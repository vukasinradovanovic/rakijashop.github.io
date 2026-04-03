<?php

namespace Database\Seeders;

use App\Models\Product\ProductPosition;
use Illuminate\Database\Seeder;

class ProductPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name' => 'Standardan',
                'slug' => ProductPosition::SLUG_REGULAR,
                'sort_order' => 10,
            ],
            [
                'name' => 'Istaknut',
                'slug' => ProductPosition::SLUG_FEATURED,
                'sort_order' => 20,
            ],
            [
                'name' => 'Premium',
                'slug' => ProductPosition::SLUG_PREMIUM,
                'sort_order' => 30,
            ],
            [
                'name' => 'Top ponuda',
                'slug' => ProductPosition::SLUG_TOP_OFFER,
                'sort_order' => 40,
            ],
        ];

        foreach ($positions as $position) {
            ProductPosition::updateOrCreate(
                ['slug' => $position['slug']],
                $position
            );
        }
    }
}
