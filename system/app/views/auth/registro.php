<?php
/**
 * Vista de Registro - Sistema PRIMERO DE JUNIO
 */

$title = 'Registro de Usuario';
$error_message = $_SESSION['error_message'] ?? '';
$success_message = $_SESSION['success_message'] ?? '';

// Limpiar mensajes de sesión
unset($_SESSION['error_message'], $_SESSION['success_message']);

ob_start();
?>

<div class="auth-header">
    <div class="auth-logo">
        <i class="fas fa-motorcycle"></i>
        <div class="auth-logo-text">
            <div class="auth-logo-title">Primero de Junio</div>
            <div class="auth-logo-subtitle">Asociación Mototaxis</div>
        </div>
    </div>
    <h2 class="auth-title">Crear Cuenta</h2>
    <p class="auth-subtitle">Únete a nuestra asociación de conductores</p>
</div>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-error">
        <i class="fas fa-exclamation-triangle"></i>
        <?= htmlspecialchars($error_message) ?>
    </div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <?= htmlspecialchars($success_message) ?>
    </div>
<?php endif; ?>

<form class="auth-form" method="POST" action="/system/routes/auth/register" id="registerForm">
    <div class="form-group">
        <label for="nombre" class="form-label">
            <i class="fas fa-user"></i>
            Nombre Completo
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-user"></i>
            <input 
                type="text" 
                id="nombre" 
                name="nombre" 
                class="form-input" 
                placeholder="Juan Pérez García"
                value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>"
                required
                minlength="3"
                maxlength="100"
            >
        </div>
        <div class="input-feedback" id="nombreFeedback"></div>
    </div>

    <div class="form-group">
        <label for="email" class="form-label">
            <i class="fas fa-envelope"></i>
            Correo Electrónico
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-envelope"></i>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-input" 
                placeholder="juan.perez@ejemplo.com"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required
                autocomplete="email"
            >
        </div>
        <div class="input-feedback" id="emailFeedback"></div>
    </div>

    <div class="form-group">
        <label for="telefono" class="form-label">
            <i class="fas fa-phone"></i>
            Teléfono
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-phone"></i>
            <input 
                type="tel" 
                id="telefono" 
                name="telefono" 
                class="form-input" 
                placeholder="+57 300 123 4567"
                value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>"
                required
                pattern="[+]?[0-9\s\-\(\)]+"
            >
        </div>
        <div class="input-feedback" id="telefonoFeedback"></div>
    </div>

    <div class="form-group">
        <label for="cedula" class="form-label">
            <i class="fas fa-id-card"></i>
            Cédula de Ciudadanía
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-id-card"></i>
            <input 
                type="text" 
                id="cedula" 
                name="cedula" 
                class="form-input" 
                placeholder="1234567890"
                value="<?= htmlspecialchars($_POST['cedula'] ?? '') ?>"
                required
                pattern="[0-9]{7,10}"
                minlength="7"
                maxlength="10"
            >
        </div>
        <div class="input-feedback" id="cedulaFeedback"></div>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">
            <i class="fas fa-lock"></i>
            Contraseña
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-lock"></i>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-input" 
                placeholder="••••••••"
                required
                minlength="6"
                autocomplete="new-password"
            >
            <button type="button" class="password-toggle" tabindex="-1">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        <div class="password-strength" id="passwordStrength">
            <div class="strength-bar">
                <div class="strength-fill" id="strengthFill"></div>
            </div>
            <div class="strength-text" id="strengthText">Escribe una contraseña</div>
        </div>
    </div>

    <div class="form-group">
        <label for="password_confirmation" class="form-label">
            <i class="fas fa-lock"></i>
            Confirmar Contraseña
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-lock"></i>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="form-input" 
                placeholder="••••••••"
                required
                autocomplete="new-password"
            >
            <button type="button" class="password-toggle" tabindex="-1">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        <div class="input-feedback" id="confirmFeedback"></div>
    </div>

    <div class="form-group">
        <label for="rol_id" class="form-label">
            <i class="fas fa-user-tag"></i>
            Tipo de Usuario
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-user-tag"></i>
            <select id="rol_id" name="rol_id" class="form-input" required>
                <option value="">Selecciona tu rol</option>
                <option value="2" <?= ($_POST['rol_id'] ?? '') == '2' ? 'selected' : '' ?>>Conductor</option>
                <option value="3" <?= ($_POST['rol_id'] ?? '') == '3' ? 'selected' : '' ?>>Operador</option>
            </select>
        </div>
    </div>

    <div class="form-options">
        <div class="checkbox-group">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">
                Acepto los <a href="/terminos" target="_blank" class="auth-link">términos y condiciones</a>
            </label>
        </div>
    </div>

    <div class="form-options">
        <div class="checkbox-group">
            <input type="checkbox" id="privacy" name="privacy" required>
            <label for="privacy">
                Acepto la <a href="/privacidad" target="_blank" class="auth-link">política de privacidad</a>
            </label>
        </div>
    </div>

    <button type="submit" class="auth-button" id="submitBtn">
        <i class="fas fa-user-plus"></i>
        Crear Cuenta
    </button>
