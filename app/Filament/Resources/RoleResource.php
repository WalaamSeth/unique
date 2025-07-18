<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Manufacturer\Manufacturer;
use App\Models\PermissionBox;
use App\Models\Role;
use App\Traits\AdminPermission\HasAdminPermission;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoleResource extends Resource
{
    use HasAdminPermission;

    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->roles()->first()?->permissionBox?->is_admin == 1.0;
    }
    /**
     * БЛОК ЛОКАЛИЗАЦИИ
     */
    public static function getLabel(): string
    {
        return __('admin.role');
    }

    public static function getPluralLabel(): string
    {
        return __('admin.roles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('role.role_name'))
                    ->placeholder(__('role.role_name_description'))
                    ->required(),
                Select::make('permission_boxes_id')
                    ->label(__('role.permit_name'))
                    ->options(PermissionBox::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->dehydrated()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('role.role_name')),
                Tables\Columns\TextColumn::make('permissionBox.name')
                    ->label(__('role.permit_name')),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
