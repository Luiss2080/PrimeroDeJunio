<?php

/**
 * Script para crear/verificar usuario administrador
 */

// Incluir bootstrap
require_once '../app/bootstrap.php';

echo "<h1>Crear/Verificar Usuario Administrador</h1>";

try {
    $db = Database::getInstance();

    // Verificar si existe la tabla de usuarios
    $tables = $db->fetchAll("SHOW TABLES LIKE 'usuarios'");
    if (empty($tables)) {
        echo "<p style='color: red;'>❌ La tabla 'usuarios' no existe. Ejecuta las migraciones primero.</p>";
        echo "<p>Ejecuta: <code>.\importar-seeds.ps1</code></p>";
        exit;
    }

    // Verificar si existe la tabla de roles
    $rolesTable = $db->fetchAll("SHOW TABLES LIKE 'roles'");
    if (empty($rolesTable)) {
        echo "<p style='color: orange;'>⚠️ Creando tabla de roles...</p>";
        $db->execute("
            CREATE TABLE roles (
                id INT PRIMARY KEY AUTO_INCREMENT,
                nombre VARCHAR(50) NOT NULL UNIQUE,
                descripcion TEXT,
                estado ENUM('activo', 'inactivo') DEFAULT 'activo',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");
    }

    // Verificar/crear rol de administrador
    $adminRole = $db->fetch("SELECT * FROM roles WHERE nombre IN ('admin', 'administrador')");
    if (!$adminRole) {
        echo "<p style='color: orange;'>⚠️ Creando rol de administrador...</p>";
        $adminRoleId = $db->insert("
            INSERT INTO roles (nombre, descripcion, estado) 
            VALUES ('admin', 'Administrador del sistema con acceso completo', 'activo')
        ");
        echo "<p style='color: green;'>✓ Rol de administrador creado con ID: $adminRoleId</p>";
    } else {
        $adminRoleId = $adminRole['id'];
        echo "<p style='color: green;'>✓ Rol de administrador existe con ID: {$adminRole['id']}</p>";
    }

    // Verificar/crear usuario administrador
    $adminUser = $db->fetch("SELECT * FROM usuarios WHERE email = 'admin@primero1dejunio.com'");

    if (!$adminUser) {
        echo "<p style='color: orange;'>⚠️ Creando usuario administrador...</p>";

        $hashedPassword = password_hash('mototaxi123', PASSWORD_DEFAULT);

        $adminUserId = $db->insert("
            INSERT INTO usuarios (nombre, apellido, email, password, rol_id, estado, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ", [
            'Administrador',
            'Sistema',
            'admin@primero1dejunio.com',
            $hashedPassword,
            $adminRoleId,
            'activo'
        ]);

        echo "<p style='color: green;'>✓ Usuario administrador creado con ID: $adminUserId</p>";
    } else {
        echo "<p style='color: green;'>✓ Usuario administrador ya existe</p>";

        // Verificar si la contraseña es correcta
        if (password_verify('mototaxi123', $adminUser['password'])) {
            echo "<p style='color: green;'>✓ Contraseña verificada correctamente</p>";
        } else {
            echo "<p style='color: orange;'>⚠️ Actualizando contraseña del administrador...</p>";
            $hashedPassword = password_hash('mototaxi123', PASSWORD_DEFAULT);
            $db->execute("UPDATE usuarios SET password = ? WHERE id = ?", [$hashedPassword, $adminUser['id']]);
            echo "<p style='color: green;'>✓ Contraseña actualizada</p>";
        }
    }

    // Mostrar información final
    $finalUser = $db->fetch("
        SELECT u.*, r.nombre as rol_nombre 
        FROM usuarios u 
        LEFT JOIN roles r ON u.rol_id = r.id 
        WHERE u.email = 'admin@primero1dejunio.com'
    ");

    echo "<h3>Datos del Usuario Administrador:</h3>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><td><strong>ID:</strong></td><td>{$finalUser['id']}</td></tr>";
    echo "<tr><td><strong>Nombre:</strong></td><td>{$finalUser['nombre']} {$finalUser['apellido']}</td></tr>";
    echo "<tr><td><strong>Email:</strong></td><td>{$finalUser['email']}</td></tr>";
    echo "<tr><td><strong>Rol:</strong></td><td>{$finalUser['rol_nombre']} (ID: {$finalUser['rol_id']})</td></tr>";
    echo "<tr><td><strong>Estado:</strong></td><td>{$finalUser['estado']}</td></tr>";
    echo "<tr><td><strong>Contraseña:</strong></td><td>mototaxi123 (hash verificado)</td></tr>";
    echo "</table>";

    echo "<br><p style='color: green; font-size: 18px;'><strong>✅ Usuario administrador listo para usar</strong></p>";
    echo "<p><strong>Credenciales:</strong></p>";
    echo "<ul>";
    echo "<li><strong>Email:</strong> admin@primero1dejunio.com</li>";
    echo "<li><strong>Contraseña:</strong> mototaxi123</li>";
    echo "</ul>";
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>

<br><br>
<a href="../app/auth/login.php">← Probar Login</a> |
<a href="diagnostico.php">Diagnóstico</a>