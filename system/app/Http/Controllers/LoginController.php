<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm()
    {
        // Solo redirigir al dashboard si se solicita explícitamente no mostrar login
        $skip_login = request()->get('skip') == '1';
        if (Session::has('user_id') && $skip_login) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        $email = trim($request->email ?? '');
        $password = $request->password ?? '';

        // Validaciones básicas
        if (empty($email) || empty($password)) {
            return back()->withErrors(['error' => 'Por favor, completa todos los campos.']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors(['error' => 'Por favor, ingresa un email válido.']);
        }

        try {
            // Buscar usuario en la base de datos
            $user = DB::table('users')
                ->join('roles', 'users.rol_id', '=', 'roles.id')
                ->select('users.*', 'roles.nombre as rol_nombre')
                ->where('users.email', $email)
                ->where('users.estado', 'activo')
                ->first();

            if (!$user) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Usuario no encontrado o inactivo.']);
                }
                return back()->withErrors(['error' => 'Usuario no encontrado o inactivo.']);
            }

            // Verificar contraseña
            if (Hash::check($password, $user->password)) {
                // Login exitoso
                Session::put('user_id', $user->id);
                Session::put('user_email', $user->email);
                Session::put('user_name', $user->nombre . ' ' . $user->apellido);
                Session::put('user_role', $user->rol_nombre);
                Session::put('user_rol_id', $user->rol_id);

                // Actualizar último acceso
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['ultimo_acceso' => now()]);

                // Redirección según el rol del usuario
                $redirectRoute = 'dashboard'; // Por defecto
                
                if ($user->rol_nombre === 'administrador') {
                    $redirectRoute = 'dashboard.administrador';
                } elseif ($user->rol_nombre === 'operador') {
                    $redirectRoute = 'dashboard.operador';
                }

                if ($request->expectsJson()) {
                    return response()->json(['success' => true, 'redirect' => route($redirectRoute)]);
                }
                return redirect()->route($redirectRoute);
            } else {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Credenciales incorrectas. Inténtalo nuevamente.']);
                }
                return back()->withErrors(['error' => 'Credenciales incorrectas. Inténtalo nuevamente.']);
            }
        } catch (\Exception $e) {
            Log::error('Error en login: ' . $e->getMessage());
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Error de conexión. Intenta de nuevo.']);
            }
            return back()->withErrors(['error' => 'Error de conexión. Intenta de nuevo.']);
        }
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
