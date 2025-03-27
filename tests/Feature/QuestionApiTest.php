<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class QuestionApiTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     */
    public function test_add_new_question_success(): void
    {
        $quiz = Quiz::factory()->create();

        $data = ['question' => 'Will this request work?',
            'hint' => "Let's see",
            'points' => 2,
            'quiz_id' => $quiz->id];

        $response = $this->postJson('/api/questions', $data);
        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });
        $this->assertDatabaseHas('questions', $data);
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

    public function test_delete_question_success(): void
    {
        $data = Question::factory()->create();
        $response = $this->deleteJson('/api/questions/'.$data->id);
        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });
        $this->assertDatabaseMissing('questions', [
            'id' => $data->id,
        ]);
    }

    public function test_question_edited_success(): void
    {
        Question::factory()->create();

        $testData = [
            'question' => 'test',
            'points' => 1,
            'hint' => 'test',
        ];
        $response = $this->putJson('/api/questions/1', $testData);

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });

        $this->assertDatabaseHas('questions', $testData);
    }

    public function test_edit_question_missing_question(): void
    {
        Question::factory()->create();

        $testData = [
            'points' => 1,
            'hint' => 'test',
        ];

        $response = $this->putJson('/api/questions/1', $testData);
        $response->assertInvalid('question');
    }

    public function test_edit_question_missing_points(): void
    {
        Question::factory()->create();

        $testData = [
            'question' => 'test',
            'hint' => 'test',
        ];

        $response = $this->putJson('/api/questions/1', $testData);
        $response->assertInvalid('points');
    }

}
