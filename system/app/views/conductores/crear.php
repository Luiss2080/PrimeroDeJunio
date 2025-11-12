<?php

/**
 * Vista Crear Conductor - Sistema PRIMERO DE JUNIO
 */

$title = 'Crear Nuevo Conductor';
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
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Crear Nuevo Conductor</span>
                        <span class="title-subtitle">Registrar conductor de mototaxi</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/conductores" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver a Lista</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-modern">
    <div class="create-form-container-modern">
        <form class="form-modern" method="POST" action="/admin/conductores/crear" enctype="multipart/form-data" id="createConductorForm">
            <!-- Información Personal -->
            <div class="system-card-modern form-section" data-aos="fade-up" data-aos-delay="100">
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
                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label for="nombre" class="form-label-modern required">
                                    Nombres
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <input type="text"
                                        id="nombre"
                                        name="nombre"
                                        class="form-input-modern"
                                        placeholder="Nombres del conductor"
                                        required
                                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                                        value="<?= htmlspecialchars($old['nombre'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="nombreFeedback"></div>
                            </div>

                            <div class="form-group-modern">
                                <label for="apellido" class="form-label-modern required">
                                    Apellidos
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <input type="text"
                                        id="apellido"
                                        name="apellido"
                                        class="form-input-modern"
                                        placeholder="Apellidos del conductor"
                                        required
                                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                                        value="<?= htmlspecialchars($old['apellido'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="apellidoFeedback"></div>
                            </div>

                            <div class="form-group-modern">
                                <label for="cedula" class="form-label-modern required">
                                    Número de Cédula
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <input type="text"
                                        id="cedula"
                                        name="cedula"
                                        class="form-input-modern"
                                        placeholder="0123456789"
                                        required
                                        pattern="[0-9]{10}"
                                        maxlength="10"
                                        value="<?= htmlspecialchars($old['cedula'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="cedulaFeedback">
                                    <div class="feedback-help">Ingrese 10 dígitos sin guiones ni espacios</div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label for="telefono" class="form-label-modern required">
                                    Teléfono
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <input type="tel"
                                        id="telefono"
                                        name="telefono"
                                        class="form-input-modern"
                                        placeholder="0987654321"
                                        required
                                        pattern="[0-9]{10}"
                                        maxlength="10"
                                        value="<?= htmlspecialchars($old['telefono'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="telefonoFeedback">
                                    <div class="feedback-help">Número de 10 dígitos</div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label for="fecha_nacimiento" class="form-label-modern required">
                                    Fecha de Nacimiento
                                    <span class="label-required">*</span>
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
                                        value="<?= htmlspecialchars($old['fecha_nacimiento'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="fechaNacimientoFeedback">
                                    <div class="feedback-help">Debe ser mayor de 18 años</div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label for="genero" class="form-label-modern required">
                                    Género
                                    <span class="label-required">*</span>
                                </label>
                                <select id="genero" name="genero" class="form-select-modern" required>
                                    <option value="">Seleccionar género</option>
                                    <option value="masculino" <?= ($old['genero'] ?? '') === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="femenino" <?= ($old['genero'] ?? '') === 'femenino' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="otro" <?= ($old['genero'] ?? '') === 'otro' ? 'selected' : '' ?>>Otro</option>
                                </select>
                                <div class="form-feedback-modern" id="generoFeedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Información de Licencia -->
            <div class="system-card-modern form-section" data-aos="fade-up" data-aos-delay="200">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-id-badge"></i>
                            </div>
                            <span>Información de Licencia de Conducir</span>
                        </div>
                    </div>

                    <div class="card-content-modern">
                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label for="licencia_numero" class="form-label-modern required">
                                    Número de Licencia
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-id-badge"></i>
                                    </div>
                                    <input type="text"
                                        id="licencia_numero"
                                        name="licencia_numero"
                                        class="form-input-modern"
                                        placeholder="EC123456789"
                                        required
                                        value="<?= htmlspecialchars($old['licencia_numero'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="licenciaNumeroFeedback"></div>
                            </div>

                            <div class="form-group-modern">
                                <label for="licencia_categoria" class="form-label-modern required">
                                    Categoría de Licencia
                                    <span class="label-required">*</span>
                                </label>
                                <select id="licencia_categoria" name="licencia_categoria" class="form-select-modern" required>
                                    <option value="">Seleccionar categoría</option>
                                    <option value="A1" <?= ($old['licencia_categoria'] ?? '') === 'A1' ? 'selected' : '' ?>>A1 - Motocicletas hasta 125cc</option>
                                    <option value="A2" <?= ($old['licencia_categoria'] ?? '') === 'A2' ? 'selected' : '' ?>>A2 - Motocicletas hasta 400cc</option>
                                    <option value="B1" <?= ($old['licencia_categoria'] ?? '') === 'B1' ? 'selected' : '' ?>>B1 - Vehículos livianos</option>
                                    <option value="B2" <?= ($old['licencia_categoria'] ?? '') === 'B2' ? 'selected' : '' ?>>B2 - Vehículos livianos profesional</option>
                                    <option value="C1" <?= ($old['licencia_categoria'] ?? '') === 'C1' ? 'selected' : '' ?>>C1 - Vehículos pesados</option>
                                </select>
                                <div class="form-feedback-modern" id="licenciaCategoriaFeedback">
                                    <div class="feedback-help">Se recomienda A1 o A2 para mototaxis</div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label for="licencia_expedicion" class="form-label-modern required">
                                    Fecha de Expedición
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <input type="date"
                                        id="licencia_expedicion"
                                        name="licencia_expedicion"
                                        class="form-input-modern"
                                        required
                                        max="<?= date('Y-m-d') ?>"
                                        value="<?= htmlspecialchars($old['licencia_expedicion'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="licenciaExpedicionFeedback"></div>
                            </div>

                            <div class="form-group-modern">
                                <label for="licencia_vigencia" class="form-label-modern required">
                                    Fecha de Vigencia
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                    <input type="date"
                                        id="licencia_vigencia"
                                        name="licencia_vigencia"
                                        class="form-input-modern"
                                        required
                                        min="<?= date('Y-m-d', strtotime('+1 month')) ?>"
                                        value="<?= htmlspecialchars($old['licencia_vigencia'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="licenciaVigenciaFeedback">
                                    <div class="feedback-help">Debe tener al menos 1 mes de vigencia</div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label for="experiencia_anos" class="form-label-modern required">
                                    Años de Experiencia Conduciendo
                                    <span class="label-required">*</span>
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-road"></i>
                                    </div>
                                    <input type="number"
                                        id="experiencia_anos"
                                        name="experiencia_anos"
                                        class="form-input-modern"
                                        placeholder="2"
                                        required
                                        min="0"
                                        max="50"
                                        value="<?= htmlspecialchars($old['experiencia_anos'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="experienciaFeedback">
                                    <div class="feedback-help">
                                        <span class="experience-indicator" id="experienceLevel"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Información de Contacto -->
            <div class="system-card-modern form-section collapsible" data-aos="fade-up" data-aos-delay="300">
                <div class="system-card-background">
                    <div class="card-header-modern collapsible-header" onclick="toggleSection(this)">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <span>Información de Contacto</span>
                        </div>
                        <div class="collapse-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <div class="card-content-modern collapsible-content">
                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label for="email" class="form-label-modern">
                                    Correo Electrónico
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
                                        value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="emailFeedback"></div>
                            </div>

                            <div class="form-group-modern">
                                <label for="telefono_emergencia" class="form-label-modern">
                                    Teléfono de Emergencia
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <input type="tel"
                                        id="telefono_emergencia"
                                        name="telefono_emergencia"
                                        class="form-input-modern"
                                        placeholder="0987654321"
                                        pattern="[0-9]{10}"
                                        maxlength="10"
                                        value="<?= htmlspecialchars($old['telefono_emergencia'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern" id="telefonoEmergenciaFeedback"></div>
                            </div>

                            <div class="form-group-modern full-width">
                                <label for="direccion" class="form-label-modern">
                                    Dirección de Domicilio
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <textarea id="direccion"
                                        name="direccion"
                                        class="form-textarea-modern"
                                        placeholder="Dirección completa de domicilio"
                                        rows="3"><?= htmlspecialchars($old['direccion'] ?? '') ?></textarea>
                                </div>
                                <div class="form-feedback-modern" id="direccionFeedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Configuración de Cuenta -->
            <div class="system-card-modern form-section collapsible" data-aos="fade-up" data-aos-delay="400">
                <div class="system-card-background">
                    <div class="card-header-modern collapsible-header" onclick="toggleSection(this)">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-user-cog"></i>
                            </div>
                            <span>Configuración de Cuenta de Usuario</span>
                        </div>
                        <div class="collapse-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <div class="card-content-modern collapsible-content">
                        <div class="info-callout-modern">
                            <i class="fas fa-info-circle"></i>
                            <p>Se creará automáticamente una cuenta de usuario para el conductor con rol "Conductor"</p>
                        </div>

                        <div class="form-grid-modern">
                            <div class="form-group-modern">
                                <label for="username" class="form-label-modern">
                                    Nombre de Usuario
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <input type="text"
                                        id="username"
                                        name="username"
                                        class="form-input-modern"
                                        placeholder="Se generará automáticamente"
                                        readonly
                                        value="<?= htmlspecialchars($old['username'] ?? '') ?>">
                                </div>
                                <div class="form-feedback-modern">
                                    <div class="feedback-help">Se generará basado en la cédula</div>
                                </div>
                            </div>

                            <div class="form-group-modern">
                                <label for="password" class="form-label-modern">
                                    Contraseña Temporal
                                </label>
                                <div class="input-group-modern">
                                    <div class="input-icon-modern">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <input type="password"
                                        id="password"
                                        name="password"
                                        class="form-input-modern"
                                        placeholder="Se generará automáticamente"
                                        readonly>
                                    <button type="button"
                                        class="btn-modern btn-sm btn-outline"
                                        onclick="generatePassword()"
                                        style="margin-left: 0.5rem;">
                                        <i class="fas fa-random"></i>
                                        Generar
                                    </button>
                                </div>
                                <div class="form-feedback-modern">
                                    <div class="feedback-help">El conductor deberá cambiarla en su primer ingreso</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Foto de Perfil -->
            <div class="system-card-modern form-section collapsible" data-aos="fade-up" data-aos-delay="500">
                <div class="system-card-background">
                    <div class="card-header-modern collapsible-header" onclick="toggleSection(this)">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <span>Foto de Perfil (Opcional)</span>
                        </div>
                        <div class="collapse-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                    <div class="card-content-modern collapsible-content">
                        <div class="photo-upload-modern">
                            <div class="photo-preview-modern" id="photoPreview">
                                <div class="photo-placeholder-modern">
                                    <i class="fas fa-user"></i>
                                    <span>Sin foto</span>
                                </div>
                            </div>

                            <div class="photo-upload-controls">
                                <input type="file"
                                    id="foto"
                                    name="foto"
                                    class="file-input-modern"
                                    accept="image/jpeg,image/png,image/jpg"
                                    onchange="previewPhoto(event)">
                                <label for="foto" class="btn-modern btn-outline">
                                    <span class="btn-icon"><i class="fas fa-upload"></i></span>
                                    <span class="btn-text">Subir Foto</span>
                                </label>
                                <button type="button"
                                    class="btn-modern btn-sm btn-outline"
                                    onclick="removePhoto()"
                                    id="removePhotoBtn"
                                    style="display: none;">
                                    <span class="btn-icon"><i class="fas fa-trash"></i></span>
                                    <span class="btn-text">Remover</span>
                                </button>
                            </div>

                            <div class="photo-requirements">
                                <p><i class="fas fa-info-circle"></i> Formatos permitidos: JPG, JPEG, PNG</p>
                                <p><i class="fas fa-weight-hanging"></i> Tamaño máximo: 2MB</p>
                                <p><i class="fas fa-expand-arrows-alt"></i> Dimensiones recomendadas: 400x400px</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions-modern" data-aos="fade-up" data-aos-delay="600">
                <div class="actions-container-modern">
                    <a href="/admin/conductores" class="btn-modern btn-outline btn-lg">
                        <span class="btn-icon"><i class="fas fa-times"></i></span>
                        <span class="btn-text">Cancelar</span>
                    </a>

                    <button type="button"
                        class="btn-modern btn-secondary btn-lg"
                        onclick="resetForm()">
                        <span class="btn-icon"><i class="fas fa-undo"></i></span>
                        <span class="btn-text">Limpiar</span>
                    </button>

                    <button type="submit"
                        class="btn-modern btn-primary btn-lg"
                        id="submitBtn">
                        <span class="btn-icon"><i class="fas fa-save"></i></span>
                        <span class="btn-text">Crear Conductor</span>
                        <span class="btn-loading">
                            <i class="fas fa-spinner fa-spin"></i>
                            Creando...
                        </span>
                    </button>
                </div>
            </div>
        </form>
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

        // Configurar validación del formulario
        setupFormValidation();

        // Generar username automáticamente
        setupUsernameGeneration();

        // Configurar fechas mínimas/máximas
        setupDateConstraints();

        // Generar contraseña automáticamente
        generatePassword();

        console.log('Crear conductor form initialized');
    });

    function setupFormValidation() {
        const form = document.getElementById('createConductorForm');

        // Validación en tiempo real para cédula
        const cedulaInput = document.getElementById('cedula');
        cedulaInput.addEventListener('input', function() {
            validateCedula(this.value);
        });

        // Validación en tiempo real para teléfono
        const telefonoInput = document.getElementById('telefono');
        telefonoInput.addEventListener('input', function() {
            validateTelefono(this.value);
        });

        // Validación de email
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                validateEmail(this.value);
            });
        }

        // Validación de licencia
        const licenciaInput = document.getElementById('licencia_numero');
        licenciaInput.addEventListener('input', function() {
            validateLicencia(this.value);
        });

        // Validación de fechas de licencia
        const expedicionInput = document.getElementById('licencia_expedicion');
        const vigenciaInput = document.getElementById('licencia_vigencia');

        expedicionInput.addEventListener('change', function() {
            validateLicenciaDates();
        });

        vigenciaInput.addEventListener('change', function() {
            validateLicenciaDates();
        });

        // Actualizar indicador de experiencia
        const experienciaInput = document.getElementById('experiencia_anos');
        experienciaInput.addEventListener('input', function() {
            updateExperienceLevel(parseInt(this.value) || 0);
        });

        // Validación al enviar
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm()) {
                submitForm();
            }
        });
    }

    function validateCedula(cedula) {
        const feedback = document.getElementById('cedulaFeedback');
        const input = document.getElementById('cedula');

        if (!cedula) {
            setFieldInvalid(input, feedback, 'La cédula es requerida');
            return false;
        }

        if (cedula.length !== 10) {
            setFieldInvalid(input, feedback, 'La cédula debe tener 10 dígitos');
            return false;
        }

        if (!/^[0-9]+$/.test(cedula)) {
            setFieldInvalid(input, feedback, 'La cédula solo debe contener números');
            return false;
        }

        // Validación algoritmo cédula ecuatoriana
        if (!validarCedulaEcuatoriana(cedula)) {
            setFieldInvalid(input, feedback, 'El número de cédula no es válido');
            return false;
        }

        setFieldValid(input, feedback, 'Cédula válida');
        return true;
    }

    function validarCedulaEcuatoriana(cedula) {
        // Algoritmo de validación de cédula ecuatoriana
        if (cedula.length !== 10) return false;

        const provincia = parseInt(cedula.substring(0, 2));
        if (provincia < 1 || provincia > 24) return false;

        const coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
        let suma = 0;

        for (let i = 0; i < 9; i++) {
            let digito = parseInt(cedula[i]) * coeficientes[i];
            if (digito > 9) digito -= 9;
            suma += digito;
        }

        const digitoVerificador = parseInt(cedula[9]);
        const decenaSuperior = Math.ceil(suma / 10) * 10;
        const digitoCalculado = decenaSuperior - suma;

        return digitoCalculado === digitoVerificador || (digitoCalculado === 10 && digitoVerificador === 0);
    }

    function validateTelefono(telefono) {
        const feedback = document.getElementById('telefonoFeedback');
        const input = document.getElementById('telefono');

        if (!telefono) {
            setFieldInvalid(input, feedback, 'El teléfono es requerido');
            return false;
        }

        if (!/^09[0-9]{8}$/.test(telefono)) {
            setFieldInvalid(input, feedback, 'El teléfono debe empezar con 09 y tener 10 dígitos');
            return false;
        }

        setFieldValid(input, feedback, 'Teléfono válido');
        return true;
    }

    function validateEmail(email) {
        const feedback = document.getElementById('emailFeedback');
        const input = document.getElementById('email');

        if (!email) {
            setFieldNeutral(input, feedback, '');
            return true; // Email es opcional
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            setFieldInvalid(input, feedback, 'Formato de email inválido');
            return false;
        }

        setFieldValid(input, feedback, 'Email válido');
        return true;
    }

    function validateLicencia(licencia) {
        const feedback = document.getElementById('licenciaNumeroFeedback');
        const input = document.getElementById('licencia_numero');

        if (!licencia) {
            setFieldInvalid(input, feedback, 'El número de licencia es requerido');
            return false;
        }

        if (licencia.length < 5) {
            setFieldInvalid(input, feedback, 'El número de licencia es muy corto');
            return false;
        }

        setFieldValid(input, feedback, 'Número de licencia válido');
        return true;
    }

    function validateLicenciaDates() {
        const expedicion = document.getElementById('licencia_expedicion').value;
        const vigencia = document.getElementById('licencia_vigencia').value;
        const vigenciaFeedback = document.getElementById('licenciaVigenciaFeedback');
        const vigenciaInput = document.getElementById('licencia_vigencia');

        if (!expedicion || !vigencia) return;

        const fechaExpedicion = new Date(expedicion);
        const fechaVigencia = new Date(vigencia);
        const hoy = new Date();

        if (fechaExpedicion >= fechaVigencia) {
            setFieldInvalid(vigenciaInput, vigenciaFeedback, 'La fecha de vigencia debe ser posterior a la expedición');
            return false;
        }

        if (fechaVigencia <= hoy) {
            setFieldInvalid(vigenciaInput, vigenciaFeedback, 'La licencia debe estar vigente');
            return false;
        }

        // Calcular días restantes
        const diasRestantes = Math.ceil((fechaVigencia - hoy) / (1000 * 60 * 60 * 24));

        if (diasRestantes < 30) {
            setFieldWarning(vigenciaInput, vigenciaFeedback, `Licencia vence en ${diasRestantes} días`);
        } else {
            setFieldValid(vigenciaInput, vigenciaFeedback, `Licencia válida por ${diasRestantes} días`);
        }

        return true;
    }

    function updateExperienceLevel(years) {
        const indicator = document.getElementById('experienceLevel');

        if (years <= 2) {
            indicator.innerHTML = '<i class="fas fa-star"></i> Conductor Novato (0-2 años)';
            indicator.className = 'experience-indicator novato';
        } else if (years <= 7) {
            indicator.innerHTML = '<i class="fas fa-award"></i> Conductor Experimentado (3-7 años)';
            indicator.className = 'experience-indicator experimentado';
        } else {
            indicator.innerHTML = '<i class="fas fa-medal"></i> Conductor Veterano (8+ años)';
            indicator.className = 'experience-indicator veterano';
        }
    }

    function setupUsernameGeneration() {
        const cedulaInput = document.getElementById('cedula');
        const usernameInput = document.getElementById('username');

        cedulaInput.addEventListener('input', function() {
            if (this.value.length === 10) {
                usernameInput.value = 'conductor_' + this.value;
            } else {
                usernameInput.value = '';
            }
        });
    }

    function setupDateConstraints() {
        // Fecha de nacimiento máxima (18 años atrás)
        const fechaNacimiento = document.getElementById('fecha_nacimiento');
        const hace18Anos = new Date();
        hace18Anos.setFullYear(hace18Anos.getFullYear() - 18);
        fechaNacimiento.max = hace18Anos.toISOString().split('T')[0];

        // Fecha de expedición máxima (hoy)
        const licenciaExpedicion = document.getElementById('licencia_expedicion');
        licenciaExpedicion.max = new Date().toISOString().split('T')[0];

        // Fecha de vigencia mínima (1 mes desde hoy)
        const licenciaVigencia = document.getElementById('licencia_vigencia');
        const enUnMes = new Date();
        enUnMes.setMonth(enUnMes.getMonth() + 1);
        licenciaVigencia.min = enUnMes.toISOString().split('T')[0];
    }

    function generatePassword() {
        const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
        let password = '';
        for (let i = 0; i < 8; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('password').value = password;
    }

    function previewPhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('photoPreview');
        const removeBtn = document.getElementById('removePhotoBtn');

        if (file) {
            // Validar tipo
            if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error', 'Solo se permiten archivos JPG, JPEG y PNG', 'error');
                } else {
                    alert('Solo se permiten archivos JPG, JPEG y PNG');
                }
                event.target.value = '';
                return;
            }

            // Validar tamaño (2MB)
            if (file.size > 2 * 1024 * 1024) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error', 'El archivo no debe superar los 2MB', 'error');
                } else {
                    alert('El archivo no debe superar los 2MB');
                }
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
                removeBtn.style.display = 'inline-flex';
            };
            reader.readAsDataURL(file);
        }
    }

    function removePhoto() {
        const fileInput = document.getElementById('foto');
        const preview = document.getElementById('photoPreview');
        const removeBtn = document.getElementById('removePhotoBtn');

        fileInput.value = '';
        preview.innerHTML = `
        <div class="photo-placeholder-modern">
            <i class="fas fa-user"></i>
            <span>Sin foto</span>
        </div>
    `;
        removeBtn.style.display = 'none';
    }

    function toggleSection(header) {
        const section = header.closest('.collapsible');
        const content = section.querySelector('.collapsible-content');
        const icon = header.querySelector('.collapse-icon i');

        section.classList.toggle('collapsed');

        if (section.classList.contains('collapsed')) {
            content.style.maxHeight = '0';
            icon.style.transform = 'rotate(-90deg)';
        } else {
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.style.transform = 'rotate(0deg)';
        }
    }

    function setFieldValid(input, feedback, message) {
        input.classList.remove('invalid', 'warning');
        input.classList.add('valid');
        feedback.className = 'form-feedback-modern valid';
        feedback.innerHTML = `<div class="feedback-success"><i class="fas fa-check"></i> ${message}</div>`;
    }

    function setFieldInvalid(input, feedback, message) {
        input.classList.remove('valid', 'warning');
        input.classList.add('invalid');
        feedback.className = 'form-feedback-modern invalid';
        feedback.innerHTML = `<div class="feedback-error"><i class="fas fa-times"></i> ${message}</div>`;
    }

    function setFieldWarning(input, feedback, message) {
        input.classList.remove('valid', 'invalid');
        input.classList.add('warning');
        feedback.className = 'form-feedback-modern warning';
        feedback.innerHTML = `<div class="feedback-warning"><i class="fas fa-exclamation-triangle"></i> ${message}</div>`;
    }

    function setFieldNeutral(input, feedback, message) {
        input.classList.remove('valid', 'invalid', 'warning');
        feedback.className = 'form-feedback-modern';
        feedback.innerHTML = message ? `<div class="feedback-help">${message}</div>` : '';
    }

    function validateForm() {
        let isValid = true;

        // Validar campos requeridos
        const requiredFields = [{
                id: 'nombre',
                validator: (v) => v.trim().length > 0,
                message: 'El nombre es requerido'
            },
            {
                id: 'apellido',
                validator: (v) => v.trim().length > 0,
                message: 'El apellido es requerido'
            },
            {
                id: 'cedula',
                validator: validateCedula
            },
            {
                id: 'telefono',
                validator: validateTelefono
            },
            {
                id: 'fecha_nacimiento',
                validator: (v) => v.trim().length > 0,
                message: 'La fecha de nacimiento es requerida'
            },
            {
                id: 'genero',
                validator: (v) => v.trim().length > 0,
                message: 'El género es requerido'
            },
            {
                id: 'licencia_numero',
                validator: validateLicencia
            },
            {
                id: 'licencia_categoria',
                validator: (v) => v.trim().length > 0,
                message: 'La categoría de licencia es requerida'
            },
            {
                id: 'licencia_expedicion',
                validator: (v) => v.trim().length > 0,
                message: 'La fecha de expedición es requerida'
            },
            {
                id: 'licencia_vigencia',
                validator: (v) => v.trim().length > 0,
                message: 'La fecha de vigencia es requerida'
            },
            {
                id: 'experiencia_anos',
                validator: (v) => parseInt(v) >= 0,
                message: 'La experiencia es requerida'
            }
        ];

        requiredFields.forEach(field => {
            const input = document.getElementById(field.id);
            const value = input.value.trim();

            if (typeof field.validator === 'function') {
                if (!field.validator(value)) {
                    isValid = false;
                }
            } else if (!field.validator(value)) {
                const feedback = document.getElementById(field.id + 'Feedback');
                setFieldInvalid(input, feedback, field.message);
                isValid = false;
            }
        });

        // Validar email si se proporcionó
        const email = document.getElementById('email').value.trim();
        if (email && !validateEmail(email)) {
            isValid = false;
        }

        // Validar fechas de licencia
        if (!validateLicenciaDates()) {
            isValid = false;
        }

        return isValid;
    }

    function submitForm() {
        const form = document.getElementById('createConductorForm');
        const submitBtn = document.getElementById('submitBtn');

        // Mostrar estado de carga
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        // Crear FormData para manejar archivos
        const formData = new FormData(form);

        // Enviar formulario
        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: '¡Conductor Creado!',
                            text: `El conductor ha sido registrado exitosamente. Usuario: ${data.username}`,
                            icon: 'success',
                            confirmButtonText: 'Ver Conductor'
                        }).then(() => {
                            window.location.href = `/admin/conductores/ver/${data.conductor_id}`;
                        });
                    } else {
                        alert('Conductor creado exitosamente');
                        window.location.href = `/admin/conductores/ver/${data.conductor_id}`;
                    }
                } else {
                    throw new Error(data.message || 'Error al crear conductor');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error', error.message || 'Error al crear conductor', 'error');
                } else {
                    alert('Error al crear conductor: ' + error.message);
                }
            })
            .finally(() => {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            });
    }

    function resetForm() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Limpiar formulario?',
                text: 'Se perderán todos los datos ingresados',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Limpiar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('createConductorForm').reset();
                    removePhoto();
                    // Limpiar estados de validación
                    document.querySelectorAll('.form-input-modern, .form-select-modern').forEach(input => {
                        input.classList.remove('valid', 'invalid', 'warning');
                    });
                    document.querySelectorAll('.form-feedback-modern').forEach(feedback => {
                        feedback.innerHTML = '';
                        feedback.className = 'form-feedback-modern';
                    });
                }
            });
        } else {
            if (confirm('¿Está seguro de limpiar el formulario?')) {
                document.getElementById('createConductorForm').reset();
                removePhoto();
            }
        }
    }
</script>



<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>