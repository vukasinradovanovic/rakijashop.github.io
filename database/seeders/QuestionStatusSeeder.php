<?php

namespace Database\Seeders;

use App\Models\Question\QuestionStatus;
use Illuminate\Database\Seeder;

class QuestionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'new',
            'in_progress',
            'answered',
            'closed',
        ];

        foreach ($statuses as $status) {
            QuestionStatus::query()->firstOrCreate([
                'name' => $status,
            ]);
        }
    }
}
