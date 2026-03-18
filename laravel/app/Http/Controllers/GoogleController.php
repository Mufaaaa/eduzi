<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with([
                'prompt' => 'select_account',
            ])
            ->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'name'      => $googleUser->getName() ?? $user->name,
                    'avatar'    => $googleUser->getAvatar(),
                ]);
            } else {
                $user = User::create([
                    'name'      => $googleUser->getName() ?? 'User Google',
                    'email'     => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                    'password'  => bcrypt(Str::random(16)),
                    'role'      => 'pengguna',
                ]);
            }

            // bersihkan sesi lama, termasuk sesi dari Filament
            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            // login ulang user google
            Auth::guard('web')->login($user, true);
            request()->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/home');
        } catch (Exception $e) {
            return redirect('/masuk')->with('error', 'Login dengan Google gagal.');
        }
    }
}