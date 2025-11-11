<?php
/**
 * Vista Perfil Usuario - Sistema PRIMERO DE JUNIO
 */

$title = 'Perfil de Usuario';
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
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="title-content">
                        <span class="title-main">Perfil de Usuario</span>
                        <span class="title-subtitle"><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?></span>
                    </div>
                </h1>
            </div>
            <div class="header-right">
                <div class="header-actions">
                    <a href="/admin/usuarios/editar/<?= $usuario['id'] ?>" class="btn-modern btn-primary">
                        <span class="btn-icon"><i class="fas fa-edit"></i></span>
                        <span class="btn-text">Editar Usuario</span>
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

<!-- Profile Content -->
<div class="container-modern">
    <div class="profile-grid-modern">
        <!-- User Card -->
        <div class="system-card-modern profile-main-card" data-aos="fade-up" data-aos-delay="100">
            <div class="system-card-background">
                <div class="profile-header-modern">
                    <div class="profile-avatar-section">
                        <div class="profile-avatar-large">
                            <?php if (!empty($usuario['avatar'])): ?>
                                <img src="<?= htmlspecialchars($usuario['avatar']) ?>" alt="Avatar">
                            <?php else: ?>
                                <div class="avatar-placeholder-xl">
                                    <?= strtoupper(substr($usuario['nombre'], 0, 1) . substr($usuario['apellido'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="profile-status-indicator <?= $usuario['estado'] ?>">
                            <i class="fas fa-circle"></i>
                        </div>
                    </div>
                    
                    <div class="profile-basic-info">
                        <h2><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?></h2>
                        <p class="profile-email"><?= htmlspecialchars($usuario['email']) ?></p>
                        <div class="profile-badges">
                            <span class="role-badge-modern <?= strtolower($usuario['rol_nombre'] ?? 'usuario') ?>">
                                <i class="fas fa-user-tag"></i>
                                <?= htmlspecialchars($usuario['rol_nombre'] ?? 'Usuario') ?>
                            </span>
                            <span class="status-badge-modern <?= $usuario['estado'] ?>">
                                <i class="fas fa-circle"></i>
                                <?= ucfirst($usuario['estado']) ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="profile-actions-modern">
                    <?php if ($usuario['estado'] === 'activo'): ?>
                        <button class="btn-modern btn-sm btn-warning" 
                                onclick="toggleUserStatus(<?= $usuario['id'] ?>, 'desactivar')">
                            <span class="btn-icon"><i class="fas fa-user-slash"></i></span>
                            <span class="btn-text">Desactivar</span>
                        </button>
                    <?php else: ?>
                        <button class="btn-modern btn-sm btn-success" 
                                onclick="toggleUserStatus(<?= $usuario['id'] ?>, 'activar')">
                            <span class="btn-icon"><i class="fas fa-user-check"></i></span>
                            <span class="btn-text">Activar</span>
                        </button>
                    <?php endif; ?>
                    
                    <button class="btn-modern btn-sm btn-info" onclick="changePassword(<?= $usuario['id'] ?>)">
                        <span class="btn-icon"><i class="fas fa-key"></i></span>
                        <span class="btn-text">Cambiar Password</span>
                    </button>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Contact Information -->
        <div class="system-card-modern" data-aos="fade-up" data-aos-delay="200">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <span>Información de Contacto</span>
                    </div>
                </div>
                
                <div class="card-content-modern">
                    <div class="info-grid-modern">
                        <div class="info-item-modern">
                            <div class="info-icon-modern">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-content-modern">
                                <span class="info-label-modern">Teléfono Principal</span>
                                <span class="info-value-modern">
                                    <?= htmlspecialchars($usuario['telefono'] ?: 'No registrado') ?>
                                </span>
                            </div>
                        </div>
                        
                        <?php if (!empty($perfil['telefono_personal'])): ?>
                            <div class="info-item-modern">
                                <div class="info-icon-modern">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="info-content-modern">
                                    <span class="info-label-modern">Teléfono Personal</span>
                                    <span class="info-value-modern">
                                        <?= htmlspecialchars($perfil['telefono_personal']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="info-item-modern">
                            <div class="info-icon-modern">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content-modern">
                                <span class="info-label-modern">Email</span>
                                <span class="info-value-modern">
                                    <?= htmlspecialchars($usuario['email']) ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="info-item-modern">
                            <div class="info-icon-modern">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content-modern">
                                <span class="info-label-modern">Dirección</span>
                                <span class="info-value-modern">
                                    <?= htmlspecialchars($usuario['direccion'] ?: 'No registrada') ?>
                                </span>
                            </div>
                        </div>
                        
                        <?php if (!empty($perfil['direccion_residencia'])): ?>
                            <div class="info-item-modern">
                                <div class="info-icon-modern">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="info-content-modern">
                                    <span class="info-label-modern">Dirección de Residencia</span>
                                    <span class="info-value-modern">
                                        <?= htmlspecialchars($perfil['direccion_residencia']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Personal Information -->
        <div class="system-card-modern" data-aos="fade-up" data-aos-delay="300">
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
                    <div class="info-grid-modern">
                        <div class="info-item-modern">
                            <div class="info-icon-modern">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="info-content-modern">
                                <span class="info-label-modern">Fecha de Nacimiento</span>
                                <span class="info-value-modern">
                                    <?php if ($usuario['fecha_nacimiento']): ?>
                                        <?= date('d/m/Y', strtotime($usuario['fecha_nacimiento'])) ?>
                                        <small>(<?= date_diff(date_create($usuario['fecha_nacimiento']), date_create('today'))->y ?> años)</small>
                                    <?php else: ?>
                                        No registrada
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        
                        <?php if (!empty($perfil['tipo_sangre'])): ?>
                            <div class="info-item-modern">
                                <div class="info-icon-modern">
                                    <i class="fas fa-tint"></i>
                                </div>
                                <div class="info-content-modern">
                                    <span class="info-label-modern">Tipo de Sangre</span>
                                    <span class="info-value-modern blood-type">
                                        <?= htmlspecialchars($perfil['tipo_sangre']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="info-item-modern">
                            <div class="info-icon-modern">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div class="info-content-modern">
                                <span class="info-label-modern">Fecha de Registro</span>
                                <span class="info-value-modern">
                                    <?= date('d/m/Y H:i', strtotime($usuario['created_at'] ?? 'now')) ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="info-item-modern">
                            <div class="info-icon-modern">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content-modern">
                                <span class="info-label-modern">Último Acceso</span>
                                <span class="info-value-modern">
                                    <?php if ($usuario['ultimo_acceso']): ?>
                                        <?= date('d/m/Y H:i', strtotime($usuario['ultimo_acceso'])) ?>
                                    <?php else: ?>
                                        <span class="text-muted">Nunca ha ingresado</span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Emergency Contact -->
        <?php if (!empty($perfil['contacto_emergencia_nombre']) || !empty($perfil['contacto_emergencia_telefono'])): ?>
            <div class="system-card-modern" data-aos="fade-up" data-aos-delay="400">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <span>Contacto de Emergencia</span>
                        </div>
                    </div>
                    
                    <div class="card-content-modern">
                        <div class="emergency-contact-modern">
                            <div class="emergency-icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="emergency-info">
                                <h4><?= htmlspecialchars($perfil['contacto_emergencia_nombre']) ?></h4>
                                <p>
                                    <i class="fas fa-phone"></i>
                                    <?= htmlspecialchars($perfil['contacto_emergencia_telefono']) ?>
                                </p>
                                <a href="tel:<?= htmlspecialchars($perfil['contacto_emergencia_telefono']) ?>" 
                                   class="btn-modern btn-sm btn-danger">
                                    <span class="btn-icon"><i class="fas fa-phone"></i></span>
                                    <span class="btn-text">Llamar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        <?php endif; ?>

        <!-- Activity & Statistics -->
        <div class="system-card-modern" data-aos="fade-up" data-aos-delay="500">
            <div class="system-card-background">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <div class="title-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span>Estadísticas de Actividad</span>
                    </div>
                </div>
                
                <div class="card-content-modern">
                    <div class="stats-modern">
                        <div class="stat-card-compact">
                            <div class="stat-icon-compact">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="stat-info-compact">
                                <span class="stat-number-compact">0</span>
                                <span class="stat-label-compact">Inicios de Sesión</span>
                            </div>
                        </div>
                        
                        <div class="stat-card-compact">
                            <div class="stat-icon-compact">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                            <div class="stat-info-compact">
                                <span class="stat-number-compact">
                                    <?= isset($usuario['created_at']) ? date_diff(date_create($usuario['created_at']), date_create('today'))->days : 0 ?>
                                </span>
                                <span class="stat-label-compact">Días en el Sistema</span>
                            </div>
                        </div>
                        
                        <?php if (strtolower($usuario['rol_nombre'] ?? '') === 'conductor'): ?>
                            <div class="stat-card-compact">
                                <div class="stat-icon-compact">
                                    <i class="fas fa-route"></i>
                                </div>
                                <div class="stat-info-compact">
                                    <span class="stat-number-compact">0</span>
                                    <span class="stat-label-compact">Viajes Realizados</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="system-card-glow"></div>
        </div>

        <!-- Notes & Observations -->
        <?php if (!empty($perfil['observaciones'])): ?>
            <div class="system-card-modern full-width" data-aos="fade-up" data-aos-delay="600">
                <div class="system-card-background">
                    <div class="card-header-modern">
                        <div class="card-title-modern">
                            <div class="title-icon">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                            <span>Observaciones</span>
                        </div>
                    </div>
                    
                    <div class="card-content-modern">
                        <div class="observations-content">
                            <?= nl2br(htmlspecialchars($perfil['observaciones'])) ?>
                        </div>
                    </div>
                </div>
                <div class="system-card-glow"></div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal-modern" id="changePasswordModal">
    <div class="modal-overlay-modern" onclick="closeModal('changePasswordModal')"></div>
    <div class="modal-content-modern">
        <div class="modal-header-modern">
            <h3>Cambiar Contraseña</h3>
            <button class="modal-close-modern" onclick="closeModal('changePasswordModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form class="modal-body-modern" method="POST" action="/admin/usuarios/cambiar-password/<?= $usuario['id'] ?>" id="changePasswordForm">
            <div class="form-group-modern">
                <label class="form-label-modern">
                    <i class="fas fa-lock"></i>
                    Nueva Contraseña
                </label>
                <div class="input-group-modern">
                    <input type="password" 
                           class="form-input-modern" 
                           name="password_nuevo" 
                           required
                           placeholder="Nueva contraseña..."
                           id="newPassword">
                    <button type="button" 
                            class="input-group-btn-modern" 
                            onclick="togglePasswordModal('newPassword')">
                        <i class="fas fa-eye" id="newPassword-icon"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-group-modern">
                <label class="form-label-modern">
                    <i class="fas fa-lock"></i>
                    Confirmar Contraseña
                </label>
                <div class="input-group-modern">
                    <input type="password" 
                           class="form-input-modern" 
                           name="password_confirmar" 
                           required
                           placeholder="Confirmar contraseña..."
                           id="confirmPassword">
                    <button type="button" 
                            class="input-group-btn-modern" 
                            onclick="togglePasswordModal('confirmPassword')">
                        <i class="fas fa-eye" id="confirmPassword-icon"></i>
                    </button>
                </div>
            </div>
            
            <div class="modal-actions-modern">
                <button type="button" class="btn-modern btn-outline" onclick="closeModal('changePasswordModal')">
                    Cancelar
                </button>
                <button type="submit" class="btn-modern btn-primary">
                    <span class="btn-icon"><i class="fas fa-save"></i></span>
                    <span class="btn-text">Cambiar Contraseña</span>
                </button>
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

    // Change password form validation
    const changePasswordForm = document.getElementById('changePasswordForm');
    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (newPassword !== confirmPassword) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Las contraseñas no coinciden'
                    });
                } else {
                    alert('Las contraseñas no coinciden');
                }
                return;
            }
            
            if (newPassword.length < 6) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La contraseña debe tener al menos 6 caracteres'
                    });
                } else {
                    alert('La contraseña debe tener al menos 6 caracteres');
                }
                return;
            }
            
            this.submit();
        });
    }

    console.log('User profile initialized');
});

