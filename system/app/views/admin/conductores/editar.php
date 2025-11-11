<?php
/**
 * Vista Editar Conductor - Sistema PRIMERO DE JUNIO
 */

$title = 'Editar Conductor';
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
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Editar Conductor</span>
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
                    <span class="breadcrumb-item active">Editar</span>
                </div>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/conductores/perfil/<?= $conductor['id'] ?>" class="btn-modern btn-info">
                        <span class="btn-icon"><i class="fas fa-eye"></i></span>
                        <span class="btn-text">Ver Perfil</span>
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
    <!-- Conductor Summary -->
    <div class="system-card-modern summary-card" data-aos="fade-up" data-aos-delay="100">
        <div class="system-card-background">
            <div class="summary-content-modern">
                <div class="conductor-summary-modern">
                    <div class="conductor-photo-modern">
                        <?php if (!empty($conductor['foto'])): ?>
                            <img src="<?= htmlspecialchars($conductor['foto']) ?>" alt="Foto" class="conductor-avatar-modern">
                        <?php else: ?>
                            <div class="conductor-avatar-placeholder-modern">
                                <?= strtoupper(substr($conductor['nombre'], 0, 1) . substr($conductor['apellido'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <span class="conductor-status-badge <?= $conductor['estado'] ?>">
                            <?= ucfirst($conductor['estado']) ?>
                        </span>
                    </div>
                    
                    <div class="conductor-info-summary-modern">
                        <h3 class="conductor-name-modern"><?= htmlspecialchars($conductor['nombre'] . ' ' . $conductor['apellido']) ?></h3>
                        <div class="conductor-details-modern">
                            <div class="detail-item-modern">
                                <i class="fas fa-id-card"></i>
                                <span>Cédula: <?= htmlspecialchars($conductor['cedula']) ?></span>
                            </div>
                            <div class="detail-item-modern">
                                <i class="fas fa-id-badge"></i>
                                <span>Licencia: <?= htmlspecialchars($conductor['licencia_numero'] ?? 'N/A') ?></span>
                            </div>
                            <div class="detail-item-modern">
                                <i class="fas fa-phone"></i>
                                <span>Teléfono: <?= htmlspecialchars($conductor['telefono']) ?></span>
                            </div>
                            <?php if (!empty($conductor['vehiculo_placa'])): ?>
                                <div class="detail-item-modern">
                                    <i class="fas fa-motorcycle"></i>
                                    <span>Vehículo: <?= htmlspecialchars($conductor['vehiculo_placa']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="conductor-stats-modern">
                        <div class="stat-item-modern">
                            <span class="stat-number"><?= $conductor['experiencia_anos'] ?></span>
                            <span class="stat-label">Años Exp.</span>
                        </div>
                        <div class="stat-item-modern">
                            <span class="stat-number"><?= $estadisticas['total_viajes'] ?? 0 ?></span>
                            <span class="stat-label">Viajes</span>
                        </div>
                        <div class="stat-item-modern">
                            <span class="stat-number"><?= number_format($estadisticas['calificacion_promedio'] ?? 0, 1) ?></span>
                            <span class="stat-label">Calificación</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="system-card-glow"></div>
    </div>

    <!-- Edit Form -->
    <div class="form-container-modern" data-aos="fade-up" data-aos-delay="200">
        <form class="form-modern" id="formEditarConductor" method="POST" action="/admin/conductores/actualizar/<?= $conductor['id'] ?>" enctype="multipart/form-data">
            
            <!-- Información Personal -->
            <div class="form-section-modern" data-aos="fade-up" data-aos-delay="300">
                <div class="section-header-modern">
                    <div class="section-icon-modern">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="section-title-modern">
                        <h3>Información Personal</h3>
                        <p>Datos básicos de identificación del conductor</p>
                    </div>
                    <div class="section-actions-modern">
                        <button type="button" class="btn-modern btn-sm btn-outline" onclick="restoreSection('personal')">
                            <i class="fas fa-undo"></i>
                            Restaurar
                        </button>
                    </div>
                </div>
                
                <div class="section-content-modern">
                    <div class="form-grid-modern">
                        <div class="form-group-modern span-full">
                            <div class="photo-upload-modern">
                                <div class="photo-preview-modern">
                                    <img id="photoPreview" 
                                         src="<?= !empty($conductor['foto']) ? htmlspecialchars($conductor['foto']) : '/assets/images/default-avatar.png' ?>" 
                                         alt="Foto">
                                    <div class="photo-overlay-modern">
                                        <i class="fas fa-camera"></i>
                                        <span>Cambiar Foto</span>
                                    </div>
                                </div>
                                <input type="file" id="foto" name="foto" accept="image/*" style="display: none;">
                                <div class="photo-actions-modern">
                                    <button type="button" class="btn-modern btn-sm btn-primary" onclick="document.getElementById('foto').click()">
                                        <i class="fas fa-camera"></i>
                                        Cambiar Foto
                                    </button>
                                    <button type="button" class="btn-modern btn-sm btn-outline" onclick="removePhoto()" id="removePhotoBtn">
                                        <i class="fas fa-times"></i>
                                        Quitar
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="nombre" class="form-label-modern">
                                Nombres *
                                <span class="label-hint-modern">Nombres completos</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-user"></i>
                                </div>
                                <input type="text" 
                                       id="nombre" 
                                       name="nombre" 
                                       class="form-input-modern" 
                                       placeholder="Ingrese nombres completos"
                                       required
                                       minlength="2"
                                       maxlength="100"
                                       value="<?= htmlspecialchars($conductor['nombre']) ?>"
                                       data-original="<?= htmlspecialchars($conductor['nombre']) ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="apellido" class="form-label-modern">
                                Apellidos *
                                <span class="label-hint-modern">Apellidos completos</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-user"></i>
                                </div>
                                <input type="text" 
                                       id="apellido" 
                                       name="apellido" 
                                       class="form-input-modern" 
                                       placeholder="Ingrese apellidos completos"
                                       required
                                       minlength="2"
                                       maxlength="100"
                                       value="<?= htmlspecialchars($conductor['apellido']) ?>"
                                       data-original="<?= htmlspecialchars($conductor['apellido']) ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="cedula" class="form-label-modern">
                                Cédula de Ciudadanía *
                                <span class="label-hint-modern">Sin puntos ni espacios</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <input type="text" 
                                       id="cedula" 
                                       name="cedula" 
                                       class="form-input-modern" 
                                       placeholder="1234567890"
                                       required
                                       pattern="[0-9]{8,12}"
                                       maxlength="12"
                                       value="<?= htmlspecialchars($conductor['cedula']) ?>"
                                       data-original="<?= htmlspecialchars($conductor['cedula']) ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="fecha_nacimiento" class="form-label-modern">
                                Fecha de Nacimiento *
                                <span class="label-hint-modern">Debe ser mayor de 18 años</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <input type="date" 
                                       id="fecha_nacimiento" 
                                       name="fecha_nacimiento" 
                                       class="form-input-modern" 
                                       required
                                       max="<?= date('Y-m-d', strtotime('-18 years')) ?>"
                                       value="<?= htmlspecialchars($conductor['fecha_nacimiento']) ?>"
                                       data-original="<?= htmlspecialchars($conductor['fecha_nacimiento']) ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información de Contacto -->
            <div class="form-section-modern" data-aos="fade-up" data-aos-delay="400">
                <div class="section-header-modern">
                    <div class="section-icon-modern">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="section-title-modern">
                        <h3>Información de Contacto</h3>
                        <p>Datos para comunicación y localización</p>
                    </div>
                    <div class="section-actions-modern">
                        <button type="button" class="btn-modern btn-sm btn-outline" onclick="restoreSection('contacto')">
                            <i class="fas fa-undo"></i>
                            Restaurar
                        </button>
                    </div>
                </div>
                
                <div class="section-content-modern">
                    <div class="form-grid-modern">
                        <div class="form-group-modern">
                            <label for="telefono" class="form-label-modern">
                                Teléfono Principal *
                                <span class="label-hint-modern">Número de celular</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <input type="tel" 
                                       id="telefono" 
                                       name="telefono" 
                                       class="form-input-modern" 
                                       placeholder="3001234567"
                                       required
                                       pattern="[0-9]{10}"
                                       maxlength="10"
                                       value="<?= htmlspecialchars($conductor['telefono']) ?>"
                                       data-original="<?= htmlspecialchars($conductor['telefono']) ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="telefono_emergencia" class="form-label-modern">
                                Teléfono de Emergencia
                                <span class="label-hint-modern">Contacto alternativo</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <input type="tel" 
                                       id="telefono_emergencia" 
                                       name="telefono_emergencia" 
                                       class="form-input-modern" 
                                       placeholder="3001234567"
                                       pattern="[0-9]{10}"
                                       maxlength="10"
                                       value="<?= htmlspecialchars($conductor['telefono_emergencia'] ?? '') ?>"
                                       data-original="<?= htmlspecialchars($conductor['telefono_emergencia'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="email" class="form-label-modern">
                                Correo Electrónico
                                <span class="label-hint-modern">Opcional</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-input-modern" 
                                       placeholder="conductor@ejemplo.com"
                                       value="<?= htmlspecialchars($conductor['email'] ?? '') ?>"
                                       data-original="<?= htmlspecialchars($conductor['email'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="direccion" class="form-label-modern">
                                Dirección de Residencia
                                <span class="label-hint-modern">Dirección completa</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <input type="text" 
                                       id="direccion" 
                                       name="direccion" 
                                       class="form-input-modern" 
                                       placeholder="Calle 123 # 45-67, Barrio Centro"
                                       maxlength="200"
                                       value="<?= htmlspecialchars($conductor['direccion'] ?? '') ?>"
                                       data-original="<?= htmlspecialchars($conductor['direccion'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información de Licencia -->
            <div class="form-section-modern" data-aos="fade-up" data-aos-delay="500">
                <div class="section-header-modern">
                    <div class="section-icon-modern">
                        <i class="fas fa-id-badge"></i>
                    </div>
                    <div class="section-title-modern">
                        <h3>Información de Licencia de Conducción</h3>
                        <p>Datos de la licencia de conducir vigente</p>
                    </div>
                    <div class="section-actions-modern">
                        <button type="button" class="btn-modern btn-sm btn-outline" onclick="restoreSection('licencia')">
                            <i class="fas fa-undo"></i>
                            Restaurar
                        </button>
                    </div>
                </div>
                
                <div class="section-content-modern">
                    <div class="form-grid-modern">
                        <div class="form-group-modern">
                            <label for="licencia_numero" class="form-label-modern">
                                Número de Licencia *
                                <span class="label-hint-modern">Número completo</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-id-badge"></i>
                                </div>
                                <input type="text" 
                                       id="licencia_numero" 
                                       name="licencia_numero" 
                                       class="form-input-modern" 
                                       placeholder="1234567890123"
                                       required
                                       maxlength="20"
                                       value="<?= htmlspecialchars($conductor['licencia_numero'] ?? '') ?>"
                                       data-original="<?= htmlspecialchars($conductor['licencia_numero'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="licencia_categoria" class="form-label-modern">
                                Categoría de Licencia *
                                <span class="label-hint-modern">Categoría válida para mototaxi</span>
                            </label>
                            <select id="licencia_categoria" 
                                    name="licencia_categoria" 
                                    class="form-select-modern" 
                                    required
                                    data-original="<?= htmlspecialchars($conductor['licencia_categoria'] ?? '') ?>">
                                <option value="">Seleccione una categoría</option>
                                <option value="A1" <?= ($conductor['licencia_categoria'] ?? '') === 'A1' ? 'selected' : '' ?>>A1 - Motocicletas hasta 125cc</option>
                                <option value="A2" <?= ($conductor['licencia_categoria'] ?? '') === 'A2' ? 'selected' : '' ?>>A2 - Motocicletas de cualquier cilindraje</option>
                                <option value="B1" <?= ($conductor['licencia_categoria'] ?? '') === 'B1' ? 'selected' : '' ?>>B1 - Automóviles y mototaxis</option>
                                <option value="B2" <?= ($conductor['licencia_categoria'] ?? '') === 'B2' ? 'selected' : '' ?>>B2 - Camionetas y buses</option>
                                <option value="C1" <?= ($conductor['licencia_categoria'] ?? '') === 'C1' ? 'selected' : '' ?>>C1 - Camiones y vehículos de carga</option>
                            </select>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="licencia_expedicion" class="form-label-modern">
                                Fecha de Expedición *
                                <span class="label-hint-modern">Fecha de emisión</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <input type="date" 
                                       id="licencia_expedicion" 
                                       name="licencia_expedicion" 
                                       class="form-input-modern" 
                                       required
                                       max="<?= date('Y-m-d') ?>"
                                       value="<?= htmlspecialchars($conductor['licencia_expedicion'] ?? '') ?>"
                                       data-original="<?= htmlspecialchars($conductor['licencia_expedicion'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="licencia_vigencia" class="form-label-modern">
                                Fecha de Vigencia *
                                <span class="label-hint-modern">Fecha de vencimiento</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <input type="date" 
                                       id="licencia_vigencia" 
                                       name="licencia_vigencia" 
                                       class="form-input-modern" 
                                       required
                                       value="<?= htmlspecialchars($conductor['licencia_vigencia'] ?? '') ?>"
                                       data-original="<?= htmlspecialchars($conductor['licencia_vigencia'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experiencia y Datos Adicionales -->
            <div class="form-section-modern collapsible-section" data-aos="fade-up" data-aos-delay="600">
                <div class="section-header-modern collapsible-header" onclick="toggleSection(this)">
                    <div class="section-icon-modern">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="section-title-modern">
                        <h3>Experiencia y Datos Adicionales</h3>
                        <p>Información adicional del conductor</p>
                    </div>
                    <div class="section-actions-modern">
                        <button type="button" class="btn-modern btn-sm btn-outline" onclick="restoreSection('adicional')">
                            <i class="fas fa-undo"></i>
                            Restaurar
                        </button>
                    </div>
                    <div class="collapse-indicator-modern">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                
                <div class="section-content-modern collapsible-content">
                    <div class="form-grid-modern">
                        <div class="form-group-modern">
                            <label for="experiencia_anos" class="form-label-modern">
                                Años de Experiencia *
                                <span class="label-hint-modern">Años conduciendo mototaxi</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <input type="number" 
                                       id="experiencia_anos" 
                                       name="experiencia_anos" 
                                       class="form-input-modern" 
                                       placeholder="0"
                                       required
                                       min="0"
                                       max="50"
                                       value="<?= htmlspecialchars($conductor['experiencia_anos'] ?? '0') ?>"
                                       data-original="<?= htmlspecialchars($conductor['experiencia_anos'] ?? '0') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="estado_civil" class="form-label-modern">
                                Estado Civil
                                <span class="label-hint-modern">Opcional</span>
                            </label>
                            <select id="estado_civil" 
                                    name="estado_civil" 
                                    class="form-select-modern"
                                    data-original="<?= htmlspecialchars($conductor['estado_civil'] ?? '') ?>">
                                <option value="">Seleccione estado civil</option>
                                <option value="soltero" <?= ($conductor['estado_civil'] ?? '') === 'soltero' ? 'selected' : '' ?>>Soltero(a)</option>
                                <option value="casado" <?= ($conductor['estado_civil'] ?? '') === 'casado' ? 'selected' : '' ?>>Casado(a)</option>
                                <option value="union_libre" <?= ($conductor['estado_civil'] ?? '') === 'union_libre' ? 'selected' : '' ?>>Unión Libre</option>
                                <option value="divorciado" <?= ($conductor['estado_civil'] ?? '') === 'divorciado' ? 'selected' : '' ?>>Divorciado(a)</option>
                                <option value="viudo" <?= ($conductor['estado_civil'] ?? '') === 'viudo' ? 'selected' : '' ?>>Viudo(a)</option>
                            </select>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="contacto_emergencia_nombre" class="form-label-modern">
                                Nombre Contacto de Emergencia
                                <span class="label-hint-modern">Persona a contactar</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <input type="text" 
                                       id="contacto_emergencia_nombre" 
                                       name="contacto_emergencia_nombre" 
                                       class="form-input-modern" 
                                       placeholder="Nombre del contacto"
                                       maxlength="100"
                                       value="<?= htmlspecialchars($conductor['contacto_emergencia_nombre'] ?? '') ?>"
                                       data-original="<?= htmlspecialchars($conductor['contacto_emergencia_nombre'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label for="contacto_emergencia_relacion" class="form-label-modern">
                                Relación con Contacto de Emergencia
                                <span class="label-hint-modern">Parentesco o relación</span>
                            </label>
                            <select id="contacto_emergencia_relacion" 
                                    name="contacto_emergencia_relacion" 
                                    class="form-select-modern"
                                    data-original="<?= htmlspecialchars($conductor['contacto_emergencia_relacion'] ?? '') ?>">
                                <option value="">Seleccione relación</option>
                                <option value="padre" <?= ($conductor['contacto_emergencia_relacion'] ?? '') === 'padre' ? 'selected' : '' ?>>Padre</option>
                                <option value="madre" <?= ($conductor['contacto_emergencia_relacion'] ?? '') === 'madre' ? 'selected' : '' ?>>Madre</option>
                                <option value="hijo" <?= ($conductor['contacto_emergencia_relacion'] ?? '') === 'hijo' ? 'selected' : '' ?>>Hijo(a)</option>
                                <option value="hermano" <?= ($conductor['contacto_emergencia_relacion'] ?? '') === 'hermano' ? 'selected' : '' ?>>Hermano(a)</option>
                                <option value="esposo" <?= ($conductor['contacto_emergencia_relacion'] ?? '') === 'esposo' ? 'selected' : '' ?>>Esposo(a)</option>
                                <option value="amigo" <?= ($conductor['contacto_emergencia_relacion'] ?? '') === 'amigo' ? 'selected' : '' ?>>Amigo(a)</option>
                                <option value="otro" <?= ($conductor['contacto_emergencia_relacion'] ?? '') === 'otro' ? 'selected' : '' ?>>Otro</option>
                            </select>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern span-full">
                            <label for="observaciones" class="form-label-modern">
                                Observaciones
                                <span class="label-hint-modern">Información adicional relevante</span>
                            </label>
                            <div class="textarea-group-modern">
                                <div class="textarea-icon-modern">
                                    <i class="fas fa-comment-alt"></i>
                                </div>
                                <textarea id="observaciones" 
                                          name="observaciones" 
                                          class="form-textarea-modern" 
                                          placeholder="Ingrese cualquier observación relevante sobre el conductor..."
                                          rows="4"
                                          maxlength="500"
                                          data-original="<?= htmlspecialchars($conductor['observaciones'] ?? '') ?>"><?= htmlspecialchars($conductor['observaciones'] ?? '') ?></textarea>
                                <div class="character-count-modern">
                                    <span id="observaciones-count"><?= strlen($conductor['observaciones'] ?? '') ?></span>/500
                                </div>
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estado del Conductor -->
            <div class="form-section-modern" data-aos="fade-up" data-aos-delay="700">
                <div class="section-header-modern">
                    <div class="section-icon-modern">
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <div class="section-title-modern">
                        <h3>Estado del Conductor</h3>
                        <p>Configurar estado de actividad</p>
                    </div>
                </div>
                
                <div class="section-content-modern">
                    <div class="form-grid-modern">
                        <div class="form-group-modern">
                            <label for="estado" class="form-label-modern">
                                Estado de Actividad
                                <span class="label-hint-modern">Estado actual del conductor</span>
                            </label>
                            <select id="estado" 
                                    name="estado" 
                                    class="form-select-modern"
                                    data-original="<?= htmlspecialchars($conductor['estado']) ?>">
                                <option value="activo" <?= $conductor['estado'] === 'activo' ? 'selected' : '' ?>>Activo - Puede trabajar</option>
                                <option value="inactivo" <?= $conductor['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo - No disponible</option>
                                <option value="suspendido" <?= $conductor['estado'] === 'suspendido' ? 'selected' : '' ?>>Suspendido - Temporalmente inhabilitado</option>
                            </select>
                            <div class="field-feedback-modern"></div>
                        </div>
                        
                        <div class="form-group-modern" id="motivoSuspensionGroup" style="display: <?= $conductor['estado'] === 'suspendido' ? 'block' : 'none' ?>;">
                            <label for="motivo_suspension" class="form-label-modern">
                                Motivo de Suspensión
                                <span class="label-hint-modern">Razón de la suspensión</span>
                            </label>
                            <div class="input-group-modern">
                                <div class="input-icon-modern">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <input type="text" 
                                       id="motivo_suspension" 
                                       name="motivo_suspension" 
                                       class="form-input-modern" 
                                       placeholder="Ingrese motivo de suspensión"
                                       maxlength="200"
                                       value="<?= htmlspecialchars($conductor['motivo_suspension'] ?? '') ?>">
                            </div>
                            <div class="field-feedback-modern"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions-modern" data-aos="fade-up" data-aos-delay="800">
                <div class="actions-left-modern">
                    <a href="/admin/conductores" class="btn-modern btn-outline btn-lg">
                        <span class="btn-icon"><i class="fas fa-times"></i></span>
                        <span class="btn-text">Cancelar</span>
                    </a>
                </div>
                <div class="actions-center-modern">
                    <button type="button" class="btn-modern btn-info btn-lg" onclick="previewChanges()">
                        <span class="btn-icon"><i class="fas fa-eye"></i></span>
                        <span class="btn-text">Previsualizar Cambios</span>
                    </button>
                    <button type="button" class="btn-modern btn-secondary btn-lg" onclick="resetAllChanges()">
                        <span class="btn-icon"><i class="fas fa-undo"></i></span>
                        <span class="btn-text">Deshacer Todo</span>
                    </button>
                </div>
                <div class="actions-right-modern">
                    <button type="submit" class="btn-modern btn-success btn-lg" id="submitBtn">
                        <span class="btn-icon"><i class="fas fa-save"></i></span>
                        <span class="btn-text">Guardar Cambios</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Changes Preview Modal -->
<div class="modal-modern" id="changesModal">
    <div class="modal-overlay-modern" onclick="closeChangesModal()"></div>
    <div class="modal-container-modern modal-lg">
        <div class="modal-header-modern">
            <h3>Vista Previa de Cambios</h3>
            <button class="modal-close-modern" onclick="closeChangesModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-content-modern">
            <div id="changesContent"></div>
        </div>
        <div class="modal-actions-modern">
            <button class="btn-modern btn-outline" onclick="closeChangesModal()">
                <span class="btn-icon"><i class="fas fa-edit"></i></span>
                <span class="btn-text">Continuar Editando</span>
            </button>
            <button class="btn-modern btn-success" onclick="submitFromPreview()">
                <span class="btn-icon"><i class="fas fa-save"></i></span>
                <span class="btn-text">Confirmar Cambios</span>
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

    // Form validation and change tracking
    setupFormValidation();
    setupChangeTracking();
    setupPhotoUpload();
    setupCharacterCounters();
    setupLicenseDateValidation();
    setupStateHandling();

    console.log('Conductor edit form initialized');
});

function setupFormValidation() {
    const form = document.getElementById('formEditarConductor');
    if (form) {
        form.addEventListener('submit', handleSubmit);
    }

    // Real-time validation
    const fields = document.querySelectorAll('.form-input-modern, .form-select-modern, .form-textarea-modern');
    
    fields.forEach(field => {
        field.addEventListener('blur', function() {
            validateField(this);
        });
        
        field.addEventListener('input', function() {
            clearFieldError(this);
            trackChange(this);
        });
    });
}

function setupChangeTracking() {
    const fields = document.querySelectorAll('.form-input-modern, .form-select-modern, .form-textarea-modern');
    
    fields.forEach(field => {
        field.addEventListener('input', function() {
            trackChange(this);
        });
        
        field.addEventListener('change', function() {
            trackChange(this);
        });
    });
}

function trackChange(field) {
    const original = field.getAttribute('data-original') || '';
    const current = field.value;
    
    if (current !== original) {
        field.classList.add('changed');
        field.closest('.form-group-modern').classList.add('has-changes');
    } else {
        field.classList.remove('changed');
        field.closest('.form-group-modern').classList.remove('has-changes');
    }
    
    updateChangesIndicator();
}

function updateChangesIndicator() {
    const changedFields = document.querySelectorAll('.form-input-modern.changed, .form-select-modern.changed, .form-textarea-modern.changed');
    const hasChanges = changedFields.length > 0;
    
    // Update submit button
    const submitBtn = document.getElementById('submitBtn');
    if (hasChanges) {
        submitBtn.classList.add('has-changes');
        submitBtn.querySelector('.btn-text').textContent = `Guardar Cambios (${changedFields.length})`;
    } else {
        submitBtn.classList.remove('has-changes');
        submitBtn.querySelector('.btn-text').textContent = 'Sin Cambios';
    }
}

function restoreSection(section) {
    let fields = [];
    
    switch (section) {
        case 'personal':
            fields = ['nombre', 'apellido', 'cedula', 'fecha_nacimiento'];
            break;
        case 'contacto':
            fields = ['telefono', 'telefono_emergencia', 'email', 'direccion'];
            break;
        case 'licencia':
            fields = ['licencia_numero', 'licencia_categoria', 'licencia_expedicion', 'licencia_vigencia'];
            break;
        case 'adicional':
            fields = ['experiencia_anos', 'estado_civil', 'contacto_emergencia_nombre', 'contacto_emergencia_relacion', 'observaciones'];
            break;
    }
    
    fields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field) {
            const original = field.getAttribute('data-original') || '';
            field.value = original;
            field.classList.remove('changed');
            field.closest('.form-group-modern').classList.remove('has-changes');
            clearFieldError(field);
        }
    });
    
    updateChangesIndicator();
}

