<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Mostrar el formulario de registro
     */
    public function showRegisterForm(Request $request)
    {
        return view('auth.registro');
    }

    /**
     * Procesar el registro inicial
     */
    public function submitRegistration(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:2|max:50|regex:/^[a-zA-ZÀ-ÿ\s]+$/',
            'apellido' => 'required|string|min:2|max:50|regex:/^[a-zA-ZÀ-ÿ\s]+$/',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'pais' => 'required|string|max:10',
            'password' => 'required|string|min:8|confirmed',
            'acepta_terminos' => 'required|accepted',
            'acepta_marketing' => 'nullable|boolean'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo debe contener letras y espacios.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.regex' => 'El apellido solo debe contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'acepta_terminos.required' => 'Debes aceptar los términos y condiciones.',
            'acepta_terminos.accepted' => 'Debes aceptar los términos y condiciones.',
            'pais.required' => 'Debes seleccionar un país.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verificar si el email ya existe (simular verificación)
        $email = $request->email;
        if ($this->emailExists($email)) {
            return back()->withErrors([
                'email' => 'Este email ya está registrado. <a href="' . route('login') . '" style="color: #00ff88;">Inicia sesión aquí</a>'
            ])->withInput();
        }

        // Generar código de verificación
        $verificationCode = $this->generateVerificationCode();

        // Guardar datos temporalmente en sesión
        Session::put('registration_data', [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'pais' => $request->pais,
            'password' => Hash::make($request->password),
            'acepta_terminos' => $request->acepta_terminos,
            'acepta_marketing' => $request->acepta_marketing ?? false,
            'verification_code' => $verificationCode,
            'code_expires_at' => now()->addMinutes(10)
        ]);

        Session::put('verification_email', $request->email);

        // Simular envío de email
        $this->sendVerificationEmail($request->email, $verificationCode);

        return redirect()->route('register.show', ['step' => 'verify'])
            ->with('success', 'Te hemos enviado un código de verificación a tu email.');
    }

    /**
     * Verificar código y completar registro
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|size:6|regex:/^[0-9]+$/',
            'email' => 'required|email'
        ], [
            'code.required' => 'El código de verificación es obligatorio.',
            'code.size' => 'El código debe tener exactamente 6 dígitos.',
            'code.regex' => 'El código debe contener solo números.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $registrationData = Session::get('registration_data');

        if (!$registrationData) {
            return redirect()->route('register.show')
                ->withErrors(['general' => 'Sesión expirada. Por favor, inicia el registro nuevamente.']);
        }

        // Verificar si el código ha expirado
        if (now()->greaterThan($registrationData['code_expires_at'])) {
            return back()->withErrors([
                'code' => 'El código de verificación ha expirado. Solicita uno nuevo.'
            ])->withInput();
        }

        // Verificar el código
        if ($request->code !== $registrationData['verification_code']) {
            return back()->withErrors([
                'code' => 'El código de verificación es incorrecto.'
            ])->withInput();
        }

        // Registrar usuario (aquí iría la lógica real de base de datos)
        $this->createUser($registrationData);

        // Limpiar sesión
        Session::forget(['registration_data', 'verification_email']);

        // Crear sesión de usuario
        Session::put('user_id', 1); // ID temporal
        Session::put('user_email', $registrationData['email']);
        Session::put('user_name', $registrationData['nombre'] . ' ' . $registrationData['apellido']);

        return redirect()->route('dashboard')
            ->with('success', '¡Bienvenido a la Asociación 1ro de Junio! Tu registro se ha completado exitosamente.');
    }

    /**
     * Reenviar código de verificación
     */
    public function resendCode(Request $request)
    {
        $registrationData = Session::get('registration_data');

        if (!$registrationData) {
            return response()->json([
                'success' => false,
                'message' => 'Sesión expirada. Por favor, inicia el registro nuevamente.'
            ]);
        }

        // Generar nuevo código
        $newCode = $this->generateVerificationCode();

        // Actualizar datos en sesión
        $registrationData['verification_code'] = $newCode;
        $registrationData['code_expires_at'] = now()->addMinutes(10);
        Session::put('registration_data', $registrationData);

        // Simular reenvío de email
        $this->sendVerificationEmail($registrationData['email'], $newCode);

        return response()->json([
            'success' => true,
            'message' => 'Código reenviado exitosamente. Revisa tu email.'
        ]);
    }

    // ===== MÉTODOS AUXILIARES ===== //

    /**
     * Verificar si email existe (simulado)
     */
    private function emailExists($email)
    {
        // Lista de emails que ya "existen" para demostración
        $existingEmails = [
            'admin@asociacion.com',
            'conductor@asociacion.com',
            'test@asociacion.com'
        ];

        return in_array(strtolower($email), $existingEmails);
    }

    /**
     * Generar código de verificación
     */
    private function generateVerificationCode()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Simular envío de email de verificación
     */
    private function sendVerificationEmail($email, $code)
    {
        // En una implementación real, aquí se enviaría el email
        // Por ahora solo loggear para debugging

        Log::info("Código de verificación para {$email}: {$code}");

        return true;
    }

    /**
     * Crear usuario (simulado)
     */
    private function createUser($data)
    {
        // En una implementación real, aquí se guardaría en la base de datos
        Log::info("Usuario registrado: {$data['email']}");

        return true;
    }
}
