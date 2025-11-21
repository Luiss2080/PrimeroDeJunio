<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta temporal para password reset (implementar después)
Route::get('/password/reset', function () {
    return redirect('/login')->with('info', 'Función de recuperación de contraseña en desarrollo');
})->name('password.request');
