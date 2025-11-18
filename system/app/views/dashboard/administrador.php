<?php
/**
 * Dashboard Administrativo - PRIMERO DE JUNIO
 * Sistema de gestión de mototaxis con diseño moderno
 */

// Validar que el usuario esté logueado
if (!Auth::check()) {
    header('Location: /PrimeroDeJunio/system/public/index.php/auth/login');
    exit;
}

// Obtener datos del usuario actual
$usuario_actual = Auth::user();
$current_page = 'dashboard';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Primero de Junio</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Estilos del Sistema -->
    <link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/header.css">
    <link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/footer.css">
    <link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/dashboard.css">
    
    <style>
        /* Reset y variables globales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-green: #00ff66;
            --primary-green-dark: #00cc52;
            --bg-dark: #000000;
            --bg-dark-secondary: #0a0a0a;
            --bg-dark-tertiary: #1a1a1a;
            --white: #ffffff;
            --gray-light: #e5e5e5;
            --gray-medium: #999999;
            --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            color: var(--white);
            min-height: 100vh;
            overflow-x: hidden;
            padding-top: 80px; /* Espacio para header fijo */
        }

        /* Layout principal del dashboard */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: calc(100vh - 80px);
            transition: var(--transition-fast);
        }

        .main-content {
            padding: 2rem;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            overflow-y: auto;
        }

        /* Área de contenido del dashboard */
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-green) 0%, #00ff88 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dashboard-subtitle {
            color: var(--gray-light);
            font-size: 1.1rem;
            font-weight: 400;
        }

        /* Tarjetas de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 2rem;
            transition: var(--transition-fast);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, var(--primary-green) 0%, #00ff88 100%);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 40px rgba(0, 255, 102, 0.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-green) 0%, #00ff88 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--bg-dark);
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-label {
            color: var(--gray-light);
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .stat-change {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-change.positive {
            color: var(--primary-green);
        }

        .stat-change.negative {
            color: #ff6b6b;
        }

        /* Secciones del dashboard */
        .dashboard-sections {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .section-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-green) 0%, #00ff88 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bg-dark);
        }

        /* Acciones rápidas */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .action-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            text-decoration: none;
            color: var(--white);
            transition: var(--transition-fast);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            text-align: center;
        }

        .action-btn:hover {
            background: rgba(0, 255, 102, 0.1);
            border-color: var(--primary-green);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 255, 102, 0.3);
        }

        .action-btn i {
            font-size: 2rem;
            color: var(--primary-green);
        }

        .action-btn span {
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }
            
            .dashboard-sections {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .dashboard-title {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    
    <!-- Header del Sistema -->
    <?php include_once __DIR__ . '/../layouts/header.php'; ?>
    
    <!-- Layout principal -->
    <div class="dashboard-layout">
        
        <!-- Sidebar -->
        <?php include_once __DIR__ . '/../layouts/sidebar.php'; ?>
        
        <!-- Contenido Principal -->
        <main class="main-content">
            <div class="dashboard-container">
                
                <!-- Header del Dashboard -->
                <header class="dashboard-header">
                    <h1 class="dashboard-title">Dashboard Administrativo</h1>
                    <p class="dashboard-subtitle">Bienvenido al sistema de gestión de mototaxis Primero de Junio</p>
                </header>

                <!-- Tarjetas de Estadísticas -->
                <section class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">150</div>
                        <div class="stat-label">Conductores Activos</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +12% este mes
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                        <div class="stat-number">89</div>
                        <div class="stat-label">Vehículos en Servicio</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +5% este mes
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <div class="stat-number">1,234</div>
                        <div class="stat-label">Viajes Hoy</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +8% vs ayer
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-number">$45,890</div>
                        <div class="stat-label">Ingresos del Mes</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +15% este mes
                        </div>
                    </div>
                </section>

                <!-- Acciones Rápidas -->
                <section class="quick-actions">
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/conductores/nuevo" class="action-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>Nuevo Conductor</span>
                    </a>
                    
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/vehiculos/nuevo" class="action-btn">
                        <i class="fas fa-car"></i>
                        <span>Registrar Vehículo</span>
                    </a>
                    
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/viajes" class="action-btn">
                        <i class="fas fa-route"></i>
                        <span>Ver Viajes</span>
                    </a>
                    
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/reportes" class="action-btn">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reportes</span>
                    </a>
                    
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/configuracion" class="action-btn">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                    
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/usuarios" class="action-btn">
                        <i class="fas fa-users-cog"></i>
                        <span>Gestionar Usuarios</span>
                    </a>
                </section>

                <!-- Secciones del Dashboard -->
                <div class="dashboard-sections">
                    
                    <!-- Viajes Recientes -->
                    <div class="section-card">
                        <h2 class="section-title">
                            <div class="section-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            Viajes Recientes
                        </h2>
                        
                        <div class="recent-trips">
                            <!-- Aquí se cargarían los viajes recientes -->
                            <p style="color: var(--gray-light); text-align: center; padding: 2rem;">
                                <i class="fas fa-info-circle"></i>
                                Los viajes recientes se mostrarán aquí
                            </p>
                        </div>
                    </div>

                    <!-- Notificaciones y Alertas -->
                    <div class="section-card">
                        <h2 class="section-title">
                            <div class="section-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            Notificaciones
                        </h2>
                        
                        <div class="notifications">
                            <!-- Aquí se cargarían las notificaciones -->
                            <p style="color: var(--gray-light); text-align: center; padding: 2rem;">
                                <i class="fas fa-check-circle"></i>
                                No hay notificaciones nuevas
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
    </div>

    <!-- Footer del Sistema -->
    <?php include_once __DIR__ . '/../layouts/footer.php'; ?>
    
    <!-- Scripts -->
    <script src="/PrimeroDeJunio/system/public/assets/js/header.js"></script>
    <script src="/PrimeroDeJunio/system/public/assets/js/sidebar.js"></script>
    <script src="/PrimeroDeJunio/system/public/assets/js/footer.js"></script>
    
    <script>
        // Inicialización específica del dashboard
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard administrativo cargado correctamente');
            
            // Cargar datos dinámicos
            loadDashboardData();
        });

        function loadDashboardData() {
            // Aquí se cargarían los datos reales del dashboard
            // Por ahora solo mostramos un mensaje de carga
            setTimeout(() => {
                console.log('Datos del dashboard cargados');
            }, 1000);
        }
    </script>
