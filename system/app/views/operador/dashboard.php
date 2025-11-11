<?php
/**
 * Dashboard Operador - Sistema PRIMERO DE JUNIO
 */

$title = 'Dashboard Operador';
$current_page = 'dashboard';

ob_start();
?>

<!-- Dashboard Header -->
<div class="page-header operador">
    <div class="header-content">
        <div class="header-left">
            <h1 class="page-title">
                <i class="fas fa-motorcycle"></i>
                Panel del Conductor
            </h1>
            <p class="page-subtitle">Tu panel de control personal</p>
        </div>
        <div class="header-right">
            <div class="driver-status">
                <div class="status-indicator online">
                    <span class="status-dot"></span>
                    <span class="status-text">En Línea</span>
                </div>
                <button class="btn btn-primary toggle-status" id="toggleStatus">
                    <i class="fas fa-power-off"></i>
                    Desconectar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="stats-section">
    <div class="stats-grid operador">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-route"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="12">0</div>
                <div class="stat-label">Viajes Hoy</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +3 vs ayer
                </div>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="185000">0</div>
                <div class="stat-label">Ingresos Hoy</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    +15%
                </div>
            </div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="48">4.8</div>
                <div class="stat-label">Calificación</div>
                <div class="stat-change positive">
                    <i class="fas fa-arrow-up"></i>
                    Excelente
                </div>
            </div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-number" data-target="8">0</div>
                <div class="stat-label">Horas Trabajadas</div>
                <div class="stat-change neutral">
                    <i class="fas fa-clock"></i>
                    de 10 hrs
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
    <div class="quick-actions operador">
        <a href="/system/app/views/operador/viajes.php" class="quick-action-card">
            <div class="action-icon primary">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div class="action-content">
                <h4>Nuevo Viaje</h4>
                <p>Registrar nuevo servicio</p>
            </div>
        </a>
        
        <a href="/system/app/views/operador/mis_viajes.php" class="quick-action-card">
            <div class="action-icon success">
                <i class="fas fa-history"></i>
            </div>
            <div class="action-content">
                <h4>Mis Viajes</h4>
                <p>Ver historial completo</p>
            </div>
        </a>
        
        <a href="/system/app/views/operador/mi_vehiculo.php" class="quick-action-card">
            <div class="action-icon warning">
                <i class="fas fa-motorcycle"></i>
            </div>
            <div class="action-content">
                <h4>Mi Vehículo</h4>
                <p>Estado y mantenimiento</p>
            </div>
        </a>
        
        <a href="/system/app/views/operador/perfil.php" class="quick-action-card">
            <div class="action-icon info">
                <i class="fas fa-user-edit"></i>
            </div>
            <div class="action-content">
                <h4>Mi Perfil</h4>
                <p>Actualizar información</p>
            </div>
        </a>
    </div>
</div>

