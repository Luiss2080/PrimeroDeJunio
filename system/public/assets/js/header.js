/* PRIMERO DE JUNIO - HEADER JAVASCRIPT DEL SISTEMA */
/* Funcionalidades para el encabezado del sistema basado en el sitio web */

class HeaderSystem {
    constructor() {
        this.header = null;
        this.searchContainer = null;
        this.userMenu = null;
        this.breadcrumb = null;
        this.notifications = null;
        this.mobileMenuBtn = null;
        this.searchTimeout = null;
        
        this.init();
    }

    init() {
        this.setupElements();
        this.setupScrollEffect();
        this.setupSearch();
        this.setupUserMenu();
        this.setupNotifications();
        this.setupMobileMenu();
        this.setupBreadcrumbs();
        this.setupKeyboardShortcuts();
        this.initializeAnimations();
    }

    setupElements() {
        this.header = document.querySelector('.header');
        this.searchContainer = document.querySelector('.search-container');
        this.userMenu = document.querySelector('.user-menu');
        this.breadcrumb = document.querySelector('.header-breadcrumb');
        this.notifications = document.querySelector('.notifications-container');
        this.mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    }

    // ===== EFECTO DE SCROLL EN EL HEADER =====
    setupScrollEffect() {
        let lastScrollY = window.scrollY;
        let ticking = false;

        const updateHeader = () => {
            const scrollY = window.scrollY;
            
            if (scrollY > 50) {
                this.header?.classList.add('header-scrolled');
            } else {
                this.header?.classList.remove('header-scrolled');
            }

            // Auto-hide header en scroll hacia abajo
            if (scrollY > lastScrollY && scrollY > 200) {
                this.header?.style.setProperty('transform', 'translateY(-100%)');
            } else {
                this.header?.style.setProperty('transform', 'translateY(0)');
            }

            lastScrollY = scrollY;
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }, { passive: true });
    }

    // ===== FUNCIONALIDAD DE BÚSQUEDA =====
    setupSearch() {
        const searchInput = this.searchContainer?.querySelector('.search-input');
        const searchBtn = this.searchContainer?.querySelector('.search-btn');
        const searchResults = this.createSearchResults();

        if (!searchInput) return;

        // Efecto de focus mejorado
        searchInput.addEventListener('focus', () => {
            this.searchContainer?.classList.add('search-focused');
            this.animateSearchExpand();
        });

        searchInput.addEventListener('blur', () => {
            setTimeout(() => {
                this.searchContainer?.classList.remove('search-focused');
                this.hideSearchResults();
            }, 150);
        });

        // Búsqueda en tiempo real
        searchInput.addEventListener('input', (e) => {
            clearTimeout(this.searchTimeout);
            const query = e.target.value.trim();

            if (query.length >= 2) {
                this.searchTimeout = setTimeout(() => {
                    this.performSearch(query);
                }, 300);
            } else {
                this.hideSearchResults();
            }
        });

        // Enter para buscar
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.executeSearch(searchInput.value);
            } else if (e.key === 'Escape') {
                searchInput.blur();
                this.hideSearchResults();
            }
        });

        // Click en botón de búsqueda
        searchBtn?.addEventListener('click', () => {
            this.executeSearch(searchInput.value);
        });
    }

    createSearchResults() {
        const resultsContainer = document.createElement('div');
        resultsContainer.className = 'search-results';
        resultsContainer.innerHTML = `
            <div class="search-results-header">
                <span class="results-title">Resultados de búsqueda</span>
                <span class="results-count">0 resultados</span>
            </div>
            <div class="search-results-content">
                <div class="search-loading">
                    <div class="loading-spinner"></div>
                    <span>Buscando...</span>
                </div>
                <div class="search-empty" style="display: none;">
                    <i class="fas fa-search"></i>
                    <span>No se encontraron resultados</span>
                </div>
                <div class="search-items"></div>
            </div>
        `;
        
        this.searchContainer?.appendChild(resultsContainer);
        return resultsContainer;
    }

    animateSearchExpand() {
        if (!this.searchContainer) return;
        
        // Efecto de expansión suave
        gsap.to(this.searchContainer, {
            scale: 1.02,
            duration: 0.3,
            ease: "power2.out"
        });

        // Efecto de brillo
        gsap.to(this.searchContainer.querySelector('::before'), {
            left: '100%',
            duration: 0.6,
            ease: "power2.out"
        });
    }

    async performSearch(query) {
        const resultsContainer = this.searchContainer?.querySelector('.search-results');
        if (!resultsContainer) return;

        resultsContainer.style.display = 'block';
        this.showSearchLoading();

        try {
            const response = await fetch(`/api/search?q=${encodeURIComponent(query)}`);
            const data = await response.json();
            
            if (data.success) {
                this.displaySearchResults(data.results);
            } else {
                this.showSearchEmpty();
            }
        } catch (error) {
            console.error('Error en búsqueda:', error);
            this.showSearchError();
        }
    }

    displaySearchResults(results) {
        const resultsContent = this.searchContainer?.querySelector('.search-items');
        const resultsCount = this.searchContainer?.querySelector('.results-count');
        
        if (!resultsContent) return;

        resultsContent.innerHTML = results.map(result => `
            <div class="search-item" data-url="${result.url}">
                <div class="search-item-icon">
                    <i class="${result.icon || 'fas fa-file'}"></i>
                </div>
                <div class="search-item-content">
                    <div class="search-item-title">${result.title}</div>
                    <div class="search-item-description">${result.description}</div>
                    <div class="search-item-category">${result.category}</div>
                </div>
                <div class="search-item-action">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        `).join('');

        resultsCount.textContent = `${results.length} resultado${results.length !== 1 ? 's' : ''}`;

        // Agregar eventos de click
        resultsContent.querySelectorAll('.search-item').forEach(item => {
            item.addEventListener('click', () => {
                const url = item.dataset.url;
                if (url) {
                    this.navigateToResult(url);
                }
            });
        });

        this.hideSearchLoading();
        this.animateSearchResults();
    }

    animateSearchResults() {
        const items = this.searchContainer?.querySelectorAll('.search-item');
        if (!items) return;

        items.forEach((item, index) => {
            gsap.fromTo(item, 
                { opacity: 0, y: 20 },
                { 
                    opacity: 1, 
                    y: 0, 
                    duration: 0.3,
                    delay: index * 0.05,
                    ease: "power2.out"
                }
            );
        });
    }

    showSearchLoading() {
        const loading = this.searchContainer?.querySelector('.search-loading');
        const empty = this.searchContainer?.querySelector('.search-empty');
        const items = this.searchContainer?.querySelector('.search-items');
        
        loading && (loading.style.display = 'flex');
        empty && (empty.style.display = 'none');
        items && (items.style.display = 'none');
    }

    hideSearchLoading() {
        const loading = this.searchContainer?.querySelector('.search-loading');
        const items = this.searchContainer?.querySelector('.search-items');
        
        loading && (loading.style.display = 'none');
        items && (items.style.display = 'block');
    }

    showSearchEmpty() {
        const loading = this.searchContainer?.querySelector('.search-loading');
        const empty = this.searchContainer?.querySelector('.search-empty');
        const items = this.searchContainer?.querySelector('.search-items');
        
        loading && (loading.style.display = 'none');
        empty && (empty.style.display = 'flex');
        items && (items.style.display = 'none');
    }

    hideSearchResults() {
        const resultsContainer = this.searchContainer?.querySelector('.search-results');
        if (resultsContainer) {
            gsap.to(resultsContainer, {
                opacity: 0,
                duration: 0.3,
                onComplete: () => {
                    resultsContainer.style.display = 'none';
                    resultsContainer.style.opacity = 1;
                }
            });
        }
    }

    executeSearch(query) {
        if (!query.trim()) return;
        
        // Navegar a página de resultados completos
        window.location.href = `/search?q=${encodeURIComponent(query)}`;
    }

    navigateToResult(url) {
        this.hideSearchResults();
        window.location.href = url;
    }

    // ===== MENÚ DE USUARIO =====
    setupUserMenu() {
        const userMenuTrigger = this.userMenu?.querySelector('.user-menu-trigger');
        const userDropdown = this.userMenu?.querySelector('.user-dropdown');
        
        if (!userMenuTrigger || !userDropdown) return;

        userMenuTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleUserMenu();
        });

        // Cerrar menú al hacer click fuera
        document.addEventListener('click', (e) => {
            if (!this.userMenu?.contains(e.target)) {
                this.closeUserMenu();
            }
        });

        // Animación de hover en items del menú
        const menuItems = userDropdown.querySelectorAll('.dropdown-item');
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                gsap.to(item, {
                    x: 5,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });

            item.addEventListener('mouseleave', () => {
                gsap.to(item, {
                    x: 0,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });
        });
    }

    toggleUserMenu() {
        const isOpen = this.userMenu?.classList.contains('open');
        
        if (isOpen) {
            this.closeUserMenu();
        } else {
            this.openUserMenu();
        }
    }

    openUserMenu() {
        this.userMenu?.classList.add('open');
        const dropdown = this.userMenu?.querySelector('.user-dropdown');
        
        if (dropdown) {
            dropdown.classList.add('show');
            gsap.fromTo(dropdown,
                { opacity: 0, y: -10, scale: 0.95 },
                { 
                    opacity: 1, 
                    y: 0, 
                    scale: 1,
                    duration: 0.3,
                    ease: "back.out(1.7)"
                }
            );
        }
    }

    closeUserMenu() {
        const dropdown = this.userMenu?.querySelector('.user-dropdown');
        
        if (dropdown) {
            gsap.to(dropdown, {
                opacity: 0,
                y: -10,
                scale: 0.95,
                duration: 0.2,
                ease: "power2.in",
                onComplete: () => {
                    dropdown.classList.remove('show');
                    this.userMenu?.classList.remove('open');
                }
            });
        }
    }

    // ===== NOTIFICACIONES =====
    setupNotifications() {
        const notificationBtn = this.notifications?.querySelector('.notification-btn');
        
        if (!notificationBtn) return;

        notificationBtn.addEventListener('click', () => {
            this.toggleNotifications();
        });

        // Actualizar contador de notificaciones
        this.updateNotificationCount();
        
        // Polling para nuevas notificaciones
        this.startNotificationPolling();
    }

    async updateNotificationCount() {
        try {
            const response = await fetch('/api/notifications/count');
            const data = await response.json();
            
            const badge = this.notifications?.querySelector('.notification-badge');
            if (badge && data.count > 0) {
                badge.textContent = data.count > 99 ? '99+' : data.count;
                badge.style.display = 'flex';
                
                // Animación de pulso para nuevas notificaciones
                gsap.fromTo(badge,
                    { scale: 1 },
                    { 
                        scale: 1.2,
                        duration: 0.3,
                        yoyo: true,
                        repeat: 1,
                        ease: "power2.inOut"
                    }
                );
            } else if (badge) {
                badge.style.display = 'none';
            }
        } catch (error) {
            console.error('Error al actualizar notificaciones:', error);
        }
    }

    startNotificationPolling() {
        // Actualizar cada 30 segundos
        setInterval(() => {
            this.updateNotificationCount();
        }, 30000);
    }

    toggleNotifications() {
        // Implementar panel de notificaciones
        console.log('Toggleando notificaciones...');
        // TODO: Implementar panel de notificaciones
    }

    // ===== BREADCRUMBS =====
    setupBreadcrumbs() {
        const breadcrumbItems = this.breadcrumb?.querySelectorAll('.breadcrumb-item a');
        
        breadcrumbItems?.forEach(item => {
            item.addEventListener('mouseenter', () => {
                gsap.to(item, {
                    scale: 1.05,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });

            item.addEventListener('mouseleave', () => {
                gsap.to(item, {
                    scale: 1,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });
        });
    }

    updateBreadcrumbs(items) {
        const container = this.breadcrumb?.querySelector('.breadcrumb-container');
        if (!container) return;

        const breadcrumbHTML = items.map((item, index) => {
            const isLast = index === items.length - 1;
            return `
                <span class="breadcrumb-item ${isLast ? 'active' : ''}">
                    ${!isLast ? `<a href="${item.url}">${item.title}</a>` : item.title}
                </span>
                ${!isLast ? '<span class="breadcrumb-separator">▸</span>' : ''}
            `;
        }).join('');

        container.innerHTML = breadcrumbHTML;
        
        // Reasignar eventos
        this.setupBreadcrumbs();
    }

    // ===== MENÚ MÓVIL =====
    setupMobileMenu() {
        if (!this.mobileMenuBtn) return;

        this.mobileMenuBtn.addEventListener('click', () => {
            this.toggleMobileMenu();
        });
    }

    toggleMobileMenu() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        
        sidebar?.classList.toggle('open');
        overlay?.classList.toggle('active');
        this.mobileMenuBtn?.classList.toggle('active');
    }

    // ===== ATAJOS DE TECLADO =====
    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl+K para abrir búsqueda
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                const searchInput = this.searchContainer?.querySelector('.search-input');
                searchInput?.focus();
            }
            
            // Ctrl+Shift+N para notificaciones
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'N') {
                e.preventDefault();
                this.toggleNotifications();
            }
            
            // Ctrl+Shift+P para menú de usuario
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'P') {
                e.preventDefault();
                this.toggleUserMenu();
            }
        });
    }

    // ===== ANIMACIONES INICIALES =====
    initializeAnimations() {
        // Animación de entrada del header
        if (this.header) {
            gsap.fromTo(this.header,
                { y: -100, opacity: 0 },
                { 
                    y: 0, 
                    opacity: 1, 
                    duration: 0.6,
                    ease: "power3.out"
                }
            );
        }

        // Animación de elementos del header
        const elements = [
            '.logo-container',
            '.header-breadcrumb',
            '.header-search',
            '.header-actions > *'
        ];

        elements.forEach((selector, index) => {
            const element = this.header?.querySelector(selector);
            if (element) {
                gsap.fromTo(element,
                    { y: -30, opacity: 0 },
                    { 
                        y: 0, 
                        opacity: 1, 
                        duration: 0.4,
                        delay: 0.1 + (index * 0.1),
                        ease: "power2.out"
                    }
                );
            }
        });
    }

    // ===== MÉTODOS PÚBLICOS =====
    showMessage(message, type = 'info') {
        // Crear mensaje toast en header
        const toast = document.createElement('div');
        toast.className = `header-toast toast-${type}`;
        toast.innerHTML = `
            <i class="fas fa-${type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle'}"></i>
            <span>${message}</span>
            <button class="toast-close">
                <i class="fas fa-times"></i>
            </button>
        `;

        this.header?.appendChild(toast);

        // Animación de entrada
        gsap.fromTo(toast,
            { x: 300, opacity: 0 },
            { x: 0, opacity: 1, duration: 0.4, ease: "power3.out" }
        );

        // Auto-remove después de 5 segundos
        setTimeout(() => {
            this.removeToast(toast);
        }, 5000);

        // Click para cerrar
        toast.querySelector('.toast-close')?.addEventListener('click', () => {
            this.removeToast(toast);
        });
    }

    removeToast(toast) {
        gsap.to(toast, {
            x: 300,
            opacity: 0,
            duration: 0.3,
            ease: "power2.in",
            onComplete: () => {
                toast.remove();
            }
        });
    }

    setUserInfo(name, role, avatar) {
        const userName = this.header?.querySelector('.user-name');
        const userRole = this.header?.querySelector('.user-role');
        const userAvatar = this.header?.querySelector('.user-avatar');

        if (userName) userName.textContent = name;
        if (userRole) userRole.textContent = role;
        if (userAvatar) userAvatar.textContent = name.charAt(0).toUpperCase();
    }

    setPageTitle(title) {
        document.title = `${title} | Primero de Junio - Sistema`;
        
        // Actualizar breadcrumb si es necesario
        const activeItem = this.breadcrumb?.querySelector('.breadcrumb-item.active');
        if (activeItem) {
            activeItem.textContent = title;
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.headerSystem = new HeaderSystem();
});

