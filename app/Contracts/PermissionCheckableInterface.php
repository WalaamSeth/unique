<?php

namespace App\Contracts;

interface PermissionCheckableInterface
{
    public function canViewResource(): bool;
    public function canReadResource(): bool;
    public function canCreateResource(): bool;
    public function canViewUser(): bool;
    public function canReadUser(): bool;
    public function canCreateUser(): bool;
    public function canViewProduct(): bool;
    public function canReadProduct(): bool;
    public function canCreateProduct(): bool;
    public function canViewArticle(): bool;
    public function canReadArticle(): bool;
    public function canCreateArticle(): bool;
    public function hasFullPermissions(): bool;
}
