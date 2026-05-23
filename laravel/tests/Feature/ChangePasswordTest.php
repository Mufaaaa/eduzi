<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_change_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('passwordlama'),
        ]);

        $response = $this->actingAs($user)->post('/ganti-password', [
            'current_password' => 'passwordlama',
            'new_password' => 'passwordbaru123',
            'new_password_confirmation' => 'passwordbaru123',
        ]);

        $response->assertSessionHas('success');

        $this->assertTrue(
            Hash::check(
                'passwordbaru123',
                $user->fresh()->password
            )
        );
    }

    public function test_change_password_fails_if_current_password_is_wrong()
    {
        $user = User::factory()->create([
            'password' => Hash::make('passwordlama'),
        ]);

        $response = $this->actingAs($user)->from('/ganti-password')->post('/ganti-password', [
            'current_password' => 'salah',
            'new_password' => 'passwordbaru123',
            'new_password_confirmation' => 'passwordbaru123',
        ]);

        $response->assertRedirect('/ganti-password');

        $response->assertSessionHasErrors('current_password');
    }

    public function test_change_password_fails_if_new_password_same_as_old()
    {
        $user = User::factory()->create([
            'password' => Hash::make('passwordlama'),
        ]);

        $response = $this->actingAs($user)->from('/ganti-password')->post('/ganti-password', [
            'current_password' => 'passwordlama',
            'new_password' => 'passwordlama',
            'new_password_confirmation' => 'passwordlama',
        ]);

        $response->assertRedirect('/ganti-password');

        $response->assertSessionHasErrors('new_password');
    }

    public function test_change_password_confirmation_must_match()
    {
        $user = User::factory()->create([
            'password' => Hash::make('passwordlama'),
        ]);

        $response = $this->actingAs($user)->from('/ganti-password')->post('/ganti-password', [
            'current_password' => 'passwordlama',
            'new_password' => 'passwordbaru123',
            'new_password_confirmation' => 'beda',
        ]);

        $response->assertRedirect('/ganti-password');

        $response->assertSessionHasErrors('new_password');
    }
}