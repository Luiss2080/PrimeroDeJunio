/**
 * PRIMERO DE JUNIO - HEADER JAVASCRIPT PROFESIONAL
 * Funcionalidades optimizadas para header del sistema - Basado en el sitio web
 */

class HeaderManager {
  constructor() {
    this.header = null;
    this.userDropdown = null;
    this.notificationDropdown = null;
    this.menuToggle = null;
    this.searchInput = null;
    this.searchContainer = null;
    this.loadingBar = null;
    this.isUserDropdownOpen = false;
    this.isNotificationDropdownOpen = false;
    this.searchTimeout = null;

    this.init();
  }

  init() {
    this.bindElements();
    this.bindEvents();
    this.setupSearch();
    this.setupNotifications();
    this.handleScrollEffects();
    this.setupPlaceholderAnimation();
  }

  bindElements() {
    this.header = document.querySelector(".header");
    this.userDropdown = document.querySelector(".user-dropdown");
    this.notificationDropdown = document.querySelector(
      ".notification-dropdown"
    );
    this.menuToggle = document.querySelector(".menu-toggle");
    this.searchInput = document.querySelector(".search-input");
    this.searchContainer = document.querySelector(".search-container");
    this.loadingBar = document.querySelector(".loading-bar");
  }

  bindEvents() {
    // User dropdown
    if (this.userDropdown) {
      const userBtn = this.userDropdown.querySelector(".user-btn");
      const userMenu = this.userDropdown.querySelector(".dropdown-menu");

      if (userBtn && userMenu) {
        userBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          this.toggleUserDropdown();
        });
      }
    }

    // Notification dropdown
    if (this.notificationDropdown) {
      const notificationBtn =
        this.notificationDropdown.querySelector(".notification-btn");
      const notificationMenu =
        this.notificationDropdown.querySelector(".dropdown-menu");

      if (notificationBtn && notificationMenu) {
        notificationBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          this.toggleNotificationDropdown();
        });
      }
    }

    // Menu toggle para móvil
    if (this.menuToggle) {
      this.menuToggle.addEventListener("click", () => {
        this.toggleMobileMenu();
      });
    }

    // Cerrar dropdowns al hacer click fuera
    document.addEventListener("click", (e) => {
      if (!this.userDropdown?.contains(e.target)) {
        this.closeUserDropdown();
      }
      if (!this.notificationDropdown?.contains(e.target)) {
        this.closeNotificationDropdown();
      }
    });

    // Cerrar con ESC
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        this.closeAllDropdowns();
      }
    });

    // Scroll effects
    window.addEventListener("scroll", () => {
      this.handleScroll();
    });

    // Resize events
    window.addEventListener("resize", () => {
      this.handleResize();
    });
  }

  setupSearch() {
    if (!this.searchInput) return;

    // Input event with debounce
    this.searchInput.addEventListener("input", (e) => {
      clearTimeout(this.searchTimeout);
      const query = e.target.value.trim();

      this.searchTimeout = setTimeout(() => {
        if (query.length >= 2) {
          this.performSearch(query);
        } else {
          this.hideSearchResults();
        }
      }, 300);
    });

    // Enter key
    this.searchInput.addEventListener("keydown", (e) => {
      if (e.key === "Enter") {
        e.preventDefault();
        const query = e.target.value.trim();
        if (query.length >= 2) {
          this.performSearch(query);
        }
      }
    });

    // Focus effects
    this.searchInput.addEventListener("focus", () => {
      this.searchContainer?.classList.add("focused");
    });

    this.searchInput.addEventListener("blur", () => {
      setTimeout(() => {
        this.searchContainer?.classList.remove("focused");
        this.hideSearchResults();
      }, 200);
    });
  }

  setupNotifications() {
    // Mark all as read
    const markAllReadBtn = document.querySelector(".mark-all-read");
    if (markAllReadBtn) {
      markAllReadBtn.addEventListener("click", () => {
        this.markAllNotificationsAsRead();
      });
    }

    // Update notification count periodically
    this.updateNotificationCount();
    setInterval(() => {
      this.updateNotificationCount();
    }, 30000); // Every 30 seconds
  }

  setupPlaceholderAnimation() {
    if (!this.searchInput) return;

    const placeholders = [
      "Buscar usuarios...",
      "Buscar vehículos...",
      "Buscar conductores...",
      "Buscar viajes...",
      "Buscar reportes...",
      "Buscar tarifas...",
    ];

    let currentIndex = 0;

    setInterval(() => {
      currentIndex = (currentIndex + 1) % placeholders.length;
      this.searchInput.placeholder = placeholders[currentIndex];
    }, 3000);
  }

  toggleUserDropdown() {
    if (this.isUserDropdownOpen) {
      this.closeUserDropdown();
    } else {
      this.closeNotificationDropdown(); // Close other dropdown first
      this.openUserDropdown();
    }
  }

  openUserDropdown() {
    const userMenu = this.userDropdown?.querySelector(".dropdown-menu");
    if (!userMenu) return;

    this.userDropdown.classList.add("active");
    userMenu.classList.add("show");
    userMenu.classList.add("fade-in");
    this.isUserDropdownOpen = true;

    // Remove animation class after animation completes
    setTimeout(() => {
      userMenu.classList.remove("fade-in");
    }, 300);
  }

  closeUserDropdown() {
    const userMenu = this.userDropdown?.querySelector(".dropdown-menu");
    if (!userMenu) return;

    this.userDropdown.classList.remove("active");
    userMenu.classList.remove("show");
    this.isUserDropdownOpen = false;
  }

  toggleNotificationDropdown() {
    if (this.isNotificationDropdownOpen) {
      this.closeNotificationDropdown();
    } else {
      this.closeUserDropdown(); // Close other dropdown first
      this.openNotificationDropdown();
    }
  }

  openNotificationDropdown() {
    const notificationMenu =
      this.notificationDropdown?.querySelector(".dropdown-menu");
    if (!notificationMenu) return;

    this.notificationDropdown.classList.add("active");
    notificationMenu.classList.add("show");
    notificationMenu.classList.add("slide-down");
    this.isNotificationDropdownOpen = true;

    // Remove animation class after animation completes
    setTimeout(() => {
      notificationMenu.classList.remove("slide-down");
    }, 300);
  }

  closeNotificationDropdown() {
    const notificationMenu =
      this.notificationDropdown?.querySelector(".dropdown-menu");
    if (!notificationMenu) return;

    this.notificationDropdown.classList.remove("active");
    notificationMenu.classList.remove("show");
    this.isNotificationDropdownOpen = false;
  }

  closeAllDropdowns() {
    this.closeUserDropdown();
    this.closeNotificationDropdown();
  }

  toggleMobileMenu() {
    // This would interact with sidebar - implement based on sidebar structure
    console.log("Toggle mobile menu");

    // Add event to show/hide sidebar or mobile navigation
    const sidebar = document.querySelector(".sidebar");
    if (sidebar) {
      sidebar.classList.toggle("show");
    }
  }

  performSearch(query) {
    console.log("Searching for:", query);

    // Show loading
    this.showLoadingBar();

    // Here you would implement the actual search functionality
    // For now, we'll just simulate a search
    setTimeout(() => {
      this.hideLoadingBar();
      this.showSearchResults(query);
    }, 800);
  }

  showSearchResults(query) {
    const searchResults =
      this.searchContainer?.querySelector(".search-results");
    if (!searchResults) return;

    // Mock search results
    searchResults.innerHTML = `
      <div class="search-results-content">
        <div class="search-result-item">
          <i class="fas fa-users"></i>
          <span>Buscar usuarios: "${query}"</span>
        </div>
        <div class="search-result-item">
          <i class="fas fa-car"></i>
          <span>Buscar vehículos: "${query}"</span>
        </div>
        <div class="search-result-item">
          <i class="fas fa-route"></i>
          <span>Buscar viajes: "${query}"</span>
        </div>
      </div>
    `;

    searchResults.classList.add("show");
  }

  hideSearchResults() {
    const searchResults =
      this.searchContainer?.querySelector(".search-results");
    if (searchResults) {
      searchResults.classList.remove("show");
    }
  }

  showLoadingBar() {
    if (this.loadingBar) {
      this.loadingBar.classList.add("active");
    }
  }

  hideLoadingBar() {
    if (this.loadingBar) {
      this.loadingBar.classList.remove("active");
    }
  }

  updateNotificationCount() {
    const badge = document.querySelector(".notification-badge");
    if (!badge) return;

    // Simulate getting notification count from server
    const count = Math.floor(Math.random() * 8);

    if (count > 0) {
      badge.textContent = count;
      badge.style.display = "block";

      // Add pulse animation
      const notificationBtn = document.querySelector(".notification-btn");
      if (notificationBtn) {
        notificationBtn.classList.add("pulse");
        setTimeout(() => {
          notificationBtn.classList.remove("pulse");
        }, 2000);
      }
    } else {
      badge.style.display = "none";
    }
  }

  markAllNotificationsAsRead() {
    // Mark all notifications as read
    const unreadItems = document.querySelectorAll(".notification-item.unread");
    unreadItems.forEach((item) => {
      item.classList.remove("unread");
    });

    // Hide notification badge
    const badge = document.querySelector(".notification-badge");
    if (badge) {
      badge.style.display = "none";
    }

    // Show success feedback
    this.showNotification(
      "Todas las notificaciones marcadas como leídas",
      "success"
    );
  }

  handleScroll() {
    const scrollY = window.scrollY;

    if (scrollY > 50) {
      this.header?.classList.add("scrolled");
    } else {
      this.header?.classList.remove("scrolled");
    }
  }

  handleResize() {
    // Close dropdowns on resize
    if (window.innerWidth <= 768) {
      this.closeAllDropdowns();
    }
  }

  handleScrollEffects() {
    let lastScrollY = window.scrollY;

    window.addEventListener("scroll", () => {
      const currentScrollY = window.scrollY;

      // Hide/show header based on scroll direction
      if (currentScrollY > lastScrollY && currentScrollY > 100) {
        this.header?.style.setProperty("transform", "translateY(-100%)");
      } else {
        this.header?.style.setProperty("transform", "translateY(0)");
      }

      lastScrollY = currentScrollY;
    });
  }

  showNotification(message, type = "info") {
    // Create notification toast
    const notification = document.createElement("div");
    notification.className = `notification-toast ${type}`;
    notification.innerHTML = `
      <i class="fas ${
        type === "success" ? "fa-check-circle" : "fa-info-circle"
      }"></i>
      <span>${message}</span>
    `;

    document.body.appendChild(notification);

    // Show notification
    setTimeout(() => {
      notification.classList.add("show");
    }, 100);

    // Remove notification after 3 seconds
    setTimeout(() => {
      notification.classList.remove("show");
      setTimeout(() => {
        notification.remove();
      }, 300);
    }, 3000);
  }
}

