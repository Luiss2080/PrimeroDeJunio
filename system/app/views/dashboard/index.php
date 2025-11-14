<?php

/**
 * PRIMERO DE JUNIO - DASHBOARD INDEX
 * Redirige al dashboard correcto según el rol del usuario
 */

session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigir al login
    header('Location: http://localhost/PrimeroDeJunio/system/app/auth/login.php');
    exit;
}

// Obtener el rol del usuario
$user_role = $_SESSION['user_role'] ?? 'operador';

// Redirigir según el rol
switch ($user_role) {
    case 'admin':
    case 'administrador':
        header('Location: administrador.php');
        break;

    case 'operador':
    case 'conductor':
    default:
        header('Location: operador.php');
        break;
}

exit;
