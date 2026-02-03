<?php

namespace Database\Seeders;

use App\Models\Cities\Cities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Beograd', 'Novi Sad', 'Niš', 'Kragujevac', 'Subotica', 
            'Zrenjanin', 'Pancevo', 'Kraljevo', 'Kruševac', 'Čačak', 'Leskovac', 
            'Valjevo', 'Vranje', 'Senta', 'Sombor', 'Šabac', 
            'Pirot', 'Apatin', 'Vršac', 'Jagodina', 'Požarevac'
        ];

        foreach ($cities as $city) {
            Cities::create(['city' => $city]);
        }
    }
}
