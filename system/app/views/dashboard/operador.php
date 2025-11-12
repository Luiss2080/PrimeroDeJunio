<?php
/**
 * Dashboard Operador - Sistema PRIMERO DE JUNIO
 */

$title = 'Dashboard Operador';
$current_page = 'dashboard';

ob_start();
?>

<!-- Dashboard Header -->
<div class="page-header-modern operador">
    <div class="container-modern">
        <div class="header-content-grid">
            <div class="header-left">
                <h1 class="page-title-modern">
                    <div class="title-icon operador">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Panel del Conductor</span>
                        <span class="title-subtitle">Tu panel de control personal</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="driver-status-modern">
                    <div class="status-indicator-modern online" id="statusIndicator">
                        <span class="status-dot-modern"></span>
                        <span class="status-text-modern">En Línea</span>
                    </div>
                    <button class="btn-modern btn-primary" id="toggleStatus">
                        <span class="btn-icon"><i class="fas fa-power-off"></i></span>
                        <span class="btn-text">Desconectar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="stats-section-modern">
    <div class="container-modern">
        <div class="stats-grid-modern operador">
            <div class="stats-card-modern primary" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern" data-target="12">0</div>
                        <div class="stats-label-modern">Viajes Hoy</div>
                        <div class="stats-change-modern positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+3 vs ayer</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow primary"></div>
            </div>
            
            <div class="stats-card-modern success" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern" data-target="185000">$0</div>
                        <div class="stats-label-modern">Ingresos Hoy</div>
                        <div class="stats-change-modern positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+15%</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow success"></div>
            </div>
            
            <div class="stats-card-modern warning" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern" data-target="48">4.8</div>
                        <div class="stats-label-modern">Calificación</div>
                        <div class="stats-change-modern positive">
                            <i class="fas fa-star"></i>
                            <span>Excelente</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow warning"></div>
            </div>
            
            <div class="stats-card-modern info" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern" data-target="8">0</div>
                        <div class="stats-label-modern">Horas Trabajadas</div>
                        <div class="stats-change-modern neutral">
                            <i class="fas fa-clock"></i>
                            <span>de 10 hrs</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow info"></div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="services-section-modern">
    <div class="container-modern">
        <h3 class="section-title-modern">
            <div class="title-icon">
                <i class="fas fa-bolt"></i>
            </div>
            <span>Acciones Rápidas</span>
        </h3>
        
        <div class="services-grid-modern operador">
            <div class="service-card-modern" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card-background">
                    <div class="service-icon-modern primary">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="service-content-modern">
                        <h4 class="service-title-modern">Nuevo Viaje</h4>
                        <p class="service-description-modern">Registrar nuevo servicio</p>
                        <a href="/system/app/views/operador/viajes.php" class="service-link-modern">
                            <span>Ir al servicio</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="service-card-glow primary"></div>
            </div>
            
            <div class="service-card-modern" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card-background">
                    <div class="service-icon-modern success">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="service-content-modern">
                        <h4 class="service-title-modern">Mis Viajes</h4>
                        <p class="service-description-modern">Ver historial completo</p>
                        <a href="/system/app/views/operador/mis_viajes.php" class="service-link-modern">
                            <span>Ir al servicio</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="service-card-glow success"></div>
            </div>
            
            <div class="service-card-modern" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card-background">
                    <div class="service-icon-modern warning">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <div class="service-content-modern">
                        <h4 class="service-title-modern">Mi Vehículo</h4>
                        <p class="service-description-modern">Estado y mantenimiento</p>
                        <a href="/system/app/views/operador/mi_vehiculo.php" class="service-link-modern">
                            <span>Ir al servicio</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="service-card-glow warning"></div>
            </div>
            
            <div class="service-card-modern" data-aos="fade-up" data-aos-delay="400">
                <div class="service-card-background">
                    <div class="service-icon-modern info">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="service-content-modern">
                        <h4 class="service-title-modern">Mi Perfil</h4>
                        <p class="service-description-modern">Actualizar información</p>
                        <a href="/system/app/views/operador/perfil.php" class="service-link-modern">
                            <span>Ir al servicio</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="service-card-glow info"></div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Content Grid -->
