<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Asociación 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">

    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS del recuperar contraseña -->
    <link rel="stylesheet" href="{{ asset('css/auth/recuperar.css') }}">

    <!-- Meta tags para SEO -->
    <meta name="description" content="Recupera tu contraseña en la Asociación 1ro de Junio. Sistema administrativo para gestión de conductores y servicios de mototaxi.">
    <meta name="keywords" content="recuperar, contraseña, asociación, mototaxi, password, reset">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph -->
    <meta property="og:title" content="Recuperar Contraseña - Asociación 1ro de Junio">
    <meta property="og:description" content="Recupera tu contraseña en la Asociación 1ro de Junio">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
</head>

<body>
    <!-- Background animado -->
    <div class="recovery-background">
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="bg-grid"></div>
    </div>

    <!-- Contenedor principal flotante -->
    <div class="main-recovery-wrapper">
        <div class="floating-container">

            <!-- Panel Izquierdo - Branding Profesional -->
            <div class="recovery-branding">
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
                        <h2 class="welcome-title">¡No te preocupes!</h2>
                        <p class="welcome-description">
                            Recupera tu acceso al sistema administrativo de la Asociación 1ro de Junio en pocos pasos. Tu cuenta está protegida con los más altos estándares de seguridad para garantizar la protección de los datos de la asociación.
                        </p>
                    </div>

                    <!-- Sección de redes sociales -->
                    <div class="social-section">
                        <p class="social-text">¿Necesitas ayuda adicional?</p>
                        <p class="social-title">¡Contáctanos directamente!</p>
                        <div class="social-media-links">
                            <a href="#" class="social-link tiktok" title="TikTok">
                                <div class="social-icon">
                                    <img src="http://localhost/PrimeroDeJunio/system/public/img/tiktok.webp" alt="TikTok" class="social-logo">
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

            <!-- Sección derecha - Formulario de recuperación -->
            <div class="recovery-form-section">
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
                        @if($step === 'email')
                        <h2 class="form-title">Recuperar Contraseña</h2>
                        <p class="form-subtitle">Ingresa tu correo electrónico para continuar</p>
                        @elseif($step === 'code')
                        <h2 class="form-title">Verificar Código</h2>
                        <p class="form-subtitle">Ingresa el código enviado a tu correo</p>
                        @elseif($step === 'password')
                        <h2 class="form-title">Nueva Contraseña</h2>
                        <p class="form-subtitle">Establece tu nueva contraseña segura</p>
                        @else
                        <h2 class="form-title">¡Listo!</h2>
                        <p class="form-subtitle">Tu contraseña ha sido actualizada</p>
                        @endif
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

                    <?php if ($step !== 'success'): ?>
                        <!-- Formulario de recuperación -->
                        <form class="recovery-form" method="POST" action="" id="recoveryForm">
                            <input type="hidden" name="step" value="<?php echo $step; ?>">

                            <?php if ($step === 'email'): ?>
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
                                            placeholder="Escribe tu email registrado..."
                                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                            required
                                            autocomplete="email">
                                    </div>
                                    <div class="input-error" id="emailError"></div>
                                </div>

                            <?php elseif ($step === 'code'): ?>
                                <!-- Campo Código -->
                                <div class="input-group">
                                    <label for="code" class="input-label">Código de Verificación</label>
                                    <div class="input-wrapper">
                                        <div class="input-icon">🔢</div>
                                        <input
                                            type="text"
                                            id="code"
                                            name="code"
                                            class="form-input"
                                            placeholder="Ingresa el código de 6 dígitos..."
                                            maxlength="6"
                                            required
                                            autocomplete="off">
                                    </div>
                                    <div class="input-error" id="codeError"></div>
                                    <div class="input-help">
                                        <p>El código ha sido enviado a: <strong><?php echo htmlspecialchars($_SESSION['recovery_email'] ?? ''); ?></strong></p>
                                    </div>
                                </div>

                            <?php elseif ($step === 'password'): ?>
                                <!-- Campo Nueva Contraseña -->
                                <div class="input-group">
                                    <label for="password" class="input-label">Nueva Contraseña</label>
                                    <div class="input-wrapper">
                                        <div class="input-icon">🔒</div>
                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            class="form-input"
                                            placeholder="Escribe tu nueva contraseña..."
                                            required
                                            autocomplete="new-password">
                                    </div>
                                    <div class="input-error" id="passwordError"></div>
                                </div>

                                <!-- Campo Confirmar Contraseña -->
                                <div class="input-group">
                                    <label for="confirm_password" class="input-label">Confirmar Contraseña</label>
                                    <div class="input-wrapper">
                                        <div class="input-icon">🔐</div>
                                        <input
                                            type="password"
                                            id="confirm_password"
                                            name="confirm_password"
                                            class="form-input"
                                            placeholder="Confirma tu nueva contraseña..."
                                            required
                                            autocomplete="new-password">
                                    </div>
                                    <div class="input-error" id="confirmPasswordError"></div>
                                </div>

                                <!-- Requisitos de contraseña -->
                                <div class="password-requirements">
                                    <p class="requirements-title">Requisitos de la contraseña:</p>
                                    <ul class="requirements-list">
                                        <li class="requirement" id="lengthReq">Al menos 6 caracteres</li>
                                        <li class="requirement" id="upperReq">Una letra mayúscula</li>
                                        <li class="requirement" id="lowerReq">Una letra minúscula</li>
                                        <li class="requirement" id="numberReq">Un número</li>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <!-- Botón de submit -->
                            <button type="submit" class="recovery-button btn-nexorium" id="recoveryButton">
                                <span class="button-text">
                                    <?php if ($step === 'email'): ?>
                                        ENVIAR CÓDIGO
                                    <?php elseif ($step === 'code'): ?>
                                        VERIFICAR CÓDIGO
                                    <?php else: ?>
                                        CAMBIAR CONTRASEÑA
                                    <?php endif; ?>
                                </span>
                                <span class="button-loader" id="buttonLoader">
                                    <div class="loader-spinner"></div>
                                </span>
                            </button>

                        </form>

                        <!-- Sección de seguridad -->
                        <div class="security-section">
                            <div class="security-features">
                                <div class="security-item">
                                    <div class="security-icon">🔐</div>
                                    <div class="security-text">
                                        <h4>Encriptación Avanzada</h4>
                                        <p>Protección de datos de nivel bancario</p>
                                    </div>
                                </div>
                                <div class="security-item">
                                    <div class="security-icon">📧</div>
                                    <div class="security-text">
                                        <h4>Verificación por Email</h4>
                                        <p>Confirmación segura en tu correo</p>
                                    </div>
                                </div>
                                <div class="security-item">
                                    <div class="security-icon">⚡</div>
                                    <div class="security-text">
                                        <h4>Proceso Rápido</h4>
                                        <p>Recupera tu acceso en minutos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Footer del formulario -->
                    <div class="form-footer">
                        <?php if ($step === 'success'): ?>
                            <div class="success-actions">
                                <a href="{{ route('login') }}" class="btn-secondary">
                                    🔐 INICIAR SESIÓN
                                </a>
                                <a href="http://localhost/PrimeroDeJunio/website/" class="btn-tertiary">
                                    🏠 VOLVER AL SITIO
                                </a>
                            </div>
                        <?php else: ?>
                            <p class="back-to-login">
                                ¿Recordaste tu contraseña?<br>
                                <a href="{{ route('login') }}" class="login-link">
                                    ¡Inicia sesión aquí!
                                </a>
                            </p>

                            <?php if ($step === 'code'): ?>
                                <p class="resend-code">
                                    ¿No recibiste el código?
                                    <a href="#" class="resend-link" id="resendCode">
                                        Reenviar código
                                    </a>
                                </p>
                            <?php endif; ?>

                            <!-- Links de ayuda -->
                            <div class="help-links">
                                <a href="#" class="help-link" id="contactSupport">
                                    <div class="help-icon">💬</div>
                                    <span>Contactar Soporte</span>
                                </a>
                                <a href="#" class="help-link" id="helpCenter">
                                    <div class="help-icon">❓</div>
                                    <span>Centro de Ayuda</span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/auth/recuperar.js') }}"></script>

    <!-- Analytics (opcional) -->
    <script>
        // Google Analytics o similar
        console.log('🔐 ASOCIACIÓN 1RO DE JUNIO Recovery: Página cargada correctamente');
    </script>

</body>

</html>