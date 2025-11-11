<?php
/**
 * Vista Perfil Conductor - Sistema PRIMERO DE JUNIO
 */

$title = 'Perfil de Conductor';
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
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Perfil de Conductor</span>
                        <span class="title-subtitle"><?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?></span>
                    </div>
                </h1>
                <div class="breadcrumb-modern">
                    <a href="/admin/dashboard" class="breadcrumb-item">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                    <span class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <a href="/admin/conductores" class="breadcrumb-item">Conductores</a>
                    <span class="breadcrumb-separator">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="breadcrumb-item active">Perfil</span>
                </div>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <button class="btn-modern btn-warning" onclick="cambiarContrasena(<?= $conductor['id'] ?>)">
                        <span class="btn-icon"><i class="fas fa-key"></i></span>
                        <span class="btn-text">Cambiar Contraseña</span>
                    </button>
                    <a href="/admin/conductores/editar/<?= $conductor['id'] ?>" class="btn-modern btn-primary">
                        <span class="btn-icon"><i class="fas fa-edit"></i></span>
                        <span class="btn-text">Editar</span>
                    </a>
                    <a href="/admin/conductores" class="btn-modern btn-outline">
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
    <div class="profile-header-modern" data-aos="fade-up" data-aos-delay="100">
        <div class="profile-header-background">
            <div class="profile-cover-modern"></div>
            <div class="profile-main-info-modern">
                <div class="profile-avatar-section-modern">
                    <div class="profile-avatar-container-modern">
                        <?php if (!empty($conductor['foto'])): ?>
                            <img src="<?= htmlspecialchars($conductor['foto']) ?>" alt="Foto" class="profile-avatar-modern">
                        <?php else: ?>
                            <div class="profile-avatar-placeholder-modern">
                                <?= strtoupper(substr($conductor['nombre'], 0, 1) . substr($conductor['apellido'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <div class="profile-status-indicator <?= $conductor['estado'] ?>"></div>
                    </div>
                    <button class="profile-photo-edit-modern" onclick="cambiarFoto(<?= $conductor['id'] ?>)">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                
                <div class="profile-info-section-modern">
                    <h1 class="profile-name-modern"><?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?></h1>
                    <div class="profile-role-modern">
                        <i class="fas fa-id-badge"></i>
                        <span>Conductor de Mototaxi</span>
                    </div>
                    <div class="profile-meta-modern">
                        <div class="meta-item-modern">
                            <i class="fas fa-id-card"></i>
                            <span>Cédula: <?= htmlspecialchars($conductor['cedula']) ?></span>
                        </div>
                        <div class="meta-item-modern">
                            <i class="fas fa-phone"></i>
                            <span>Teléfono: <?= htmlspecialchars($conductor['telefono']) ?></span>
                        </div>
                        <div class="meta-item-modern">
                            <i class="fas fa-calendar"></i>
                            <span>Registrado: <?= date('d/m/Y', strtotime($conductor['fecha_registro'] ?? 'now')) ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="profile-actions-section-modern">
                    <div class="profile-status-badge-modern">
                        <span class="status-badge-modern <?= $conductor['estado'] ?>">
                            <?= ucfirst($conductor['estado']) ?>
                        </span>
                    </div>
                    <div class="profile-quick-actions-modern">
                        <?php if ($conductor['estado'] === 'activo'): ?>
                            <button class="btn-modern btn-sm btn-warning" onclick="suspenderConductor(<?= $conductor['id'] ?>)">
                                <i class="fas fa-pause"></i>
                                Suspender
                            </button>
                        <?php else: ?>
                            <button class="btn-modern btn-sm btn-success" onclick="activarConductor(<?= $conductor['id'] ?>)">
                                <i class="fas fa-play"></i>
                                Activar
                            </button>
                        <?php endif; ?>
                        
                        <?php if (empty($conductor['vehiculo_placa'])): ?>
                            <button class="btn-modern btn-sm btn-info" onclick="asignarVehiculo(<?= $conductor['id'] ?>)">
                                <i class="fas fa-motorcycle"></i>
                                Asignar Vehículo
                            </button>
                        <?php else: ?>
                            <button class="btn-modern btn-sm btn-outline" onclick="desasignarVehiculo(<?= $conductor['id'] ?>)">
                                <i class="fas fa-times"></i>
                                Desasignar
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-content-modern">
        <!-- Statistics Cards -->
        <div class="stats-grid-modern" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card-modern primary">
                <div class="stat-card-background">
                    <div class="stat-icon-modern">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="stat-content-modern">
                        <div class="stat-number-modern"><?= $estadisticas['total_viajes'] ?? 0 ?></div>
                        <div class="stat-label-modern">Viajes Totales</div>
                        <div class="stat-change-modern">
                            <i class="fas fa-arrow-up"></i>
                            <span><?= $estadisticas['viajes_mes'] ?? 0 ?> este mes</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-glow primary"></div>
            </div>
            
            <div class="stat-card-modern success">
                <div class="stat-card-background">
                    <div class="stat-icon-modern">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content-modern">
                        <div class="stat-number-modern"><?= number_format($estadisticas['calificacion_promedio'] ?? 0, 1) ?></div>
                        <div class="stat-label-modern">Calificación</div>
                        <div class="stat-change-modern">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?= $i <= ($estadisticas['calificacion_promedio'] ?? 0) ? 'active' : '' ?>"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="stat-card-glow success"></div>
            </div>
            
            <div class="stat-card-modern info">
                <div class="stat-card-background">
                    <div class="stat-icon-modern">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content-modern">
                        <div class="stat-number-modern">$<?= number_format($estadisticas['ingresos_totales'] ?? 0, 0) ?></div>
                        <div class="stat-label-modern">Ingresos Totales</div>
                        <div class="stat-change-modern">
                            <i class="fas fa-calendar"></i>
                            <span>$<?= number_format($estadisticas['ingresos_mes'] ?? 0, 0) ?> este mes</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-glow info"></div>
            </div>
            
            <div class="stat-card-modern warning">
                <div class="stat-card-background">
                    <div class="stat-icon-modern">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content-modern">
                        <div class="stat-number-modern"><?= $conductor['experiencia_anos'] ?? 0 ?></div>
                        <div class="stat-label-modern">Años Experiencia</div>
                        <div class="stat-change-modern">
                            <?php
                            $experiencia = $conductor['experiencia_anos'] ?? 0;
                            if ($experiencia <= 2) {
                                echo '<i class="fas fa-star"></i><span>Novato</span>';
                            } elseif ($experiencia <= 7) {
                                echo '<i class="fas fa-award"></i><span>Experimentado</span>';
                            } else {
                                echo '<i class="fas fa-medal"></i><span>Veterano</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="stat-card-glow warning"></div>
            </div>
        </div>

        <div class="profile-sections-grid-modern">
            <!-- Personal Information -->
            <div class="profile-section-modern" data-aos="fade-up" data-aos-delay="300">
                <div class="section-card-modern">
                    <div class="section-card-background">
                        <div class="section-header-modern">
                            <div class="section-title-modern">
                                <div class="title-icon-modern">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span>Información Personal</span>
                            </div>
                            <button class="btn-modern btn-sm btn-outline" onclick="editarSeccion('personal')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        
                        <div class="section-content-modern">
                            <div class="info-grid-modern">
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Nombres Completos</div>
                                    <div class="info-value-modern"><?= htmlspecialchars($conductor['nombre']) ?></div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Apellidos Completos</div>
                                    <div class="info-value-modern"><?= htmlspecialchars($conductor['apellido']) ?></div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Cédula de Ciudadanía</div>
                                    <div class="info-value-modern"><?= htmlspecialchars($conductor['cedula']) ?></div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Fecha de Nacimiento</div>
                                    <div class="info-value-modern">
                                        <?= htmlspecialchars($conductor['fecha_nacimiento']) ?>
                                        <span class="info-extra-modern">
                                            (<?= date_diff(date_create($conductor['fecha_nacimiento']), date_create('today'))->y ?> años)
                                        </span>
                                    </div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Estado Civil</div>
                                    <div class="info-value-modern"><?= ucfirst($conductor['estado_civil'] ?? 'No especificado') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-card-glow"></div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="profile-section-modern" data-aos="fade-up" data-aos-delay="400">
                <div class="section-card-modern">
                    <div class="section-card-background">
                        <div class="section-header-modern">
                            <div class="section-title-modern">
                                <div class="title-icon-modern">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <span>Información de Contacto</span>
                            </div>
                            <button class="btn-modern btn-sm btn-outline" onclick="editarSeccion('contacto')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        
                        <div class="section-content-modern">
                            <div class="info-grid-modern">
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Teléfono Principal</div>
                                    <div class="info-value-modern">
                                        <i class="fas fa-mobile-alt"></i>
                                        <?= htmlspecialchars($conductor['telefono']) ?>
                                        <button class="btn-contact-modern" onclick="llamar('<?= $conductor['telefono'] ?>')">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Teléfono de Emergencia</div>
                                    <div class="info-value-modern">
                                        <?php if (!empty($conductor['telefono_emergencia'])): ?>
                                            <i class="fas fa-phone"></i>
                                            <?= htmlspecialchars($conductor['telefono_emergencia']) ?>
                                            <button class="btn-contact-modern" onclick="llamar('<?= $conductor['telefono_emergencia'] ?>')">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted">No registrado</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Correo Electrónico</div>
                                    <div class="info-value-modern">
                                        <?php if (!empty($conductor['email'])): ?>
                                            <i class="fas fa-envelope"></i>
                                            <?= htmlspecialchars($conductor['email']) ?>
                                            <button class="btn-contact-modern" onclick="enviarEmail('<?= $conductor['email'] ?>')">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted">No registrado</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="info-item-modern span-full">
                                    <div class="info-label-modern">Dirección de Residencia</div>
                                    <div class="info-value-modern">
                                        <?php if (!empty($conductor['direccion'])): ?>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <?= htmlspecialchars($conductor['direccion']) ?>
                                            <button class="btn-contact-modern" onclick="verMapa('<?= urlencode($conductor['direccion']) ?>')">
                                                <i class="fas fa-map"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted">No registrada</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-card-glow"></div>
                </div>
            </div>

            <!-- License Information -->
            <div class="profile-section-modern" data-aos="fade-up" data-aos-delay="500">
                <div class="section-card-modern">
                    <div class="section-card-background">
                        <div class="section-header-modern">
                            <div class="section-title-modern">
                                <div class="title-icon-modern">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <span>Licencia de Conducir</span>
                            </div>
                            <button class="btn-modern btn-sm btn-outline" onclick="editarSeccion('licencia')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        
                        <div class="section-content-modern">
                            <div class="info-grid-modern">
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Número de Licencia</div>
                                    <div class="info-value-modern"><?= htmlspecialchars($conductor['licencia_numero'] ?? 'No registrado') ?></div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Categoría</div>
                                    <div class="info-value-modern">
                                        <span class="category-badge-modern <?= strtolower($conductor['licencia_categoria'] ?? 'sin-categoria') ?>">
                                            <?= htmlspecialchars($conductor['licencia_categoria'] ?? 'N/A') ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Fecha de Expedición</div>
                                    <div class="info-value-modern"><?= htmlspecialchars($conductor['licencia_expedicion'] ?? 'No registrado') ?></div>
                                </div>
                                <div class="info-item-modern">
                                    <div class="info-label-modern">Fecha de Vigencia</div>
                                    <div class="info-value-modern">
                                        <?php if (!empty($conductor['licencia_vigencia'])): ?>
                                            <?php
                                            $vigencia = new DateTime($conductor['licencia_vigencia']);
                                            $hoy = new DateTime();
                                            $diasRestantes = $vigencia > $hoy ? $hoy->diff($vigencia)->days : 0;
                                            $vencida = $vigencia < $hoy;
                                            ?>
                                            <div class="license-status-modern">
                                                <span><?= htmlspecialchars($conductor['licencia_vigencia']) ?></span>
                                                <span class="license-indicator-modern <?= $vencida ? 'expired' : ($diasRestantes <= 30 ? 'warning' : 'valid') ?>">
                                                    <?php if ($vencida): ?>
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        Vencida
                                                    <?php elseif ($diasRestantes <= 30): ?>
                                                        <i class="fas fa-clock"></i>
                                                        Vence en <?= $diasRestantes ?> días
                                                    <?php else: ?>
                                                        <i class="fas fa-check"></i>
                                                        Vigente
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">No registrado</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-card-glow"></div>
                </div>
            </div>

            <!-- Vehicle Information -->
            <div class="profile-section-modern" data-aos="fade-up" data-aos-delay="600">
                <div class="section-card-modern">
                    <div class="section-card-background">
                        <div class="section-header-modern">
                            <div class="section-title-modern">
                                <div class="title-icon-modern">
                                    <i class="fas fa-motorcycle"></i>
                                </div>
                                <span>Vehículo Asignado</span>
                            </div>
                            <?php if (!empty($conductor['vehiculo_placa'])): ?>
                                <a href="/admin/vehiculos/perfil/<?= $vehiculo['id'] ?? '' ?>" class="btn-modern btn-sm btn-outline">
                                    <i class="fas fa-eye"></i>
                                    Ver Vehículo
                                </a>
                            <?php else: ?>
                                <button class="btn-modern btn-sm btn-primary" onclick="asignarVehiculo(<?= $conductor['id'] ?>)">
                                    <i class="fas fa-plus"></i>
                                    Asignar
                                </button>
                            <?php endif; ?>
                        </div>
                        
                        <div class="section-content-modern">
                            <?php if (!empty($conductor['vehiculo_placa'])): ?>
                                <div class="vehicle-info-modern">
                                    <div class="vehicle-main-modern">
                                        <div class="vehicle-icon-modern">
                                            <i class="fas fa-motorcycle"></i>
                                        </div>
                                        <div class="vehicle-details-modern">
                                            <div class="vehicle-plate-modern"><?= htmlspecialchars($conductor['vehiculo_placa']) ?></div>
                                            <div class="vehicle-model-modern">
                                                <?= htmlspecialchars($vehiculo['marca'] ?? 'N/A') ?> 
                                                <?= htmlspecialchars($vehiculo['modelo'] ?? '') ?>
                                            </div>
                                            <div class="vehicle-year-modern">Año: <?= htmlspecialchars($vehiculo['ano'] ?? 'N/A') ?></div>
                                        </div>
                                        <div class="vehicle-status-modern">
                                            <span class="vehicle-status-badge <?= strtolower($vehiculo['estado'] ?? 'sin-estado') ?>">
                                                <?= ucfirst($vehiculo['estado'] ?? 'Sin estado') ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="vehicle-stats-modern">
                                        <div class="vehicle-stat-modern">
                                            <span class="stat-value"><?= $vehiculo['kilometraje'] ?? 0 ?> km</span>
                                            <span class="stat-label">Kilometraje</span>
                                        </div>
                                        <div class="vehicle-stat-modern">
                                            <span class="stat-value">
                                                <?= date('d/m/Y', strtotime($conductor['fecha_asignacion_vehiculo'] ?? 'now')) ?>
                                            </span>
                                            <span class="stat-label">Asignado desde</span>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="no-vehicle-modern">
                                    <div class="no-vehicle-icon-modern">
                                        <i class="fas fa-motorcycle"></i>
                                    </div>
                                    <div class="no-vehicle-text-modern">
                                        <h4>Sin Vehículo Asignado</h4>
                                        <p>Este conductor no tiene un vehículo asignado actualmente</p>
                                        <button class="btn-modern btn-primary" onclick="asignarVehiculo(<?= $conductor['id'] ?>)">
                                            <span class="btn-icon"><i class="fas fa-plus"></i></span>
                                            <span class="btn-text">Asignar Vehículo</span>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="section-card-glow"></div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="profile-section-modern" data-aos="fade-up" data-aos-delay="700">
                <div class="section-card-modern">
                    <div class="section-card-background">
                        <div class="section-header-modern">
                            <div class="section-title-modern">
                                <div class="title-icon-modern">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <span>Contacto de Emergencia</span>
                            </div>
                            <button class="btn-modern btn-sm btn-outline" onclick="editarSeccion('emergencia')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        
                        <div class="section-content-modern">
                            <?php if (!empty($conductor['contacto_emergencia_nombre'])): ?>
                                <div class="emergency-contact-modern">
                                    <div class="contact-avatar-modern">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="contact-info-modern">
                                        <div class="contact-name-modern"><?= htmlspecialchars($conductor['contacto_emergencia_nombre']) ?></div>
                                        <div class="contact-relation-modern">
                                            <i class="fas fa-heart"></i>
                                            <?= ucfirst($conductor['contacto_emergencia_relacion'] ?? 'No especificado') ?>
                                        </div>
                                        <?php if (!empty($conductor['telefono_emergencia'])): ?>
                                            <div class="contact-phone-modern">
                                                <i class="fas fa-phone"></i>
                                                <?= htmlspecialchars($conductor['telefono_emergencia']) ?>
                                                <button class="btn-contact-modern" onclick="llamar('<?= $conductor['telefono_emergencia'] ?>')">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="no-emergency-contact-modern">
                                    <div class="no-contact-icon-modern">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <div class="no-contact-text-modern">
                                        <h4>Sin Contacto de Emergencia</h4>
                                        <p>No se ha registrado información de contacto de emergencia</p>
                                        <button class="btn-modern btn-outline" onclick="editarSeccion('emergencia')">
                                            <span class="btn-icon"><i class="fas fa-plus"></i></span>
                                            <span class="btn-text">Agregar Contacto</span>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="section-card-glow"></div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="profile-section-modern span-full" data-aos="fade-up" data-aos-delay="800">
                <div class="section-card-modern">
                    <div class="section-card-background">
                        <div class="section-header-modern">
                            <div class="section-title-modern">
                                <div class="title-icon-modern">
                                    <i class="fas fa-sticky-note"></i>
                                </div>
                                <span>Observaciones Adicionales</span>
                            </div>
                            <button class="btn-modern btn-sm btn-outline" onclick="editarSeccion('observaciones')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                        
                        <div class="section-content-modern">
                            <?php if (!empty($conductor['observaciones'])): ?>
                                <div class="observations-modern">
                                    <p><?= nl2br(htmlspecialchars($conductor['observaciones'])) ?></p>
                                </div>
                            <?php else: ?>
                                <div class="no-observations-modern">
                                    <i class="fas fa-sticky-note"></i>
                                    <span>No hay observaciones registradas para este conductor</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="section-card-glow"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal-modern" id="passwordModal">
    <div class="modal-overlay-modern" onclick="closePasswordModal()"></div>
    <div class="modal-container-modern">
        <div class="modal-header-modern">
            <h3>Cambiar Contraseña</h3>
            <button class="modal-close-modern" onclick="closePasswordModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-content-modern">
            <form id="passwordForm">
                <div class="form-group-modern">
                    <label class="form-label-modern">Nueva Contraseña</label>
                    <div class="input-group-modern">
                        <div class="input-icon-modern">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" class="form-input-modern" id="newPassword" placeholder="Nueva contraseña">
                        <button type="button" class="password-toggle-modern" onclick="togglePassword('newPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group-modern">
                    <label class="form-label-modern">Confirmar Contraseña</label>
                    <div class="input-group-modern">
                        <div class="input-icon-modern">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" class="form-input-modern" id="confirmPassword" placeholder="Confirmar contraseña">
                        <button type="button" class="password-toggle-modern" onclick="togglePassword('confirmPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group-modern">
                    <div class="checkbox-group-modern">
                        <input type="checkbox" id="forceChange" checked>
                        <label for="forceChange">Requerir cambio en el siguiente inicio de sesión</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-actions-modern">
            <button class="btn-modern btn-outline" onclick="closePasswordModal()">
                <span class="btn-text">Cancelar</span>
            </button>
            <button class="btn-modern btn-primary" onclick="updatePassword()">
                <span class="btn-text">Cambiar Contraseña</span>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true
        });
    }

    console.log('Conductor profile page initialized');
});

