<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $fillable = [
        'title',
        'content',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];


    public function getThumbnailAttribute(): ?string
    {
        return $this->images ? $this->images[0] : null;
    }
}
