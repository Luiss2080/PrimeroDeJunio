/**
 * PRIMERO DE JUNIO - FOOTER JAVASCRIPT PROFESIONAL
 * Funcionalidades optimizadas para footer del sistema - Basado en el sitio web
 */

class FooterManager {
    constructor() {
        this.footer = null;
        this.scrollToTopBtn = null;
        this.systemStatus = null;
        this.lastScrollY = 0;
        this.scrollThreshold = 300;
        
        this.init();
    }

    init() {
        this.bindElements();
        this.bindEvents();
        this.updateSystemInfo();
        this.setupScrollToTop();
        this.startSystemMonitoring();
    }

    bindElements() {
        this.footer = document.querySelector('.system-footer');
        this.scrollToTopBtn = document.querySelector('.scroll-to-top');
        this.systemStatus = document.querySelector('.system-status');
    }

    bindEvents() {
        // Scroll to top button
        if (this.scrollToTopBtn) {
            this.scrollToTopBtn.addEventListener('click', () => {
                this.scrollToTop();
            });
        }

        // Enlaces del footer
        const footerLinks = this.footer?.querySelectorAll('a[href^="#"]');
        footerLinks?.forEach(link => {
            link.addEventListener('click', (e) => {
                this.handleInternalLink(e, link);
            });
        });

        // Monitor de scroll
        window.addEventListener('scroll', () => {
            this.handleScroll();
        });

        // Eventos de teclado
        document.addEventListener('keydown', (e) => {
            this.handleKeyboard(e);
        });

        // Eventos de sistema
        this.setupSystemEvents();
    }

    updateSystemInfo() {
        // Actualizar información del sistema
        this.updateVersion();
        this.updateUptime();
        this.updateLastActivity();
        
        // Actualizar cada minuto
        setInterval(() => {
            this.updateUptime();
            this.updateLastActivity();
        }, 60000);
    }

    updateVersion() {
        const versionElement = document.querySelector('.system-version');
        if (versionElement) {
            // Obtener versión del sistema (esto vendría del backend)
            const version = window.systemInfo?.version || '1.0.0';
            versionElement.textContent = `v${version}`;
        }
    }

    updateUptime() {
        const uptimeElement = document.querySelector('.system-uptime');
        if (uptimeElement) {
            // Calcular tiempo de sesión
            const startTime = sessionStorage.getItem('sessionStart') || Date.now();
            const currentTime = Date.now();
            const uptime = currentTime - startTime;
            
            const hours = Math.floor(uptime / (1000 * 60 * 60));
            const minutes = Math.floor((uptime % (1000 * 60 * 60)) / (1000 * 60));
            
            uptimeElement.textContent = `${hours}h ${minutes}m`;
        }
    }

    updateLastActivity() {
        const activityElement = document.querySelector('.last-activity');
        if (activityElement) {
            const now = new Date();
            const timeString = now.toLocaleTimeString('es-ES', {
                hour: '2-digit',
                minute: '2-digit'
            });
            activityElement.textContent = timeString;
        }
    }

    setupScrollToTop() {
        if (!this.scrollToTopBtn) {
            this.createScrollToTopBtn();
        }
    }

    createScrollToTopBtn() {
        this.scrollToTopBtn = document.createElement('button');
        this.scrollToTopBtn.className = 'scroll-to-top';
        this.scrollToTopBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
        this.scrollToTopBtn.setAttribute('aria-label', 'Volver al inicio');
        this.scrollToTopBtn.setAttribute('title', 'Volver al inicio');
        
        document.body.appendChild(this.scrollToTopBtn);
        
        this.scrollToTopBtn.addEventListener('click', () => {
            this.scrollToTop();
        });
    }

    handleScroll() {
        const currentScrollY = window.scrollY;
        
        // Mostrar/ocultar botón scroll to top
        if (currentScrollY > this.scrollThreshold) {
            this.showScrollToTop();
        } else {
            this.hideScrollToTop();
        }
        
        this.lastScrollY = currentScrollY;
    }

    showScrollToTop() {
        if (this.scrollToTopBtn) {
            this.scrollToTopBtn.classList.add('show');
        }
    }

    hideScrollToTop() {
        if (this.scrollToTopBtn) {
            this.scrollToTopBtn.classList.remove('show');
        }
    }

    scrollToTop() {
        const startY = window.scrollY;
        const targetY = 0;
        const distance = startY - targetY;
        const duration = Math.min(800, Math.abs(distance) * 0.5);
        let startTime = null;

        const easeOutCubic = (t) => {
            return 1 - Math.pow(1 - t, 3);
        };

        const animate = (currentTime) => {
            if (startTime === null) startTime = currentTime;
            
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            const ease = easeOutCubic(progress);
            
            window.scrollTo(0, startY - (distance * ease));
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };

        requestAnimationFrame(animate);

        // Efecto visual en el botón
        this.scrollToTopBtn?.classList.add('bounce');
        setTimeout(() => {
            this.scrollToTopBtn?.classList.remove('bounce');
        }, 600);
    }

