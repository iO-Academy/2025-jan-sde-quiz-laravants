<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class QuizApiTest extends TestCase
{
    use DatabaseMigrations;
    public function testGetSingleQuizSuccess(): void
    {
        Answer::factory()->create();

        $response = $this->get('/api/quizzes/1');

        $response->assertStatus(200)
           ->assertJson(function (AssertableJson $json){
               $json->hasAll(['message', 'data'])
                   ->has('data', function (AssertableJson $data){
                       $data->hasAll(['id', 'name', 'description', 'questions'])
                           ->has('questions', 1, function (AssertableJson $questions){
                               $questions->hasAll(['id', 'question', 'hint', 'points', 'answers'])
                                   ->has('answers', 1, function (AssertableJson $answers){
                                       $answers->hasAll(['id', 'answer', 'feedback', 'correct']);
                                   });
                           });
                   });
           });
    }
}
