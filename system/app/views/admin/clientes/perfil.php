<?php
/**
 * Vista Perfil Cliente - Sistema PRIMERO DE JUNIO
 */

$title = 'Perfil de Cliente';
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
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Perfil de Cliente</span>
                        <span class="title-subtitle"><?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?></span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <button class="btn-modern btn-info dropdown-toggle" data-dropdown="opciones-perfil">
                        <span class="btn-icon"><i class="fas fa-cog"></i></span>
                        <span class="btn-text">Opciones</span>
                    </button>
                    <div class="dropdown-menu-modern" id="opciones-perfil">
                        <a href="/admin/clientes/editar/<?= $cliente['id'] ?>" class="dropdown-item-modern">
                            <i class="fas fa-edit"></i> Editar Cliente
                        </a>
                        <a href="/admin/clientes/historial/<?= $cliente['id'] ?>" class="dropdown-item-modern">
                            <i class="fas fa-history"></i> Historial
                        </a>
                        <div class="dropdown-divider-modern"></div>
                        <a href="/admin/viajes/crear?cliente_id=<?= $cliente['id'] ?>" class="dropdown-item-modern">
                            <i class="fas fa-plus"></i> Nuevo Viaje
                        </a>
                        <a href="/admin/clientes/exportar-perfil/<?= $cliente['id'] ?>" class="dropdown-item-modern">
                            <i class="fas fa-download"></i> Exportar Perfil
                        </a>
                    </div>
                    <a href="/admin/clientes" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-modern">
    <!-- Profile Header -->
    <div class="profile-header-modern" data-aos="fade-up">
        <div class="system-card-modern profile-card">
            <div class="system-card-background">
                <div class="profile-content-modern">
                    <div class="profile-avatar-modern">
                        <?php if (!empty($cliente['foto'])): ?>
                            <img src="/uploads/clientes/<?= htmlspecialchars($cliente['foto']) ?>" alt="Foto de <?= htmlspecialchars($cliente['nombre']) ?>">
                        <?php else: ?>
                            <div class="avatar-placeholder-large-modern">
                                <?= strtoupper(substr($cliente['nombre'], 0, 1) . substr($cliente['apellido'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <div class="profile-status-modern <?= $cliente['estado'] ?>">
                            <?= ucfirst($cliente['estado']) ?>
                        </div>
                    </div>
                    
                    <div class="profile-info-modern">
                        <h2 class="profile-name-modern">
                            <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?>
                        </h2>
                        <div class="profile-meta-modern">
                            <span class="profile-id">ID: #<?= str_pad($cliente['id'], 4, '0', STR_PAD_LEFT) ?></span>
                            <span class="type-badge-modern <?= $cliente['tipo_cliente'] ?>">
                                <?php
                                switch($cliente['tipo_cliente']) {
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
                            <?php if ($cliente['descuento_porcentaje'] > 0): ?>
                                <span class="discount-badge-modern">
                                    <i class="fas fa-tag"></i> <?= $cliente['descuento_porcentaje'] ?>% desc.
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="profile-contact-modern">
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
                            <?php if (!empty($cliente['direccion'])): ?>
                                <div class="contact-item-modern">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= htmlspecialchars($cliente['direccion']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="profile-actions-modern">
                        <a href="/admin/clientes/editar/<?= $cliente['id'] ?>" class="btn-modern btn-primary">
                            <span class="btn-icon"><i class="fas fa-edit"></i></span>
                            <span class="btn-text">Editar</span>
                        </a>
                        <button class="btn-modern btn-success" onclick="nuevoViaje()">
                            <span class="btn-icon"><i class="fas fa-route"></i></span>
                            <span class="btn-text">Nuevo Viaje</span>
                        </button>
                        <?php if ($cliente['estado'] === 'activo'): ?>
                            <button class="btn-modern btn-warning" onclick="desactivarCliente()">
                                <span class="btn-icon"><i class="fas fa-pause"></i></span>
                                <span class="btn-text">Desactivar</span>
                            </button>
                        <?php else: ?>
                            <button class="btn-modern btn-success" onclick="activarCliente()">
                                <span class="btn-icon"><i class="fas fa-play"></i></span>
                                <span class="btn-text">Activar</span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid-modern" data-aos="fade-up" data-aos-delay="100">
        <div class="stats-card-modern primary">
            <div class="stats-card-background">
                <div class="stats-icon-modern">
                    <i class="fas fa-route"></i>
                </div>
                <div class="stats-content-modern">
                    <div class="stats-number-modern"><?= $estadisticas['total_viajes'] ?? 0 ?></div>
                    <div class="stats-label-modern">Total Viajes</div>
                    <div class="stats-change-modern">
                        <span>Realizados</span>
                    </div>
                </div>
            </div>
            <div class="stats-card-glow primary"></div>
        </div>
        
        <div class="stats-card-modern success">
            <div class="stats-card-background">
                <div class="stats-icon-modern">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stats-content-modern">
                    <div class="stats-number-modern">Bs. <?= number_format($estadisticas['total_gastado'] ?? 0, 2) ?></div>
                    <div class="stats-label-modern">Total Gastado</div>
                    <div class="stats-change-modern positive">
                        <span>Acumulado</span>
                    </div>
                </div>
            </div>
            <div class="stats-card-glow success"></div>
        </div>
        
        <div class="stats-card-modern info">
            <div class="stats-card-background">
                <div class="stats-icon-modern">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stats-content-modern">
                    <div class="stats-number-modern">
                        <?= $cliente['ultimo_viaje'] ? date('d/m/Y', strtotime($cliente['ultimo_viaje'])) : 'Nunca' ?>
                    </div>
                    <div class="stats-label-modern">Último Viaje</div>
                    <div class="stats-change-modern">
                        <span><?= $cliente['ultimo_viaje'] ? \Carbon\Carbon::parse($cliente['ultimo_viaje'])->diffForHumans() : 'Sin viajes' ?></span>
                    </div>
                </div>
            </div>
            <div class="stats-card-glow info"></div>
        </div>
        
        <div class="stats-card-modern warning">
            <div class="stats-card-background">
                <div class="stats-icon-modern">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stats-content-modern">
                    <div class="stats-number-modern"><?= number_format($estadisticas['promedio_calificacion'] ?? 0, 1) ?></div>
                    <div class="stats-label-modern">Calificación Promedio</div>
                    <div class="stats-change-modern">
                        <div class="rating-stars-modern">
                            <?php
                            $rating = $estadisticas['promedio_calificacion'] ?? 0;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<i class="fas fa-star"></i>';
                                } elseif ($i - 0.5 <= $rating) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="stats-card-glow warning"></div>
        </div>
    </div>

    <!-- Content Tabs -->
    <div class="tabs-modern" data-aos="fade-up" data-aos-delay="200">
        <div class="tabs-header-modern">
            <button class="tab-button-modern active" data-tab="informacion">
                <i class="fas fa-info-circle"></i>
                <span>Información</span>
            </button>
            <button class="tab-button-modern" data-tab="viajes">
                <i class="fas fa-route"></i>
                <span>Viajes (<?= count($viajes_recientes ?? []) ?>)</span>
            </button>
            <button class="tab-button-modern" data-tab="pagos">
                <i class="fas fa-credit-card"></i>
                <span>Pagos</span>
            </button>
            <button class="tab-button-modern" data-tab="actividad">
                <i class="fas fa-clock"></i>
                <span>Actividad</span>
            </button>
        </div>

        <!-- Tab: Información -->
        <div class="tab-content-modern active" id="informacion">
            <div class="info-sections-modern">
                <!-- Información Personal -->
                <div class="system-card-modern info-section">
                    <div class="system-card-background">
                        <div class="card-header-modern">
                            <div class="card-title-modern">
                                <div class="title-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span>Información Personal</span>
                            </div>
                        </div>
                        <div class="card-content-modern">
                            <div class="info-grid-modern">
                                <div class="info-item-modern">
                                    <label>Nombre Completo:</label>
                                    <span><?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?></span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Documento:</label>
                                    <span><?= htmlspecialchars($cliente['documento'] ?: 'No especificado') ?></span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Fecha de Nacimiento:</label>
                                    <span><?= $cliente['fecha_nacimiento'] ? date('d/m/Y', strtotime($cliente['fecha_nacimiento'])) : 'No especificado' ?></span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Género:</label>
                                    <span><?= ucfirst($cliente['genero'] ?: 'No especificado') ?></span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Tipo de Cliente:</label>
                                    <span class="type-badge-modern <?= $cliente['tipo_cliente'] ?>">
                                        <?= ucfirst($cliente['tipo_cliente']) ?>
                                    </span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Estado:</label>
                                    <span class="status-badge-modern <?= $cliente['estado'] ?>">
                                        <?= ucfirst($cliente['estado']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="system-card-glow"></div>
                </div>

                <!-- Información de Contacto -->
                <div class="system-card-modern info-section">
                    <div class="system-card-background">
                        <div class="card-header-modern">
                            <div class="card-title-modern">
                                <div class="title-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <span>Información de Contacto</span>
                            </div>
                        </div>
                        <div class="card-content-modern">
                            <div class="info-grid-modern">
                                <div class="info-item-modern">
                                    <label>Teléfono Principal:</label>
                                    <span>
                                        <a href="tel:<?= htmlspecialchars($cliente['telefono']) ?>" class="contact-link-modern">
                                            <i class="fas fa-phone"></i>
                                            <?= htmlspecialchars($cliente['telefono']) ?>
                                        </a>
                                    </span>
                                </div>
                                <?php if (!empty($cliente['telefono_secundario'])): ?>
                                    <div class="info-item-modern">
                                        <label>Teléfono Alternativo:</label>
                                        <span>
                                            <a href="tel:<?= htmlspecialchars($cliente['telefono_secundario']) ?>" class="contact-link-modern">
                                                <i class="fas fa-phone"></i>
                                                <?= htmlspecialchars($cliente['telefono_secundario']) ?>
                                            </a>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($cliente['email'])): ?>
                                    <div class="info-item-modern">
                                        <label>Email:</label>
                                        <span>
                                            <a href="mailto:<?= htmlspecialchars($cliente['email']) ?>" class="contact-link-modern">
                                                <i class="fas fa-envelope"></i>
                                                <?= htmlspecialchars($cliente['email']) ?>
                                            </a>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($cliente['direccion'])): ?>
                                    <div class="info-item-modern full-width">
                                        <label>Dirección:</label>
                                        <span><?= htmlspecialchars($cliente['direccion']) ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($cliente['referencias'])): ?>
                                    <div class="info-item-modern full-width">
                                        <label>Referencias:</label>
                                        <span><?= htmlspecialchars($cliente['referencias']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="system-card-glow"></div>
                </div>

                <?php if ($cliente['tipo_cliente'] === 'corporativo'): ?>
                    <!-- Información Corporativa -->
                    <div class="system-card-modern info-section">
                        <div class="system-card-background">
                            <div class="card-header-modern">
                                <div class="card-title-modern">
                                    <div class="title-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <span>Información Corporativa</span>
                                </div>
                            </div>
                            <div class="card-content-modern">
                                <div class="info-grid-modern">
                                    <div class="info-item-modern">
                                        <label>Empresa:</label>
                                        <span><?= htmlspecialchars($cliente['empresa'] ?: 'No especificado') ?></span>
                                    </div>
                                    <div class="info-item-modern">
                                        <label>RUC/NIT:</label>
                                        <span><?= htmlspecialchars($cliente['ruc'] ?: 'No especificado') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="system-card-glow"></div>
                    </div>
                <?php endif; ?>

                <!-- Configuraciones -->
                <div class="system-card-modern info-section">
                    <div class="system-card-background">
                        <div class="card-header-modern">
                            <div class="card-title-modern">
                                <div class="title-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <span>Configuraciones y Preferencias</span>
                            </div>
                        </div>
                        <div class="card-content-modern">
                            <div class="info-grid-modern">
                                <div class="info-item-modern">
                                    <label>Descuento Aplicado:</label>
                                    <span>
                                        <?php if ($cliente['descuento_porcentaje'] > 0): ?>
                                            <span class="discount-info-modern">
                                                <i class="fas fa-tag"></i>
                                                <?= $cliente['descuento_porcentaje'] ?>%
                                                <?php if (!empty($cliente['motivo_descuento'])): ?>
                                                    <span class="discount-reason">(<?= htmlspecialchars($cliente['motivo_descuento']) ?>)</span>
                                                <?php endif; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="no-discount">Sin descuento</span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Prioridad:</label>
                                    <span class="priority-badge-modern <?= $cliente['prioridad'] ?? 'normal' ?>">
                                        <?= ucfirst($cliente['prioridad'] ?? 'Normal') ?>
                                    </span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Notificaciones SMS:</label>
                                    <span class="notification-status <?= ($cliente['notificaciones_sms'] ?? true) ? 'enabled' : 'disabled' ?>">
                                        <i class="fas <?= ($cliente['notificaciones_sms'] ?? true) ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                                        <?= ($cliente['notificaciones_sms'] ?? true) ? 'Habilitado' : 'Deshabilitado' ?>
                                    </span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Notificaciones Email:</label>
                                    <span class="notification-status <?= ($cliente['notificaciones_email'] ?? false) ? 'enabled' : 'disabled' ?>">
                                        <i class="fas <?= ($cliente['notificaciones_email'] ?? false) ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                                        <?= ($cliente['notificaciones_email'] ?? false) ? 'Habilitado' : 'Deshabilitado' ?>
                                    </span>
                                </div>
                                <?php if (!empty($cliente['observaciones'])): ?>
                                    <div class="info-item-modern full-width">
                                        <label>Observaciones:</label>
                                        <span><?= htmlspecialchars($cliente['observaciones']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="system-card-glow"></div>
                </div>

                <!-- Información de Auditoría -->
                <div class="system-card-modern info-section">
                    <div class="system-card-background">
                        <div class="card-header-modern">
                            <div class="card-title-modern">
                                <div class="title-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <span>Información de Registro</span>
                            </div>
                        </div>
                        <div class="card-content-modern">
                            <div class="info-grid-modern">
                                <div class="info-item-modern">
                                    <label>Fecha de Registro:</label>
                                    <span><?= $cliente['created_at'] ? date('d/m/Y H:i', strtotime($cliente['created_at'])) : 'No disponible' ?></span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Última Modificación:</label>
                                    <span><?= $cliente['updated_at'] ? date('d/m/Y H:i', strtotime($cliente['updated_at'])) : 'No disponible' ?></span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Cliente desde:</label>
                                    <span>
                                        <?php
                                        if ($cliente['created_at']) {
                                            $fechaRegistro = \Carbon\Carbon::parse($cliente['created_at']);
                                            echo $fechaRegistro->diffForHumans();
                                        } else {
                                            echo 'No disponible';
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Total de Viajes:</label>
                                    <span><?= $estadisticas['total_viajes'] ?? 0 ?> viajes realizados</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="system-card-glow"></div>
                </div>
            </div>
        </div>

        <!-- Tab: Viajes -->
        <div class="tab-content-modern" id="viajes">
            <div class="system-card-modern table-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-route"></i>
                            </div>
                            <span>Historial de Viajes</span>
                        </div>
                        <div class="card-actions-modern">
                            <a href="/admin/viajes/crear?cliente_id=<?= $cliente['id'] ?>" class="btn-modern btn-sm btn-primary">
                                <span class="btn-icon"><i class="fas fa-plus"></i></span>
                                <span class="btn-text">Nuevo Viaje</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-content-modern">
                        <?php if (!empty($viajes_recientes)): ?>
                            <div class="table-container-modern">
                                <table class="table-modern">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Origen - Destino</th>
                                            <th>Conductor</th>
                                            <th>Costo</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($viajes_recientes as $viaje): ?>
                                            <tr>
                                                <td>
                                                    <div class="date-info-modern">
                                                        <span class="date"><?= date('d/m/Y', strtotime($viaje['fecha'])) ?></span>
                                                        <span class="time"><?= date('H:i', strtotime($viaje['fecha'])) ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="route-info-modern">
                                                        <div class="route-from"><?= htmlspecialchars($viaje['origen']) ?></div>
                                                        <div class="route-arrow"><i class="fas fa-arrow-right"></i></div>
                                                        <div class="route-to"><?= htmlspecialchars($viaje['destino']) ?></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="conductor-info-modern">
                                                        <span class="conductor-name"><?= htmlspecialchars($viaje['conductor_nombre'] ?? 'No asignado') ?></span>
                                                        <?php if (!empty($viaje['vehiculo_placa'])): ?>
                                                            <span class="vehicle-plate"><?= htmlspecialchars($viaje['vehiculo_placa']) ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="price-modern">Bs. <?= number_format($viaje['costo'], 2) ?></span>
                                                </td>
                                                <td>
                                                    <span class="status-badge-modern <?= $viaje['estado'] ?>">
                                                        <?= ucfirst($viaje['estado']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="actions-modern">
                                                        <a href="/admin/viajes/ver/<?= $viaje['id'] ?>" 
                                                           class="btn-modern btn-sm btn-outline" 
                                                           title="Ver Detalles">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-footer-modern">
                                <a href="/admin/viajes?cliente_id=<?= $cliente['id'] ?>" class="btn-modern btn-outline">
                                    Ver todos los viajes
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="empty-state-modern">
                                <div class="empty-icon-modern">
                                    <i class="fas fa-route"></i>
                                </div>
                                <h3>Sin viajes registrados</h3>
                                <p>Este cliente aún no ha realizado ningún viaje.</p>
                                <a href="/admin/viajes/crear?cliente_id=<?= $cliente['id'] ?>" class="btn-modern btn-primary">
                                    <span class="btn-icon"><i class="fas fa-plus"></i></span>
                                    <span class="btn-text">Crear primer viaje</span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Tab: Pagos -->
        <div class="tab-content-modern" id="pagos">
            <div class="system-card-modern">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <span>Historial de Pagos</span>
                        </div>
                    </div>
                    <div class="card-content-modern">
                        <div class="empty-state-modern">
                            <div class="empty-icon-modern">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <h3>Módulo de pagos en desarrollo</h3>
                            <p>La gestión de pagos estará disponible próximamente.</p>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Tab: Actividad -->
        <div class="tab-content-modern" id="actividad">
            <div class="system-card-modern">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <span>Registro de Actividad</span>
                        </div>
                    </div>
                    <div class="card-content-modern">
                        <div class="timeline-modern">
                            <div class="timeline-item-modern">
                                <div class="timeline-marker-modern created">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="timeline-content-modern">
                                    <h4>Cliente registrado</h4>
                                    <p>El cliente fue registrado en el sistema</p>
                                    <span class="timeline-date-modern">
                                        <?= $cliente['created_at'] ? date('d/m/Y H:i', strtotime($cliente['created_at'])) : 'Fecha no disponible' ?>
                                    </span>
                                </div>
                            </div>
                            
                            <?php if ($cliente['updated_at'] && $cliente['updated_at'] !== $cliente['created_at']): ?>
                                <div class="timeline-item-modern">
                                    <div class="timeline-marker-modern updated">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="timeline-content-modern">
                                        <h4>Información actualizada</h4>
                                        <p>Los datos del cliente fueron modificados</p>
                                        <span class="timeline-date-modern">
                                            <?= date('d/m/Y H:i', strtotime($cliente['updated_at'])) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($cliente['ultimo_viaje']): ?>
                                <div class="timeline-item-modern">
                                    <div class="timeline-marker-modern trip">
                                        <i class="fas fa-route"></i>
                                    </div>
                                    <div class="timeline-content-modern">
                                        <h4>Último viaje</h4>
                                        <p>Viaje más reciente realizado</p>
                                        <span class="timeline-date-modern">
                                            <?= date('d/m/Y H:i', strtotime($cliente['ultimo_viaje'])) ?>
                                        </span>
                                    </div>
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

    // Tab functionality
    document.querySelectorAll('.tab-button-modern').forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            document.querySelectorAll('.tab-button-modern').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content-modern').forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        });
    });

    console.log('Cliente perfil initialized');
});

// Action functions
function nuevoViaje() {
    window.location.href = `/admin/viajes/crear?cliente_id=<?= $cliente['id'] ?>`;
}

function desactivarCliente() {
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
                window.location.href = `/admin/clientes/desactivar/<?= $cliente['id'] ?>`;
            }
        });
    } else {
        if (confirm('¿Está seguro de desactivar este cliente?')) {
            window.location.href = `/admin/clientes/desactivar/<?= $cliente['id'] ?>`;
        }
    }
}