</body>
</html>
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .menu-item {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            color: #333;
        }

        .menu-icon {
            font-size: 1.5em;
            margin-bottom: 10px;
            display: block;
        }

        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9em;
        }

        .logout-btn:hover {
            background: #c82333;
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <a href="/PrimeroDeJunio/system/app/auth/login.php?logout=1" class="logout-btn">🚪 Cerrar Sesión</a>

    <div class="container">
        <div class="header">
            <h1>🏍️ Dashboard Administrativo</h1>
            <div class="user-info">
                <strong>👤 Bienvenido:</strong>
                <?= htmlspecialchars($usuario_actual['nombre'] ?? 'Administrador') ?>
                <strong>📧</strong> <?= htmlspecialchars($usuario_actual['email'] ?? 'admin@primero1dejunio.com') ?>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <span class="card-icon">👥</span>
                <div class="card-number">5</div>
                <div class="card-label">Usuarios Totales</div>
            </div>

            <div class="card">
                <span class="card-icon">🏍️</span>
                <div class="card-number">12</div>
                <div class="card-label">Conductores Activos</div>
            </div>

            <div class="card">
                <span class="card-icon">🚗</span>
                <div class="card-number">8</div>
                <div class="card-label">Vehículos Registrados</div>
            </div>

            <div class="card">
                <span class="card-icon">📋</span>
                <div class="card-number">25</div>
                <div class="card-label">Viajes Hoy</div>
            </div>
        </div>

        <h2 style="color: white; margin-bottom: 20px;">📋 Gestión del Sistema</h2>
        <div class="menu-grid">
            <a href="/PrimeroDeJunio/system/public/index.php/admin/usuarios" class="menu-item">
                <span class="menu-icon">👥</span>
                <strong>Gestión de Usuarios</strong><br>
                <small>Crear, editar y gestionar usuarios</small>
            </a>

            <a href="/PrimeroDeJunio/system/public/index.php/admin/conductores" class="menu-item">
                <span class="menu-icon">🏍️</span>
                <strong>Gestión de Conductores</strong><br>
                <small>Administrar conductores y licencias</small>
            </a>

            <a href="/PrimeroDeJunio/system/public/index.php/admin/vehiculos" class="menu-item">
                <span class="menu-icon">🚗</span>
                <strong>Gestión de Vehículos</strong><br>
                <small>Registro y mantenimiento de motos</small>
            </a>

            <a href="/PrimeroDeJunio/system/public/index.php/admin/viajes" class="menu-item">
                <span class="menu-icon">📋</span>
                <strong>Gestión de Viajes</strong><br>
                <small>Historial y seguimiento de viajes</small>
            </a>

            <a href="/PrimeroDeJunio/system/public/index.php/admin/clientes" class="menu-item">
                <span class="menu-icon">👤</span>
                <strong>Gestión de Clientes</strong><br>
                <small>Base de datos de clientes</small>
            </a>

            <a href="/PrimeroDeJunio/system/public/index.php/admin/reportes" class="menu-item">
                <span class="menu-icon">📊</span>
                <strong>Reportes</strong><br>
                <small>Estadísticas e informes del sistema</small>
            </a>

            <a href="/PrimeroDeJunio/system/public/index.php/admin/configuracion" class="menu-item">
                <span class="menu-icon">⚙️</span>
                <strong>Configuración</strong><br>
                <small>Ajustes del sistema y preferencias</small>
            </a>

            <a href="/PrimeroDeJunio/system/public/index.php/admin/permisos" class="menu-item">
                <span class="menu-icon">🔐</span>
                <strong>Roles y Permisos</strong><br>
                <small>Gestión de accesos y permisos</small>
            </a>
        </div>

        <div style="text-align: center; margin-top: 40px; color: rgba(255,255,255,0.8);">
            <p>Sistema de Gestión Mototaxis "Primero de Junio" v1.0</p>
            <p>© 2025 - Panel de Administración</p>
        </div>
    </div>
</body>

</html>
<div class="stats-card" data-clickable="true" data-url="/admin/usuarios">
    <div class="stats-icon">
        <i class="fas fa-users"></i>
    </div>
    <div class="stats-value">156</div>
    <div class="stats-label">Usuarios Activos</div>
    <div class="stats-change positive">
        <i class="fas fa-arrow-up"></i>
        +12%
    </div>
</div>

<div class="stats-card" data-clickable="true" data-url="/admin/viajes">
    <div class="stats-icon">
        <i class="fas fa-route"></i>
    </div>
    <div class="stats-value">1247</div>
    <div class="stats-label">Viajes Completados</div>
    <div class="stats-change positive">
        <i class="fas fa-arrow-up"></i>
        +8%
    </div>
</div>

<div class="stats-card" data-clickable="true" data-url="/admin/vehiculos">
    <div class="stats-icon">
        <i class="fas fa-motorcycle"></i>
    </div>
    <div class="stats-value">89</div>
    <div class="stats-label">Vehículos Registrados</div>
    <div class="stats-change positive">
        <i class="fas fa-arrow-up"></i>
        +5%
    </div>
</div>

<div class="stats-card" data-clickable="true" data-url="/admin/ingresos">
    <div class="stats-icon">
        <i class="fas fa-dollar-sign"></i>
    </div>
    <div class="stats-value">$25680</div>
    <div class="stats-label">Ingresos del Mes</div>
    <div class="stats-change positive">
        <i class="fas fa-arrow-up"></i>
        +15%
    </div>
</div>
</div>

<!-- Panel de Gestión Rápida -->
<div class="row">
    <div class="col-lg-8">
        <div class="system-card">
            <div class="system-card-header">
                <h3 class="system-card-title">
                    <i class="fas fa-chart-line"></i>
                    Resumen de Actividad
                </h3>
                <span class="system-card-badge">Tiempo Real</span>
            </div>
            <div class="system-card-content">
                <div class="activity-summary">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Nuevos Conductores</h4>
                            <p>3 conductores registrados hoy</p>
                            <small>Último: hace 2 horas</small>
                        </div>
                        <div class="activity-action">
                            <a href="/admin/conductores" class="btn-outline btn-sm">Ver Todos</a>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Alertas Pendientes</h4>
                            <p>5 vehículos requieren mantenimiento</p>
                            <small>Urgente: 2 casos</small>
                        </div>
                        <div class="activity-action">
                            <a href="/admin/mantenimiento" class="btn-danger btn-sm">Revisar</a>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Reporte Diario</h4>
                            <p>87 viajes completados hoy</p>
                            <small>Eficiencia: 94%</small>
                        </div>
                        <div class="activity-action">
                            <a href="/admin/reportes" class="btn-primary btn-sm">Ver Reporte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="system-card">
            <div class="system-card-header">
                <h3 class="system-card-title">
                    <i class="fas fa-clock"></i>
                    Acciones Rápidas
                </h3>
            </div>
            <div class="system-card-content">
                <div class="quick-actions">
                    <a href="/admin/usuarios/nuevo" class="quick-action-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>Nuevo Usuario</span>
                    </a>

                    <a href="/admin/conductores/nuevo" class="quick-action-btn">
                        <i class="fas fa-id-card"></i>
                        <span>Registrar Conductor</span>
                    </a>

                    <a href="/admin/vehiculos/nuevo" class="quick-action-btn">
                        <i class="fas fa-motorcycle"></i>
                        <span>Nuevo Vehículo</span>
                    </a>

                    <a href="/admin/tarifas" class="quick-action-btn">
                        <i class="fas fa-tags"></i>
                        <span>Gestionar Tarifas</span>
                    </a>

                    <a href="/admin/configuracion" class="quick-action-btn">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>

                    <a href="/admin/reportes/generar" class="quick-action-btn">
                        <i class="fas fa-file-download"></i>
                        <span>Generar Reporte</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="system-card">
            <div class="system-card-header">
                <h3 class="system-card-title">
                    <i class="fas fa-bell"></i>
                    Notificaciones
                </h3>
                <span class="system-card-badge">5 Nuevas</span>
            </div>
            <div class="system-card-content">
                <div class="notifications-list">
                    <div class="notification-item">
                        <div class="notification-icon success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="notification-content">
                            <p>Pago procesado exitosamente</p>
                            <small>hace 10 minutos</small>
                        </div>
                    </div>

                    <div class="notification-item">
                        <div class="notification-icon warning">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <div class="notification-content">
                            <p>Vehículo requiere mantenimiento</p>
                            <small>hace 1 hora</small>
                        </div>
                    </div>

                    <div class="notification-item">
                        <div class="notification-icon info">
                            <i class="fas fa-info"></i>
                        </div>
                        <div class="notification-content">
                            <p>Nuevo conductor registrado</p>
                            <small>hace 2 horas</small>
                        </div>
                    </div>
                </div>

                <div class="notifications-footer">
                    <a href="/admin/notificaciones" class="btn-outline btn-sm btn-block">
                        Ver Todas las Notificaciones
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Información del Sistema -->
<div class="row">
    <div class="col-12">
        <div class="system-card">
            <div class="system-card-header">
                <h3 class="system-card-title">
                    <i class="fas fa-info-circle"></i>
                    Estado del Sistema
                </h3>
                <span class="system-card-badge">Online</span>
            </div>
            <div class="system-card-content">
                <div class="system-status-grid">
                    <div class="status-item">
                        <div class="status-indicator online"></div>
                        <span class="status-label">Base de Datos</span>
                        <span class="status-value">Conectada</span>
                    </div>

                    <div class="status-item">
                        <div class="status-indicator online"></div>
                        <span class="status-label">Servidor</span>
                        <span class="status-value">Funcionando</span>
                    </div>

                    <div class="status-item">
                        <div class="status-indicator online"></div>
                        <span class="status-label">API</span>
                        <span class="status-value">Disponible</span>
                    </div>

                    <div class="status-item">
                        <div class="status-indicator warning"></div>
                        <span class="status-label">Backups</span>
                        <span class="status-value">Pendiente</span>
                    </div>
                </div>
            </div>
            <div class="system-card-footer">
                <small class="text-muted">
                    <i class="fas fa-clock"></i>
                    Última actualización: <?= date('d/m/Y H:i:s') ?>
                </small>
                <a href="/admin/sistema/diagnostico" class="btn-outline btn-sm">
                    Diagnóstico Completo
                </a>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Actualizar reloj
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('es-CO', {
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
        }

        setInterval(updateTime, 1000);

        // Animar números de estadísticas
        const animateNumbers = () => {
            const numbers = document.querySelectorAll('[data-target]');

            numbers.forEach(number => {
                const target = parseInt(number.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (target > 1000000) {
                        number.textContent = (current / 1000000).toFixed(1) + 'M';
                    } else if (target > 1000) {
                        number.textContent = Math.floor(current).toLocaleString();
                    } else {
                        number.textContent = Math.floor(current);
                    }

                    if (current >= target) {
                        if (target > 1000000) {
                            number.textContent = (target / 1000000).toFixed(1) + 'M';
                        } else {
                            number.textContent = target.toLocaleString();
                        }
                        clearInterval(timer);
                    }
                }, 20);
            });
        };

        // Iniciar animaciones con delay
        setTimeout(animateNumbers, 500);

        // Gráfico de ingresos (Chart.js)
        const ctx = document.getElementById('incomeChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                    datasets: [{
                        label: 'Ingresos',
                        data: [320000, 450000, 380000, 520000, 670000, 800000, 650000],
                        borderColor: '#00ff66',
                        backgroundColor: 'rgba(0, 255, 102, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#888',
                                callback: function(value) {
                                    return '$' + (value / 1000) + 'K';
                                }
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#888'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            }
                        }
                    }
                }
            });
        }
    });
</script>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
$content = ob_get_clean();
include '../layouts/main.php';
?>