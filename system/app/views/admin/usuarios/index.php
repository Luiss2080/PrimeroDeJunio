<?php
/**
 * Vista Index Usuarios - Sistema PRIMERO DE JUNIO
 */

$title = 'Gestión de Usuarios';
$current_page = 'usuarios';

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
                        <span class="title-main">Gestión de Usuarios</span>
                        <span class="title-subtitle">Administrar usuarios del sistema</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/usuarios/crear" class="btn-modern btn-primary">
                        <span class="btn-icon"><i class="fas fa-plus"></i></span>
                        <span class="btn-text">Nuevo Usuario</span>
                    </a>
                    <div class="dropdown-modern">
                        <button class="btn-modern btn-outline dropdown-toggle" data-dropdown="exportar-usuarios">
                            <span class="btn-icon"><i class="fas fa-download"></i></span>
                            <span class="btn-text">Exportar</span>
                        </button>
                        <div class="dropdown-menu-modern" id="exportar-usuarios">
                            <a href="/admin/usuarios/exportar?formato=excel" class="dropdown-item-modern">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>
                            <a href="/admin/usuarios/exportar?formato=pdf" class="dropdown-item-modern">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <a href="/admin/usuarios/exportar?formato=csv" class="dropdown-item-modern">
                                <i class="fas fa-file-csv"></i> CSV
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
                        <div class="stats-label-modern">Total Usuarios</div>
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
                        <div class="stats-label-modern">Usuarios Activos</div>
                    </div>
                </div>
                <div class="stats-card-glow success"></div>
            </div>
            
            <div class="stats-card-modern warning" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= $estadisticas['pendientes'] ?? 0 ?></div>
                        <div class="stats-label-modern">Pendientes</div>
                    </div>
                </div>
                <div class="stats-card-glow warning"></div>
            </div>
            
            <div class="stats-card-modern info" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card-background">
                    <div class="stats-icon-modern">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="stats-content-modern">
                        <div class="stats-number-modern"><?= count($estadisticas['por_rol'] ?? []) ?></div>
                        <div class="stats-label-modern">Roles Activos</div>
                    </div>
                </div>
                <div class="stats-card-glow info"></div>
            </div>
        </div>
    </div>
</div>

