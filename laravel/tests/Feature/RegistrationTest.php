<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/daftar', [
            'name' => 'Faiq',
            'email' => 'faiq@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => 'on',
        ]);

        $response->assertRedirect('/masuk');

        $this->assertDatabaseHas('users', [
            'email' => 'faiq@gmail.com',
            'name' => 'Faiq',
            'role' => 'pengguna',
        ]);
    }
}