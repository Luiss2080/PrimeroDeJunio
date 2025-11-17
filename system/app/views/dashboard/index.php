<?php

/**
 * PRIMERO DE JUNIO - DASHBOARD INDEX
 * Redirige al dashboard correcto según el rol del usuario
 * Incluye validaciones de seguridad
 */

session_start();

// Función de seguridad: Bloquear acceso a archivos de log
function blockLogFiles()
{
    $requestedFile = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('/\.log$/i', $requestedFile)) {
        http_response_code(403);
        die('Acceso denegado');
    }
}

// Función de seguridad: Prevenir directory listing
function preventDirectoryListing()
{
    $requestedPath = $_SERVER['REQUEST_URI'] ?? '';
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';

    // Si están intentando acceder al directorio sin especificar archivo
    if (dirname($scriptName) === rtrim($requestedPath, '/')) {
        // Este script ya maneja esa situación
        return;
    }
}

// Aplicar medidas de seguridad
blockLogFiles();
preventDirectoryListing();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigir al login
    header('Location: http://localhost/PrimeroDeJunio/system/app/auth/login.php');
    exit;
}

// Obtener el rol del usuario de la sesión
$user_role = $_SESSION['user_role'] ?? 'operador';

// Manejo de parámetro role en URL (para compatibilidad con login.php)
if (isset($_GET['role'])) {
    $url_role = $_GET['role'];

    // Validar que el rol de la URL coincida con el rol de la sesión
    $role_mapping = [
        'admin' => ['admin', 'administrador'],
        'operador' => ['operador'],
        'supervisor' => ['supervisor'],
        'conductor' => ['conductor']
    ];

    $session_role_normalized = strtolower($user_role);
    $url_role_normalized = strtolower($url_role);

    // Verificar si el usuario tiene permisos para el rol solicitado
    $has_permission = false;
    foreach ($role_mapping as $allowed_url_role => $session_roles) {
        if ($url_role_normalized === $allowed_url_role && in_array($session_role_normalized, $session_roles)) {
            $has_permission = true;
            break;
        }
    }

    if (!$has_permission) {
        // Si no tiene permisos, usar el rol de la sesión
        $redirect_role = $session_role_normalized;
    } else {
        $redirect_role = $session_role_normalized;
    }
} else {
    $redirect_role = strtolower($user_role);
}

// Redirigir según el rol validado
switch ($redirect_role) {
    case 'admin':
    case 'administrador':
        header('Location: administrador.php');
        break;

    case 'supervisor':
        header('Location: operador.php?view=supervisor'); // Usamos vista especial para supervisor
        break;

    case 'conductor':
        header('Location: operador.php?view=conductor'); // Usamos vista especial para conductor
        break;

    case 'operador':
    default:
        header('Location: operador.php');
        break;
}

exit;
