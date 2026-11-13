<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeminiChatController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KalkulatorController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ArtikelVideoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\PemantauanController;
use App\Http\Middleware\PreventAuthPageCache;

// ======================================================
// HALAMAN UTAMA
// ======================================================

Route::get('/', [IndexController::class, 'index'])
    ->name('index');

// ======================================================
// HALAMAN GUEST (BELUM LOGIN)
// ======================================================

Route::middleware(['guest', PreventAuthPageCache::class])->group(function () {

    // Registrasi
    Route::get('/daftar', [RegisterController::class, 'index'])
        ->name('register');

    Route::post('/daftar', [RegisterController::class, 'store'])
        ->name('register.store');

    // Login biasa
    Route::get('/masuk', [LoginController::class, 'index'])
        ->name('login');

    Route::post('/masuk', [LoginController::class, 'authenticate'])
        ->name('login.authenticate');

    // Lupa password
    Route::get('/lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
        ->name('password.reset.submit');

    // Login Google
    Route::get('/auth/google', [GoogleController::class, 'redirect'])
        ->name('google.login');
});

// Callback Google harus berada di luar middleware guest
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->middleware(PreventAuthPageCache::class)
    ->name('google.callback');

// ======================================================
// HALAMAN YANG DAPAT DIAKSES TANPA LOGIN
// ======================================================

Route::view('/syarat-ketentuan', 'auth.terms')
    ->name('terms');

Route::view('/kebijakan-privasi', 'auth.privacy')
    ->name('privacy');

     // Kalkulator
    Route::get('/kalkulator', [KalkulatorController::class, 'index'])
        ->name('kalkulator');

    Route::post('/predict', [KalkulatorController::class, 'predict']);

    // Komunitas
    Route::get('/komunitas', [KomunitasController::class, 'index'])
        ->name('komunitas');

    Route::post('/komunitas', [KomunitasController::class, 'store'])
        ->name('komunitas.store');

    Route::post('/komunitas/komentar', [KomunitasController::class, 'komentar'])
        ->name('komentar.store');

    Route::post('/like', [KomunitasController::class, 'like'])
        ->name('like.store');

    // Artikel dan video
    Route::get('/artikel-video', [ArtikelVideoController::class, 'index'])
        ->name('artikelvideo');

    Route::get('/artikel/{id}', [ArtikelVideoController::class, 'show'])
        ->name('artikel.show');

    // Panduan
    Route::get('/panduan', [PanduanController::class, 'index'])
        ->name('panduan');

// ======================================================
// HALAMAN PENGGUNA YANG SUDAH LOGIN
// ======================================================

Route::middleware(['auth', PreventAuthPageCache::class])->group(function () {

    // Home
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.edit');

    Route::post('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Ganti password
    Route::get('/ganti-password', [ChangePasswordController::class, 'edit'])
        ->name('password.edit');

    Route::post('/ganti-password', [ChangePasswordController::class, 'update'])
        ->name('password.update');

    // Pemantauan anak
    Route::get('/pemantauan', [PemantauanController::class, 'index'])
        ->name('pemantauan');

    // Grafik perkembangan gizi
    Route::get('/pemantauan/grafik', [PemantauanController::class, 'grafik'])
        ->name('grafik.perkembangan');

    // Riwayat
    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('riwayat');

    Route::get('/riwayat/export/pdf', [RiwayatController::class, 'exportPdf'])
        ->name('riwayat.export');

    // Jadwal Posyandu
    Route::get('/jadwal-posyandu', [PosyanduController::class, 'index'])
        ->name('posyandu.index');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});

// ======================================================
// GEMINI CHAT
// ======================================================
Route::post('/deep-chat', [GeminiChatController::class, 'handle'])
    ->name('deep-chat');