function resetAllChanges() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Deshacer todos los cambios?',
            text: 'Se perderán todas las modificaciones realizadas',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Deshacer Todo',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#f59e0b'
        }).then((result) => {
            if (result.isConfirmed) {
                performResetAllChanges();
            }
        });
    } else {
        if (confirm('¿Está seguro de deshacer todos los cambios?')) {
            performResetAllChanges();
        }
    }
}

function performResetAllChanges() {
    const fields = document.querySelectorAll('.form-input-modern, .form-select-modern, .form-textarea-modern');
    
    fields.forEach(field => {
        const original = field.getAttribute('data-original') || '';
        field.value = original;
        field.classList.remove('changed');
        field.closest('.form-group-modern').classList.remove('has-changes');
        clearFieldError(field);
    });
    
    // Reset photo
    const photoPreview = document.getElementById('photoPreview');
    const originalPhoto = '<?= !empty($conductor["foto"]) ? htmlspecialchars($conductor["foto"]) : "/assets/images/default-avatar.png" ?>';
    photoPreview.src = originalPhoto;
    
    updateChangesIndicator();
    
    if (typeof Swal !== 'undefined') {
        Swal.fire('Cambios Deshecho', 'Se han restaurado todos los valores originales', 'info');
    }
}

function validateField(field) {
    const feedback = field.closest('.form-group-modern').querySelector('.field-feedback-modern');
    let isValid = true;
    let message = '';

    // Clear previous validation
    clearFieldError(field);

    // Required field validation
    if (field.hasAttribute('required') && !field.value.trim()) {
        isValid = false;
        message = 'Este campo es obligatorio';
    }
    
    // Specific field validations (same as create form)
    switch (field.name) {
        case 'cedula':
            if (field.value && !/^[0-9]{8,12}$/.test(field.value)) {
                isValid = false;
                message = 'La cédula debe tener entre 8 y 12 dígitos numéricos';
            }
            break;
            
        case 'telefono':
        case 'telefono_emergencia':
            if (field.value && !/^[0-9]{10}$/.test(field.value)) {
                isValid = false;
                message = 'El teléfono debe tener 10 dígitos';
            }
            break;
            
        case 'email':
            if (field.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) {
                isValid = false;
                message = 'Ingrese un correo electrónico válido';
            }
            break;
    }

    if (!isValid) {
        showFieldError(field, message);
    }

    return isValid;
}