// CSS para componentes dinámicos
const headerStyles = `
.search-results {
    position: absolute;
    top: 120%;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.95);
    border: 1px solid rgba(0, 255, 102, 0.2);
    border-radius: 15px;
    backdrop-filter: blur(20px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    z-index: 1001;
    max-height: 400px;
    overflow: hidden;
    display: none;
}

.search-results-header {
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.results-title {
    font-weight: 600;
    color: var(--white);
    font-size: 0.9rem;
}

.results-count {
    font-size: 0.8rem;
    color: var(--gray-light);
}

.search-results-content {
    max-height: 300px;
    overflow-y: auto;
}

.search-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    gap: 1rem;
    color: var(--gray-light);
}

.search-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    gap: 1rem;
    color: var(--gray-light);
}

.search-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    cursor: pointer;
    transition: var(--transition-fast);
}

.search-item:hover {
    background: rgba(0, 255, 102, 0.1);
    transform: translateX(5px);
}

.search-item-icon {
    width: 40px;
    height: 40px;
    background: rgba(0, 255, 102, 0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-green);
    margin-right: 1rem;
}

.search-item-content {
    flex: 1;
}

.search-item-title {
    font-weight: 600;
    color: var(--white);
    margin-bottom: 0.25rem;
}

.search-item-description {
    font-size: 0.8rem;
    color: var(--gray-light);
    margin-bottom: 0.25rem;
}

.search-item-category {
    font-size: 0.7rem;
    color: var(--primary-green);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.search-item-action {
    color: var(--gray-medium);
    transition: var(--transition-fast);
}

.search-item:hover .search-item-action {
    color: var(--primary-green);
    transform: translateX(5px);
}

.header-toast {
    position: absolute;
    top: 100%;
    right: 2rem;
    background: var(--white);
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    gap: 1rem;
    max-width: 400px;
    z-index: 1002;
}

.toast-success { border-left: 4px solid #22c55e; }
.toast-error { border-left: 4px solid #dc2626; }
.toast-info { border-left: 4px solid #3b82f6; }

.toast-close {
    background: none;
    border: none;
    color: var(--gray-medium);
    cursor: pointer;
    padding: 0.25rem;
}

.loading-spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(0, 255, 102, 0.3);
    border-top: 2px solid var(--primary-green);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
`;

// Agregar estilos al documento
const styleElement = document.createElement('style');
styleElement.textContent = headerStyles;
document.head.appendChild(styleElement);