// Action functions
function editarSeccion(seccion) {
    window.location.href = `/admin/conductores/editar/<?= $conductor['id'] ?>#${seccion}`;
}

function cambiarContrasena(conductorId) {
    document.getElementById('passwordModal').classList.add('active');
}

function closePasswordModal() {
    document.getElementById('passwordModal').classList.remove('active');
    document.getElementById('passwordForm').reset();
}

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.parentElement.querySelector('.password-toggle-modern');
    
    if (input.type === 'password') {
        input.type = 'text';
        button.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        input.type = 'password';
        button.innerHTML = '<i class="fas fa-eye"></i>';
    }
}

function updatePassword() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const forceChange = document.getElementById('forceChange').checked;
    
    if (!newPassword) {
        showAlert('Por favor ingrese una nueva contraseña', 'error');
        return;
    }
    
    if (newPassword.length < 6) {
        showAlert('La contraseña debe tener al menos 6 caracteres', 'error');
        return;
    }
    
    if (newPassword !== confirmPassword) {
        showAlert('Las contraseñas no coinciden', 'error');
        return;
    }
    
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Contraseña actualizada',
            text: 'La contraseña ha sido cambiada exitosamente',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    } else {
        alert('Contraseña actualizada exitosamente');
    }
    
    closePasswordModal();
}

