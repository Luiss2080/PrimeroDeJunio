<?php

/**
 * Punto de entrada principal del Sistema PRIMERO DE JUNIO
 */

// Incluir bootstrap del sistema
require_once '../app/bootstrap.php';

try {
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