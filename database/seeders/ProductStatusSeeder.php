<?php

namespace Database\Seeders;

use App\Models\Product\ProductStatus;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'aktivan',
            'neaktivan',
            'rasprodat',
        ];

        foreach ($statuses as $status) {
            ProductStatus::firstOrCreate([
                'name' => $status,
            ]);
        }
    }
}