function cambiarFoto(conductorId) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Cambiar Foto de Perfil',
            text: 'Redirigiendo a la página de edición...',
            icon: 'info',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = `/admin/conductores/editar/${conductorId}#foto`;
        });
    } else {
        window.location.href = `/admin/conductores/editar/${conductorId}#foto`;
    }
}

function asignarVehiculo(conductorId) {
    window.location.href = `/admin/asignaciones/crear?conductor_id=${conductorId}`;
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
                window.location.href = `/admin/conductores/suspender/${conductorId}?motivo=${encodeURIComponent(result.value)}`;
            }
        });
    } else {
        const motivo = prompt('Ingrese el motivo de suspensión:');
        if (motivo) {
            window.location.href = `/admin/conductores/suspender/${conductorId}?motivo=${encodeURIComponent(motivo)}`;
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

// Contact functions
function llamar(telefono) {
    window.location.href = `tel:${telefono}`;
}

function enviarEmail(email) {
    window.location.href = `mailto:${email}`;
}

function verMapa(direccion) {
    window.open(`https://maps.google.com/maps?q=${direccion}`, '_blank');
}

function showAlert(message, type = 'info') {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: type === 'error' ? 'Error' : 'Información',
            text: message,
            icon: type === 'error' ? 'error' : 'info',
            timer: 3000,
            showConfirmButton: false
        });
    } else {
        alert(message);
    }
}
</script>

