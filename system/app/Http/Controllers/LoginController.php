<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        // Aquí iría la lógica de autenticación con la base de datos
        // Por ahora, usaremos credenciales de ejemplo
        if ($email === 'admin@asociacion.com' && $password === 'admin123') {
            Session::put('user_id', 1);
            Session::put('user_email', $email);
            Session::put('user_name', 'Administrador');
            Session::put('user_role', 'admin');

            return redirect('http://localhost/PrimeroDeJunio/system/dashboard/');
        } else {
            return back()->withErrors(['error' => 'Credenciales incorrectas. Inténtalo nuevamente.']);
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
