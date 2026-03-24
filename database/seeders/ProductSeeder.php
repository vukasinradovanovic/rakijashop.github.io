<?php

namespace Database\Seeders;

use App\Models\Product\Product;
use App\Models\Product\ProductStatus;
use App\Models\Product\CategoryProducts;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusId = ProductStatus::query()
            ->where('name', 'aktivan')
            ->value('id')
            ?? ProductStatus::query()->value('id');

        if (!$statusId) {
            return;
        }

        $products = [
            ['name' => 'Šljivovica Klasik', 'description' => 'Tradicionalna šljivovica punog ukusa i mirisa zrele šljive.', 'price' => 1590.00, 'category_name' => 'Rakija', 'owner_email' => 'admin@example.com'],
            ['name' => 'Kajsijeva Rakija Premium', 'description' => 'Aromatična kajsija sa blagim završetkom i voćnim notama.', 'price' => 1790.00, 'category_name' => 'Rakija', 'owner_email' => 'manager@example.com'],
            ['name' => 'Dunjevača Zlatna', 'description' => 'Prepoznatljiv miris dunje i harmoničan ukus.', 'price' => 1890.00, 'category_name' => 'Rakija', 'owner_email' => 'user@example.com'],
            ['name' => 'Viljamovka Reserve', 'description' => 'Fina rakija od viljamovke sa dugim i čistim aftertaste-om.', 'price' => 1990.00, 'category_name' => 'Rakija', 'owner_email' => 'admin@example.com'],
            ['name' => 'Lozovača Heritage', 'description' => 'Rakija od grožđa sa osvežavajućim i suvim tonovima.', 'price' => 1490.00, 'category_name' => 'Rakija', 'owner_email' => 'manager@example.com'],
            ['name' => 'Medovača Balkan', 'description' => 'Spoj prirodnog meda i blage rakije za pitak karakter.', 'price' => 1690.00, 'category_name' => 'Rakija', 'owner_email' => 'user@example.com'],
            ['name' => 'Travarica Planinska', 'description' => 'Biljne note sa planinskim začinskim završetkom.', 'price' => 1550.00, 'category_name' => 'Žestoka pića', 'owner_email' => 'admin@example.com'],
            ['name' => 'Višnjevača Crvena', 'description' => 'Intenzivan ukus višnje sa prijatnom slatkoćom.', 'price' => 1450.00, 'category_name' => 'Žestoka pića', 'owner_email' => 'manager@example.com'],
            ['name' => 'Malinovača Fruktus', 'description' => 'Voćna rakija od maline, lagana i osvežavajuća.', 'price' => 1750.00, 'category_name' => 'Žestoka pića', 'owner_email' => 'user@example.com'],
            ['name' => 'Jabukovača Classic', 'description' => 'Balans svežine jabuke i blage topline alkohola.', 'price' => 1390.00, 'category_name' => 'Žestoka pića', 'owner_email' => 'admin@example.com'],
            ['name' => 'Orahovača Domaca', 'description' => 'Bogata aroma zelenog oraha sa blagom gorčinom.', 'price' => 1650.00, 'category_name' => 'Žestoka pića', 'owner_email' => 'manager@example.com'],
            ['name' => 'Kleka Select', 'description' => 'Jedinstven karakter kleke za ljubitelje jačih aroma.', 'price' => 1720.00, 'category_name' => 'Žestoka pića', 'owner_email' => 'user@example.com'],
            ['name' => 'Šljivovica Barrique', 'description' => 'Odležana u hrastu za dublji, zaokružen profil.', 'price' => 2290.00, 'category_name' => 'Vino', 'owner_email' => 'admin@example.com'],
            ['name' => 'Kruška Gold', 'description' => 'Rakija od kruške sa elegantnim i mekim završetkom.', 'price' => 1840.00, 'category_name' => 'Vino', 'owner_email' => 'manager@example.com'],
            ['name' => 'Kajsija Reserve', 'description' => 'Odležana kajsijeva rakija sa bogatim voćnim slojevima.', 'price' => 2190.00, 'category_name' => 'Vino', 'owner_email' => 'user@example.com'],
            ['name' => 'Dunja Special', 'description' => 'Plemenita dunjevača izraženog mirisa i punoće.', 'price' => 2090.00, 'category_name' => 'Vino', 'owner_email' => 'admin@example.com'],
            ['name' => 'Loza Premium', 'description' => 'Čista i suva lozovača sa pažljivo odabranim grožđem.', 'price' => 1640.00, 'category_name' => 'Pivo', 'owner_email' => 'manager@example.com'],
            ['name' => 'Smokvovaca Dalmatia', 'description' => 'Specifična rakija od smokve sa toplim notama.', 'price' => 1940.00, 'category_name' => 'Pivo', 'owner_email' => 'user@example.com'],
            ['name' => 'Kupinovaca Royal', 'description' => 'Aromatična kupina i bogat voćni ukus.', 'price' => 1860.00, 'category_name' => 'Pivo', 'owner_email' => 'admin@example.com'],
            ['name' => 'Šumska Mistika', 'description' => 'Kompleksna voćna rakija inspirisana šumskim plodovima.', 'price' => 1980.00, 'category_name' => 'Pivo', 'owner_email' => 'manager@example.com'],
        ];

        $usersByEmail = User::query()
            ->whereIn('email', ['admin@example.com', 'manager@example.com', 'user@example.com'])
            ->pluck('id', 'email');

        $categoryNames = collect($products)
            ->pluck('category_name')
            ->unique();

        foreach ($categoryNames as $categoryName) {
            CategoryProducts::firstOrCreate(
                ['name' => $categoryName],
                [
                    'slug' => Str::slug($categoryName),
                    'is_active' => true,
                ]
            );
        }

        $categoryIdsByName = CategoryProducts::query()
            ->whereIn('name', $categoryNames->all())
            ->pluck('id', 'name');

        foreach ($products as $product) {
            $model = Product::updateOrCreate(
                ['slug' => Str::slug($product['name'])],
                [
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'status_id' => $statusId,
                ]
            );

            $ownerId = $usersByEmail[$product['owner_email']] ?? null;
            if ($ownerId) {
                $model->users()->sync([$ownerId]);
            }

            $categoryId = $categoryIdsByName[$product['category_name']] ?? null;
            if ($categoryId) {
                $model->categories()->sync([$categoryId]);
            }
        }
    }
}
