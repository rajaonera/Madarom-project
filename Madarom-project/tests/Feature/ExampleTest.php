<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {

        $data  = [

        ];
        $response = $this->post('/quote/validate_quote', $data);

        $response->assertStatus(200);
    }
}
