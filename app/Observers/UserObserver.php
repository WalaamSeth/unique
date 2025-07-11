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

    public function created(User $user)
    {
        try {
            $role = Role::where('slug', 'user')->firstOrFail();

            if (!$user->roles()->where('role_id', $role->id)->exists()) {
                $user->roles()->attach($role->id);
            }
        } catch (\Exception $e) {
            Log::error("Role attachment error: ".$e->getMessage(), [
                'user_id' => $user->id
            ]);
        }
    }
}
