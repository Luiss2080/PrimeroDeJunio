/* PRIMERO DE JUNIO - SIDEBAR JAVASCRIPT DEL SISTEMA */
/* Funcionalidades para el sidebar del sistema basado en el sitio web */

class SidebarSystem {
  constructor() {
    this.sidebar = null;
    this.toggleBtn = null;
    this.overlay = null;
    this.navItems = [];
    this.submenuItems = [];
    this.isCompact = false;
    this.isMobile = false;

    this.init();
  }

  init() {
    this.setupElements();
    this.setupToggle();
    this.setupNavigation();
    this.setupSubmenu();
    this.setupUserProfile();
    this.setupResponsive();
    this.setupKeyboardNavigation();
    this.initializeAnimations();
    this.loadUserStats();
  }

  setupElements() {
    this.sidebar = document.querySelector(".sidebar");
    this.toggleBtn = document.querySelector(".sidebar-toggle");
    this.overlay = document.querySelector(".sidebar-overlay");
    this.navItems = document.querySelectorAll(".nav-item");
    this.submenuItems = document.querySelectorAll(".nav-item.has-submenu");
  }

  // ===== TOGGLE DEL SIDEBAR =====
  setupToggle() {
    if (!this.toggleBtn) return;

    this.toggleBtn.addEventListener("click", () => {
      this.toggleSidebar();
    });

    // Auto-collapse en pantallas pequeñas
    this.checkScreenSize();
    window.addEventListener("resize", () => {
      this.checkScreenSize();
    });
  }

  toggleSidebar() {
    if (this.isMobile) {
      this.toggleMobileSidebar();
    } else {
      this.toggleCompactSidebar();
    }
  }

  toggleCompactSidebar() {
    this.isCompact = !this.isCompact;
    this.sidebar?.classList.toggle("compact", this.isCompact);

    // Guardar estado en localStorage
    localStorage.setItem("sidebarCompact", this.isCompact.toString());

    // Animación del botón
    this.animateToggleButton();

    // Notificar cambio de layout
    this.notifyLayoutChange();
  }

  toggleMobileSidebar() {
    const isOpen = this.sidebar?.classList.contains("open");

    this.sidebar?.classList.toggle("open");
    this.overlay?.classList.toggle("active");

    if (!isOpen) {
      this.animateSidebarOpen();
    } else {
      this.animateSidebarClose();
    }
  }

  animateToggleButton() {
    if (!this.toggleBtn) return;

    gsap.to(this.toggleBtn, {
      rotation: this.isCompact ? 180 : 0,
      scale: 1.1,
      duration: 0.3,
      ease: "back.out(1.7)",
      onComplete: () => {
        gsap.to(this.toggleBtn, {
          scale: 1,
          duration: 0.2,
        });
      },
    });
  }

  checkScreenSize() {
    const isMobile = window.innerWidth <= 768;

    if (isMobile !== this.isMobile) {
      this.isMobile = isMobile;

      if (isMobile) {
        this.sidebar?.classList.remove("compact");
        this.sidebar?.classList.remove("open");
        this.overlay?.classList.remove("active");
      } else {
        // Restaurar estado de compact mode
        const savedCompact = localStorage.getItem("sidebarCompact") === "true";
        this.isCompact = savedCompact;
        this.sidebar?.classList.toggle("compact", savedCompact);
      }
    }
  }

  // ===== NAVEGACIÓN =====
  setupNavigation() {
    this.navItems.forEach((item) => {
      const link = item.querySelector(".nav-link");
      if (!link) return;

      // Efecto hover mejorado
      link.addEventListener("mouseenter", () => {
        this.animateNavItemHover(item, true);
      });

      link.addEventListener("mouseleave", () => {
        this.animateNavItemHover(item, false);
      });

      // Click navigation
      link.addEventListener("click", (e) => {
        if (
          link.getAttribute("href") === "#" ||
          item.classList.contains("has-submenu")
        ) {
          e.preventDefault();
          this.handleNavClick(item);
        } else {
          this.setActiveNavItem(item);
        }
      });
    });

    // Establecer item activo basado en URL actual
    this.setActiveBasedOnUrl();
  }

  animateNavItemHover(item, isEntering) {
    const link = item.querySelector(".nav-link");
    const icon = item.querySelector(".nav-icon");

    if (!link) return;

    if (isEntering) {
      gsap.to(link, {
        x: 5,
        backgroundColor: "rgba(0, 255, 102, 0.1)",
        duration: 0.3,
        ease: "power2.out",
      });

      if (icon) {
        gsap.to(icon, {
          scale: 1.1,
          rotate: 5,
          duration: 0.3,
          ease: "back.out(1.7)",
        });
      }

      // Efecto de brillo
      this.createShineEffect(link);
    } else {
      gsap.to(link, {
        x: 0,
        backgroundColor: "transparent",
        duration: 0.3,
        ease: "power2.out",
      });

      if (icon) {
        gsap.to(icon, {
          scale: 1,
          rotate: 0,
          duration: 0.3,
          ease: "power2.out",
        });
      }
    }
  }

