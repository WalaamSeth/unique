<?php

namespace App\Traits;

use App\Contracts\PermissionCheckableInterface;

trait HasAdminStatus
{
    public function getStatus(): string
    {
        $this->loadMissing('roles.permissionBox');

        $permissionBox = $this->roles->first()?->permissionBox;

        if (!$permissionBox) {
            return __('user.roles.user');
        }

        if ($permissionBox->is_admin && $permissionBox->hasFullPermissions()) {
            return __('user.roles.admin');
        }

        if ($permissionBox->hasFullPermissions()) {
            return __('user.roles.moderator');
        }

        return __('user.roles.user');
    }
}
