<?php
/**
 * Vista Perfil Vehículo - Sistema PRIMERO DE JUNIO
 */

$title = 'Perfil de Vehículo';
$current_page = 'vehiculos';

// Datos del vehículo
$vehiculo = $vehiculo ?? [];

ob_start();
?>

<!-- Page Header -->
<div class="page-header-modern vehicle-profile">
    <div class="container-modern">
        <div class="header-content-grid">
            <div class="header-left">
                <h1 class="page-title-modern">
                    <div class="title-icon admin">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main"><?= htmlspecialchars($vehiculo['placa'] ?? 'Vehículo') ?></span>
                        <span class="title-subtitle"><?= htmlspecialchars(($vehiculo['marca'] ?? '') . ' ' . ($vehiculo['modelo'] ?? '') . ' ' . ($vehiculo['anio'] ?? '')) ?></span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="vehicle-status-badge status-<?= $vehiculo['estado'] ?? 'disponible' ?>">
                    <?php 
                    $status_config = [
                        'disponible' => ['icon' => 'check-circle', 'text' => 'Disponible'],
                        'ocupado' => ['icon' => 'clock', 'text' => 'Ocupado'],
                        'mantenimiento' => ['icon' => 'tools', 'text' => 'Mantenimiento'],
                        'inactivo' => ['icon' => 'times-circle', 'text' => 'Inactivo']
                    ];
                    $status = $status_config[$vehiculo['estado'] ?? 'disponible'];
                    ?>
                    <i class="fas fa-<?= $status['icon'] ?>"></i>
                    <span><?= $status['text'] ?></span>
                </div>
                <div class="header-actions">
                    <a href="/admin/vehiculos/<?= $vehiculo['id'] ?? '' ?>/editar" class="btn-modern btn-primary">
                        <span class="btn-icon"><i class="fas fa-edit"></i></span>
                        <span class="btn-text">Editar</span>
                    </a>
                    <a href="/admin/vehiculos" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-modern">
    <!-- Vehicle Overview Cards -->
    <div class="vehicle-overview-grid" data-aos="fade-up">
        <!-- Vehicle Photo & Basic Info -->
        <div class="system-card-modern vehicle-photo-card">
            <div class="system-card-background">
                <div class="vehicle-photo-section">
                    <div class="vehicle-main-photo">
                        <img src="<?= $vehiculo['foto'] ?? '/assets/images/default-vehicle.png' ?>" alt="<?= htmlspecialchars($vehiculo['placa'] ?? 'Vehículo') ?>">
                        <div class="photo-overlay">
                            <button class="btn-modern btn-sm btn-outline" onclick="openPhotoModal()">
                                <i class="fas fa-expand"></i>
                                Ver imagen completa
                            </button>
                        </div>
                    </div>
                    
                    <div class="vehicle-basic-info">
                        <h3><?= htmlspecialchars($vehiculo['placa'] ?? '') ?></h3>
                        <div class="vehicle-details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Marca:</span>
                                <span class="detail-value"><?= htmlspecialchars($vehiculo['marca'] ?? 'No especificado') ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Modelo:</span>
                                <span class="detail-value"><?= htmlspecialchars($vehiculo['modelo'] ?? 'No especificado') ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Año:</span>
                                <span class="detail-value"><?= htmlspecialchars($vehiculo['anio'] ?? 'No especificado') ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Color:</span>
                                <span class="detail-value"><?= htmlspecialchars($vehiculo['color'] ?? 'No especificado') ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Tipo:</span>
                                <span class="detail-value"><?= ucfirst(htmlspecialchars($vehiculo['tipo'] ?? 'No especificado')) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Quick Stats -->
        <div class="system-card-modern vehicle-stats-card">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span>Estadísticas Rápidas</span>
                    </div>
                </div>
                
                <div class="card-content-modern">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-route"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number"><?= number_format($vehiculo['total_viajes'] ?? 0) ?></div>
                                <div class="stat-label">Viajes Realizados</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number"><?= number_format($vehiculo['kilometraje'] ?? 0) ?></div>
                                <div class="stat-label">Kilometraje Total</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number">$<?= number_format($vehiculo['ingresos_total'] ?? 0, 2) ?></div>
                                <div class="stat-label">Ingresos Generados</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-number"><?= $vehiculo['total_mantenimientos'] ?? 0 ?></div>
                                <div class="stat-label">Mantenimientos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>
    </div>

    <!-- Main Content Tabs -->
    <div class="tabs-container-modern vehicle-tabs" data-aos="fade-up" data-aos-delay="200">
        <div class="tabs-header-modern">
            <button class="tab-button-modern active" data-tab="especificaciones">
                <i class="fas fa-cog"></i>
                Especificaciones
            </button>
            <button class="tab-button-modern" data-tab="documentacion">
                <i class="fas fa-file-alt"></i>
                Documentación
            </button>
            <button class="tab-button-modern" data-tab="conductor">
                <i class="fas fa-user-tie"></i>
                Conductor
            </button>
            <button class="tab-button-modern" data-tab="mantenimiento">
                <i class="fas fa-tools"></i>
                Mantenimiento
            </button>
            <button class="tab-button-modern" data-tab="historial">
                <i class="fas fa-history"></i>
                Historial
            </button>
        </div>

        <div class="tabs-content-modern">
            <!-- Tab: Especificaciones -->
            <div class="tab-content-modern active" data-tab="especificaciones">
                <div class="content-grid-modern">
                    <!-- Especificaciones Técnicas -->
                    <div class="system-card-modern">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <span>Especificaciones Técnicas</span>
                                </div>
                            </div>
                            
                            <div class="card-content-modern">
                                <div class="specs-grid">
                                    <div class="spec-item">
                                        <div class="spec-icon">
                                            <i class="fas fa-cog"></i>
                                        </div>
                                        <div class="spec-content">
                                            <div class="spec-label">Número de Motor</div>
                                            <div class="spec-value"><?= htmlspecialchars($vehiculo['numero_motor'] ?? 'No especificado') ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="spec-item">
                                        <div class="spec-icon">
                                            <i class="fas fa-hashtag"></i>
                                        </div>
                                        <div class="spec-content">
                                            <div class="spec-label">Número de Chasis</div>
                                            <div class="spec-value"><?= htmlspecialchars($vehiculo['numero_chasis'] ?? 'No especificado') ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="spec-item">
                                        <div class="spec-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="spec-content">
                                            <div class="spec-label">Capacidad</div>
                                            <div class="spec-value"><?= htmlspecialchars($vehiculo['capacidad_pasajeros'] ?? '0') ?> pasajeros</div>
                                        </div>
                                    </div>
                                    
                                    <div class="spec-item">
                                        <div class="spec-icon">
                                            <i class="fas fa-gas-pump"></i>
                                        </div>
                                        <div class="spec-content">
                                            <div class="spec-label">Combustible</div>
                                            <div class="spec-value"><?= ucfirst(htmlspecialchars($vehiculo['tipo_combustible'] ?? 'No especificado')) ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="spec-item">
                                        <div class="spec-icon">
                                            <i class="fas fa-cogs"></i>
                                        </div>
                                        <div class="spec-content">
                                            <div class="spec-label">Transmisión</div>
                                            <div class="spec-value"><?= ucfirst(htmlspecialchars($vehiculo['transmision'] ?? 'No especificado')) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>

                    <!-- Características -->
                    <div class="system-card-modern">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>Características</span>
                                </div>
                            </div>
                            
                            <div class="card-content-modern">
                                <div class="characteristics-grid">
                                    <?php 
                                    $caracteristicas_iconos = [
                                        'aire_acondicionado' => ['icon' => 'fas fa-snowflake', 'label' => 'Aire Acondicionado'],
                                        'gps' => ['icon' => 'fas fa-map-marked-alt', 'label' => 'GPS'],
                                        'bluetooth' => ['icon' => 'fab fa-bluetooth', 'label' => 'Bluetooth'],
                                        'usb' => ['icon' => 'fab fa-usb', 'label' => 'Puerto USB'],
                                        'wifi' => ['icon' => 'fas fa-wifi', 'label' => 'WiFi'],
                                        'camara_retroceso' => ['icon' => 'fas fa-video', 'label' => 'Cámara de Retroceso']
                                    ];
                                    
                                    $caracteristicas_vehiculo = isset($vehiculo['caracteristicas']) ? json_decode($vehiculo['caracteristicas'], true) ?? [] : [];
                                    
                                    if (!empty($caracteristicas_vehiculo)):
                                        foreach ($caracteristicas_vehiculo as $caracteristica):
                                            if (isset($caracteristicas_iconos[$caracteristica])):
                                    ?>
                                        <div class="characteristic-item active">
                                            <div class="characteristic-icon">
                                                <i class="<?= $caracteristicas_iconos[$caracteristica]['icon'] ?>"></i>
                                            </div>
                                            <span><?= $caracteristicas_iconos[$caracteristica]['label'] ?></span>
                                        </div>
                                    <?php 
                                            endif;
                                        endforeach;
                                    else:
                                    ?>
                                        <div class="empty-state-small">
                                            <i class="fas fa-info-circle"></i>
                                            <span>Sin características especificadas</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                </div>
            </div>

            <!-- Tab: Documentación -->
            <div class="tab-content-modern" data-tab="documentacion">
                <div class="content-grid-modern">
                    <!-- RUAT -->
                    <div class="system-card-modern document-card">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <span>RUAT</span>
                                </div>
                                <?php if (!empty($vehiculo['archivo_ruat'])): ?>
                                    <a href="<?= $vehiculo['archivo_ruat'] ?>" target="_blank" class="btn-modern btn-sm btn-outline">
                                        <i class="fas fa-external-link-alt"></i>
                                        Ver documento
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-content-modern">
                                <div class="document-info">
                                    <div class="doc-detail">
                                        <span class="doc-label">Número:</span>
                                        <span class="doc-value"><?= htmlspecialchars($vehiculo['ruat'] ?? 'No especificado') ?></span>
                                    </div>
                                    <div class="doc-detail">
                                        <span class="doc-label">Vencimiento:</span>
                                        <span class="doc-value">
                                            <?php if (!empty($vehiculo['fecha_vencimiento_ruat'])): ?>
                                                <?php 
                                                $fecha = new DateTime($vehiculo['fecha_vencimiento_ruat']);
                                                $hoy = new DateTime();
                                                $diff = $hoy->diff($fecha);
                                                ?>
                                                <?= $fecha->format('d/m/Y') ?>
                                                <?php if ($fecha < $hoy): ?>
                                                    <span class="status-danger">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        Vencido
                                                    </span>
                                                <?php elseif ($diff->days <= 30): ?>
                                                    <span class="status-warning">
                                                        <i class="fas fa-clock"></i>
                                                        Por vencer
                                                    </span>
                                                <?php else: ?>
                                                    <span class="status-success">
                                                        <i class="fas fa-check-circle"></i>
                                                        Vigente
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                No especificado
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>

                    <!-- SOAT -->
                    <div class="system-card-modern document-card">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <span>SOAT</span>
                                </div>
                                <?php if (!empty($vehiculo['archivo_soat'])): ?>
                                    <a href="<?= $vehiculo['archivo_soat'] ?>" target="_blank" class="btn-modern btn-sm btn-outline">
                                        <i class="fas fa-external-link-alt"></i>
                                        Ver documento
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-content-modern">
                                <div class="document-info">
                                    <div class="doc-detail">
                                        <span class="doc-label">Número:</span>
                                        <span class="doc-value"><?= htmlspecialchars($vehiculo['soat'] ?? 'No especificado') ?></span>
                                    </div>
                                    <div class="doc-detail">
                                        <span class="doc-label">Vencimiento:</span>
                                        <span class="doc-value">
                                            <?php if (!empty($vehiculo['fecha_vencimiento_soat'])): ?>
                                                <?php 
                                                $fecha = new DateTime($vehiculo['fecha_vencimiento_soat']);
                                                $hoy = new DateTime();
                                                $diff = $hoy->diff($fecha);
                                                ?>
                                                <?= $fecha->format('d/m/Y') ?>
                                                <?php if ($fecha < $hoy): ?>
                                                    <span class="status-danger">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        Vencido
                                                    </span>
                                                <?php elseif ($diff->days <= 30): ?>
                                                    <span class="status-warning">
                                                        <i class="fas fa-clock"></i>
                                                        Por vencer
                                                    </span>
                                                <?php else: ?>
                                                    <span class="status-success">
                                                        <i class="fas fa-check-circle"></i>
                                                        Vigente
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                No especificado
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>

                    <!-- Revisión Técnica -->
                    <div class="system-card-modern document-card">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <span>Revisión Técnica</span>
                                </div>
                                <?php if (!empty($vehiculo['archivo_revision'])): ?>
                                    <a href="<?= $vehiculo['archivo_revision'] ?>" target="_blank" class="btn-modern btn-sm btn-outline">
                                        <i class="fas fa-external-link-alt"></i>
                                        Ver documento
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-content-modern">
                                <div class="document-info">
                                    <div class="doc-detail">
                                        <span class="doc-label">Número:</span>
                                        <span class="doc-value"><?= htmlspecialchars($vehiculo['revision_tecnica'] ?? 'No especificado') ?></span>
                                    </div>
                                    <div class="doc-detail">
                                        <span class="doc-label">Vencimiento:</span>
                                        <span class="doc-value">
                                            <?php if (!empty($vehiculo['fecha_vencimiento_revision'])): ?>
                                                <?php 
                                                $fecha = new DateTime($vehiculo['fecha_vencimiento_revision']);
                                                $hoy = new DateTime();
                                                $diff = $hoy->diff($fecha);
                                                ?>
                                                <?= $fecha->format('d/m/Y') ?>
                                                <?php if ($fecha < $hoy): ?>
                                                    <span class="status-danger">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        Vencido
                                                    </span>
                                                <?php elseif ($diff->days <= 30): ?>
                                                    <span class="status-warning">
                                                        <i class="fas fa-clock"></i>
                                                        Por vencer
                                                    </span>
                                                <?php else: ?>
                                                    <span class="status-success">
                                                        <i class="fas fa-check-circle"></i>
                                                        Vigente
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                No especificado
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                </div>
            </div>

            <!-- Tab: Conductor -->
            <div class="tab-content-modern" data-tab="conductor">
                <?php if (!empty($vehiculo['conductor_id']) && isset($conductor_asignado)): ?>
                    <div class="system-card-modern conductor-card">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span>Conductor Asignado</span>
                                </div>
                                <a href="/admin/conductores/<?= $conductor_asignado['id'] ?>" class="btn-modern btn-sm btn-outline">
                                    <i class="fas fa-eye"></i>
                                    Ver perfil
                                </a>
                            </div>
                            
                            <div class="card-content-modern">
                                <div class="conductor-profile-modern">
                                    <div class="conductor-avatar-modern">
                                        <img src="<?= $conductor_asignado['foto'] ?? '/assets/images/default-avatar.png' ?>" alt="<?= htmlspecialchars($conductor_asignado['nombre']) ?>">
                                    </div>
                                    <div class="conductor-info-modern">
                                        <h3><?= htmlspecialchars($conductor_asignado['nombre'] . ' ' . $conductor_asignado['apellido']) ?></h3>
                                        <div class="conductor-details-modern">
                                            <div class="detail-row">
                                                <span class="detail-label">Licencia:</span>
                                                <span class="detail-value"><?= htmlspecialchars($conductor_asignado['licencia'] ?? 'No especificada') ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Teléfono:</span>
                                                <span class="detail-value"><?= htmlspecialchars($conductor_asignado['telefono'] ?? 'No especificado') ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Email:</span>
                                                <span class="detail-value"><?= htmlspecialchars($conductor_asignado['email'] ?? 'No especificado') ?></span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Fecha de asignación:</span>
                                                <span class="detail-value"><?= date('d/m/Y', strtotime($conductor_asignado['fecha_asignacion'] ?? 'now')) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Estadísticas del conductor con este vehículo -->
                                <div class="conductor-stats-modern">
                                    <h4>Estadísticas con este vehículo</h4>
                                    <div class="stats-row-modern">
                                        <div class="stat-item-small">
                                            <div class="stat-value"><?= $conductor_asignado['viajes_vehiculo'] ?? 0 ?></div>
                                            <div class="stat-label">Viajes realizados</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-value"><?= number_format($conductor_asignado['km_vehiculo'] ?? 0) ?></div>
                                            <div class="stat-label">Kilómetros</div>
                                        </div>
                                        <div class="stat-item-small">
                                            <div class="stat-value">$<?= number_format($conductor_asignado['ingresos_vehiculo'] ?? 0, 2) ?></div>
                                            <div class="stat-label">Ingresos generados</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                <?php else: ?>
                    <div class="system-card-modern">
                        <div class="system-card-background">
                            <div class="card-content-modern">
                                <div class="empty-state-modern">
                                    <div class="empty-icon-modern">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                    <h3>Sin conductor asignado</h3>
                                    <p>Este vehículo no tiene ningún conductor asignado actualmente.</p>
                                    <a href="/admin/vehiculos/<?= $vehiculo['id'] ?>/editar" class="btn-modern btn-primary">
                                        <span class="btn-icon"><i class="fas fa-user-plus"></i></span>
                                        <span class="btn-text">Asignar Conductor</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tab: Mantenimiento -->
            <div class="tab-content-modern" data-tab="mantenimiento">
                <div class="content-grid-modern">
                    <!-- Próximo Mantenimiento -->
                    <div class="system-card-modern">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <span>Próximo Mantenimiento</span>
                                </div>
                            </div>
                            
                            <div class="card-content-modern">
                                <?php if (!empty($vehiculo['proximo_mantenimiento'])): ?>
                                    <div class="maintenance-info-modern">
                                        <div class="maintenance-date">
                                            <i class="fas fa-calendar-check"></i>
                                            <span><?= date('d/m/Y', strtotime($vehiculo['proximo_mantenimiento'])) ?></span>
                                        </div>
                                        <?php if (!empty($vehiculo['km_proximo_mantenimiento'])): ?>
                                            <div class="maintenance-km">
                                                <i class="fas fa-tachometer-alt"></i>
                                                <span><?= number_format($vehiculo['km_proximo_mantenimiento']) ?> km</span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php 
                                        $fecha_mantenimiento = new DateTime($vehiculo['proximo_mantenimiento']);
                                        $hoy = new DateTime();
                                        $diff = $hoy->diff($fecha_mantenimiento);
                                        ?>
                                        
                                        <?php if ($fecha_mantenimiento < $hoy): ?>
                                            <div class="maintenance-alert alert-danger">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Mantenimiento atrasado por <?= $diff->days ?> días
                                            </div>
                                        <?php elseif ($diff->days <= 7): ?>
                                            <div class="maintenance-alert alert-warning">
                                                <i class="fas fa-clock"></i>
                                                Mantenimiento próximo en <?= $diff->days ?> días
                                            </div>
                                        <?php else: ?>
                                            <div class="maintenance-alert alert-info">
                                                <i class="fas fa-info-circle"></i>
                                                Faltan <?= $diff->days ?> días para mantenimiento
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="empty-state-small">
                                        <i class="fas fa-calendar-times"></i>
                                        <span>No hay mantenimiento programado</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>

                    <!-- Historial de Mantenimientos -->
                    <div class="system-card-modern">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                    <span>Historial de Mantenimientos</span>
                                </div>
                                <button class="btn-modern btn-sm btn-primary" onclick="openMaintenanceModal()">
                                    <i class="fas fa-plus"></i>
                                    Nuevo Mantenimiento
                                </button>
                            </div>
                            
                            <div class="card-content-modern">
                                <?php if (isset($mantenimientos) && !empty($mantenimientos)): ?>
                                    <div class="maintenance-history-modern">
                                        <?php foreach ($mantenimientos as $mantenimiento): ?>
                                            <div class="maintenance-item-modern">
                                                <div class="maintenance-header-modern">
                                                    <h4><?= htmlspecialchars($mantenimiento['tipo']) ?></h4>
                                                    <span class="maintenance-date"><?= date('d/m/Y', strtotime($mantenimiento['fecha'])) ?></span>
                                                </div>
                                                <div class="maintenance-details-modern">
                                                    <p><?= htmlspecialchars($mantenimiento['descripcion']) ?></p>
                                                    <div class="maintenance-meta-modern">
                                                        <span class="maintenance-cost">$<?= number_format($mantenimiento['costo'], 2) ?></span>
                                                        <span class="maintenance-km"><?= number_format($mantenimiento['kilometraje']) ?> km</span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="empty-state-modern">
                                        <div class="empty-icon-modern">
                                            <i class="fas fa-tools"></i>
                                        </div>
                                        <h3>Sin mantenimientos registrados</h3>
                                        <p>No se han registrado mantenimientos para este vehículo.</p>
                                        <button class="btn-modern btn-primary" onclick="openMaintenanceModal()">
                                            <span class="btn-icon"><i class="fas fa-plus"></i></span>
                                            <span class="btn-text">Registrar Primer Mantenimiento</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                </div>
            </div>

            <!-- Tab: Historial -->
            <div class="tab-content-modern" data-tab="historial">
                <div class="system-card-modern">
                    <div class="system-card-background">
                        <div class="card-header-modern">
                            <div class="card-title-modern">
                                <div class="title-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <span>Historial de Actividades</span>
                            </div>
                        </div>
                        
                        <div class="card-content-modern">
                            <div class="timeline-modern">
                                <?php if (isset($historial_actividades) && !empty($historial_actividades)): ?>
                                    <?php foreach ($historial_actividades as $actividad): ?>
                                        <div class="timeline-item-modern">
                                            <div class="timeline-marker-modern <?= $actividad['tipo'] ?? 'info' ?>">
                                                <i class="<?= $actividad['icono'] ?? 'fas fa-circle' ?>"></i>
                                            </div>
                                            <div class="timeline-content-modern">
                                                <div class="timeline-header-modern">
                                                    <h4><?= htmlspecialchars($actividad['titulo']) ?></h4>
                                                    <span class="timeline-date-modern"><?= date('d/m/Y H:i', strtotime($actividad['fecha'])) ?></span>
                                                </div>
                                                <p><?= htmlspecialchars($actividad['descripcion']) ?></p>
                                                <?php if (!empty($actividad['detalles'])): ?>
                                                    <div class="timeline-details-modern">
                                                        <?= $actividad['detalles'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="timeline-item-modern">
                                        <div class="timeline-marker-modern success">
                                            <i class="fas fa-plus-circle"></i>
                                        </div>
                                        <div class="timeline-content-modern">
                                            <div class="timeline-header-modern">
                                                <h4>Vehículo Registrado</h4>
                                                <span class="timeline-date-modern"><?= date('d/m/Y H:i', strtotime($vehiculo['created_at'] ?? 'now')) ?></span>
                                            </div>
                                            <p>El vehículo fue registrado en el sistema por primera vez.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="empty-state-modern">
                                        <div class="empty-icon-modern">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <h3>Sin actividades adicionales</h3>
                                        <p>No se han registrado actividades adicionales para este vehículo.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="system-card-glow"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Observaciones -->
    <?php if (!empty($vehiculo['observaciones'])): ?>
        <div class="system-card-modern" data-aos="fade-up" data-aos-delay="400">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <span>Observaciones</span>
                    </div>
                </div>
                
                <div class="card-content-modern">
                    <div class="observations-content">
                        <p><?= nl2br(htmlspecialchars($vehiculo['observaciones'])) ?></p>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true
        });
    }

    // Sistema de tabs
    initializeTabs();
    
    console.log('Vehicle profile initialized');
});

