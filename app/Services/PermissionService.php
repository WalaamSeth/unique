<?php

namespace App\Services;

use App\Contracts\PermissionCheckableInterface;
use App\Models\PermissionBox;

class PermissionService implements PermissionCheckableInterface
{
    public function __construct(private PermissionBox $permissionBox) {}

    public function canViewResource(): bool
    {
        return (bool) $this->permissionBox->view_resource;
    }

    public function canReadResource(): bool
    {
        return $this->canViewResource() && (bool) $this->permissionBox->read_resource;
    }

    public function canCreateResource(): bool
    {
        return $this->canReadResource() && (bool) $this->permissionBox->create_resource;
    }

    public function canViewUser(): bool
    {
        return (bool) $this->permissionBox->view_user;
    }

    public function canReadUser(): bool
    {
        return $this->canViewUser() && (bool) $this->permissionBox->read_user;
    }

    public function canCreateUser(): bool
    {
        return $this->canReadUser() && (bool) $this->permissionBox->create_user;
    }

    public function canViewProduct(): bool
    {
        return (bool) $this->permissionBox->view_product;
    }

    public function canReadProduct(): bool
    {
        return $this->canViewProduct() && (bool) $this->permissionBox->read_product;
    }

    public function canCreateProduct(): bool
    {
        return $this->canReadProduct() && (bool) $this->permissionBox->create_product;
    }

    public function canViewArticle(): bool
    {
        return (bool) $this->permissionBox->view_article;
    }

    public function canReadArticle(): bool
    {
        return $this->canViewUser() && (bool) $this->permissionBox->read_article;
    }

    public function canCreateArticle(): bool
    {
        return $this->canReadUser() && (bool) $this->permissionBox->create_article;
    }

    public function hasFullPermissions(): bool
    {
        return $this->permissionBox->hasFullPermissions();
    }
}
