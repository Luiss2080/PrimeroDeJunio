<?php
/**
 * Vista de Recuperar Contraseña - Sistema PRIMERO DE JUNIO
 */

$title = 'Recuperar Contraseña';
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
    <h2 class="auth-title">Recuperar Contraseña</h2>
    <p class="auth-subtitle">Te enviaremos un enlace para restablecer tu contraseña</p>
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

<form class="auth-form" method="POST" action="/system/routes/auth/recover" id="recoverForm">
    <div class="form-group">
        <label for="email" class="form-label">
            <i class="fas fa-envelope"></i>
            Correo Electrónico Registrado
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-envelope"></i>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-input" 
                placeholder="conductor@ejemplo.com"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required
                autocomplete="email"
            >
        </div>
        <div class="input-help">
            <i class="fas fa-info-circle"></i>
            Ingresa el email que usaste al registrarte
        </div>
    </div>

    <button type="submit" class="auth-button" id="submitBtn">
        <i class="fas fa-paper-plane"></i>
        Enviar Enlace de Recuperación
    </button>
</form>

<div class="auth-footer">
    <p>¿Recordaste tu contraseña? 
        <a href="/system/app/views/auth/login.php" class="auth-link">Inicia sesión aquí</a>
    </p>
    
    <p>¿No tienes una cuenta? 
        <a href="/system/app/views/auth/registro.php" class="auth-link">Regístrate aquí</a>
    </p>
    
    <div style="margin-top: 1.5rem;">
        <div class="alert alert-info" style="margin-bottom: 0;">
            <i class="fas fa-shield-alt"></i>
            <strong>Seguridad:</strong> El enlace de recuperación expirará en 1 hora por tu seguridad.
        </div>
    </div>
</div>

<style>
.input-help {
    font-size: 0.8rem;
    color: var(--gray-light);
    margin-top: 0.5rem;
    padding-left: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.input-help i {
    color: var(--primary-green);
    opacity: 0.7;
}

.recovery-info {
    background: rgba(0, 255, 102, 0.1);
    border: 1px solid rgba(0, 255, 102, 0.3);
    border-radius: 12px;
    padding: 1.5rem;
    margin: 1.5rem 0;
    text-align: center;
}

.recovery-info h3 {
    color: var(--primary-green);
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.recovery-info p {
    color: var(--gray-light);
    font-size: 0.9rem;
    margin: 0.5rem 0;
}

.recovery-steps {
    text-align: left;
    margin-top: 1rem;
}

.recovery-steps ol {
    color: var(--gray-light);
    font-size: 0.9rem;
    padding-left: 1.5rem;
}

.recovery-steps li {
    margin: 0.5rem 0;
}

.contact-support {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
}

.support-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-green);
    text-decoration: none;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border: 1px solid var(--primary-green);
    border-radius: 8px;
    transition: var(--transition-fast);
}

.support-link:hover {
    background: rgba(0, 255, 102, 0.1);
    transform: translateY(-2px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('recoverForm');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('email');

    // Validación de email
    emailInput.addEventListener('blur', function() {
        if (this.value && this.validity.valid) {
            this.style.borderColor = 'var(--primary-green)';
        } else if (this.value) {
            this.style.borderColor = '#dc2626';
        }
    });

    // Manejo del formulario
    form.addEventListener('submit', function(e) {
        const email = emailInput.value.trim();
        
        if (!email) {
            e.preventDefault();
            showMessage('Por favor, ingresa tu correo electrónico', 'error');
            return;
        }
        
        if (!emailInput.validity.valid) {
            e.preventDefault();
            showMessage('Por favor, ingresa un correo electrónico válido', 'error');
            return;
        }
        
        // Cambiar estado del botón
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading"></span> Enviando...';
        
        // Mostrar información de recuperación
        setTimeout(() => {
            showRecoveryInfo();
        }, 1000);
    });

    function showMessage(message, type = 'info') {
        // Remover alertas existentes
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        // Crear nueva alerta
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.innerHTML = `
            <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
            ${message}
        `;
        
        // Insertar antes del formulario
        const authHeader = document.querySelector('.auth-header');
        authHeader.insertAdjacentElement('afterend', alert);
        
        // Auto-remover después de 5 segundos
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }

    function showRecoveryInfo() {
        const form = document.querySelector('.auth-form');
        const recoveryInfo = document.createElement('div');
        recoveryInfo.className = 'recovery-info';
        recoveryInfo.innerHTML = `
            <h3><i class="fas fa-envelope"></i> Correo Enviado</h3>
            <p>Hemos enviado un enlace de recuperación a tu correo electrónico.</p>
            
            <div class="recovery-steps">
                <p><strong>Sigue estos pasos:</strong></p>
                <ol>
                    <li>Revisa tu bandeja de entrada</li>
                    <li>Busca un email de "Primero de Junio"</li>
                    <li>Haz clic en el enlace de recuperación</li>
                    <li>Crea una nueva contraseña segura</li>
                </ol>
            </div>
            
            <p style="margin-top: 1rem;">
                <i class="fas fa-clock"></i>
                <strong>Importante:</strong> El enlace expirará en 1 hora.
            </p>
        `;
        
        form.style.display = 'none';
        form.insertAdjacentElement('afterend', recoveryInfo);
        
        // Agregar enlace de soporte
        const contactSupport = document.createElement('div');
        contactSupport.className = 'contact-support';
        contactSupport.innerHTML = `
            <p style="margin-bottom: 1rem; color: var(--gray-light);">
                ¿No recibiste el correo?
            </p>
            <a href="#" class="support-link" onclick="showForm()">
                <i class="fas fa-redo"></i>
                Reenviar Correo
            </a>
            <div style="margin-top: 1rem;">
                <a href="mailto:soporte@primero1dejunio.com" class="support-link">
                    <i class="fas fa-headset"></i>
                    Contactar Soporte
                </a>
            </div>
        `;
        
        recoveryInfo.insertAdjacentElement('afterend', contactSupport);
    }

    // Función global para mostrar el formulario nuevamente
    window.showForm = function() {
        const recoveryInfo = document.querySelector('.recovery-info');
        const contactSupport = document.querySelector('.contact-support');
        const form = document.querySelector('.auth-form');
        
        if (recoveryInfo) recoveryInfo.remove();
        if (contactSupport) contactSupport.remove();
        
        form.style.display = 'block';
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar Enlace de Recuperación';
    };
});
</script>

<?php
$content = ob_get_clean();
include '../layouts/auth.php';
?>