{{-- Header del Sistema - Asociación 1ro de Junio --}}
<header class="dashboard-header">
    <!-- Left: Brand & Search -->
    <div class="header-left">
        <div class="header-brand">
            <h1 class="brand-text">1RO DE JUNIO</h1>
        </div>
        <div class="header-search">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" placeholder="Buscar en el sistema..." class="search-input">
        </div>
    </div>

    <!-- Center: Navigation (Desktop) -->
    <div class="header-center">
        <nav class="header-nav">
            <a href="{{ route('dashboard') }}" class="header-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">Inicio</a>
            <a href="{{ route('reportes.index') }}" class="header-link {{ request()->routeIs('reportes.*') ? 'active' : '' }}">Reportes</a>
            <a href="{{ route('contact') }}" class="header-link">Ayuda</a>
        </nav>
    </div>

    <!-- Right: Actions & Profile -->
    <div class="header-right">
        
        <!-- Notificaciones -->
        <div class="notification-wrapper">
            <button class="notification-btn" id="notificationToggle">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                </svg>
                <span class="notification-badge">3</span>
            </button>
        </div>

        <!-- Perfil de Usuario -->
        <div class="user-profile-container">
            <button class="profile-trigger" id="profileDropdownToggle">
                <div class="user-avatar">
                    <span>{{ substr(Auth::user()->name ?? 'U', 0, 1) }}</span>
                </div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</span>
                    <span class="user-role-badge">{{ Auth::user()->role ?? 'Admin' }}</span>
                </div>
                <svg class="dropdown-arrow" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7 10l5 5 5-5z"/>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div class="profile-dropdown" id="profileDropdown">
                <div class="dropdown-header">
                    <span class="dropdown-user-name">{{ Auth::user()->name ?? 'Usuario' }}</span>
                    <span class="dropdown-user-email">{{ Auth::user()->email ?? 'usuario@sistema.com' }}</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Mi Perfil
                </a>
                <a href="{{ route('configuraciones.index') }}" class="dropdown-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    Configuración
                </a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    // Simple script to handle dropdown toggle
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('profileDropdownToggle');
        const dropdown = document.getElementById('profileDropdown');
        
        if(toggle && dropdown) {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('show');
            });
            
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target) && !toggle.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        }
    });
</script>