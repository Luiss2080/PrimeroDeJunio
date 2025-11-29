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
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

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

// Rutas de dashboard
Route::get('/dashboard', function () {
    if (!session('user_id')) {
        return redirect()->route('login');
    }
    
    // Redirección según el rol del usuario
    $userRole = session('user_role');
    
    if ($userRole === 'administrador') {
        return redirect()->route('dashboard.administrador');
    } elseif ($userRole === 'operador') {
        return redirect()->route('dashboard.operador');
    } else {
        // Si no tiene un rol válido, mostrar página de redirección
        return view('dashboard.index');
    }
})->name('dashboard');

// Dashboard específico para administrador
Route::get('/dashboard/administrador', function () {
    if (!session('user_id') || session('user_role') !== 'administrador') {
        return redirect()->route('login');
    }
    return view('dashboard.administrador');
})->name('dashboard.administrador');

// Dashboard específico para operador
Route::get('/dashboard/operador', function () {
    if (!session('user_id') || session('user_role') !== 'operador') {
        return redirect()->route('login');
    }
    return view('dashboard.operador');
})->name('dashboard.operador');

// Rutas de módulos del sistema (requieren autenticación)
Route::middleware(['web', 'auth.check'])->group(function () {
    // Conductores
    Route::get('/conductores', function () {
        return view('conductores.index');
    })->name('conductores.index');
    
    // Vehículos
    Route::get('/vehiculos', function () {
        return view('vehiculos.index');
    })->name('vehiculos.index');
    
    // Viajes
    Route::get('/viajes', function () {
        return view('viajes.index');
    })->name('viajes.index');
    
    // Clientes
    Route::get('/clientes', function () {
        return view('clientes.index');
    })->name('clientes.index');
    
    // Tarifas
    Route::get('/tarifas', function () {
        return view('tarifas.index');
    })->name('tarifas.index');
    
    // Reportes
    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');
    
    // Rutas solo para administradores
    Route::middleware(['admin.check'])->group(function () {
        // Usuarios
        Route::get('/usuarios', function () {
            return view('usuarios.index');
        })->name('usuarios.index');
        
        // Configuración
        Route::get('/configuracion', function () {
            return view('configuraciones.index');
        })->name('configuraciones.index');
    });
});

// Ruta temporal para contacto
Route::get('/contact', function () {
    return redirect()->route('register.show')->with('info', '¡Completa el formulario de registro para unirte a la asociación!');
})->name('contact');
