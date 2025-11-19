<?php

/**
 * Punto de entrada principal del Sistema PRIMERO DE JUNIO
 */

// Incluir bootstrap del sistema
require_once '../app/bootstrap.php';

try {
    // Verificar si la URL es para login, redirigir al login funcional
    $requestUri = $_SERVER['REQUEST_URI'];
    $path = parse_url($requestUri, PHP_URL_PATH);
    
    // Si es una ruta de login, redirigir al login que funciona
    if (strpos($path, '/login') !== false || strpos($path, 'index.php') === false || $path === '/PrimeroDeJunio/system/public/') {
        $loginUrl = '../app/auth/login.php';
        header("Location: $loginUrl");
        exit;
    }
    
    // Inicializar el router (ya carga las rutas automáticamente)
    $router = new Router();

    // Procesar la request actual
    $router->dispatch();
} catch (Exception $e) {
    // Manejo de errores global
    if (config('app.debug')) {
        echo "<h1>Error del Sistema</h1>";
        echo "<p><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
        echo "<p><strong>Archivo:</strong> " . $e->getFile() . "</p>";
        echo "<p><strong>Línea:</strong> " . $e->getLine() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    } else {
        echo "<h1>Error del Servidor</h1>";
        echo "<p>Ha ocurrido un error interno. Por favor, contacta al administrador.</p>";
    }

    // Log del error
    logError("Error no capturado", ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
}
