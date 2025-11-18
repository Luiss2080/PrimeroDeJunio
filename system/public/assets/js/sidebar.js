/**
 * SISTEMA PRIMERO DE JUNIO - SIDEBAR JAVASCRIPT
 * JavaScript moderno para interacciones del sidebar
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // === ELEMENTOS DEL SIDEBAR ===
    const sidebar = document.getElementById('systemSidebar');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    const navItems = document.querySelectorAll('.nav-item');
    
    // === VARIABLES DE ESTADO ===
    let activePage = getCurrentPage();
    let openSubmenus = [];
    
    // === INICIALIZACIÓN ===
    initSidebar();
    
    // === EVENT LISTENERS ===
    
    // Cerrar sidebar (móvil)
    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }
    
    // Overlay del sidebar
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }
    
    // Toggles de submenú
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const submenuId = this.getAttribute('data-submenu');
            toggleSubmenu(submenuId);
        });
    });
    
    // Navigation links
    document.querySelectorAll('.nav-link:not(.submenu-toggle)').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.href || this.href === 'javascript:void(0)') {
                e.preventDefault();
                return;
            }
            
            // En móvil, cerrar sidebar después de navegar
            if (window.innerWidth <= 768) {
                setTimeout(closeSidebar, 100);
            }
        });
    });
    
    // Submenu links
    document.querySelectorAll('.submenu-link').forEach(link => {
        link.addEventListener('click', function() {
            // En móvil, cerrar sidebar después de navegar
            if (window.innerWidth <= 768) {
                setTimeout(closeSidebar, 100);
            }
        });
    });
    
    // === FUNCIONES PRINCIPALES ===
    
    /**
     * Inicializar sidebar
     */
    function initSidebar() {
        // Establecer página activa
        setActivePage(activePage);
        
        // Restaurar submenús abiertos desde localStorage
        restoreSubmenuState();
        
        // Configurar responsive behavior
        handleResponsiveBehavior();
        
        // Añadir tooltips para sidebar colapsado
        addCollapsedTooltips();
        
        // Inicializar drag & drop si es necesario
        initDragAndDrop();
    }
    
    /**
     * Cerrar sidebar (móvil)
     */
    function closeSidebar() {
        if (!sidebar) return;
        
        sidebar.classList.remove('mobile-open');
        sidebarOverlay?.classList.remove('show');
        document.body.style.overflow = '';
        
        // Resetear botón toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.classList.remove('active');
        }
    }
    
    /**
     * Toggle de submenú
     */
    function toggleSubmenu(submenuId) {
        const navItem = document.querySelector(`[data-submenu="${submenuId}"]`)?.closest('.nav-item');
        const submenu = document.getElementById(`submenu-${submenuId}`);
        
        if (!navItem || !submenu) return;
        
        const isOpen = navItem.classList.contains('active');
        
        if (isOpen) {
            closeSubmenu(submenuId);
        } else {
            openSubmenu(submenuId);
        }
        
        // Guardar estado en localStorage
        saveSubmenuState();
    }
    
    /**
     * Abrir submenú
     */
    function openSubmenu(submenuId) {
        const navItem = document.querySelector(`[data-submenu="${submenuId}"]`)?.closest('.nav-item');
        const submenu = document.getElementById(`submenu-${submenuId}`);
        const arrow = navItem?.querySelector('.submenu-arrow');
        
        if (!navItem || !submenu) return;
        
        // Añadir a lista de abiertos
        if (!openSubmenus.includes(submenuId)) {
            openSubmenus.push(submenuId);
        }
        
        // Activar visualmente
        navItem.classList.add('active');
        
        // Rotar flecha
        if (arrow) {
            arrow.style.transform = 'rotate(180deg)';
        }
        
        // Calcular altura del submenú
        const submenuItems = submenu.querySelectorAll('.submenu-item');
        const itemHeight = 40; // Altura aproximada de cada item
        const padding = 16; // Padding del submenú
        const maxHeight = (submenuItems.length * itemHeight) + padding;
        
        // Animar apertura
        submenu.style.maxHeight = `${maxHeight}px`;
        
        // Añadir clase para animaciones adicionales
        setTimeout(() => {
            submenu.classList.add('open');
        }, 50);
    }
    
    /**
     * Cerrar submenú
     */
    function closeSubmenu(submenuId) {
        const navItem = document.querySelector(`[data-submenu="${submenuId}"]`)?.closest('.nav-item');
        const submenu = document.getElementById(`submenu-${submenuId}`);
        const arrow = navItem?.querySelector('.submenu-arrow');
        
        if (!navItem || !submenu) return;
        
        // Quitar de lista de abiertos
        openSubmenus = openSubmenus.filter(id => id !== submenuId);
        
        // Desactivar visualmente
        navItem.classList.remove('active');
        
        // Rotar flecha
        if (arrow) {
            arrow.style.transform = 'rotate(0deg)';
        }
        
        // Animar cierre
        submenu.style.maxHeight = '0px';
        submenu.classList.remove('open');
    }
    
    /**
     * Establecer página activa
     */
    function setActivePage(page) {
        // Remover clases activas previas
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active');
        });
        
        document.querySelectorAll('.submenu-link').forEach(link => {
            link.classList.remove('active');
        });
        
        // Encontrar y activar el item correspondiente
        const currentUrl = window.location.pathname;
        let matchedItem = null;
        let matchedSubmenu = null;
        
        // Buscar coincidencia exacta en submenús
        document.querySelectorAll('.submenu-link').forEach(link => {
            if (link.getAttribute('href') === currentUrl) {
                matchedSubmenu = link;
                matchedItem = link.closest('.nav-item');
            }
        });
        
        // Si no hay coincidencia en submenús, buscar en menú principal
        if (!matchedItem) {
            document.querySelectorAll('.nav-link:not(.submenu-toggle)').forEach(link => {
                if (link.getAttribute('href') === currentUrl) {
                    matchedItem = link.closest('.nav-item');
                }
            });
        }
        
        // Activar item encontrado
        if (matchedItem) {
            matchedItem.classList.add('active');
            
            // Si es un submenú, abrir el menú padre
            if (matchedSubmenu) {
                const parentToggle = matchedItem.querySelector('.submenu-toggle');
                if (parentToggle) {
                    const submenuId = parentToggle.getAttribute('data-submenu');
                    openSubmenu(submenuId);
                }
                matchedSubmenu.classList.add('active');
            }
        }
    }
    
    /**
     * Obtener página actual
     */
    function getCurrentPage() {
        const path = window.location.pathname;
        const segments = path.split('/').filter(segment => segment);
        
        if (segments.length >= 2) {
            return segments[1]; // admin, operador, etc.
        }
        
        return 'dashboard';
    }
    
    /**
     * Guardar estado de submenús en localStorage
     */
    function saveSubmenuState() {
        try {
            localStorage.setItem('sidebar_open_submenus', JSON.stringify(openSubmenus));
        } catch (e) {
            console.warn('No se pudo guardar el estado del sidebar:', e);
        }
    }
    
    /**
     * Restaurar estado de submenús desde localStorage
     */
    function restoreSubmenuState() {
        try {
            const saved = localStorage.getItem('sidebar_open_submenus');
            if (saved) {
                const savedSubmenus = JSON.parse(saved);
                savedSubmenus.forEach(submenuId => {
                    openSubmenu(submenuId);
                });
            }
        } catch (e) {
            console.warn('No se pudo restaurar el estado del sidebar:', e);
        }
    }
    
    /**
     * Manejar comportamiento responsive
     */
    function handleResponsiveBehavior() {
        const mediaQuery = window.matchMedia('(max-width: 1024px)');
        
        function handleMediaQueryChange(mq) {
            if (mq.matches) {
                // Tablet/móvil: colapsar automáticamente
                if (sidebar && !sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.add('collapsed');
                }
            }
        }
        
        // Ejecutar inmediatamente
        handleMediaQueryChange(mediaQuery);
        
        // Escuchar cambios
        mediaQuery.addListener(handleMediaQueryChange);
    }
    
    /**
     * Añadir tooltips para sidebar colapsado
     */
    function addCollapsedTooltips() {
        document.querySelectorAll('.nav-link').forEach(link => {
            const textElement = link.querySelector('.nav-text');
            if (textElement) {
                link.setAttribute('title', textElement.textContent.trim());
            }
        });
    }
    
    /**
     * Inicializar drag & drop (futuro)
     */
    function initDragAndDrop() {
        // Implementar en el futuro para reordenar elementos del menú
        // Por ahora, solo preparamos la estructura
    }
    
    // === UTILIDADES ===
    
    /**
     * Scroll suave a elemento del sidebar
     */
    function scrollToNavItem(itemId) {
        const item = document.getElementById(itemId);
        if (item && sidebar) {
            const sidebarNav = sidebar.querySelector('.sidebar-nav');
            if (sidebarNav) {
                const itemTop = item.offsetTop;
                const containerHeight = sidebarNav.clientHeight;
                const scrollTop = itemTop - (containerHeight / 2);
                
                sidebarNav.scrollTo({
                    top: scrollTop,
                    behavior: 'smooth'
                });
            }
        }
    }
    
    /**
     * Filtrar elementos del menú
     */
    function filterMenu(query) {
        const searchTerm = query.toLowerCase().trim();
        
        document.querySelectorAll('.nav-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            const matches = text.includes(searchTerm);
            
            item.style.display = matches ? 'block' : 'none';
            
            // Si un submenú coincide, mostrar el padre
            if (!matches) {
                const submenuItems = item.querySelectorAll('.submenu-item');
                let hasMatchingSubmenu = false;
                
                submenuItems.forEach(submenuItem => {
                    const submenuText = submenuItem.textContent.toLowerCase();
                    const submenuMatches = submenuText.includes(searchTerm);
                    submenuItem.style.display = submenuMatches ? 'block' : 'none';
                    
                    if (submenuMatches) {
                        hasMatchingSubmenu = true;
                    }
                });
                
                if (hasMatchingSubmenu) {
                    item.style.display = 'block';
                    // Abrir submenú para mostrar coincidencias
                    const submenuToggle = item.querySelector('.submenu-toggle');
                    if (submenuToggle) {
                        const submenuId = submenuToggle.getAttribute('data-submenu');
                        openSubmenu(submenuId);
                    }
                }
            }
        });
    }
    
    /**
     * Resetear filtro del menú
     */
    function resetMenuFilter() {
        document.querySelectorAll('.nav-item, .submenu-item').forEach(item => {
            item.style.display = 'block';
        });
    }
    
    // === ATAJOS DE TECLADO ===
    document.addEventListener('keydown', function(e) {
        // Alt + S: Toggle sidebar
        if (e.altKey && e.key === 's') {
            e.preventDefault();
            if (window.HeaderManager) {
                window.HeaderManager.toggleSidebar();
            }
        }
        
        // Alt + 1-9: Navegación rápida
        if (e.altKey && /^[1-9]$/.test(e.key)) {
            e.preventDefault();
            const index = parseInt(e.key) - 1;
            const navLinks = document.querySelectorAll('.nav-link:not(.submenu-toggle)');
            if (navLinks[index]) {
                navLinks[index].click();
            }
        }
    });
    
    // === EVENTOS PERSONALIZADOS ===
    
    // Evento cuando se cambia la página
    document.addEventListener('pageChanged', function(e) {
        setActivePage(e.detail.page);
    });
    
    // === EXPOSER FUNCIONES GLOBALMENTE ===
    window.SidebarManager = {
        toggleSubmenu,
        openSubmenu,
        closeSubmenu,
        setActivePage,
        filterMenu,
        resetMenuFilter,
        scrollToNavItem,
        closeSidebar
    };
    
    // === INTEGRACIÓN CON HEADER ===
    
    // Escuchar eventos del header
    document.addEventListener('headerToggleSidebar', function() {
        // Ya manejado por HeaderManager
    });
    
    // === ANALYTICS Y TRACKING ===
    
    /**
     * Rastrear navegación (opcional)
     */
    function trackNavigation(page, section = null) {
        // Implementar tracking de analytics si es necesario
        console.log('Navegación:', { page, section, timestamp: Date.now() });
    }
    
    // Rastrear clics en navegación
    document.querySelectorAll('.nav-link, .submenu-link').forEach(link => {
        link.addEventListener('click', function() {
            const page = this.getAttribute('href');
            const section = this.closest('.nav-item')?.querySelector('.nav-text')?.textContent;
            trackNavigation(page, section);
        });
    });
    
    // === ESTADO DE CARGA ===
    
    // Marcar sidebar como cargado
    setTimeout(() => {
        if (sidebar) {
            sidebar.classList.add('loaded');
        }
    }, 100);
    
});

