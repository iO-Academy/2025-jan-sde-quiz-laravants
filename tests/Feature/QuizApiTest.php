<?php

namespace Tests\Feature;

use App\Models\Quiz;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;


class QuizApiTest extends TestCase
{
    use DatabaseMigrations;
    public function testGetSingleQuizSuccess(): void
    {
       Quiz::factory()->create();
        $response = $this->get('/api/quizzes/1');

        $response->assertStatus(200)
           ->assertJson(function (AssertableJson $json){
               $json->hasAll(['message', 'data'])
                   ->has('data', function (AssertableJson $data){
                       $data->hasAll(['id', 'name', 'description']);
                   });
           });
    }
}
