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

    <header class="header" id="systemHeader">
        <div class="header-wrapper">
            <div class="header-container">

                <!-- Logo Profesional -->
                <div class="logo-container">
                    <img src="/PrimeroDeJunio/system/public/assets/images/logoMoto.jpg"
                        alt="Primero de Junio"
                        class="logo-image">
                    <div class="logo-text-container">
                        <span class="logo-text">1RO. DE JUNIO</span>
                        <span class="logo-tagline">Sistema de Gestión</span>
                    </div>
                </div>

                <!-- Toggle Menu Sidebar (móvil) -->
                <button class="menu-toggle" id="menuToggle" aria-label="Menú">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Búsqueda del Sistema -->
                <div class="search-container">
                    <div class="search-input-wrapper">
                        <i class="search-icon fas fa-search"></i>
                        <input type="text"
                            class="search-input"
                            id="searchInput"
                            placeholder="Buscar usuarios, vehículos, viajes..."
                            autocomplete="off">
                    </div>
                    
                    <!-- Resultados de búsqueda -->
                    <div class="search-results" id="searchResults">
                        <div class="search-results-content">
                            <!-- Los resultados se cargarán aquí dinámicamente -->
                        </div>
                    </div>
                </div>

                <!-- Acciones del Header -->
                <div class="header-actions">

                <!-- Acciones del Header -->
                <div class="header-actions">

                    <!-- Notificaciones -->
                    <div class="notification-dropdown">
                        <button class="notification-btn" id="notificationBtn" aria-label="Notificaciones">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge" id="notificationBadge">3</span>
                        </button>

                        <!-- Dropdown de notificaciones -->
                        <div class="dropdown-menu notification-menu" id="notificationMenu">
                            <div class="dropdown-header">
                                <h3>Notificaciones</h3>
                                <button class="mark-all-read" id="markAllRead">
                                    <i class="fas fa-check-double"></i>
                                </button>
                            </div>

                            <div class="dropdown-content">
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

                            <div class="dropdown-footer">
                                <a href="/PrimeroDeJunio/system/public/index.php/admin/notificaciones" class="view-all">
                                    Ver todas las notificaciones
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Perfil de Usuario -->
                    <div class="user-dropdown">
                        <button class="user-btn" id="userBtn" aria-label="Perfil de usuario">
                            <div class="user-avatar">
                                <?php 
                                $nombre_usuario = $usuario_actual['nombre'] ?? 'Usuario';
                                echo strtoupper(substr($nombre_usuario, 0, 1));
                                ?>
                            </div>
                            <div class="user-info">
                                <span class="user-name"><?= htmlspecialchars($nombre_usuario) ?></span>
                                <span class="user-role"><?= htmlspecialchars($usuario_rol) ?></span>
                            </div>
                            <i class="dropdown-arrow fas fa-chevron-down"></i>
                        </button>

                        <!-- Dropdown del perfil -->
                        <div class="dropdown-menu user-menu" id="userMenu">
                            <div class="dropdown-header">
                                <div class="user-profile-info">
                                    <div class="user-avatar-large">
                                        <?= strtoupper(substr($nombre_usuario, 0, 1)) ?>
                                    </div>
                                    <div class="user-details">
                                        <span class="user-name-large"><?= htmlspecialchars($nombre_usuario) ?></span>
                                        <span class="user-email"><?= htmlspecialchars($usuario_actual['email'] ?? 'usuario@example.com') ?></span>
                                        <span class="user-role-badge"><?= htmlspecialchars($usuario_rol) ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-content">
                                <a href="/PrimeroDeJunio/system/public/index.php/admin/perfil" class="dropdown-item">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Mi Perfil</span>
                                </a>

                                <a href="/PrimeroDeJunio/system/public/index.php/admin/configuracion" class="dropdown-item">
                                    <i class="fas fa-cog"></i>
                                    <span>Configuración</span>
                                </a>

                                <a href="/PrimeroDeJunio/system/public/index.php/admin/preferencias" class="dropdown-item">
                                    <i class="fas fa-sliders-h"></i>
                                    <span>Preferencias</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <a href="/PrimeroDeJunio/system/public/index.php/auth/logout" class="dropdown-item logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Cerrar Sesión</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Indicador de progreso -->
        <div class="loading-bar" id="loadingBar"></div>
    </header>

    <script src="/PrimeroDeJunio/system/public/assets/js/header.js"></script>

<?php } // Fin del if HEADER_INCLUDED 
?>