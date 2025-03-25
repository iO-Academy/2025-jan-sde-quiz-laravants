<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 150; $i++) {
            DB::table('answers')->insert([
                'answer' => fake()->sentence(10),
                'feedback' => fake()->sentence(2),
                'correct' => fake()->boolean(),
                'question_id' => fake()->numberBetween(1, 50),
            ]);
        }
    }
}
