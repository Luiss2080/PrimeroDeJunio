{{-- Layout principal para el dashboard del sistema --}}
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
    
    <!-- CSS del Sistema -->
    <link rel="stylesheet" href="{{ asset('css/base/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/dashboard.css') }}">
    
    <!-- CSS específico de la página -->
    @stack('styles')
    
    <!-- Meta tags -->
    <meta name="description" content="@yield('description', 'Dashboard administrativo de la Asociación 1ro de Junio. Gestión profesional de mototaxis.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title') - Asociación 1ro de Junio">
    <meta property="og:description" content="@yield('description', 'Dashboard administrativo de la Asociación 1ro de Junio')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/LogoAsociacion.png') }}">
</head>

<body class="dashboard-body">
    
    <!-- Loader inicial -->
    <div id="page-loader" class="page-loader">
        <div class="loader-content">
            <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo" class="loader-logo">
            <div class="loader-spinner"></div>
            <p>Cargando dashboard...</p>
        </div>
    </div>
    
    <!-- Contenedor principal del dashboard -->
    <div class="dashboard-layout">
        
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-container">
                
                <!-- Logo y menú móvil -->
                <div class="header-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    
                    <div class="header-logo">
                        <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo" class="logo">
                        <div class="logo-text">
                            <h1>Asociación</h1>
                            <span>1ro de Junio</span>
                        </div>
                    </div>
                </div>
                
                <!-- Búsqueda -->
                <div class="header-search">
                    <div class="search-container">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        <input type="text" placeholder="Buscar en el sistema..." class="search-input">
                    </div>
                </div>
                
                <!-- Acciones del header -->
                <div class="header-right">
                    
                    <!-- Notificaciones -->
                    <div class="header-notifications">
                        <button class="notification-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                            </svg>
                            <span class="notification-badge">3</span>
                        </button>
                    </div>
                    
                    <!-- Usuario -->
                    <div class="header-user">
                        <div class="user-info">
                            <div class="user-avatar">
                                <img src="{{ asset('images/default-avatar.jpg') }}" alt="Usuario" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmZiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTIgMkM2LjQ4IDIgMiA2LjQ4IDIgMTJzNC40OCAxMCAxMCAxMCAxMC00LjQ4IDEwLTEwUzE3LjUyIDIgMTIgMnptMCAzYzEuNjYgMCAzIDEuMzQgMyAzcy0xLjM0IDMtMyAzLTMtMS4zNC0zLTMgMS4zNC0zIDMtM3ptMCAxNC4yYy0yLjUgMC00LjcxLTEuMjgtNi0zLjJDNi4wMyAxNC41MSA5LjUzIDEzIDEyIDEzczUuOTcgMS41MSA2IDMuMmMtMS4yOSAxLjkyLTMuNSAzLjItNiAzLjJ6Ii8+PC9zdmc+'" class="avatar-img">
                            </div>
                            <div class="user-text">
                                <span class="user-name">{{ session('user_name', 'Usuario') }}</span>
                                <span class="user-role">{{ ucfirst(session('user_role', 'usuario')) }}</span>
                            </div>
                        </div>
                        
                        <div class="user-dropdown">
                            <button class="dropdown-toggle">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 10l5 5 5-5z"/>
                                </svg>
                            </button>
                            
                            <div class="dropdown-menu">
                                <a href="/perfil" class="dropdown-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    Mi Perfil
                                </a>
                                <a href="/configuracion" class="dropdown-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                                    </svg>
                                    Configuración
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                                    </svg>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Sidebar -->
        <aside class="dashboard-sidebar" id="dashboardSidebar">
            <div class="sidebar-content">
                
                <!-- Navegación principal -->
                <nav class="sidebar-nav">
                    <div class="nav-section">
                        <h3 class="nav-title">Principal</h3>
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="/dashboard/{{ session('user_role') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="nav-section">
                        <h3 class="nav-title">Gestión</h3>
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="/conductores" class="nav-link {{ request()->is('conductores*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    <span>Conductores</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/vehiculos" class="nav-link {{ request()->is('vehiculos*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                    </svg>
                                    <span>Vehículos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/viajes" class="nav-link {{ request()->is('viajes*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20 6h-2.18c.11-.31.18-.65.18-1a2.996 2.996 0 0 0-5.5-1.65l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1z"/>
                                    </svg>
                                    <span>Viajes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/clientes" class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-4.8c0-.7.33-1.35.85-1.78L12 6c.55-.37 1.3-.37 1.85 0l7.15 5.42c.52.43.85 1.08.85 1.78V18c0 1.11-.89 2-2 2H6c-1.11 0-2-.89-2-2z"/>
                                    </svg>
                                    <span>Clientes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    @if(session('user_role') === 'administrador')
                    <div class="nav-section">
                        <h3 class="nav-title">Administración</h3>
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="/usuarios" class="nav-link {{ request()->is('usuarios*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 7c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4zM12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    <span>Usuarios</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/tarifas" class="nav-link {{ request()->is('tarifas*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                                    </svg>
                                    <span>Tarifas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/configuracion" class="nav-link {{ request()->is('configuracion*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                                    </svg>
                                    <span>Configuración</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    
                    <div class="nav-section">
                        <h3 class="nav-title">Reportes</h3>
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="/reportes" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
                                    <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                    </svg>
                                    <span>Reportes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                <!-- Información del sistema -->
                <div class="sidebar-footer">
                    <div class="system-info">
                        <div class="info-item">
                            <span class="info-label">Versión</span>
                            <span class="info-value">1.0.0</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Estado</span>
                            <span class="info-value status-online">Activo</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        
        <!-- Contenido principal -->
        <main class="dashboard-main">
            <div class="main-content">
                @yield('content')
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="dashboard-footer">
            <div class="footer-container">
                <div class="footer-left">
                    <span>&copy; {{ date('Y') }} Asociación 1ro de Junio</span>
                    <span class="separator">|</span>
                    <span>Sistema de Gestión Profesional</span>
                </div>
                
                <div class="footer-right">
                    <span>Desarrollado en Santa Cruz, Bolivia</span>
                    <span class="separator">|</span>
                    <span>Versión 1.0.0</span>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Overlay para móvil -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
    
    <!-- Scripts del dashboard -->
    <script>
        // Configuración global
        window.appConfig = {
            csrfToken: '{{ csrf_token() }}',
            baseUrl: '{{ url("/") }}',
            locale: '{{ app()->getLocale() }}',
            user: {
                id: '{{ session("user_id") }}',
                name: '{{ session("user_name") }}',
                role: '{{ session("user_role") }}'
            }
        };
        
        // Inicialización del dashboard
        document.addEventListener('DOMContentLoaded', function() {
            // Ocultar loader
            const loader = document.getElementById('page-loader');
            if (loader) {
                setTimeout(() => {
                    loader.style.opacity = '0';
                    setTimeout(() => loader.style.display = 'none', 300);
                }, 800);
            }
            
            // Toggle sidebar
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('dashboardSidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                    overlay.classList.toggle('active');
                    document.body.classList.toggle('sidebar-open');
                });
            }
            
            // Cerrar sidebar al hacer clic en overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                });
            }
            
            // Dropdown de usuario
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            
            if (dropdownToggle && dropdownMenu) {
                dropdownToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdownMenu.classList.toggle('show');
                });
                
                // Cerrar dropdown al hacer clic fuera
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.user-dropdown')) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
        });
        
        console.log('🚀 DASHBOARD LAYOUT: Sistema cargado correctamente');
    </script>
    
    <!-- Scripts específicos de la página -->
    @stack('scripts')
</body>
</html>