function showFieldError(field, message) {
    field.classList.add('error');
    const feedback = field.closest('.form-group-modern').querySelector('.field-feedback-modern');
    if (feedback) {
        feedback.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
        feedback.style.display = 'block';
    }
}

function clearFieldError(field) {
    field.classList.remove('error');
    const feedback = field.closest('.form-group-modern').querySelector('.field-feedback-modern');
    if (feedback) {
        feedback.style.display = 'none';
    }
}

function setupPhotoUpload() {
    const photoInput = document.getElementById('foto');
    const photoPreview = document.getElementById('photoPreview');

    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        photoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    showAlert('Por favor seleccione un archivo de imagen válido', 'error');
                }
            }
        });
    }
}

function removePhoto() {
    document.getElementById('foto').value = '';
    document.getElementById('photoPreview').src = '/assets/images/default-avatar.png';
}

function setupCharacterCounters() {
    const textareas = document.querySelectorAll('textarea[maxlength]');
    
    textareas.forEach(textarea => {
        const countElement = document.getElementById(textarea.name + '-count');
        if (countElement) {
            textarea.addEventListener('input', function() {
                countElement.textContent = this.value.length;
            });
        }
    });
}

function setupLicenseDateValidation() {
    const expedicionInput = document.getElementById('licencia_expedicion');
    const vigenciaInput = document.getElementById('licencia_vigencia');
    
    if (expedicionInput && vigenciaInput) {
        expedicionInput.addEventListener('change', function() {
            if (this.value) {
                const expedicion = new Date(this.value);
                const minVigencia = new Date(expedicion);
                minVigencia.setFullYear(expedicion.getFullYear() + 1);
                
                vigenciaInput.min = minVigencia.toISOString().split('T')[0];
            }
        });
    }
}

