<?php

/**
 * Vista Editar Usuario - Sistema PRIMERO DE JUNIO
 */

$title = 'Editar Usuario';
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
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Editar Usuario</span>
                        <span class="title-subtitle"><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?></span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/usuarios/perfil/<?= $usuario['id'] ?>" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-eye"></i></span>
                        <span class="btn-text">Ver Perfil</span>
                    </a>
                    <a href="/admin/usuarios" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Info Summary -->
<div class="container-modern">
    <div class="user-summary-modern" data-aos="fade-up" data-aos-delay="100">
        <div class="summary-background">
            <div class="user-avatar-section">
                <div class="user-avatar-large">
                    <?php if (!empty($usuario['avatar'])): ?>
                        <img src="<?= htmlspecialchars($usuario['avatar']) ?>" alt="Avatar">
                    <?php else: ?>
                        <div class="avatar-placeholder-large">
                            <?= strtoupper(substr($usuario['nombre'], 0, 1) . substr($usuario['apellido'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="button" class="btn-modern btn-sm btn-outline" onclick="changeAvatar()">
                    <span class="btn-icon"><i class="fas fa-camera"></i></span>
                    <span class="btn-text">Cambiar Foto</span>
                </button>
            </div>

            <div class="user-details-section">
                <div class="user-basic-info">
                    <h3><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?></h3>
                    <p><?= htmlspecialchars($usuario['email']) ?></p>
                    <div class="user-meta">
                        <span class="role-badge-modern <?= strtolower($usuario['rol_nombre'] ?? 'usuario') ?>">
                            <?= htmlspecialchars($usuario['rol_nombre'] ?? 'N/A') ?>
                        </span>
                        <span class="status-badge-modern <?= $usuario['estado'] ?>">
                            <?= ucfirst($usuario['estado']) ?>
                        </span>
                    </div>
                </div>

                <div class="user-stats">
                    <div class="stat-item">
                        <i class="fas fa-calendar-plus"></i>
                        <div>
                            <span class="stat-label">Creado</span>
                            <span class="stat-value"><?= date('d/m/Y', strtotime($usuario['created_at'] ?? 'now')) ?></span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <span class="stat-label">Último Acceso</span>
                            <span class="stat-value">
                                <?= $usuario['ultimo_acceso'] ? date('d/m/Y H:i', strtotime($usuario['ultimo_acceso'])) : 'Nunca' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="summary-glow"></div>
    </div>

    <!-- Edit Form -->
    <form class="form-modern" method="POST" id="editUserForm" enctype="multipart/form-data">
        <div class="form-grid-modern">
            <!-- Información Básica -->
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="200">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>Información Básica</span>
                        </div>
                    </div>

                    <div class="card-content-modern">
                        <div class="form-grid-modern cols-2">
                            <div class="form-group-modern">
                                <label class="form-label-modern required">
                                    <i class="fas fa-user"></i>
                                    Nombre
                                </label>
                                <input type="text"
                                    class="form-input-modern"
                                    name="nombre"
                                    required
                                    value="<?= htmlspecialchars($usuario['nombre']) ?>">
                                <div class="form-error-modern" id="nombre-error"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern required">
                                    <i class="fas fa-user"></i>
                                    Apellido
                                </label>
                                <input type="text"
                                    class="form-input-modern"
                                    name="apellido"
                                    required
                                    value="<?= htmlspecialchars($usuario['apellido']) ?>">
                                <div class="form-error-modern" id="apellido-error"></div>
                            </div>
                        </div>

                        <div class="form-grid-modern cols-2">
                            <div class="form-group-modern">
                                <label class="form-label-modern required">
                                    <i class="fas fa-envelope"></i>
                                    Email
                                </label>
                                <input type="email"
                                    class="form-input-modern"
                                    name="email"
                                    required
                                    value="<?= htmlspecialchars($usuario['email']) ?>">
                                <div class="form-error-modern" id="email-error"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-phone"></i>
                                    Teléfono
                                </label>
                                <input type="tel"
                                    class="form-input-modern"
                                    name="telefono"
                                    value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>">
                                <div class="form-error-modern" id="telefono-error"></div>
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-map-marker-alt"></i>
                                Dirección
                            </label>
                            <input type="text"
                                class="form-input-modern"
                                name="direccion"
                                value="<?= htmlspecialchars($usuario['direccion'] ?? '') ?>">
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-calendar"></i>
                                Fecha de Nacimiento
                            </label>
                            <input type="date"
                                class="form-input-modern"
                                name="fecha_nacimiento"
                                value="<?= $usuario['fecha_nacimiento'] ?>">
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Rol y Estado -->
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="300">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <span>Rol y Estado</span>
                        </div>
                    </div>

                    <div class="card-content-modern">
                        <div class="form-group-modern">
                            <label class="form-label-modern required">
                                <i class="fas fa-user-tag"></i>
                                Rol del Usuario
                            </label>
                            <select class="form-select-modern" name="rol_id" required id="rolSelect">
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?= $rol['id'] ?>"
                                        <?= $usuario['rol_id'] == $rol['id'] ? 'selected' : '' ?>
                                        data-description="<?= htmlspecialchars($rol['descripcion']) ?>">
                                        <?= htmlspecialchars($rol['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-help-modern" id="rolDescription"></div>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern required">
                                <i class="fas fa-toggle-on"></i>
                                Estado del Usuario
                            </label>
                            <div class="radio-group-modern">
                                <label class="radio-option-modern">
                                    <input type="radio" name="estado" value="activo"
                                        <?= $usuario['estado'] === 'activo' ? 'checked' : '' ?>>
                                    <span class="radio-checkmark-modern"></span>
                                    <span class="radio-label-modern">
                                        <strong>Activo</strong>
                                        <small>Usuario puede acceder al sistema</small>
                                    </span>
                                </label>

                                <label class="radio-option-modern">
                                    <input type="radio" name="estado" value="inactivo"
                                        <?= $usuario['estado'] === 'inactivo' ? 'checked' : '' ?>>
                                    <span class="radio-checkmark-modern"></span>
                                    <span class="radio-label-modern">
                                        <strong>Inactivo</strong>
                                        <small>Usuario bloqueado, no puede acceder</small>
                                    </span>
                                </label>

                                <label class="radio-option-modern">
                                    <input type="radio" name="estado" value="pendiente"
                                        <?= $usuario['estado'] === 'pendiente' ? 'checked' : '' ?>>
                                    <span class="radio-checkmark-modern"></span>
                                    <span class="radio-label-modern">
                                        <strong>Pendiente</strong>
                                        <small>En espera de activación</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="400">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <span>Cambiar Contraseña</span>
                        </div>
                        <div class="toggle-section-modern" onclick="toggleSection('passwordSection')">
                            <span>Opcional</span>
                            <i class="fas fa-chevron-down" id="passwordSectionIcon"></i>
                        </div>
                    </div>

                    <div class="card-content-modern collapsible-content" id="passwordSection">
                        <div class="form-notice-modern">
                            <i class="fas fa-info-circle"></i>
                            <p>Deje los campos en blanco si no desea cambiar la contraseña actual.</p>
                        </div>

                        <div class="form-grid-modern cols-2">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-lock"></i>
                                    Nueva Contraseña
                                </label>
                                <div class="input-group-modern">
                                    <input type="password"
                                        class="form-input-modern"
                                        name="password"
                                        placeholder="Nueva contraseña..."
                                        id="password">
                                    <button type="button"
                                        class="input-group-btn-modern"
                                        onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                <div class="password-strength-modern" id="passwordStrength"></div>
                                <div class="form-error-modern" id="password-error"></div>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-lock"></i>
                                    Confirmar Contraseña
                                </label>
                                <div class="input-group-modern">
                                    <input type="password"
                                        class="form-input-modern"
                                        name="password_confirm"
                                        placeholder="Confirmar contraseña..."
                                        id="passwordConfirm">
                                    <button type="button"
                                        class="input-group-btn-modern"
                                        onclick="togglePassword('passwordConfirm')">
                                        <i class="fas fa-eye" id="passwordConfirm-icon"></i>
                                    </button>
                                </div>
                                <div class="form-error-modern" id="password_confirm-error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Información Adicional -->
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="500">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <span>Información del Perfil</span>
                        </div>
                        <div class="toggle-section-modern" onclick="toggleSection('additionalInfo')">
                            <span>Expandir</span>
                            <i class="fas fa-chevron-down" id="additionalInfoIcon"></i>
                        </div>
                    </div>

                    <div class="card-content-modern collapsible-content" id="additionalInfo">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-phone-alt"></i>
                                Teléfono Personal
                            </label>
                            <input type="tel"
                                class="form-input-modern"
                                name="telefono_personal"
                                value="<?= htmlspecialchars($perfil['telefono_personal'] ?? '') ?>">
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-home"></i>
                                Dirección de Residencia
                            </label>
                            <textarea class="form-textarea-modern"
                                name="direccion_residencia"
                                rows="3"><?= htmlspecialchars($perfil['direccion_residencia'] ?? '') ?></textarea>
                        </div>

                        <div class="form-grid-modern cols-2">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-tint"></i>
                                    Tipo de Sangre
                                </label>
                                <select class="form-select-modern" name="tipo_sangre">
                                    <option value="">Seleccionar...</option>
                                    <?php
                                    $tipos = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                    foreach ($tipos as $tipo): ?>
                                        <option value="<?= $tipo ?>"
                                            <?= ($perfil['tipo_sangre'] ?? '') === $tipo ? 'selected' : '' ?>>
                                            <?= $tipo ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-user-friends"></i>
                                    Contacto de Emergencia
                                </label>
                                <input type="text"
                                    class="form-input-modern"
                                    name="contacto_emergencia_nombre"
                                    value="<?= htmlspecialchars($perfil['contacto_emergencia_nombre'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-phone"></i>
                                Teléfono de Emergencia
                            </label>
                            <input type="tel"
                                class="form-input-modern"
                                name="contacto_emergencia_telefono"
                                value="<?= htmlspecialchars($perfil['contacto_emergencia_telefono'] ?? '') ?>">
                        </div>

                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-sticky-note"></i>
                                Observaciones
                            </label>
                            <textarea class="form-textarea-modern"
                                name="observaciones"
                                rows="3"
                                placeholder="Notas adicionales sobre el usuario..."><?= htmlspecialchars($perfil['observaciones'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions-modern" data-aos="fade-up" data-aos-delay="600">
            <div class="actions-container-modern">
                <button type="button" class="btn-modern btn-outline" onclick="window.location.href='/admin/usuarios'">
                    <span class="btn-icon"><i class="fas fa-times"></i></span>
                    <span class="btn-text">Cancelar</span>
                </button>

                <button type="button" class="btn-modern btn-secondary" onclick="resetForm()">
                    <span class="btn-icon"><i class="fas fa-undo"></i></span>
                    <span class="btn-text">Restaurar</span>
                </button>

                <button type="submit" class="btn-modern btn-primary" id="submitBtn">
                    <span class="btn-icon"><i class="fas fa-save"></i></span>
                    <span class="btn-text">Guardar Cambios</span>
                    <div class="btn-loader-modern" id="submitLoader"></div>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Hidden file input for avatar -->
<input type="file" id="avatarInput" accept="image/*" style="display: none;">

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

        // Initialize form
        const form = document.getElementById('editUserForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitLoader = document.getElementById('submitLoader');

        // Store original form data
        const originalFormData = new FormData(form);

        // Role description update
        const roleSelect = document.getElementById('rolSelect');
        const roleDescription = document.getElementById('rolDescription');

        function updateRoleDescription() {
            const selectedOption = roleSelect.options[roleSelect.selectedIndex];
            const description = selectedOption.getAttribute('data-description');
            roleDescription.textContent = description || '';
        }

        roleSelect.addEventListener('change', updateRoleDescription);
        updateRoleDescription(); // Initialize

        // Password validation
        const passwordInput = document.getElementById('password');
        const passwordConfirm = document.getElementById('passwordConfirm');
        const passwordStrength = document.getElementById('passwordStrength');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                if (password) {
                    const strength = checkPasswordStrength(password);
                    passwordStrength.innerHTML = `
                    <div class="strength-bar-modern ${strength.class}">
                        <div class="strength-fill-modern" style="width: ${strength.percentage}%"></div>
                    </div>
                    <span class="strength-text-modern">${strength.text}</span>
                `;
                } else {
                    passwordStrength.innerHTML = '';
                }
            });
        }

        if (passwordConfirm) {
            passwordConfirm.addEventListener('input', function() {
                const password = passwordInput.value;
                const confirm = this.value;
                const errorDiv = document.getElementById('password_confirm-error');

                if (confirm && password !== confirm) {
                    showFieldError(this, 'Las contraseñas no coinciden');
                } else {
                    clearFieldError(this);
                }
            });
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (validateForm()) {
                // Check if form has changes
                if (!hasFormChanges()) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Sin cambios',
                            text: 'No se han detectado cambios en el formulario.'
                        });
                    } else {
                        alert('No se han detectado cambios en el formulario.');
                    }
                    return;
                }

                submitBtn.disabled = true;
                submitLoader.style.display = 'block';

                setTimeout(() => {
                    this.submit();
                }, 500);
            }
        });

        // Real-time validation
        const inputs = form.querySelectorAll('input[required], select[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });

        function validateForm() {
            let isValid = true;

            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });

            // Validate password if provided
            const password = passwordInput.value;
            const confirm = passwordConfirm.value;

            if (password && password !== confirm) {
                showFieldError(passwordConfirm, 'Las contraseñas no coinciden');
                isValid = false;
            }

            if (password && password.length < 6) {
                showFieldError(passwordInput, 'La contraseña debe tener al menos 6 caracteres');
                isValid = false;
            }

            return isValid;
        }

        function validateField(field) {
            const value = field.value.trim();
            const fieldName = field.name;
            let isValid = true;
            let errorMessage = '';

            clearFieldError(field);

            if (field.hasAttribute('required') && !value) {
                errorMessage = 'Este campo es requerido';
                isValid = false;
            }

            switch (fieldName) {
                case 'email':
                    if (value && !isValidEmail(value)) {
                        errorMessage = 'Email inválido';
                        isValid = false;
                    }
                    break;
                case 'telefono':
                case 'telefono_personal':
                case 'contacto_emergencia_telefono':
                    if (value && !isValidPhone(value)) {
                        errorMessage = 'Formato de teléfono inválido';
                        isValid = false;
                    }
                    break;
            }

            if (!isValid) {
                showFieldError(field, errorMessage);
            }

            return isValid;
        }

        function hasFormChanges() {
            const currentFormData = new FormData(form);

            // Compare current form data with original
            for (let [key, value] of currentFormData.entries()) {
                if (originalFormData.get(key) !== value) {
                    return true;
                }
            }

            return false;
        }

        function showFieldError(field, message) {
            field.classList.add('error');
            const errorDiv = document.getElementById(field.name + '-error');
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
            }
        }

        function clearFieldError(field) {
            field.classList.remove('error');
            const errorDiv = document.getElementById(field.name + '-error');
            if (errorDiv) {
                errorDiv.style.display = 'none';
            }
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhone(phone) {
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]{7,15}$/;
            return phoneRegex.test(phone);
        }

        function checkPasswordStrength(password) {
            let score = 0;

            if (password.length >= 8) score += 20;
            if (password.length >= 12) score += 10;
            if (/[a-z]/.test(password)) score += 20;
            if (/[A-Z]/.test(password)) score += 20;
            if (/[0-9]/.test(password)) score += 20;
            if (/[^A-Za-z0-9]/.test(password)) score += 10;

            if (score < 40) {
                return {
                    class: 'weak',
                    percentage: score,
                    text: 'Débil'
                };
            } else if (score < 70) {
                return {
                    class: 'medium',
                    percentage: score,
                    text: 'Medio'
                };
            } else {
                return {
                    class: 'strong',
                    percentage: score,
                    text: 'Fuerte'
                };
            }
        }

        console.log('Edit user form initialized');
    });

    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Toggle collapsible sections
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        const icon = document.getElementById(sectionId + 'Icon');

        section.classList.toggle('active');
        icon.classList.toggle('fa-chevron-down');
        icon.classList.toggle('fa-chevron-up');
    }

    // Change avatar
    function changeAvatar() {
        document.getElementById('avatarInput').click();
    }

    // Reset form to original state
    function resetForm() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Restaurar formulario?',
                text: 'Se perderán todos los cambios no guardados',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Restaurar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editUserForm').reset();
                    window.location.reload();
                }
            });
        } else {
            if (confirm('¿Está seguro de que desea restaurar el formulario? Se perderán todos los cambios no guardados.')) {
                document.getElementById('editUserForm').reset();
                window.location.reload();
            }
        }
    }
</script>



<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>