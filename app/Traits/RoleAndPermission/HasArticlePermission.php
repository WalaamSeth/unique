<?php

namespace App\Traits\RoleAndPermission;

use Illuminate\Database\Eloquent\Model;

trait HasArticlePermission
{
    public static function canViewAny(): bool
    {
        return auth()->user()?->canViewArticle() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->canCreateArticle() ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->canReadArticle() ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->canReadArticle() ?? false;
    }
}
