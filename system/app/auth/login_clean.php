<?php

/**
 * LOGIN SIMPLIFICADO Y LIMPIO
 */

// 1. Control estricto de sesión
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// 2. Cargar dependencias
require_once '../bootstrap.php';
require_once APP_PATH . '/core/Auth.php';

$error = '';
$debug = '';

// 3. Logout simple
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// 4. Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $debug = "Procesando login para: $email";

    try {
        // Intentar login
        $loginSuccess = Auth::login($email, $password);

        if ($loginSuccess) {
            // Obtener usuario y rol
            $user = Auth::user();
            $debug .= " | Login exitoso | Rol: " . ($user['rol_nombre'] ?? 'desconocido');

            // Redireccionar con JavaScript como backup
            $redirectUrl = 'http://localhost/PrimeroDeJunio/system/public/index.php/admin/dashboard';

            echo "<!DOCTYPE html><html><head><title>Redirigiendo...</title></head><body>";
            echo "<h2>✅ Login exitoso</h2>";
            echo "<p>Redirigiendo al dashboard...</p>";
            echo "<script>window.location.href = '$redirectUrl';</script>";
            echo "<meta http-equiv='refresh' content='2;url=$redirectUrl'>";
            echo "<a href='$redirectUrl'>Si no eres redirigido automáticamente, haz clic aquí</a>";
            echo "</body></html>";
            exit;
        } else {
            $error = 'Credenciales incorrectas';
            $debug .= " | Login falló - credenciales incorrectas";
        }
    } catch (Exception $e) {
        $error = 'Error del sistema: ' . $e->getMessage();
        $debug .= " | Excepción: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PRIMERO DE JUNIO</title>
    <link rel="stylesheet" href="http://localhost/PrimeroDeJunio/system/public/assets/css/login.css">
</head>

<body>
    <div class="login-background">
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
    </div>

    <div class="main-login-wrapper">
        <div class="floating-container">
            <!-- Panel Izquierdo -->
            <div class="login-branding">
                <div class="branding-content">
                    <div class="brand-section">
                        <div class="logo-container">
                            <img src="http://localhost/PrimeroDeJunio/website/public/images/logoMoto.jpg" alt="PRIMERO DE JUNIO" class="brand-logo">
                        </div>
                        <div class="brand-text">
                            <h1 class="brand-title">PRIMERO DE JUNIO</h1>
                            <div class="brand-line"></div>
                            <span class="brand-subtitle">ASOCIACIÓN MOTOTAXIS</span>
                        </div>
                    </div>
                    <div class="welcome-section">
                        <h2 class="welcome-title">¡Listo para el servicio!</h2>
                        <p class="welcome-description">
                            Inicia sesión y accede al sistema de gestión profesional para conductores y operadores.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Panel Derecho - Formulario -->
            <div class="login-form-section">
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">Iniciar Sesión</h2>
                        <p class="form-subtitle">Ingresa tus credenciales para continuar</p>
                    </div>

                    <?php if ($debug): ?>
                        <div style="background:#f0f8ff;border:1px solid #ccc;padding:10px;margin:10px 0;font-size:12px;">
                            Debug: <?php echo htmlspecialchars($debug); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="alert alert-error">
                            <div class="alert-icon">⚠️</div>
                            <div class="alert-message"><?php echo htmlspecialchars($error); ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="login-form">
                        <div class="input-group">
                            <label for="email" class="input-label">Correo Electrónico</label>
                            <div class="input-wrapper">
                                <div class="input-icon">📧</div>
                                <input type="email" id="email" name="email" class="form-input"
                                    placeholder="admin@primero1dejunio.com" required
                                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="password" class="input-label">Contraseña</label>
                            <div class="input-wrapper">
                                <div class="input-icon">🔒</div>
                                <input type="password" id="password" name="password" class="form-input"
                                    placeholder="••••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="login-button btn-primero-junio">
                            <span class="button-text">🏍️ ACCESO MOTOTAXI</span>
                        </button>
                    </form>

                    <div style="text-align: center; margin-top: 15px;">
                        <small style="color: #666;">
                            Credenciales de prueba: admin@primero1dejunio.com / mototaxi123
                        </small>
                    </div>

                    <div style="text-align: center; margin-top: 10px;">
                        <a href="?logout=1" style="color: #999; font-size: 12px;">🗑️ Limpiar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="http://localhost/PrimeroDeJunio/system/public/assets/js/login.js"></script>
</body>

</html>