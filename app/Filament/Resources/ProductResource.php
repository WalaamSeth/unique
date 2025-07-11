<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Traits\HasProductPermission;
use App\Traits\HasResourcePermission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    use HasProductPermission;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 5;

    /**
     * БЛОК ЛОКАЛИЗАЦИИ
     */
    public static function getLabel(): string
    {
        return __('admin.product');
    }

    public static function getPluralLabel(): string
    {
        return __('admin.products');
    }


    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!auth()->user()->roles()->first()?->permissionBox?->is_admin) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.title'))
                    ->placeholder(__('admin.enterTitle'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label(__('admin.description'))
                    ->placeholder(__('admin.enterDescription'))
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('main_image')
                    ->label(__('admin.main_image'))
                    ->image()
                    ->directory('products/main')
                    ->required()
                    ->preserveFilenames()
                    ->imageEditor()
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('additional_images')
                    ->label(__('admin.add_image'))
                    ->image()
                    ->directory('products/additional')
                    ->multiple()
                    ->maxFiles(3)
                    ->preserveFilenames()
                    ->imageEditor()
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull(),

                Forms\Components\Select::make('categories')
                    ->label(__('admin.categories'))
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload()
                    ->required()
                    ->afterStateUpdated(function ($state, $record) {
                        if (!$record) return;

                        $record->clearMediaCollection('additional_images');
                        foreach ($state as $file) {
                            $record->addMedia($file->getRealPath())
                                ->toMediaCollection('additional_images');
                        }
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('admin.owner'))
                    ->visible(fn() => auth()->user()->roles()->first()?->permissionBox?->is_admin),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.title'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('categories.name')
                    ->label(__('admin.categories'))
                    ->badge(),

                Tables\Columns\ImageColumn::make('main_image')
                    ->label(__('admin.main_image'))
                    ->disk('public')
                    ->height(50)
                    ->circular(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
