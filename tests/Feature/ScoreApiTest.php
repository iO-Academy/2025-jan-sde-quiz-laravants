<?php

namespace Tests\Feature;

use App\Models\Quiz;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScoreApiTest extends TestCase
{
    use DatabaseMigrations;

    public function test_scores_api_success(): void
    {
        Quiz::factory()->create();
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
