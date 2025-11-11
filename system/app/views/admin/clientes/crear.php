<?php
/**
 * Vista Crear Cliente - Sistema PRIMERO DE JUNIO
 */

$title = 'Nuevo Cliente';
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
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Registrar Nuevo Cliente</span>
                        <span class="title-subtitle">Agregar cliente al sistema de transporte</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
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

    <form class="form-modern" id="formCliente" method="POST" action="/admin/clientes/crear" enctype="multipart/form-data" data-aos="fade-up" data-aos-delay="200">
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
                    </div>
                    
                    <div class="card-content-modern">
                        <!-- Photo Upload -->
                        <div class="form-group-modern full-width">
                            <div class="avatar-upload-modern">
                                <div class="avatar-preview-modern">
                                    <img id="avatarPreview" src="/assets/images/default-avatar.png" alt="Avatar">
                                </div>
                                <div class="upload-button-modern">
                                    <input type="file" id="foto" name="foto" accept="image/*" style="display: none;">
                                    <button type="button" class="btn-modern btn-outline" onclick="document.getElementById('foto').click()">
                                        <span class="btn-icon"><i class="fas fa-camera"></i></span>
                                        <span class="btn-text">Subir Foto</span>
                                    </button>
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
                                           value="<?= htmlspecialchars($old['nombre'] ?? '') ?>"
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
                                           value="<?= htmlspecialchars($old['apellido'] ?? '') ?>"
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
                                           value="<?= htmlspecialchars($old['documento'] ?? '') ?>"
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
                                           value="<?= htmlspecialchars($old['fecha_nacimiento'] ?? '') ?>">
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
                                               <?= ($old['tipo_cliente'] ?? 'particular') === 'particular' ? 'checked' : '' ?>>
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
                                               <?= ($old['tipo_cliente'] ?? '') === 'corporativo' ? 'checked' : '' ?>>
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
                                               <?= ($old['tipo_cliente'] ?? '') === 'frecuente' ? 'checked' : '' ?>>
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
                            <div class="form-group-modern full-width" id="campos-corporativo" style="display: none;">
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
                                                   value="<?= htmlspecialchars($old['empresa'] ?? '') ?>"
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
                                                   value="<?= htmlspecialchars($old['ruc'] ?? '') ?>"
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
                                           value="<?= htmlspecialchars($old['telefono'] ?? '') ?>"
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
                                           value="<?= htmlspecialchars($old['telefono_secundario'] ?? '') ?>"
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
                                           value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                                           placeholder="cliente@ejemplo.com">
                                </div>
                                <div class="form-error-modern" id="error-email"></div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label class="form-label-modern">Género</label>
                                <select class="form-select-modern" name="genero" id="genero">
                                    <option value="">Seleccionar</option>
                                    <option value="masculino" <?= ($old['genero'] ?? '') === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="femenino" <?= ($old['genero'] ?? '') === 'femenino' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="otro" <?= ($old['genero'] ?? '') === 'otro' ? 'selected' : '' ?>>Otro</option>
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
                                          placeholder="Calle, número, zona, ciudad..."><?= htmlspecialchars($old['direccion'] ?? '') ?></textarea>
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
                                          placeholder="Cerca de..., frente a..., al lado de..."><?= htmlspecialchars($old['referencias'] ?? '') ?></textarea>
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
                            <span>Configuraciones Adicionales</span>
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
                                                   <?= ($old['tiene_descuento'] ?? false) ? 'checked' : '' ?>>
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
                                
                                <div class="form-group-modern" id="grupo-descuento" style="display: none;">
                                    <label class="form-label-modern">Porcentaje de Descuento</label>
                                    <div class="input-group-modern">
                                        <div class="input-icon-modern">
                                            <i class="fas fa-percentage"></i>
                                        </div>
                                        <input type="number" 
                                               class="form-input-modern" 
                                               name="descuento_porcentaje" 
                                               id="descuento_porcentaje"
                                               value="<?= htmlspecialchars($old['descuento_porcentaje'] ?? '') ?>"
                                               min="0"
                                               max="50"
                                               placeholder="0">
                                    </div>
                                    <div class="form-help-modern">Máximo 50%</div>
                                </div>
                            </div>
                            
                            <div class="form-group-modern full-width" id="grupo-motivo-descuento" style="display: none;">
                                <label class="form-label-modern">Motivo del Descuento</label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <input type="text" 
                                           class="form-input-modern" 
                                           name="motivo_descuento" 
                                           id="motivo_descuento"
                                           value="<?= htmlspecialchars($old['motivo_descuento'] ?? '') ?>"
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
                                           <?= ($old['notificaciones_sms'] ?? true) ? 'checked' : '' ?>>
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
                                           <?= ($old['notificaciones_email'] ?? false) ? 'checked' : '' ?>>
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
                                    <label class="form-label-modern">Estado Inicial</label>
                                    <select class="form-select-modern" name="estado" id="estado">
                                        <option value="activo" <?= ($old['estado'] ?? 'activo') === 'activo' ? 'selected' : '' ?>>Activo</option>
                                        <option value="inactivo" <?= ($old['estado'] ?? '') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                                    </select>
                                </div>
                                
                                <div class="form-group-modern">
                                    <label class="form-label-modern">Prioridad</label>
                                    <select class="form-select-modern" name="prioridad" id="prioridad">
                                        <option value="normal" <?= ($old['prioridad'] ?? 'normal') === 'normal' ? 'selected' : '' ?>>Normal</option>
                                        <option value="alta" <?= ($old['prioridad'] ?? '') === 'alta' ? 'selected' : '' ?>>Alta</option>
                                        <option value="vip" <?= ($old['prioridad'] ?? '') === 'vip' ? 'selected' : '' ?>>VIP</option>
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
                                              placeholder="Notas adicionales sobre el cliente..."><?= htmlspecialchars($old['observaciones'] ?? '') ?></textarea>
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
                                <span class="btn-text">Registrar Cliente</span>
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

