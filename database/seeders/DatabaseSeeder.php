<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'nickname' => 'Tester',
            'email' => 'test@example.com',
            'phone' => '9111111111',
            'password' => Hash::make(
                value: '#test#',
                options: []
            ),
            'status' => 'Test'
        ]);
    }
}
