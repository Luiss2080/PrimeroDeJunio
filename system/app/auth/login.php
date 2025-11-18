<?php
/**
 * PRIMERO DE JUNIO - LOGIN SIMPLIFICADO
 */

// Iniciar sesión limpia
session_start();

// Cargar dependencias
require_once '../bootstrap.php';
require_once APP_PATH . '/core/Auth.php';

// Variables
$error_message = '';

// LOGOUT SIMPLE
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// PROCESAR LOGIN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error_message = 'Por favor, completa todos los campos.';
    } else {
        try {
            if (Auth::login($email, $password)) {
                // Login exitoso - redirigir al dashboard
                header('Location: http://localhost/PrimeroDeJunio/system/public/index.php/admin/dashboard');
                exit;
            } else {
                $error_message = 'Email o contraseña incorrectos.';
            }
        } catch (Exception $e) {
            $error_message = 'Error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PRIMERO DE JUNIO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo h1 {
            color: #333;
            margin: 0;
            font-size: 24px;
        }
        .logo p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background: #5a67d8;
        }
        .error {
            background: #fee;
            border: 1px solid #fcc;
            color: #c00;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .logout-link {
            text-align: center;
            margin-top: 20px;
        }
        .logout-link a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>PRIMERO DE JUNIO</h1>
            <p>ASOCIACIÓN MOTOTAXIS</p>
        </div>

        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>

        <div class="logout-link">
            <a href="?logout=1">¿Problemas? Limpiar sesión</a>
        </div>
    </div>
</body>
</html>