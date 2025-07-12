<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Traits\AdminPermission\HasPrivateArticleAccess;
use App\Traits\RoleAndPermission\HasArticlePermission;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ArticleResource extends Resource
{
    use HasArticlePermission, HasPrivateArticleAccess;

    protected static ?string $model = Article::class;
    protected static ?string $navigationGroup = null;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    /**
     * БЛОК ЛОКАЛИЗАЦИИ
     */
    public static function getLabel(): string
    {
        return __('admin.article');
    }

    public static function getPluralLabel(): string
    {
        return __('admin.articles');
    }

    /**
     * БЛОК доступа к приватным статьям
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(!self::canViewPrivateArticles(), function ($query) {
                $query->where('is_private', false);
            });
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                TextInput::make('title')
                    ->label(__('admin.article_title'))
                    ->placeholder(__('admin.enterTitle'))
                    ->required(),
                RichEditor::make('content')
                    ->label(__('admin.article_description'))
                    ->placeholder(__('admin.enterDescription'))
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('kb-images')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'undo',
                    ])
                    ->required(),
                ]),
                Forms\Components\Section::make('')
                    ->schema([
                Forms\Components\Toggle::make('is_private')
                    ->label(__('articles.private'))
                    ->helperText(__('articles.private_helper'))
                    ->default(false),
                    ]),
                Forms\Components\Section::make('')
                    ->schema([
                FileUpload::make('images')
                    ->label(__(''))
                    ->multiple()
                    ->image()
                    ->directory('kb-images'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.article_title'))
                    ->searchable(),
                static::getArticleTypeColumn(),
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
    /**
     * БЛОК стилизации поля "Тип статьи"
     */
    protected static function getArticleTypeColumn(): Tables\Columns\TextColumn
    {
        return Tables\Columns\TextColumn::make('is_private')
            ->label(__('Тип статьи'))
            ->formatStateUsing(fn ($state) => $state
                ? __('Приватная статья')
                : __('Публичная статья'))
            ->badge()
            ->color(fn ($state) => static::getArticleTypeColor($state))
            ->icon(fn ($state) => static::getArticleTypeIcon($state))
            ->extraAttributes(fn ($state) => static::getArticleTypeStyles($state));
    }

    protected static function getArticleTypeColor(bool $isPrivate): string
    {
        return $isPrivate ? 'danger' : 'success';
    }

    protected static function getArticleTypeIcon(bool $isPrivate): string
    {
        return $isPrivate ? 'heroicon-o-lock-closed' : 'heroicon-o-globe-alt';
    }

    protected static function getArticleTypeStyles(bool $isPrivate): array
    {
        return [
            'class' => $isPrivate
                ? 'border-red-500 px-2 py-1 rounded-lg'
                : 'border-green-500 px-2 py-1 rounded-lg',
        ];
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ArticleView::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