function activarCliente() {
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
                window.location.href = `/admin/clientes/activar/<?= $cliente['id'] ?>`;
            }
        });
    } else {
        if (confirm('¿Está seguro de activar este cliente?')) {
            window.location.href = `/admin/clientes/activar/<?= $cliente['id'] ?>`;
        }
    }
}
</script>

<style>
/* Estilos específicos para el perfil de cliente */
.profile-header-modern {
    margin-bottom: 2rem;
}

.profile-content-modern {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 2rem;
}

.profile-avatar-modern {
    position: relative;
    width: 120px;
    height: 120px;
    flex-shrink: 0;
}

.profile-avatar-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-placeholder-large-modern {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 2rem;
}

.profile-status-modern {
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    border: 2px solid var(--card-bg);
}

.profile-status-modern.activo {
    background: var(--success-color);
    color: white;
}

.profile-status-modern.inactivo {
    background: var(--error-color);
    color: white;
}

.profile-info-modern {
    flex: 1;
}

.profile-name-modern {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.profile-meta-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.profile-id {
    font-size: 0.9rem;
    color: var(--text-secondary);
    font-weight: 600;
}

.discount-badge-modern {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.profile-contact-modern {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.contact-item-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
}

.contact-item-modern i {
    color: var(--primary-green);
    width: 16px;
}

.contact-link-modern {
    color: var(--text-secondary);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s ease;
}

.contact-link-modern:hover {
    color: var(--primary-green);
}

.profile-actions-modern {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    align-self: flex-start;
}

.info-sections-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

.info-section {
    height: fit-content;
}

.info-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.info-item-modern {
    padding: 0.75rem;
    background: var(--card-hover-bg);
    border-radius: 6px;
    border-left: 3px solid var(--primary-green);
}

.info-item-modern.full-width {
    grid-column: 1 / -1;
}

.info-item-modern label {
    display: block;
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-bottom: 0.25rem;
    font-weight: 600;
}

.info-item-modern span {
    font-size: 0.9rem;
    color: var(--text-primary);
}

.priority-badge-modern {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.priority-badge-modern.normal {
    background: rgba(107, 114, 128, 0.15);
    color: var(--text-secondary);
}

.priority-badge-modern.alta {
    background: rgba(245, 158, 11, 0.15);
    color: var(--warning-color);
}

.priority-badge-modern.vip {
    background: rgba(168, 85, 247, 0.15);
    color: #a855f7;
}

.notification-status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    font-weight: 600;
}

.notification-status.enabled {
    color: var(--success-color);
}

.notification-status.disabled {
    color: var(--error-color);
}

.discount-info-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--success-color);
    font-weight: 600;
}