  createShineEffect(element) {
    // Crear efecto de brillo que se mueve de izquierda a derecha
    const shine = document.createElement("div");
    shine.className = "nav-shine-effect";
    shine.style.cssText = `
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            pointer-events: none;
            z-index: 1;
        `;

    element.style.position = "relative";
    element.appendChild(shine);

    gsap.to(shine, {
      left: "100%",
      duration: 0.6,
      ease: "power2.out",
      onComplete: () => {
        shine.remove();
      },
    });
  }

  handleNavClick(item) {
    if (item.classList.contains("has-submenu")) {
      this.toggleSubmenu(item);
    } else {
      this.setActiveNavItem(item);
      // Cerrar sidebar móvil después de navegación
      if (this.isMobile) {
        this.toggleMobileSidebar();
      }
    }
  }

  setActiveNavItem(item) {
    // Remover active de todos los items
    this.navItems.forEach((navItem) => {
      navItem.querySelector(".nav-link")?.classList.remove("active");
    });

    // Agregar active al item actual
    item.querySelector(".nav-link")?.classList.add("active");

    // Animación de activación
    this.animateActiveItem(item);
  }

  animateActiveItem(item) {
    const link = item.querySelector(".nav-link");
    if (!link) return;

    // Efecto de pulso
    gsap.fromTo(
      link,
      { scale: 1 },
      {
        scale: 1.05,
        duration: 0.2,
        yoyo: true,
        repeat: 1,
        ease: "power2.inOut",
      }
    );

    // Efecto de highlight
    gsap.fromTo(
      link,
      { boxShadow: "0 0 0 0 rgba(0, 255, 102, 0.3)" },
      {
        boxShadow: "0 0 20px 5px rgba(0, 255, 102, 0.1)",
        duration: 0.5,
        ease: "power2.out",
      }
    );
  }

  setActiveBasedOnUrl() {
    const currentPath = window.location.pathname;

    this.navItems.forEach((item) => {
      const link = item.querySelector(".nav-link");
      if (link && link.getAttribute("href") === currentPath) {
        this.setActiveNavItem(item);
      }
    });
  }

