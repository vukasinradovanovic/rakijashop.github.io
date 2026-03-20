<?php

namespace Database\Seeders;

use App\Models\Question\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Opste pitanje',
            'Porudzbina',
            'Saradnja',
            'Reklamacija',
            'Dostava',
        ];

        foreach ($types as $type) {
            QuestionType::query()->firstOrCreate(
                ['name' => $type],
                ['is_active' => true]
            );
        }
    }
}
