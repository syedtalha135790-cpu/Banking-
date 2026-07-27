<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_number' => '1234567890',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Default Customer User
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'phone_number' => '0987654321',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);
    }
}
