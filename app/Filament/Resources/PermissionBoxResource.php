<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionBoxResource\Pages;
use App\Filament\Resources\PermissionBoxResource\RelationManagers;
use App\Models\PermissionBox;
use App\Traits\HasAdminPermission;
use App\Traits\HasResourcePermission;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionBoxResource extends Resource
{
    use HasAdminPermission;

    protected static ?string $model = PermissionBox::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?int $navigationSort = 1;

    /**
     * БЛОК ЛОКАЛИЗАЦИИ
     */
    public static function getLabel(): string
    {
        return __('admin.permit_box');
    }

    public static function getPluralLabel(): string
    {
        return __('admin.permit_boxes');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                TextInput::make('name')
                    ->label(__('admin.title'))
                    ->placeholder(__('admin.enterTitle'))
                    ->required()
                ]),
                Forms\Components\Section::make('Разрешения')
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                        Grid::make(3)->schema([
                            Toggle::make('is_admin')
                                ->label(__('permission.is_admin'))
                                ->live()
                                ->afterStateUpdated(function ($state, Forms\Set $set) {
                                    self::toggleAllPermissions($state, $set);
                                }),
                        ]),
                            ]),
                        Grid::make(3)->schema([
                            Toggle::make('view_resource')
                                ->label(__('permission.view_resource'))
                                ->reactive(),
                            Toggle::make('read_resource')
                                ->label(__('permission.read_resource'))
                                ->reactive(),
                            Toggle::make('create_resource')
                                ->label(__('permission.create_resource'))
                                ->reactive(),
                        ]),
                        Grid::make(3)->schema([
                            Toggle::make('view_user')
                                ->label(__('permission.view_user'))
                                ->reactive(),
                            Toggle::make('read_user')
                                ->label(__('permission.read_user'))
                                ->reactive(),
                            Toggle::make('create_user')
                                ->label(__('permission.create_user'))
                                ->reactive(),
                        ]),
                        Grid::make(3)->schema([
                            Toggle::make('view_product')
                                ->label(__('permission.view_product'))
                                ->reactive(),
                            Toggle::make('read_product')
                                ->label(__('permission.read_product'))
                                ->reactive(),
                            Toggle::make('create_product')
                                ->label(__('permission.create_product'))
                                ->reactive(),
                        ]),
                        Grid::make(3)->schema([
                            Toggle::make('view_article')
                                ->label(__('permission.view_article'))
                                ->reactive(),
                            Toggle::make('read_article')
                                ->label(__('permission.read_article'))
                                ->reactive(),
                            Toggle::make('create_article')
                                ->label(__('permission.create_article'))
                                ->reactive(),

                        ])
                    ])
            ]);
    }

    protected static function toggleAllPermissions($state, Forms\Set $set): void
    {
        $permissions = [
            'view_resource', 'read_resource', 'create_resource',
            'view_user', 'read_user', 'create_user',
            'view_article', 'read_article', 'create_article'
        ];

        foreach ($permissions as $permission) {
            $set($permission, $state ? 1.0 : 0.0);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.title'))
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
            'index' => Pages\ListPermissionBoxes::route('/'),
            'create' => Pages\CreatePermissionBox::route('/create'),
            'edit' => Pages\EditPermissionBox::route('/{record}/edit'),
        ];
    }
}
