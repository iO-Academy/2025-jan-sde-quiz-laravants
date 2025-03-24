<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++){
            DB::table('quizzes')->insert([
                'name' => fake()->words(1, true),
                'description' => fake()->sentence(7)
            ]);
        }
    }
}