function setupStateHandling() {
    const estadoSelect = document.getElementById('estado');
    const motivoGroup = document.getElementById('motivoSuspensionGroup');
    
    estadoSelect.addEventListener('change', function() {
        if (this.value === 'suspendido') {
            motivoGroup.style.display = 'block';
            document.getElementById('motivo_suspension').setAttribute('required', 'true');
        } else {
            motivoGroup.style.display = 'none';
            document.getElementById('motivo_suspension').removeAttribute('required');
            document.getElementById('motivo_suspension').value = '';
        }
    });
}

function toggleSection(header) {
    const section = header.closest('.collapsible-section');
    const content = section.querySelector('.collapsible-content');
    const indicator = header.querySelector('.collapse-indicator-modern i');
    
    section.classList.toggle('collapsed');
    
    if (section.classList.contains('collapsed')) {
        content.style.maxHeight = '0';
        indicator.style.transform = 'rotate(-90deg)';
    } else {
        content.style.maxHeight = content.scrollHeight + 'px';
        indicator.style.transform = 'rotate(0deg)';
    }
}

function previewChanges() {
    const changedFields = document.querySelectorAll('.form-input-modern.changed, .form-select-modern.changed, .form-textarea-modern.changed');
    
    if (changedFields.length === 0) {
        if (typeof Swal !== 'undefined') {
            Swal.fire('Sin Cambios', 'No se han realizado modificaciones', 'info');
        } else {
            alert('No se han realizado modificaciones');
        }
        return;
    }
    
    let changesHTML = '<div class="changes-preview">';
    
    changedFields.forEach(field => {
        const label = field.closest('.form-group-modern').querySelector('.form-label-modern').textContent.replace('*', '').trim();
        const original = field.getAttribute('data-original') || '';
        const current = field.value;
        
        changesHTML += `
            <div class="change-item">
                <div class="change-field">${label}</div>
                <div class="change-values">
                    <div class="change-original">
                        <span class="change-label">Anterior:</span>
                        <span class="change-value">${original || 'Sin valor'}</span>
                    </div>
                    <div class="change-arrow">→</div>
                    <div class="change-new">
                        <span class="change-label">Nuevo:</span>
                        <span class="change-value">${current || 'Sin valor'}</span>
                    </div>
                </div>
            </div>
        `;
    });
    
    changesHTML += '</div>';
    
    document.getElementById('changesContent').innerHTML = changesHTML;
    document.getElementById('changesModal').classList.add('active');
}

