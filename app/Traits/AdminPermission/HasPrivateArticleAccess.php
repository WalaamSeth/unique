<?php

namespace App\Traits\AdminPermission;

use Illuminate\Database\Eloquent\Model;

trait HasPrivateArticleAccess
{
    public static function canViewPrivateArticles(): bool
    {
        return auth()->user()->roles()->first()?->permissionBox?->is_admin == 1.0;
    }
    public static function canViewArticle(Model $article): bool
    {
        if (!$article->is_private) {
            return true;
        }

        return self::canViewPrivateArticles();
    }
}