<div class="container-modern">
    <div class="dashboard-grid-modern">
        <!-- Viaje Actual / Próximo -->
        <div class="system-card-modern current-trip" data-aos="fade-up" data-aos-delay="100">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-navigation"></i>
                        </div>
                        <span>Viaje Actual</span>
                    </div>
                    <span class="status-badge-modern active">En Curso</span>
                </div>
                
                <div class="card-content-modern">
                    <div class="current-trip-info-modern">
                        <div class="trip-route-visual-modern">
                            <div class="route-point-modern start">
                                <i class="fas fa-circle"></i>
                                <span>Centro Comercial</span>
                            </div>
                            <div class="route-line-modern">
                                <div class="route-progress-modern" style="width: 65%"></div>
                            </div>
                            <div class="route-point-modern end">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Universidad Nacional</span>
                            </div>
                        </div>
                        
                        <div class="trip-details-grid-modern">
                            <div class="detail-item-modern">
                                <i class="fas fa-user"></i>
                                <div class="detail-content-modern">
                                    <span class="detail-label-modern">Cliente</span>
                                    <span class="detail-value-modern">Ana María Rodríguez</span>
                                </div>
                            </div>
                            
                            <div class="detail-item-modern">
                                <i class="fas fa-clock"></i>
                                <div class="detail-content-modern">
                                    <span class="detail-label-modern">Hora Inicio</span>
                                    <span class="detail-value-modern">14:30</span>
                                </div>
                            </div>
                            
                            <div class="detail-item-modern">
                                <i class="fas fa-route"></i>
                                <div class="detail-content-modern">
                                    <span class="detail-label-modern">Distancia</span>
                                    <span class="detail-value-modern">8.5 km</span>
                                </div>
                            </div>
                            
                            <div class="detail-item-modern">
                                <i class="fas fa-money-bill-wave"></i>
                                <div class="detail-content-modern">
                                    <span class="detail-label-modern">Tarifa</span>
                                    <span class="detail-value-modern">$15,500</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="trip-actions-modern">
                            <button class="btn-modern btn-success btn-lg">
                                <span class="btn-icon"><i class="fas fa-check-circle"></i></span>
                                <span class="btn-text">Finalizar Viaje</span>
                            </button>
                            <button class="btn-modern btn-outline btn-sm">
                                <span class="btn-icon"><i class="fas fa-phone"></i></span>
                                <span class="btn-text">Contactar Cliente</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Resumen del Día -->
        <div class="system-card-modern" data-aos="fade-up" data-aos-delay="200">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <span>Resumen del Día</span>
                    </div>
                    <span class="date-info-modern"><?= date('d/m/Y') ?></span>
                </div>
                
                <div class="card-content-modern">
                    <div class="daily-summary-modern">
                        <div class="summary-chart-modern">
                            <canvas id="dailyChart" width="200" height="200"></canvas>
                        </div>
                        
                        <div class="summary-stats-modern">
                            <div class="summary-item-modern">
                                <div class="summary-icon-modern completed">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="summary-content-modern">
                                    <span class="summary-number-modern">11</span>
                                    <span class="summary-label-modern">Completados</span>
                                </div>
                            </div>
                            
                            <div class="summary-item-modern">
                                <div class="summary-icon-modern active">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="summary-content-modern">
                                    <span class="summary-number-modern">1</span>
                                    <span class="summary-label-modern">En Curso</span>
                                </div>
                            </div>
                            
                            <div class="summary-item-modern">
                                <div class="summary-icon-modern cancelled">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="summary-content-modern">
                                    <span class="summary-number-modern">0</span>
                                    <span class="summary-label-modern">Cancelados</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="daily-earnings-modern">
                            <div class="earnings-total-modern">
                                <span class="earnings-label-modern">Total del Día</span>
                                <span class="earnings-amount-modern">$185,000</span>
                            </div>
                            <div class="earnings-breakdown-modern">
                                <div class="breakdown-item-modern">
                                    <span>Tarifas: $200,000</span>
                                </div>
                                <div class="breakdown-item-modern">
                                    <span>Descuentos: -$15,000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Historial Reciente -->
        <div class="system-card-modern full-width" data-aos="fade-up" data-aos-delay="300">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <span>Últimos Viajes</span>
                    </div>
                    <a href="/system/app/views/operador/mis_viajes.php" class="btn-modern btn-sm btn-outline">
                        <span class="btn-text">Ver Todos</span>
                    </a>
                </div>
                
                <div class="card-content-modern">
                    <div class="table-container-modern">
                        <table class="table-modern">
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
                                        <div class="route-cell-modern">
                                            <span class="route-start-modern">Terminal</span>
                                            <i class="fas fa-arrow-right"></i>
                                            <span class="route-end-modern">Centro</span>
                                        </div>
                                    </td>
                                    <td>Carlos Méndez</td>
                                    <td>25 min</td>
                                    <td class="amount-modern">$12,000</td>
                                    <td><span class="status-badge-modern completed">Completado</span></td>
                                </tr>
                                
                                <tr>
                                    <td>12:20</td>
                                    <td>
                                        <div class="route-cell-modern">
                                            <span class="route-start-modern">Universidad</span>
                                            <i class="fas fa-arrow-right"></i>
                                            <span class="route-end-modern">Hospital</span>
                                        </div>
                                    </td>
                                    <td>María González</td>
                                    <td>18 min</td>
                                    <td class="amount-modern">$10,500</td>
                                    <td><span class="status-badge-modern completed">Completado</span></td>
                                </tr>
                                
                                <tr>
                                    <td>11:30</td>
                                    <td>
                                        <div class="route-cell-modern">
                                            <span class="route-start-modern">Aeropuerto</span>
                                            <i class="fas fa-arrow-right"></i>
                                            <span class="route-end-modern">Centro</span>
                                        </div>
                                    </td>
                                    <td>Roberto Silva</td>
                                    <td>35 min</td>
                                    <td class="amount-modern">$28,000</td>
                                    <td><span class="status-badge-modern completed">Completado</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Estado del Vehículo -->
        <div class="system-card-modern" data-aos="fade-up" data-aos-delay="400">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                        <span>Mi Vehículo</span>
                    </div>
                    <span class="status-badge-modern good">Buen Estado</span>
                </div>
                
                <div class="card-content-modern">
                    <div class="vehicle-info-modern">
                        <div class="vehicle-details-modern">
                            <div class="vehicle-model-modern">
                                <i class="fas fa-motorcycle"></i>
                                <div>
                                    <span class="model-name-modern">Yamaha XTZ 150</span>
                                    <span class="model-plate-modern">ABC-123</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="vehicle-metrics-modern">
                            <div class="metric-item-modern">
                                <div class="metric-icon-modern fuel">
                                    <i class="fas fa-gas-pump"></i>
                                </div>
                                <div class="metric-content-modern">
                                    <span class="metric-value-modern">85%</span>
                                    <span class="metric-label-modern">Combustible</span>
                                </div>
                            </div>
                            
                            <div class="metric-item-modern">
                                <div class="metric-icon-modern mileage">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <div class="metric-content-modern">
                                    <span class="metric-value-modern">45,230</span>
                                    <span class="metric-label-modern">Kilómetros</span>
                                </div>
                            </div>
                            
                            <div class="metric-item-modern">
                                <div class="metric-icon-modern maintenance">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <div class="metric-content-modern">
                                    <span class="metric-value-modern">15 días</span>
                                    <span class="metric-label-modern">Próx. Mantenimiento</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="vehicle-actions-modern">
                            <a href="/system/app/views/operador/mi_vehiculo.php" class="btn-modern btn-primary btn-sm">
                                <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                <span class="btn-text">Ver Detalles</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>
    </div>
