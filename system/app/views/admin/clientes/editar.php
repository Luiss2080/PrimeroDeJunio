<?php
/**
 * Vista Editar Cliente - Sistema PRIMERO DE JUNIO
 */

$title = 'Editar Cliente';
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
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Editar Cliente</span>
                        <span class="title-subtitle">Modificar información de <?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?></span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/clientes/perfil/<?= $cliente['id'] ?>" class="btn-modern btn-info">
                        <span class="btn-icon"><i class="fas fa-eye"></i></span>
                        <span class="btn-text">Ver Perfil</span>
                    </a>
                    <a href="/admin/clientes" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Container -->
<div class="container-modern">
    <!-- Progress Indicator -->
    <div class="progress-indicator-modern" data-aos="fade-up">
        <div class="progress-steps-modern">
            <div class="progress-step-modern active" data-step="1">
                <div class="step-number-modern">1</div>
                <div class="step-label-modern">Información Personal</div>
            </div>
            <div class="progress-line-modern"></div>
            <div class="progress-step-modern" data-step="2">
                <div class="step-number-modern">2</div>
                <div class="step-label-modern">Contacto y Ubicación</div>
            </div>
            <div class="progress-line-modern"></div>
            <div class="progress-step-modern" data-step="3">
                <div class="step-number-modern">3</div>
                <div class="step-label-modern">Configuraciones</div>
            </div>
        </div>
    </div>

    <!-- Información del Cliente -->
    <div class="system-card-modern info-card" data-aos="fade-up" data-aos-delay="100">
        <div class="system-card-background">
            <div class="card-content-modern">
                <div class="client-info-header-modern">
                    <div class="client-avatar-edit-modern">
                        <?php if (!empty($cliente['foto'])): ?>
                            <img src="/uploads/clientes/<?= htmlspecialchars($cliente['foto']) ?>" alt="Foto del cliente">
                        <?php else: ?>
                            <div class="avatar-placeholder-edit-modern">
                                <?= strtoupper(substr($cliente['nombre'], 0, 1) . substr($cliente['apellido'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <div class="client-status-large <?= $cliente['estado'] ?>"></div>
                    </div>
                    <div class="client-details-modern">
                        <h3 class="client-name-edit"><?= htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']) ?></h3>
                        <div class="client-meta-modern">
                            <span class="client-id-edit">ID: #<?= str_pad($cliente['id'], 4, '0', STR_PAD_LEFT) ?></span>
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
                            <span class="status-badge-modern <?= $cliente['estado'] ?>"><?= ucfirst($cliente['estado']) ?></span>
                        </div>
                        <div class="client-stats-modern">
                            <div class="stat-item">
                                <span class="stat-value"><?= $cliente['total_viajes'] ?? 0 ?></span>
                                <span class="stat-label">Viajes</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?= $cliente['created_at'] ? date('M Y', strtotime($cliente['created_at'])) : 'N/A' ?></span>
                                <span class="stat-label">Desde</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="system-card-glow"></div>
    </div>

    <form class="form-modern" id="formEditarCliente" method="POST" action="/admin/clientes/editar/<?= $cliente['id'] ?>" enctype="multipart/form-data" data-aos="fade-up" data-aos-delay="200">
        <!-- Paso 1: Información Personal -->
        <div class="form-step-modern active" data-step="1">
            <div class="system-card-modern form-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>Información Personal</span>
                        </div>
                        <div class="card-actions-modern">
                            <button type="button" class="btn-modern btn-sm btn-outline" onclick="resetForm()">
                                <span class="btn-icon"><i class="fas fa-undo"></i></span>
                                <span class="btn-text">Restaurar</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-content-modern">
                        <!-- Photo Upload -->
                        <div class="form-group-modern full-width">
                            <div class="avatar-upload-modern">
                                <div class="avatar-preview-modern">
                                    <?php if (!empty($cliente['foto'])): ?>
                                        <img id="avatarPreview" src="/uploads/clientes/<?= htmlspecialchars($cliente['foto']) ?>" alt="Avatar">
                                    <?php else: ?>
                                        <img id="avatarPreview" src="/assets/images/default-avatar.png" alt="Avatar">
                                    <?php endif; ?>
                                </div>
                                <div class="upload-button-modern">
                                    <input type="file" id="foto" name="foto" accept="image/*" style="display: none;">
                                    <button type="button" class="btn-modern btn-outline" onclick="document.getElementById('foto').click()">
                                        <span class="btn-icon"><i class="fas fa-camera"></i></span>
                                        <span class="btn-text">Cambiar Foto</span>
                                    </button>
                                    <?php if (!empty($cliente['foto'])): ?>
                                        <button type="button" class="btn-modern btn-sm btn-danger" onclick="removePhoto()">
                                            <span class="btn-icon"><i class="fas fa-trash"></i></span>
                                        </button>
                                        <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label class="form-label-modern required">Nombre</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <input type="text" 
                                           class="form-input-modern" 
                                           name="nombre" 
                                           id="nombre"
                                           value="<?= htmlspecialchars($cliente['nombre']) ?>"
                                           placeholder="Ingrese el nombre"
                                           required>
                                </div>
                                <div class="form-error-modern" id="error-nombre"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern required">Apellido</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <input type="text" 
                                           class="form-input-modern" 
                                           name="apellido" 
                                           id="apellido"
                                           value="<?= htmlspecialchars($cliente['apellido']) ?>"
                                           placeholder="Ingrese el apellido"
                                           required>
                                </div>
                                <div class="form-error-modern" id="error-apellido"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern">Documento</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <input type="text" 
                                           class="form-input-modern" 
                                           name="documento" 
                                           id="documento"
                                           value="<?= htmlspecialchars($cliente['documento'] ?? '') ?>"
                                           placeholder="Número de documento">
                                </div>
                                <div class="form-error-modern" id="error-documento"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern">Fecha de Nacimiento</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <input type="date" 
                                           class="form-input-modern" 
                                           name="fecha_nacimiento" 
                                           id="fecha_nacimiento"
                                           value="<?= htmlspecialchars($cliente['fecha_nacimiento'] ?? '') ?>">
                                </div>
                                <div class="form-error-modern" id="error-fecha_nacimiento"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern required">Tipo de Cliente</label>
                                <div class="radio-group-modern">
                                    <label class="radio-modern">
                                        <input type="radio" 
                                               name="tipo_cliente" 
                                               value="particular"
                                               <?= $cliente['tipo_cliente'] === 'particular' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-user"></i>
                                            <span>Particular</span>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-modern">
                                        <input type="radio" 
                                               name="tipo_cliente" 
                                               value="corporativo"
                                               <?= $cliente['tipo_cliente'] === 'corporativo' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-building"></i>
                                            <span>Corporativo</span>
                                        </div>
                                    </label>
                                    
                                    <label class="radio-modern">
                                        <input type="radio" 
                                               name="tipo_cliente" 
                                               value="frecuente"
                                               <?= $cliente['tipo_cliente'] === 'frecuente' ? 'checked' : '' ?>>
                                        <span class="radio-check-modern"></span>
                                        <div class="radio-content-modern">
                                            <i class="fas fa-star"></i>
                                            <span>Frecuente</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-error-modern" id="error-tipo_cliente"></div>
                            </div>
                            
                            <!-- Campos específicos para cliente corporativo -->
                            <div class="form-group-modern full-width" id="campos-corporativo" style="<?= $cliente['tipo_cliente'] === 'corporativo' ? '' : 'display: none;' ?>">
                                <div class="form-subgrid-modern">
                                    <div class="form-group-modern">
                                        <label class="form-label-modern">Empresa</label>
                                        <div class="input-group-modern">
                                            <div class="input-icon-modern">
                                                <i class="fas fa-building"></i>
                                            </div>
                                            <input type="text" 
                                                   class="form-input-modern" 
                                                   name="empresa" 
                                                   id="empresa"
                                                   value="<?= htmlspecialchars($cliente['empresa'] ?? '') ?>"
                                                   placeholder="Nombre de la empresa">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group-modern">
                                        <label class="form-label-modern">RUC/NIT</label>
                                        <div class="input-group-modern">
                                            <div class="input-icon-modern">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <input type="text" 
                                                   class="form-input-modern" 
                                                   name="ruc" 
                                                   id="ruc"
                                                   value="<?= htmlspecialchars($cliente['ruc'] ?? '') ?>"
                                                   placeholder="RUC o NIT de la empresa">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-step-actions-modern">
                            <button type="button" class="btn-modern btn-primary btn-next" data-next="2">
                                <span class="btn-text">Siguiente</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Paso 2: Contacto y Ubicación -->
        <div class="form-step-modern" data-step="2">
            <div class="system-card-modern form-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-address-book"></i>
                            </div>
                            <span>Contacto y Ubicación</span>
                        </div>
                    </div>
                    
                    <div class="card-content-modern">
                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label class="form-label-modern required">Teléfono Principal</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <input type="tel" 
                                           class="form-input-modern" 
                                           name="telefono" 
                                           id="telefono"
                                           value="<?= htmlspecialchars($cliente['telefono']) ?>"
                                           placeholder="+591 7XXXXXXX"
                                           required>
                                </div>
                                <div class="form-error-modern" id="error-telefono"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern">Teléfono Alternativo</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <input type="tel" 
                                           class="form-input-modern" 
                                           name="telefono_secundario" 
                                           id="telefono_secundario"
                                           value="<?= htmlspecialchars($cliente['telefono_secundario'] ?? '') ?>"
                                           placeholder="+591 7XXXXXXX (opcional)">
                                </div>
                                <div class="form-error-modern" id="error-telefono_secundario"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern">Email</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <input type="email" 
                                           class="form-input-modern" 
                                           name="email" 
                                           id="email"
                                           value="<?= htmlspecialchars($cliente['email'] ?? '') ?>"
                                           placeholder="cliente@ejemplo.com">
                                </div>
                                <div class="form-error-modern" id="error-email"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern">Género</label>
                                <select class="form-select-modern" name="genero" id="genero">
                                    <option value="">Seleccionar</option>
                                    <option value="masculino" <?= ($cliente['genero'] ?? '') === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="femenino" <?= ($cliente['genero'] ?? '') === 'femenino' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="otro" <?= ($cliente['genero'] ?? '') === 'otro' ? 'selected' : '' ?>>Otro</option>
                                </select>
                                <div class="form-error-modern" id="error-genero"></div>
                            </div>
                        </div>
                        
                        <!-- Dirección -->
                        <div class="form-group-modern full-width">
                            <label class="form-label-modern">Dirección Completa</label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <textarea class="form-textarea-modern" 
                                          name="direccion" 
                                          id="direccion" 
                                          rows="3"
                                          placeholder="Calle, número, zona, ciudad..."><?= htmlspecialchars($cliente['direccion'] ?? '') ?></textarea>
                            </div>
                            <div class="form-error-modern" id="error-direccion"></div>
                        </div>

                        <!-- Referencias de Ubicación -->
                        <div class="form-group-modern full-width">
                            <label class="form-label-modern">Referencias de Ubicación</label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <textarea class="form-textarea-modern" 
                                          name="referencias" 
                                          id="referencias" 
                                          rows="2"
                                          placeholder="Cerca de..., frente a..., al lado de..."><?= htmlspecialchars($cliente['referencias'] ?? '') ?></textarea>
                            </div>
                            <div class="form-error-modern" id="error-referencias"></div>
                        </div>
                        
                        <div class="form-step-actions-modern">
                            <button type="button" class="btn-modern btn-outline btn-back" data-back="1">
                                <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                                <span class="btn-text">Anterior</span>
                            </button>
                            <button type="button" class="btn-modern btn-primary btn-next" data-next="3">
                                <span class="btn-text">Siguiente</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Paso 3: Configuraciones -->
        <div class="form-step-modern" data-step="3">
            <div class="system-card-modern form-card">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <span>Configuraciones y Estado</span>
                        </div>
                    </div>
                    
                    <div class="card-content-modern">
                        <!-- Descuentos y Promociones -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-tag"></i>
                                Descuentos y Promociones
                            </h3>
                            
                            <div class="form-grid-modern">
                                <div class="form-group-modern">
                                    <div class="checkbox-group-modern">
                                        <label class="checkbox-modern">
                                            <input type="checkbox" 
                                                   name="tiene_descuento" 
                                                   id="tiene_descuento"
                                                   value="1"
                                                   <?= ($cliente['descuento_porcentaje'] > 0) ? 'checked' : '' ?>>
                                            <span class="checkbox-check-modern">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <div class="checkbox-content-modern">
                                                <span class="checkbox-title">Aplicar Descuento Especial</span>
                                                <span class="checkbox-description">Cliente con tarifa preferencial</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group-modern" id="grupo-descuento" style="<?= ($cliente['descuento_porcentaje'] > 0) ? '' : 'display: none;' ?>">
                                    <label class="form-label-modern">Porcentaje de Descuento</label>
                                    <div class="input-group-modern">
                                        <div class="input-icon-modern">
                                            <i class="fas fa-percentage"></i>
                                        </div>
                                        <input type="number" 
                                               class="form-input-modern" 
                                               name="descuento_porcentaje" 
                                               id="descuento_porcentaje"
                                               value="<?= htmlspecialchars($cliente['descuento_porcentaje'] ?? '') ?>"
                                               min="0"
                                               max="50"
                                               placeholder="0">
                                    </div>
                                    <div class="form-help-modern">Máximo 50%</div>
                                </div>
                            </div>
                            
                            <div class="form-group-modern full-width" id="grupo-motivo-descuento" style="<?= ($cliente['descuento_porcentaje'] > 0) ? '' : 'display: none;' ?>">
                                <label class="form-label-modern">Motivo del Descuento</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <input type="text" 
                                           class="form-input-modern" 
                                           name="motivo_descuento" 
                                           id="motivo_descuento"
                                           value="<?= htmlspecialchars($cliente['motivo_descuento'] ?? '') ?>"
                                           placeholder="Ej: Cliente frecuente, promoción especial...">
                                </div>
                            </div>
                        </div>

                        <!-- Preferencias de Servicio -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-star"></i>
                                Preferencias de Servicio
                            </h3>
                            
                            <div class="checkbox-group-modern">
                                <label class="checkbox-modern">
                                    <input type="checkbox" 
                                           name="notificaciones_sms" 
                                           value="1"
                                           <?= ($cliente['notificaciones_sms'] ?? true) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <span class="checkbox-title">Notificaciones SMS</span>
                                        <span class="checkbox-description">Recibir mensajes sobre el estado del servicio</span>
                                    </div>
                                </label>
                                
                                <label class="checkbox-modern">
                                    <input type="checkbox" 
                                           name="notificaciones_email" 
                                           value="1"
                                           <?= ($cliente['notificaciones_email'] ?? false) ? 'checked' : '' ?>>
                                    <span class="checkbox-check-modern">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div class="checkbox-content-modern">
                                        <span class="checkbox-title">Notificaciones Email</span>
                                        <span class="checkbox-description">Recibir correos con confirmaciones y facturas</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Estado y Observaciones -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-info-circle"></i>
                                Estado y Observaciones
                            </h3>
                            
                            <div class="form-grid-modern">
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Estado del Cliente</label>
                                    <select class="form-select-modern" name="estado" id="estado">
                                        <option value="activo" <?= $cliente['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                                        <option value="inactivo" <?= $cliente['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                    </select>
                                </div>
                                
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Prioridad</label>
                                    <select class="form-select-modern" name="prioridad" id="prioridad">
                                        <option value="normal" <?= ($cliente['prioridad'] ?? 'normal') === 'normal' ? 'selected' : '' ?>>Normal</option>
                                        <option value="alta" <?= ($cliente['prioridad'] ?? '') === 'alta' ? 'selected' : '' ?>>Alta</option>
                                        <option value="vip" <?= ($cliente['prioridad'] ?? '') === 'vip' ? 'selected' : '' ?>>VIP</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group-modern full-width">
                                <label class="form-label-modern">Observaciones</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-comment-alt"></i>
                                    </div>
                                    <textarea class="form-textarea-modern" 
                                              name="observaciones" 
                                              id="observaciones" 
                                              rows="3"
                                              placeholder="Notas adicionales sobre el cliente..."><?= htmlspecialchars($cliente['observaciones'] ?? '') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Auditoría -->
                        <div class="form-section-modern">
                            <h3 class="section-title-modern">
                                <i class="fas fa-clock"></i>
                                Información de Registro
                            </h3>
                            
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
                                    <label>Total de Viajes:</label>
                                    <span><?= $cliente['total_viajes'] ?? 0 ?> viajes realizados</span>
                                </div>
                                <div class="info-item-modern">
                                    <label>Último Viaje:</label>
                                    <span><?= $cliente['ultimo_viaje'] ? date('d/m/Y', strtotime($cliente['ultimo_viaje'])) : 'Ningún viaje' ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-step-actions-modern">
                            <button type="button" class="btn-modern btn-outline btn-back" data-back="2">
                                <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                                <span class="btn-text">Anterior</span>
                            </button>
                            <button type="submit" class="btn-modern btn-success btn-submit" id="submitBtn">
                                <span class="btn-icon"><i class="fas fa-save"></i></span>
                                <span class="btn-text">Guardar Cambios</span>
                                <div class="btn-loading">
                                    <div class="spinner-modern"></div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>
    </form>
</div>

<!-- Change History Modal -->
<div class="modal-modern" id="historyModal">
    <div class="modal-overlay-modern" onclick="closeHistory()"></div>
    <div class="modal-container-modern large">
        <div class="modal-header-modern">
            <h2>Historial de Cambios</h2>
            <button class="modal-close-modern" onclick="closeHistory()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body-modern" id="historyContent">
            <!-- El contenido se cargará dinámicamente -->
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

    // Referencias a elementos
    const form = document.getElementById('formEditarCliente');
    const steps = document.querySelectorAll('.form-step-modern');
    const progressSteps = document.querySelectorAll('.progress-step-modern');
    const nextButtons = document.querySelectorAll('.btn-next');
    const backButtons = document.querySelectorAll('.btn-back');
    const submitBtn = document.getElementById('submitBtn');

    // Guardar valores originales para resetear
    const originalValues = {};
    form.querySelectorAll('input, select, textarea').forEach(field => {
        if (field.type === 'checkbox' || field.type === 'radio') {
            originalValues[field.name] = field.checked;
        } else {
            originalValues[field.name] = field.value;
        }
    });

    // Eventos de navegación
    nextButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const nextStep = parseInt(this.getAttribute('data-next'));
            if (validateCurrentStep()) {
                showStep(nextStep);
            }
        });
    });

    backButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const prevStep = parseInt(this.getAttribute('data-back'));
            showStep(prevStep);
        });
    });

    // Mostrar/ocultar campos según tipo de cliente
    const tipoClienteInputs = document.querySelectorAll('input[name="tipo_cliente"]');
    tipoClienteInputs.forEach(input => {
        input.addEventListener('change', function() {
            const camposCorporativo = document.getElementById('campos-corporativo');
            if (this.value === 'corporativo') {
                camposCorporativo.style.display = 'block';
                document.getElementById('empresa').required = true;
            } else {
                camposCorporativo.style.display = 'none';
                document.getElementById('empresa').required = false;
            }
        });
    });

    // Mostrar/ocultar campos de descuento
    const tieneDescuento = document.getElementById('tiene_descuento');
    tieneDescuento.addEventListener('change', function() {
        const grupoDescuento = document.getElementById('grupo-descuento');
        const grupoMotivo = document.getElementById('grupo-motivo-descuento');
        
        if (this.checked) {
            grupoDescuento.style.display = 'block';
            grupoMotivo.style.display = 'block';
        } else {
            grupoDescuento.style.display = 'none';
            grupoMotivo.style.display = 'none';
            document.getElementById('descuento_porcentaje').value = '';
            document.getElementById('motivo_descuento').value = '';
        }
    });

    // Preview de foto
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Validación en tiempo real
    setupRealTimeValidation();

    // Detectar cambios en el formulario
    let formChanged = false;
    form.addEventListener('input', function() {
        formChanged = true;
    });

    form.addEventListener('change', function() {
        formChanged = true;
    });

    // Advertencia antes de salir
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '¿Está seguro de salir? Los cambios no guardados se perderán.';
            return e.returnValue;
        }
    });

    // Submit del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitBtn.classList.add('loading');
            
            // Simular delay y enviar
            setTimeout(() => {
                formChanged = false; // Resetear flag de cambios
                this.submit();
            }, 1000);
        }
    });

    console.log('Cliente editar form initialized');
});

