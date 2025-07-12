<?php

namespace App\Traits\AdminPermission;

trait HasAdminPermission
{
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() &&
            auth()->user()->roles()->first()?->permissionBox?->is_admin == 1.0;
    }
}