// Toggle user status
function toggleUserStatus(userId, action) {
    if (typeof Swal !== 'undefined') {
        const actionText = action === 'activar' ? 'activar' : 'desactivar';
        const confirmText = action === 'activar' ? 'Activar' : 'Desactivar';
        
        Swal.fire({
            title: `¿${confirmText} usuario?`,
            text: `¿Estás seguro de que deseas ${actionText} este usuario?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: action === 'activar' ? '#22c55e' : '#f59e0b'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/usuarios/${action}/${userId}`;
            }
        });
    } else {
        if (confirm(`¿Estás seguro de que deseas ${actionText} este usuario?`)) {
            window.location.href = `/admin/usuarios/${action}/${userId}`;
        }
    }
}

// Change password modal
function changePassword(userId) {
    openModal('changePasswordModal');
}

// Modal functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('active');
    document.body.style.overflow = '';
    
    // Reset form if exists
    const form = modal.querySelector('form');
    if (form) {
        form.reset();
    }
}

// Toggle password visibility in modal
function togglePasswordModal(fieldId) {
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
</script>

<style>
/* Estilos específicos para el perfil de usuario */
.profile-grid-modern {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.profile-main-card {
    grid-column: 1 / -1;
}

.profile-header-modern {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
}

.profile-avatar-section {
    position: relative;
}

.profile-avatar-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid var(--primary-green);
}

.profile-avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder-xl {
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
    bottom: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid var(--card-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
}

.profile-status-indicator.activo {
    background: var(--success-color);
    color: white;
}

.profile-status-indicator.inactivo {
    background: var(--error-color);
    color: white;
}

.profile-status-indicator.pendiente {
    background: var(--warning-color);
    color: white;
}

.profile-basic-info {
    flex: 1;
}

.profile-basic-info h2 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.profile-email {
    font-size: 1.1rem;
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.profile-badges {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.profile-actions-modern {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.info-grid-modern {
    display: grid;
    gap: 1rem;
}

.info-item-modern {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--card-hover-bg);
    border-radius: 8px;
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
}

.info-item-modern:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
}

.info-icon-modern {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: rgba(0, 255, 102, 0.1);
    border: 1px solid rgba(0, 255, 102, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-green);
    flex-shrink: 0;
}

.info-content-modern {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.info-label-modern {
    font-size: 0.8rem;
    color: var(--text-secondary);
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.info-value-modern {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 0.95rem;
}

.info-value-modern small {
    color: var(--text-secondary);
    font-weight: 400;
    margin-left: 0.5rem;
}

.blood-type {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error-color);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-weight: 700;
    display: inline-block;
}

.emergency-contact-modern {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
    background: rgba(239, 68, 68, 0.05);
    border: 1px solid rgba(239, 68, 68, 0.1);
    border-radius: 8px;
}

.emergency-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--error-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.emergency-info {
    flex: 1;
}

.emergency-info h4 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.emergency-info p {
    color: var(--text-secondary);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stats-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.stat-card-compact {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--card-hover-bg);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.stat-card-compact:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
}

.stat-icon-compact {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.stat-info-compact {
    display: flex;
    flex-direction: column;
}

.stat-number-compact {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.stat-label-compact {
    font-size: 0.8rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.observations-content {
    padding: 1.5rem;
    background: var(--card-hover-bg);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    color: var(--text-secondary);
    line-height: 1.6;
}

.full-width {
    grid-column: 1 / -1;
}

.text-muted {
    color: var(--text-secondary);
    font-style: italic;
}

/* Modal styles */
.modal-modern {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
}

.modal-modern.active {
    display: flex;
}

.modal-overlay-modern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-content-modern {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    z-index: 1;
}

.modal-header-modern {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-color);
}

.modal-header-modern h3 {
    color: var(--text-primary);
    margin: 0;
}

.modal-close-modern {
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    font-size: 1.2rem;
    padding: 0.5rem;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.modal-close-modern:hover {
    color: var(--error-color);
    background: rgba(239, 68, 68, 0.1);
}

.modal-body-modern {
    padding: 1.5rem;
}

.modal-actions-modern {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

/* Responsive design */
@media (max-width: 1024px) {
    .profile-grid-modern {
        grid-template-columns: 1fr;
    }
    
    .stats-modern {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .profile-header-modern {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .profile-badges {
        justify-content: center;
    }
    
    .profile-actions-modern {
        flex-direction: column;
        align-items: center;
    }
    
    .emergency-contact-modern {
        flex-direction: column;
        text-align: center;
    }
    
    .modal-content-modern {
        width: 95%;
        margin: 1rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include '../../layouts/main.php';
?>