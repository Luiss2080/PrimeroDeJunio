<?php
/**
 * Vista Crear Usuario - Sistema PRIMERO DE JUNIO
 */

$title = 'Crear Usuario';
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
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Crear Usuario</span>
                        <span class="title-subtitle">Agregar nuevo usuario al sistema</span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/usuarios" class="btn-modern btn-outline">
                        <span class="btn-icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-text">Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="container-modern">
    <form class="form-modern" method="POST" id="createUserForm" enctype="multipart/form-data">
        <div class="form-grid-modern">
            <!-- Información Básica -->
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="100">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>Información Básica</span>
                        </div>
                        <div class="required-indicator-modern">
                            <i class="fas fa-asterisk"></i>
                            <span>Campos requeridos</span>
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
                                       placeholder="Ingrese el nombre..."
                                       value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
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
                                       placeholder="Ingrese el apellido..."
                                       value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>">
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
                                       placeholder="ejemplo@correo.com"
                                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
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
                                       placeholder="+57 300 123 4567"
                                       value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
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
                                   placeholder="Ingrese la dirección..."
                                   value="<?= htmlspecialchars($_POST['direccion'] ?? '') ?>">
                            <div class="form-error-modern" id="direccion-error"></div>
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-calendar"></i>
                                Fecha de Nacimiento
                            </label>
                            <input type="date" 
                                   class="form-input-modern" 
                                   name="fecha_nacimiento" 
                                   value="<?= htmlspecialchars($_POST['fecha_nacimiento'] ?? '') ?>">
                            <div class="form-error-modern" id="fecha_nacimiento-error"></div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Seguridad y Rol -->
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="200">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <span>Seguridad y Rol</span>
                        </div>
                    </div>
                    
                    <div class="card-content-modern">
                        <div class="form-group-modern">
                            <label class="form-label-modern required">
                                <i class="fas fa-user-tag"></i>
                                Rol del Usuario
                            </label>
                            <select class="form-select-modern" name="rol_id" required id="rolSelect">
                                <option value="">Seleccionar rol...</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?= $rol['id'] ?>" 
                                            <?= ($_POST['rol_id'] ?? '') == $rol['id'] ? 'selected' : '' ?>
                                            data-description="<?= htmlspecialchars($rol['descripcion']) ?>">
                                        <?= htmlspecialchars($rol['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-help-modern" id="rolDescription">
                                Seleccione el rol que tendrá el usuario en el sistema
                            </div>
                            <div class="form-error-modern" id="rol_id-error"></div>
                        </div>
                        
                        <div class="form-grid-modern cols-2">
                            <div class="form-group-modern">
                                <label class="form-label-modern required">
                                    <i class="fas fa-lock"></i>
                                    Contraseña
                                </label>
                                <div class="input-group-modern">
                                    <input type="password" 
                                           class="form-input-modern" 
                                           name="password" 
                                           required
                                           placeholder="Mínimo 6 caracteres..."
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
                                <label class="form-label-modern required">
                                    <i class="fas fa-lock"></i>
                                    Confirmar Contraseña
                                </label>
                                <div class="input-group-modern">
                                    <input type="password" 
                                           class="form-input-modern" 
                                           name="password_confirm" 
                                           required
                                           placeholder="Confirme la contraseña..."
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
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-toggle-on"></i>
                                Estado del Usuario
                            </label>
                            <div class="radio-group-modern">
                                <label class="radio-option-modern">
                                    <input type="radio" name="estado" value="activo" 
                                           <?= ($_POST['estado'] ?? 'activo') === 'activo' ? 'checked' : '' ?>>
                                    <span class="radio-checkmark-modern"></span>
                                    <span class="radio-label-modern">
                                        <strong>Activo</strong>
                                        <small>Usuario puede acceder al sistema</small>
                                    </span>
                                </label>
                                
                                <label class="radio-option-modern">
                                    <input type="radio" name="estado" value="pendiente"
                                           <?= ($_POST['estado'] ?? '') === 'pendiente' ? 'checked' : '' ?>>
                                    <span class="radio-checkmark-modern"></span>
                                    <span class="radio-label-modern">
                                        <strong>Pendiente</strong>
                                        <small>Usuario creado, esperando activación</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>

            <!-- Información Adicional -->
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="300">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <span>Información Adicional</span>
                        </div>
                        <div class="toggle-section-modern" onclick="toggleSection('additionalInfo')">
                            <span>Opcional</span>
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
                                   placeholder="Número de contacto personal..."
                                   value="<?= htmlspecialchars($_POST['telefono_personal'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-home"></i>
                                Dirección de Residencia
                            </label>
                            <textarea class="form-textarea-modern" 
                                      name="direccion_residencia" 
                                      rows="3"
                                      placeholder="Dirección completa de residencia..."><?= htmlspecialchars($_POST['direccion_residencia'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="form-grid-modern cols-2">
                            <div class="form-group-modern">
                                <label class="form-label-modern">
                                    <i class="fas fa-tint"></i>
                                    Tipo de Sangre
                                </label>
                                <select class="form-select-modern" name="tipo_sangre">
                                    <option value="">Seleccionar...</option>
                                    <option value="A+" <?= ($_POST['tipo_sangre'] ?? '') === 'A+' ? 'selected' : '' ?>>A+</option>
                                    <option value="A-" <?= ($_POST['tipo_sangre'] ?? '') === 'A-' ? 'selected' : '' ?>>A-</option>
                                    <option value="B+" <?= ($_POST['tipo_sangre'] ?? '') === 'B+' ? 'selected' : '' ?>>B+</option>
                                    <option value="B-" <?= ($_POST['tipo_sangre'] ?? '') === 'B-' ? 'selected' : '' ?>>B-</option>
                                    <option value="AB+" <?= ($_POST['tipo_sangre'] ?? '') === 'AB+' ? 'selected' : '' ?>>AB+</option>
                                    <option value="AB-" <?= ($_POST['tipo_sangre'] ?? '') === 'AB-' ? 'selected' : '' ?>>AB-</option>
                                    <option value="O+" <?= ($_POST['tipo_sangre'] ?? '') === 'O+' ? 'selected' : '' ?>>O+</option>
                                    <option value="O-" <?= ($_POST['tipo_sangre'] ?? '') === 'O-' ? 'selected' : '' ?>>O-</option>
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
                                       placeholder="Nombre del contacto..."
                                       value="<?= htmlspecialchars($_POST['contacto_emergencia_nombre'] ?? '') ?>">
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
                                   placeholder="Teléfono del contacto de emergencia..."
                                   value="<?= htmlspecialchars($_POST['contacto_emergencia_telefono'] ?? '') ?>">
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions-modern" data-aos="fade-up" data-aos-delay="400">
            <div class="actions-container-modern">
                <button type="button" class="btn-modern btn-outline" onclick="window.location.href='/admin/usuarios'">
                    <span class="btn-icon"><i class="fas fa-times"></i></span>
                    <span class="btn-text">Cancelar</span>
                </button>
                
                <button type="reset" class="btn-modern btn-secondary">
                    <span class="btn-icon"><i class="fas fa-undo"></i></span>
                    <span class="btn-text">Limpiar</span>
                </button>
                
                <button type="submit" class="btn-modern btn-primary" id="submitBtn">
                    <span class="btn-icon"><i class="fas fa-save"></i></span>
                    <span class="btn-text">Crear Usuario</span>
                    <div class="btn-loader-modern" id="submitLoader"></div>
                </button>
            </div>
        </div>
    </form>
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

    // Form validation
    const form = document.getElementById('createUserForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitLoader = document.getElementById('submitLoader');

    // Role description update
    const roleSelect = document.getElementById('rolSelect');
    const roleDescription = document.getElementById('rolDescription');
    
    roleSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const description = selectedOption.getAttribute('data-description');
        roleDescription.textContent = description || 'Seleccione el rol que tendrá el usuario en el sistema';
    });

    // Password strength checker
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('passwordStrength');
    
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        
        passwordStrength.innerHTML = `
            <div class="strength-bar-modern ${strength.class}">
                <div class="strength-fill-modern" style="width: ${strength.percentage}%"></div>
            </div>
            <span class="strength-text-modern">${strength.text}</span>
        `;
    });

    // Password confirmation validation
    const passwordConfirm = document.getElementById('passwordConfirm');
    
    passwordConfirm.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirm = this.value;
        const errorDiv = document.getElementById('password_confirm-error');
        
        if (confirm && password !== confirm) {
            errorDiv.textContent = 'Las contraseñas no coinciden';
            errorDiv.style.display = 'block';
            this.classList.add('error');
        } else {
            errorDiv.style.display = 'none';
            this.classList.remove('error');
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitBtn.disabled = true;
            submitLoader.style.display = 'block';
            
            // Simulate form processing
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
        
        // Validate password confirmation
        const password = passwordInput.value;
        const confirm = passwordConfirm.value;
        
        if (password !== confirm) {
            showFieldError(passwordConfirm, 'Las contraseñas no coinciden');
            isValid = false;
        }
        
        return isValid;
    }

    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        let isValid = true;
        let errorMessage = '';

        // Clear previous error
        clearFieldError(field);

        // Required validation
        if (field.hasAttribute('required') && !value) {
            errorMessage = 'Este campo es requerido';
            isValid = false;
        }

        // Specific validations
        switch (fieldName) {
            case 'email':
                if (value && !isValidEmail(value)) {
                    errorMessage = 'Email inválido';
                    isValid = false;
                }
                break;
            case 'password':
                if (value && value.length < 6) {
                    errorMessage = 'La contraseña debe tener al menos 6 caracteres';
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
            return { class: 'weak', percentage: score, text: 'Débil' };
        } else if (score < 70) {
            return { class: 'medium', percentage: score, text: 'Medio' };
        } else {
            return { class: 'strong', percentage: score, text: 'Fuerte' };
        }
    }

    console.log('Create user form initialized');
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
</script>

<style>
/* Estilos específicos para el formulario de crear usuario */
.form-grid-modern {
    display: grid;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.form-grid-modern.cols-2 {
    grid-template-columns: 1fr 1fr;
}

.required-indicator-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.8rem;
}

.required-indicator-modern i {
    color: var(--error-color);
    font-size: 0.7rem;
}

.form-label-modern.required::after {
    content: '*';
    color: var(--error-color);
    margin-left: 0.25rem;
}

.form-label-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
}

