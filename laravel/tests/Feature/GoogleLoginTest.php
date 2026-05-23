<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class GoogleLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_redirect()
    {
        $response = $this->get('/auth/google');

        $response->assertRedirect();
    }

    public function test_user_can_login_with_google()
    {
        $abstractUser = Mockery::mock(SocialiteUser::class);

        $abstractUser->shouldReceive('getId')
            ->andReturn('google123');

        $abstractUser->shouldReceive('getName')
            ->andReturn('Faiq Google');

        $abstractUser->shouldReceive('getEmail')
            ->andReturn('google@example.com');

        $abstractUser->shouldReceive('getAvatar')
            ->andReturn('https://avatar.test/photo.jpg');

        Socialite::shouldReceive('driver->user')
            ->andReturn($abstractUser);

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users', [
            'email' => 'google@example.com',
            'google_id' => 'google123',
        ]);
    }

    public function test_existing_user_can_login_with_google()
    {
        $user = User::factory()->create([
            'email' => 'google@example.com',
            'role' => 'pengguna',
        ]);

        $abstractUser = Mockery::mock(SocialiteUser::class);

        $abstractUser->shouldReceive('getId')
            ->andReturn('google123');

        $abstractUser->shouldReceive('getName')
            ->andReturn('Updated Google User');

        $abstractUser->shouldReceive('getEmail')
            ->andReturn('google@example.com');

        $abstractUser->shouldReceive('getAvatar')
            ->andReturn('https://avatar.test/photo.jpg');

        Socialite::shouldReceive('driver->user')
            ->andReturn($abstractUser);

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect('/home');

        $user->refresh();

        $this->assertEquals('google123', $user->google_id);
    }
}