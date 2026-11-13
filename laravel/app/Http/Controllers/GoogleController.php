<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect ke halaman autentikasi Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')
            ->with([
                'prompt' => 'select_account',
            ])
            ->redirect();
    }

    /**
     * Callback setelah autentikasi Google berhasil.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari pengguna berdasarkan Google ID atau email.
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {

                // Perbarui data pengguna yang sudah terdaftar.
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'name' => $googleUser->getName() ?? $user->name,
                    'avatar' => $googleUser->getAvatar(),
                ]);

            } else {

                // Buat akun baru jika belum terdaftar.
                $user = User::create([
                    'name' => $googleUser->getName() ?? 'User Google',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(16)),
                    'role' => 'pengguna',
                ]);
            }

            // Bersihkan autentikasi sebelumnya.
            Auth::guard('web')->logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();

            // Login menggunakan akun Google.
            Auth::guard('web')->login($user, true);

            // Regenerasi session setelah login.
            request()->session()->regenerate();

            // Redirect berdasarkan role pengguna.
            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/home');

        } catch (Exception $e) {

            report($e);

            return redirect('/masuk')
                ->with('error', 'Login dengan Google gagal.');
        }
    }
}
