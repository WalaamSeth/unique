<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $moderatorRole = Role::where('slug', 'moderator')->first();
        $userRole = Role::where('slug', 'user')->first();

        // Администратор
        $admin = User::create([
            'name' => 'Admin',
            'nickname' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '1111111111',
            'password' => Hash::make(
                value: '123',
                options: []
            ),
            'status' => 'Администратор',
        ]);

        $admin->roles()->attach($adminRole);

        // Модератор
        $mod = User::create([
            'name' => 'Moderator',
            'nickname' => 'Moderator',
            'email' => 'mod@example.com',
            'phone' => '1111111111',
            'password' => Hash::make(
                value: '231',
                options: []
            ),
            'status' => 'Модератор',
        ]);

        $mod->roles()->attach($moderatorRole);

        // Обычный пользователь
        $user = User::create([
            'name' => 'User',
            'nickname' => 'User',
            'email' => 'user@example.com',
            'phone' => '1111111111',
            'password' => Hash::make(
                value: '321',
                options: []
            ),
            'status' => 'Пользователь',
        ]);

        $user->roles()->attach($userRole);
    }
}
