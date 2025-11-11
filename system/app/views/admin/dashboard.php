<?php
/**
 * Dashboard Administrativo - Sistema PRIMERO DE JUNIO
 */

$title = 'Panel de Administración';
$pageTitle = 'Panel de Administración';
$pageSubtitle = 'Gestión completa del sistema de mototaxis';
$breadcrumb = [
    ['title' => 'Inicio', 'url' => '/admin/dashboard'],
    ['title' => 'Panel de Administración', 'url' => '']
];

$current_page = 'dashboard';
ob_start();
?>

<!-- Dashboard de Estadísticas -->
<div class="stats-grid">
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

<style>
/* Dashboard Específico */
.page-header {
    background: rgba(0, 255, 102, 0.1);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(0, 255, 102, 0.2);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.page-title {
    font-size: 2rem;
    color: var(--white);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-title i {
    color: var(--primary-green);
}

.page-subtitle {
    color: var(--gray-light);
    margin: 0.5rem 0 0 0;
    font-size: 1rem;
}

.header-stats {
    display: flex;
    gap: 1rem;
}

.stat-item {
    background: rgba(0, 0, 0, 0.3);
    padding: 0.75rem 1rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--gray-light);
    font-weight: 600;
}

.stat-item i {
    color: var(--primary-green);
}

/* Quick Actions */
.quick-actions-section {
    margin-bottom: 2rem;
}

.section-title {
    color: var(--white);
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: var(--primary-green);
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.quick-action-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    text-decoration: none;
    color: inherit;
    transition: var(--transition-fast);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.quick-action-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-green);
    border-color: var(--primary-green);
}

.action-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient-primary);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--white);
}

.action-content h4 {
    color: var(--white);
    margin: 0 0 0.25rem 0;
    font-size: 1.1rem;
}

.action-content p {
    color: var(--gray-light);
    margin: 0;
    font-size: 0.9rem;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
}

.stat-card.primary { border-color: var(--primary-green); }
.stat-card.success { border-color: #22c55e; }
.stat-card.warning { border-color: #f59e0b; }
.stat-card.info { border-color: #3b82f6; }

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
}

.stat-card.primary::before { background: var(--primary-green); }
.stat-card.success::before { background: #22c55e; }
.stat-card.warning::before { background: #f59e0b; }
.stat-card.info::before { background: #3b82f6; }

.stat-card {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    background: rgba(255, 255, 255, 0.1);
    color: var(--primary-green);
}

.stat-card.success .stat-icon { color: #22c55e; }
.stat-card.warning .stat-icon { color: #f59e0b; }
.stat-card.info .stat-icon { color: #3b82f6; }

.stat-number {
    font-size: 2rem;
    font-weight: 800;
    color: var(--white);
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--gray-light);
    margin: 0.25rem 0;
}

.stat-change {
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.stat-change.positive {
    color: #22c55e;
}

.stat-change.negative {
    color: #dc2626;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

.dashboard-card.full-width {
    grid-column: 1 / -1;
}

.dashboard-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
}

.card-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    color: var(--white);
    margin: 0;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-title i {
    color: var(--primary-green);
}

.card-content {
    padding: 1.5rem;
}

/* Trips List */
.trip-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
}

.trip-item:last-child {
    border-bottom: none;
}

.trip-route {
    color: var(--white);
    font-weight: 600;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.trip-details {
    display: flex;
    gap: 1rem;
    font-size: 0.9rem;
}

.trip-conductor {
    color: var(--gray-light);
}

.trip-time {
    color: var(--gray-medium);
}

.trip-status {
    text-align: right;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.status-badge.completed {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.status-badge.active {
    background: rgba(249, 115, 22, 0.2);
    color: #f97316;
}

.trip-amount {
    display: block;
    color: var(--white);
    font-weight: 700;
}

/* Drivers Ranking */
.driver-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
}

.driver-item:last-child {
    border-bottom: none;
}

.driver-position {
    width: 30px;
    height: 30px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-weight: 700;
    font-size: 0.9rem;
}

.driver-info {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.driver-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-light);
}

.driver-name {
    color: var(--white);
    font-weight: 600;
}

.driver-stats {
    color: var(--gray-light);
    font-size: 0.85rem;
}

.driver-rating {
    text-align: right;
}

.rating-value {
    display: block;
    color: var(--white);
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.rating-stars {
    color: #f59e0b;
    font-size: 0.8rem;
}

/* Alerts */
.notification-count {
    background: #dc2626;
    color: white;
    border-radius: 50%;
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
    font-weight: 600;
    min-width: 20px;
    text-align: center;
}

.alert-item {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
}

.alert-item:last-child {
    border-bottom: none;
}

.alert-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert-item.warning .alert-icon {
    background: rgba(249, 115, 22, 0.2);
    color: #f97316;
}

.alert-item.info .alert-icon {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
}

.alert-item.success .alert-icon {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.alert-title {
    color: var(--white);
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.alert-text {
    color: var(--gray-light);
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.alert-time {
    color: var(--gray-medium);
    font-size: 0.8rem;
}

.chart-container {
    height: 300px;
    position: relative;
}

/* Responsive */
@media (max-width: 768px) {
    .header-content {
        text-align: center;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
</style>

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
