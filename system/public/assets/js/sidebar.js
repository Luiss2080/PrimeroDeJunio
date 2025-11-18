/**
 * PRIMERO DE JUNIO - SIDEBAR JAVASCRIPT PROFESIONAL
 * Funcionalidades optimizadas para sidebar del sistema - Basado en el sitio web
 */

class SidebarManager {
    constructor() {
        this.sidebar = null;
        this.overlay = null;
        this.navLinks = [];
        this.currentPath = window.location.pathname;
        this.isCollapsed = false;
        this.isMobile = window.innerWidth <= 768;
        
        this.init();
    }

    init() {
        this.bindElements();
        this.bindEvents();
        this.setActiveMenuItem();
        this.updateUserInfo();
        this.setupTooltips();
        this.handleResponsive();
    }

    bindElements() {
        this.sidebar = document.querySelector('.system-sidebar');
        this.overlay = document.querySelector('.sidebar-overlay');
        this.navLinks = document.querySelectorAll('.nav-link');
    }

    bindEvents() {
        // Enlaces de navegación
        this.navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                this.handleNavClick(e, link);
            });
        });

        // Overlay para cerrar en móvil
        if (this.overlay) {
            this.overlay.addEventListener('click', () => {
                this.closeSidebar();
            });
        }

        // Scroll en sidebar
        if (this.sidebar) {
            this.sidebar.addEventListener('scroll', () => {
                this.handleSidebarScroll();
            });
        }

        // Eventos de teclado
        document.addEventListener('keydown', (e) => {
            this.handleKeyboard(e);
        });

        // Redimensionar ventana
        window.addEventListener('resize', () => {
            this.handleResize();
        });

        // Estado de conexión
        this.setupConnectionMonitor();
    }

    handleNavClick(e, link) {
        const href = link.getAttribute('href');
        const hasSubmenu = link.nextElementSibling?.classList.contains('submenu');
        
        if (hasSubmenu) {
            e.preventDefault();
            this.toggleSubmenu(link);
            return;
        }

        if (href && href !== '#') {
            // Remover clase active de todos los enlaces
            this.navLinks.forEach(l => l.classList.remove('active'));
            
            // Agregar clase active al enlace clickeado
            link.classList.add('active');
            
            // Animación de navegación
            this.animateNavigation(link);
            
            // En móvil, cerrar sidebar después de navegar
            if (this.isMobile) {
                setTimeout(() => {
                    this.closeSidebar();
                }, 300);
            }
        }
    }

    setActiveMenuItem() {
        this.navLinks.forEach(link => {
            const href = link.getAttribute('href');
            
            if (href && this.currentPath.includes(href.replace(/^.*\//, ''))) {
                link.classList.add('active');
                
                // Si está en un submenú, mostrar el submenú
                const parentSubmenu = link.closest('.submenu');
                if (parentSubmenu) {
                    const toggleLink = parentSubmenu.previousElementSibling;
                    if (toggleLink) {
                        this.showSubmenu(toggleLink);
                    }
                }
            }
        });
    }

    toggleSubmenu(link) {
        const submenu = link.nextElementSibling;
        const icon = link.querySelector('.nav-icon');
        
        if (submenu) {
            const isOpen = submenu.classList.contains('show');
            
            if (isOpen) {
                this.hideSubmenu(link);
            } else {
                this.showSubmenu(link);
            }
        }
    }

    showSubmenu(link) {
        const submenu = link.nextElementSibling;
        const icon = link.querySelector('.nav-icon');
        
        if (submenu) {
            submenu.classList.add('show');
            link.classList.add('expanded');
            
            if (icon && icon.classList.contains('fa-chevron-right')) {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-down');
            }
        }
    }

    hideSubmenu(link) {
        const submenu = link.nextElementSibling;
        const icon = link.querySelector('.nav-icon');
        
        if (submenu) {
            submenu.classList.remove('show');
            link.classList.remove('expanded');
            
            if (icon && icon.classList.contains('fa-chevron-down')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-right');
            }
        }
    }

    animateNavigation(link) {
        // Efecto de ondas en el enlace
        const ripple = document.createElement('div');
        ripple.className = 'nav-ripple';
        link.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    updateUserInfo() {
        const userCard = document.querySelector('.user-card');
        if (!userCard) return;

        // Obtener información del usuario desde PHP
        const userData = window.userData || {
            name: 'Usuario',
            role: 'Sistema',
            avatar: 'U'
        };

        const avatar = userCard.querySelector('.user-card-avatar');
        const name = userCard.querySelector('.user-card-name');
        const role = userCard.querySelector('.user-card-role');

        if (avatar) avatar.textContent = userData.avatar;
        if (name) name.textContent = userData.name;
        if (role) role.textContent = userData.role;

        // Actualizar estado de conexión
        this.updateConnectionStatus();
    }

    updateConnectionStatus() {
        const statusElement = document.querySelector('.user-card-status');
        if (!statusElement) return;

        const isOnline = navigator.onLine;
        const statusText = statusElement.querySelector('.status-text');
        const statusIndicator = statusElement.querySelector('.status-indicator');

        if (isOnline) {
            statusText.textContent = 'En línea';
            statusIndicator.style.background = 'var(--primary-green)';
        } else {
            statusText.textContent = 'Sin conexión';
            statusIndicator.style.background = '#ff4444';
        }
    }

    setupConnectionMonitor() {
        window.addEventListener('online', () => {
            this.updateConnectionStatus();
            this.showConnectionNotification('Conexión restaurada', 'success');
        });

        window.addEventListener('offline', () => {
            this.updateConnectionStatus();
            this.showConnectionNotification('Sin conexión a internet', 'warning');
        });
    }

    showConnectionNotification(message, type) {
        // Crear notificación temporal
        const notification = document.createElement('div');
        notification.className = `connection-notification ${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'wifi' : 'exclamation-triangle'}"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        // Mostrar con animación
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // Ocultar después de 3 segundos
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    setupTooltips() {
        // Solo en escritorio y si el sidebar está colapsado
        if (this.isMobile || !this.isCollapsed) return;

        this.navLinks.forEach(link => {
            const text = link.querySelector('.nav-text')?.textContent;
            if (text) {
                link.setAttribute('title', text);
                link.setAttribute('data-tooltip', text);
            }
        });
    }

    toggleSidebar() {
        if (this.isMobile) {
            this.sidebar?.classList.toggle('show');
            this.overlay?.classList.toggle('show');
        } else {
            this.isCollapsed = !this.isCollapsed;
            this.sidebar?.classList.toggle('collapsed');
            
            // Actualizar tooltips
            this.setupTooltips();
            
            // Guardar estado
            localStorage.setItem('sidebarCollapsed', this.isCollapsed);
        }
    }

    closeSidebar() {
        if (this.isMobile) {
            this.sidebar?.classList.remove('show');
            this.overlay?.classList.remove('show');
        }
    }

    handleSidebarScroll() {
        const scrollTop = this.sidebar.scrollTop;
        
        if (scrollTop > 20) {
            this.sidebar.classList.add('scrolled');
        } else {
            this.sidebar.classList.remove('scrolled');
        }
    }

    handleKeyboard(e) {
        // Cerrar sidebar con ESC en móvil
        if (e.key === 'Escape' && this.isMobile) {
            this.closeSidebar();
        }
        
        // Toggle con Ctrl + B
        if (e.ctrlKey && e.key === 'b') {
            e.preventDefault();
            this.toggleSidebar();
        }
    }

    handleResize() {
        const wasMobile = this.isMobile;
        this.isMobile = window.innerWidth <= 768;
        
        if (wasMobile !== this.isMobile) {
            // Cambio de móvil a desktop o viceversa
            if (this.isMobile) {
                this.closeSidebar();
            } else {
                this.sidebar?.classList.remove('show');
                this.overlay?.classList.remove('show');
            }
            
            this.handleResponsive();
        }
    }

    handleResponsive() {
        if (this.isMobile) {
            // En móvil, ocultar por defecto
            this.sidebar?.classList.remove('collapsed');
            this.sidebar?.classList.remove('show');
        } else {
            // En desktop, restaurar estado guardado
            const savedState = localStorage.getItem('sidebarCollapsed') === 'true';
            this.isCollapsed = savedState;
            
            if (this.isCollapsed) {
                this.sidebar?.classList.add('collapsed');
            }
        }
    }
}

// CSS adicional dinámico
const sidebarStyles = `
.nav-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(0, 255, 102, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    animation: ripple 0.6s linear;
    pointer-events: none;
}

@keyframes ripple {
    to {
        width: 100px;
        height: 100px;
        opacity: 0;
    }
}

.system-sidebar.scrolled .sidebar-logo {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.connection-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
    color: var(--white);
    padding: 12px 16px;
    border-radius: 8px;
    border: 1px solid;
    font-size: 14px;
    z-index: 1200;
    transform: translateX(100%);
    transition: transform 0.3s ease-out;
    display: flex;
    align-items: center;
    gap: 8px;
}

.connection-notification.success {
    border-color: var(--primary-green);
}

.connection-notification.warning {
    border-color: #ff9800;
}

.connection-notification.show {
    transform: translateX(0);
}

.system-sidebar.collapsed {
    width: 60px;
}

.system-sidebar.collapsed .nav-text,
.system-sidebar.collapsed .nav-badge,
.system-sidebar.collapsed .sidebar-logo-text,
.system-sidebar.collapsed .nav-section-title,
.system-sidebar.collapsed .user-card-name,
.system-sidebar.collapsed .user-card-role,
.system-sidebar.collapsed .user-card-status {
    opacity: 0;
    visibility: hidden;
}

.system-sidebar.collapsed .nav-link {
    justify-content: center;
    padding: 12px;
}

[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.9);
    color: var(--white);
    padding: 6px 8px;
    border-radius: 4px;
    white-space: nowrap;
    font-size: 12px;
    margin-left: 10px;
    z-index: 1000;
    border: 1px solid rgba(0, 255, 102, 0.2);
}

@media (max-width: 768px) {
    .connection-notification {
        top: 10px;
        right: 10px;
        left: 10px;
        transform: translateY(-100%);
    }
    
    .connection-notification.show {
        transform: translateY(0);
    }
}
`;

// Inyectar estilos adicionales
const styleSheet = document.createElement('style');
styleSheet.textContent = sidebarStyles;
document.head.appendChild(styleSheet);

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new SidebarManager();
});

// Exportar para uso global si es necesario
window.SidebarManager = SidebarManager;
