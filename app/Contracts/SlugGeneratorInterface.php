<?php

namespace App\Contracts;

interface SlugGeneratorInterface
{
    public function generate(string $text, string $modelClass, string $slugField = 'slug'): string;
}