  // ===== SUBMENÚS =====
  setupSubmenu() {
    this.submenuItems.forEach((item) => {
      const submenu = item.querySelector(".submenu");
      if (!submenu) return;

      // Configurar altura inicial
      submenu.style.maxHeight = "0px";

      // Configurar eventos de submenu items
      const submenuLinks = submenu.querySelectorAll(".nav-link");
      submenuLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
          if (link.getAttribute("href") !== "#") {
            this.setActiveSubmenuItem(link);
            if (this.isMobile) {
              this.toggleMobileSidebar();
            }
          }
        });
      });
    });
  }

  toggleSubmenu(parentItem) {
    const submenu = parentItem.querySelector(".submenu");
    const arrow = parentItem.querySelector(".nav-arrow");

    if (!submenu) return;

    const isOpen = parentItem.classList.contains("open");

    // Cerrar otros submenús si no es compact mode
    if (!this.isCompact && !isOpen) {
      this.closeAllSubmenus();
    }

    if (isOpen) {
      this.closeSubmenu(parentItem);
    } else {
      this.openSubmenu(parentItem);
    }
  }

  openSubmenu(parentItem) {
    const submenu = parentItem.querySelector(".submenu");
    const arrow = parentItem.querySelector(".nav-arrow");

    if (!submenu) return;

    parentItem.classList.add("open");

    // Calcular altura real del submenu
    submenu.style.maxHeight = "none";
    const height = submenu.scrollHeight;
    submenu.style.maxHeight = "0px";

    // Animar apertura
    gsap.to(submenu, {
      maxHeight: height + "px",
      duration: 0.4,
      ease: "power3.out",
      onComplete: () => {
        submenu.style.maxHeight = "none";
      },
    });

    // Rotar arrow
    if (arrow) {
      gsap.to(arrow, {
        rotation: 90,
        duration: 0.3,
        ease: "power2.out",
      });
    }

    // Animar items del submenu
    this.animateSubmenuItems(submenu, true);
  }

  closeSubmenu(parentItem) {
    const submenu = parentItem.querySelector(".submenu");
    const arrow = parentItem.querySelector(".nav-arrow");

    if (!submenu) return;

    parentItem.classList.remove("open");

    gsap.to(submenu, {
      maxHeight: "0px",
      duration: 0.3,
      ease: "power2.in",
    });

    // Rotar arrow de vuelta
    if (arrow) {
      gsap.to(arrow, {
        rotation: 0,
        duration: 0.3,
        ease: "power2.out",
      });
    }

    // Animar items del submenu saliendo
    this.animateSubmenuItems(submenu, false);
  }

  closeAllSubmenus() {
    this.submenuItems.forEach((item) => {
      if (item.classList.contains("open")) {
        this.closeSubmenu(item);
      }
    });
  }

  animateSubmenuItems(submenu, isOpening) {
    const items = submenu.querySelectorAll(".nav-link");

    items.forEach((item, index) => {
      if (isOpening) {
        gsap.fromTo(
          item,
          { opacity: 0, x: -20 },
          {
            opacity: 1,
            x: 0,
            duration: 0.3,
            delay: index * 0.05,
            ease: "power2.out",
          }
        );
      } else {
        gsap.to(item, {
          opacity: 0,
          x: -20,
          duration: 0.2,
          delay: index * 0.02,
          ease: "power2.in",
        });
      }
    });
  }

  setActiveSubmenuItem(link) {
    // Remover active de todos los submenu items
    document.querySelectorAll(".submenu .nav-link").forEach((item) => {
      item.classList.remove("active");
    });

    // Agregar active al item actual
    link.classList.add("active");

    // Asegurar que el submenu padre esté abierto
    const parentSubmenu = link.closest(".submenu");
    const parentItem = parentSubmenu?.closest(".nav-item.has-submenu");

    if (parentItem && !parentItem.classList.contains("open")) {
      this.openSubmenu(parentItem);
    }
  }

  // ===== PERFIL DE USUARIO =====
  setupUserProfile() {
    const profileContainer = this.sidebar?.querySelector(
      ".user-profile-sidebar"
    );
    if (!profileContainer) return;

    profileContainer.addEventListener("click", () => {
      this.showUserProfileModal();
    });

    // Efecto hover en avatar
    const avatar = profileContainer.querySelector(".profile-avatar");
    if (avatar) {
      avatar.addEventListener("mouseenter", () => {
        gsap.to(avatar, {
          scale: 1.05,
          rotate: 5,
          duration: 0.3,
          ease: "back.out(1.7)",
        });
      });

      avatar.addEventListener("mouseleave", () => {
        gsap.to(avatar, {
          scale: 1,
          rotate: 0,
          duration: 0.3,
          ease: "power2.out",
        });
      });
    }
  }

  showUserProfileModal() {
    // Implementar modal de perfil de usuario
    console.log("Abriendo modal de perfil...");
    // TODO: Implementar modal de perfil
  }

  updateUserProfile(userData) {
    const nameElement = this.sidebar?.querySelector(".profile-name");
    const roleElement = this.sidebar?.querySelector(".profile-role");
    const avatarElement = this.sidebar?.querySelector(".profile-avatar");

    if (nameElement) nameElement.textContent = userData.name;
    if (roleElement) roleElement.textContent = userData.role;
    if (avatarElement)
      avatarElement.textContent = userData.name.charAt(0).toUpperCase();

    // Animación de actualización
    [nameElement, roleElement, avatarElement].forEach((element) => {
      if (element) {
        gsap.fromTo(
          element,
          { scale: 0.9, opacity: 0.7 },
          { scale: 1, opacity: 1, duration: 0.3, ease: "power2.out" }
        );
      }
    });
  }

  // ===== ESTADÍSTICAS DE USUARIO =====
  async loadUserStats() {
    const statsContainer = this.sidebar?.querySelector(".user-stats");
    if (!statsContainer) return;

    try {
      const response = await fetch("/api/user/stats");
      const data = await response.json();

      if (data.success) {
        this.updateUserStats(data.stats);
      }
    } catch (error) {
      console.error("Error cargando estadísticas:", error);
    }
  }

  updateUserStats(stats) {
    const statsGrid = this.sidebar?.querySelector(".stats-grid");
    if (!statsGrid) return;

    const statsHTML = Object.entries(stats)
      .map(
        ([key, value]) => `
            <div class="stat-item">
                <div class="stat-value">${value}</div>
                <div class="stat-label">${key}</div>
            </div>
        `
      )
      .join("");

    statsGrid.innerHTML = statsHTML;

    // Animar contadores
    this.animateStatCounters();
  }

  animateStatCounters() {
    const statValues = this.sidebar?.querySelectorAll(".stat-value");

    statValues?.forEach((element) => {
      const finalValue = parseInt(element.textContent) || 0;
      element.textContent = "0";

      gsap.to(
        { value: 0 },
        {
          value: finalValue,
          duration: 1.5,
          ease: "power2.out",
          onUpdate: function () {
            element.textContent = Math.round(this.targets()[0].value);
          },
        }
      );
    });
  }

  // ===== NAVEGACIÓN POR TECLADO =====
  setupKeyboardNavigation() {
    document.addEventListener("keydown", (e) => {
      if (e.ctrlKey || e.metaKey) {
        switch (e.key) {
          case "b":
            e.preventDefault();
            this.toggleSidebar();
            break;
          case "[":
            e.preventDefault();
            this.navigatePrevious();
            break;
          case "]":
            e.preventDefault();
            this.navigateNext();
            break;
        }
      }
    });
  }

  navigatePrevious() {
    const activeItem = this.sidebar?.querySelector(".nav-link.active");
    if (!activeItem) return;

    const allLinks = Array.from(
      this.sidebar?.querySelectorAll(".nav-link") || []
    );
    const currentIndex = allLinks.indexOf(activeItem);

    if (currentIndex > 0) {
      const previousLink = allLinks[currentIndex - 1];
      this.navigateToLink(previousLink);
    }
  }

  navigateNext() {
    const activeItem = this.sidebar?.querySelector(".nav-link.active");
    if (!activeItem) return;

    const allLinks = Array.from(
      this.sidebar?.querySelectorAll(".nav-link") || []
    );
    const currentIndex = allLinks.indexOf(activeItem);

    if (currentIndex < allLinks.length - 1) {
      const nextLink = allLinks[currentIndex + 1];
      this.navigateToLink(nextLink);
    }
  }

  navigateToLink(link) {
    const href = link.getAttribute("href");
    if (href && href !== "#") {
      window.location.href = href;
    }
  }

  // ===== RESPONSIVE =====
  setupResponsive() {
    // Cerrar sidebar móvil cuando se hace click en overlay
    this.overlay?.addEventListener("click", () => {
      if (this.isMobile) {
        this.toggleMobileSidebar();
      }
    });

    // Cerrar con tecla Escape
    document.addEventListener("keydown", (e) => {
      if (
        e.key === "Escape" &&
        this.isMobile &&
        this.sidebar?.classList.contains("open")
      ) {
        this.toggleMobileSidebar();
      }
    });
  }

  // ===== ANIMACIONES INICIALES =====
  initializeAnimations() {
    // Animación de entrada del sidebar
    if (this.sidebar) {
      gsap.fromTo(
        this.sidebar,
        { x: -300, opacity: 0 },
        {
          x: 0,
          opacity: 1,
          duration: 0.6,
          ease: "power3.out",
        }
      );
    }

    // Animación escalonada de nav items
    this.navItems.forEach((item, index) => {
      gsap.fromTo(
        item,
        { x: -50, opacity: 0 },
        {
          x: 0,
          opacity: 1,
          duration: 0.4,
          delay: 0.1 + index * 0.05,
          ease: "power2.out",
        }
      );
    });

    // Animación del user profile
    const userProfile = this.sidebar?.querySelector(".user-profile-sidebar");
    if (userProfile) {
      gsap.fromTo(
        userProfile,
        { scale: 0.9, opacity: 0 },
        {
          scale: 1,
          opacity: 1,
          duration: 0.5,
          delay: 0.3,
          ease: "back.out(1.7)",
        }
      );
    }
  }

  animateSidebarOpen() {
    gsap.fromTo(
      this.sidebar,
      { x: "-100%" },
      {
        x: "0%",
        duration: 0.4,
        ease: "power3.out",
      }
    );

    gsap.fromTo(
      this.overlay,
      { opacity: 0 },
      {
        opacity: 1,
        duration: 0.3,
        ease: "power2.out",
      }
    );
  }

  animateSidebarClose() {
    gsap.to(this.sidebar, {
      x: "-100%",
      duration: 0.3,
      ease: "power2.in",
    });

    gsap.to(this.overlay, {
      opacity: 0,
      duration: 0.2,
      ease: "power2.in",
    });
  }

  // ===== NOTIFICACIÓN DE CAMBIO DE LAYOUT =====
  notifyLayoutChange() {
    // Disparar evento para que otros componentes se ajusten
    const event = new CustomEvent("sidebarLayoutChange", {
      detail: { isCompact: this.isCompact },
    });
    window.dispatchEvent(event);
  }

  // ===== MÉTODOS PÚBLICOS =====
  addMenuItem(menuData, parentSelector = ".sidebar-nav .nav-menu") {
    const parentMenu = this.sidebar?.querySelector(parentSelector);
    if (!parentMenu) return;

    const menuItem = document.createElement("li");
    menuItem.className = "nav-item";
    menuItem.innerHTML = `
            <a href="${menuData.url || "#"}" class="nav-link">
                <i class="nav-icon ${menuData.icon}"></i>
                <span class="nav-label">${menuData.label}</span>
                ${
                  menuData.badge
                    ? `<span class="nav-badge">${menuData.badge}</span>`
                    : ""
                }
                ${
                  menuData.submenu
                    ? '<i class="nav-arrow fas fa-chevron-right"></i>'
                    : ""
                }
            </a>
            ${
              menuData.submenu
                ? `
                <ul class="submenu">
                    ${menuData.submenu
                      .map(
                        (subitem) => `
                        <li class="nav-item">
                            <a href="${subitem.url || "#"}" class="nav-link">
                                <i class="nav-icon ${subitem.icon}"></i>
                                <span class="nav-label">${subitem.label}</span>
                            </a>
                        </li>
                    `
                      )
                      .join("")}
                </ul>
            `
                : ""
            }
        `;

    parentMenu.appendChild(menuItem);

    // Reconfigurar eventos
    this.setupNavigation();
    if (menuData.submenu) {
      this.setupSubmenu();
    }

    // Animar entrada del nuevo item
    gsap.fromTo(
      menuItem,
      { opacity: 0, x: -30 },
      { opacity: 1, x: 0, duration: 0.4, ease: "power2.out" }
    );
  }

  removeMenuItem(selector) {
    const menuItem = this.sidebar?.querySelector(selector);
    if (!menuItem) return;

    gsap.to(menuItem, {
      opacity: 0,
      x: -30,
      duration: 0.3,
      ease: "power2.in",
      onComplete: () => {
        menuItem.remove();
      },
    });
  }

  updateMenuBadge(selector, badgeText) {
    const menuLink = this.sidebar?.querySelector(selector);
    if (!menuLink) return;

    let badge = menuLink.querySelector(".nav-badge");

    if (badgeText) {
      if (!badge) {
        badge = document.createElement("span");
        badge.className = "nav-badge";
        menuLink.appendChild(badge);
      }
      badge.textContent = badgeText;

      // Animación de actualización
      gsap.fromTo(
        badge,
        { scale: 1.2, backgroundColor: "rgba(0, 255, 102, 0.8)" },
        { scale: 1, backgroundColor: "", duration: 0.4, ease: "power2.out" }
      );
    } else if (badge) {
      gsap.to(badge, {
        scale: 0,
        opacity: 0,
        duration: 0.2,
        ease: "power2.in",
        onComplete: () => {
          badge.remove();
        },
      });
    }
  }

  setCompactMode(isCompact) {
    this.isCompact = isCompact;
    this.sidebar?.classList.toggle("compact", isCompact);
    this.animateToggleButton();
    this.notifyLayoutChange();
  }
}