</div>

<style>
/* Estilos específicos para dashboard operador - Usando componentes del website */
.page-header-modern.operador {
    background: var(--gradient-operador, linear-gradient(135deg, rgba(0, 255, 102, 0.1), rgba(34, 197, 94, 0.1)));
}

.title-icon.operador {
    background: var(--gradient-primary);
}

.driver-status-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.status-indicator-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.status-indicator-modern.online {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color, #22c55e);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.status-indicator-modern.offline {
    background: rgba(107, 114, 128, 0.15);
    color: var(--gray-medium);
    border: 1px solid rgba(107, 114, 128, 0.3);
}

.status-dot-modern {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse 2s infinite;
}

.stats-grid-modern.operador {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}

.services-grid-modern.operador {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}

.dashboard-grid-modern {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-top: 2rem;
}

.dashboard-grid-modern .full-width {
    grid-column: 1 / -1;
}

/* Viaje Actual - Estilos específicos usando componentes base */
.current-trip .card-header-modern {
    background: linear-gradient(135deg, rgba(0, 255, 102, 0.1), rgba(34, 197, 94, 0.05));
    border-bottom: 1px solid rgba(0, 255, 102, 0.2);
}

.trip-route-visual-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 1.5rem 0;
    padding: 1.5rem;
    background: var(--card-hover-bg);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.route-point-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-secondary);
    min-width: 80px;
}

