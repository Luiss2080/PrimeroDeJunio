<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de recuperación de contraseña
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [PasswordResetController::class, 'sendResetCode'])->name('password.email');
Route::post('/password/verify', [PasswordResetController::class, 'verifyCode'])->name('password.verify');
Route::post('/password/update', [PasswordResetController::class, 'resetPassword'])->name('password.update');
Route::post('/password/resend', [PasswordResetController::class, 'resendCode'])->name('password.resend');
