<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PasswordResetController extends Controller
{
    /**
     * Mostrar formulario de recuperación (paso 1: email)
     */
    public function showResetForm()
    {
        return view('auth.recuperar')->with('step', 'email');
    }

    /**
     * Procesar solicitud de recuperación por email
     */
    public function sendResetCode(Request $request)
    {
        $email = trim($request->email ?? '');

        // Validaciones básicas
        if (empty($email)) {
            return back()->withErrors(['error' => 'Por favor, ingresa tu correo electrónico.']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors(['error' => 'Por favor, ingresa un email válido.']);
        }

        // Verificar si el email existe (simulación)
        if ($email === 'admin@asociacion.com') {
            Session::put('recovery_email', $email);
            Session::put('recovery_code', '123456'); // En producción, generar código aleatorio

            return view('auth.recuperar')
                ->with('step', 'code')
                ->with('success', 'Se ha enviado un código de verificación a tu correo electrónico.');
        } else {
            return back()->withErrors(['error' => 'No se encontró una cuenta asociada a este correo electrónico.']);
        }
    }

    /**
     * Verificar código de recuperación (paso 2)
     */
    public function verifyCode(Request $request)
    {
        $code = trim($request->code ?? '');
        $storedCode = Session::get('recovery_code');

        if (empty($code)) {
            return back()->withErrors(['error' => 'Por favor, ingresa el código de verificación.']);
        }

        if ($code !== $storedCode) {
            return back()->withErrors(['error' => 'El código ingresado es incorrecto. Inténtalo nuevamente.']);
        }

        Session::put('recovery_code_verified', true);

        return view('auth.recuperar')
            ->with('step', 'password')
            ->with('success', 'Código verificado correctamente. Ahora puedes establecer tu nueva contraseña.');
    }

    /**
     * Establecer nueva contraseña (paso 3)
     */
    public function resetPassword(Request $request)
    {
        $password = $request->password ?? '';
        $confirmPassword = $request->confirm_password ?? '';

        if (empty($password) || empty($confirmPassword)) {
            return back()->withErrors(['error' => 'Por favor, completa todos los campos de contraseña.']);
        }

        if (strlen($password) < 6) {
            return back()->withErrors(['error' => 'La contraseña debe tener al menos 6 caracteres.']);
        }

        if ($password !== $confirmPassword) {
            return back()->withErrors(['error' => 'Las contraseñas no coinciden.']);
        }

        // En producción, aquí se actualizaría la contraseña en la base de datos

        // Limpiar sesión
        Session::forget(['recovery_email', 'recovery_code', 'recovery_code_verified']);

        return view('auth.recuperar')
            ->with('step', 'success')
            ->with('success', '¡Contraseña actualizada correctamente! Ya puedes iniciar sesión con tu nueva contraseña.');
    }

    /**
     * Reenviar código de verificación
     */
    public function resendCode()
    {
        $email = Session::get('recovery_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        // Simular reenvío de código
        Session::put('recovery_code', '123456'); // En producción, generar nuevo código

        return back()->with('success', 'Se ha reenviado el código de verificación a tu correo electrónico.');
    }
}