.route-point-modern.start i {
    color: var(--primary-green);
    font-size: 1.2rem;
}

.route-point-modern.end i {
    color: var(--warning-color);
    font-size: 1.2rem;
}

.route-line-modern {
    flex: 1;
    height: 4px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 2px;
    position: relative;
    overflow: hidden;
}

.route-progress-modern {
    height: 100%;
    background: var(--gradient-primary);
    border-radius: 2px;
    transition: width 0.5s ease;
    position: relative;
}

.route-progress-modern::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 20px;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3));
    animation: progressShimmer 2s infinite;
}

@keyframes progressShimmer {
    0% { transform: translateX(-20px); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: translateX(20px); opacity: 0; }
}

.trip-details-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin: 1.5rem 0;
}

.detail-item-modern {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.detail-item-modern:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.detail-item-modern i {
    color: var(--primary-green);
    width: 20px;
    text-align: center;
    font-size: 1.1rem;
}

.detail-content-modern {
    display: flex;
    flex-direction: column;
}

.detail-label-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-bottom: 0.25rem;
}

.detail-value-modern {
    font-weight: 600;
    color: var(--text-primary);
}

.trip-actions-modern {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 1.5rem;
}

/* Resumen del día - Usando componentes base */
.daily-summary-modern {
    text-align: center;
}

.summary-chart-modern {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: center;
}

.summary-stats-modern {
    display: flex;
    justify-content: space-around;
    margin: 1.5rem 0;
    gap: 1rem;
    flex-wrap: wrap;
}

.summary-item-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.summary-icon-modern {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    transition: all 0.3s ease;
}

.summary-icon-modern:hover {
    transform: scale(1.1);
}

.summary-icon-modern.completed {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
    border: 2px solid rgba(34, 197, 94, 0.3);
}

.summary-icon-modern.active {
    background: rgba(249, 115, 22, 0.15);
    color: var(--warning-color);
    border: 2px solid rgba(249, 115, 22, 0.3);
}

.summary-icon-modern.cancelled {
    background: rgba(239, 68, 68, 0.15);
    color: var(--error-color);
    border: 2px solid rgba(239, 68, 68, 0.3);
}

.summary-number-modern {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
}

