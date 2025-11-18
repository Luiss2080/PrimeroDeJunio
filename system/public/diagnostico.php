<?php
/**
 * Página de diagnóstico para verificar conexión y datos
 */

// Incluir bootstrap
require_once '../app/bootstrap.php';

echo "<h1>Diagnóstico del Sistema</h1>";

try {
    // Probar conexión a la base de datos
    $db = Database::getInstance();
    echo "<p style='color: green;'>✓ Conexión a base de datos exitosa</p>";
    
    // Verificar tabla usuarios
    $usuarios = $db->fetchAll("SELECT * FROM usuarios LIMIT 5");
    echo "<h3>Usuarios en la base de datos:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Email</th><th>Nombre</th><th>Rol ID</th><th>Estado</th></tr>";
    foreach ($usuarios as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['nombre']}</td>";
        echo "<td>{$user['rol_id']}</td>";
        echo "<td>{$user['estado']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Verificar tabla roles
    $roles = $db->fetchAll("SELECT * FROM roles");
    echo "<h3>Roles en la base de datos:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Estado</th></tr>";
    foreach ($roles as $rol) {
        echo "<tr>";
        echo "<td>{$rol['id']}</td>";
        echo "<td>{$rol['nombre']}</td>";
        echo "<td>{$rol['descripcion']}</td>";
        echo "<td>{$rol['estado']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Verificar usuario admin específico
    $admin = $db->fetch(
        "SELECT u.*, r.nombre as rol_nombre 
         FROM usuarios u 
         LEFT JOIN roles r ON u.rol_id = r.id 
         WHERE u.email = ?", 
        ['admin@primero1dejunio.com']
    );
    
    echo "<h3>Usuario Admin:</h3>";
    if ($admin) {
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
    } else {
        echo "<p style='color: red;'>❌ Usuario admin no encontrado</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>

<br><br>
<a href="auth/login.php">← Volver al login</a>