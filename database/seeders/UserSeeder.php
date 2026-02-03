<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Section 1: add users via an array (bulk insert)
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'remember_token' => str()->random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => Hash::make('manager123'),
                'email_verified_at' => now(),
                'remember_token' => str()->random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basic User',
                'email' => 'user@example.com',
                'password' => Hash::make('user12345'),
                'email_verified_at' => null,
                'remember_token' => str()->random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Perform bulk insert; ensure timestamps/passwords provided
        User::query()->insert($users);
    }
}