<!-- Preview Modal -->
<div class="modal-modern" id="previewModal">
    <div class="modal-overlay-modern" onclick="closePreview()"></div>
    <div class="modal-container-modern large">
        <div class="modal-header-modern">
            <h2>Confirmación de Datos</h2>
            <button class="modal-close-modern" onclick="closePreview()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body-modern" id="previewContent">
            <!-- El contenido se generará dinámicamente -->
        </div>
        <div class="modal-footer-modern">
            <button class="btn-modern btn-outline" onclick="closePreview()">Corregir</button>
            <button class="btn-modern btn-success" onclick="confirmSubmit()">Confirmar Registro</button>
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
    const form = document.getElementById('formCliente');
    const steps = document.querySelectorAll('.form-step-modern');
    const progressSteps = document.querySelectorAll('.progress-step-modern');
    const nextButtons = document.querySelectorAll('.btn-next');
    const backButtons = document.querySelectorAll('.btn-back');
    const submitBtn = document.getElementById('submitBtn');

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

    // Submit con preview
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            showPreview();
        }
    });

    console.log('Cliente crear form initialized');
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

function showPreview() {
    const formData = new FormData(document.getElementById('formCliente'));
    let previewContent = '<div class="preview-section-modern">';
    
    // Información personal
    previewContent += `
        <h3><i class="fas fa-user"></i> Información Personal</h3>
        <div class="preview-grid-modern">
            <div><strong>Nombre:</strong> ${formData.get('nombre')} ${formData.get('apellido')}</div>
            <div><strong>Tipo:</strong> ${getTypeLabel(formData.get('tipo_cliente'))}</div>
            <div><strong>Documento:</strong> ${formData.get('documento') || 'No especificado'}</div>
            <div><strong>Fecha Nacimiento:</strong> ${formData.get('fecha_nacimiento') || 'No especificado'}</div>
        </div>
    `;
    
    // Contacto
    previewContent += `
        <h3><i class="fas fa-phone"></i> Información de Contacto</h3>
        <div class="preview-grid-modern">
            <div><strong>Teléfono:</strong> ${formData.get('telefono')}</div>
            <div><strong>Email:</strong> ${formData.get('email') || 'No especificado'}</div>
            <div><strong>Dirección:</strong> ${formData.get('direccion') || 'No especificado'}</div>
        </div>
    `;
    
    // Configuraciones
    previewContent += `
        <h3><i class="fas fa-cog"></i> Configuraciones</h3>
        <div class="preview-grid-modern">
            <div><strong>Estado:</strong> ${formData.get('estado')}</div>
            <div><strong>Descuento:</strong> ${formData.get('tiene_descuento') ? formData.get('descuento_porcentaje') + '%' : 'Sin descuento'}</div>
            <div><strong>Prioridad:</strong> ${formData.get('prioridad')}</div>
        </div>
    `;
    
    previewContent += '</div>';
    
    document.getElementById('previewContent').innerHTML = previewContent;
    document.getElementById('previewModal').classList.add('active');
}

