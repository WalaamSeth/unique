<?php

namespace App\Traits\RoleAndPermission;

use Illuminate\Database\Eloquent\Model;

trait HasUserPermission
{
    public static function canViewAny(): bool
    {
        return auth()->user()?->canViewUser() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->canCreateUser() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->canReadUser() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->canReadUser() ?? false;
    }
}
