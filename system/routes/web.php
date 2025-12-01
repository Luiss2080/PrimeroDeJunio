<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    // Si el usuario ya está autenticado, redirigir al dashboard correspondiente
    if (session('user_id')) {
        $userRole = session('user_role');
        
        if ($userRole === 'administrador') {
            return redirect()->route('dashboard.administrador');
        } elseif ($userRole === 'operador') {
            return redirect()->route('dashboard.operador');
        }
    }
    
    // Si no está autenticado, redirigir al login
    return redirect()->route('login');
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
    
    // Redirección directa según el rol del usuario
    $userRole = session('user_role');
    
    if ($userRole === 'administrador') {
        return redirect()->route('dashboard.administrador');
    } elseif ($userRole === 'operador') {
        return redirect()->route('dashboard.operador');
    } else {
        // Si no tiene un rol válido, cerrar sesión y redirigir al login
        session()->flush();
        return redirect()->route('login')->withErrors(['error' => 'Rol de usuario no válido. Por favor, contacta al administrador.']);
    }
})->name('dashboard');

// Dashboard específico para administrador
Route::get('/dashboard/administrador', function () {
    return view('dashboard.administrador');
})->middleware(['web', 'auth.check', 'admin.check'])->name('dashboard.administrador');

// Dashboard específico para operador  
Route::get('/dashboard/operador', function () {
    return view('dashboard.operador');
})->middleware(['web', 'auth.check'])->name('dashboard.operador');

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
    
    // Pagos
    Route::get('/pagos', function () {
        return view('pagos.index');
    })->name('pagos.index');
    
    // Reportes
    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');

    Route::get('/reportes/conductores', function () {
        return view('reportes.conductores');
    })->name('reportes.conductores');

    Route::get('/reportes/viajes', function () {
        return view('reportes.viajes');
    })->name('reportes.viajes');

    Route::get('/reportes/ingresos', function () {
        return view('reportes.index'); // Fallback to index as ingresos view doesn't exist yet
    })->name('reportes.ingresos');
    
    // Rutas solo para administradores
    Route::middleware(['admin.check'])->group(function () {
        // Permisos
        Route::get('/permisos', function () {
            return view('permisos.index');
        })->name('permisos.index');

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
