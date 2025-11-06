<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PratoValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_prato_validation_fails_on_missing_fields(): void
    {
        $response = $this->post('/pratos', []);
        // validation should redirect back (302) with errors
        $response->assertStatus(302);
    }
}
