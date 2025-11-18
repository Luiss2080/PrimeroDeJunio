<?php
/**
 * Footer del Sistema - PRIMERO DE JUNIO
 * Componente independiente de footer moderno
 */

// Solo incluir si no está ya incluido
if (!defined('FOOTER_INCLUDED')) {
    define('FOOTER_INCLUDED', true);
    
    // Incluir estilos CSS del footer
    echo '<link rel="stylesheet" href="/PrimeroDeJunio/system/public/assets/css/footer.css">';
    
    // Obtener año actual
    $current_year = date('Y');
?>

<footer class="system-footer" id="systemFooter">
    <div class="footer-wrapper">
        
        <!-- Contenido Principal del Footer -->
        <div class="footer-main">
            <div class="footer-container">
                
                <!-- Sección de Información de la Empresa -->
                <div class="footer-section footer-brand">
                    <div class="footer-logo">
                        <img src="/PrimeroDeJunio/system/public/assets/images/logoMoto.jpg" 
                             alt="Primero de Junio" 
                             class="footer-logo-image">
                        <div class="footer-logo-text">
                            <span class="footer-logo-name">Primero de Junio</span>
                            <span class="footer-logo-tagline">Sistema de Gestión de Mototaxis</span>
                        </div>
                    </div>
                    
                    <div class="company-description">
                        Plataforma integral para la gestión eficiente de servicios de mototaxis, 
                        facilitando el control de conductores, vehículos, viajes y tarifas con 
                        tecnología moderna y segura.
                    </div>
                    
                    <div class="version-info">
                        <div class="version-badge">
                            <i class="fas fa-code"></i>
                            <span class="version-text">Sistema v1.0</span>
                        </div>
                        
                        <div class="build-info">
                            <i class="fas fa-hammer"></i>
                            <span class="build-text">Build #<?= $current_year ?>.1</span>
                        </div>
                    </div>
                </div>

                <!-- Sección de Enlaces del Sistema -->
                <div class="footer-section footer-system">
                    <h3 class="footer-title">Sistema</h3>
                    <div class="footer-links">
                        <a href="/PrimeroDeJunio/system/public/index.php/admin" class="system-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                        
                        <a href="/PrimeroDeJunio/system/public/index.php/admin/usuarios" class="system-link">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                        
                        <a href="/PrimeroDeJunio/system/public/index.php/admin/conductores" class="system-link">
                            <i class="fas fa-motorcycle"></i>
                            <span>Conductores</span>
                        </a>
                        
                        <a href="/PrimeroDeJunio/system/public/index.php/admin/vehiculos" class="system-link">
                            <i class="fas fa-car"></i>
                            <span>Vehículos</span>
                        </a>
                        
                        <a href="/PrimeroDeJunio/system/public/index.php/admin/viajes" class="system-link">
                            <i class="fas fa-route"></i>
                            <span>Viajes</span>
                        </a>
                        
                        <a href="/PrimeroDeJunio/system/public/index.php/admin/reportes" class="system-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reportes</span>
                        </a>
                    </div>
                </div>

                <!-- Sección de Información Técnica -->
                <div class="footer-section footer-tech">
                    <h3 class="footer-title">Información Técnica</h3>
                    <div class="tech-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="feature-content">
                                <span class="feature-name">Seguridad Avanzada</span>
                                <span class="feature-desc">Autenticación y encriptación</span>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-cloud"></i>
                            </div>
                            <div class="feature-content">
                                <span class="feature-name">Base de Datos</span>
                                <span class="feature-desc">MySQL con respaldo automático</span>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="feature-content">
                                <span class="feature-name">Responsive Design</span>
                                <span class="feature-desc">Compatible con dispositivos móviles</span>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="feature-content">
                                <span class="feature-name">Analytics</span>
                                <span class="feature-desc">Reportes en tiempo real</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie de Página Inferior -->
        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <div class="footer-copyright">
                    <span>&copy; <?= $current_year ?> Primero de Junio. Todos los derechos reservados.</span>
                </div>
                
                <div class="footer-links-bottom">
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/ayuda" class="footer-link">
                        <i class="fas fa-question-circle"></i>
                        Ayuda
                    </a>
                    
                    <span class="footer-separator">•</span>
                    
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/soporte" class="footer-link">
                        <i class="fas fa-life-ring"></i>
                        Soporte
                    </a>
                    
                    <span class="footer-separator">•</span>
                    
                    <a href="/PrimeroDeJunio/system/public/index.php/admin/configuracion" class="footer-link">
                        <i class="fas fa-cog"></i>
                        Configuración
                    </a>
                </div>
                
                <div class="footer-status">
                    <div class="system-status online" title="Sistema operativo">
                        <i class="fas fa-circle"></i>
                        <span>Sistema Operativo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Botón Scroll to Top -->
    <button class="scroll-to-top" id="scrollToTop" aria-label="Volver arriba">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<script src="/PrimeroDeJunio/system/public/assets/js/footer.js"></script>

<?php } // Fin del if FOOTER_INCLUDED ?>
