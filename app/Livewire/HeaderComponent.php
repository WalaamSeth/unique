<?php

namespace App\Livewire;

use Livewire\Component;

class HeaderComponent extends Component
{
    public string $search = '';

    protected $queryString = ['search'];

    public function updatedSearch()
    {
        return redirect()->to('/?search='.$this->search);
    }

    public function render()
    {
        return view('livewire.header-component');
    }
}
