<?php

/**
 * Vista Index Conductores - Sistema PRIMERO DE JUNIO
 */

$title = 'Gestión de Conductores';
$current_page = 'conductores';

ob_start();
?>

<!-- Page Header -->
<div class="page-header-modern">
    <div class="container-modern">
        <div class="header-content-grid">
            <div class="header-left">
                <h1 class="page-title-modern">
                    <div class="title-icon admin">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Gestión de Conductores</span>
                        <span class="title-subtitle">Administrar conductores de mototaxis</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/conductores/crear" class="btn-modern btn-primary">
                        <span class="btn-icon"><i class="fas fa-plus"></i></span>
                        <span class="btn-text">Nuevo Conductor</span>
                    </a>
                    <div class="dropdown-modern">
                        <button class="btn-modern btn-outline dropdown-toggle" data-dropdown="opciones-conductores">
                            <span class="btn-icon"><i class="fas fa-cog"></i></span>
                            <span class="btn-text">Opciones</span>
                        </button>
                        <div class="dropdown-menu-modern" id="opciones-conductores">
                            <a href="/admin/conductores/licencias-vencimiento" class="dropdown-item-modern">
                                <i class="fas fa-exclamation-triangle"></i> Licencias por Vencer
                            </a>
                            <a href="/admin/conductores/estadisticas" class="dropdown-item-modern">
                                <i class="fas fa-chart-bar"></i> Estadísticas
                            </a>
                            <div class="dropdown-divider-modern"></div>
                            <a href="/admin/conductores/exportar?formato=excel" class="dropdown-item-modern">
                                <i class="fas fa-file-excel"></i> Exportar Excel
                            </a>
                            <a href="/admin/conductores/exportar?formato=pdf" class="dropdown-item-modern">
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
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['total'] ?? 0 ?></div>
                        <div class="stats-label-modern">Total Conductores</div>
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
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['activos'] ?? 0 ?></div>
                        <div class="stats-label-modern">Activos</div>
                        <div class="stats-change-modern positive">
                            <i class="fas fa-check"></i>
                            <span>Trabajando</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow success"></div>
            </div>

            <div class="stats-card-modern warning" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['licencias_por_vencer'] ?? 0 ?></div>
                        <div class="stats-label-modern">Licencias por Vencer</div>
                        <div class="stats-change-modern warning">
                            <i class="fas fa-clock"></i>
                            <span>Próximos 30 días</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow warning"></div>
            </div>

            <div class="stats-card-modern info" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['con_vehiculo'] ?? 0 ?></div>
                        <div class="stats-label-modern">Con Vehículo</div>
                        <div class="stats-change-modern">
                            <i class="fas fa-car"></i>
                            <span>Asignados</span>
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
                    <button class="filter-btn-modern active" data-filter="todos" onclick="filterConductores('todos')">
                        <i class="fas fa-users"></i>
                        <span>Todos</span>
                        <span class="filter-count"><?= $estadisticas['total'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="activos" onclick="filterConductores('activos')">
                        <i class="fas fa-user-check"></i>
                        <span>Activos</span>
                        <span class="filter-count"><?= $estadisticas['activos'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="novatos" onclick="filterConductores('novatos')">
                        <i class="fas fa-star"></i>
                        <span>Novatos</span>
                        <span class="filter-count"><?= $estadisticas['por_experiencia']['novatos'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="experimentados" onclick="filterConductores('experimentados')">
                        <i class="fas fa-award"></i>
                        <span>Experimentados</span>
                        <span class="filter-count"><?= $estadisticas['por_experiencia']['experimentados'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="veteranos" onclick="filterConductores('veteranos')">
                        <i class="fas fa-medal"></i>
                        <span>Veteranos</span>
                        <span class="filter-count"><?= $estadisticas['por_experiencia']['veteranos'] ?? 0 ?></span>
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
                            <label class="form-label-modern">Buscar Conductor</label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input type="text"
                                    class="form-input-modern"
                                    name="buscar"
                                    value="<?= htmlspecialchars($filtros['buscar'] ?? '') ?>"
                                    placeholder="Nombre, cédula, licencia...">
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">Estado</label>
                            <select class="form-select-modern" name="estado">
                                <option value="">Todos los estados</option>
                                <option value="activo" <?= ($filtros['estado'] ?? '') === 'activo' ? 'selected' : '' ?>>Activo</option>
                                <option value="inactivo" <?= ($filtros['estado'] ?? '') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                <option value="suspendido" <?= ($filtros['estado'] ?? '') === 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
                            </select>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">Categoría de Licencia</label>
                            <select class="form-select-modern" name="licencia_categoria">
                                <option value="">Todas las categorías</option>
                                <option value="A1" <?= ($filtros['licencia_categoria'] ?? '') === 'A1' ? 'selected' : '' ?>>A1</option>
                                <option value="A2" <?= ($filtros['licencia_categoria'] ?? '') === 'A2' ? 'selected' : '' ?>>A2</option>
                                <option value="B1" <?= ($filtros['licencia_categoria'] ?? '') === 'B1' ? 'selected' : '' ?>>B1</option>
                                <option value="B2" <?= ($filtros['licencia_categoria'] ?? '') === 'B2' ? 'selected' : '' ?>>B2</option>
                                <option value="C1" <?= ($filtros['licencia_categoria'] ?? '') === 'C1' ? 'selected' : '' ?>>C1</option>
                            </select>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">Experiencia</label>
                            <select class="form-select-modern" name="experiencia">
                                <option value="">Toda experiencia</option>
                                <option value="novato" <?= ($filtros['experiencia'] ?? '') === 'novato' ? 'selected' : '' ?>>Novato (0-2 años)</option>
                                <option value="experimentado" <?= ($filtros['experiencia'] ?? '') === 'experimentado' ? 'selected' : '' ?>>Experimentado (3-7 años)</option>
                                <option value="veterano" <?= ($filtros['experiencia'] ?? '') === 'veterano' ? 'selected' : '' ?>>Veterano (8+ años)</option>
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

    <!-- Conductores List -->
    <div class="system-card-modern table-card" data-aos="fade-up" data-aos-delay="700">
        <div class="system-card-background">
            <div class="card-header-modern">
                <div class="card-title-modern">
                    <div class="title-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <span>Lista de Conductores (<?= count($conductores) ?>)</span>
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
                        <table class="table-modern" id="conductoresTable">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Conductor</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Documento</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Licencia</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Experiencia</span>
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
                                            <span>Vehículo</span>
                                        </div>
                                    </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($conductores as $conductor): ?>
                                    <tr class="table-row-modern conductor-row"
                                        data-conductor-id="<?= $conductor['id'] ?>"
                                        data-estado="<?= $conductor['estado'] ?>"
                                        data-experiencia="<?= $conductor['experiencia_anos'] ?>">
                                        <td>
                                            <div class="driver-cell-modern">
                                                <div class="driver-avatar-modern">
                                                    <?php if (!empty($conductor['foto'])): ?>
                                                        <img src="<?= htmlspecialchars($conductor['foto']) ?>"
                                                            alt="Foto">
                                                    <?php else: ?>
                                                        <div class="avatar-placeholder-modern">
                                                            <?= strtoupper(substr($conductor['nombre'], 0, 1) . substr($conductor['apellido'], 0, 1)) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="driver-status-dot <?= $conductor['estado'] ?>"></div>
                                                </div>
                                                <div class="driver-info-modern">
                                                    <span class="driver-name-modern">
                                                        <?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?>
                                                    </span>
                                                    <span class="driver-phone-modern">
                                                        <?= htmlspecialchars($conductor['telefono'] ?? 'N/A') ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="document-info-modern">
                                                <span class="cedula-modern">
                                                    <?= htmlspecialchars($conductor['cedula']) ?>
                                                </span>
                                                <span class="email-modern">
                                                    <?= htmlspecialchars($conductor['email'] ?? 'N/A') ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="license-info-modern">
                                                <span class="license-number-modern">
                                                    <?= htmlspecialchars($conductor['licencia_numero'] ?? 'N/A') ?>
                                                </span>
                                                <div class="license-details-modern">
                                                    <span class="license-category-modern <?= strtolower($conductor['licencia_categoria'] ?? 'sin-categoria') ?>">
                                                        <?= htmlspecialchars($conductor['licencia_categoria'] ?? 'N/A') ?>
                                                    </span>
                                                    <?php if ($conductor['licencia_vigencia']): ?>
                                                        <?php
                                                        $vigencia = new DateTime($conductor['licencia_vigencia']);
                                                        $hoy = new DateTime();
                                                        $diasRestantes = $hoy->diff($vigencia)->days;
                                                        $vencida = $vigencia < $hoy;
                                                        ?>
                                                        <span class="license-expiry-modern <?= $vencida ? 'expired' : ($diasRestantes <= 30 ? 'warning' : 'valid') ?>">
                                                            <?php if ($vencida): ?>
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                                Vencida
                                                            <?php elseif ($diasRestantes <= 30): ?>
                                                                <i class="fas fa-clock"></i>
                                                                <?= $diasRestantes ?> días
                                                            <?php else: ?>
                                                                <i class="fas fa-check"></i>
                                                                Vigente
                                                            <?php endif; ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="experience-modern">
                                                <span class="experience-years">
                                                    <?= $conductor['experiencia_anos'] ?> años
                                                </span>
                                                <span class="experience-level <?=
                                                                                $conductor['experiencia_anos'] <= 2 ? 'novato' : ($conductor['experiencia_anos'] <= 7 ? 'experimentado' : 'veterano')
                                                                                ?>">
                                                    <?php
                                                    if ($conductor['experiencia_anos'] <= 2) {
                                                        echo '<i class="fas fa-star"></i> Novato';
                                                    } elseif ($conductor['experiencia_anos'] <= 7) {
                                                        echo '<i class="fas fa-award"></i> Experimentado';
                                                    } else {
                                                        echo '<i class="fas fa-medal"></i> Veterano';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge-modern <?= $conductor['estado'] ?>">
                                                <?= ucfirst($conductor['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="vehicle-info-modern">
                                                <?php if (!empty($conductor['vehiculo_placa'])): ?>
                                                    <div class="vehicle-assigned">
                                                        <i class="fas fa-motorcycle"></i>
                                                        <span><?= htmlspecialchars($conductor['vehiculo_placa']) ?></span>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="no-vehicle">
                                                        <i class="fas fa-ban"></i>
                                                        Sin asignar
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="actions-modern">
                                                <a href="/admin/conductores/ver/<?= $conductor['id'] ?>"
                                                    class="btn-modern btn-sm btn-outline"
                                                    title="Ver Perfil">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/admin/conductores/editar/<?= $conductor['id'] ?>"
                                                    class="btn-modern btn-sm btn-primary"
                                                    title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php if (empty($conductor['vehiculo_placa'])): ?>
                                                    <button class="btn-modern btn-sm btn-info"
                                                        onclick="asignarVehiculo(<?= $conductor['id'] ?>)"
                                                        title="Asignar Vehículo">
                                                        <i class="fas fa-motorcycle"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn-modern btn-sm btn-warning"
                                                        onclick="desasignarVehiculo(<?= $conductor['id'] ?>)"
                                                        title="Desasignar Vehículo">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <?php if ($conductor['estado'] === 'activo'): ?>
                                                    <button class="btn-modern btn-sm btn-warning"
                                                        onclick="suspenderConductor(<?= $conductor['id'] ?>)"
                                                        title="Suspender">
                                                        <i class="fas fa-pause"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn-modern btn-sm btn-success"
                                                        onclick="activarConductor(<?= $conductor['id'] ?>)"
                                                        title="Activar">
                                                        <i class="fas fa-play"></i>
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
                    <div class="drivers-cards-grid-modern">
                        <?php foreach ($conductores as $conductor): ?>
                            <div class="driver-card-modern"
                                data-aos="fade-up"
                                data-aos-delay="100"
                                data-estado="<?= $conductor['estado'] ?>"
                                data-experiencia="<?= $conductor['experiencia_anos'] ?>">
                                <div class="driver-card-background">
                                    <div class="driver-card-header">
                                        <div class="driver-avatar-large-modern">
                                            <?php if (!empty($conductor['foto'])): ?>
                                                <img src="<?= htmlspecialchars($conductor['foto']) ?>"
                                                    alt="Foto">
                                            <?php else: ?>
                                                <div class="avatar-placeholder-large-modern">
                                                    <?= strtoupper(substr($conductor['nombre'], 0, 1) . substr($conductor['apellido'], 0, 1)) ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="driver-status-large <?= $conductor['estado'] ?>"></div>
                                        </div>
                                        <span class="status-badge-modern <?= $conductor['estado'] ?>">
                                            <?= ucfirst($conductor['estado']) ?>
                                        </span>
                                    </div>

                                    <div class="driver-card-content">
                                        <h3 class="driver-card-name">
                                            <?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?>
                                        </h3>

                                        <div class="driver-card-info">
                                            <div class="info-row">
                                                <i class="fas fa-id-card"></i>
                                                <span><?= htmlspecialchars($conductor['cedula']) ?></span>
                                            </div>
                                            <div class="info-row">
                                                <i class="fas fa-phone"></i>
                                                <span><?= htmlspecialchars($conductor['telefono'] ?? 'N/A') ?></span>
                                            </div>
                                            <div class="info-row">
                                                <i class="fas fa-id-badge"></i>
                                                <span><?= htmlspecialchars($conductor['licencia_numero'] ?? 'N/A') ?></span>
                                            </div>
                                            <div class="info-row">
                                                <i class="fas fa-star"></i>
                                                <span><?= $conductor['experiencia_anos'] ?> años de experiencia</span>
                                            </div>
                                        </div>

                                        <?php if (!empty($conductor['vehiculo_placa'])): ?>
                                            <div class="vehicle-assigned-card">
                                                <i class="fas fa-motorcycle"></i>
                                                <span>Vehículo: <?= htmlspecialchars($conductor['vehiculo_placa']) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="driver-card-actions">
                                        <a href="/admin/conductores/ver/<?= $conductor['id'] ?>"
                                            class="btn-modern btn-sm btn-outline">
                                            <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                            <span class="btn-text">Ver</span>
                                        </a>
                                        <a href="/admin/conductores/editar/<?= $conductor['id'] ?>"
                                            class="btn-modern btn-sm btn-primary">
                                            <span class="btn-icon"><i class="fas fa-edit"></i></span>
                                            <span class="btn-text">Editar</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="driver-card-glow"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="system-card-glow"></div>
    </div>
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

        // Dropdown functionality
        document.querySelectorAll('[data-dropdown]').forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdownId = this.getAttribute('data-dropdown');
                const dropdown = document.getElementById(dropdownId);
                dropdown.classList.toggle('active');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-modern')) {
                document.querySelectorAll('.dropdown-menu-modern').forEach(menu => {
                    menu.classList.remove('active');
                });
            }
        });

        // View toggle functionality
        document.querySelectorAll('.view-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const view = this.getAttribute('data-view');

                // Update active toggle
                document.querySelectorAll('.view-toggle').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Update views
                document.getElementById('tableView').classList.toggle('active', view === 'table');
                document.getElementById('cardsView').classList.toggle('active', view === 'cards');
            });
        });

        // Clear filters
        document.getElementById('clearFilters').addEventListener('click', function() {
            const form = document.getElementById('filtersForm');
            form.reset();
            window.location.href = '/admin/conductores';
        });

        // Auto-submit filters
        document.querySelectorAll('.form-select-modern').forEach(select => {
            select.addEventListener('change', function() {
                document.getElementById('filtersForm').submit();
            });
        });

        // Table sorting with DataTables
        if (typeof $ !== 'undefined' && $.fn.DataTable) {
            $('#conductoresTable').DataTable({
                language: {
                    url: '/assets/js/datatables-es.json'
                },
                pageLength: 25,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [5, 6]
                }]
            });
        }

        console.log('Conductores index initialized');
    });

    // Filter functions
    function filterConductores(filter) {
        const rows = document.querySelectorAll('.conductor-row');
        const cards = document.querySelectorAll('.driver-card-modern');

        // Update active filter button
        document.querySelectorAll('.filter-btn-modern').forEach(btn => btn.classList.remove('active'));
        document.querySelector(`[data-filter="${filter}"]`).classList.add('active');

        // Filter logic
        rows.forEach(row => {
            let show = true;

            switch (filter) {
                case 'todos':
                    show = true;
                    break;
                case 'activos':
                    show = row.getAttribute('data-estado') === 'activo';
                    break;
                case 'novatos':
                    show = parseInt(row.getAttribute('data-experiencia')) <= 2;
                    break;
                case 'experimentados':
                    const exp = parseInt(row.getAttribute('data-experiencia'));
                    show = exp >= 3 && exp <= 7;
                    break;
                case 'veteranos':
                    show = parseInt(row.getAttribute('data-experiencia')) > 7;
                    break;
            }

            row.style.display = show ? '' : 'none';
        });

        // Filter cards
        cards.forEach(card => {
            let show = true;

            switch (filter) {
                case 'todos':
                    show = true;
                    break;
                case 'activos':
                    show = card.getAttribute('data-estado') === 'activo';
                    break;
                case 'novatos':
                    show = parseInt(card.getAttribute('data-experiencia')) <= 2;
                    break;
                case 'experimentados':
                    const exp = parseInt(card.getAttribute('data-experiencia'));
                    show = exp >= 3 && exp <= 7;
                    break;
                case 'veteranos':
                    show = parseInt(card.getAttribute('data-experiencia')) > 7;
                    break;
            }

            card.style.display = show ? '' : 'none';
        });
    }

    // Action functions
    function asignarVehiculo(conductorId) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Asignar Vehículo',
                text: 'Redirigiendo a la página de asignación de vehículos...',
                icon: 'info',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = `/admin/asignaciones/crear?conductor_id=${conductorId}`;
            });
        } else {
            window.location.href = `/admin/asignaciones/crear?conductor_id=${conductorId}`;
        }
    }

    function desasignarVehiculo(conductorId) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Desasignar vehículo?',
                text: 'El conductor quedará sin vehículo asignado',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Desasignar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#f59e0b'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/conductores/desasignar-vehiculo/${conductorId}`;
                }
            });
        } else {
            if (confirm('¿Está seguro de desasignar el vehículo de este conductor?')) {
                window.location.href = `/admin/conductores/desasignar-vehiculo/${conductorId}`;
            }
        }
    }

    function suspenderConductor(conductorId) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Suspender Conductor',
                text: 'Ingrese el motivo de la suspensión:',
                input: 'textarea',
                inputAttributes: {
                    autocapitalize: 'off',
                    placeholder: 'Motivo de suspensión...'
                },
                showCancelButton: true,
                confirmButtonText: 'Suspender',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#f59e0b',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Debe ingresar un motivo para la suspensión';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/conductores/suspender/${conductorId}`;

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'motivo';
                    input.value = result.value;
                    form.appendChild(input);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        } else {
            const motivo = prompt('Ingrese el motivo de suspensión:');
            if (motivo) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/conductores/suspender/${conductorId}`;

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'motivo';
                input.value = motivo;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        }
    }

    function activarConductor(conductorId) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Activar conductor?',
                text: 'El conductor podrá volver a trabajar',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Activar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#22c55e'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/conductores/activar/${conductorId}`;
                }
            });
        } else {
            if (confirm('¿Está seguro de activar este conductor?')) {
                window.location.href = `/admin/conductores/activar/${conductorId}`;
            }
        }
    }
</script>


<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>