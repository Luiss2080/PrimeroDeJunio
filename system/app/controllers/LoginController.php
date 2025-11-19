<?php

/**
 * Controlador de Autenticación
 * Sistema PRIMERO DE JUNIO
 * Maneja login, logout y rutas de dashboards basadas en roles
 */
class LoginController extends Controller
{
    protected $usuario;

    public function __construct()
    {
        parent::__construct();
        $this->usuario = new Usuario();
    }

    /**
     * Mostrar formulario de login
     */
    public function index()
    {
        // Si ya está autenticado, redirigir al dashboard correspondiente
        if (Auth::check()) {
            $this->redirigirSegunRol();
            return;
        }

        $this->view('auth/login', [
            'titulo' => 'Iniciar Sesión - Sistema Primero de Junio'
        ]);
    }

    /**
     * Procesar login
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
            return;
        }

        try {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Validaciones básicas
            if (empty($email) || empty($password)) {
                throw new Exception('Todos los campos son obligatorios');
            }

            // Validar formato de email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Por favor ingrese un email válido');
            }

            // Intentar autenticación
            $resultado = Auth::login($email, $password);
            
            if (!$resultado) {
                throw new Exception('Email o contraseña incorrectos');
            }

            // Login exitoso - verificar estado del usuario
            $usuarioData = Auth::user();
            
            if ($usuarioData['estado'] !== 'activo') {
                Auth::logout();
                throw new Exception('Usuario inactivo. Contacte al administrador');
            }

            // Registrar el acceso exitoso
            $this->registrarAccesoExitoso($usuarioData['id']);

            // Redirigir según el rol
            $this->redirigirSegunRol();

        } catch (Exception $e) {
            // Registrar intento fallido
            $this->registrarIntentoFallido($email ?? 'desconocido', $e->getMessage());
            
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/login');
        }
    }

    /**
     * Procesar logout
     */
    public function logout()
    {
        try {
            $usuario = Auth::user();
            
            if ($usuario) {
                $this->registrarLogout($usuario['id']);
            }

            Auth::logout();
            $this->setFlash('success', 'Sesión cerrada correctamente');
            
        } catch (Exception $e) {
            $this->setFlash('error', 'Error al cerrar sesión');
        }

        $this->redirect('/login');
    }

    /**
     * Redirigir al usuario según su rol
     */
    private function redirigirSegunRol()
    {
        try {
            $usuario = Auth::user();
            
            if (!$usuario) {
                $this->redirect('/login');
                return;
            }

            $dashboardUrl = Auth::getDashboardUrl();
            
            // Configurar mensaje de bienvenida personalizado
            $this->configurarMensajeBienvenida($usuario);
            
            $this->redirect($dashboardUrl);

        } catch (Exception $e) {
            $this->setFlash('error', 'Error al determinar el dashboard: ' . $e->getMessage());
            $this->redirect('/login');
        }
    }

    /**
     * Configurar mensaje de bienvenida personalizado
     */
    private function configurarMensajeBienvenida($usuario)
    {
        $nombre = $usuario['nombre'] ?? 'Usuario';
        $rol = ucfirst($usuario['rol'] ?? 'usuario');
        $horaActual = date('H');

        // Saludo según la hora
        $saludo = 'Buenos días';
        if ($horaActual >= 12 && $horaActual < 18) {
            $saludo = 'Buenas tardes';
        } elseif ($horaActual >= 18) {
            $saludo = 'Buenas noches';
        }

        // Mensaje personalizado según el rol
        switch ($usuario['rol']) {
            case 'admin':
                $mensaje = "$saludo, $nombre. Bienvenido al panel de administración.";
                $submensaje = "Tienes acceso completo a todas las funcionalidades del sistema.";
                break;
            
            case 'operador':
                $mensaje = "$saludo, $nombre. Bienvenido al panel operativo.";
                $submensaje = "Gestiona conductores, vehículos, viajes y operaciones diarias.";
                break;
            
            case 'conductor':
                $mensaje = "$saludo, $nombre. Bienvenido a tu panel de conductor.";
                $submensaje = "Administra tus viajes y revisa tu información.";
                break;
            
            default:
                $mensaje = "$saludo, $nombre. Bienvenido al sistema.";
                $submensaje = "";
        }

        // Agregar información adicional de sesión
        $_SESSION['mensaje_bienvenida'] = $mensaje;
        $_SESSION['submensaje_bienvenida'] = $submensaje;
        $_SESSION['ultimo_acceso'] = $usuario['ultimo_acceso'] ?? null;
        
        $this->setFlash('success', $mensaje);
    }