// Inicializar cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
  window.sidebarSystem = new SidebarSystem();
});

// Escuchar cambios en el layout desde otros componentes
window.addEventListener("sidebarLayoutChange", (e) => {
  console.log("Layout del sidebar cambió:", e.detail);
});

// CSS adicional para animaciones dinámicas
const sidebarStyles = `
.nav-shine-effect {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    pointer-events: none;
    z-index: 1;
}

.sidebar-loading .nav-item {
    opacity: 0.6;
    pointer-events: none;
}

.nav-item.loading .nav-link::after {
    content: '';
    position: absolute;
    right: 1rem;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(0, 255, 102, 0.3);
    border-top: 2px solid var(--primary-green);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.nav-item.new .nav-link::before {
    content: 'NUEVO';
    position: absolute;
    top: -8px;
    right: 0;
    background: #dc2626;
    color: white;
    font-size: 0.6rem;
    padding: 2px 6px;
    border-radius: 8px;
    font-weight: 600;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
        transform: translate3d(0,0,0);
    }
    40%, 43% {
        transform: translate3d(0,-8px,0);
    }
    70% {
        transform: translate3d(0,-4px,0);
    }
    90% {
        transform: translate3d(0,-2px,0);
    }
}

.sidebar.mobile-open {
    transform: translateX(0);
}

.sidebar.mobile-closing {
    transform: translateX(-100%);
}
`;

// Agregar estilos al documento
const sidebarStyleElement = document.createElement("style");
sidebarStyleElement.textContent = sidebarStyles;
document.head.appendChild(sidebarStyleElement);
