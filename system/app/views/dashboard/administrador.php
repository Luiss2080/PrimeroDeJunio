<?php

/**
 * Dashboard Administrativo - Simple
 * Sistema PRIMERO DE JUNIO
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Primero de Junio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .user-info {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .card-icon {
            font-size: 2em;
            margin-bottom: 15px;
            display: block;
        }

        .card-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
        }

        .card-label {
            color: #666;
            font-size: 0.9em;
        }

        .menu-grid {
            display: grid;
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