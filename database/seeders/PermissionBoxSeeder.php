<?php

namespace Database\Seeders;

use App\Models\PermissionBox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Админские разрешения
        PermissionBox::create([
            'name' => 'Админский доступ',
            'view_resource' => 1,
            'read_resource' => 1,
            'create_resource' => 1,
            'view_user' => 1,
            'read_user' => 1,
            'create_user' => 1,
            'view_product' => 1,
            'read_product' => 1,
            'create_product' => 1,
            'view_article' => 1,
            'read_article' => 1,
            'create_article' => 1,
            'is_admin' => 1,
        ]);

        // Модераторские разрешения
        PermissionBox::create([
            'name' => 'Модераторский доступ',
            'view_resource' => 1,
            'read_resource' => 1,
            'create_resource' => 1,
            'view_user' => 1,
            'read_user' => 1,
            'create_user' => 1,
            'view_product' => 1,
            'read_product' => 1,
            'create_product' => 1,
            'view_article' => 1,
            'read_article' => 1,
            'create_article' => 1,
            'is_admin' => 0,
        ]);

        // Пользовательские разрешения
        PermissionBox::create([
            'name' => 'Пользовательский доступ',
            'view_resource' => 0,
            'read_resource' => 0,
            'create_resource' => 0,
            'view_user' => 0,
            'read_user' => 0,
            'view_product' => 1,
            'read_product' => 1,
            'create_product' => 1,
            'create_user' => 0,
            'view_article' => 1,
            'read_article' => 0,
            'create_article' => 0,
            'is_admin' => 0,
        ]);
    }
}
