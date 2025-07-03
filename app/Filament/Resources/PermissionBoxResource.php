<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionBoxResource\Pages;
use App\Filament\Resources\PermissionBoxResource\RelationManagers;
use App\Models\PermissionBox;
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
    protected static ?string $model = PermissionBox::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                TextInput::make('name')
                    ->label('Название пакета доступов')
                    ->placeholder('Введите название пакета доступов')
                    ->required()
                ]),
                Forms\Components\Section::make('Разрешения')
                    ->schema([
                        Grid::make(3)->schema([
                            Toggle::make('view_resource')
                                ->label('Просмотр ресурсов'),
                            Toggle::make('read_resource')
                                ->label('Изменение ресурсов'),
                            Toggle::make('create_resource')
                                ->label('Создание ресурсов'),
                        ]),
                        Grid::make(3)->schema([
                            Toggle::make('view_user')
                                ->label('Просмотр пользователей'),
                            Toggle::make('read_user')
                                ->label('Изменение пользователей'),
                            Toggle::make('create_user')
                                ->label('Создание пользователей'),
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название пакета доступов')
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
            'index' => Pages\ListPermissionBoxes::route('/'),
            'create' => Pages\CreatePermissionBox::route('/create'),
            'edit' => Pages\EditPermissionBox::route('/{record}/edit'),
        ];
    }
}
