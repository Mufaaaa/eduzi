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

Route::get('/', [IndexController::class, 'index']);

Route::get('/daftar', [RegisterController::class, 'index'])->name('register');
Route::post('/daftar', [RegisterController::class, 'store'])->name('register.store');

Route::get('/masuk', [LoginController::class, 'index'])->name('login');
Route::post('/masuk', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset.submit');

Route::view('/syarat-ketentuan', 'auth.terms')->name('terms');
Route::view('/kebijakan-privasi', 'auth.privacy')->name('privacy');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');; 
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/ganti-password', [ChangePasswordController::class, 'edit'])
        ->name('password.edit');
    Route::post('/ganti-password', [ChangePasswordController::class, 'update'])
        ->name('password.update');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/kalkulator', [KalkulatorController::class, 'index'])->name('kalkulator');
Route::post('/predict', [KalkulatorController::class, 'predict']);

Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas');
Route::post('/komunitas', [KomunitasController::class, 'store'])->name('komunitas.store');
Route::post('/komunitas/komentar', [KomunitasController::class, 'komentar'])->name('komentar.store');
Route::post('/like', [KomunitasController::class, 'like'])->name('like.store');

Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');

Route::get('/artikel-video', [ArtikelVideoController::class, 'index'])->name('artikelvideo');
Route::get('/artikel/{id}', [ArtikelVideoController::class, 'show'])->name('artikel.show');

Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
Route::get('/riwayat/export/pdf', [RiwayatController::class, 'exportPdf'])->name('riwayat.export');

Route::get('/jadwal-posyandu', [PosyanduController::class, 'index'])->name('posyandu.index');

Route::post('/deep-chat', [GeminiChatController::class, 'handle'])->withoutMiddleware(['web']);