<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        // Jika pengguna sudah login, jangan tampilkan halaman login.
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            return $user->role === 'admin'
                ? redirect('/admin')
                : redirect('/home');
        }

        return response()
            ->view('auth.login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    /**
     * Proses autentikasi login biasa.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {

            // Regenerasi session untuk keamanan.
            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            // Redirect berdasarkan role.
            if ($user->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/home');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        // Logout pengguna.
        Auth::guard('web')->logout();

        // Hapus session lama.
        $request->session()->invalidate();

        // Regenerasi CSRF token.
        $request->session()->regenerateToken();

        return redirect('/masuk')
            ->with('success', 'Berhasil logout.');
    }
}
