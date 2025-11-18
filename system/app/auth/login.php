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
    <title>Acceso Administrativo - PRIMERO DE JUNIO Asociación de Mototaxis</title>
    <link rel="icon" type="image/jpeg" href="http://localhost/PrimeroDeJunio/website/public/images/logoMoto.jpg">

    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS del login -->
    <link rel="stylesheet" href="http://localhost/PrimeroDeJunio/system/public/assets/css/login.css">

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
                                    placeholder="conductor@primero1dejunio.com"
                                    required
                                    autocomplete="email">
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

                        <!-- Enlace de limpieza de sesión discreto -->
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="?logout=1" style="color: #666; font-size: 11px; text-decoration: none; opacity: 0.7;">
                                ¿Problemas de acceso? Limpiar sesión
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript -->
    <script src="http://localhost/PrimeroDeJunio/system/public/assets/js/login.js"></script>

    <!-- Analytics (opcional) -->
    <script>
        // Google Analytics o similar
        console.log('🔐 PRIMERO DE JUNIO Login: Página cargada correctamente');
    </script>

</body>

</html>