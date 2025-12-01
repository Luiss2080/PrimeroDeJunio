<aside class="dashboard-sidebar" id="systemSidebar">
    <!-- Logo del Sidebar -->
    <div class="sidebar-logo">
        <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo Asociación" class="sidebar-logo-image">
        <div class="sidebar-logo-text">
            <span class="sidebar-brand">1RO DE JUNIO</span>
            <span class="sidebar-tagline">Sistema Admin</span>
        </div>
    </div>

    <!-- Navegación Principal -->
    <nav class="sidebar-nav">
        <ul class="nav-menu">
            
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <!-- Sección: Gestión de Personal -->
            <li class="nav-section">
                <span class="section-title">Gestión de Personal</span>
            </li>

            <!-- Conductores -->
            <li class="nav-item">
                <a href="{{ route('conductores.index') }}" class="nav-link {{ request()->routeIs('conductores.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Conductores</span>
                    <span class="nav-badge">4</span>
                </a>
            </li>

            <!-- Usuarios del Sistema -->
            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-4h3v-3h10v3h3v4H4z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Usuarios</span>
                    <span class="nav-badge blue">28</span>
                </a>
            </li>

            <!-- Sección: Flota y Vehículos -->
            <li class="nav-section">
                <span class="section-title">Flota y Vehículos</span>
            </li>

            <!-- Vehículos -->
            <li class="nav-item">
                <a href="{{ route('vehiculos.index') }}" class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Vehículos</span>
                </a>
            </li>

            <!-- Viajes -->
            <li class="nav-item">
                <a href="{{ route('viajes.index') }}" class="nav-link {{ request()->routeIs('viajes.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Viajes</span>
                    <span class="nav-badge green">12</span>
                </a>
            </li>

            <!-- Sección: Administración -->
            <li class="nav-section">
                <span class="section-title">Administración</span>
            </li>

            <!-- Clientes -->
            <li class="nav-item">
                <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2.01.99L12 11l-1.99-2.01A2.5 2.5 0 0 0 8 8H5.46c-.8 0-1.49.59-1.42 1.37L6 16.5V22h2v-6h2v6h8z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Clientes</span>
                </a>
            </li>

            <!-- Tarifas -->
            <li class="nav-item">
                <a href="{{ route('tarifas.index') }}" class="nav-link {{ request()->routeIs('tarifas.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Tarifas</span>
                </a>
            </li>

            <!-- Pagos -->
            <li class="nav-item">
                <a href="{{ route('pagos.index') }}" class="nav-link {{ request()->routeIs('pagos.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Pagos</span>
                </a>
            </li>

            <!-- Sección: Reportes y Análisis -->
            <li class="nav-section">
                <span class="section-title">Reportes</span>
            </li>

            <!-- Reportes -->
            <li class="nav-item has-submenu">
                <a href="#" class="nav-link submenu-toggle">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Reportes</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('reportes.conductores') }}" class="submenu-link {{ request()->routeIs('reportes.conductores') ? 'active' : '' }}">Conductores</a></li>
                    <li><a href="{{ route('reportes.viajes') }}" class="submenu-link {{ request()->routeIs('reportes.viajes') ? 'active' : '' }}">Viajes</a></li>
                    <li><a href="{{ route('reportes.ingresos') }}" class="submenu-link {{ request()->routeIs('reportes.ingresos') ? 'active' : '' }}">Ingresos</a></li>
                </ul>
            </li>

            <!-- Sección: Sistema -->
            <li class="nav-section">
                <span class="section-title">Sistema</span>
            </li>

            <!-- Permisos -->
            <li class="nav-item">
                <a href="{{ route('permisos.index') }}" class="nav-link {{ request()->routeIs('permisos.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
