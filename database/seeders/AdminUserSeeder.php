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
                "city_id" => 1,
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name'     => 'User',
                'password' => Hash::make('Temp123!'),
                'role_id'     => 2,
                'email_verified_at' => now(),
                'is_active' => true,
                "city_id" => 1

            ]
        );
    }
}
