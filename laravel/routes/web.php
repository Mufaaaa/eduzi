<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', [IndexController::class, 'index']);

Route::get('/masuk', [LoginController::class, 'index'])->name('login');
Route::get('/daftar', [RegisterController::class, 'index'])->name('register');

Route::view('/syarat-ketentuan', 'auth.terms')->name('terms');
Route::view('//kebijakan-privasi', 'auth.privacy')->name('privacy');