function closeChangesModal() {
    document.getElementById('changesModal').classList.remove('active');
}

function submitFromPreview() {
    closeChangesModal();
    document.getElementById('formEditarConductor').dispatchEvent(new Event('submit'));
}

function handleSubmit(e) {
    e.preventDefault();
    
    // Validate all fields
    let isValid = true;
    const fields = document.querySelectorAll('.form-input-modern, .form-select-modern, .form-textarea-modern');
    
    fields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    if (!isValid) {
        showAlert('Por favor corrija los errores en el formulario', 'error');
        return false;
    }

    // Check if there are changes
    const changedFields = document.querySelectorAll('.form-input-modern.changed, .form-select-modern.changed, .form-textarea-modern.changed');
    if (changedFields.length === 0) {
        showAlert('No se han realizado cambios para guardar', 'info');
        return false;
    }

    // Submit form
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.querySelector('.btn-text').textContent;
    
    submitBtn.disabled = true;
    submitBtn.querySelector('.btn-text').textContent = 'Guardando...';
    submitBtn.querySelector('.btn-icon i').className = 'fas fa-spinner fa-spin';
    
    // Simulate form submission (replace with actual submission)
    setTimeout(() => {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¡Conductor Actualizado!',
                text: 'Los cambios han sido guardados exitosamente',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = '/admin/conductores/perfil/<?= $conductor["id"] ?>';
            });
        } else {
            alert('Conductor actualizado exitosamente');
            window.location.href = '/admin/conductores/perfil/<?= $conductor["id"] ?>';
        }
    }, 2000);
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
/* Estilos específicos para editar conductor */
.summary-card {
    margin-bottom: 2rem;
}

