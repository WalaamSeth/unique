<?php

namespace App\Traits;

use App\Contracts\PermissionCheckableInterface;
use App\Contracts\SlugGeneratorInterface;
use Illuminate\Support\Facades\App;

trait HasSlugGeneration
{
    protected static function updateSlugField(string $name, callable $set, string $modelClass): void
    {
        $slugGenerator = App::make(SlugGeneratorInterface::class);
        $slug = $slugGenerator->generate($name, $modelClass);
        $set('slug', $slug);
    }
}
