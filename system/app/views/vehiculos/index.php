<?php
/**
 * Vista Index Vehículos - Sistema PRIMERO DE JUNIO
 */

$title = 'Gestión de Vehículos';
$current_page = 'vehiculos';

ob_start();
?>

<!-- Page Header -->
<div class="page-header-modern">
    <div class="container-modern">
        <div class="header-content-grid">
            <div class="header-left">
                <h1 class="page-title-modern">
                    <div class="title-icon admin">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Gestión de Vehículos</span>
                        <span class="title-subtitle">Control de flota y mantenimiento</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/vehiculos/crear" class="btn-modern btn-primary">
                        <span class="btn-icon"><i class="fas fa-plus"></i></span>
                        <span class="btn-text">Nuevo Vehículo</span>
                    </a>
                    <div class="dropdown-modern">
                        <button class="btn-modern btn-outline dropdown-toggle" data-dropdown="opciones-vehiculos">
                            <span class="btn-icon"><i class="fas fa-cog"></i></span>
                            <span class="btn-text">Opciones</span>
                        </button>
                        <div class="dropdown-menu-modern" id="opciones-vehiculos">
                            <a href="/admin/vehiculos/mantenimientos" class="dropdown-item-modern">
                                <i class="fas fa-tools"></i> Mantenimientos
                            </a>
                            <a href="/admin/vehiculos/asignaciones" class="dropdown-item-modern">
                                <i class="fas fa-user-tie"></i> Asignaciones
                            </a>
                            <div class="dropdown-divider-modern"></div>
                            <a href="/admin/vehiculos/exportar?formato=excel" class="dropdown-item-modern">
                                <i class="fas fa-file-excel"></i> Exportar Excel
                            </a>
                            <a href="/admin/vehiculos/exportar?formato=pdf" class="dropdown-item-modern">
                                <i class="fas fa-file-pdf"></i> Exportar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section-modern">
    <div class="container-modern">
        <div class="stats-grid-modern">
            <div class="stats-card-modern primary" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['total'] ?? 0 ?></div>
                        <div class="stats-label-modern">Total Vehículos</div>
                        <div class="stats-change-modern">
                            <span>Registrados</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow primary"></div>
            </div>
            
            <div class="stats-card-modern success" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['disponibles'] ?? 0 ?></div>
                        <div class="stats-label-modern">Disponibles</div>
                        <div class="stats-change-modern positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>Operativos</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow success"></div>
            </div>
            
            <div class="stats-card-modern warning" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['en_mantenimiento'] ?? 0 ?></div>
                        <div class="stats-label-modern">En Mantenimiento</div>
                        <div class="stats-change-modern">
                            <i class="fas fa-wrench"></i>
                            <span>Temporales</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow warning"></div>
            </div>
            
            <div class="stats-card-modern info" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['asignados'] ?? 0 ?></div>
                        <div class="stats-label-modern">Asignados</div>
                        <div class="stats-change-modern">
                            <i class="fas fa-link"></i>
                            <span>Conductores</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow info"></div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Filters -->