<!-- Dashboard Content Grid -->
<div class="dashboard-grid">
    <!-- Viaje Actual / Próximo -->
    <div class="dashboard-card current-trip">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-navigation"></i>
                Viaje Actual
            </h4>
            <span class="trip-status-badge active">En Curso</span>
        </div>
        <div class="card-content">
            <div class="current-trip-info">
                <div class="trip-route-visual">
                    <div class="route-point start">
                        <i class="fas fa-circle"></i>
                        <span>Centro Comercial</span>
                    </div>
                    <div class="route-line">
                        <div class="route-progress" style="width: 65%"></div>
                    </div>
                    <div class="route-point end">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Universidad Nacional</span>
                    </div>
                </div>
                
                <div class="trip-details-grid">
                    <div class="detail-item">
                        <i class="fas fa-user"></i>
                        <div class="detail-content">
                            <span class="detail-label">Cliente</span>
                            <span class="detail-value">Ana María Rodríguez</span>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-clock"></i>
                        <div class="detail-content">
                            <span class="detail-label">Hora Inicio</span>
                            <span class="detail-value">14:30</span>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-route"></i>
                        <div class="detail-content">
                            <span class="detail-label">Distancia</span>
                            <span class="detail-value">8.5 km</span>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <div class="detail-content">
                            <span class="detail-label">Tarifa</span>
                            <span class="detail-value">$15,500</span>
                        </div>
                    </div>
                </div>
                
                <div class="trip-actions">
                    <button class="btn btn-success btn-lg">
                        <i class="fas fa-check-circle"></i>
                        Finalizar Viaje
                    </button>
                    <button class="btn btn-outline btn-sm">
                        <i class="fas fa-phone"></i>
                        Contactar Cliente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen del Día -->
    <div class="dashboard-card">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-calendar-day"></i>
                Resumen del Día
            </h4>
            <span class="date-info"><?= date('d/m/Y') ?></span>
        </div>
        <div class="card-content">
            <div class="daily-summary">
                <div class="summary-chart">
                    <canvas id="dailyChart" width="200" height="200"></canvas>
                </div>
                
                <div class="summary-stats">
                    <div class="summary-item">
                        <div class="summary-icon completed">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-number">11</span>
                            <span class="summary-label">Completados</span>
                        </div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-icon active">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-number">1</span>
                            <span class="summary-label">En Curso</span>
                        </div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-icon cancelled">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="summary-content">
                            <span class="summary-number">0</span>
                            <span class="summary-label">Cancelados</span>
                        </div>
                    </div>
                </div>
                
                <div class="daily-earnings">
                    <div class="earnings-total">
                        <span class="earnings-label">Total del Día</span>
                        <span class="earnings-amount">$185,000</span>
                    </div>
                    <div class="earnings-breakdown">
                        <div class="breakdown-item">
                            <span>Tarifas: $200,000</span>
                        </div>
                        <div class="breakdown-item">
                            <span>Descuentos: -$15,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial Reciente -->
    <div class="dashboard-card full-width">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-history"></i>
                Últimos Viajes
            </h4>
            <a href="/system/app/views/operador/mis_viajes.php" class="btn btn-sm btn-outline">Ver Todos</a>
        </div>
        <div class="card-content">
            <div class="trips-table-container">
                <table class="trips-table">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Ruta</th>
                            <th>Cliente</th>
                            <th>Duración</th>
                            <th>Tarifa</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>13:45</td>
                            <td>
                                <div class="route-cell">
                                    <span class="route-start">Terminal</span>
                                    <i class="fas fa-arrow-right"></i>
                                    <span class="route-end">Centro</span>
                                </div>
                            </td>
                            <td>Carlos Méndez</td>
                            <td>25 min</td>
                            <td class="amount">$12,000</td>
                            <td><span class="status-badge completed">Completado</span></td>
                        </tr>
                        
                        <tr>
                            <td>12:20</td>
                            <td>
                                <div class="route-cell">
                                    <span class="route-start">Universidad</span>
                                    <i class="fas fa-arrow-right"></i>
                                    <span class="route-end">Hospital</span>
                                </div>
                            </td>
                            <td>María González</td>
                            <td>18 min</td>
                            <td class="amount">$10,500</td>
                            <td><span class="status-badge completed">Completado</span></td>
                        </tr>
                        
                        <tr>
                            <td>11:30</td>
                            <td>
                                <div class="route-cell">
                                    <span class="route-start">Aeropuerto</span>
                                    <i class="fas fa-arrow-right"></i>
                                    <span class="route-end">Centro</span>
                                </div>
                            </td>
                            <td>Roberto Silva</td>
                            <td>35 min</td>
                            <td class="amount">$28,000</td>
                            <td><span class="status-badge completed">Completado</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Estado del Vehículo -->
    <div class="dashboard-card">
        <div class="card-header">
            <h4 class="card-title">
                <i class="fas fa-motorcycle"></i>
                Mi Vehículo
            </h4>
            <span class="vehicle-status good">Buen Estado</span>
        </div>
        <div class="card-content">
            <div class="vehicle-info">
                <div class="vehicle-details">
                    <div class="vehicle-model">
                        <i class="fas fa-motorcycle"></i>
                        <div>
                            <span class="model-name">Yamaha XTZ 150</span>
                            <span class="model-plate">ABC-123</span>
                        </div>
                    </div>
                </div>
                
                <div class="vehicle-metrics">
                    <div class="metric-item">
                        <div class="metric-icon fuel">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <div class="metric-content">
                            <span class="metric-value">85%</span>
                            <span class="metric-label">Combustible</span>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-icon mileage">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div class="metric-content">
                            <span class="metric-value">45,230</span>
                            <span class="metric-label">Kilómetros</span>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-icon maintenance">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div class="metric-content">
                            <span class="metric-value">15 días</span>
                            <span class="metric-label">Próx. Mantenimiento</span>
                        </div>
                    </div>
                </div>
                
                <div class="vehicle-actions">
                    <a href="/system/app/views/operador/mi_vehiculo.php" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye"></i>
                        Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para operador */
.page-header.operador {
    background: linear-gradient(135deg, rgba(0, 255, 102, 0.15), rgba(34, 197, 94, 0.15));
}

.driver-status {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
}

