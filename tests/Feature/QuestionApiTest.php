<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class QuestionApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     */
    public function test_add_new_question_success(): void
    {
        $response = $this->postJson('/api/questions', [
            'question' => 'Will this request work?',
            'hint' => "Let's see",
            'points' => 2,
            'quiz_id' => 2,
        ]);
        $response->assertValid(['message']);
    }

    public function test_add_new_question_fail(): void
    {
        $response = $this->postJson('/api/questions', [
            'question' => null,
            'hint' => null,
            'points' => null,
            'quiz_id' => null,
        ]);
        $response->assertValid(['message', 'errors']);
    }
}