.discount-reason {
    font-weight: 400;
    font-style: italic;
    color: var(--text-secondary);
}

.no-discount {
    color: var(--text-secondary);
    font-style: italic;
}

.tabs-modern {
    margin-top: 2rem;
}

.tabs-header-modern {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-color);
    overflow-x: auto;
}

.tab-button-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border: none;
    background: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
    font-weight: 600;
}

.tab-button-modern:hover {
    color: var(--primary-green);
    background: rgba(var(--primary-green-rgb), 0.05);
}

.tab-button-modern.active {
    color: var(--primary-green);
    border-bottom-color: var(--primary-green);
}

.tab-content-modern {
    display: none;
}

.tab-content-modern.active {
    display: block;
}

.route-info-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
}

.route-from, .route-to {
    color: var(--text-secondary);
}

.route-arrow {
    color: var(--primary-green);
}

.conductor-info-modern {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.conductor-name {
    color: var(--text-primary);
    font-weight: 600;
}

.vehicle-plate {
    font-size: 0.8rem;
    color: var(--text-secondary);
    background: var(--card-hover-bg);
    padding: 0.125rem 0.5rem;
    border-radius: 4px;
    width: fit-content;
}

.date-info-modern {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.date {
    color: var(--text-primary);
    font-weight: 600;
}

.time {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.price-modern {
    font-weight: 700;
    color: var(--success-color);
}

.table-footer-modern {
    padding: 1rem;
    text-align: center;
    border-top: 1px solid var(--border-color);
}

.empty-state-modern {
    text-align: center;
    padding: 3rem 1rem;
}

.empty-icon-modern {
    font-size: 3rem;
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.empty-state-modern h3 {
    font-size: 1.2rem;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.empty-state-modern p {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
}

.timeline-modern {
    position: relative;
    padding-left: 2rem;
}

.timeline-modern::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--border-color);
}

.timeline-item-modern {
    position: relative;
    margin-bottom: 2rem;
}

.timeline-marker-modern {
    position: absolute;
    left: -2rem;
    top: 0;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    border: 2px solid var(--card-bg);
}

.timeline-marker-modern.created {
    background: var(--success-color);
}

.timeline-marker-modern.updated {
    background: var(--primary-green);
}

.timeline-marker-modern.trip {
    background: var(--info-color);
}

.timeline-content-modern {
    background: var(--card-hover-bg);
    padding: 1rem;
    border-radius: 8px;
    border-left: 3px solid var(--primary-green);
}

.timeline-content-modern h4 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.timeline-content-modern p {
    color: var(--text-secondary);
    margin: 0 0 0.5rem 0;
}

.timeline-date-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
    font-weight: 600;
}

.rating-stars-modern {
    display: flex;
    gap: 0.125rem;
}

.rating-stars-modern i {
    color: #fbbf24;
    font-size: 0.8rem;
}

/* Responsive design */
@media (max-width: 1024px) {
    .info-sections-modern {
        grid-template-columns: 1fr;
    }
    
    .profile-content-modern {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-actions-modern {
        flex-direction: row;
        justify-content: center;
        align-self: center;
    }
}

@media (max-width: 768px) {
    .profile-content-modern {
        padding: 1.5rem;
        gap: 1.5rem;
    }
    
    .profile-avatar-modern {
        width: 100px;
        height: 100px;
    }
    
    .avatar-placeholder-large-modern {
        font-size: 1.5rem;
    }
    
    .profile-name-modern {
        font-size: 1.5rem;
    }
    
    .profile-meta-modern {
        justify-content: center;
    }
    
    .profile-actions-modern {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .tabs-header-modern {
        gap: 0.25rem;
    }
    
    .tab-button-modern {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }
    
    .info-grid-modern {
        grid-template-columns: 1fr;
    }
    
    .timeline-modern {
        padding-left: 1.5rem;
    }
    
    .timeline-marker-modern {
        left: -1.5rem;
        width: 24px;
        height: 24px;
        font-size: 0.7rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>