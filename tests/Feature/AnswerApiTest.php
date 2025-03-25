<?php

namespace Tests\Feature;

use App\Http\Requests\CreateAnswerRequest;
use App\Models\Answer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AnswerApiTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_answer_created_success(): void
    {

        CreateAnswerRequest::create(1);
        Answer::factory()->create();

        $testData = [
            'answer' => 'test',
            'correct' => 0,
            'question_id' => 1,
        ];

        $response = $this->postJson('/api/answers', $testData);

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });

        $this->assertDatabaseHas('answers', $testData);
    }

    public function test_new_answer_created_missing_answer(): void
    {
        $testData = [
            'correct' => 0,
            'question_id' => 1,
        ];

        $response = $this->postJson('/api/answers', $testData);
        $response->assertInvalid('answer');
    }

    public function test_new_answer_created_missing_correct(): void
    {
        $testData = [
            'answer' => 'test',
            'question_id' => 1,
        ];

        $response = $this->postJson('/api/answers', $testData);
        $response->assertInvalid('correct');
    }

    public function test_new_answer_created_missing_question_id(): void
    {
        $testData = [
            'answer' => 'test',
            'correct' => 0,
        ];

        $response = $this->postJson('/api/answers', $testData);
        $response->assertInvalid('question_id');
    }
}
