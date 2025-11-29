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
        // Si ya está logueado y no se fuerza el login, redirigir al dashboard
        $force_login = request()->get('force') == '1';
        if (Session::has('user_id') && !$force_login) {
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

                return redirect()->route('dashboard');
            } else {
                return back()->withErrors(['error' => 'Credenciales incorrectas. Inténtalo nuevamente.']);
            }
        } catch (\Exception $e) {
            Log::error('Error en login: ' . $e->getMessage());
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
