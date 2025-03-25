<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('questions')->insert([
                'question' => fake()->sentence(10),
                'hint' => fake()->sentence(5),
                'points' => fake()->numberBetween(1, 3),
                'quiz_id' => fake()->numberBetween(1, 10),
            ]);
        }
    }
}
