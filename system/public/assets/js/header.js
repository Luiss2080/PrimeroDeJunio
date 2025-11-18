/**
 * PRIMERO DE JUNIO - HEADER JAVASCRIPT PROFESIONAL
 * Funcionalidades optimizadas para header del sistema - Basado en el sitio web
 */

class HeaderManager {
    constructor() {
        this.header = null;
        this.userDropdown = null;
        this.menuToggle = null;
        this.searchInput = null;
        this.notificationBtn = null;
        this.isDropdownOpen = false;
        this.searchTimeout = null;
        
        this.init();
    }

    init() {
        this.bindElements();
        this.bindEvents();
        this.setupSearch();
        this.setupNotifications();
        this.handleResponsive();
    }

    bindElements() {
        this.header = document.querySelector('.system-header');
        this.userDropdown = document.querySelector('.user-dropdown');
        this.menuToggle = document.querySelector('.menu-toggle');
        this.searchInput = document.querySelector('.search-input');
        this.notificationBtn = document.querySelector('.notification-btn');
    }

    bindEvents() {
        // Dropdown de usuario
        if (this.userDropdown) {
            const userBtn = this.userDropdown.querySelector('.user-btn');
            const dropdownMenu = this.userDropdown.querySelector('.dropdown-menu');

            if (userBtn && dropdownMenu) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleUserDropdown();
                });

                // Cerrar dropdown al hacer click fuera
                document.addEventListener('click', (e) => {
                    if (!this.userDropdown.contains(e.target)) {
                        this.closeUserDropdown();
                    }
                });

