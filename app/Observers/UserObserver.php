<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
