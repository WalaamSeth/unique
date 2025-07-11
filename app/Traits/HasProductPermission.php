<?php

namespace App\Traits;

use App\Contracts\PermissionCheckableInterface;
use Illuminate\Database\Eloquent\Model;

trait HasProductPermission
{
    public static function canViewAny(): bool
    {
        return auth()->user()?->canViewProduct() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->canCreateProduct() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->canReadProduct() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->canReadProduct() ?? false;
    }
}
