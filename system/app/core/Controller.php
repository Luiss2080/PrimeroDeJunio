<?php

/**
 * Controlador Base del Sistema PRIMERO DE JUNIO
 */
abstract class Controller
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Cargar una vista
     */
    protected function view($viewName, $data = [])
    {
        extract($data);
        $viewPath = VIEWS_PATH . '/' . str_replace('.', '/', $viewName) . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            throw new Exception("Vista no encontrada: $viewName");
        }
    }

    /**
     * Redireccionar
     */
    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    /**
     * Respuesta JSON
     */
    protected function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Establecer mensaje flash
     */
    protected function setFlash($type, $message)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'][$type] = $message;
    }

    /**
     * Obtener mensaje flash
     */
    protected function getFlash($type)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['flash'][$type])) {
            $message = $_SESSION['flash'][$type];
            unset($_SESSION['flash'][$type]);
            return $message;
        }
        return null;
    }

    /**
     * Verificar si el usuario está autenticado
     */
    protected function isAuthenticated()
    {
        return Auth::check();
    }

    /**
     * Obtener usuario actual
     */
    protected function getUsuarioActual()
    {
        return Auth::user();
    }

    /**
     * Verificar si tiene un permiso específico
     */
    protected function tienePermiso($permiso)
    {
        return Auth::hasPermission($permiso);
    }

    /**
     * Requerir autenticación
     */
    protected function requireAuth()
    {
        if (!$this->isAuthenticated()) {
            $this->redirect('/login');
            exit;
        }
    }

    /**
     * Requerir permiso específico
     */
    protected function requirePermission($permiso)
    {
        if (!$this->tienePermiso($permiso)) {
            $this->setFlash('error', 'No tienes permisos para realizar esta acción');
            $this->redirect('/dashboard');
            exit;
        }
    }

    /**
     * Obtener parámetros de la URL
     */
    protected function getParams()
    {
        return $_GET;
    }

    /**
     * Obtener datos POST
     */
    protected function getPostData()
    {
        return $_POST;
    }

    /**
     * Validar token CSRF
     */
    protected function validateCsrfToken()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $token = $_POST['_token'] ?? $_GET['_token'] ?? '';
        $sessionToken = $_SESSION['csrf_token'] ?? '';
        
        return hash_equals($sessionToken, $token);
    }

    /**
     * Generar token CSRF
     */
    protected function generateCsrfToken()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
}