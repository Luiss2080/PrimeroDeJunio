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
    
    <!-- Meta tags -->
    <meta name="description" content="@yield('description', 'Dashboard administrativo de la Asociación 1ro de Junio. Gestión profesional de mototaxis.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CSS Externo del Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    
    <!-- Estilos mínimos específicos del layout -->
    <style>
        /* Solo estilos específicos necesarios para el layout */
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .content-wrapper {
            flex: 1;
            padding-top: 80px;
            padding-bottom: 60px;
            overflow-y: auto;
        }
        
        /* Estos estilos específicos del sidebar ya están en dashboard.css */
        
        .user-profile .user-details {
            flex: 1;
        }
        
        .user-profile .user-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-white);
            margin: 0 0 2px 0;
        }
        
        .user-profile .user-details p {
            font-size: 12px;
            color: var(--text-white-muted);
            margin: 0;
        }
        
        .logout-form {
            display: flex;
        }
        
        .logout-btn {
            background: none;
            border: none;
            color: var(--text-white-muted);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }
        
        /* Header Moderno */
        .dashboard-header {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 80px;
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 255, 102, 0.2);
            z-index: 1000;
            transition: left 0.3s ease;
        }
        
        .header-container {
            display: flex;
            align-items: center;
            height: 100%;
            padding: 0 30px;
            gap: 24px;
        }
        
        .header-search {
            flex: 1;
            max-width: 500px;
        }
        
        .search-container {
            position: relative;
            width: 100%;
        }
        
        .search-input {
            width: 100%;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 0 50px 0 20px;
            color: var(--text-white);
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 20px var(--green-glow);
        }
        
        .search-input::placeholder {
            color: var(--text-white-muted);
        }
        
        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-white-muted);
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .notification-btn {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--text-white);
        }
        
        .notification-btn:hover {
            background: rgba(0, 255, 102, 0.2);
            border-color: var(--primary-green);
            transform: translateY(-2px);
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-green-dark));
            color: #000;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-menu {
            position: relative;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 8px 16px 8px 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-info:hover {
            background: rgba(0, 255, 102, 0.2);
            border-color: var(--primary-green);
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #000;
            font-size: 14px;
        }
        
        .user-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-white);
            margin-bottom: 2px;
        }
        
        .user-details p {
            font-size: 12px;
            color: var(--text-white-muted);
        }
        
        /* Footer Moderno */
        .dashboard-footer {
            position: fixed;
            bottom: 0;
            left: 280px;
            right: 0;
            height: 60px;
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border-top: 1px solid rgba(0, 255, 102, 0.2);
            z-index: 999;
            transition: left 0.3s ease;
        }
        
        .footer-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 30px;
        }
        
        .footer-left,
        .footer-right {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-white-muted);
        }
        
        .separator {
            color: rgba(0, 255, 102, 0.5);
        }
        
        /* Animaciones de carga */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark-secondary) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.3s ease;
        }
        
        .loader-content {
            text-align: center;
            color: var(--text-white);
        }
        
        .loader-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            border-radius: 16px;
        }
        
        .loader-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(0, 255, 102, 0.3);
            border-top: 3px solid var(--primary-green);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-sidebar {
                transform: translateX(-100%);
            }
            
            .dashboard-sidebar.open {
                transform: translateX(0);
            }
            
            .dashboard-header,
            .dashboard-footer {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-overlay {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }
            
            .mobile-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        }
    </style>
    
    <!-- CSS específico de la página -->
    @stack('styles')
</head>

<body>
    
    <!-- Loader inicial -->
    <div id="page-loader" class="page-loader">
        <div class="loader-content">
            <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo" class="loader-logo">
            <div class="loader-spinner"></div>
            <p>Cargando dashboard...</p>
        </div>
    </div>

    <!-- Layout del Dashboard -->
    <div class="dashboard-layout">
        
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-content">
                
                <!-- Logo -->
                <div class="sidebar-header">
                    <div class="logo-container">
                        <div class="logo-icon">
                            <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo">
                        </div>
                        <div class="logo-text">
                            <h2>ASOCIACIÓN</h2>
                            <span>1ro de Junio</span>
                        </div>
                    </div>
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Navegación -->
                <nav class="sidebar-nav">
                    <div class="nav-section">
                        <h3 class="nav-title">Principal</h3>
                        <ul class="nav-menu">
                            <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                                <a href="{{ session('user_role') === 'administrador' ? route('dashboard.administrador') : route('dashboard.operador') }}" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('conductores.*') ? 'active' : '' }}">
                                <a href="/conductores" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    <span>Conductores</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                                <a href="/vehiculos" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                                    </svg>
                                    <span>Vehículos</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('viajes.*') ? 'active' : '' }}">
                                <a href="/viajes" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                    <span>Viajes</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                                <a href="/clientes" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
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
                        <ul class="nav-menu">
                            <li class="nav-item {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                                <a href="/usuarios" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM9 13c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4zm7.76-9.64l-1.68 1.69c.84 1.18.84 2.71 0 3.89l1.68 1.69c2.02-2.02 2.02-5.07 0-7.27zM20.07 2l-1.63 1.63c2.77 3.02 2.77 7.56 0 10.74L20.07 16c3.9-3.89 3.91-9.95 0-14z"/>
                                    </svg>
                                    <span>Usuarios</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('tarifas.*') ? 'active' : '' }}">
                                <a href="/tarifas" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                                    </svg>
                                    <span>Tarifas</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
                                <a href="/reportes" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                    </svg>
                                    <span>Reportes</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('configuraciones.*') ? 'active' : '' }}">
                                <a href="/configuracion" class="nav-link">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                                    </svg>
                                    <span>Configuración</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </nav>
                
                <!-- User Profile en Sidebar -->
                <div class="sidebar-footer">
                    <div class="user-profile">
                        <div class="user-avatar-sidebar">
                            {{ substr(session('user_name'), 0, 2) }}
                        </div>
                        <div class="user-details">
                            <h4>{{ session('user_name') }}</h4>
                            <p>{{ ucfirst(session('user_role')) }}</p>
                        </div>
                        <form action="/logout" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn" title="Cerrar Sesión">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="main-content">
            
            <!-- Header -->
            <header class="dashboard-header">
                <div class="header-container">
                    
                    <!-- Búsqueda -->
                    <div class="header-search">
                        <div class="search-container">
                            <input type="text" placeholder="Buscar en el sistema..." class="search-input">
                            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Acciones del header -->
                    <div class="header-actions">
                        
                        <!-- Notificaciones -->
                        <button class="notification-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                            </svg>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <!-- Usuario -->
                        <div class="user-menu">
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr(session('user_name'), 0, 2) }}
                                </div>
                                <div class="user-details">
                                    <h4>{{ session('user_name') }}</h4>
                                    <p>{{ ucfirst(session('user_role')) }}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </header>
            
            <!-- Contenido principal -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            
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
            const sidebar = document.querySelector('.dashboard-sidebar');
            const overlay = document.getElementById('mobileOverlay');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                    if (overlay) {
                        overlay.classList.toggle('active');
                    }
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
        });
        
        console.log('🚀 DASHBOARD: Sistema cargado correctamente');
    </script>
    
    <!-- Scripts específicos de la página -->
    @stack('scripts')
</body>
</html>