<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        if ($user->isDirty('roles')) {
            $user->load('roles.permissionBox');
            $user->status = $user->getStatus();
        }
    }
}
