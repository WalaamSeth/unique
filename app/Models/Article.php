<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 * @property int $id Уникальный идентификатор статьи
 * @property string $title Заголовок статьи
 * @property string $content Содержание статьи
 * @property array|null $images Массив путей к изображениям
 * @property \Illuminate\Support\Carbon $created_at Дата создания
 * @property \Illuminate\Support\Carbon $updated_at Дата обновления
 *
 * @property-read string|null $thumbnail Псевдосвойство - первое изображение из массива
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 */
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