<div class="container-modern">
    <div class="system-card-modern quick-filters-card" data-aos="fade-up" data-aos-delay="500">
        <div class="system-card-background">
            <div class="card-content-modern">
                <div class="quick-filters-modern">
                    <button class="filter-btn-modern active" data-filter="todos" onclick="filterVehiculos('todos')">
                        <i class="fas fa-car"></i>
                        <span>Todos</span>
                        <span class="filter-count"><?= $estadisticas['total'] ?? 0 ?></span>
                    </button>
                    
                    <button class="filter-btn-modern" data-filter="disponible" onclick="filterVehiculos('disponible')">
                        <i class="fas fa-check-circle"></i>
                        <span>Disponibles</span>
                        <span class="filter-count"><?= $estadisticas['disponibles'] ?? 0 ?></span>
                    </button>
                    
                    <button class="filter-btn-modern" data-filter="ocupado" onclick="filterVehiculos('ocupado')">
                        <i class="fas fa-route"></i>
                        <span>En Servicio</span>
                        <span class="filter-count"><?= $estadisticas['ocupados'] ?? 0 ?></span>
                    </button>
                    
                    <button class="filter-btn-modern" data-filter="mantenimiento" onclick="filterVehiculos('mantenimiento')">
                        <i class="fas fa-tools"></i>
                        <span>Mantenimiento</span>
                        <span class="filter-count"><?= $estadisticas['en_mantenimiento'] ?? 0 ?></span>
                    </button>
                    
                    <button class="filter-btn-modern" data-filter="inactivo" onclick="filterVehiculos('inactivo')">
                        <i class="fas fa-pause-circle"></i>
                        <span>Inactivos</span>
                        <span class="filter-count"><?= $estadisticas['inactivos'] ?? 0 ?></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="system-card-glow"></div>
    </div>

    <!-- Advanced Filters -->
    <div class="system-card-modern filters-card" data-aos="fade-up" data-aos-delay="600">
        <div class="system-card-background">
            <div class="card-header-modern">
                <div class="card-title-modern">
                    <div class="title-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <span>Búsqueda Avanzada</span>
                </div>
                <button class="btn-modern btn-sm btn-outline" id="clearFilters">
                    <span class="btn-icon"><i class="fas fa-times"></i></span>
                    <span class="btn-text">Limpiar</span>
                </button>
            </div>
            
            <div class="card-content-modern">
                <form class="filters-form-modern" method="GET" id="filtersForm">
                    <div class="filters-grid-modern">
                        <div class="form-group-modern">
                            <label class="form-label-modern">Buscar Vehículo</label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input type="text" 
                                       class="form-input-modern" 
                                       name="buscar" 
                                       value="<?= htmlspecialchars($filtros['buscar'] ?? '') ?>"
                                       placeholder="Placa, marca, modelo...">
                            </div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">Estado</label>
                            <select class="form-select-modern" name="estado">
                                <option value="">Todos los estados</option>
                                <option value="disponible" <?= ($filtros['estado'] ?? '') === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                                <option value="ocupado" <?= ($filtros['estado'] ?? '') === 'ocupado' ? 'selected' : '' ?>>En Servicio</option>
                                <option value="mantenimiento" <?= ($filtros['estado'] ?? '') === 'mantenimiento' ? 'selected' : '' ?>>Mantenimiento</option>
                                <option value="inactivo" <?= ($filtros['estado'] ?? '') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">Tipo</label>
                            <select class="form-select-modern" name="tipo">
                                <option value="">Todos los tipos</option>
                                <option value="sedan" <?= ($filtros['tipo'] ?? '') === 'sedan' ? 'selected' : '' ?>>Sedán</option>
                                <option value="suv" <?= ($filtros['tipo'] ?? '') === 'suv' ? 'selected' : '' ?>>SUV</option>
                                <option value="hatchback" <?= ($filtros['tipo'] ?? '') === 'hatchback' ? 'selected' : '' ?>>Hatchback</option>
                                <option value="pickup" <?= ($filtros['tipo'] ?? '') === 'pickup' ? 'selected' : '' ?>>Pick-up</option>
                                <option value="van" <?= ($filtros['tipo'] ?? '') === 'van' ? 'selected' : '' ?>>Van</option>
                            </select>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">Conductor</label>
                            <select class="form-select-modern" name="conductor_id">
                                <option value="">Sin filtro</option>
                                <option value="0" <?= ($filtros['conductor_id'] ?? '') === '0' ? 'selected' : '' ?>>Sin asignar</option>
                                <?php foreach ($conductores ?? [] as $conductor): ?>
                                    <option value="<?= $conductor['id'] ?>" <?= ($filtros['conductor_id'] ?? '') == $conductor['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">&nbsp;</label>
                            <button type="submit" class="btn-modern btn-primary btn-sm">
                                <span class="btn-icon"><i class="fas fa-search"></i></span>
                                <span class="btn-text">Buscar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="system-card-glow"></div>
    </div>

    <!-- Vehicles List -->
    <div class="system-card-modern table-card" data-aos="fade-up" data-aos-delay="700">
        <div class="system-card-background">
            <div class="card-header-modern">
                <div class="card-title-modern">
                    <div class="title-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <span>Lista de Vehículos (<?= count($vehiculos) ?>)</span>
                </div>
                <div class="card-actions-modern">
                    <div class="view-toggle-modern">
                        <button class="btn-modern btn-sm btn-outline view-toggle active" data-view="table">
                            <i class="fas fa-table"></i>
                        </button>
                        <button class="btn-modern btn-sm btn-outline view-toggle" data-view="cards">
                            <i class="fas fa-th-large"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="card-content-modern">
                <!-- Table View -->
                <div class="table-view-modern active" id="tableView">
                    <div class="table-container-modern">
                        <table class="table-modern" id="vehiculosTable">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Vehículo</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Especificaciones</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Conductor</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Estado</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Kilometraje</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Mantenimiento</span>
                                        </div>
                                    </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vehiculos as $vehiculo): ?>
                                    <tr class="table-row-modern vehiculo-row" 
                                        data-vehiculo-id="<?= $vehiculo['id'] ?>"
                                        data-estado="<?= $vehiculo['estado'] ?>"
                                        data-tipo="<?= $vehiculo['tipo'] ?>">
                                        <td>
                                            <div class="vehicle-cell-modern">
                                                <div class="vehicle-image-modern">
                                                    <?php if (!empty($vehiculo['foto'])): ?>
                                                        <img src="/uploads/vehiculos/<?= htmlspecialchars($vehiculo['foto']) ?>" alt="Vehículo">
                                                    <?php else: ?>
                                                        <div class="vehicle-placeholder-modern">
                                                            <i class="fas fa-car"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="vehicle-status-dot <?= $vehiculo['estado'] ?>"></div>
                                                </div>
                                                <div class="vehicle-info-modern">
                                                    <span class="vehicle-plate-modern">
                                                        <?= htmlspecialchars($vehiculo['placa']) ?>
                                                    </span>
                                                    <span class="vehicle-brand-modern">
                                                        <?= htmlspecialchars($vehiculo['marca'] . ' ' . $vehiculo['modelo']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="specs-info-modern">
                                                <div class="spec-item-modern">
                                                    <i class="fas fa-palette"></i>
                                                    <span><?= htmlspecialchars($vehiculo['color']) ?></span>
                                                </div>
                                                <div class="spec-item-modern">
                                                    <i class="fas fa-calendar"></i>
                                                    <span><?= htmlspecialchars($vehiculo['anio']) ?></span>
                                                </div>
                                                <div class="spec-item-modern">
                                                    <i class="fas fa-car-side"></i>
                                                    <span><?= ucfirst($vehiculo['tipo']) ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if (!empty($vehiculo['conductor_nombre'])): ?>
                                                <div class="driver-info-modern">
                                                    <div class="driver-avatar-small">
                                                        <?= strtoupper(substr($vehiculo['conductor_nombre'], 0, 1)) ?>
                                                    </div>
                                                    <div class="driver-details">
                                                        <span class="driver-name"><?= htmlspecialchars($vehiculo['conductor_nombre']) ?></span>
                                                        <span class="driver-phone"><?= htmlspecialchars($vehiculo['conductor_telefono']) ?></span>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="no-driver">
                                                    <i class="fas fa-user-slash"></i>
                                                    <span>Sin asignar</span>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="status-badge-modern <?= $vehiculo['estado'] ?>">
                                                <?php
                                                switch($vehiculo['estado']) {
                                                    case 'disponible':
                                                        echo '<i class="fas fa-check-circle"></i> Disponible';
                                                        break;
                                                    case 'ocupado':
                                                        echo '<i class="fas fa-route"></i> En Servicio';
                                                        break;
                                                    case 'mantenimiento':
                                                        echo '<i class="fas fa-tools"></i> Mantenimiento';
                                                        break;
                                                    case 'inactivo':
                                                        echo '<i class="fas fa-pause-circle"></i> Inactivo';
                                                        break;
                                                    default:
                                                        echo ucfirst($vehiculo['estado']);
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="mileage-info-modern">
                                                <span class="mileage-number">
                                                    <?= number_format($vehiculo['kilometraje'] ?? 0) ?>
                                                </span>
                                                <span class="mileage-unit">km</span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if (!empty($vehiculo['proximo_mantenimiento'])): ?>
                                                <div class="maintenance-info-modern">
                                                    <?php
                                                    $diasRestantes = floor((strtotime($vehiculo['proximo_mantenimiento']) - time()) / 86400);
                                                    $urgencia = $diasRestantes <= 7 ? 'urgent' : ($diasRestantes <= 30 ? 'warning' : 'normal');
                                                    ?>
                                                    <div class="maintenance-badge <?= $urgencia ?>">
                                                        <i class="fas fa-<?= $urgencia === 'urgent' ? 'exclamation-triangle' : 'calendar' ?>"></i>
                                                        <span><?= $diasRestantes ?> días</span>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <span class="no-maintenance">No programado</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="actions-modern">
                                                <a href="/admin/vehiculos/perfil/<?= $vehiculo['id'] ?>" 
                                                   class="btn-modern btn-sm btn-outline" 
                                                   title="Ver Perfil">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/admin/vehiculos/editar/<?= $vehiculo['id'] ?>" 
                                                   class="btn-modern btn-sm btn-primary" 
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn-modern btn-sm btn-info" 
                                                        onclick="asignarConductor(<?= $vehiculo['id'] ?>)"
                                                        title="Asignar Conductor">
                                                    <i class="fas fa-user-plus"></i>
                                                </button>
                                                <?php if ($vehiculo['estado'] !== 'mantenimiento'): ?>
                                                    <button class="btn-modern btn-sm btn-warning" 
                                                            onclick="programarMantenimiento(<?= $vehiculo['id'] ?>)"
                                                            title="Programar Mantenimiento">
                                                        <i class="fas fa-tools"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Cards View -->
                <div class="cards-view-modern" id="cardsView">
                    <div class="vehicles-cards-grid-modern">
                        <?php foreach ($vehiculos as $vehiculo): ?>
                            <div class="vehicle-card-modern" 
                                 data-aos="fade-up" 
                                 data-aos-delay="100"
                                 data-estado="<?= $vehiculo['estado'] ?>"
                                 data-tipo="<?= $vehiculo['tipo'] ?>">
                                <div class="vehicle-card-background">
                                    <div class="vehicle-card-header">
                                        <div class="vehicle-image-large">
                                            <?php if (!empty($vehiculo['foto'])): ?>
                                                <img src="/uploads/vehiculos/<?= htmlspecialchars($vehiculo['foto']) ?>" alt="Vehículo">
                                            <?php else: ?>
                                                <div class="vehicle-placeholder-large">
                                                    <i class="fas fa-car"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="vehicle-status-large <?= $vehiculo['estado'] ?>"></div>
                                        </div>
                                        <span class="status-badge-modern <?= $vehiculo['estado'] ?>">
                                            <?= ucfirst($vehiculo['estado']) ?>
                                        </span>
                                    </div>
                                    
                                    <div class="vehicle-card-content">
                                        <h3 class="vehicle-plate-large">
                                            <?= htmlspecialchars($vehiculo['placa']) ?>
                                        </h3>
                                        <h4 class="vehicle-brand-large">
                                            <?= htmlspecialchars($vehiculo['marca'] . ' ' . $vehiculo['modelo']) ?>
                                        </h4>
                                        
                                        <div class="vehicle-card-specs">
                                            <div class="spec-row">
                                                <i class="fas fa-palette"></i>
                                                <span><?= htmlspecialchars($vehiculo['color']) ?></span>
                                            </div>
                                            <div class="spec-row">
                                                <i class="fas fa-calendar"></i>
                                                <span><?= htmlspecialchars($vehiculo['anio']) ?></span>
                                            </div>
                                            <div class="spec-row">
                                                <i class="fas fa-tachometer-alt"></i>
                                                <span><?= number_format($vehiculo['kilometraje'] ?? 0) ?> km</span>
                                            </div>
                                            <div class="spec-row">
                                                <i class="fas fa-car-side"></i>
                                                <span><?= ucfirst($vehiculo['tipo']) ?></span>
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($vehiculo['conductor_nombre'])): ?>
                                            <div class="driver-card-info">
                                                <div class="driver-icon">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                                <div class="driver-text">
                                                    <span class="driver-name"><?= htmlspecialchars($vehiculo['conductor_nombre']) ?></span>
                                                    <span class="driver-phone"><?= htmlspecialchars($vehiculo['conductor_telefono']) ?></span>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="no-driver-card">
                                                <i class="fas fa-user-slash"></i>
                                                <span>Sin conductor asignado</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="vehicle-card-actions">
                                        <a href="/admin/vehiculos/perfil/<?= $vehiculo['id'] ?>" 
                                           class="btn-modern btn-sm btn-outline">
                                            <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                            <span class="btn-text">Ver</span>
                                        </a>
                                        <a href="/admin/vehiculos/editar/<?= $vehiculo['id'] ?>" 
                                           class="btn-modern btn-sm btn-primary">
                                            <span class="btn-icon"><i class="fas fa-edit"></i></span>
                                            <span class="btn-text">Editar</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="vehicle-card-glow"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="system-card-glow"></div>
    </div>
</div>

<!-- Assignment Modal -->
<div class="modal-modern" id="assignmentModal">
    <div class="modal-overlay-modern" onclick="closeAssignmentModal()"></div>
    <div class="modal-container-modern medium">
        <div class="modal-header-modern">
            <h2>Asignar Conductor</h2>
            <button class="modal-close-modern" onclick="closeAssignmentModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body-modern" id="assignmentContent">
            <!-- El contenido se cargará dinámicamente -->
        </div>
    </div>
</div>

<!-- Maintenance Modal -->
<div class="modal-modern" id="maintenanceModal">
    <div class="modal-overlay-modern" onclick="closeMaintenanceModal()"></div>
    <div class="modal-container-modern medium">
        <div class="modal-header-modern">
            <h2>Programar Mantenimiento</h2>
            <button class="modal-close-modern" onclick="closeMaintenanceModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body-modern" id="maintenanceContent">
            <!-- El contenido se cargará dinámicamente -->
        </div>
    </div>
</div>



<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>