.summary-label-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.daily-earnings-modern {
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.earnings-total-modern {
    margin-bottom: 0.75rem;
}

.earnings-label-modern {
    display: block;
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.earnings-amount-modern {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary-green);
    text-shadow: 0 0 20px rgba(0, 255, 102, 0.3);
}

.earnings-breakdown-modern {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

/* Estado del vehículo - Usando componentes base */
.vehicle-info-modern {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.vehicle-model-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--card-hover-bg);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.vehicle-model-modern i {
    font-size: 2.5rem;
    color: var(--primary-green);
}

.model-name-modern {
    display: block;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 1.1rem;
}

.model-plate-modern {
    display: block;
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.vehicle-metrics-modern {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.metric-item-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.metric-item-modern:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
}

.metric-icon-modern {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.metric-icon-modern.fuel {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.metric-icon-modern.mileage {
    background: rgba(59, 130, 246, 0.15);
    color: var(--info-color);
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.metric-icon-modern.maintenance {
    background: rgba(249, 115, 22, 0.15);
    color: var(--warning-color);
    border: 1px solid rgba(249, 115, 22, 0.3);
}

.metric-content-modern {
    display: flex;
    flex-direction: column;
}

.metric-value-modern {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 1rem;
}

.metric-label-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.vehicle-actions-modern {
    display: flex;
    justify-content: center;
}

/* Tabla moderna - Usando componentes base */
.table-container-modern {
    overflow-x: auto;
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.table-modern {
    width: 100%;
    border-collapse: collapse;
    background: var(--card-bg);
}

.table-modern th,
.table-modern td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.table-modern th {
    background: var(--card-hover-bg);
    color: var(--text-secondary);
    font-weight: 600;
    font-size: 0.9rem;
}

.table-modern tbody tr {
    transition: all 0.3s ease;
}

.table-modern tbody tr:hover {
    background: var(--card-hover-bg);
    transform: scale(1.01);
}

.route-cell-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.route-start-modern {
    color: var(--primary-green);
    font-weight: 500;
}

.route-end-modern {
    color: var(--warning-color);
    font-weight: 500;
}

.route-cell-modern i {
    color: var(--text-secondary);
    font-size: 0.8rem;
}

.amount-modern {
    font-weight: 700;
    color: var(--primary-green);
    font-size: 1rem;
}

.date-info-modern {
    padding: 0.25rem 0.75rem;
    background: var(--card-hover-bg);
    border-radius: 15px;
    font-size: 0.85rem;
    color: var(--text-secondary);
    border: 1px solid var(--border-color);
}

/* Status badges usando componentes base */
.status-badge-modern.active {
    background: rgba(249, 115, 22, 0.15);
    color: var(--warning-color);
    border: 1px solid rgba(249, 115, 22, 0.3);
}

.status-badge-modern.completed {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.status-badge-modern.good {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

/* Responsive design */
@media (max-width: 768px) {
    .driver-status-modern {
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
    }
    
    .dashboard-grid-modern {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .trip-route-visual-modern {
        flex-direction: column;
        text-align: center;
    }
    
    .route-line-modern {
        width: 100px;
        height: 4px;
    }
    
    .trip-details-grid-modern {
        grid-template-columns: 1fr;
    }
    
    .trip-actions-modern {
        flex-direction: column;
    }
    
    .summary-stats-modern {
        justify-content: center;
    }
    
    .table-modern {
        font-size: 0.85rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar AOS (Animate On Scroll) para las animaciones del website
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    }

    // Animar números de estadísticas con efectos del website
    const animateNumbers = () => {
        const numbers = document.querySelectorAll('[data-target]');
        
        numbers.forEach(number => {
            const target = parseFloat(number.getAttribute('data-target'));
            const increment = target / 60;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                
                if (target === 48) { // Para calificación
                    number.textContent = (current / 10).toFixed(1);
                } else if (target > 1000) {
                    if (target === 185000) {
                        number.textContent = '$' + Math.floor(current).toLocaleString();
                    } else {
                        number.textContent = Math.floor(current).toLocaleString();
                    }
                } else {
                    number.textContent = Math.floor(current);
                }
                
                if (current >= target) {
                    if (target === 48) {
                        number.textContent = '4.8';
                    } else if (target === 185000) {
                        number.textContent = '$' + target.toLocaleString();
                    } else {
                        number.textContent = target.toLocaleString();
                    }
                    clearInterval(timer);
                }
            }, 30);
        });
    };

    // Inicializar animación de números con delay
    setTimeout(animateNumbers, 800);

    // Toggle de estado con efectos modernos
    const toggleBtn = document.getElementById('toggleStatus');
    const statusIndicator = document.getElementById('statusIndicator');
    
    if (toggleBtn && statusIndicator) {
        toggleBtn.addEventListener('click', function() {
            const isOnline = statusIndicator.classList.contains('online');
            
            // Agregar efecto de loading
            this.style.transform = 'scale(0.95)';
            this.style.opacity = '0.7';
            
            setTimeout(() => {
                if (isOnline) {
                    statusIndicator.classList.remove('online');
                    statusIndicator.classList.add('offline');
                    statusIndicator.querySelector('.status-text-modern').textContent = 'Desconectado';
                    this.innerHTML = '<span class="btn-icon"><i class="fas fa-power-off"></i></span><span class="btn-text">Conectar</span>';
                    this.classList.remove('btn-primary');
                    this.classList.add('btn-success');
                } else {
                    statusIndicator.classList.remove('offline');
                    statusIndicator.classList.add('online');
                    statusIndicator.querySelector('.status-text-modern').textContent = 'En Línea';
                    this.innerHTML = '<span class="btn-icon"><i class="fas fa-power-off"></i></span><span class="btn-text">Desconectar</span>';
                    this.classList.remove('btn-success');
                    this.classList.add('btn-primary');
                }
                
                // Restaurar efecto
                this.style.transform = '';
                this.style.opacity = '';
            }, 200);
        });
    }

    // Gráfico del día con Chart.js y tema del website
    const ctx = document.getElementById('dailyChart');
    if (ctx && typeof Chart !== 'undefined') {
        const chart = new Chart(ctx, {
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
                    borderWidth: 3,
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    hoverBackgroundColor: [
                        '#16a34a',
                        '#ea580c',
                        '#dc2626'
                    ],
                    hoverBorderColor: '#00ff66'
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
                cutout: '75%',
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });

        // Animar el gráfico después de cargarlo
        setTimeout(() => {
            chart.update();
        }, 500);
    }

    // Actualizar progreso del viaje con efectos suaves
    const progressBar = document.querySelector('.route-progress-modern');
    if (progressBar) {
        let progress = 65;
        const targetProgress = 100;
        
        const updateProgress = () => {
            if (progress < targetProgress) {
                progress += Math.random() * 3;
                progressBar.style.width = Math.min(progress, targetProgress) + '%';
                
                // Agregar efecto de pulso cuando se acerca al final
                if (progress > 90) {
                    progressBar.style.boxShadow = '0 0 20px rgba(0, 255, 102, 0.6)';
                }
                
                if (progress < targetProgress) {
                    setTimeout(updateProgress, 3000 + Math.random() * 2000);
                } else {
                    // Viaje completado
                    setTimeout(() => {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Viaje Completado!',
                                text: 'El viaje ha sido finalizado exitosamente',
                                confirmButtonColor: '#00ff66'
                            });
                        }
                    }, 1000);
                }
            }
        };
        
        // Iniciar actualización de progreso
        setTimeout(updateProgress, 2000);
    }

    // Efectos hover para las cards usando GSAP si está disponible
    if (typeof gsap !== 'undefined') {
        // Efectos para las stats cards
        gsap.utils.toArray('.stats-card-modern').forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    duration: 0.3,
                    y: -5,
                    scale: 1.02,
                    ease: 'power2.out'
                });
            });
            
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    duration: 0.3,
                    y: 0,
                    scale: 1,
                    ease: 'power2.out'
                });
            });
        });

        // Efectos para las service cards
        gsap.utils.toArray('.service-card-modern').forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    duration: 0.3,
                    y: -8,
                    rotationY: 5,
                    ease: 'power2.out'
                });
            });
            
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    duration: 0.3,
                    y: 0,
                    rotationY: 0,
                    ease: 'power2.out'
                });
            });
        });

        // Efectos para las system cards
        gsap.utils.toArray('.system-card-modern').forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    duration: 0.3,
                    y: -3,
                    scale: 1.01,
                    ease: 'power2.out'
                });
                
                // Efecto de glow
                const glow = card.querySelector('.system-card-glow');
                if (glow) {
                    gsap.to(glow, {
                        duration: 0.3,
                        opacity: 0.8,
                        ease: 'power2.out'
                    });
                }
            });
            
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    duration: 0.3,
                    y: 0,
                    scale: 1,
                    ease: 'power2.out'
                });
                
                const glow = card.querySelector('.system-card-glow');
                if (glow) {
                    gsap.to(glow, {
                        duration: 0.3,
                        opacity: 0.3,
                        ease: 'power2.out'
                    });
                }
            });
        });
    }

    // Intersection Observer para animar elementos al entrar en viewport
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (typeof gsap !== 'undefined') {
                        gsap.fromTo(entry.target, {
                            opacity: 0,
                            y: 30
                        }, {
                            opacity: 1,
                            y: 0,
                            duration: 0.6,
                            ease: 'power2.out'
                        });
                    } else {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observar elementos que necesitan animación
        document.querySelectorAll('.system-card-modern, .stats-card-modern, .service-card-modern').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    }

    // Auto-refresh de datos cada 30 segundos
    setInterval(() => {
        // Simular actualización de datos en tiempo real
        const elements = document.querySelectorAll('[data-target]');
        elements.forEach(el => {
            if (el.textContent.includes('$')) {
                // Pequeña variación en ingresos
                const currentValue = parseInt(el.textContent.replace(/[\$,]/g, ''));
                const variation = Math.floor(Math.random() * 5000) - 2500;
                const newValue = Math.max(0, currentValue + variation);
                el.textContent = '$' + newValue.toLocaleString();
            }
        });
        
        // Actualizar progreso si existe
        if (progressBar && progress < 100) {
            progress += Math.random() * 2;
            progressBar.style.width = Math.min(progress, 100) + '%';
        }
    }, 30000);

    console.log('Dashboard del Operador inicializado con componentes del website');
});
</script>

<?php
$content = ob_get_clean();
include '../layouts/main.php';
?>