.status-indicator.online {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.status-indicator.offline {
    background: rgba(107, 114, 128, 0.2);
    color: #6b7280;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.stats-grid.operador {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}

.quick-actions.operador {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}

/* Viaje Actual */
.current-trip .card-header {
    background: rgba(0, 255, 102, 0.1);
    border-bottom: 1px solid rgba(0, 255, 102, 0.3);
}

.trip-status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.trip-status-badge.active {
    background: rgba(249, 115, 22, 0.2);
    color: #f97316;
}

.trip-route-visual {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.route-point {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--gray-light);
}

.route-point.start i {
    color: var(--primary-green);
}

.route-point.end i {
    color: #f97316;
}

.route-line {
    flex: 1;
    height: 3px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
    position: relative;
}

.route-progress {
    height: 100%;
    background: var(--gradient-primary);
    border-radius: 2px;
    transition: width 0.3s ease;
}

.trip-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.detail-item i {
    color: var(--primary-green);
    width: 20px;
    text-align: center;
}

.detail-content {
    display: flex;
    flex-direction: column;
}

.detail-label {
    font-size: 0.8rem;
    color: var(--gray-medium);
}

.detail-value {
    font-weight: 600;
    color: var(--white);
}

.trip-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

/* Resumen del Día */
.daily-summary {
    text-align: center;
}

.summary-chart {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center;
}

.summary-stats {
    display: flex;
    justify-content: space-around;
    margin-bottom: 1.5rem;
}

.summary-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.summary-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.summary-icon.completed {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.summary-icon.active {
    background: rgba(249, 115, 22, 0.2);
    color: #f97316;
}

.summary-icon.cancelled {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

.summary-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--white);
}

.summary-label {
    font-size: 0.8rem;
    color: var(--gray-light);
}

.daily-earnings {
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

.earnings-total {
    margin-bottom: 0.5rem;
}

.earnings-label {
    display: block;
    font-size: 0.9rem;
    color: var(--gray-light);
}

.earnings-amount {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--primary-green);
}

.earnings-breakdown {
    font-size: 0.8rem;
    color: var(--gray-medium);
}

/* Tabla de Viajes */
.trips-table-container {
    overflow-x: auto;
}

.trips-table {
    width: 100%;
    border-collapse: collapse;
}

.trips-table th,
.trips-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.trips-table th {
    color: var(--gray-light);
    font-weight: 600;
    font-size: 0.9rem;
}

.trips-table td {
    color: var(--white);
}

.route-cell {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.route-start {
    color: var(--primary-green);
}

.route-end {
    color: #f97316;
}

.route-cell i {
    color: var(--gray-medium);
    font-size: 0.8rem;
}

.amount {
    font-weight: 700;
    color: var(--primary-green);
}

/* Estado del Vehículo */
.vehicle-status {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.vehicle-status.good {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.vehicle-model {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.vehicle-model i {
    font-size: 2rem;
    color: var(--primary-green);
}

.model-name {
    display: block;
    font-weight: 600;
    color: var(--white);
}

.model-plate {
    display: block;
    font-size: 0.9rem;
    color: var(--gray-light);
}

.vehicle-metrics {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.metric-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.metric-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.metric-icon.fuel {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.metric-icon.mileage {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
}

.metric-icon.maintenance {
    background: rgba(249, 115, 22, 0.2);
    color: #f97316;
}

.metric-value {
    display: block;
    font-weight: 600;
    color: var(--white);
}

.metric-label {
    display: block;
    font-size: 0.8rem;
    color: var(--gray-light);
}

/* Responsive */
@media (max-width: 768px) {
    .driver-status {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .trip-details-grid {
        grid-template-columns: 1fr;
    }
    
    .trip-actions {
        flex-direction: column;
    }
    
    .summary-stats {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animar números de estadísticas
    const animateNumbers = () => {
        const numbers = document.querySelectorAll('[data-target]');
        
        numbers.forEach(number => {
            const target = parseFloat(number.getAttribute('data-target'));
            const increment = target / 50;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                
                if (target === 48) { // Para calificación
                    number.textContent = (current / 10).toFixed(1);
                } else if (target > 1000) {
                    number.textContent = Math.floor(current).toLocaleString();
                } else {
                    number.textContent = Math.floor(current);
                }
                
                if (current >= target) {
                    if (target === 48) {
                        number.textContent = '4.8';
                    } else {
                        number.textContent = target.toLocaleString();
                    }
                    clearInterval(timer);
                }
            }, 20);
        });
    };

    setTimeout(animateNumbers, 500);

    // Toggle de estado
    const toggleBtn = document.getElementById('toggleStatus');
    const statusIndicator = document.querySelector('.status-indicator');
    
    toggleBtn.addEventListener('click', function() {
        if (statusIndicator.classList.contains('online')) {
            statusIndicator.classList.remove('online');
            statusIndicator.classList.add('offline');
            statusIndicator.querySelector('.status-text').textContent = 'Desconectado';
            this.innerHTML = '<i class="fas fa-power-off"></i> Conectar';
            this.classList.remove('btn-primary');
            this.classList.add('btn-success');
        } else {
            statusIndicator.classList.remove('offline');
            statusIndicator.classList.add('online');
            statusIndicator.querySelector('.status-text').textContent = 'En Línea';
            this.innerHTML = '<i class="fas fa-power-off"></i> Desconectar';
            this.classList.remove('btn-success');
            this.classList.add('btn-primary');
        }
    });

    // Gráfico del día (Chart.js)
    const ctx = document.getElementById('dailyChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completados', 'En Curso', 'Cancelados'],
                datasets: [{
                    data: [11, 1, 0],
                    backgroundColor: [
                        '#22c55e',
                        '#f97316',
                        '#ef4444'
                    ],
                    borderWidth: 0
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
                cutout: '70%'
            }
        });
    }

    // Actualizar progreso del viaje (simulación)
    const progressBar = document.querySelector('.route-progress');
    if (progressBar) {
        let progress = 65;
        const interval = setInterval(() => {
            progress += 2;
            progressBar.style.width = progress + '%';
            if (progress >= 100) {
                clearInterval(interval);
                // Aquí se podría mostrar notificación de viaje completado
            }
        }, 5000);
    }
});
</script>

<?php
$content = ob_get_clean();
include '../layouts/main.php';
?>