</form>

<div class="auth-footer">
    <p>¿Ya tienes una cuenta? 
        <a href="/system/app/views/auth/login.php" class="auth-link">Inicia sesión aquí</a>
    </p>
    
    <div style="margin-top: 1.5rem;">
        <div class="alert alert-info" style="margin-bottom: 0;">
            <i class="fas fa-info-circle"></i>
            <strong>Nota:</strong> Tu cuenta será revisada por un administrador antes de ser activada.
        </div>
    </div>
</div>

<style>
.input-feedback {
    font-size: 0.8rem;
    margin-top: 0.25rem;
    padding-left: 0.5rem;
}

.input-feedback.valid {
    color: var(--primary-green);
}

.input-feedback.invalid {
    color: #dc2626;
}

.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    width: 100%;
    height: 4px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 2px;
    overflow: hidden;
}

.strength-fill {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-text {
    font-size: 0.8rem;
    margin-top: 0.25rem;
    text-align: center;
    color: var(--gray-light);
}

/* Clases de fuerza de contraseña */
.strength-weak .strength-fill { width: 25%; background: #dc2626; }
.strength-fair .strength-fill { width: 50%; background: #f59e0b; }
.strength-good .strength-fill { width: 75%; background: #3b82f6; }
.strength-strong .strength-fill { width: 100%; background: var(--primary-green); }

.form-input.valid {
    border-color: var(--primary-green);
    box-shadow: 0 0 0 3px rgba(0, 255, 102, 0.1);
}

.form-input.invalid {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const strengthContainer = document.getElementById('passwordStrength');
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');

    // Validación de contraseña en tiempo real
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        updatePasswordStrength(strength);
    });

    // Validación de confirmación de contraseña
    confirmInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirm = this.value;
        const feedback = document.getElementById('confirmFeedback');
        
        if (confirm === '') {
            this.classList.remove('valid', 'invalid');
            feedback.textContent = '';
            return;
        }
        
        if (password === confirm) {
            this.classList.remove('invalid');
            this.classList.add('valid');
            feedback.textContent = '✓ Las contraseñas coinciden';
            feedback.className = 'input-feedback valid';
        } else {
            this.classList.remove('valid');
            this.classList.add('invalid');
            feedback.textContent = '✗ Las contraseñas no coinciden';
            feedback.className = 'input-feedback invalid';
        }
    });

    // Validación de cédula
    document.getElementById('cedula').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        
        const feedback = document.getElementById('cedulaFeedback');
        if (this.value.length >= 7 && this.value.length <= 10) {
            this.classList.remove('invalid');
            this.classList.add('valid');
            feedback.textContent = '✓ Cédula válida';
            feedback.className = 'input-feedback valid';
        } else if (this.value.length > 0) {
            this.classList.remove('valid');
            this.classList.add('invalid');
            feedback.textContent = '✗ La cédula debe tener entre 7 y 10 dígitos';
            feedback.className = 'input-feedback invalid';
        }
    });

    // Validación de email
    document.getElementById('email').addEventListener('blur', function() {
        const feedback = document.getElementById('emailFeedback');
        if (this.value && this.validity.valid) {
            this.classList.remove('invalid');
            this.classList.add('valid');
            feedback.textContent = '✓ Email válido';
            feedback.className = 'input-feedback valid';
        } else if (this.value) {
            this.classList.remove('valid');
            this.classList.add('invalid');
            feedback.textContent = '✗ Ingresa un email válido';
            feedback.className = 'input-feedback invalid';
        }
    });

    // Validación del formulario
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
        }
    });

    function calculatePasswordStrength(password) {
        let score = 0;
        
        if (password.length >= 6) score += 1;
        if (password.length >= 8) score += 1;
        if (/[a-z]/.test(password)) score += 1;
        if (/[A-Z]/.test(password)) score += 1;
        if (/[0-9]/.test(password)) score += 1;
        if (/[^A-Za-z0-9]/.test(password)) score += 1;
        
        return Math.min(score, 4);
    }

    function updatePasswordStrength(strength) {
        const classes = ['strength-weak', 'strength-fair', 'strength-good', 'strength-strong'];
        const texts = ['Muy débil', 'Débil', 'Buena', 'Fuerte'];
        
        strengthContainer.className = 'password-strength';
        
        if (strength > 0) {
            strengthContainer.classList.add(classes[strength - 1]);
            strengthText.textContent = texts[strength - 1];
        } else {
            strengthText.textContent = 'Escribe una contraseña';
        }
    }

    function validateForm() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;
        
        if (password !== confirm) {
            alert('Las contraseñas no coinciden');
            return false;
        }
        
        if (password.length < 6) {
            alert('La contraseña debe tener al menos 6 caracteres');
            return false;
        }
        
        return true;
    }
});
</script>

<?php
$content = ob_get_clean();
include '../layouts/auth.php';
?>