function showStep(stepNumber) {
    // Ocultar todos los pasos
    document.querySelectorAll('.form-step-modern').forEach(step => {
        step.classList.remove('active');
    });
    
    // Mostrar paso actual
    document.querySelector(`.form-step-modern[data-step="${stepNumber}"]`).classList.add('active');
    
    // Actualizar indicador de progreso
    document.querySelectorAll('.progress-step-modern').forEach((step, index) => {
        step.classList.remove('active', 'completed');
        if (index + 1 === stepNumber) {
            step.classList.add('active');
        } else if (index + 1 < stepNumber) {
            step.classList.add('completed');
        }
    });
    
    // Scroll al inicio del formulario
    document.querySelector('.form-modern').scrollIntoView({ behavior: 'smooth' });
}

function validateCurrentStep() {
    const activeStep = document.querySelector('.form-step-modern.active');
    const stepNumber = parseInt(activeStep.getAttribute('data-step'));
    
    let isValid = true;
    const requiredFields = activeStep.querySelectorAll('input[required], select[required]');
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            showFieldError(field, 'Este campo es requerido');
            isValid = false;
        } else {
            clearFieldError(field);
        }
    });
    
    // Validaciones específicas por paso
    switch (stepNumber) {
        case 1:
            isValid = validateStep1() && isValid;
            break;
        case 2:
            isValid = validateStep2() && isValid;
            break;
        case 3:
            isValid = validateStep3() && isValid;
            break;
    }
    
    return isValid;
}

