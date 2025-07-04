<?php

namespace App\Traits;

use App\Contracts\PermissionCheckableInterface;

trait HasAdminStatus
{
    public function getStatus(): string
    {
        if (!$this->role || !$this->role->permissionBox) {
            return 'Пользователь';
        }

        return $this->role->permissionBox instanceof PermissionCheckableInterface &&
        $this->role->permissionBox->hasFullPermissions()
            ? 'Админ'
            : 'Пользователь';
    }
}
