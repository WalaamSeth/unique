<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'products';
    protected $keyType = 'int';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'title',
        'description',
        'main_image',
        'additional_images',
        'user_id',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'additional_images' => 'array'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addAdditionalImage($path)
    {
        $images = $this->additional_images ?? [];
        $images[] = $path;
        $this->additional_images = $images;
    }

    public function removeAdditionalImage($index)
    {
        $images = $this->additional_images ?? [];
        unset($images[$index]);
        $this->additional_images = array_values($images);
    }

}
