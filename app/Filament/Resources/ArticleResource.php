<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use App\Traits\HasArticlePermission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

class ArticleResource extends Resource
{
    use HasArticlePermission;

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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ArticleView::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
