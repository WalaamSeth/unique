<?php

namespace App\Livewire;

use App\Filament\Resources\ArticleResource;
use App\Traits\HasArticlePermission;
use Livewire\Component;

class HeaderArticleLink extends Component
{
    use HasArticlePermission;

    public function render()
    {
        return view('livewire.header-article-link', [
            'url' => ArticleResource::getUrl(),
            'label' => ArticleResource::getNavigationLabel(),
            'icon' => 'heroicon-o-book-open',
        ]);
    }
}
