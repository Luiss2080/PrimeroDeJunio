<?php
/**
 * Dashboard Administrativo - Sistema PRIMERO DE JUNIO
 */

$title = 'Dashboard Administrativo';
$current_page = 'dashboard';

ob_start();
?>

<!-- Dashboard Header -->
<div class="page-header">
    <div class="header-content">
        <div class="header-left">
            <h1 class="page-title">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard Administrativo
            </h1>
            <p class="page-subtitle">Panel de control y estadísticas generales</p>
        </div>
        <div class="header-right">
            <div class="header-stats">
                <div class="stat-item">
                    <i class="fas fa-calendar-day"></i>
                    <span><?= date('d/m/Y') ?></span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-clock"></i>
                    <span id="current-time"><?= date('H:i:s') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions-section">
    <h3 class="section-title">
        <i class="fas fa-bolt"></i>
        Acciones Rápidas
    </h3>
    <div class="quick-actions">
        <a href="/system/app/views/admin/conductores.php" class="quick-action-card">
            <div class="action-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="action-content">
                <h4>Nuevo Conductor</h4>
                <p>Registrar conductor</p>
            </div>
        </a>
        
        <a href="/system/app/views/admin/vehiculos.php" class="quick-action-card">
            <div class="action-icon">
                <i class="fas fa-motorcycle"></i>
            </div>
            <div class="action-content">
                <h4>Nuevo Vehículo</h4>
                <p>Registrar vehículo</p>
            </div>
        </a>
        
        <a href="/system/app/views/admin/usuarios.php" class="quick-action-card">
            <div class="action-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="action-content">
                <h4>Gestionar Usuarios</h4>
                <p>Administrar usuarios</p>
            </div>
        </a>
        
        <a href="/system/app/views/admin/reportes.php" class="quick-action-card">
            <div class="action-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="action-content">
                <h4>Ver Reportes</h4>
                <p>Estadísticas y reportes</p>
            </div>
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-section">
    <h3 class="section-title">
        <i class="fas fa-chart-line"></i>
        Estadísticas Generales
    </h3>
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="45">0</div>
                <div class="stat-label">Total Conductores</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +5 este mes
                </div>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-motorcycle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="38">0</div>
                <div class="stat-label">Vehículos Activos</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +3 este mes
                </div>
            </div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-route"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="156">0</div>
                <div class="stat-label">Viajes Hoy</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +12% vs ayer
                </div>
            </div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="2850000">0</div>
                <div class="stat-label">Ingresos Mes</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +8.5%
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Content Grid -->
<div class="dashboard-grid">
    <!-- Viajes Recientes -->
    <div class="dashboard-card">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-clock"></i>
                Viajes Recientes
            </h4>
            <a href="/system/app/views/admin/reportes.php" class="btn btn-sm btn-outline">Ver Todos</a>
        </div>
        <div class="card-content">
            <div class="trips-list">
                <div class="trip-item">
                    <div class="trip-info">
                        <div class="trip-route">
                            <i class="fas fa-map-marker-alt text-success"></i>
                            Centro → La Macarena
                        </div>
                        <div class="trip-details">
                            <span class="trip-conductor">Juan Pérez</span>
                            <span class="trip-time">hace 5 min</span>
                        </div>
                    </div>
                    <div class="trip-status">
                        <span class="status-badge completed">Completado</span>
                        <span class="trip-amount">$8,500</span>
                    </div>
                </div>
                
                <div class="trip-item">
                    <div class="trip-info">
                        <div class="trip-route">
                            <i class="fas fa-map-marker-alt text-warning"></i>
                            Terminal → Universidad
                        </div>
                        <div class="trip-details">
                            <span class="trip-conductor">María García</span>
                            <span class="trip-time">hace 12 min</span>
                        </div>
                    </div>
                    <div class="trip-status">
                        <span class="status-badge active">En Curso</span>
                        <span class="trip-amount">$12,000</span>
                    </div>
                </div>
                
                <div class="trip-item">
                    <div class="trip-info">
                        <div class="trip-route">
                            <i class="fas fa-map-marker-alt text-info"></i>
                            Aeropuerto → Centro
                        </div>
                        <div class="trip-details">
                            <span class="trip-conductor">Carlos López</span>
                            <span class="trip-time">hace 18 min</span>
                        </div>
                    </div>
                    <div class="trip-status">
                        <span class="status-badge completed">Completado</span>
                        <span class="trip-amount">$25,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Conductores del Día -->
    <div class="dashboard-card">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-star"></i>
                Top Conductores del Día
            </h4>
            <a href="/system/app/views/admin/conductores.php" class="btn btn-sm btn-outline">Ver Todos</a>
        </div>
        <div class="card-content">
            <div class="drivers-ranking">
                <div class="driver-item">
                    <div class="driver-position">1</div>
                    <div class="driver-info">
                        <div class="driver-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="driver-details">
                            <div class="driver-name">Juan Pérez</div>
                            <div class="driver-stats">8 viajes • $68,000</div>
                        </div>
                    </div>
                    <div class="driver-rating">
                        <span class="rating-value">4.9</span>
                        <div class="rating-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <div class="driver-item">
                    <div class="driver-position">2</div>
                    <div class="driver-info">
                        <div class="driver-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="driver-details">
                            <div class="driver-name">María García</div>
                            <div class="driver-stats">6 viajes • $52,000</div>
                        </div>
                    </div>
                    <div class="driver-rating">
                        <span class="rating-value">4.8</span>
                        <div class="rating-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <div class="driver-item">
                    <div class="driver-position">3</div>
                    <div class="driver-info">
                        <div class="driver-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="driver-details">
                            <div class="driver-name">Carlos López</div>
                            <div class="driver-stats">5 viajes • $45,000</div>
                        </div>
                    </div>
                    <div class="driver-rating">
                        <span class="rating-value">4.7</span>
                        <div class="rating-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ingresos -->
    <div class="dashboard-card full-width">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-chart-area"></i>
                Ingresos de los Últimos 7 Días
            </h4>
            <div class="card-actions">
                <select class="form-select sm">
                    <option value="7">Últimos 7 días</option>
                    <option value="30">Último mes</option>
                    <option value="90">Últimos 3 meses</option>
                </select>
            </div>
        </div>
        <div class="card-content">
            <div class="chart-container">
                <canvas id="incomeChart" width="400" height="150"></canvas>
            </div>
        </div>
    </div>

    <!-- Alertas y Notificaciones -->
    <div class="dashboard-card">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-bell"></i>
                Alertas del Sistema
            </h4>
            <span class="notification-count">3</span>
        </div>
        <div class="card-content">
            <div class="alerts-list">
                <div class="alert-item warning">
                    <div class="alert-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Vencimiento de Licencia</div>
                        <div class="alert-text">2 conductores tienen licencias próximas a vencer</div>
                        <div class="alert-time">hace 1 hora</div>
                    </div>
                </div>
                
                <div class="alert-item info">
                    <div class="alert-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Mantenimiento Programado</div>
                        <div class="alert-text">5 vehículos requieren mantenimiento esta semana</div>
                        <div class="alert-time">hace 2 horas</div>
                    </div>
                </div>
                
                <div class="alert-item success">
                    <div class="alert-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert-content">
                        <div class="alert-title">Meta Mensual Alcanzada</div>
                        <div class="alert-text">Se superó la meta de viajes del mes</div>
                        <div class="alert-time">hace 3 horas</div>
                    </div>
                </div>
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
