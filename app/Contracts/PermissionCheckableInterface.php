<?php

namespace App\Contracts;

interface PermissionCheckableInterface
{
    public function hasFullPermissions(): bool;
}
