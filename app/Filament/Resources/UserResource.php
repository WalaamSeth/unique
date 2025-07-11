<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use App\Traits\HasResourcePermission;
use App\Traits\HasUserPermission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    use HasUserPermission;

    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 3;

    /**
     * БЛОК ЛОКАЛИЗАЦИИ
     */
    public static function getLabel(): string
    {
        return __('admin.user');
    }

    public static function getPluralLabel(): string
    {
        return __('admin.users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('user.name'))
                            ->placeholder(__('user.name_description'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nickname')
                            ->label(__('user.nickname'))
                            ->placeholder(__('user.nickname_description'))
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('')
                    ->schema([
                        TextInput::make('phone')
                            ->label(__('user.phone'))
                            ->placeholder(__('user.phone_description'))
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label(__('user.email'))
                            ->placeholder(__('user.email_description'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('password')
                            ->label(__('user.password'))
                            ->placeholder(__('user.password_description'))
                            ->password()
                            ->required()
                            ->maxLength(255),
                    ]),
                Forms\Components\Section::make('')
                    ->schema([
                        Select::make('roles')
                        ->label(__('user.role'))
                            ->relationship(
                                name: 'roles',
                                titleAttribute: 'name',
                            )
                            ->preload()
                            ->searchable()
                            ->required()
                            ->live()
                            ->dehydrated(false)
                            ->afterStateUpdated(function (Forms\Set $set, $state) {
                                static::updateStatusBasedOnRole($set, $state);
                            }),
                        TextInput::make('status')
                            ->label(__('user.status'))
                            ->disabled()
                            ->maxLength(255)
                            ->dehydrated()
                    ]),
            ]);
    }

    protected static function updateStatusBasedOnRole(Forms\Set $set, $state): void
    {
        if (empty($state)) {
            $set('status', __('user.roles.user'));
            return;
        }

        $roleId = is_array($state) ? $state[0] : $state;
        $role = Role::with('permissionBox')->find($roleId);

        $status = $role?->permissionBox?->is_admin
            ? __('user.roles.admin')
            : ($role?->permissionBox?->hasFullPermissions()
                ? __('user.roles.moderator')
                : __('user.roles.user'));

        $set('status', $status);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('roles.permissionBox');
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('user.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('nickname')
                    ->label(__('user.nickname'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('user.status'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('user.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
