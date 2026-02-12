<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('Temp123!'),
                'role_id'     => 1,
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );
        User::updateOrCreate(
            ['email' => 'manager@gmail.com'],
            [
                'name'     => 'Manager',
                'password' => Hash::make('Temp123!'),
                'role_id'     => 2,
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );
        User::updateOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name'     => 'Staff',
                'password' => Hash::make('Temp123!'),
                'role_id'     => 3,
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name'     => 'User',
                'password' => Hash::make('Temp123!'),
                'role_id'     => 4,
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );
    }
}