<!-- Filters Section -->
<div class="container-modern">
    <div class="system-card-modern filters-card" data-aos="fade-up" data-aos-delay="500">
        <div class="system-card-background">
            <div class="card-header-modern">
                <div class="card-title-modern">
                    <div class="title-icon">
                        <i class="fas fa-filter"></i>
                    </div>
                    <span>Filtros de Búsqueda</span>
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
                            <label class="form-label-modern">Buscar Usuario</label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input type="text" 
                                       class="form-input-modern" 
                                       name="buscar" 
                                       value="<?= htmlspecialchars($filtros['buscar']) ?>"
                                       placeholder="Nombre, apellido, email o teléfono...">
                            </div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">Rol</label>
                            <select class="form-select-modern" name="rol_id">
                                <option value="">Todos los roles</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?= $rol['id'] ?>" 
                                            <?= $filtros['rol_id'] == $rol['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($rol['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">Estado</label>
                            <select class="form-select-modern" name="estado">
                                <option value="">Todos los estados</option>
                                <option value="activo" <?= $filtros['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                                <option value="inactivo" <?= $filtros['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                <option value="pendiente" <?= $filtros['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            </select>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">&nbsp;</label>
                            <div class="filters-actions-modern">
                                <button type="submit" class="btn-modern btn-primary btn-sm">
                                    <span class="btn-icon"><i class="fas fa-search"></i></span>
                                    <span class="btn-text">Buscar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="system-card-glow"></div>
    </div>

    <!-- Users Table -->
    <div class="system-card-modern table-card" data-aos="fade-up" data-aos-delay="600">
        <div class="system-card-background">
            <div class="card-header-modern">
                <div class="card-title-modern">
                    <div class="title-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <span>Lista de Usuarios (<?= count($usuarios) ?>)</span>
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
                        <table class="table-modern" id="usuariosTable">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Usuario</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Email</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="th-content-modern">
                                            <span>Rol</span>
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
                                            <span>Último Acceso</span>
                                            <i class="fas fa-sort sort-icon"></i>
                                        </div>
                                    </th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr class="table-row-modern" data-user-id="<?= $usuario['id'] ?>">
                                        <td>
                                            <div class="user-cell-modern">
                                                <div class="user-avatar-modern">
                                                    <?php if (!empty($usuario['avatar'])): ?>
                                                        <img src="<?= htmlspecialchars($usuario['avatar']) ?>" 
                                                             alt="Avatar">
                                                    <?php else: ?>
                                                        <div class="avatar-placeholder-modern">
                                                            <?= strtoupper(substr($usuario['nombre'], 0, 1) . substr($usuario['apellido'], 0, 1)) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="user-info-modern">
                                                    <span class="user-name-modern">
                                                        <?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?>
                                                    </span>
                                                    <span class="user-phone-modern">
                                                        <?= htmlspecialchars($usuario['telefono'] ?? 'N/A') ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="email-modern">
                                                <?= htmlspecialchars($usuario['email']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="role-badge-modern <?= strtolower($usuario['rol_nombre'] ?? 'usuario') ?>">
                                                <?= htmlspecialchars($usuario['rol_nombre'] ?? 'N/A') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge-modern <?= $usuario['estado'] ?>">
                                                <?= ucfirst($usuario['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="date-modern">
                                                <?php if ($usuario['ultimo_acceso']): ?>
                                                    <?= date('d/m/Y H:i', strtotime($usuario['ultimo_acceso'])) ?>
                                                <?php else: ?>
                                                    <span class="text-muted">Nunca</span>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="actions-modern">
                                                <a href="/admin/usuarios/perfil/<?= $usuario['id'] ?>" 
                                                   class="btn-modern btn-sm btn-outline" 
                                                   title="Ver Perfil">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/admin/usuarios/editar/<?= $usuario['id'] ?>" 
                                                   class="btn-modern btn-sm btn-primary" 
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php if ($usuario['estado'] === 'activo'): ?>
                                                    <button class="btn-modern btn-sm btn-warning" 
                                                            onclick="toggleUserStatus(<?= $usuario['id'] ?>, 'desactivar')"
                                                            title="Desactivar">
                                                        <i class="fas fa-user-slash"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn-modern btn-sm btn-success" 
                                                            onclick="toggleUserStatus(<?= $usuario['id'] ?>, 'activar')"
                                                            title="Activar">
                                                        <i class="fas fa-user-check"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button class="btn-modern btn-sm btn-danger" 
                                                        onclick="deleteUser(<?= $usuario['id'] ?>)"
                                                        title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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
                    <div class="users-cards-grid-modern">
                        <?php foreach ($usuarios as $usuario): ?>
                            <div class="user-card-modern" data-aos="fade-up" data-aos-delay="100">
                                <div class="user-card-background">
                                    <div class="user-card-header">
                                        <div class="user-avatar-large-modern">
                                            <?php if (!empty($usuario['avatar'])): ?>
                                                <img src="<?= htmlspecialchars($usuario['avatar']) ?>" 
                                                     alt="Avatar">
                                            <?php else: ?>
                                                <div class="avatar-placeholder-large-modern">
                                                    <?= strtoupper(substr($usuario['nombre'], 0, 1) . substr($usuario['apellido'], 0, 1)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <span class="status-badge-modern <?= $usuario['estado'] ?>">
                                            <?= ucfirst($usuario['estado']) ?>
                                        </span>
                                    </div>
                                    
                                    <div class="user-card-content">
                                        <h3 class="user-card-name">
                                            <?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?>
                                        </h3>
                                        <p class="user-card-email">
                                            <?= htmlspecialchars($usuario['email']) ?>
                                        </p>
                                        <div class="user-card-meta">
                                            <div class="meta-item">
                                                <span class="role-badge-modern <?= strtolower($usuario['rol_nombre'] ?? 'usuario') ?>">
                                                    <?= htmlspecialchars($usuario['rol_nombre'] ?? 'N/A') ?>
                                                </span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-phone"></i>
                                                <span><?= htmlspecialchars($usuario['telefono'] ?? 'N/A') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="user-card-actions">
                                        <a href="/admin/usuarios/perfil/<?= $usuario['id'] ?>" 
                                           class="btn-modern btn-sm btn-outline">
                                            <span class="btn-icon"><i class="fas fa-eye"></i></span>
                                            <span class="btn-text">Ver</span>
                                        </a>
                                        <a href="/admin/usuarios/editar/<?= $usuario['id'] ?>" 
                                           class="btn-modern btn-sm btn-primary">
                                            <span class="btn-icon"><i class="fas fa-edit"></i></span>
                                            <span class="btn-text">Editar</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="user-card-glow"></div>
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
        window.location.href = '/admin/usuarios';
    });

    // Table sorting
    if (typeof $ !== 'undefined' && $.fn.DataTable) {
        $('#usuariosTable').DataTable({
            language: {
                url: '/assets/js/datatables-es.json'
            },
            pageLength: 25,
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [5] }
            ]
        });
    }

    // Auto-submit filters
    document.querySelectorAll('.form-select-modern').forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('filtersForm').submit();
        });
    });

    console.log('Usuarios index initialized');
});

