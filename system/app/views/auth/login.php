<?php
/**
 * Vista de Login - Sistema PRIMERO DE JUNIO
 */

$title = 'Iniciar Sesión';
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
    <h2 class="auth-title">¡Bienvenido!</h2>
    <p class="auth-subtitle">Inicia sesión para acceder al sistema</p>
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

<form class="auth-form" method="POST" action="/system/routes/auth/login">
    <div class="form-group">
        <label for="email" class="form-label">
            <i class="fas fa-envelope"></i>
            Correo Electrónico
        </label>
        <div class="input-group">
            <i class="input-icon fas fa-user"></i>
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
                autocomplete="current-password"
            >
            <button type="button" class="password-toggle" tabindex="-1">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>

    <div class="form-options">
        <div class="checkbox-group">
            <input type="checkbox" id="remember" name="remember" value="1">
            <label for="remember">Recordarme</label>
        </div>
        <a href="/system/app/views/auth/recuperar.php" class="forgot-password">
            ¿Olvidaste tu contraseña?
        </a>
    </div>

    <button type="submit" class="auth-button">
        <i class="fas fa-sign-in-alt"></i>
        Iniciar Sesión
    </button>
</form>

<div class="auth-footer">
    <p>¿No tienes una cuenta? 
        <a href="/system/app/views/auth/registro.php" class="auth-link">Regístrate aquí</a>
    </p>
    
    <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1);">
        <p style="font-size: 0.8rem; opacity: 0.7; margin: 0;">
            <i class="fas fa-shield-alt"></i>
            Sistema seguro desarrollado por <strong>Nexorium</strong>
        </p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación en tiempo real
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    emailInput.addEventListener('blur', function() {
        if (this.value && !this.validity.valid) {
            this.style.borderColor = '#dc2626';
        } else if (this.value) {
            this.style.borderColor = 'var(--primary-green)';
        }
    });
    
    passwordInput.addEventListener('input', function() {
        if (this.value.length >= 6) {
            this.style.borderColor = 'var(--primary-green)';
        } else if (this.value.length > 0) {
            this.style.borderColor = '#dc2626';
        }
    });
});
</script>

<?php
$content = ob_get_clean();
include '../layouts/auth.php';
?>