function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button-modern');
    const tabContents = document.querySelectorAll('.tab-content-modern');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remover clase active de todos los botones y contenidos
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Activar botón y contenido correspondiente
            this.classList.add('active');
            document.querySelector(`[data-tab="${targetTab}"].tab-content-modern`).classList.add('active');
        });
    });
}

function openPhotoModal() {
    // Implementar modal para ver foto completa
    console.log('Open photo modal');
}

function openMaintenanceModal() {
    // Implementar modal para nuevo mantenimiento
    console.log('Open maintenance modal');
}
</script>

<style>
/* Estilos específicos para perfil de vehículo */
.vehicle-profile {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
}

.vehicle-status-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-right: 1rem;
}

.vehicle-status-badge.status-disponible {
    background: rgba(34, 197, 94, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.vehicle-status-badge.status-ocupado {
    background: rgba(59, 130, 246, 0.1);
    color: var(--info-color);
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.vehicle-status-badge.status-mantenimiento {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning-color);
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.vehicle-status-badge.status-inactivo {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.vehicle-overview-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.vehicle-photo-card {
    min-height: 400px;
}

.vehicle-photo-section {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.vehicle-main-photo {
    flex: 1;
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    min-height: 250px;
    margin-bottom: 1.5rem;
}

.vehicle-main-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.vehicle-main-photo:hover .photo-overlay {
    opacity: 1;
}

.vehicle-basic-info h3 {
    margin: 0 0 1rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    text-align: center;
}

.vehicle-details-grid {
    display: grid;
    gap: 0.75rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-color);
}

.detail-label {
    font-weight: 600;
    color: var(--text-secondary);
}

.detail-value {
    color: var(--text-primary);
}

.vehicle-stats-card .card-content-modern {
    padding: 1.5rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.stat-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--primary-color);
    color: white;
    font-size: 1.25rem;
}

.stat-content {
    flex: 1;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.content-grid-modern {
    display: grid;
    gap: 2rem;
}

.specs-grid {
    display: grid;
    gap: 1rem;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.spec-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--primary-color);
    color: white;
}

.spec-content {
    flex: 1;
}

.spec-label {
    font-weight: 600;
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.spec-value {
    color: var(--text-primary);
    font-size: 1rem;
}

.characteristics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.characteristic-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.characteristic-item.active {
    border-color: var(--success-color);
    background: rgba(34, 197, 94, 0.05);
}

.characteristic-icon {
    color: var(--success-color);
    font-size: 1.25rem;
}

.document-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.doc-detail {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-color);
}

.doc-label {
    font-weight: 600;
    color: var(--text-secondary);
}

.doc-value {
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.status-success {
    color: var(--success-color);
}

.status-warning {
    color: var(--warning-color);
}

.status-danger {
    color: var(--danger-color);
}

.conductor-profile-modern {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.conductor-avatar-modern {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid var(--border-color);
}

.conductor-avatar-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.conductor-info-modern {
    flex: 1;
}

.conductor-info-modern h3 {
    margin: 0 0 1rem 0;
    color: var(--text-primary);
    font-size: 1.25rem;
}

.conductor-details-modern {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.detail-row {
    display: flex;
    gap: 1rem;
}

.detail-row .detail-label {
    min-width: 100px;
    font-weight: 600;
    color: var(--text-secondary);
}

.conductor-stats-modern h4 {
    margin: 0 0 1rem 0;
    color: var(--text-primary);
    font-size: 1rem;
    font-weight: 600;
}

.stats-row-modern {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}

.stat-item-small {
    text-align: center;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.stat-item-small .stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.stat-item-small .stat-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.maintenance-info-modern {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.maintenance-date,
.maintenance-km {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
}

.maintenance-alert {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    border-radius: 8px;
    font-weight: 600;
    margin-top: 1rem;
}

.maintenance-alert.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.maintenance-alert.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning-color);
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.maintenance-alert.alert-info {
    background: rgba(59, 130, 246, 0.1);
    color: var(--info-color);
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.maintenance-history-modern {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.maintenance-item-modern {
    padding: 1.5rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.maintenance-header-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.maintenance-header-modern h4 {
    margin: 0;
    color: var(--text-primary);
    font-weight: 600;
}

.maintenance-date {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.maintenance-details-modern p {
    margin: 0 0 1rem 0;
    color: var(--text-secondary);
    line-height: 1.5;
}

.maintenance-meta-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

.maintenance-cost {
    font-weight: 600;
    color: var(--success-color);
    font-size: 1rem;
}

.maintenance-km {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.observations-content {
    padding: 1.5rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.observations-content p {
    margin: 0;
    color: var(--text-primary);
    line-height: 1.6;
}

.empty-state-small {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    color: var(--text-secondary);
    font-style: italic;
    justify-content: center;
}

/* Responsive design */
@media (max-width: 1024px) {
    .vehicle-overview-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .characteristics-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .vehicle-overview-grid {
        gap: 1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .characteristics-grid {
        grid-template-columns: 1fr;
    }
    
    .conductor-profile-modern {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .stats-row-modern {
        grid-template-columns: 1fr;
    }
    
    .maintenance-meta-modern {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .stat-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .spec-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .characteristic-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>