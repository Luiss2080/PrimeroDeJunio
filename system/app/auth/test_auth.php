<?php
// Test simple de Auth::login
require_once '../bootstrap.php';
require_once APP_PATH . '/core/Auth.php';

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo "<h2>Test de Auth::login</h2>";

// Credenciales de prueba
$email = 'admin@primero1dejunio.com';
$password = 'mototaxi123'; // Contraseña correcta según seeds

echo "<p>Probando login con:</p>";
echo "<ul>";
echo "<li>Email: $email</li>";
echo "<li>Password: [oculta]</li>";
echo "</ul>";

try {
    $resultado = Auth::login($email, $password);
    echo "<p style='color: " . ($resultado ? 'green' : 'red') . ";'>";
    echo "Resultado: " . ($resultado ? "SUCCESS ✅" : "FAILED ❌");
    echo "</p>";

    if ($resultado) {
        echo "<h3>Datos del usuario logueado:</h3>";
        $usuario = Auth::user();
        echo "<pre>";
        print_r($usuario);
        echo "</pre>";

        echo "<p>✅ El Auth::login funciona correctamente</p>";
        echo "<a href='login.php'>Volver al login</a>";
    } else {
        echo "<p>❌ Auth::login falló - revisar credenciales o base de datos</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>ERROR: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
