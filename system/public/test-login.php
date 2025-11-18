<?php
/**
 * Script para probar el proceso de login paso a paso
 */

// Incluir bootstrap
require_once '../app/bootstrap.php';

echo "<h1>Prueba de Login - Paso a Paso</h1>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    echo "<h3>Datos recibidos:</h3>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Password:</strong> " . str_repeat('*', strlen($password)) . "</p>";
    echo "<hr>";
    
    try {
        echo "<h3>Paso 1: Buscar usuario por email</h3>";
        $usuario = new Usuario();
        $user = $usuario->buscarPorEmail($email);
        
        if (!$user) {
            echo "<p style='color: red;'>❌ Usuario no encontrado con email: $email</p>";
            
            // Buscar emails similares
            $db = Database::getInstance();
            $similares = $db->fetchAll("SELECT email FROM usuarios WHERE email LIKE ?", ["%$email%"]);
            if ($similares) {
                echo "<p><strong>Emails similares encontrados:</strong></p><ul>";
                foreach ($similares as $sim) {
                    echo "<li>{$sim['email']}</li>";
                }
                echo "</ul>";
            }
        } else {
            echo "<p style='color: green;'>✓ Usuario encontrado</p>";
            echo "<pre>";
            echo "ID: {$user['id']}\n";
            echo "Nombre: {$user['nombre']} {$user['apellido']}\n";
            echo "Email: {$user['email']}\n";
            echo "Estado: {$user['estado']}\n";
            echo "Rol ID: {$user['rol_id']}\n";
            echo "Password Hash: " . substr($user['password'], 0, 20) . "...\n";
            echo "</pre>";
            
            echo "<h3>Paso 2: Verificar contraseña</h3>";
            $passwordCorrect = password_verify($password, $user['password']);
            
            if ($passwordCorrect) {
                echo "<p style='color: green;'>✓ Contraseña correcta</p>";
            } else {
                echo "<p style='color: red;'>❌ Contraseña incorrecta</p>";
                echo "<p><strong>Hash en BD:</strong> {$user['password']}</p>";
                echo "<p><strong>Hash de prueba:</strong> " . password_hash($password, PASSWORD_DEFAULT) . "</p>";
            }
            
            echo "<h3>Paso 3: Verificar estado</h3>";
            if ($user['estado'] === 'activo') {
                echo "<p style='color: green;'>✓ Usuario activo</p>";
            } else {
                echo "<p style='color: red;'>❌ Usuario no activo: {$user['estado']}</p>";
            }
            
            echo "<h3>Paso 4: Obtener datos con rol</h3>";
            $userConRol = $usuario->obtenerConRol($user['id']);
            if ($userConRol) {
                echo "<p style='color: green;'>✓ Datos con rol obtenidos</p>";
                echo "<pre>";
                print_r($userConRol);
                echo "</pre>";
            } else {
                echo "<p style='color: red;'>❌ Error obteniendo datos con rol</p>";
            }
            
            if ($passwordCorrect && $user['estado'] === 'activo') {
                echo "<h3>Paso 5: Simular login con Auth::login()</h3>";
                try {
                    $loginResult = Auth::login($email, $password);
                    if ($loginResult) {
                        echo "<p style='color: green;'>✓ Login exitoso con Auth::login()</p>";
                        
                        $authUser = Auth::user();
                        echo "<p><strong>Usuario en sesión:</strong></p>";
                        echo "<pre>";
                        print_r($authUser);
                        echo "</pre>";
                        
                        echo "<p><strong>Dashboard URL:</strong> " . Auth::getDashboardUrl() . "</p>";
                    } else {
                        echo "<p style='color: red;'>❌ Auth::login() retornó false</p>";
                    }
                } catch (Exception $e) {
                    echo "<p style='color: red;'>❌ Error en Auth::login(): " . $e->getMessage() . "</p>";
                }
            }
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
} else {
    ?>
    <form method="POST" style="max-width: 400px;">
        <div style="margin-bottom: 15px;">
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" value="admin@primero1dejunio.com" 
                   style="width: 100%; padding: 8px;" required>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="password">Contraseña:</label><br>
            <input type="password" name="password" id="password" value="mototaxi123" 
                   style="width: 100%; padding: 8px;" required>
        </div>
        
        <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            Probar Login
        </button>
    </form>
    
    <br><br>
    <a href="crear-admin.php">Crear/Verificar Admin</a> | 
    <a href="diagnostico.php">Diagnóstico</a> | 
    <a href="../app/auth/login.php">Login Real</a>
    <?php
}
?>