<?php

/**
 * Clase Auth - Manejo de autenticación y autorización
 * Sistema PRIMERO DE JUNIO
 */
class Auth
{
    private static $usuario = null;
    private static $permisos = [];

    /**
     * Iniciar sesión
     */
    public static function login($email, $password)
    {
        $usuario = new Usuario();
        $user = $usuario->buscarPorEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['estado'] !== 'activo') {
                throw new Exception('Usuario inactivo o pendiente de aprobación');
            }

            // Iniciar sesión
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_rol_id'] = $user['rol_id'];

            // Actualizar último acceso
            $usuario->actualizarUltimoAcceso($user['id']);

            // Cargar usuario completo con rol
            self::loadUser();

            return true;
        }

        return false;
    }

    /**
     * Cerrar sesión
     */
    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        self::$usuario = null;
        self::$permisos = [];

        session_unset();
        session_destroy();

        return true;
    }

    /**
     * Verificar si el usuario está autenticado
     */
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    /**
     * Obtener usuario actual
     */
    public static function user()
    {
        if (!self::check()) {
            return null;
        }

        if (self::$usuario === null) {
            self::loadUser();
        }

        return self::$usuario;
    }

    /**
     * Obtener ID del usuario actual
     */
    public static function id()
    {
        $user = self::user();
        return $user ? $user['id'] : null;
    }

    /**
     * Verificar si tiene un permiso específico
     */
    public static function hasPermission($permiso)
    {
        if (!self::check()) {
            return false;
        }

        $usuario = self::user();
        if (!$usuario) {
            return false;
        }

        // El administrador tiene todos los permisos
        if ($usuario['rol_nombre'] === 'administrador') {
            return true;
        }

        // Cargar permisos si no están cargados
        if (empty(self::$permisos)) {
            self::loadPermissions();
        }

        return in_array($permiso, self::$permisos);
    }

    /**
     * Verificar si tiene un rol específico
     */
    public static function hasRole($rolNombre)
    {
        $usuario = self::user();
        if (!$usuario || !isset($usuario['rol_nombre'])) {
            return false;
        }

        $rolUsuario = strtolower($usuario['rol_nombre']);
        $rolRequerido = strtolower($rolNombre);

        // Manejar equivalencias de roles
        if ($rolRequerido === 'administrador' && $rolUsuario === 'admin') {
            return true;
        }
        if ($rolRequerido === 'admin' && $rolUsuario === 'administrador') {
            return true;
        }

        return $rolUsuario === $rolRequerido;
    }

    /**
     * Verificar si es administrador
     */
    public static function isAdmin()
    {
        return self::hasRole('administrador') || self::hasRole('admin');
    }

    /**
     * Verificar si es operador
     */
    public static function isOperador()
    {
        return self::hasRole('operador');
    }

    /**
     * Verificar si es conductor
     */
    public static function isConductor()
    {
        return self::hasRole('conductor');
    }

    /**
     * Requerir autenticación
     */
    public static function requireAuth()
    {
        if (!self::check()) {
            if (self::isAjaxRequest()) {
                http_response_code(401);
                echo json_encode(['error' => 'No autenticado']);
                exit;
            } else {
                header('Location: /login');
                exit;
            }
        }
    }

    /**
     * Requerir permiso específico
     */
    public static function requirePermission($permiso)
    {
        self::requireAuth();

        if (!self::hasPermission($permiso)) {
            if (self::isAjaxRequest()) {
                http_response_code(403);
                echo json_encode(['error' => 'Sin permisos']);
                exit;
            } else {
                header('Location: /dashboard?error=sin_permisos');
                exit;
            }
        }
    }

    /**
     * Requerir rol específico
     */
    public static function requireRole($rolNombre)
    {
        self::requireAuth();

        if (!self::hasRole($rolNombre)) {
            if (self::isAjaxRequest()) {
                http_response_code(403);
                echo json_encode(['error' => 'Rol insuficiente']);
                exit;
            } else {
                header('Location: /dashboard?error=rol_insuficiente');
                exit;
            }
        }
    }

    /**
     * Generar token CSRF
     */
    public static function generateCsrfToken()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    /**
     * Verificar token CSRF
     */
    public static function verifyCsrfToken($token)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $sessionToken = $_SESSION['csrf_token'] ?? '';
        return hash_equals($sessionToken, $token);
    }

    /**
     * Intentar login con recordar sesión
     */
    public static function attempt($email, $password, $remember = false)
    {
        if (self::login($email, $password)) {
            if ($remember) {
                self::setRememberToken();
            }
            return true;
        }
        return false;
    }

    /**
     * Cargar usuario desde la base de datos
     */
    private static function loadUser()
    {
        if (!isset($_SESSION['user_id'])) {
            return;
        }

        $usuario = new Usuario();
        self::$usuario = $usuario->obtenerConRol($_SESSION['user_id']);
    }

    /**
     * Cargar permisos del usuario
     */
    private static function loadPermissions()
    {
        $usuario = self::user();
        if (!$usuario || !isset($usuario['rol_id'])) {
            return;
        }

        $db = Database::getInstance();
        $rol = $db->fetch("SELECT permisos FROM roles WHERE id = ?", [$usuario['rol_id']]);

        if ($rol && !empty($rol['permisos'])) {
            $permisos = json_decode($rol['permisos'], true);
            self::$permisos = is_array($permisos) ? $permisos : [];
        }
    }

    /**
     * Establecer token de recordar sesión
     */
    private static function setRememberToken()
    {
        $token = bin2hex(random_bytes(32));
        $userId = self::id();

        if ($userId) {
            // Guardar token en base de datos (implementar tabla remember_tokens si es necesario)
            setcookie('remember_token', $token, time() + (86400 * 30), '/', '', true, true); // 30 días
        }
    }

    /**
     * Verificar si es una petición AJAX
     */
    private static function isAjaxRequest()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Obtener URL de dashboard según el rol
     */
    public static function getDashboardUrl()
    {
        $usuario = self::user();
        if (!$usuario) {
            return '/login';
        }

        $rol = strtolower($usuario['rol_nombre'] ?? '');

        switch ($rol) {
            case 'admin':
            case 'administrador':
                return '/admin/dashboard';
            case 'operador':
                return '/operador/dashboard';
            case 'conductor':
                return '/conductor/dashboard';
            default:
                return '/dashboard';
        }
    }

    /**
     * Obtener permisos por defecto según el rol
     */
    public static function getDefaultPermissions($rolNombre)
    {
        $permisos = [
            'administrador' => [
                'usuarios.ver',
                'usuarios.crear',
                'usuarios.editar',
                'usuarios.eliminar',
                'conductores.ver',
                'conductores.crear',
                'conductores.editar',
                'conductores.eliminar',
                'vehiculos.ver',
                'vehiculos.crear',
                'vehiculos.editar',
                'vehiculos.eliminar',
                'clientes.ver',
                'clientes.crear',
                'clientes.editar',
                'clientes.eliminar',
                'viajes.ver',
                'viajes.crear',
                'viajes.editar',
                'viajes.eliminar',
                'reportes.ver',
                'configuracion.editar'
            ],
            'operador' => [
                'conductores.ver',
                'conductores.crear',
                'conductores.editar',
                'vehiculos.ver',
                'vehiculos.crear',
                'vehiculos.editar',
                'clientes.ver',
                'clientes.crear',
                'clientes.editar',
                'viajes.ver',
                'viajes.crear',
                'viajes.editar',
                'reportes.ver'
            ],
            'conductor' => [
                'viajes.ver',
                'viajes.editar',
                'clientes.ver'
            ]
        ];

        return $permisos[$rolNombre] ?? [];
    }
}
