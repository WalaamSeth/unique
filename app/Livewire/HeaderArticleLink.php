<?php

namespace App\Livewire;

use App\Traits\RoleAndPermission\HasArticlePermission;
use Livewire\Component;

class HeaderArticleLink extends Component
{
    use HasArticlePermission;

    public $url;
    public $icon;
    public $label;

    public function mount($url, $icon, $label)
    {
        $this->url = $url;
        $this->icon = $icon;
        $this->label = $label;
    }
    public function render()
    {
        return view('livewire.header-article-link', [
            'hasAccess' => $this->canViewAny()
        ]);
    }
}
