<?php

namespace App\Traits\RoleAndPermission;

use Illuminate\Database\Eloquent\Model;

trait HasResourcePermission
{
    public static function canViewAny(): bool
    {
        return auth()->user()?->canViewResource() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->canCreateResource() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->canReadResource() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->canReadResource() ?? false;
    }
}
