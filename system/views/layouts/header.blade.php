{{-- Header del Sistema - Asociación 1ro de Junio --}}
<header class="dashboard-header">
    <div class="header-title">
        <h1>1RO DE JUNIO</h1>
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
        </div>

        <!-- Usuario -->
        <div class="header-user-info">
            <span class="user-name">{{ Auth::user()->name ?? 'Usuario' }}</span>
            <span class="user-role">{{ Auth::user()->role ?? 'Administrador' }}</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout" title="Cerrar Sesión" style="background:none; border:none; color:inherit; cursor:pointer;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>