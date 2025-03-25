<?php

namespace Tests\Feature;

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
}
