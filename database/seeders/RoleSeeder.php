<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'permissions' => [
                    'view_dashboard',
                    'upload_documents',
                    'approve_agreement',
                    'verify_payment',
                    'manage_users',
                    'view_reports',
                    'edit_profile',
                    'track_application',
                    'manage_roles',
                    'view_all_applications'
                ],
                'is_active' => true
            ],
            [
                'name' => 'User',
                'permissions' => [
                    'view_dashboard',
                    'upload_documents',
                    'edit_profile',
                    'track_application'
                ],
                'is_active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
