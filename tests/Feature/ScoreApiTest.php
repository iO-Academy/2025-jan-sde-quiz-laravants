<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ScoreApiTest extends TestCase
{
    use DatabaseMigrations;

    public function test_scores_api_success(): void
    {
        $quiz = Quiz::factory()->create();

        $question1 = Question::factory()->create(['quiz_id' => $quiz->id, 'points' => 1]);
        $q1answer1 = Answer::factory()->create(['question_id' => $question1->id, 'correct' => 1]);
        $q1answer2 = Answer::factory()->create(['question_id' => $question1->id, 'correct' => 0]);

        $question2 = Question::factory()->create(['quiz_id' => $quiz->id, 'points' => 4]);
        $q2answer1 = Answer::factory()->create(['question_id' => $question2->id, 'correct' => 1]);
        $q2answer2 = Answer::factory()->create(['question_id' => $question2->id, 'correct' => 0]);

        $response = $this->post('/api/scores', [
            'quiz' => $quiz->id,
            'answers' => [
                [
                    'question' => (string) $question1->id,
                    'answer' => $q1answer1->id,
                ],
                [
                    'question' => (string) $question2->id,
                    'answer' => $q2answer2->id,
                ],
            ],
        ]);

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'data'])
                    ->has('data', function (AssertableJson $data) {
                        $data->hasAll(['points', 'available_points', 'question_count', 'correct_count'])
                            ->where('points', 1)
                            ->where('available_points', 5)
                            ->where('question_count', 2)
                            ->where('correct_count', 1);
                    });
            });
    }

    public function test_scores_api_invalid_quiz(): void
    {
        $quiz = Quiz::factory()->create();

        $testData = [
            'answers' => [
                [
                    'question' => '1',
                    'answer' => 1,
                ],
                [
                    'question' => '2',
                    'answer' => 2,
                ],
            ],
        ];

        $response = $this->postJson('/api/scores', $testData);
        $response->assertInvalid('quiz');
    }

    public function test_scores_api_invalid_answers(): void
    {
        $quiz = Quiz::factory()->create();

        $testData = [
            'quiz' => 1,
        ];

        $response = $this->postJson('/api/scores', $testData);
        $response->assertInvalid('answers');
    }
}
