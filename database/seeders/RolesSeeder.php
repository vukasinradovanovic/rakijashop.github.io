<?php

namespace Database\Seeders;

use App\Models\User\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'moderator', 'korisnik','prodavnica'];

        foreach ($roles as $role) {
            Roles::create(['role_name' => $role]);
        }
    }
}
