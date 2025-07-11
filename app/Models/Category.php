<?php

namespace App\Models;

use App\Contracts\SlugGeneratorInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $keyType = 'int';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'name' => 'string'
    ];

    protected $fillable = ['name', 'slug'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $slugGenerator = App::make(SlugGeneratorInterface::class);
            $category->slug = $slugGenerator->generate(
                $category->name,
                self::class
            );
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $slugGenerator = App::make(SlugGeneratorInterface::class);
                $category->slug = $slugGenerator->generate(
                    $category->name,
                    self::class
                );
            }
        });
    }
}
