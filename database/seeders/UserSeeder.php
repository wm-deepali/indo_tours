<?php

namespace Database\Seeders;

use App\Models\RoleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure a Super Admin role category exists and is flagged correctly
        $superAdminRole = RoleCategory::updateOrCreate(
            ['name' => 'Super Admin'],
            [
                'description' => 'Full system control — bypasses all permission checks.',
                'sort_order' => 1,
                'status' => true,
                'is_super_admin' => true,
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('password123'),
                'role_category_id' => $superAdminRole->id,
                'status' => true,
            ]
        );

    }
}