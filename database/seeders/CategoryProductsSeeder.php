<?php

namespace Database\Seeders;

use App\Models\Product\CategoryProducts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Rakija', 'slug' => 'rakija', 'is_active' => true],
            ['name' => 'Vino', 'slug' => 'vino', 'is_active' => true],
            ['name' => 'Pivo', 'slug' => 'pivo', 'is_active' => true],
            ['name' => 'Žestoka pića', 'slug' => 'zestoka-pica', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            CategoryProducts::firstOrCreate($category);
        }
    }
}
