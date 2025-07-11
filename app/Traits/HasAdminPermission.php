<?php

namespace App\Traits;

use App\Contracts\PermissionCheckableInterface;
use Illuminate\Database\Eloquent\Model;

trait HasAdminPermission
{
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() &&
            auth()->user()->roles()->first()?->permissionBox?->is_admin == 1.0;
    }
}
