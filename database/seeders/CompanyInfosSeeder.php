<?php

namespace Database\Seeders;

use App\Models\Company\CompanyInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyInfosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyInfo::create([
            'name' => 'rakijashop',
            'company' => NULL,
            'email_1' => 'rakijashop@example.com',
            'email_2' => NULL,
            'phone_1' => '+381600000000',
            'phone_2' => '+381600000001',
            'address' => NULL,
            'zip_code' => NULL,
            'city_sr' => NULL,
            'city_en' => NULL,
            'country_sr' => NULL,
            'country_en' => NULL,
            'website' => NULL,
            'tax_no' => NULL,
            'company_no' => NULL,
        ]);
    }
}
