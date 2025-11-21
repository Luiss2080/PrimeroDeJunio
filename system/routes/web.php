<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [RegisterController::class, 'submitRegistration'])->name('register.submit');
Route::post('/register/verify', [RegisterController::class, 'verifyCode'])->name('register.verify');
Route::post('/register/resend', [RegisterController::class, 'resendCode'])->name('register.resend');

// Rutas de recuperación de contraseña
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [PasswordResetController::class, 'sendResetCode'])->name('password.email');
Route::post('/password/verify', [PasswordResetController::class, 'verifyCode'])->name('password.verify');
Route::post('/password/update', [PasswordResetController::class, 'resetPassword'])->name('password.update');
Route::post('/password/resend', [PasswordResetController::class, 'resendCode'])->name('password.resend');

// Ruta temporal para dashboard
Route::get('/dashboard', function () {
    if (!session('user_id')) {
        return redirect()->route('login');
    }
    return view('dashboard.index');
})->name('dashboard');

// Ruta temporal para contacto
Route::get('/contact', function () {
    return redirect()->route('register.show')->with('info', '¡Completa el formulario de registro para unirte a la asociación!');
})->name('contact');
