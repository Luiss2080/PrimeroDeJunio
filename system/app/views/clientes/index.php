<?php

/**
 * Vista Index Clientes - Sistema PRIMERO DE JUNIO
 */

$title = 'Gestión de Clientes';
$current_page = 'clientes';

ob_start();
?>

<!-- Page Header -->
<div class="page-header-modern">
    <div class="container-modern">
        <div class="header-content-grid">
            <div class="header-left">
                <h1 class="page-title-modern">
                    <div class="title-icon admin">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Gestión de Clientes</span>
                        <span class="title-subtitle">Administrar base de clientes del servicio</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/clientes/crear" class="btn-modern btn-primary">
                        <span class="btn-icon"><i class="fas fa-plus"></i></span>
                        <span class="btn-text">Nuevo Cliente</span>
                    </a>
                    <div class="dropdown-modern">
                        <button class="btn-modern btn-outline dropdown-toggle" data-dropdown="opciones-clientes">
                            <span class="btn-icon"><i class="fas fa-cog"></i></span>
                            <span class="btn-text">Opciones</span>
                        </button>
                        <div class="dropdown-menu-modern" id="opciones-clientes">
                            <a href="/admin/clientes/estadisticas" class="dropdown-item-modern">
                                <i class="fas fa-chart-bar"></i> Estadísticas
                            </a>
                            <a href="/admin/clientes/frecuentes" class="dropdown-item-modern">
                                <i class="fas fa-star"></i> Clientes Frecuentes
                            </a>
                            <div class="dropdown-divider-modern"></div>
                            <a href="/admin/clientes/exportar?formato=excel" class="dropdown-item-modern">
                                <i class="fas fa-file-excel"></i> Exportar Excel
                            </a>
                            <a href="/admin/clientes/exportar?formato=pdf" class="dropdown-item-modern">
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
                        <div class="stats-label-modern">Total Clientes</div>
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
                            <span>Disponibles</span>
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
                        <div class="stats-number-modern"><?= $estadisticas['por_tipo']['frecuente'] ?? 0 ?></div>
                        <div class="stats-label-modern">Frecuentes</div>
                        <div class="stats-change-modern">
                            <i class="fas fa-crown"></i>
                            <span>VIP</span>
                        </div>
                    </div>
                </div>
                <div class="stats-card-glow warning"></div>
            </div>

            <div class="stats-card-modern info" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['con_descuentos'] ?? 0 ?></div>
                        <div class="stats-label-modern">Con Descuentos</div>
                        <div class="stats-change-modern">
                            <i class="fas fa-tag"></i>
                            <span>Especiales</span>
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
                    <button class="filter-btn-modern active" data-filter="todos" onclick="filterClientes('todos')">
                        <i class="fas fa-users"></i>
                        <span>Todos</span>
                        <span class="filter-count"><?= $estadisticas['total'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="activos" onclick="filterClientes('activos')">
                        <i class="fas fa-user-check"></i>
                        <span>Activos</span>
                        <span class="filter-count"><?= $estadisticas['activos'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="particular" onclick="filterClientes('particular')">
                        <i class="fas fa-user"></i>
                        <span>Particulares</span>
                        <span class="filter-count"><?= $estadisticas['por_tipo']['particular'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="corporativo" onclick="filterClientes('corporativo')">
                        <i class="fas fa-building"></i>
                        <span>Corporativos</span>
                        <span class="filter-count"><?= $estadisticas['por_tipo']['corporativo'] ?? 0 ?></span>
                    </button>

                    <button class="filter-btn-modern" data-filter="frecuente" onclick="filterClientes('frecuente')">
                        <i class="fas fa-star"></i>
                        <span>Frecuentes</span>
                        <span class="filter-count"><?= $estadisticas['por_tipo']['frecuente'] ?? 0 ?></span>
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
                            <label class="form-label-modern">Buscar Cliente</label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input type="text"
                                    class="form-input-modern"
                                    name="buscar"
                                    value="<?= htmlspecialchars($filtros['buscar'] ?? '') ?>"
                                    placeholder="Nombre, teléfono, email...">
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">Tipo de Cliente</label>
                            <select class="form-select-modern" name="tipo_cliente">
                                <option value="">Todos los tipos</option>
                                <option value="particular" <?= ($filtros['tipo_cliente'] ?? '') === 'particular' ? 'selected' : '' ?>>Particular</option>
                                <option value="corporativo" <?= ($filtros['tipo_cliente'] ?? '') === 'corporativo' ? 'selected' : '' ?>>Corporativo</option>
                                <option value="frecuente" <?= ($filtros['tipo_cliente'] ?? '') === 'frecuente' ? 'selected' : '' ?>>Frecuente</option>
                            </select>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">Estado</label>
                            <select class="form-select-modern" name="estado">
                                <option value="">Todos los estados</option>
                                <option value="activo" <?= ($filtros['estado'] ?? '') === 'activo' ? 'selected' : '' ?>>Activo</option>
                                <option value="inactivo" <?= ($filtros['estado'] ?? '') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">Con Descuento</label>
                            <select class="form-select-modern" name="con_descuento">
                                <option value="">Todos</option>
                                <option value="si" <?= ($filtros['con_descuento'] ?? '') === 'si' ? 'selected' : '' ?>>Con descuento</option>
                                <option value="no" <?= ($filtros['con_descuento'] ?? '') === 'no' ? 'selected' : '' ?>>Sin descuento</option>
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

    <!-- Clientes List -->
    <div class="system-card-modern table-card" data-aos="fade-up" data-aos-delay="700">
        <div class="system-card-background">
            <div class="card-header-modern">
                <div class="card-title-modern">
                    <div class="title-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <span>Lista de Clientes (<?= count($clientes) ?>)</span>
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
                        <table class="table-modern" id="clientesTable">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Cliente</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Contacto</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Tipo</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Viajes</span>
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
                                            <span>Descuento</span>
                                        </div>
                                    </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $cliente): ?>
                                    <tr class="table-row-modern cliente-row"
                                        data-cliente-id="<?= $cliente['id'] ?>"
                                        data-estado="<?= $cliente['estado'] ?>"
                                        data-tipo="<?= $cliente['tipo_cliente'] ?>">
                                        <td>
                                            <div class="client-cell-modern">
                                                <div class="client-avatar-modern">
                                                    <div class="avatar-placeholder-modern">
                                                        <?= strtoupper(substr($cliente['nombre'], 0, 1) . substr($cliente['apellido'], 0, 1)) ?>
                                                    </div>
                                                    <div class="client-status-dot <?= $cliente['estado'] ?>"></div>
                                                </div>
                                                <div class="client-info-modern">
                                                    <span class="client-name-modern">
                                                        <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?>
                                                    </span>
                                                    <span class="client-id-modern">
                                                        ID: #<?= str_pad($cliente['id'], 4, '0', STR_PAD_LEFT) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contact-info-modern">
                                                <div class="contact-item-modern">
                                                    <i class="fas fa-phone"></i>
                                                    <span><?= htmlspecialchars($cliente['telefono']) ?></span>
                                                </div>
                                                <?php if (!empty($cliente['email'])): ?>
                                                    <div class="contact-item-modern">
                                                        <i class="fas fa-envelope"></i>
                                                        <span><?= htmlspecialchars($cliente['email']) ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="type-badge-modern <?= $cliente['tipo_cliente'] ?>">
                                                <?php
                                                switch ($cliente['tipo_cliente']) {
                                                    case 'particular':
                                                        echo '<i class="fas fa-user"></i> Particular';
                                                        break;
                                                    case 'corporativo':
                                                        echo '<i class="fas fa-building"></i> Corporativo';
                                                        break;
                                                    case 'frecuente':
                                                        echo '<i class="fas fa-star"></i> Frecuente';
                                                        break;
                                                    default:
                                                        echo '<i class="fas fa-user"></i> Particular';
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="trips-info-modern">
                                                <span class="trips-count">
                                                    <?= $cliente['total_viajes'] ?? 0 ?>
                                                </span>
                                                <span class="trips-label">viajes</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge-modern <?= $cliente['estado'] ?>">
                                                <?= ucfirst($cliente['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($cliente['descuento_porcentaje'] > 0): ?>
                                                <div class="discount-info-modern">
                                                    <i class="fas fa-tag"></i>
                                                    <span><?= $cliente['descuento_porcentaje'] ?>%</span>
                                                </div>
                                            <?php else: ?>
                                                <span class="no-discount">Sin descuento</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="actions-modern">
                                                <a href="/admin/clientes/perfil/<?= $cliente['id'] ?>"
                                                    class="btn-modern btn-sm btn-outline"
                                                    title="Ver Perfil">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/admin/clientes/editar/<?= $cliente['id'] ?>"
                                                    class="btn-modern btn-sm btn-primary"
                                                    title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn-modern btn-sm btn-info"
                                                    onclick="verViajes(<?= $cliente['id'] ?>)"
                                                    title="Ver Viajes">
                                                    <i class="fas fa-route"></i>
                                                </button>
                                                <?php if ($cliente['estado'] === 'activo'): ?>
                                                    <button class="btn-modern btn-sm btn-warning"
                                                        onclick="desactivarCliente(<?= $cliente['id'] ?>)"
                                                        title="Desactivar">
                                                        <i class="fas fa-pause"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn-modern btn-sm btn-success"
                                                        onclick="activarCliente(<?= $cliente['id'] ?>)"
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
                    <div class="clients-cards-grid-modern">
                        <?php foreach ($clientes as $cliente): ?>
                            <div class="client-card-modern"
                                data-aos="fade-up"
                                data-aos-delay="100"
                                data-estado="<?= $cliente['estado'] ?>"
                                data-tipo="<?= $cliente['tipo_cliente'] ?>">
                                <div class="client-card-background">
                                    <div class="client-card-header">
                                        <div class="client-avatar-large-modern">
                                            <div class="avatar-placeholder-large-modern">
                                                <?= strtoupper(substr($cliente['nombre'], 0, 1) . substr($cliente['apellido'], 0, 1)) ?>
                                            </div>
                                            <div class="client-status-large <?= $cliente['estado'] ?>"></div>
                                        </div>
                                        <span class="status-badge-modern <?= $cliente['estado'] ?>">
                                            <?= ucfirst($cliente['estado']) ?>
                                        </span>
                                    </div>

                                    <div class="client-card-content">
                                        <h3 class="client-card-name">
                                            <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?>
                                        </h3>

                                        <div class="client-card-info">
                                            <div class="info-row">
                                                <i class="fas fa-phone"></i>
                                                <span><?= htmlspecialchars($cliente['telefono']) ?></span>
                                            </div>
                                            <?php if (!empty($cliente['email'])): ?>
                                                <div class="info-row">
                                                    <i class="fas fa-envelope"></i>
                                                    <span><?= htmlspecialchars($cliente['email']) ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="info-row">
                                                <i class="fas fa-route"></i>
                                                <span><?= $cliente['total_viajes'] ?? 0 ?> viajes realizados</span>
                                            </div>
                                        </div>

                                        <div class="client-type-modern">
                                            <span class="type-badge-modern <?= $cliente['tipo_cliente'] ?>">
                                                <?php
                                                switch ($cliente['tipo_cliente']) {
                                                    case 'particular':
                                                        echo '<i class="fas fa-user"></i> Particular';
                                                        break;
                                                    case 'corporativo':
                                                        echo '<i class="fas fa-building"></i> Corporativo';
                                                        break;
                                                    case 'frecuente':
                                                        echo '<i class="fas fa-star"></i> Frecuente';
                                                        break;
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        <?php if ($cliente['descuento_porcentaje'] > 0): ?>
                                            <div class="discount-card-modern">
                                                <i class="fas fa-tag"></i>
                                                <span>Descuento del <?= $cliente['descuento_porcentaje'] ?>%</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="client-card-actions">
                                        <a href="/admin/clientes/perfil/<?= $cliente['id'] ?>"
                                            class="btn-modern btn-sm btn-outline">
                                            <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                            <span class="btn-text">Ver</span>
                                        </a>
                                        <a href="/admin/clientes/editar/<?= $cliente['id'] ?>"
                                            class="btn-modern btn-sm btn-primary">
                                            <span class="btn-icon"><i class="fas fa-edit"></i></span>
                                            <span class="btn-text">Editar</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="client-card-glow"></div>
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
            window.location.href = '/admin/clientes';
        });

        // Auto-submit filters
        document.querySelectorAll('.form-select-modern').forEach(select => {
            select.addEventListener('change', function() {
                document.getElementById('filtersForm').submit();
            });
        });

        // Table sorting with DataTables
        if (typeof $ !== 'undefined' && $.fn.DataTable) {
            $('#clientesTable').DataTable({
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

        console.log('Clientes index initialized');
    });

    // Filter functions
    function filterClientes(filter) {
        const rows = document.querySelectorAll('.cliente-row');
        const cards = document.querySelectorAll('.client-card-modern');

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
                case 'particular':
                case 'corporativo':
                case 'frecuente':
                    show = row.getAttribute('data-tipo') === filter;
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
                case 'particular':
                case 'corporativo':
                case 'frecuente':
                    show = card.getAttribute('data-tipo') === filter;
                    break;
            }

            card.style.display = show ? '' : 'none';
        });
    }

    // Action functions
    function verViajes(clienteId) {
        window.location.href = `/admin/viajes?cliente_id=${clienteId}`;
    }

    function desactivarCliente(clienteId) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Desactivar cliente?',
                text: 'El cliente no podrá solicitar servicios',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Desactivar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#f59e0b'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/clientes/desactivar/${clienteId}`;
                }
            });
        } else {
            if (confirm('¿Está seguro de desactivar este cliente?')) {
                window.location.href = `/admin/clientes/desactivar/${clienteId}`;
            }
        }
    }

    function activarCliente(clienteId) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Activar cliente?',
                text: 'El cliente podrá volver a solicitar servicios',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Activar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#22c55e'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/admin/clientes/activar/${clienteId}`;
                }
            });
        } else {
            if (confirm('¿Está seguro de activar este cliente?')) {
                window.location.href = `/admin/clientes/activar/${clienteId}`;
            }
        }
    }
</script>


<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>