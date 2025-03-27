<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AnswerApiTest extends TestCase
{
    use DatabaseMigrations;

    public function test_new_answer_created_success(): void
    {
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

    public function test_delete_answer_success(): void
    {
        $data = Answer::factory()->create();
        $response = $this->deleteJson('/api/answers/'.$data->id);
        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });
        $this->assertDatabaseMissing('answers', [
            'id' => $data->id,
        ]);
    }

    public function test_answer_updated_success(): void
    {
        Answer::factory()->create();

        $testData = [
            'answer' => 'test',
            'correct' => 1,
        ];

        $response = $this->putJson('/api/answers/1', $testData);

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });

        $this->assertDatabaseHas('answers', $testData);
    }

    public function test_answer_updated_missing_answer(): void
    {
        Answer::factory()->create();

        $testData = [
            'correct' => 1,
        ];

        $response = $this->putJson('/api/answers/1', $testData);
        $response->assertInvalid('answer');
    }

    public function test_answer_updated_missing_correct(): void
    {
        Answer::factory()->create();

        $testData = [
            'answer' => 'test',
        ];

        $response = $this->putJson('/api/answers/1', $testData);
        $response->assertInvalid('correct');
    }
}