.form-label-modern i {
    color: var(--primary-green);
    width: 16px;
}

.input-group-modern {
    position: relative;
    display: flex;
}

.input-group-btn-modern {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.input-group-btn-modern:hover {
    color: var(--primary-green);
    background: rgba(0, 255, 102, 0.1);
}

.password-strength-modern {
    margin-top: 0.5rem;
}

.strength-bar-modern {
    height: 4px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-fill-modern {
    height: 100%;
    transition: all 0.3s ease;
}

.strength-bar-modern.weak .strength-fill-modern {
    background: var(--error-color);
}

.strength-bar-modern.medium .strength-fill-modern {
    background: var(--warning-color);
}

.strength-bar-modern.strong .strength-fill-modern {
    background: var(--success-color);
}

.strength-text-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.radio-group-modern {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.radio-option-modern {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border: 2px solid transparent;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.radio-option-modern:hover {
    border-color: var(--primary-green);
    background: rgba(0, 255, 102, 0.05);
}

.radio-option-modern input[type="radio"] {
    display: none;
}

.radio-option-modern input[type="radio"]:checked + .radio-checkmark-modern {
    background: var(--primary-green);
    border-color: var(--primary-green);
}

.radio-option-modern input[type="radio"]:checked + .radio-checkmark-modern::after {
    opacity: 1;
}

.radio-option-modern input[type="radio"]:checked ~ .radio-label-modern {
    color: var(--text-primary);
}

.radio-checkmark-modern {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-color);
    border-radius: 50%;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.radio-checkmark-modern::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.radio-label-modern {
    display: flex;
    flex-direction: column;
    color: var(--text-secondary);
    transition: color 0.3s ease;
}

.radio-label-modern strong {
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.radio-label-modern small {
    font-size: 0.8rem;
    opacity: 0.8;
}

.toggle-section-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    color: var(--text-secondary);
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.toggle-section-modern:hover {
    color: var(--primary-green);
}

.toggle-section-modern i {
    transition: transform 0.3s ease;
}

.collapsible-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.collapsible-content.active {
    max-height: 1000px;
}

.form-actions-modern {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.actions-container-modern {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    flex-wrap: wrap;
}

.btn-loader-modern {
    display: none;
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 0.5rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.form-input-modern.error,
.form-select-modern.error,
.form-textarea-modern.error {
    border-color: var(--error-color);
    background: rgba(239, 68, 68, 0.05);
}

.form-error-modern {
    display: none;
    color: var(--error-color);
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

.form-help-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

/* Responsive design */
@media (max-width: 768px) {
    .form-grid-modern.cols-2 {
        grid-template-columns: 1fr;
    }
    
    .actions-container-modern {
        justify-content: center;
        flex-direction: column-reverse;
    }
    
    .radio-group-modern {
        gap: 0.75rem;
    }
    
    .radio-option-modern {
        padding: 0.75rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>