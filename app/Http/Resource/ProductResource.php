<?php

namespace App\Http\Resource;

use Illuminate\Http\Request;

class ProductResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'main_image' => $this->main_image ? asset('storage/'.$this->main_image) : null,
            'additional_images' => $this->additional_images
                ? array_map(fn($img) => asset('storage/'.$img), $this->additional_images)
                : [],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'categories' => $this->categories->map(fn($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
            ]),
            'created_at' => $this->created_at->format('d.m.Y H:i'),
        ];
    }
}
