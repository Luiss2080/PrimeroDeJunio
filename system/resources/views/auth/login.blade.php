<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Sistema - Asociación 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">

    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS del login -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Meta tags para SEO -->
    <meta name="description" content="Accede a tu cuenta en la Asociación 1ro de Junio. Sistema administrativo para gestión de conductores y servicios de mototaxi.">
    <meta name="keywords" content="login, asociación, mototaxi, conductores, gestión, sistema">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph -->
    <meta property="og:title" content="Iniciar Sesión - Asociación 1ro de Junio">
    <meta property="og:description" content="Accede a tu cuenta en la Asociación 1ro de Junio">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
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
                            <img src="{{ asset('images/LogoAsociacion.png') }}" alt="ASOCIACIÓN 1RO DE JUNIO" class="brand-logo">
                        </div>
                        <div class="brand-text">
                            <h1 class="brand-title">1RO DE JUNIO</h1>
                            <div class="brand-line"></div>
                            <span class="brand-subtitle">ASOCIACIÓN DE MOTOTAXIS</span>
                        </div>
                    </div>

                    <!-- Mensaje profesional -->
                    <div class="welcome-section">
                        <h2 class="welcome-title">¡Bienvenido!</h2>
                        <p class="welcome-description">
                            Inicia sesión con tu cuenta y accede al sistema administrativo de la Asociación 1ro de Junio. Plataforma diseñada para la gestión integral de conductores, servicios de mototaxi y administración de la asociación.
                        </p>
                    </div>

                    <!-- Sección de redes sociales -->
                    <div class="social-section">
                        <p class="social-text">¿Tienes dudas sobre nuestros servicios?</p>
                        <p class="social-title">¡Contáctate con nosotros!</p>
                        <div class="social-media-links">
                            <a href="#" class="social-link tiktok" title="TikTok">
                                <div class="social-icon">
                                    <img src="http://localhost/Nexorium/website/public/images/tiktok.webp" alt="TikTok" class="social-logo">
                                </div>
                                <span>TikTok</span>
                            </a>
                            <a href="#" class="social-link facebook" title="Facebook">
                                <div class="social-icon">
                                    <img src="http://localhost/Nexorium/website/public/images/facebook.webp" alt="Facebook" class="social-logo">
                                </div>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="social-link instagram" title="Instagram">
                                <div class="social-icon">
                                    <img src="http://localhost/Nexorium/website/public/images/Instagram.webp" alt="Instagram" class="social-logo">
                                </div>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-link whatsapp" title="WhatsApp">
                                <div class="social-icon">
                                    <img src="http://localhost/Nexorium/website/public/images/wpps.webp" alt="WhatsApp" class="social-logo">
                                </div>
                                <span>WhatsApp</span>
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

                <div class="form-container"> <!-- Header del formulario -->
                    <div class="form-header">
                        <h2 class="form-title">Iniciar Sesión</h2>
                        <p class="form-subtitle">Ingresa tus credenciales para continuar</p>
                    </div>

                    <!-- Mensajes de error/éxito -->
                    @if($errors->any())
                    <div class="alert alert-error">
                        <div class="alert-icon">⚠️</div>
                        <div class="alert-message">{{ $errors->first() }}</div>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">
                        <div class="alert-icon">✅</div>
                        <div class="alert-message">{{ session('success') }}</div>
                    </div>
                    @endif

                    <!-- Formulario de login -->
                    <form class="login-form" method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Campo Email -->
                        <div class="input-group">
                            <label for="email" class="input-label">Correo Electrónico</label>
                            <div class="input-wrapper">
                                <div class="input-icon">✉</div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input"
                                    placeholder="Escribe tu email aquí..."
                                    value="{{ old('email') }}"
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
                                    placeholder="Escribe tu contraseña aquí..."
                                    required
                                    autocomplete="current-password">
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
                            <a href="{{ route('password.request') }}" class="forgot-password" id="forgotPasswordLink">¿Olvidaste tu contraseña?</a>
                        </div>

                        <!-- Botón de submit -->
                        <button type="submit" class="login-button btn-nexorium" id="loginButton">
                            <span class="button-text">ACCESO SISTEMA</span>
                            <span class="button-loader" id="buttonLoader">
                                <div class="loader-spinner"></div>
                            </span>
                        </button>

                    </form>

                    <!-- Footer del formulario -->
                    <div class="form-footer">
                        <p class="register-text">
                            ¿Quieres unirte a nuestra asociación?
                            <span class="highlight"><a href="#" class="register-link" id="registerLink">¡Solicita tu registro!</a></span>
                        </p>

                        <!-- Social Media Links -->
                        <div class="social-media-links">
                            <a href="#" class="social-link trading-signals" title="Señales de Trading">
                                <div class="social-icon">📊</div>
                                <span>Señales VIP</span>
                            </a>
                            <a href="#" class="social-link academy" title="Academia">
                                <div class="social-icon">🎓</div>
                                <span>Academia Pro</span>
                            </a>
                            <a href="#" class="social-link community" title="Comunidad">
                                <div class="social-icon">👥</div>
                                <span>Comunidad</span>
                            </a>
                            <a href="#" class="social-link support" title="Soporte">
                                <div class="social-icon">💬</div>
                                <span>Soporte 24/7</span>
                            </a>
                        </div>

                        <!-- Register Link -->
                        <div class="register-section">
                            <p class="no-account-text">¿No tienes cuenta en el sistema?
                                <span class="highlight"><a href="#" class="register-link-main" id="registerMainLink">¡Solicita tu acceso!</a></span>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/login.js') }}"></script>

    <!-- Analytics (opcional) -->
    <script>
        // Google Analytics o similar
        console.log('🔐 ASOCIACIÓN 1RO DE JUNIO Login: Página cargada correctamente');
    </script>

</body>

</html>