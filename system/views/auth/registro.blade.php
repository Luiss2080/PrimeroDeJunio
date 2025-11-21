<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Asociación 1ro de Junio</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Únete a la Asociación 1ro de Junio. Registro seguro para conductores de mototaxi y miembros de nuestra comunidad.">
    <meta name="keywords" content="registro, asociación, mototaxi, 1ro de junio, conductores, transporte">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph -->
    <meta property="og:title" content="Registro - Asociación 1ro de Junio">
    <meta property="og:description" content="Únete a nuestra asociación de conductores de mototaxi">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>

<body>
    <!-- Background decorativo -->
    <div class="register-background">
        <div class="bg-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="bg-grid"></div>
    </div>

    <!-- Contenedor principal flotante -->
    <div class="main-register-wrapper">
        <div class="floating-container">

            <!-- Panel Izquierdo - Branding Profesional -->
            <div class="register-branding">
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
                        <h2 class="welcome-title">¡Únete a Nosotros!</h2>
                        <p class="welcome-description">
                            Forma parte de la Asociación 1ro de Junio, donde los conductores de mototaxi encuentran apoyo,
                            capacitación y oportunidades de crecimiento. Juntos construimos un futuro mejor para el transporte urbano.
                        </p>
                    </div>

                    <!-- Características destacadas -->
                    <div class="features-section">
                        <h3 class="features-title">Beneficios de ser miembro</h3>
                        <div class="features-list">
                            <div class="feature-item">
                                <div class="feature-icon">🏍️</div>
                                <div class="feature-content">
                                    <h4>Apoyo Integral</h4>
                                    <p>Respaldo legal y administrativo</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">📚</div>
                                <div class="feature-content">
                                    <h4>Capacitación</h4>
                                    <p>Cursos y talleres especializados</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">🤝</div>
                                <div class="feature-content">
                                    <h4>Comunidad</h4>
                                    <p>Red de apoyo entre conductores</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">🎯</div>
                                <div class="feature-content">
                                    <h4>Oportunidades</h4>
                                    <p>Acceso a mejores trabajos</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de redes sociales -->
                    <div class="social-section">
                        <p class="social-text">¿Tienes dudas sobre nuestros servicios?</p>
                        <h3 class="social-title">¡Contáctate con nosotros!</h3>
                        <div class="social-media-links">
                            <a href="#" class="social-link tiktok" target="_blank">
                                <div class="social-icon">
                                    <img src="{{ asset('images/tiktok.png') }}" alt="TikTok" class="social-logo">
                                </div>
                                <span>TikTok</span>
                            </a>
                            <a href="#" class="social-link facebook" target="_blank">
                                <div class="social-icon">
                                    <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="social-logo">
                                </div>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="social-link instagram" target="_blank">
                                <div class="social-icon">
                                    <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="social-logo">
                                </div>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-link whatsapp" target="_blank">
                                <div class="social-icon">
                                    <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="social-logo">
                                </div>
                                <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Derecho - Formulario de Registro -->
            <div class="register-form-section">
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
                    <!-- Encabezado del formulario -->
                    @if(request('step') === 'verify')
                    <div class="form-header">
                        <h2 class="form-title">Verificar Email</h2>
                        <p class="form-subtitle">Ingresa el código de 6 dígitos que enviamos a tu email para completar el registro.</p>
                    </div>
                    @else
                    <div class="form-header">
                        <h2 class="form-title">Crear Cuenta</h2>
                        <p class="form-subtitle">Ingresa tus datos para unirte a la Asociación 1ro de Junio</p>
                    </div>
                    @endif

                    <!-- Mostrar errores -->
                    @if($errors->any())
                    <div class="alert alert-error">
                        <span class="alert-icon">⚠️</span>
                        <div class="alert-message">
                            @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Mostrar mensaje de éxito -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        <span class="alert-icon">✅</span>
                        <div class="alert-message">
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Formulario de registro -->
                    @if(request('step') === 'verify')
                    <!-- Paso 2: Verificación de email -->
                    <form class="register-form" method="POST" action="{{ route('register.verify') }}" id="registerForm">
                        @csrf
                        <input type="hidden" name="step" value="verify">
                        <input type="hidden" name="email" value="{{ session('verification_email') }}">

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
                                    placeholder="Ingresa el código de 6 dígitos"
                                    maxlength="6"
                                    required
                                    autocomplete="one-time-code">
                            </div>
                            <div class="input-error" id="codeError"></div>
                            <div class="input-help">
                                <p>Revisa tu bandeja de entrada y spam. El código expira en <strong>10 minutos</strong>.</p>
                            </div>
                        </div>

                        <!-- Botón de submit -->
                        <button type="submit" class="register-button btn-asociacion" id="registerButton">
                            <span class="button-text">VERIFICAR Y COMPLETAR REGISTRO</span>
                            <span class="button-loader" id="buttonLoader">
                                <div class="loader-spinner"></div>
                            </span>
                        </button>

                        <!-- Reenviar código -->
                        <div class="resend-code">
                            <p>¿No recibiste el código?</p>
                            <a href="#" class="resend-link" id="resendCode">Reenviar código</a>
                        </div>

                    </form>
                    @else
                    <!-- Paso 1: Registro inicial -->
                    <form class="register-form" method="POST" action="{{ route('register.submit') }}" id="registerForm">
                        @csrf
                        <input type="hidden" name="step" value="register">

                        <!-- Fila de nombre y apellido -->
                        <div class="form-row">
                            <div class="input-group half-width">
                                <label for="nombre" class="input-label">Nombre</label>
                                <div class="input-wrapper">
                                    <div class="input-icon">👤</div>
                                    <input
                                        type="text"
                                        id="nombre"
                                        name="nombre"
                                        class="form-input"
                                        placeholder="Tu nombre"
                                        value="{{ old('nombre') }}"
                                        required
                                        autocomplete="given-name">
                                </div>
                                <div class="input-error" id="nombreError"></div>
                            </div>

                            <div class="input-group half-width">
                                <label for="apellido" class="input-label">Apellido</label>
                                <div class="input-wrapper">
                                    <div class="input-icon">👤</div>
                                    <input
                                        type="text"
                                        id="apellido"
                                        name="apellido"
                                        class="form-input"
                                        placeholder="Tu apellido"
                                        value="{{ old('apellido') }}"
                                        required
                                        autocomplete="family-name">
                                </div>
                                <div class="input-error" id="apellidoError"></div>
                            </div>
                        </div>

                        <!-- Campo Email -->
                        <div class="input-group">
                            <label for="email" class="input-label">Correo Electrónico</label>
                            <div class="input-wrapper">
                                <div class="input-icon">✉️</div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input"
                                    placeholder="tu-email@ejemplo.com"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email">
                            </div>
                            <div class="input-error" id="emailError"></div>
                        </div>

                        <!-- Fila de teléfono y país -->
                        <div class="form-row">
                            <div class="input-group half-width">
                                <label for="telefono" class="input-label">Teléfono (Opcional)</label>
                                <div class="input-wrapper">
                                    <div class="input-icon">📱</div>
                                    <input
                                        type="tel"
                                        id="telefono"
                                        name="telefono"
                                        class="form-input"
                                        placeholder="+57 300 123 4567"
                                        value="{{ old('telefono') }}"
                                        autocomplete="tel">
                                </div>
                                <div class="input-error" id="telefonoError"></div>
                            </div>

                            <div class="input-group half-width">
                                <label for="pais" class="input-label">País</label>
                                <div class="input-wrapper">
                                    <div class="input-icon">🌍</div>
                                    <select
                                        id="pais"
                                        name="pais"
                                        class="form-input form-select"
                                        required
                                        autocomplete="country">
                                        <option value="">Selecciona tu país</option>
                                        <option value="CO" {{ old('pais') == 'CO' ? 'selected' : '' }}>🇨🇴 Colombia</option>
                                        <option value="VE" {{ old('pais') == 'VE' ? 'selected' : '' }}>🇻🇪 Venezuela</option>
                                        <option value="EC" {{ old('pais') == 'EC' ? 'selected' : '' }}>🇪🇨 Ecuador</option>
                                        <option value="PE" {{ old('pais') == 'PE' ? 'selected' : '' }}>🇵🇪 Perú</option>
                                        <option value="PA" {{ old('pais') == 'PA' ? 'selected' : '' }}>🇵🇦 Panamá</option>
                                        <option value="MX" {{ old('pais') == 'MX' ? 'selected' : '' }}>🇲🇽 México</option>
                                        <option value="OTHER" {{ old('pais') == 'OTHER' ? 'selected' : '' }}>🌎 Otro</option>
                                    </select>
                                </div>
                                <div class="input-error" id="paisError"></div>
                            </div>
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
                                    placeholder="Crea una contraseña segura"
                                    required
                                    autocomplete="new-password">
                            </div>
                            <div class="input-error" id="passwordError"></div>
                            <div class="input-help">
                                <p>Debe tener al menos <strong>8 caracteres</strong>, incluir mayúsculas, minúsculas y números.</p>
                            </div>
                        </div>

                        <!-- Campo Confirmar Contraseña -->
                        <div class="input-group">
                            <label for="confirm_password" class="input-label">Confirmar Contraseña</label>
                            <div class="input-wrapper">
                                <div class="input-icon">🔒</div>
                                <input
                                    type="password"
                                    id="confirm_password"
                                    name="password_confirmation"
                                    class="form-input"
                                    placeholder="Repite tu contraseña"
                                    required
                                    autocomplete="new-password">
                            </div>
                            <div class="input-error" id="confirmPasswordError"></div>
                        </div>

                        <!-- Checkboxes de términos -->
                        <div class="checkbox-group">
                            <label class="checkbox-label required">
                                <input type="checkbox" name="acepta_terminos" id="acepta_terminos" class="checkbox-input" required {{ old('acepta_terminos') ? 'checked' : '' }}>
                                <span class="checkbox-text">
                                    Acepto los <a href="#" class="link-terms">Términos y Condiciones</a>
                                    y la <a href="#" class="link-privacy">Política de Privacidad</a> de la Asociación 1ro de Junio.
                                </span>
                            </label>

                            <label class="checkbox-label">
                                <input type="checkbox" name="acepta_marketing" id="acepta_marketing" class="checkbox-input" {{ old('acepta_marketing') ? 'checked' : '' }}>
                                <span class="checkbox-text">
                                    Deseo recibir información sobre eventos, capacitaciones y beneficios de la asociación.
                                </span>
                            </label>
                        </div>

                        <!-- Botón de submit -->
                        <button type="submit" class="register-button btn-asociacion" id="registerButton">
                            <span class="button-text">CREAR MI CUENTA</span>
                            <span class="button-loader" id="buttonLoader">
                                <div class="loader-spinner"></div>
                            </span>
                        </button>

                    </form>
                    @endif

                    <!-- Footer del formulario -->
                    <div class="form-footer">
                        @if(request('step') === 'verify')
                        <div class="help-links">
                            <a href="#" class="help-link" id="contactSupport">
                                <span class="help-icon">🎧</span>
                                Soporte 24/7
                            </a>
                            <a href="#" class="help-link" id="helpCenter">
                                <span class="help-icon">❓</span>
                                Centro de Ayuda
                            </a>
                        </div>
                        <div class="back-to-login">
                            <p>¿Ya tienes cuenta en el sistema?</p>
                            <a href="{{ route('login') }}" class="login-link">
                                ¡Inicia sesión aquí!
                            </a>
                        </div>
                        @else
                        <!-- Sección de beneficios adicionales -->
                        <div class="benefits-section">
                            <div class="benefits-features">
                                <div class="benefit-item">
                                    <div class="benefit-icon">🎯</div>
                                    <div class="benefit-text">
                                        <h4>Señales VIP</h4>
                                        <p>Acceso prioritario a rutas</p>
                                    </div>
                                </div>
                                <div class="benefit-item">
                                    <div class="benefit-icon">🎓</div>
                                    <div class="benefit-text">
                                        <h4>Academia Pro</h4>
                                        <p>Capacitación especializada</p>
                                    </div>
                                </div>
                                <div class="benefit-item">
                                    <div class="benefit-icon">👥</div>
                                    <div class="benefit-text">
                                        <h4>Comunidad</h4>
                                        <p>Red de conductores unidos</p>
                                    </div>
                                </div>
                                <div class="benefit-item">
                                    <div class="benefit-icon">💬</div>
                                    <div class="benefit-text">
                                        <h4>Soporte 24/7</h4>
                                        <p>Ayuda cuando la necesites</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="back-to-login">
                            <p>¿Ya tienes cuenta en el sistema?</p>
                            <a href="{{ route('login') }}" class="login-link">
                                ¡Inicia sesión aquí!
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/registro.js') }}"></script>
</body>

</html>