function validateStep1() {
    let isValid = true;
    
    // Validar nombre y apellido
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    
    if (nombre.value.length < 2) {
        showFieldError(nombre, 'El nombre debe tener al menos 2 caracteres');
        isValid = false;
    }
    
    if (apellido.value.length < 2) {
        showFieldError(apellido, 'El apellido debe tener al menos 2 caracteres');
        isValid = false;
    }
    
    // Validar campos corporativos si es necesario
    const tipoCliente = document.querySelector('input[name="tipo_cliente"]:checked');
    if (tipoCliente && tipoCliente.value === 'corporativo') {
        const empresa = document.getElementById('empresa');
        if (!empresa.value.trim()) {
            showFieldError(empresa, 'El nombre de la empresa es requerido');
            isValid = false;
        }
    }
    
    return isValid;
}

function validateStep2() {
    let isValid = true;
    
    // Validar teléfono
    const telefono = document.getElementById('telefono');
    const telefonoRegex = /^[0-9+\-\s()]{7,15}$/;
    
    if (!telefonoRegex.test(telefono.value)) {
        showFieldError(telefono, 'Formato de teléfono inválido');
        isValid = false;
    }
    
    // Validar email si está presente
    const email = document.getElementById('email');
    if (email.value && !isValidEmail(email.value)) {
        showFieldError(email, 'Formato de email inválido');
        isValid = false;
    }
    
    return isValid;
}