    /**
     * Página de recuperación de contraseña
     */
    public function recuperar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarRecuperacion();
            return;
        }

        $this->view('auth/recuperar', [
            'titulo' => 'Recuperar Contraseña'
        ]);
    }

    /**
     * Procesar solicitud de recuperación
     */
    private function procesarRecuperacion()
    {
        try {
            $email = trim($_POST['email'] ?? '');
            $usuario = trim($_POST['usuario'] ?? '');

            if (empty($email) && empty($usuario)) {
                throw new Exception('Debe proporcionar email o nombre de usuario');
            }

            // Buscar usuario
            $usuarioData = null;
            if (!empty($email)) {
                $usuarioData = $this->usuario->buscarPorEmail($email);
            } elseif (!empty($usuario)) {
                $usuarioData = $this->usuario->buscarPorNombreUsuario($usuario);
            }

            if (!$usuarioData) {
                // Por seguridad, no indicamos si el usuario existe o no
                $this->setFlash('success', 'Si los datos son correctos, recibirá instrucciones por email');
                $this->redirect('/login');
                return;
            }

            // Generar token de recuperación
            $token = $this->generarTokenRecuperacion($usuarioData['id']);
            
            // Enviar email (implementar según necesidades)
            $this->enviarEmailRecuperacion($usuarioData, $token);
            
            $this->setFlash('success', 'Se han enviado las instrucciones de recuperación');
            $this->redirect('/login');

        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/recuperar');
        }
    }

    /**
     * Resetear contraseña con token
     */
    public function reset($token = null)
    {
        if (!$token) {
            $this->setFlash('error', 'Token de recuperación no válido');
            $this->redirect('/login');
            return;
        }

        // Verificar token
        $resetData = $this->verificarTokenRecuperacion($token);
        
        if (!$resetData) {
            $this->setFlash('error', 'Token expirado o no válido');
            $this->redirect('/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarResetPassword($resetData['usuario_id'], $token);
            return;
        }

        $this->view('auth/reset', [
            'token' => $token,
            'titulo' => 'Restablecer Contraseña'
        ]);
    }

    /**
     * Procesar nueva contraseña
     */
    private function procesarResetPassword($usuarioId, $token)
    {
        try {
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($password) || empty($confirmPassword)) {
                throw new Exception('Debe completar ambos campos');
            }

            if ($password !== $confirmPassword) {
                throw new Exception('Las contraseñas no coinciden');
            }

            if (strlen($password) < 6) {
                throw new Exception('La contraseña debe tener al menos 6 caracteres');
            }

            // Actualizar contraseña
            $this->usuario->actualizarPassword($usuarioId, $password);
            
            // Invalidar token
            $this->invalidarTokenRecuperacion($token);
            
            $this->setFlash('success', 'Contraseña actualizada exitosamente');
            $this->redirect('/login');

        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/reset/' . $token);
        }
    }

    /**
     * Verificar estado de sesión (AJAX)
     */
    public function verificarSesion()
    {
        $activa = Auth::check();
        $usuario = $activa ? Auth::user() : null;

        $this->jsonResponse([
            'sesion_activa' => $activa,
            'usuario' => $usuario ? [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['rol'],
                'tiempo_restante' => $this->obtenerTiempoRestanteSesion()
            ] : null
        ]);
    }

    /**
     * Extender sesión (AJAX)
     */
    public function extenderSesion()
    {
        if (!Auth::check()) {
            $this->jsonResponse(['error' => 'Sesión no activa'], 401);
            return;
        }

        try {
            // Extender tiempo de sesión
            $_SESSION['ultima_actividad'] = time();
            
            $this->jsonResponse([
                'success' => true,
                'tiempo_restante' => $this->obtenerTiempoRestanteSesion(),
                'mensaje' => 'Sesión extendida'
            ]);

        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Cambiar contraseña desde el dashboard
     */
    public function cambiarPassword()
    {
        Auth::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $passwordActual = $_POST['password_actual'] ?? '';
                $passwordNuevo = $_POST['password_nuevo'] ?? '';
                $confirmarPassword = $_POST['confirmar_password'] ?? '';

                // Validaciones
                if (empty($passwordActual) || empty($passwordNuevo) || empty($confirmarPassword)) {
                    throw new Exception('Todos los campos son obligatorios');
                }

                if ($passwordNuevo !== $confirmarPassword) {
                    throw new Exception('Las contraseñas nuevas no coinciden');
                }

                if (strlen($passwordNuevo) < 6) {
                    throw new Exception('La contraseña debe tener al menos 6 caracteres');
                }

                // Verificar contraseña actual
                $usuario = Auth::user();
                if (!$this->usuario->verificarPassword($usuario['id'], $passwordActual)) {
                    throw new Exception('La contraseña actual es incorrecta');
                }

                // Actualizar contraseña
                $this->usuario->actualizarPassword($usuario['id'], $passwordNuevo);
                
                $this->setFlash('success', 'Contraseña actualizada exitosamente');
                $this->redirect(Auth::getDashboardUrl());

            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
                $this->redirect('/cambiar-password');
            }
        }

        $this->view('auth/cambiar_password', [
            'titulo' => 'Cambiar Contraseña'
        ]);
    }

    /**
     * Registrar acceso exitoso
     */
    private function registrarAccesoExitoso($usuarioId)
    {
        try {
            $datos = [
                'usuario_id' => $usuarioId,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'desconocida',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'desconocido',
                'tipo_evento' => 'login_exitoso',
                'fecha_hora' => date('Y-m-d H:i:s')
            ];

            Database::getInstance()->insert('logs_acceso', $datos);
            
        } catch (Exception $e) {
            // Fallar silenciosamente para no interrumpir el login
            error_log("Error al registrar acceso exitoso: " . $e->getMessage());
        }
    }

    /**
     * Registrar intento fallido
     */
    private function registrarIntentoFallido($usuario, $motivo)
    {
        try {
            $datos = [
                'usuario_intento' => $usuario,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'desconocida',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'desconocido',
                'tipo_evento' => 'login_fallido',
                'motivo' => $motivo,
                'fecha_hora' => date('Y-m-d H:i:s')
            ];

            Database::getInstance()->insert('logs_acceso', $datos);
            
        } catch (Exception $e) {
            error_log("Error al registrar intento fallido: " . $e->getMessage());
        }
    }

    /**
     * Registrar logout
     */
    private function registrarLogout($usuarioId)
    {
        try {
            $datos = [
                'usuario_id' => $usuarioId,
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'desconocida',
                'tipo_evento' => 'logout',
                'fecha_hora' => date('Y-m-d H:i:s')
            ];

            Database::getInstance()->insert('logs_acceso', $datos);
            
        } catch (Exception $e) {
            error_log("Error al registrar logout: " . $e->getMessage());
        }
    }

    /**
     * Generar token de recuperación
     */
    private function generarTokenRecuperacion($usuarioId)
    {
        $token = bin2hex(random_bytes(32));
        $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $datos = [
            'usuario_id' => $usuarioId,
            'token' => hash('sha256', $token),
            'expiracion' => $expiracion,
            'usado' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s')
        ];

        Database::getInstance()->insert('tokens_recuperacion', $datos);
        
        return $token;
    }

    /**
     * Verificar token de recuperación
     */
    private function verificarTokenRecuperacion($token)
    {
        $hashedToken = hash('sha256', $token);
        
        $sql = "SELECT * FROM tokens_recuperacion 
                WHERE token = ? AND usado = 0 AND expiracion > NOW() 
                LIMIT 1";
        
        return Database::getInstance()->fetch($sql, [$hashedToken]);
    }

    /**
     * Invalidar token de recuperación
     */
    private function invalidarTokenRecuperacion($token)
    {
        $hashedToken = hash('sha256', $token);
        
        $sql = "UPDATE tokens_recuperacion SET usado = 1 WHERE token = ?";
        Database::getInstance()->execute($sql, [$hashedToken]);
    }

    /**
     * Enviar email de recuperación
     */
    private function enviarEmailRecuperacion($usuario, $token)
    {
        // Implementar envío de email según configuración
        // Por ahora solo guardar en logs para desarrollo
        $url = "http://" . $_SERVER['HTTP_HOST'] . "/reset/" . $token;
        
        $mensaje = "Enlace de recuperación: " . $url;
        
        error_log("Recuperación de contraseña para {$usuario['email']}: $mensaje");
        
        // Aquí se integraría con servicio de email (PHPMailer, etc.)
    }

    /**
     * Obtener tiempo restante de sesión en minutos
     */
    private function obtenerTiempoRestanteSesion()
    {
        $tiempoExpiracion = 30 * 60; // 30 minutos
        $ultimaActividad = $_SESSION['ultima_actividad'] ?? time();
        $tiempoTranscurrido = time() - $ultimaActividad;
        $tiempoRestante = max(0, $tiempoExpiracion - $tiempoTranscurrido);
        
        return round($tiempoRestante / 60); // Retornar en minutos
    }
}