// CSS adicional dinámico para efectos y notificaciones
const additionalStyles = `
.notification-toast {
  position: fixed;
  top: 100px;
  right: 20px;
  background: rgba(0, 0, 0, 0.95);
  backdrop-filter: blur(15px);
  border: 1px solid rgba(0, 255, 102, 0.3);
  border-radius: var(--border-radius-large);
  padding: 16px 20px;
  color: var(--white);
  font-size: 14px;
  font-weight: 500;
  z-index: 10000;
  transform: translateX(400px);
  opacity: 0;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  gap: 10px;
  max-width: 350px;
}

.notification-toast.show {
  transform: translateX(0);
  opacity: 1;
}

.notification-toast.success {
  border-color: rgba(0, 255, 102, 0.5);
  background: rgba(0, 255, 102, 0.1);
}

.notification-toast.success i {
  color: var(--primary-green);
}

.search-results-content {
  padding: 10px 0;
}

.search-result-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 20px;
  color: var(--white);
  cursor: pointer;
  transition: var(--transition-fast);
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.search-result-item:hover {
  background: rgba(0, 255, 102, 0.1);
  color: var(--primary-green);
}

.search-result-item:last-child {
  border-bottom: none;
}

.search-result-item i {
  width: 16px;
  text-align: center;
  color: var(--primary-green);
}

.search-container.focused .search-input {
  border-color: var(--primary-green);
  background: rgba(0, 255, 102, 0.08);
  box-shadow: 0 0 0 2px rgba(0, 255, 102, 0.25);
}

.header {
  transition: transform var(--transition-smooth), 
              background var(--transition-fast),
              box-shadow var(--transition-fast);
}

@media (max-width: 768px) {
  .notification-toast {
    left: 20px;
    right: 20px;
    max-width: none;
    transform: translateY(-100px);
  }
  
  .notification-toast.show {
    transform: translateY(0);
  }
}
`;

// Inyectar estilos adicionales
const styleSheet = document.createElement("style");
styleSheet.textContent = additionalStyles;
document.head.appendChild(styleSheet);

// Inicializar cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
  new HeaderManager();
});

// Exportar para uso global si es necesario
window.HeaderManager = HeaderManager;
