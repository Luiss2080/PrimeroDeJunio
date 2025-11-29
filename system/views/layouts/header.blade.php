{{-- Header del Sistema - Asociación 1ro de Junio --}}
<header class="system-header">
    <div class="header-wrapper">
        <div class="header-container">
            
            <!-- Logo del Sistema -->
            <div class="header-logo">
                <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo Asociación" class="logo-image">
                <div class="logo-text-container">
                    <h1 class="logo-text">1RO DE JUNIO</h1>
                    <span class="logo-tagline">Sistema Administrativo</span>
                </div>
            </div>

            <!-- Navegación Principal -->
            <nav class="header-nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('conductores.index') }}" class="nav-link {{ request()->routeIs('conductores.*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                            </svg>
                            <span>Conductores</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vehiculos.index') }}" class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                            </svg>
                            <span>Vehículos</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Barra de Búsqueda -->
            <div class="header-search">
                <div class="search-container">
                    <input type="text" placeholder="Buscar en el sistema..." class="search-input" id="globalSearch">
                    <button class="search-btn" type="button">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Acciones del Header -->
            <div class="header-actions">
                
                <!-- Notificaciones -->
                <div class="notification-container">
                    <button class="notification-btn" id="notificationToggle">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                        </svg>
                        <span class="notification-count">3</span>
                    </button>
                    
                    <!-- Dropdown de Notificaciones -->
                    <div class="dropdown-menu notification-dropdown" id="notificationDropdown">
                        <div class="dropdown-header">
                            <h3>Notificaciones</h3>
                            <span class="notification-count-text">3 nuevas</span>
                        </div>
                        <div class="dropdown-content">
                            <div class="notification-item">
                                <div class="notification-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                                    </svg>
                                </div>
                                <div class="notification-content">
                                    <p>Nuevo conductor registrado</p>
                                    <span>Hace 5 minutos</span>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                                    </svg>
                                </div>
                                <div class="notification-content">
                                    <p>Mantenimiento programado</p>
                                    <span>Hace 15 minutos</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-footer">
                            <a href="#" class="dropdown-link">Ver todas las notificaciones</a>
                        </div>
                    </div>
                </div>

                <!-- Usuario -->
                <div class="user-container">
                    <button class="user-btn" id="userToggle">
                        <img src="{{ asset('images/user-avatar.png') }}" alt="Usuario" class="user-avatar">
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</span>
                            <span class="user-role">{{ Auth::user()->role ?? 'Administrador' }}</span>
                        </div>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </button>
                    
                    <!-- Dropdown de Usuario -->
                    <div class="dropdown-menu user-dropdown" id="userDropdown">
                        <div class="dropdown-header">
                            <div class="user-profile">
                                <img src="{{ asset('images/user-avatar.png') }}" alt="Usuario" class="user-avatar-large">
                                <div class="user-details">
                                    <h3>{{ Auth::user()->name ?? 'Usuario' }}</h3>
                                    <span>{{ Auth::user()->email ?? 'admin@primero1dejunio.com' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-content">
                            <a href="{{ route('perfil.index') }}" class="dropdown-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                                Mi Perfil
                            </a>
                            <a href="{{ route('configuraciones.index') }}" class="dropdown-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                                </svg>
                                Configuración
                            </a>
                            <div class="dropdown-separator"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item logout-item" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                                </svg>
                                Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Botón móvil -->
                <button class="mobile-menu-btn" id="mobileMenuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Formulario oculto para logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</header>

<!-- Incluir CSS del Header -->
<link rel="stylesheet" href="{{ asset('css/components/header.css') }}">

<!-- Incluir JS del Header -->
<script src="{{ asset('js/components/header.js') }}"></script>