                // Cerrar con ESC
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeUserDropdown();
                    }
                });
            }
        }

        // Toggle del menú móvil
        if (this.menuToggle) {
            this.menuToggle.addEventListener('click', () => {
                this.toggleMobileMenu();
            });
        }

        // Scroll del header
        window.addEventListener('scroll', () => {
            this.handleScroll();
        });

        // Redimensionar ventana
        window.addEventListener('resize', () => {
            this.handleResize();
        });
    }

    setupSearch() {
        if (!this.searchInput) return;

        this.searchInput.addEventListener('input', (e) => {
            clearTimeout(this.searchTimeout);
            const query = e.target.value.trim();

            this.searchTimeout = setTimeout(() => {
                if (query.length >= 2) {
                    this.performSearch(query);
                }
            }, 300);
        });

        this.searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = e.target.value.trim();
                if (query.length >= 2) {
                    this.performSearch(query);
                }
            }
        });

        // Placeholder dinámico
        this.animateSearchPlaceholder();
    }

    setupNotifications() {
        if (!this.notificationBtn) return;

        this.notificationBtn.addEventListener('click', () => {
            this.toggleNotifications();
        });

        // Simular actualización de notificaciones
        this.updateNotificationCount();
        
        // Actualizar cada 30 segundos
        setInterval(() => {
            this.updateNotificationCount();
        }, 30000);
    }

    toggleUserDropdown() {
        const dropdownMenu = this.userDropdown.querySelector('.dropdown-menu');
        
        if (this.isDropdownOpen) {
            this.closeUserDropdown();
        } else {
            this.openUserDropdown();
        }
    }

    openUserDropdown() {
        const dropdownMenu = this.userDropdown.querySelector('.dropdown-menu');
        
        this.userDropdown.classList.add('active');
        dropdownMenu.classList.add('show');
        dropdownMenu.classList.add('fade-in');
        this.isDropdownOpen = true;

        // Animación de entrada
        setTimeout(() => {
            dropdownMenu.classList.remove('fade-in');
        }, 300);
    }

    closeUserDropdown() {
        const dropdownMenu = this.userDropdown.querySelector('.dropdown-menu');
        
        this.userDropdown.classList.remove('active');
        dropdownMenu.classList.remove('show');
        this.isDropdownOpen = false;
    }

    toggleMobileMenu() {
        const sidebar = document.querySelector('.system-sidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        if (sidebar) {
            sidebar.classList.toggle('show');
            
            if (overlay) {
                overlay.classList.toggle('show');
            }

            // Crear overlay si no existe
            if (!overlay) {
                this.createSidebarOverlay();
            }
        }
    }

    createSidebarOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay show';
        document.body.appendChild(overlay);

        overlay.addEventListener('click', () => {
            this.toggleMobileMenu();
        });
    }

    performSearch(query) {
        console.log('Buscando:', query);
        
        // Aquí se implementaría la búsqueda real
        // Por ahora solo mostramos un mensaje
        this.showSearchFeedback(query);
    }

    showSearchFeedback(query) {
        const searchContainer = this.searchInput.parentElement;
        
        // Remover feedback anterior
        const existingFeedback = searchContainer.querySelector('.search-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }

        // Crear nuevo feedback
        const feedback = document.createElement('div');
        feedback.className = 'search-feedback';
        feedback.innerHTML = `
            <div class="search-result">
                <i class="fas fa-search"></i>
                <span>Buscando: "${query}"...</span>
            </div>
        `;
        
        searchContainer.appendChild(feedback);

        // Remover después de 3 segundos
        setTimeout(() => {
            feedback.remove();
        }, 3000);
    }

    animateSearchPlaceholder() {
        const placeholders = [
            'Buscar usuarios...',
            'Buscar vehículos...',
            'Buscar conductores...',
            'Buscar viajes...',
            'Buscar reportes...'
        ];
        
        let currentIndex = 0;
        
        setInterval(() => {
            currentIndex = (currentIndex + 1) % placeholders.length;
            this.searchInput.placeholder = placeholders[currentIndex];
        }, 3000);
    }

    toggleNotifications() {
        // Aquí se implementaría el panel de notificaciones
        console.log('Mostrando notificaciones');
        
        // Simular marcado como leído
        this.markNotificationsAsRead();
    }

    updateNotificationCount() {
        const badge = this.notificationBtn?.querySelector('.notification-badge');
        if (!badge) return;

        // Simular obtención de notificaciones del servidor
        const count = Math.floor(Math.random() * 10);
        
        if (count > 0) {
            badge.textContent = count;
            badge.style.display = 'block';
            this.notificationBtn.classList.add('has-notifications');
        } else {
            badge.style.display = 'none';
            this.notificationBtn.classList.remove('has-notifications');
        }
    }

    markNotificationsAsRead() {
        const badge = this.notificationBtn?.querySelector('.notification-badge');
        if (badge) {
            badge.style.display = 'none';
            this.notificationBtn.classList.remove('has-notifications');
        }
    }

    handleScroll() {
        const scrollY = window.scrollY;
        
        if (scrollY > 50) {
            this.header?.classList.add('scrolled');
        } else {
            this.header?.classList.remove('scrolled');
        }
    }

    handleResize() {
        // Cerrar dropdown en redimensión
        if (this.isDropdownOpen && window.innerWidth <= 768) {
            this.closeUserDropdown();
        }

        // Cerrar menú móvil en desktop
        if (window.innerWidth > 768) {
            const sidebar = document.querySelector('.system-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (sidebar?.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
            
            if (overlay?.classList.contains('show')) {
                overlay.classList.remove('show');
            }
        }
    }

    handleResponsive() {
        // Verificar si es móvil
        const isMobile = window.innerWidth <= 768;
        
        if (isMobile) {
            this.header?.classList.add('mobile');
        } else {
            this.header?.classList.remove('mobile');
        }
    }
}

// CSS adicional dinámico
const headerStyles = `
.search-feedback {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 255, 102, 0.2);
    border-radius: 8px;
    padding: 10px;
    margin-top: 5px;
    z-index: 1000;
    animation: slideDown 0.3s ease-out;
}

.search-result {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--white);
    font-size: 14px;
}

.search-result i {
    color: var(--primary-green);
}

.notification-btn.has-notifications {
    animation: pulse 2s infinite;
}

.system-header.scrolled {
    background: rgba(0, 0, 0, 0.98);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
}

.system-header.mobile .header-container {
    padding: 0 10px;
}

@media (max-width: 768px) {
    .search-feedback {
        position: fixed;
        top: var(--header-height);
        left: 10px;
        right: 10px;
        margin: 10px 0;
    }
}
`;

// Inyectar estilos adicionales
const styleSheet = document.createElement('style');
styleSheet.textContent = headerStyles;
document.head.appendChild(styleSheet);

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new HeaderManager();
});

// Exportar para uso global si es necesario
window.HeaderManager = HeaderManager;