function getTypeLabel(type) {
    switch (type) {
        case 'particular': return 'Particular';
        case 'corporativo': return 'Corporativo';
        case 'frecuente': return 'Frecuente';
        default: return 'Particular';
    }
}

function closePreview() {
    document.getElementById('previewModal').classList.remove('active');
}

function confirmSubmit() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.classList.add('loading');
    
    // Simular envío (reemplazar con envío real)
    setTimeout(() => {
        document.getElementById('formCliente').submit();
    }, 1000);
}
</script>

<style>
/* Estilos específicos para el formulario de crear cliente */
.progress-indicator-modern {
    margin-bottom: 2rem;
}

.progress-steps-modern {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 600px;
    margin: 0 auto;
}

.progress-step-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
}

.progress-step-modern.active {
    color: var(--primary-green);
}

.progress-step-modern.completed {
    color: var(--success-color);
}

.step-number-modern {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--card-hover-bg);
    border: 2px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    transition: all 0.3s ease;
}

.progress-step-modern.active .step-number-modern {
    background: var(--primary-green);
    border-color: var(--primary-green);
    color: white;
}

.progress-step-modern.completed .step-number-modern {
    background: var(--success-color);
    border-color: var(--success-color);
    color: white;
}

.step-label-modern {
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    white-space: nowrap;
}

.progress-line-modern {
    flex: 1;
    height: 2px;
    background: var(--border-color);
    margin: 0 1rem;
    position: relative;
}

.form-step-modern {
    display: none;
}

.form-step-modern.active {
    display: block;
}

.form-step-actions-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.avatar-upload-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.avatar-preview-modern {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid var(--border-color);
    background: var(--card-hover-bg);
}

.avatar-preview-modern img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.radio-group-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.radio-modern {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--card-hover-bg);
}

.radio-modern:hover {
    border-color: var(--primary-green);
}

.radio-modern input[type="radio"] {
    display: none;
}

.radio-modern input[type="radio"]:checked + .radio-check-modern + .radio-content-modern {
    color: var(--primary-green);
}

.radio-modern input[type="radio"]:checked ~ * {
    border-color: var(--primary-green);
}

.radio-check-modern {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-color);
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.radio-modern input[type="radio"]:checked + .radio-check-modern {
    border-color: var(--primary-green);
    background: var(--primary-green);
}

.radio-modern input[type="radio"]:checked + .radio-check-modern::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 6px;
    height: 6px;
    background: white;
    border-radius: 50%;
}

.radio-content-modern {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.radio-content-modern i {
    font-size: 1.2rem;
    margin-bottom: 0.25rem;
}

.checkbox-group-modern {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.checkbox-modern {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--card-hover-bg);
}

.checkbox-modern:hover {
    border-color: var(--primary-green);
}

.checkbox-modern input[type="checkbox"] {
    display: none;
}

.checkbox-check-modern {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-color);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.checkbox-modern input[type="checkbox"]:checked + .checkbox-check-modern {
    background: var(--primary-green);
    border-color: var(--primary-green);
    color: white;
}

.checkbox-content-modern {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.checkbox-title {
    font-weight: 600;
    color: var(--text-primary);
}

.checkbox-description {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.form-section-modern {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--border-color);
}

.form-section-modern:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.section-title-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
}

.section-title-modern i {
    color: var(--primary-green);
}

.preview-section-modern h3 {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 1.5rem 0 1rem 0;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border-color);
}

.preview-section-modern h3:first-child {
    margin-top: 0;
}

.preview-grid-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.preview-grid-modern div {
    padding: 0.5rem;
    background: var(--card-hover-bg);
    border-radius: 4px;
    font-size: 0.9rem;
}

/* Responsive design */
@media (max-width: 768px) {
    .progress-steps-modern {
        flex-direction: column;
        gap: 1rem;
    }
    
    .progress-line-modern {
        height: 20px;
        width: 2px;
        margin: 0;
    }
    
    .step-label-modern {
        white-space: normal;
        max-width: 120px;
    }
    
    .form-step-actions-modern {
        flex-direction: column;
        gap: 1rem;
    }
    
    .radio-group-modern {
        grid-template-columns: 1fr;
    }
    
    .avatar-upload-modern {
        margin-bottom: 1.5rem;
    }
    
    .avatar-preview-modern {
        width: 100px;
        height: 100px;
    }
}

@media (max-width: 480px) {
    .preview-grid-modern {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>