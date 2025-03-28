<?php

namespace Tests\Feature;

use App\Http\Requests\CreateQuizRequest;
use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class QuizApiTest extends TestCase
{
    use DatabaseMigrations;

    public function test_get_all_quizzes_success(): void
    {
        Quiz::factory()->create();
        $response = $this->get('/api/quizzes');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'data'])
                    ->has('data', 1, function (AssertableJson $json) {
                        $json->hasAll(['id', 'name', 'description']);
                    });
            });
    }

    public function test_get_single_quiz_success(): void
    {
        Answer::factory()->create();

        $response = $this->get('/api/quizzes/1');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'data'])
                    ->has('data', function (AssertableJson $data) {
                        $data->hasAll(['id', 'name', 'description', 'questions'])
                            ->has('questions', 1, function (AssertableJson $questions) {
                                $questions->hasAll(['id', 'question', 'hint', 'points', 'answers'])
                                    ->has('answers', 1, function (AssertableJson $answers) {
                                        $answers->hasAll(['id', 'answer', 'feedback', 'correct']);
                                    });
                            });
                    });
            });
    }

    public function test_quiz_does_not_exist(): void
    {
        Quiz::factory()->create();

        $response = $this->get('/api/quizzes/0');

        $response->assertStatus(404);
    }

    public function test_new_quiz_created_success(): void
    {
        CreateQuizRequest::create(1);

        $testData = [
            'name' => 'test',
            'description' => 'test',
        ];
        $response = $this->postJson('/api/quizzes', $testData);

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });

        $this->assertDatabaseHas('quizzes', $testData);
    }

    public function test_new_quiz_created_missing_name(): void
    {
        $testData = [
            'description' => 'test',
        ];

        $response = $this->postJson('/api/quizzes', $testData);
        $response->assertInvalid('name');
    }

    public function test_new_quiz_created_missing_description(): void
    {
        $testData = [
            'name' => 'test',
        ];

        $response = $this->postJson('/api/quizzes', $testData);
        $response->assertInvalid('description');
    }

    public function test_quiz_updated_success(): void
    {

        Quiz::factory()->create();

        $testData = [
            'name' => 'test',
            'description' => 'test',
        ];
        $response = $this->putJson('/api/quizzes/1', $testData);

        $response->assertStatus(201)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message']);
            });

        $this->assertDatabaseHas('quizzes', $testData);
    }

    public function test_edit_quiz_created_missing_name(): void
    {
        Quiz::factory()->create();

        $testData = [
            'description' => 'test',
        ];

        $response = $this->putJson('/api/quizzes/1', $testData);
        $response->assertInvalid('name');
    }

    public function test_edit_quiz_created_missing_description(): void
    {
        Quiz::factory()->create();

        $testData = [
            'name' => 'test',
        ];

        $response = $this->putJson('/api/quizzes/1', $testData);
        $response->assertInvalid('description');
    }
}
