<?php

namespace App\Services;

use App\Contracts\PermissionCheckableInterface;
use App\Contracts\SlugGeneratorInterface;
use App\Models\PermissionBox;
use Illuminate\Support\Str;

class SlugGenerator implements SlugGeneratorInterface
{
    public function generate(string $text, string $modelClass, string $slugField = 'slug'): string
    {
        $slug = Str::slug($text);
        $originalSlug = $slug;
        $count = 1;

        while ($modelClass::where($slugField, $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
