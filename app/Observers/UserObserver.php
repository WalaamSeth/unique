<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        if ($user->isDirty('role_id')) {
            $user->status = $user->status;
        }
    }
}
