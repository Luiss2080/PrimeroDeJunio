<?php
/**
 * Header del Sistema - PRIMERO DE JUNIO
 * Componente independiente de header moderno
 */

// Solo incluir si no está ya incluido
if (!defined('HEADER_INCLUDED')) {
    define('HEADER_INCLUDED', true);
    
    // Incluir Font Awesome
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">';
    
    // Incluir estilos CSS del header
    echo '<link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/header.css">';
    
    // Obtener usuario actual
    $usuario_actual = Auth::user();
    $usuario_rol = $usuario_actual['rol_nombre'] ?? 'Usuario';
?>

<header class="system-header" id="systemHeader">
    <div class="header-wrapper">
        <div class="header-container">
            
            <!-- Logo y Marca -->
            <div class="header-brand">
                <img src="/PrimeroDeJunio/system/public/assets/images/logoMoto.jpg" 
                     alt="Primero de Junio" 
                     class="header-logo-image">
                <div class="header-logo-text">
                    <span class="header-logo-main">Primero de Junio</span>
                    <span class="header-logo-sub">Sistema de Gestión</span>
                </div>
            </div>

            <!-- Controles del Header -->
            <div class="header-controls">
                
                <!-- Botón Menu Sidebar (móvil) -->
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Abrir menú">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>

                <!-- Búsqueda -->
                <div class="header-search">
                    <form class="search-form" id="headerSearchForm">
                        <div class="search-input-wrapper">
                            <input type="text" 
                                   class="search-input" 
                                   id="headerSearchInput"
                                   placeholder="Buscar en el sistema..."
                                   autocomplete="off">
                            <button type="submit" class="search-button" aria-label="Buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Resultados de búsqueda -->
                    <div class="search-results" id="searchResults" style="display: none;">
                        <div class="search-results-content">
                            <div class="search-loading">
                                <i class="fas fa-spinner fa-spin"></i>
                                <span>Buscando...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones del Header -->
                <div class="header-actions">
                    
                    <!-- Notificaciones -->
                    <div class="header-notifications">
                        <button class="notifications-toggle" id="notificationsToggle" aria-label="Notificaciones">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge" id="notificationBadge">3</span>
                        </button>
                        
                        <!-- Dropdown de notificaciones -->
                        <div class="notifications-dropdown" id="notificationsDropdown">
                            <div class="notifications-header">
                                <h3>Notificaciones</h3>
                                <button class="mark-all-read" id="markAllRead">
                                    <i class="fas fa-check-double"></i>
                                    Marcar todas como leídas
                                </button>
                            </div>
                            
                            <div class="notifications-list">
                                <div class="notification-item unread">
                                    <div class="notification-icon">
                                        <i class="fas fa-route"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">Nuevo viaje registrado</div>
                                        <div class="notification-text">Juan Pérez ha registrado un nuevo viaje</div>
                                        <div class="notification-time">Hace 5 minutos</div>
                                    </div>
                                </div>
                                
                                <div class="notification-item unread">
                                    <div class="notification-icon">
                                        <i class="fas fa-car"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">Mantenimiento pendiente</div>
                                        <div class="notification-text">Vehículo ABC-123 requiere mantenimiento</div>
                                        <div class="notification-time">Hace 1 hora</div>
                                    </div>
                                </div>
                                
                                <div class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">Nuevo conductor registrado</div>
                                        <div class="notification-text">María García se ha registrado como conductora</div>
                                        <div class="notification-time">Hace 2 horas</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="notifications-footer">
                                <a href="/PrimeroDeJunio/system/public/index.php/admin/notificaciones" class="view-all-notifications">
                                    Ver todas las notificaciones
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Perfil de Usuario -->
                    <div class="header-user-profile">
                        <button class="user-profile-toggle" id="userProfileToggle" aria-label="Perfil de usuario">
                            <img src="<?= htmlspecialchars($usuario_actual['avatar'] ?? '/PrimeroDeJunio/system/public/assets/images/default-avatar.png') ?>" 
                                 alt="Avatar" 
                                 class="user-avatar">
                            <div class="user-info">
                                <span class="user-name"><?= htmlspecialchars($usuario_actual['nombre'] ?? 'Usuario') ?></span>
                                <span class="user-role"><?= htmlspecialchars($usuario_rol) ?></span>
                            </div>
                            <i class="fas fa-chevron-down profile-arrow"></i>
                        </button>
                        
                        <!-- Dropdown del perfil -->
                        <div class="user-profile-dropdown" id="userProfileDropdown">
                            <div class="profile-dropdown-header">
                                <div class="profile-user-info">
                                    <img src="<?= htmlspecialchars($usuario_actual['avatar'] ?? '/PrimeroDeJunio/system/public/assets/images/default-avatar.png') ?>" 
                                         alt="Avatar" 
                                         class="profile-avatar-large">
                                    <div class="profile-user-details">
                                        <span class="profile-user-name"><?= htmlspecialchars($usuario_actual['nombre'] ?? 'Usuario') ?></span>
                                        <span class="profile-user-email"><?= htmlspecialchars($usuario_actual['email'] ?? 'usuario@example.com') ?></span>
                                        <span class="profile-user-role"><?= htmlspecialchars($usuario_rol) ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="profile-dropdown-menu">
                                <a href="/PrimeroDeJunio/system/public/index.php/admin/perfil" class="profile-menu-item">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Mi Perfil</span>
                                </a>
                                
                                <a href="/PrimeroDeJunio/system/public/index.php/admin/configuracion" class="profile-menu-item">
                                    <i class="fas fa-cog"></i>
                                    <span>Configuración</span>
                                </a>
                                
                                <a href="/PrimeroDeJunio/system/public/index.php/admin/preferencias" class="profile-menu-item">
                                    <i class="fas fa-sliders-h"></i>
                                    <span>Preferencias</span>
                                </a>
                                
                                <div class="profile-menu-divider"></div>
                                
                                <a href="/PrimeroDeJunio/system/public/index.php/auth/logout" class="profile-menu-item logout-item">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Cerrar Sesión</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Indicador de progreso de carga -->
    <div class="header-loading-bar" id="headerLoadingBar"></div>
</header>

<script src="/PrimeroDeJunio/system/public/assets/js/header.js"></script>

<?php } // Fin del if HEADER_INCLUDED ?>