    handleInternalLink(e, link) {
        const href = link.getAttribute('href');
        
        if (href.startsWith('#')) {
            e.preventDefault();
            
            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                this.smoothScrollTo(targetElement);
            }
        }
    }

    smoothScrollTo(element) {
        const targetY = element.offsetTop - 100; // Offset para header fijo
        
        window.scrollTo({
            top: targetY,
            behavior: 'smooth'
        });
    }

    handleKeyboard(e) {
        // Scroll to top con Ctrl + Home
        if (e.ctrlKey && e.key === 'Home') {
            e.preventDefault();
            this.scrollToTop();
        }
        
        // Ir al footer con Ctrl + End
        if (e.ctrlKey && e.key === 'End') {
            e.preventDefault();
            this.footer?.scrollIntoView({ behavior: 'smooth' });
        }
    }

    setupSystemEvents() {
        // Guardar tiempo de inicio de sesión
        if (!sessionStorage.getItem('sessionStart')) {
            sessionStorage.setItem('sessionStart', Date.now().toString());
        }

        // Detectar inactividad
        let inactivityTimer;
        const resetTimer = () => {
            clearTimeout(inactivityTimer);
            this.updateLastActivity();
            
            inactivityTimer = setTimeout(() => {
                this.handleInactivity();
            }, 30 * 60 * 1000); // 30 minutos
        };

        // Eventos que indican actividad
        ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(event => {
            document.addEventListener(event, resetTimer, true);
        });

        resetTimer();
    }

    handleInactivity() {
        // Mostrar mensaje de inactividad
        this.showInactivityWarning();
    }

    showInactivityWarning() {
        const warning = document.createElement('div');
        warning.className = 'inactivity-warning';
        warning.innerHTML = `
            <div class="warning-content">
                <i class="fas fa-clock"></i>
                <h3>Sesión inactiva</h3>
                <p>Tu sesión ha estado inactiva por 30 minutos.</p>
                <div class="warning-actions">
                    <button class="btn-continue">Continuar sesión</button>
                    <button class="btn-logout">Cerrar sesión</button>
                </div>
            </div>
        `;
        
        document.body.appendChild(warning);
        
        // Eventos de los botones
        warning.querySelector('.btn-continue')?.addEventListener('click', () => {
            warning.remove();
        });
        
        warning.querySelector('.btn-logout')?.addEventListener('click', () => {
            window.location.href = '/auth/logout.php';
        });
        
        // Auto-cerrar después de 5 minutos
        setTimeout(() => {
            if (document.body.contains(warning)) {
                window.location.href = '/auth/logout.php';
            }
        }, 5 * 60 * 1000);
    }

    startSystemMonitoring() {
        // Monitor de rendimiento del sistema
        this.updateSystemStats();
        
        setInterval(() => {
            this.updateSystemStats();
        }, 5000);
    }

    updateSystemStats() {
        // Obtener estadísticas de rendimiento
        if ('memory' in performance) {
            const memInfo = performance.memory;
            const memUsage = (memInfo.usedJSHeapSize / memInfo.totalJSHeapSize * 100).toFixed(1);
            
            // Actualizar indicador si existe
            const memElement = document.querySelector('.memory-usage');
            if (memElement) {
                memElement.textContent = `${memUsage}%`;
            }
        }
        
        // Monitor de conexión
        this.updateConnectionQuality();
    }

    updateConnectionQuality() {
        const statusElement = document.querySelector('.connection-status');
        if (!statusElement) return;

        const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        
        if (connection) {
            const effectiveType = connection.effectiveType || 'unknown';
            const downlink = connection.downlink || 0;
            
            let quality = 'good';
            if (downlink < 1) quality = 'poor';
            else if (downlink < 5) quality = 'fair';
            
            statusElement.className = `connection-status ${quality}`;
            statusElement.textContent = effectiveType.toUpperCase();
        }
    }
}

// CSS adicional dinámico
const footerStyles = `
.inactivity-warning {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
    z-index: 2000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease-out;
}

.warning-content {
    background: rgba(26, 29, 41, 0.95);
    border: 1px solid rgba(0, 255, 102, 0.2);
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    max-width: 400px;
    animation: slideUp 0.3s ease-out;
}

.warning-content i {
    font-size: 48px;
    color: #ff9800;
    margin-bottom: 20px;
}

.warning-content h3 {
    color: var(--white);
    font-size: 24px;
    margin-bottom: 15px;
}

.warning-content p {
    color: var(--gray-light);
    margin-bottom: 30px;
}

.warning-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.warning-actions button {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition-fast);
}

.btn-continue {
    background: var(--gradient-primary);
    color: var(--white);
}

.btn-logout {
    background: transparent;
    color: var(--gray-light);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-continue:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 255, 102, 0.3);
}

.btn-logout:hover {
    color: #ff4444;
    border-color: #ff4444;
}

.connection-status {
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 600;
}

.connection-status.good {
    background: rgba(0, 255, 102, 0.1);
    color: var(--primary-green);
}

.connection-status.fair {
    background: rgba(255, 152, 0, 0.1);
    color: #ff9800;
}

.connection-status.poor {
    background: rgba(255, 68, 68, 0.1);
    color: #ff4444;
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .warning-content {
        margin: 20px;
        padding: 30px 20px;
    }
    
    .warning-actions {
        flex-direction: column;
    }
}
`;

// Inyectar estilos adicionales
const styleSheet = document.createElement('style');
styleSheet.textContent = footerStyles;
document.head.appendChild(styleSheet);

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new FooterManager();
});

// Exportar para uso global si es necesario
window.FooterManager = FooterManager;