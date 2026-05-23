<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'faiq@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pengguna',
        ]);

        $response = $this->post('/masuk', [
            'email' => 'faiq@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/home');

        $this->assertAuthenticated();
    }

    public function test_admin_can_login()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $response = $this->post('/masuk', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin');

        $this->assertAuthenticated();
    }

    public function test_login_fails_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'faiq@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from('/masuk')->post('/masuk', [
            'email' => 'faiq@example.com',
            'password' => 'salahpassword',
        ]);

        $response->assertRedirect('/masuk');

        $response->assertSessionHas('error');

        $this->assertGuest();
    }
}