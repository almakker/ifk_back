<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run()
    {
        // Create admin 
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password', 
            'role' => User::ROLE_ADMIN,
        ]);

        // Create test users
        User::factory()->count(5)->create([
            'role' => User::ROLE_STAFF
        ]);
    }
} 