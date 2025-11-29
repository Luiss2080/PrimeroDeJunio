{{-- Layout base para páginas de autenticación --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Asociación 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- CSS específico por página -->
    @stack('styles')
    
    <!-- Meta tags para SEO -->
    <meta name="description" content="@yield('description', 'Accede al sistema administrativo de la Asociación 1ro de Junio. Gestión profesional de mototaxis en Santa Cruz, Bolivia.')">
    <meta name="keywords" content="@yield('keywords', 'login, asociación, mototaxi, conductores, gestión, sistema, Santa Cruz, Bolivia')">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title') - Asociación 1ro de Junio">
    <meta property="og:description" content="@yield('description', 'Sistema administrativo de la Asociación 1ro de Junio')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="auth-body">
    
    <!-- Background animado -->
    <div class="auth-background">
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="bg-grid"></div>
        <div class="bg-glow"></div>
    </div>
    
    <!-- Contenedor principal -->
    <div class="auth-wrapper">
        <div class="auth-container">
            
            <!-- Panel Izquierdo - Branding -->
            <div class="auth-branding">
                <div class="branding-effects">
                    <div class="gradient-mesh"></div>
                    <div class="floating-elements">
                        <div class="float-element float-1"></div>
                        <div class="float-element float-2"></div>
                        <div class="float-element float-3"></div>
                    </div>
                </div>
                
                <!-- Logo y Marca -->
                <div class="brand-content">
                    <div class="brand-logo">
                        <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo Asociación" class="logo-main">
                        <div class="logo-glow"></div>
                    </div>
                    
                    <div class="brand-text">
                        <h1 class="brand-title">ASOCIACIÓN<br><span class="highlight">1RO DE JUNIO</span></h1>
                        <p class="brand-subtitle">Sistema Administrativo Profesional</p>
                        <p class="brand-description">
                            Plataforma integral para la gestión eficiente de conductores, 
                            vehículos y operaciones de mototaxis en Santa Cruz, Bolivia.
                        </p>
                    </div>
                    
                    <!-- Características del Sistema -->
                    <div class="system-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span>Sistema Seguro</span>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <span>Gestión Rápida</span>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <span>Confiable 24/7</span>
                        </div>
                    </div>
                </div>
                
                <!-- Estadísticas -->
                <div class="brand-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ \App\Models\Conductor::count() }}+</span>
                        <span class="stat-label">Conductores</span>
                    </div>
                    
                    <div class="stat-item">
                        <span class="stat-number">{{ \App\Models\Vehiculo::count() }}+</span>
                        <span class="stat-label">Vehículos</span>
                    </div>
                    
                    <div class="stat-item">
                        <span class="stat-number">{{ \App\Models\Cliente::count() }}+</span>
                        <span class="stat-label">Clientes</span>
                    </div>
                </div>
            </div>
            
            <!-- Panel Derecho - Formulario de Autenticación -->
            <div class="auth-form-panel">
                <div class="form-container">
                    
                    @yield('content')
                    
                </div>
                
                <!-- Footer del Form -->
                <div class="auth-footer">
                    <div class="footer-links">
                        <a href="{{ url('/') }}" class="footer-link">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                            Sitio Web
                        </a>
                        
                        <a href="#help" class="footer-link">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                            </svg>
                            Ayuda
                        </a>
                    </div>
                    
                    <div class="footer-copyright">
                        <span>&copy; {{ date('Y') }} Asociación 1ro de Junio</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CSS general de autenticación -->
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
    
    <!-- Scripts específicos por página -->
    @stack('scripts')
    
    <!-- Scripts globales -->
    <script>
        // Configuración global
        window.appConfig = {
            csrfToken: '{{ csrf_token() }}',
            baseUrl: '{{ url("/") }}',
            locale: '{{ app()->getLocale() }}'
        };
        
        console.log('🔐 AUTH LAYOUT: Sistema de autenticación cargado correctamente');
    </script>
</body>
</html>