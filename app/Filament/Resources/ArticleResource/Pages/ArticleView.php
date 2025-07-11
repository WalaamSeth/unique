<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\View;
use Filament\Resources\Pages\ViewRecord;

class ArticleView extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')
                    ->schema([
                        TextInput::make('title')
                            ->label('Заголовок')
                            ->disabled(),

                        RichEditor::make('content')
                            ->label('Содержание')
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Изображения')
                    ->schema([
                        FileUpload::make('images')
                            ->disabled()
                            ->image()
                            ->multiple()
                            ->view('filament.forms.components.full-size-images'), // 👈 Кастомный шаблон
                    ]),
            ]);
    }
}