.conductor-summary-modern {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 1.5rem;
}

.conductor-photo-modern {
    position: relative;
    flex-shrink: 0;
}

.conductor-avatar-modern {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--border-color);
}

.conductor-avatar-placeholder-modern {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: white;
    font-size: 1.8rem;
    border: 3px solid var(--border-color);
}

.conductor-status-badge {
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
    border: 2px solid var(--card-bg);
}

.conductor-status-badge.activo {
    background: var(--success-color);
}

.conductor-status-badge.inactivo {
    background: var(--error-color);
}

.conductor-status-badge.suspendido {
    background: var(--warning-color);
}

.conductor-info-summary-modern {
    flex: 1;
}

.conductor-name-modern {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.conductor-details-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 0.75rem;
}

.detail-item-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.detail-item-modern i {
    color: var(--primary-green);
    width: 16px;
}

.conductor-stats-modern {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    text-align: center;
}

.stat-item-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-green);
}

.stat-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
    font-weight: 600;
}

.section-actions-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Change tracking */
.form-input-modern.changed,
.form-select-modern.changed,
.form-textarea-modern.changed {
    border-color: var(--warning-color);
    background-color: rgba(245, 158, 11, 0.05);
    position: relative;
}

.form-group-modern.has-changes::before {
    content: '•';
    position: absolute;
    top: 0.5rem;
    left: -1rem;
    color: var(--warning-color);
    font-size: 1.5rem;
    font-weight: bold;
}

.btn-modern.has-changes {
    background: var(--warning-color);
    border-color: var(--warning-color);
    color: white;
}

/* Changes preview modal */
.changes-preview {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.change-item {
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 1rem;
}

.change-field {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.change-values {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 1rem;
    align-items: center;
}

.change-original,
.change-new {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.change-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    font-weight: 600;
    text-transform: uppercase;
}

.change-value {
    padding: 0.5rem;
    border-radius: 4px;
    font-size: 0.9rem;
}

.change-original .change-value {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error-color);
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.change-new .change-value {
    background: rgba(34, 197, 94, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.change-arrow {
    font-size: 1.2rem;
    color: var(--primary-green);
    font-weight: bold;
    text-align: center;
}

/* Responsive design */
@media (max-width: 1024px) {
    .conductor-summary-modern {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .conductor-stats-modern {
        flex-direction: row;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .conductor-details-modern {
        grid-template-columns: 1fr;
    }
    
    .section-header-modern {
        flex-direction: column;
        gap: 1rem;
    }
    
    .section-actions-modern {
        align-self: stretch;
    }
    
    .change-values {
        grid-template-columns: 1fr;
        gap: 0.5rem;
        text-align: center;
    }
    
    .change-arrow {
        transform: rotate(90deg);
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>