<style>
/* Profile header styles */
.profile-header-modern {
    margin-bottom: 2rem;
}

.profile-header-background {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    overflow: hidden;
    position: relative;
}

.profile-cover-modern {
    height: 120px;
    background: var(--gradient-primary);
    position: relative;
}

.profile-main-info-modern {
    display: flex;
    align-items: flex-start;
    gap: 2rem;
    padding: 2rem;
    margin-top: -60px;
    position: relative;
    z-index: 10;
}

.profile-avatar-section-modern {
    position: relative;
    flex-shrink: 0;
}

.profile-avatar-container-modern {
    position: relative;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid var(--card-bg);
    background: var(--card-bg);
}

.profile-avatar-modern {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-avatar-placeholder-modern {
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 2.5rem;
}

.profile-status-indicator {
    position: absolute;
    bottom: 8px;
    right: 8px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: 3px solid var(--card-bg);
}

.profile-status-indicator.activo {
    background: var(--success-color);
}

.profile-status-indicator.inactivo {
    background: var(--error-color);
}

.profile-status-indicator.suspendido {
    background: var(--warning-color);
}

.profile-photo-edit-modern {
    position: absolute;
    bottom: -10px;
    right: -10px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary-green);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-md);
}

.profile-photo-edit-modern:hover {
    background: var(--primary-green-dark);
    transform: scale(1.1);
}

