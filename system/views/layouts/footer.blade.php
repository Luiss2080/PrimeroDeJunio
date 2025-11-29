{{-- Footer del Sistema - Asociación 1ro de Junio --}}
<footer class="system-footer" id="systemFooter">
    <div class="footer-container">
        
        <!-- Contenido Principal del Footer -->
        <div class="footer-content">
            
            <!-- Información del Sistema -->
            <div class="footer-section system-info">
                <h3 class="footer-title">Sistema Administrativo</h3>
                <p class="system-description">
                    Plataforma integral para la gestión de la Asociación 1ro de Junio. 
                    Administra conductores, vehículos y operaciones de manera eficiente.
                </p>
                
                <!-- Enlaces del Sistema -->
                <div class="system-links">
                    <a href="{{ route('dashboard') }}" class="system-link">
                        <div class="system-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                            </svg>
                        </div>
                        Dashboard
                    </a>
                    <a href="{{ route('reportes.index') }}" class="system-link">
                        <div class="system-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                            </svg>
                        </div>
                        Reportes
                    </a>
                    <a href="{{ route('configuraciones.index') }}" class="system-link">
                        <div class="system-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                            </svg>
                        </div>
                        Configuración
                    </a>
                </div>
            </div>
            
            <!-- Estadísticas Rápidas -->
            <div class="footer-section stats-section">
                <h3 class="footer-title">Estadísticas</h3>
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\Conductor::count() }}</span>
                            <span class="stat-label">Conductores</span>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\Vehiculo::count() }}</span>
                            <span class="stat-label">Vehículos</span>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2.01.99L12 11l-1.99-2.01A2.5 2.5 0 0 0 8 8H5.46c-.8 0-1.49.59-1.42 1.37L6 16.5V22h2v-6h2v6h8z"/>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\Cliente::count() }}</span>
                            <span class="stat-label">Clientes</span>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2.01.99L12 11l-1.99-2.01A2.5 2.5 0 0 0 8 8H5.46c-.8 0-1.49.59-1.42 1.37L6 16.5V22h2v-6h2v6h8z"/>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\User::count() }}</span>
                            <span class="stat-label">Usuarios</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Información de la Asociación -->
            <div class="footer-section association-info">
                <div class="association-logo">
                    <img src="{{ asset('images/LogoAsociacion.png') }}" alt="Logo Asociación" class="footer-logo-image">
                    <div class="association-text">
                        <h3 class="association-name">ASOCIACIÓN 1RO DE JUNIO</h3>
                        <p class="association-tagline">Mototaxis Confiables</p>
                    </div>
                </div>
                
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <span>Santa Cruz, Bolivia</span>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <span>info@primero1dejunio.com</span>
                    </div>
                </div>
                
                <!-- Estado del Sistema -->
                <div class="system-status">
                    <div class="status-indicator online">
                        <div class="status-dot"></div>
                        <span class="status-text">Sistema Operativo</span>
                    </div>
                    <div class="last-update">
                        <span>Última actualización: {{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Información Técnica -->
        <div class="tech-info">
            <div class="tech-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span>Seguro</span>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span>Rápido</span>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <span>Confiable</span>
                </div>
            </div>
            
            <!-- Versión del Sistema -->
            <div class="version-info">
                <span class="version-badge">v{{ config('app.version', '1.0.0') }}</span>
                <span class="build-info">Build #2025.1</span>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-copyright">
                <span>&copy; {{ date('Y') }} Asociación 1ro de Junio. Todos los derechos reservados.</span>
            </div>
            
            <div class="footer-links">
                <a href="#privacy" class="footer-link">Política de Privacidad</a>
                <span class="separator">|</span>
                <a href="#terms" class="footer-link">Términos de Uso</a>
                <span class="separator">|</span>
                <a href="#help" class="footer-link">Ayuda</a>
            </div>
            
            <!-- Tiempo de sesión -->
            <div class="session-info">
                <div class="session-time">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                        <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                    </svg>
                    <span id="sessionTime">Sesión activa</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Botón Scroll to Top -->
    <button class="scroll-to-top" id="scrollToTop">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
            <path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
        </svg>
    </button>
</footer>

<!-- Incluir CSS del Footer -->
<link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">

<!-- Incluir JS del Footer -->
<script src="{{ asset('js/components/footer.js') }}"></script>