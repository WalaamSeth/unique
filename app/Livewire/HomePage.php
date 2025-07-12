<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn($q) => $q->where(function($query) {
                $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            }))
            ->with(['user', 'categories'])
            ->latest()
            ->paginate(12);

        return view('livewire.home-page', compact('products'))->layout('layouts.app');
    }
}
