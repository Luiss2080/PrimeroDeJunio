<?php

/**
 * PRIMERO DE JUNIO - LOGIN CON METODOLOGÍA EXITOSA MIGRADA
 */

// 1. Control estricto de sesión (metodología que funciona)
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// 2. Cargar dependencias
require_once '../bootstrap.php';
require_once APP_PATH . '/core/Auth.php';

$error_message = '';
$debug_info = '';

// 3. Logout simple y efectivo
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// 4. Procesar formulario (metodología exitosa de login_clean.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $debug_info = "Procesando login para: $email";

    try {
        // Intentar login usando la metodología que funciona
        $loginSuccess = Auth::login($email, $password);

        if ($loginSuccess) {
            // Obtener usuario y rol
            $user = Auth::user();
            $debug_info .= " | Login exitoso | Rol: " . ($user['rol_nombre'] ?? 'desconocido');

            // Determinar URL de redirección según el rol
            $rol = strtolower($user['rol_nombre'] ?? '');
            switch ($rol) {
                case 'admin':
                case 'administrador':
                    $redirectUrl = '../../public/index.php/admin/dashboard';
                    break;
                case 'operador':
                    $redirectUrl = '../../public/index.php/operador/dashboard';
                    break;
                case 'conductor':
                    $redirectUrl = '../../public/index.php/conductor/dashboard';
                    break;
                default:
                    $redirectUrl = '../../public/index.php/admin/dashboard';
            }

            // Redireccionar inmediatamente usando múltiples métodos
            header("Location: $redirectUrl");
            echo "<!DOCTYPE html><html><head><title>Redirigiendo...</title></head><body>";
            echo "<h2 style='color: green; text-align: center; margin-top: 50px;'>✅ Login exitoso</h2>";
            echo "<p style='text-align: center;'>Bienvenido " . htmlspecialchars($user['nombre']) . "! Redirigiendo al dashboard...</p>";
            echo "<script>window.location.href = '$redirectUrl';</script>";
            echo "<meta http-equiv='refresh' content='1;url=$redirectUrl'>";
            echo "<div style='text-align: center; margin-top: 20px;'>";
            echo "<a href='$redirectUrl' style='color: blue; text-decoration: none; background: #f0f8ff; padding: 10px 20px; border-radius: 5px;'>Si no eres redirigido automáticamente, haz clic aquí</a>";
            echo "</div>";
            echo "</body></html>";
            exit;
        } else {
            $error_message = 'Email o contraseña incorrectos';
            $debug_info .= " | Login falló - credenciales incorrectas";
        }
    } catch (Exception $e) {
        $error_message = 'Error del sistema: ' . $e->getMessage();
        $debug_info .= " | Excepción: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo - PRIMERO DE JUNIO Asociación de Mototaxis</title>
    <link rel="icon" type="image/jpeg" href="../../../website/public/images/logoMoto.jpg">

    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS del login -->
    <link rel="stylesheet" href="../../public/assets/css/login.css">

    <!-- Meta tags para SEO -->
    <meta name="description" content="Accede a tu cuenta en PRIMERO DE JUNIO Asociación de Mototaxis. Plataforma administrativa para conductores y servicios.">
    <meta name="keywords" content="login, primero de junio, mototaxis, asociacion, iniciar sesión, conductores">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph -->
    <meta property="og:title" content="Iniciar Sesión - PRIMERO DE JUNIO Asociación de Mototaxis">
    <meta property="og:description" content="Accede a tu cuenta en PRIMERO DE JUNIO Asociación de Mototaxis">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
</head>

<body>
    <!-- Background animado -->
    <div class="login-background">
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="bg-grid"></div>
    </div>

    <!-- Contenedor principal flotante -->
    <div class="main-login-wrapper">
        <div class="floating-container">

            <!-- Panel Izquierdo - Branding Profesional -->
            <div class="login-branding">
                <!-- Efectos de background -->
                <div class="branding-effects">
                    <div class="gradient-mesh"></div>
                    <div class="floating-elements">
                        <div class="float-element element-1"></div>
                        <div class="float-element element-2"></div>
                        <div class="float-element element-3"></div>
                    </div>
                </div>

                <div class="branding-content">
                    <!-- Logo y marca - Diseño profesional -->
                    <div class="brand-section">
                        <div class="logo-container">
                            <div class="logo-backdrop"></div>
                            <img src="http://localhost/PrimeroDeJunio/website/public/images/logoMoto.jpg" alt="PRIMERO DE JUNIO" class="brand-logo">
                        </div>
                        <div class="brand-text">
                            <h1 class="brand-title">PRIMERO DE JUNIO</h1>
                            <div class="brand-line"></div>
                            <span class="brand-subtitle">ASOCIACIÓN MOTOTAXIS</span>
                        </div>
                    </div>

                    <!-- Mensaje profesional -->
                    <div class="welcome-section">
                        <h2 class="welcome-title">¡Listo para el servicio!</h2>
                        <p class="welcome-description">
                            Inicia sesión con tu cuenta administrativa y accede a la plataforma de gestión diseñada para conductores profesionales y operadores de mototaxis con excelencia en el servicio.
                        </p>
                    </div>

                    <!-- Sección de redes sociales -->
                    <div class="social-section">
                        <p class="social-text">¿Tienes dudas o quieres saber más?</p>
                        <p class="social-title">¡Contáctate con nosotros!</p>
                        <div class="social-media-links">
                            <a href="#" class="social-link whatsapp" title="WhatsApp">
                                <div class="social-icon">💬</div>
                                <span>WhatsApp</span>
                            </a>
                            <a href="#" class="social-link facebook" title="Facebook">
                                <div class="social-icon">📘</div>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="social-link instagram" title="Instagram">
                                <div class="social-icon">📷</div>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-link youtube" title="YouTube">
                                <div class="social-icon">📺</div>
                                <span>YouTube</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección derecha - Formulario de login -->
            <div class="login-form-section">
                <!-- Líneas decorativas -->
                <div class="form-lines">
                    <div class="line line-1"></div>
                    <div class="line line-2"></div>
                    <div class="line line-3"></div>
                </div>

                <!-- Partículas decorativas -->
                <div class="form-particles">
                    <div class="particle particle-1"></div>
                    <div class="particle particle-2"></div>
                    <div class="particle particle-3"></div>
                    <div class="particle particle-4"></div>
                </div>

                <div class="form-container">
                    <!-- Header del formulario -->
                    <div class="form-header">
                        <h2 class="form-title">Iniciar Sesión</h2>
                        <p class="form-subtitle">Ingresa tus credenciales para continuar</p>
                    </div>

                    <!-- Debug info (solo visible si hay debug) -->
                    <?php if (!empty($debug_info) && strpos($debug_info, 'Procesando') !== false): ?>
                        <div style="background:#f0f8ff;border:1px solid #ccc;padding:8px;margin:10px 0;font-size:11px;border-radius:4px;">
                            <strong>Debug:</strong> <?php echo htmlspecialchars($debug_info); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Mensajes de error -->
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-error">
                            <div class="alert-icon">⚠️</div>
                            <div class="alert-message"><?php echo htmlspecialchars($error_message); ?></div>
                        </div>
                    <?php endif; ?>

                    <!-- Formulario de login -->
                    <form class="login-form" method="POST" action="" id="loginForm">

                        <!-- Campo Email -->
                        <div class="input-group">
                            <label for="email" class="input-label">Correo Electrónico</label>
                            <div class="input-wrapper">
                                <div class="input-icon">📧</div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input"
                                    placeholder="admin@primero1dejunio.com"
                                    required
                                    autocomplete="email"
                                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                            </div>
                            <div class="input-error" id="emailError"></div>
                        </div>

                        <!-- Campo Contraseña -->
                        <div class="input-group">
                            <label for="password" class="input-label">Contraseña</label>
                            <div class="input-wrapper">
                                <div class="input-icon">🔒</div>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-input"
                                    placeholder="••••••••••"
                                    required
                                    autocomplete="current-password">
                                <button type="button" class="password-toggle" id="passwordToggle">
                                    <span class="toggle-icon">👁️</span>
                                </button>
                            </div>
                            <div class="input-error" id="passwordError"></div>
                        </div>

                        <!-- Recordar y Olvidé contraseña -->
                        <div class="form-options">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" id="remember" class="checkbox-input">
                                <span class="checkbox-custom"></span>
                                <span class="checkbox-text">Recordarme</span>
                            </label>
                            <a href="#" class="forgot-password" id="forgotPasswordLink">¿Olvidaste tu contraseña?</a>
                        </div>

                        <!-- Botón de submit -->
                        <button type="submit" class="login-button btn-primero-junio" id="loginButton">
                            <span class="button-text">🏍️ ACCESO MOTOTAXI</span>
                            <span class="button-loader" id="buttonLoader">
                                <div class="loader-spinner"></div>
                            </span>
                        </button>

                    </form>

                    <!-- Footer del formulario -->
                    <div class="form-footer">
                        <p class="register-text">
                            ¿Quieres unirte a nuestra asociación de conductores?
                            <a href="#" class="register-link" id="registerLink">¡Solicita tu registro!</a>
                        </p>

                        <!-- Social Media Links -->
                        <div class="social-media-links">
                            <a href="#" class="social-link servicios" title="Servicios de Mototaxi">
                                <div class="social-icon">🏍️</div>
                                <span>Servicios</span>
                            </a>
                            <a href="#" class="social-link conductores" title="Conductores">
                                <div class="social-icon">👥</div>
                                <span>Conductores</span>
                            </a>
                            <a href="#" class="social-link asociacion" title="Asociación">
                                <div class="social-icon">🏢</div>
                                <span>Asociación</span>
                            </a>
                            <a href="#" class="social-link soporte" title="Soporte">
                                <div class="social-icon">💬</div>
                                <span>Soporte 24/7</span>
                            </a>
                        </div>

                        <!-- Register Link -->
                        <div class="register-section">
                            <p class="no-account-text">¿No tienes cuenta de conductor?
                                <a href="#" class="register-link-main" id="registerMainLink">¡Solicita acceso exclusivo!</a>
                            </p>
                        </div>

                        <!-- Credenciales de ayuda y limpieza de sesión -->
                        <div style="text-align: center; margin-top: 20px; padding-top: 15px; border-top: 1px solid #333;">
                            <small style="color: #666; display: block; margin-bottom: 10px;">
                                <strong>Credenciales de prueba:</strong><br>
                                📧 admin@primero1dejunio.com<br>
                                🔑 mototaxi123
                            </small>
                            <a href="?logout=1" style="color: #666; font-size: 11px; text-decoration: none; opacity: 0.7;">
                                🗑️ ¿Problemas de acceso? Limpiar sesión
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript -->
    <script src="../../public/assets/js/login.js"></script>

    <!-- Analytics (opcional) -->
    <script>
        // Google Analytics o similar
        console.log('🔐 PRIMERO DE JUNIO Login: Página cargada correctamente');
    </script>

</body>

</html>