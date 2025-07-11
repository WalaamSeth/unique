<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $main_image
 * @property array|null $additional_images
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read \App\Models\User $user
 * @property-read int|null $categories_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAdditionalImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

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
