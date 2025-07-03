<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property float $view_resource
 * @property float $read_resource
 * @property float $create_resource
 * @property float $view_user
 * @property float $read_user
 * @property float $create_user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox query()
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereCreateResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereCreateUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereReadResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereReadUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereViewResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionBox whereViewUser($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PermissionBox extends Model
{
    protected $table = 'permission_boxes';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'view_resource',
        'read_resource',
        'create_resource',
        'view_user',
        'read_user',
        'create_user',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'view_resource' => 'float',
            'read_resource' => 'float',
            'create_resource' => 'float',
            'view_user' => 'float',
            'read_user' => 'float',
            'create_user' => 'float',
        ];
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'permission_boxes_id');
    }
}
