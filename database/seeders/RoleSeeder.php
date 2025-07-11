<?php

namespace Database\Seeders;

use App\Models\PermissionBox;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $adminPermission = PermissionBox::where('name', 'Админский доступ')->first();
        $moderatorPermission = PermissionBox::where('name', 'Модераторский доступ')->first();
        $userPermission = PermissionBox::where('name', 'Пользовательский доступ')->first();

        Role::create([
            'name' => 'Админ',
            'slug' => 'admin',
            'permission_boxes_id' => $adminPermission->id,
        ]);

        Role::create([
            'name' => 'Модератор',
            'slug' => 'moderator',
            'permission_boxes_id' => $moderatorPermission->id,
        ]);

        Role::create([
            'name' => 'Пользователь',
            'slug' => 'user',
            'permission_boxes_id' => $userPermission->id,
        ]);
    }
}