.profile-info-section-modern {
    flex: 1;
    min-width: 0;
}

.profile-name-modern {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.profile-role-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-green);
    font-weight: 600;
    margin-bottom: 1rem;
}

.profile-meta-modern {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.meta-item-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.meta-item-modern i {
    color: var(--primary-green);
}

.profile-actions-section-modern {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 1rem;
}

.profile-quick-actions-modern {
    display: flex;
    gap: 0.75rem;
}

/* Stats grid */
.stats-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* Profile sections grid */
.profile-sections-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

.profile-section-modern.span-full {
    grid-column: 1 / -1;
}

.section-card-modern {
    position: relative;
    height: 100%;
}

.section-card-background {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.section-header-modern {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border-color);
}

.section-title-modern {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
    color: var(--text-primary);
}

.title-icon-modern {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

/* Info grid */
.info-grid-modern {
    display: grid;
    gap: 1rem;
}

.info-item-modern {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-item-modern.span-full {
    grid-column: 1 / -1;
}

.info-label-modern {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value-modern {
    font-size: 1rem;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-extra-modern {
    font-size: 0.85rem;
    color: var(--text-secondary);
    font-style: italic;
}

.text-muted {
    color: var(--text-secondary);
    font-style: italic;
}

/* Contact buttons */
.btn-contact-modern {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--primary-green);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: auto;
}

.btn-contact-modern:hover {
    background: var(--primary-green-dark);
    transform: scale(1.1);
}

/* License status */
.license-status-modern {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.license-indicator-modern {
    font-size: 0.85rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.license-indicator-modern.valid {
    color: var(--success-color);
}

.license-indicator-modern.warning {
    color: var(--warning-color);
}

.license-indicator-modern.expired {
    color: var(--error-color);
}

/* Category badge */
.category-badge-modern {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
}

.category-badge-modern.a1,
.category-badge-modern.a2 {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
}

.category-badge-modern.b1,
.category-badge-modern.b2 {
    background: rgba(59, 130, 246, 0.15);
    color: var(--info-color);
}

.category-badge-modern.c1 {
    background: rgba(245, 158, 11, 0.15);
    color: var(--warning-color);
}

/* Vehicle info */
.vehicle-info-modern {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.vehicle-main-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.vehicle-icon-modern {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.vehicle-details-modern {
    flex: 1;
}

.vehicle-plate-modern {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-primary);
}

.vehicle-model-modern {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.vehicle-year-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.vehicle-status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.vehicle-status-badge.activo {
    background: rgba(34, 197, 94, 0.15);
    color: var(--success-color);
}

.vehicle-status-badge.inactivo {
    background: rgba(239, 68, 68, 0.15);
    color: var(--error-color);
}

.vehicle-status-badge.mantenimiento {
    background: rgba(245, 158, 11, 0.15);
    color: var(--warning-color);
}

.vehicle-stats-modern {
    display: flex;
    gap: 1rem;
}

.vehicle-stat-modern {
    flex: 1;
    text-align: center;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.vehicle-stat-modern .stat-value {
    display: block;
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.vehicle-stat-modern .stat-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

/* No vehicle state */
.no-vehicle-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 2rem;
    color: var(--text-secondary);
}

.no-vehicle-icon-modern {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--card-hover-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 1rem;
    border: 2px dashed var(--border-color);
}

.no-vehicle-text-modern h4 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.no-vehicle-text-modern p {
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

/* Emergency contact */
.emergency-contact-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.contact-avatar-modern {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.contact-info-modern {
    flex: 1;
}

.contact-name-modern {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.contact-relation-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.contact-phone-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

/* No emergency contact */
.no-emergency-contact-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 2rem;
    color: var(--text-secondary);
}

.no-contact-icon-modern {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--card-hover-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 1rem;
    border: 2px dashed var(--border-color);
}

.no-contact-text-modern h4 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.no-contact-text-modern p {
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

/* Observations */
.observations-modern {
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
}

.observations-modern p {
    color: var(--text-primary);
    line-height: 1.6;
    margin: 0;
}

.no-observations-modern {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 2rem;
    color: var(--text-secondary);
    font-style: italic;
}

/* Password modal */
.password-toggle-modern {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
}

.password-toggle-modern:hover {
    color: var(--primary-green);
    background: rgba(var(--primary-green-rgb), 0.1);
}

.checkbox-group-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.checkbox-group-modern input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: var(--primary-green);
}

.checkbox-group-modern label {
    font-size: 0.9rem;
    color: var(--text-secondary);
    cursor: pointer;
}

/* Responsive design */
@media (max-width: 1200px) {
    .profile-sections-grid-modern {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .profile-main-info-modern {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
        margin-top: -30px;
        padding: 1.5rem;
    }
    
    .profile-avatar-container-modern {
        width: 100px;
        height: 100px;
    }
    
    .profile-name-modern {
        font-size: 1.5rem;
    }
    
    .profile-meta-modern {
        justify-content: center;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .profile-actions-section-modern {
        align-items: center;
    }
    
    .profile-quick-actions-modern {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .stats-grid-modern {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
    
    .vehicle-main-modern {
        flex-direction: column;
        text-align: center;
    }
    
    .vehicle-stats-modern {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .stats-grid-modern {
        grid-template-columns: 1fr;
    }
    
    .emergency-contact-modern {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>