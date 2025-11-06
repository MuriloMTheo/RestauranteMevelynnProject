<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompraValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_compra_validation_fails_on_missing_fields(): void
    {
        $response = $this->post('/compras', []);
        $response->assertStatus(302);
    }
}
