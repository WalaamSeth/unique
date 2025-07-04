<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Select::make('role_id')
                    ->label(__('user.role'))
                    ->options(Role::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->dehydrated()
                    ->live()
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

    protected static function updateStatusBasedOnRole(Forms\Set $set, $roleId): void
    {
        $role = Role::with('permissionBox')->find($roleId);
        $set('status', $role?->permissionBox?->hasFullPermissions() ? 'Админ' : 'Пользователь');
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
                    Tables\Actions\DeleteBulkAction::make(),
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
