<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Two\AbstractProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class GoogleLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Membuat mock provider Socialite.
     */
    private function mockGoogleUser(
        string $id = 'google123',
        string $name = 'Faiq Google',
        string $email = 'google@example.com'
    ): void {
        $abstractUser = Mockery::mock(SocialiteUser::class);

        $abstractUser->shouldReceive('getId')
            ->andReturn($id);

        $abstractUser->shouldReceive('getName')
            ->andReturn($name);

        $abstractUser->shouldReceive('getEmail')
            ->andReturn($email);

        $abstractUser->shouldReceive('getAvatar')
            ->andReturn('https://avatar.test/photo.jpg');

        $provider = Mockery::mock(AbstractProvider::class);

        // Controller memanggil redirectUrl() sebelum user().
        $provider->shouldReceive('redirectUrl')
            ->once()
            ->andReturnSelf();

        $provider->shouldReceive('user')
            ->once()
            ->andReturn($abstractUser);

        Socialite::shouldReceive('driver')
            ->with('google')
            ->once()
            ->andReturn($provider);
    }

    public function test_google_redirect()
    {
        $response = $this->get('/auth/google');

        $response->assertRedirect();
    }

    public function test_user_can_login_with_google()
    {
        $this->mockGoogleUser();

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users', [
            'email' => 'google@example.com',
            'google_id' => 'google123',
            'name' => 'Faiq Google',
            'role' => 'pengguna',
        ]);

        $this->assertAuthenticated();

        $this->assertEquals(
            'google@example.com',
            auth()->user()->email
        );
    }

    public function test_existing_user_can_login_with_google()
    {
        $user = User::factory()->create([
            'name' => 'Old User',
            'email' => 'google@example.com',
            'role' => 'pengguna',
            'google_id' => null,
        ]);

        $this->mockGoogleUser(
            'google123',
            'Updated Google User',
            'google@example.com'
        );

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect('/home');

        $user->refresh();

        $this->assertEquals('google123', $user->google_id);

        $this->assertEquals(
            'Updated Google User',
            $user->name
        );

        $this->assertEquals(
            'https://avatar.test/photo.jpg',
            $user->avatar
        );

        $this->assertAuthenticatedAs($user);
    }
}
