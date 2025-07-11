<?php

namespace App\Models;

use App\Contracts\PermissionCheckableInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PermissionBox
 *
 * @property int $id
 * @property string|null $name
 * @property bool $view_resource
 * @property bool $read_resource
 * @property bool $create_resource
 * @property bool $view_user
 * @property bool $read_user
 * @property bool $create_user
 * @property bool $view_product
 * @property bool $read_product
 * @property bool $create_product
 * @property bool $view_article
 * @property bool $read_article
 * @property bool $create_article
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 *
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
 *
 * @mixin \Eloquent
 */
class PermissionBox extends Model implements PermissionCheckableInterface
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
        'view_product',
        'read_product',
        'create_product',
        'view_article',
        'read_article',
        'create_article',
        'is_admin',
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
            'view_product' => 'float',
            'read_product' => 'float',
            'create_product' => 'float',
            'view_article' => 'float',
            'read_article' => 'float',
            'create_article' => 'float',
            'is_admin' => 'float',
        ];
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'permission_boxes_id');
    }

    public function canViewResource(): bool
    {
        return (bool) $this->view_resource;
    }

    public function canReadResource(): bool
    {
        return $this->canViewResource() && (bool) $this->read_resource;
    }

    public function canCreateResource(): bool
    {
        return $this->canReadResource() && (bool) $this->create_resource;
    }

    public function canViewUser(): bool
    {
        return (bool) $this->view_user;
    }

    public function canReadUser(): bool
    {
        return $this->canViewUser() && (bool) $this->read_user;
    }

    public function canCreateUser(): bool
    {
        return $this->canReadUser() && (bool) $this->create_user;
    }

    public function canViewProduct(): bool
    {
        return (bool) $this->view_product;
    }

    public function canReadProduct(): bool
    {
        return $this->canViewProduct() && (bool) $this->read_product;
    }

    public function canCreateProduct(): bool
    {
        return $this->canReadProduct() && (bool) $this->create_product;
    }

    public function canViewArticle(): bool
    {
        return (bool) $this->view_article;
    }

    public function canReadArticle(): bool
    {
        return $this->canViewUser() && (bool) $this->read_article;
    }

    public function canCreateArticle(): bool
    {
        return $this->canReadUser() && (bool) $this->create_article;
    }

    public function hasFullPermissions(): bool
    {
        return $this->canCreateResource()
            && $this->canCreateUser()
            && $this->canCreateProduct()
            && $this->canCreateArticle()
            && $this->canReadResource()
            && $this->canReadProduct()
            && $this->canReadUser()
            && $this->canReadArticle()
            && $this->canViewResource()
            && $this->canViewProduct()
            && $this->canViewUser()
            && $this->canViewArticle();
    }
}