function validateStep3() {
    let isValid = true;
    
    // Validar descuento si está marcado
    const tieneDescuento = document.getElementById('tiene_descuento');
    if (tieneDescuento.checked) {
        const descuentoPorcentaje = document.getElementById('descuento_porcentaje');
        const porcentaje = parseFloat(descuentoPorcentaje.value);
        
        if (isNaN(porcentaje) || porcentaje < 0 || porcentaje > 50) {
            showFieldError(descuentoPorcentaje, 'El descuento debe ser entre 0% y 50%');
            isValid = false;
        }
    }
    
    return isValid;
}

function validateForm() {
    let isValid = true;
    
    // Validar todos los pasos
    for (let i = 1; i <= 3; i++) {
        const step = document.querySelector(`.form-step-modern[data-step="${i}"]`);
        const requiredFields = step.querySelectorAll('input[required], select[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
            }
        });
    }
    
    return isValid;
}

function showFieldError(field, message) {
    field.classList.add('error');
    const errorElement = document.getElementById(`error-${field.id}`);
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
}

function clearFieldError(field) {
    field.classList.remove('error');
    const errorElement = document.getElementById(`error-${field.id}`);
    if (errorElement) {
        errorElement.textContent = '';
        errorElement.style.display = 'none';
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function setupRealTimeValidation() {
    // Limpiar errores al escribir
    document.querySelectorAll('.form-input-modern, .form-select-modern, .form-textarea-modern').forEach(field => {
        field.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                clearFieldError(this);
            }
        });
    });
}

