<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User\UserStatus;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definisanje statusa
        $statuses = ['active', 'deactivated', 'banned'];

        foreach ($statuses as $status) {
            UserStatus::create(['status' => $status]);
        }
    }
}