<aside class="dashboard-sidebar" id="systemSidebar">
    <!-- Logo del Sidebar -->
    <div class="sidebar-logo">
        <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo Asociación" class="sidebar-logo-image">
        <div class="sidebar-logo-text">
            <span class="sidebar-brand">1RO DE JUNIO</span>
            <span class="sidebar-tagline">Sistema Admin</span>
        </div>
    </div>

    <!-- Navegación Principal -->
    <nav class="sidebar-nav">
        <ul class="nav-menu">
            
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <!-- Sección: Gestión de Personal -->
            <li class="nav-section">
                <span class="section-title">Gestión de Personal</span>
            </li>

            <!-- Conductores -->
            <li class="nav-item">
                <a href="{{ route('conductores.index') }}" class="nav-link {{ request()->routeIs('conductores.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Conductores</span>
                    <span class="nav-badge">4</span>
                </a>
            </li>

            <!-- Usuarios del Sistema -->
            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-4h3v-3h10v3h3v4H4z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Usuarios</span>
                    <span class="nav-badge blue">28</span>
                </a>
            </li>

            <!-- Sección: Flota y Vehículos -->
            <li class="nav-section">
                <span class="section-title">Flota y Vehículos</span>
            </li>

            <!-- Vehículos -->
            <li class="nav-item">
                <a href="{{ route('vehiculos.index') }}" class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Vehículos</span>
                </a>
            </li>

            <!-- Viajes -->
            <li class="nav-item">
                <a href="{{ route('viajes.index') }}" class="nav-link {{ request()->routeIs('viajes.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Viajes</span>
                    <span class="nav-badge green">12</span>
                </a>
            </li>

            <!-- Sección: Administración -->
            <li class="nav-section">
                <span class="section-title">Administración</span>
            </li>

            <!-- Clientes -->
            <li class="nav-item">
                <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2.01.99L12 11l-1.99-2.01A2.5 2.5 0 0 0 8 8H5.46c-.8 0-1.49.59-1.42 1.37L6 16.5V22h2v-6h2v6h8z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Clientes</span>
                </a>
            </li>

            <!-- Tarifas -->
            <li class="nav-item">
                <a href="{{ route('tarifas.index') }}" class="nav-link {{ request()->routeIs('tarifas.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Tarifas</span>
                </a>
            </li>

            <!-- Pagos -->
            <li class="nav-item">
                <a href="{{ route('pagos.index') }}" class="nav-link {{ request()->routeIs('pagos.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Pagos</span>
                </a>
            </li>

            <!-- Sección: Reportes y Análisis -->
            <li class="nav-section">
                <span class="section-title">Reportes</span>
            </li>

            <!-- Reportes -->
            <li class="nav-item has-submenu">
                <a href="#" class="nav-link submenu-toggle">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Reportes</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('reportes.conductores') }}" class="submenu-link {{ request()->routeIs('reportes.conductores') ? 'active' : '' }}">
                        <div class="nav-icon-mini">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                            </svg>
                        </div>
                        Conductores
                    </a></li>
                    <li><a href="{{ route('reportes.viajes') }}" class="submenu-link {{ request()->routeIs('reportes.viajes') ? 'active' : '' }}">
                        <div class="nav-icon-mini">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        Viajes
                    </a></li>
                    <li><a href="{{ route('reportes.ingresos') }}" class="submenu-link {{ request()->routeIs('reportes.ingresos') ? 'active' : '' }}">
                        <div class="nav-icon-mini">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                            </svg>
                        </div>
                        Ingresos
                    </a></li>
                </ul>
            </li>

            <!-- Sección: Sistema -->
            <li class="nav-section">
                <span class="section-title">Sistema</span>
            </li>

            <!-- Permisos -->
            <li class="nav-item">
                <a href="{{ route('permisos.index') }}" class="nav-link {{ request()->routeIs('permisos.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Permisos</span>
                </a>
            </li>

            <!-- Configuraciones -->
            <li class="nav-item">
                <a href="{{ route('configuraciones.index') }}" class="nav-link {{ request()->routeIs('configuraciones.*') ? 'active' : '' }}">
                    <div class="nav-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                        </svg>
                    </div>
                    <span class="nav-text">Configuración</span>
                </a>
            </li>

        </ul>
    </nav>

    <!-- Footer Action Section -->
    <div class="sidebar-footer">
        <div class="theme-toggle-mini" id="themeToggle">
            <span class="theme-label">Modo Oscuro</span>
            <div class="toggle-switch"></div>
        </div>
    </div>
</aside>


<!-- Incluir CSS del Sidebar -->
<link rel="stylesheet" href="{{ asset('css/components/sidebar.css') }}">
<!-- Incluir JS del Sidebar -->
<script src="{{ asset('js/components/sidebar.js') }}"></script>