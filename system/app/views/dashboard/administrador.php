<?php
/**
 * Dashboard Administrativo - PRIMERO DE JUNIO
 * Sistema de gestión de mototaxis
 */

// Validar que el usuario esté logueado
if (!Auth::check()) {
    header('Location: /PrimeroDeJunio/system/public/index.php/auth/login');
    exit;
}

// Obtener datos del usuario actual
$usuario_actual = Auth::user();
$current_page = 'dashboard';

// Datos para JavaScript
$userData = [
    'name' => $usuario_actual['nombre'],
    'role' => $usuario_actual['rol'],
    'avatar' => strtoupper(substr($usuario_actual['nombre'], 0, 1))
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Primero de Junio</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Estilos optimizados del Sistema -->
    <link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/header.css">
    <link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/footer.css">
    
    <style>
        /* Contenido específico del dashboard */
        .dashboard-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 30px;
            min-height: calc(100vh - var(--header-height));
            transition: var(--transition-smooth);
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-family: var(--font-headings);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dashboard-subtitle {
            color: var(--gray-light);
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        /* Tarjetas de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 102, 0.2);
            border-radius: var(--border-radius-large);
            padding: 24px;
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
            background: var(--gradient-primary);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            background: rgba(0, 255, 102, 0.1);
            box-shadow: 0 8px 25px rgba(0, 255, 102, 0.2);
            border-color: var(--primary-green);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 20px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--gray-medium);
            font-size: 14px;
            margin-bottom: 12px;
        }

        .stat-change {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .stat-change.positive {
            background: rgba(0, 255, 102, 0.1);
            color: var(--primary-green);
        }

        .stat-change.negative {
            background: rgba(255, 68, 68, 0.1);
            color: #ff4444;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-content {
                margin-left: 0;
                padding: 20px 15px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .dashboard-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include_once __DIR__ . '/../layouts/header.php'; ?>
    
    <!-- Sidebar -->
    <?php include_once __DIR__ . '/../layouts/sidebar.php'; ?>
    
    <!-- Contenido Principal del Dashboard -->
    <main class="dashboard-content">
        <!-- Header del Dashboard -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Dashboard Administrativo</h1>
            <p class="dashboard-subtitle">Bienvenido, <?php echo htmlspecialchars($usuario_actual['nombre']); ?>. Aquí tienes el resumen de tu sistema.</p>
        </div>

        <!-- Estadísticas principales -->
        <div class="stats-grid">
            <!-- Total Usuarios -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-number">156</div>
                <div class="stat-label">Total Usuarios</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +12.5%
                </div>
            </div>

            <!-- Total Vehículos -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                </div>
                <div class="stat-number">89</div>
                <div class="stat-label">Vehículos Activos</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +8.3%
                </div>
            </div>

            <!-- Viajes Hoy -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-route"></i>
                    </div>
                </div>
                <div class="stat-number">234</div>
                <div class="stat-label">Viajes Hoy</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +15.7%
                </div>
            </div>

            <!-- Ingresos -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="stat-number">$2,450</div>
                <div class="stat-label">Ingresos Hoy</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i>
                    -5.2%
                </div>
            </div>

            <!-- Conductores Online -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="stat-number">45</div>
                <div class="stat-label">Conductores Online</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +20.1%
                </div>
            </div>

            <!-- Mantenimientos -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                </div>
                <div class="stat-number">12</div>
                <div class="stat-label">Mantenimientos Pendientes</div>
                <div class="stat-change negative">
                    <i class="fas fa-arrow-down"></i>
                    -3.1%
                </div>
            </div>
        </div>

        <!-- Contenido adicional aquí -->
        <div style="min-height: 200px; display: flex; align-items: center; justify-content: center; color: var(--gray-medium);">
            <i class="fas fa-chart-bar" style="font-size: 48px; margin-right: 20px; color: var(--primary-green);"></i>
            <div>
                <h3>Gráficos y reportes próximamente</h3>
                <p>Esta sección contendrá gráficos detallados y reportes del sistema.</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../layouts/footer.php'; ?>

    <!-- JavaScript optimizado del Sistema -->
    <script>
        // Pasar datos del usuario a JavaScript
        window.userData = <?php echo json_encode($userData); ?>;
    </script>
    <script src="/PrimeroDeJunio/system/public/assets/js/header.js"></script>
    <script src="/PrimeroDeJunio/system/public/assets/js/sidebar.js"></script>
    <script src="/PrimeroDeJunio/system/public/assets/js/footer.js"></script>
</body>
</html>