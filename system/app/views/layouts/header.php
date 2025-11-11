<header class="header">
    <div class="header-container">
        <!-- Logo -->
        <a href="/system/dashboard" class="logo-container">
            <i class="fas fa-car-side" style="font-size: 2rem; color: var(--primary-green);"></i>
            <div>
                <div class="logo-text">Primero de Junio</div>
                <div class="logo-tagline">Sistema de Gestión</div>
            </div>
        </a>
        
        <!-- Botón menú móvil -->
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Menú de usuario -->
        <div class="user-menu">
            <!-- Notificaciones -->
            <div class="dropdown">
                <button class="btn btn-ghost" data-tooltip="Notificaciones">
                    <i class="fas fa-bell"></i>
                    <?php if (isset($_SESSION['unread_notifications']) && $_SESSION['unread_notifications'] > 0): ?>
                        <span class="badge badge-danger" style="position: absolute; top: -5px; right: -5px; min-width: 18px; height: 18px; border-radius: 50%; font-size: 0.7rem; padding: 0;">
                            <?= $_SESSION['unread_notifications'] ?>
                        </span>
                    <?php endif; ?>
                </button>
            </div>
            
            <!-- Información del usuario -->
            <div class="user-info">
                <div class="user-avatar">
                    <?= strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1)) ?>
                </div>
                <div class="user-details">
                    <div class="user-name"><?= $_SESSION['user_name'] ?? 'Usuario' ?></div>
                    <div class="user-role" style="font-size: 0.8rem; color: var(--gray-medium);">
                        <?= $_SESSION['user_role'] ?? 'Rol' ?>
                    </div>
                </div>
            </div>
            
            <!-- Dropdown del usuario -->
            <div class="dropdown">
                <button class="btn btn-ghost dropdown-toggle" data-tooltip="Opciones de usuario">
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="/system/perfil" class="dropdown-item">
                        <i class="fas fa-user"></i>
                        Mi Perfil
                    </a>
                    <a href="/system/configuracion" class="dropdown-item">
                        <i class="fas fa-cog"></i>
                        Configuración
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/system/auth/logout" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Estilos para el dropdown del header -->
<style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--dark-secondary);
    border: 1px solid rgba(0, 255, 102, 0.2);
    border-radius: var(--border-radius);
    min-width: 200px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: var(--transition-fast);
    z-index: 1000;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
}

.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    color: var(--white);
    text-decoration: none;
    transition: var(--transition-fast);
    font-size: 0.9rem;
}

.dropdown-item:hover {
    background: rgba(0, 255, 102, 0.1);
    color: var(--primary-green);
}

.dropdown-item.text-danger:hover {
    background: rgba(220, 38, 38, 0.1);
    color: #dc2626;
}

.dropdown-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
    margin: 0.5rem 0;
}

.user-details {
    text-align: right;
}

.user-name {
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--white);
}

@media (max-width: 1024px) {
    .user-details {
        display: none;
    }
    
    .user-menu {
        gap: 0.5rem;
    }
}
</style>