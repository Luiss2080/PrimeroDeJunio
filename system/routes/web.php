<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ChalecoController;

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
    // Conductores
    Route::get('/conductores', [ConductorController::class, 'index'])->name('conductores.index');
    Route::get('/conductores/crear', [ConductorController::class, 'create'])->name('conductores.create');
    Route::post('/conductores', [ConductorController::class, 'store'])->name('conductores.store');
    Route::get('/conductores/{id}', [ConductorController::class, 'show'])->name('conductores.show');
    Route::get('/conductores/{id}/editar', [ConductorController::class, 'edit'])->name('conductores.edit');
    Route::put('/conductores/{id}', [ConductorController::class, 'update'])->name('conductores.update');
    Route::delete('/conductores/{id}', [ConductorController::class, 'destroy'])->name('conductores.destroy');
    
    // Chalecos
    Route::get('/chalecos', [ChalecoController::class, 'index'])->name('chalecos.index');
    Route::get('/chalecos/crear', [ChalecoController::class, 'create'])->name('chalecos.create');
    Route::post('/chalecos', [ChalecoController::class, 'store'])->name('chalecos.store');
    Route::get('/chalecos/{chaleco}', [ChalecoController::class, 'show'])->name('chalecos.show');
    Route::get('/chalecos/{chaleco}/editar', [ChalecoController::class, 'edit'])->name('chalecos.edit');
    Route::put('/chalecos/{chaleco}', [ChalecoController::class, 'update'])->name('chalecos.update');
    Route::delete('/chalecos/{chaleco}', [ChalecoController::class, 'destroy'])->name('chalecos.destroy');
    Route::post('/chalecos/asignar', [ChalecoController::class, 'asignar'])->name('chalecos.asignar');
    Route::post('/chalecos/{chaleco}/liberar', [ChalecoController::class, 'liberar'])->name('chalecos.liberar');
    Route::get('/api/chalecos/disponibles', [ChalecoController::class, 'disponibles'])->name('api.chalecos.disponibles');
    
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
        Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/crear', [App\Http\Controllers\UserController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('usuarios.show');
        Route::get('/usuarios/{user}/editar', [App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('usuarios.destroy');
        
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
