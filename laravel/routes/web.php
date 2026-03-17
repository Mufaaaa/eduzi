<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeminiChatController;

Route::get('/', [IndexController::class, 'index']);

Route::get('/daftar', [RegisterController::class, 'index'])->name('register');
Route::post('/daftar', [RegisterController::class, 'store'])->name('register.store');

Route::get('/masuk', [LoginController::class, 'index'])->name('login');
Route::post('/masuk', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::view('/syarat-ketentuan', 'auth.terms')->name('terms');
Route::view('/kebijakan-privasi', 'auth.privacy')->name('privacy');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');; 
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::post('/deep-chat', [GeminiChatController::class, 'handle'])->withoutMiddleware(['web']);