function resetForm() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Restaurar valores originales?',
            text: 'Se perderán todos los cambios realizados',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Restaurar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#f59e0b'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    } else {
        if (confirm('¿Está seguro de restaurar los valores originales? Se perderán todos los cambios.')) {
            location.reload();
        }
    }
}

function removePhoto() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Eliminar foto?',
            text: 'La foto actual se eliminará',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('avatarPreview').src = '/assets/images/default-avatar.png';
                document.getElementById('remove_photo').value = '1';
            }
        });
    } else {
        if (confirm('¿Está seguro de eliminar la foto actual?')) {
            document.getElementById('avatarPreview').src = '/assets/images/default-avatar.png';
            document.getElementById('remove_photo').value = '1';
        }
    }
}

function showHistory() {
    // Cargar historial de cambios (implementar según necesidad)
    document.getElementById('historyModal').classList.add('active');
}

function closeHistory() {
    document.getElementById('historyModal').classList.remove('active');
}
</script>

<style>
/* Estilos específicos para editar cliente */
.client-info-header-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.client-avatar-edit-modern {
    position: relative;
    width: 80px;
    height: 80px;
    flex-shrink: 0;
}

.client-avatar-edit-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-placeholder-edit-modern {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 1.5rem;
}

.client-details-modern {
    flex: 1;
}

.client-name-edit {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.client-meta-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.75rem;
    flex-wrap: wrap;
}

.client-id-edit {
    font-size: 0.9rem;
    color: var(--text-secondary);
    font-weight: 600;
}

.client-stats-modern {
    display: flex;
    gap: 2rem;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.stat-value {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-green);
}

.stat-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
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

/* Responsive design */
@media (max-width: 768px) {
    .client-info-header-modern {
        flex-direction: column;
        text-align: center;
    }
    
    .client-meta-modern {
        justify-content: center;
    }
    
    .client-stats-modern {
        justify-content: center;
        gap: 1.5rem;
    }
    
    .info-grid-modern {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>