<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test main public pages return 200
     */
    public function test_welcome_cardapio_login_pages_return_successful_response(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/cardapio')->assertStatus(200);
        $this->get('/login')->assertStatus(200);
    }
}
