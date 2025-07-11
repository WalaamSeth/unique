<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;
use App\Services\PermissionService;
use App\Traits\HasAdminStatus;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $nickname
 * @property string $email
 * @property string $password
 * @property string|null $phone
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $notifications_count
 * @property-read int|null $roles_count
 * @property-read int|null $tokens_count
 */
#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasAdminStatus;

    protected $table = 'users';
    protected $keyType = 'int';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'phone',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'nickname' => 'string',
            'email' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'phone' => 'string',
            'status' => 'string',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function canViewResource(): bool
    {
        return $this->getPermissionService()->canViewResource();
    }

    public function canReadResource(): bool
    {
        return $this->getPermissionService()->canReadResource();
    }

    public function canCreateResource(): bool
    {
        return $this->getPermissionService()->canCreateResource();
    }

    public function canViewUser(): bool
    {
        return $this->getPermissionService()->canViewUser();
    }

    public function canReadUser(): bool
    {
        return $this->getPermissionService()->canReadUser();
    }

    public function canCreateUser(): bool
    {
        return $this->getPermissionService()->canCreateUser();
    }

    public function canViewProduct(): bool
    {
        return $this->getPermissionService()->canViewProduct();
    }

    public function canReadProduct(): bool
    {
        return $this->getPermissionService()->canReadProduct();
    }

    public function canCreateProduct(): bool
    {
        return $this->getPermissionService()->canCreateProduct();
    }

    public function canViewArticle(): bool
    {
        return $this->getPermissionService()->canViewArticle();
    }

    public function canReadArticle(): bool
    {
        return $this->getPermissionService()->canReadArticle();
    }

    public function canCreateArticle(): bool
    {
        return $this->getPermissionService()->canCreateArticle();
    }

    public function hasFullPermissions(): bool
    {
        return $this->getPermissionService()->hasFullPermissions();
    }

    protected function getPermissionService(): PermissionService
    {
        if (!$this->relationLoaded('roles')) {
            $this->load('roles.permissionBox');
        }

        $permissionBox = $this->roles->first()?->permissionBox ?? new PermissionBox();

        return new PermissionService($permissionBox);
    }
    public function getStatusAttribute(): string
    {
        return $this->getStatus();
    }
}