/**
 * UTILIDADES DEL SIDEBAR
 */

// Badge dinámico para elementos del menú
function updateNavBadge(navKey, count) {
    const navItem = document.querySelector(`[data-submenu="${navKey}"]`)?.closest('.nav-item');
    if (!navItem) return;
    
    let badge = navItem.querySelector('.nav-badge');
    
    if (count > 0) {
        if (!badge) {
            badge = document.createElement('span');
            badge.className = 'nav-badge';
            const navText = navItem.querySelector('.nav-text');
            if (navText) {
                navText.parentNode.insertBefore(badge, navText.nextSibling);
            }
        }
        badge.textContent = count > 99 ? '99+' : count;
    } else if (badge) {
        badge.remove();
    }
}

// Notificación en elemento del menú
function showNavNotification(navKey, message) {
    const navItem = document.querySelector(`[data-submenu="${navKey}"]`)?.closest('.nav-item');
    if (!navItem) return;
    
    // Crear indicador de notificación
    const indicator = document.createElement('div');
    indicator.className = 'nav-notification-indicator';
    indicator.style.cssText = `
        position: absolute;
        top: 10px;
        right: 10px;
        width: 8px;
        height: 8px;
        background: #ff4757;
        border-radius: 50%;
        animation: pulse 1s infinite;
    `;
    
    navItem.style.position = 'relative';
    navItem.appendChild(indicator);
    
    // Remover después de unos segundos
    setTimeout(() => {
        if (indicator.parentNode) {
            indicator.parentNode.removeChild(indicator);
        }
    }, 5000);
}

// Exportar utilidades
window.SidebarUtils = {
    updateNavBadge,
    showNavNotification
};
