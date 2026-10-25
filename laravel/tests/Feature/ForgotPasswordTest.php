<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menonaktifkan middleware CSRF selama pengujian.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        ]);
    }

    /**
     * Halaman lupa password dapat dibuka.
     */
    public function test_halaman_lupa_password_dapat_dibuka(): void
    {
        $response = $this->get(route('password.request'));

        $response->assertOk();
        $response->assertSee('Lupa Password');
        $response->assertSee('Masukkan email akun Anda.');
        $response->assertSee('Kirim Link Reset Password');
    }

    /**
     * Email dengan format tidak valid ditolak.
     */
    public function test_email_tidak_valid_ditolak(): void
    {
        $response = $this->from('/lupa-password')
            ->post(route('password.email'), [
                'email' => 'bukan-email',
            ]);

        $response->assertRedirect('/lupa-password');
        $response->assertSessionHasErrors('email');
    }

    /**
     * Email yang tidak terdaftar ditolak.
     */
    public function test_email_yang_tidak_terdaftar_ditolak(): void
    {
        $response = $this->from('/lupa-password')
            ->post(route('password.email'), [
                'email' => 'tidakterdaftar@example.com',
            ]);

        $response->assertRedirect('/lupa-password');
        $response->assertSessionHasErrors('email');
    }

    /**
     * Halaman reset password dapat dibuka menggunakan token.
     */
    public function test_halaman_reset_password_dapat_dibuka(): void
    {
        $user = User::factory()->create([
            'email' => 'faiq@example.com',
        ]);

        $token = Password::createToken($user);

        $response = $this->get(
            route('password.reset', ['token' => $token])
            . '?email=' . urlencode($user->email)
        );

        $response->assertOk();
        $response->assertViewIs('auth.reset-password');
        $response->assertViewHas('token', $token);
        $response->assertViewHas('email', $user->email);
    }

    /**
     * Token reset password yang tidak valid ditolak.
     */
    public function test_reset_password_dengan_token_tidak_valid_ditolak(): void
    {
        $user = User::factory()->create([
            'email' => 'faiq@example.com',
            'password' => Hash::make('PasswordLama123!'),
        ]);

        $response = $this->from(
            route('password.reset', ['token' => 'token-salah'])
            . '?email=' . urlencode($user->email)
        )->post(route('password.reset.submit'), [
            'token' => 'token-salah',
            'email' => $user->email,
            'password' => 'PasswordBaru123!',
            'password_confirmation' => 'PasswordBaru123!',
        ]);

        $response->assertRedirect();

        $response->assertSessionHasErrors('email');

        $this->assertTrue(
            Hash::check(
                'PasswordLama123!',
                $user->fresh()->password
            )
        );
    }

    /**
     * Reset password membutuhkan email.
     */
    public function test_reset_password_membutuhkan_email(): void
    {
        $response = $this->from('/reset-password/token-pengujian')
            ->post(route('password.reset.submit'), [
                'token' => 'token-pengujian',
                'email' => '',
                'password' => 'PasswordBaru123!',
                'password_confirmation' => 'PasswordBaru123!',
            ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
    }

    /**
     * Konfirmasi password harus sama dengan password baru.
     */
    public function test_konfirmasi_password_harus_sama(): void
    {
        $user = User::factory()->create([
            'email' => 'faiq@example.com',
        ]);

        $response = $this->from('/reset-password/token-pengujian')
            ->post(route('password.reset.submit'), [
                'token' => 'token-pengujian',
                'email' => $user->email,
                'password' => 'PasswordBaru123!',
                'password_confirmation' => 'PasswordBerbeda123!',
            ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('password');
    }

    /**
     * Pengguna dapat mereset password dengan token valid.
     */
    public function test_pengguna_dapat_mereset_password_dengan_token_valid(): void
    {
        $user = User::factory()->create([
            'email' => 'faiq@example.com',
            'password' => Hash::make('PasswordLama123!'),
        ]);

        $token = Password::createToken($user);

        $response = $this->post(route('password.reset.submit'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'PasswordBaru123!',
            'password_confirmation' => 'PasswordBaru123!',
        ]);

        $response->assertRedirect('/masuk');

        $response->assertSessionHas(
            'success',
            'Password berhasil diubah. Silakan login.'
        );

        $user->refresh();

        $this->assertTrue(
            Hash::check('PasswordBaru123!', $user->password)
        );

        $this->assertFalse(
            Hash::check('PasswordLama123!', $user->password)
        );

        $this->assertNotEmpty($user->remember_token);
    }
}