// User actions functions
function toggleUserStatus(userId, action) {
    if (typeof Swal !== 'undefined') {
        const actionText = action === 'activar' ? 'activar' : 'desactivar';
        const confirmText = action === 'activar' ? 'Activar' : 'Desactivar';
        
        Swal.fire({
            title: `¿${confirmText} usuario?`,
            text: `¿Estás seguro de que deseas ${actionText} este usuario?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: action === 'activar' ? '#22c55e' : '#f59e0b'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/usuarios/${action}/${userId}`;
            }
        });
    } else {
        if (confirm(`¿Estás seguro de que deseas ${actionText} este usuario?`)) {
            window.location.href = `/admin/usuarios/${action}/${userId}`;
        }
    }
}

function deleteUser(userId) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Eliminar usuario?',
            text: 'Esta acción no se puede deshacer. El usuario será eliminado permanentemente.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/usuarios/eliminar/${userId}`;
            }
        });
    } else {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
            window.location.href = `/admin/usuarios/eliminar/${userId}`;
        }
    }
}
</script>

<style>
/* Estilos específicos para la vista de usuarios */
.filters-card {
    margin-bottom: 2rem;
}

.filters-grid-modern {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 1.5rem;
    align-items: end;
}

.user-cell-modern {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar-modern {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.user-avatar-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder-modern {
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 0.9rem;
}

.user-info-modern {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.user-name-modern {
    font-weight: 600;
    color: var(--text-primary);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-phone-modern {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.role-badge-modern {
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-badge-modern.administrador {
    background: rgba(239, 68, 68, 0.15);
    color: var(--error-color);
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.role-badge-modern.operador {
    background: rgba(59, 130, 246, 0.15);
    color: var(--info-color);
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.role-badge-modern.conductor {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.role-badge-modern.usuario {
    background: rgba(107, 114, 128, 0.15);
    color: var(--text-secondary);
    border: 1px solid rgba(107, 114, 128, 0.3);
}

.users-cards-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.user-card-modern {
    position: relative;
    height: 100%;
}

.user-card-background {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.user-card-modern:hover .user-card-background {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.user-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.user-avatar-large-modern {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
}

.user-avatar-large-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder-large-modern {
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 1.2rem;
}

.user-card-content {
    flex: 1;
    margin-bottom: 1rem;
}

.user-card-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.user-card-email {
    color: var(--text-secondary);
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.user-card-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.user-card-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
}

.user-card-glow {
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: var(--gradient-primary);
    border-radius: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
    filter: blur(8px);
}

.user-card-modern:hover .user-card-glow {
    opacity: 0.3;
}

/* Cards view toggle */
.cards-view-modern {
    display: none;
}

.cards-view-modern.active {
    display: block;
}

.table-view-modern.active {
    display: block;
}

.table-view-modern:not(.active) {
    display: none;
}

/* View toggle buttons */
.view-toggle-modern {
    display: flex;
    gap: 0.25rem;
}

.view-toggle.active {
    background: var(--primary-green);
    color: white;
}

/* Responsive design */
@media (max-width: 1024px) {
    .filters-grid-modern {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .users-cards-grid-modern {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 768px) {
    .filters-grid-modern {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .user-card-actions {
        flex-direction: column;
    }
    
    .actions-modern {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>