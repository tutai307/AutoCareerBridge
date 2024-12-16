<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('users')->truncate();

        // Define the roles
        $roles = [
            ROLE_ADMIN,
            ROLE_COMPANY,
            ROLE_UNIVERSITY,
            ROLE_HIRING,
            ROLE_SUB_ADMIN,
            ROLE_SUB_UNIVERSITY
        ];

        for ($i = 0; $i < 6; $i++) {
            DB::table('users')->insert([
                'user_name' => 'User ' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => $roles[$i],
            ]);
        }
    }
}
