<?php
/**
 * Sidebar del Sistema - PRIMERO DE JUNIO
 * Componente independiente de sidebar moderno
 */

// Solo incluir si no está ya incluido
if (!defined('SIDEBAR_INCLUDED')) {
    define('SIDEBAR_INCLUDED', true);
    
    // Incluir estilos CSS del sidebar
    echo '<link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/sidebar.css">';
    
    // Obtener usuario actual y permisos
    $usuario_actual = Auth::user();
    $usuario_rol = $usuario_actual['rol_nombre'] ?? 'Usuario';

    // Determinar página actual para navegación activa
    $current_page = $current_page ?? '';
    $current_url = $_SERVER['REQUEST_URI'] ?? '';

    // Configuración del menú según el rol del usuario
    $menu_items = [];

    // Menú para Administradores
    if (in_array($usuario_rol, ['Administrador', 'Super Administrador'])) {
        $menu_items = [
            [
                'icon' => 'fas fa-tachometer-alt',
                'title' => 'Dashboard',
                'url' => '/PrimeroDeJunio/system/public/index.php/admin',
                'key' => 'dashboard',
                'badge' => '',
                'submenu' => []
            ],
            [
                'icon' => 'fas fa-users',
                'title' => 'Usuarios',
                'url' => '/PrimeroDeJunio/system/public/index.php/admin/usuarios',
                'key' => 'usuarios',
                'badge' => '',
                'submenu' => [
                    ['title' => 'Lista de Usuarios', 'url' => '/PrimeroDeJunio/system/public/index.php/admin/usuarios', 'icon' => 'fas fa-list'],
                    ['title' => 'Nuevo Usuario', 'url' => '/PrimeroDeJunio/system/public/index.php/admin/usuarios/nuevo', 'icon' => 'fas fa-plus'],
                    ['title' => 'Roles y Permisos', 'url' => '/PrimeroDeJunio/system/public/index.php/admin/permisos', 'icon' => 'fas fa-shield-alt']
                ]
            ],
            [
                'icon' => 'fas fa-motorcycle',
                'title' => 'Conductores',
                'url' => '/PrimeroDeJunio/system/public/index.php/admin/conductores',
                'key' => 'conductores',
                'badge' => '',
                'submenu' => [
                    ['title' => 'Lista de Conductores', 'url' => '/PrimeroDeJunio/system/public/index.php/admin/conductores', 'icon' => 'fas fa-list'],
                    ['title' => 'Nuevo Conductor', 'url' => '/PrimeroDeJunio/system/public/index.php/admin/conductores/nuevo', 'icon' => 'fas fa-plus']
                ]
            ],
            [
                'icon' => 'fas fa-car',
                'title' => 'Vehículos',
                'url' => '/PrimeroDeJunio/system/public/index.php/admin/vehiculos',
                'key' => 'vehiculos',
                'badge' => '',
                'submenu' => [
                    ['title' => 'Lista de Vehículos', 'url' => '/PrimeroDeJunio/system/public/index.php/admin/vehiculos', 'icon' => 'fas fa-list'],
                    ['title' => 'Nuevo Vehículo', 'url' => '/PrimeroDeJunio/system/public/index.php/admin/vehiculos/nuevo', 'icon' => 'fas fa-plus']
                ]
            ],
            [
                'icon' => 'fas fa-route',
                'title' => 'Viajes',
                'url' => '/PrimeroDeJunio/system/public/index.php/admin/viajes',
                'key' => 'viajes',
                'badge' => '',
                'submenu' => []
            ],
            [
                'icon' => 'fas fa-chart-bar',
                'title' => 'Reportes',
                'url' => '/PrimeroDeJunio/system/public/index.php/admin/reportes',
                'key' => 'reportes',
                'badge' => '',
                'submenu' => []
            ],
            [
                'icon' => 'fas fa-cog',
                'title' => 'Configuración',
                'url' => '/PrimeroDeJunio/system/public/index.php/admin/configuracion',
                'key' => 'configuracion',
                'badge' => '',
                'submenu' => []
            ]
        ];
    } elseif ($usuario_rol === 'Operador') {
        // Menú para Operadores
        $menu_items = [
            [
                'icon' => 'fas fa-tachometer-alt',
                'title' => 'Dashboard',
                'url' => '/PrimeroDeJunio/system/public/index.php/operador',
                'key' => 'dashboard',
                'badge' => '',
                'submenu' => []
            ],
            [
                'icon' => 'fas fa-route',
                'title' => 'Viajes',
                'url' => '/PrimeroDeJunio/system/public/index.php/operador/viajes',
                'key' => 'viajes',
                'badge' => '',
                'submenu' => []
            ],
            [
                'icon' => 'fas fa-users',
                'title' => 'Clientes',
                'url' => '/PrimeroDeJunio/system/public/index.php/operador/clientes',
                'key' => 'clientes',
                'badge' => '',
                'submenu' => []
            ]
        ];
    }

    // Función helper para determinar si un item está activo
    function isActiveMenuItem($item_key, $current_page, $current_url) {
        if ($current_page === $item_key) {
            return true;
        }
        return false;
    }
?>

<aside class="system-sidebar" id="systemSidebar">
    <div class="sidebar-wrapper">
        
        <!-- Header del Sidebar -->
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="/PrimeroDeJunio/system/public/assets/images/logoMoto.jpg" alt="Logo" class="sidebar-logo-image">
                <div class="sidebar-logo-text">
                    <span class="sidebar-logo-main">Primero de Junio</span>
                    <span class="sidebar-logo-sub">Dashboard</span>
                </div>
            </div>
            
            <!-- Botón cerrar sidebar (móvil) -->
            <button class="sidebar-close" id="sidebarClose">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Navegación Principal -->
        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">MENÚ PRINCIPAL</div>
                
                <ul class="nav-list">
                    <?php foreach ($menu_items as $item): ?>
                        <?php 
                        $is_active = isActiveMenuItem($item['key'], $current_page, $current_url);
                        $has_submenu = !empty($item['submenu']);
                        ?>
                        
                        <li class="nav-item <?= $has_submenu ? 'has-submenu' : '' ?> <?= $is_active ? 'active' : '' ?>">
                            <a href="<?= $has_submenu ? 'javascript:void(0)' : htmlspecialchars($item['url']) ?>" 
                               class="nav-link <?= $has_submenu ? 'submenu-toggle' : '' ?>"
                               <?= $has_submenu ? 'data-submenu="' . $item['key'] . '"' : '' ?>>
                                
                                <div class="nav-link-content">
                                    <div class="nav-icon">
                                        <i class="<?= $item['icon'] ?>"></i>
                                    </div>
                                    
                                    <span class="nav-text"><?= htmlspecialchars($item['title']) ?></span>
                                    
                                    <?php if ($item['badge']): ?>
                                        <span class="nav-badge"><?= htmlspecialchars($item['badge']) ?></span>
                                    <?php endif; ?>
                                    
                                    <?php if ($has_submenu): ?>
                                        <i class="fas fa-chevron-down submenu-arrow"></i>
                                    <?php endif; ?>
                                </div>
                            </a>

                            <!-- Submenú -->
                            <?php if ($has_submenu): ?>
                                <ul class="submenu" id="submenu-<?= $item['key'] ?>">
                                    <?php foreach ($item['submenu'] as $subitem): ?>
                                        <li class="submenu-item">
                                            <a href="<?= htmlspecialchars($subitem['url']) ?>" class="submenu-link">
                                                <i class="<?= $subitem['icon'] ?>"></i>
                                                <span><?= htmlspecialchars($subitem['title']) ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>

        <!-- Información del Usuario -->
        <div class="sidebar-user-info">
            <div class="user-card">
                <div class="user-avatar-small">
                    <img src="<?= htmlspecialchars($usuario_actual['avatar'] ?? '/PrimeroDeJunio/system/public/assets/images/default-avatar.png') ?>" alt="Avatar">
                </div>
                
                <div class="user-details-compact">
                    <span class="user-name-small"><?= htmlspecialchars($usuario_actual['nombre'] ?? 'Usuario') ?></span>
                    <span class="user-role-small"><?= htmlspecialchars($usuario_rol) ?></span>
                </div>
                
                <div class="user-actions-small">
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/perfil" class="user-action-btn" title="Perfil">
                        <i class="fas fa-user-cog"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer del Sidebar -->
        <div class="sidebar-footer">
            <div class="sidebar-version">
                <span class="version-label">Sistema v1.0</span>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay para sidebar en móvil -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script src="/PrimeroDeJunio/system/public/assets/js/sidebar.js"></script>

<?php } // Fin del if SIDEBAR_INCLUDED ?>