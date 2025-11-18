/**
 * SISTEMA PRIMERO DE JUNIO - HEADER JAVASCRIPT
 * JavaScript moderno para interacciones del header
 */

document.addEventListener("DOMContentLoaded", function () {
  // === ELEMENTOS DEL HEADER ===
  const sidebarToggle = document.getElementById("sidebarToggle");
  const notificationBtn = document.getElementById("notificationBtn");
  const notificationsDropdown = document.getElementById(
    "notificationsDropdown"
  );
  const userProfileBtn = document.getElementById("userProfileBtn");
  const userDropdown = document.getElementById("userDropdown");
  const headerOverlay = document.getElementById("headerOverlay");
  const globalSearch = document.getElementById("globalSearch");

  // === VARIABLES DE ESTADO ===
  let activeDropdown = null;
  let searchTimeout = null;

  // === TOGGLE SIDEBAR ===
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function () {
      toggleSidebar();
    });
  }

  // === NOTIFICACIONES ===
  if (notificationBtn && notificationsDropdown) {
    notificationBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      toggleDropdown("notifications");
    });
  }

  // === PERFIL DE USUARIO ===
  if (userProfileBtn && userDropdown) {
    userProfileBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      toggleDropdown("user");
    });
  }

  // === OVERLAY ===
  if (headerOverlay) {
    headerOverlay.addEventListener("click", function () {
      closeAllDropdowns();
    });
  }

  // === BÚSQUEDA GLOBAL ===
  if (globalSearch) {
    globalSearch.addEventListener("input", function (e) {
      handleGlobalSearch(e.target.value);
    });

    globalSearch.addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        performSearch(e.target.value);
      }
    });

    // Focus con Ctrl+K
    document.addEventListener("keydown", function (e) {
      if (e.ctrlKey && e.key === "k") {
        e.preventDefault();
        globalSearch.focus();
        globalSearch.select();
      }
    });
  }

  // === CERRAR DROPDOWNS AL HACER CLIC FUERA ===
  document.addEventListener("click", function (e) {
    if (
      !e.target.closest(".notifications-container") &&
      !e.target.closest(".user-profile-container")
    ) {
      closeAllDropdowns();
    }
  });

  // === ESCAPE KEY ===
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      closeAllDropdowns();
    }
  });

  // === FUNCIONES ===

  /**
   * Toggle del sidebar
   */
  function toggleSidebar() {
    const sidebar = document.getElementById("systemSidebar");
    const sidebarOverlay = document.getElementById("sidebarOverlay");
    const headerWrapper = document.querySelector(".header-wrapper");

    if (!sidebar) return;

    // En móvil, usar overlay
    if (window.innerWidth <= 768) {
      sidebar.classList.toggle("mobile-open");
      sidebarOverlay?.classList.toggle("show");

      // Prevenir scroll del body
      if (sidebar.classList.contains("mobile-open")) {
        document.body.style.overflow = "hidden";
      } else {
        document.body.style.overflow = "";
      }
    } else {
      // En desktop, colapsar
      sidebar.classList.toggle("collapsed");

      if (headerWrapper) {
        if (sidebar.classList.contains("collapsed")) {
          headerWrapper.classList.add("sidebar-collapsed");
        } else {
          headerWrapper.classList.remove("sidebar-collapsed");
        }
      }
    }

    // Animar el botón
    if (sidebarToggle) {
      sidebarToggle.classList.toggle("active");
    }
  }

  /**
   * Toggle de dropdowns
   */
  function toggleDropdown(type) {
    const dropdown =
      type === "notifications" ? notificationsDropdown : userDropdown;

    if (!dropdown) return;

    // Si ya está activo, cerrar
    if (activeDropdown === type) {
      closeAllDropdowns();
      return;
    }

    // Cerrar otros dropdowns
    closeAllDropdowns();

    // Abrir el dropdown actual
    dropdown.classList.add("show");
    headerOverlay.classList.add("show");
    activeDropdown = type;

    // Animar entrada
    setTimeout(() => {
      dropdown.style.transform = "translateY(0)";
      dropdown.style.opacity = "1";
    }, 10);
  }

  /**
   * Cerrar todos los dropdowns
   */
  function closeAllDropdowns() {
    [notificationsDropdown, userDropdown].forEach((dropdown) => {
      if (dropdown) {
        dropdown.classList.remove("show");
      }
    });

    if (headerOverlay) {
      headerOverlay.classList.remove("show");
    }

    activeDropdown = null;
  }

  /**
   * Manejar búsqueda global
   */
  function handleGlobalSearch(query) {
    // Limpiar timeout anterior
    if (searchTimeout) {
      clearTimeout(searchTimeout);
    }

    // Si la query está vacía, limpiar resultados
    if (!query.trim()) {
      clearSearchResults();
      return;
    }

    // Debounce de 300ms
    searchTimeout = setTimeout(() => {
      performLiveSearch(query);
    }, 300);
  }

  /**
   * Realizar búsqueda en vivo
   */
  function performLiveSearch(query) {
    // Aquí implementarías la lógica de búsqueda
    console.log("Buscando:", query);

    // Ejemplo de implementación con fetch
    /*
        fetch(`/api/search?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displaySearchResults(data);
            })
            .catch(error => {
                console.error('Error en búsqueda:', error);
            });
        */
  }

  /**
   * Realizar búsqueda completa
   */
  function performSearch(query) {
    if (!query.trim()) return;

    // Redirigir a página de búsqueda o mostrar resultados
    window.location.href = `/admin/buscar?q=${encodeURIComponent(query)}`;
  }

  /**
   * Limpiar resultados de búsqueda
   */
  function clearSearchResults() {
    // Implementar lógica para limpiar resultados
  }

  /**
   * Mostrar resultados de búsqueda
   */
  function displaySearchResults(results) {
    // Implementar lógica para mostrar resultados
  }

  // === RESPONSIVE HANDLERS ===

  /**
   * Manejar cambios de tamaño de ventana
   */
  function handleResize() {
    const sidebar = document.getElementById("systemSidebar");
    const sidebarOverlay = document.getElementById("sidebarOverlay");
    const headerWrapper = document.querySelector(".header-wrapper");

    if (!sidebar) return;

    // Si cambiamos a desktop y el sidebar está abierto en móvil, cerrar overlay
    if (window.innerWidth > 768) {
      sidebar.classList.remove("mobile-open");
      sidebarOverlay?.classList.remove("show");
      document.body.style.overflow = "";
    }

    // Ajustar header wrapper según estado del sidebar
    if (headerWrapper && sidebar) {
      if (window.innerWidth <= 768) {
        headerWrapper.classList.remove("sidebar-collapsed");
        headerWrapper.classList.add("sidebar-hidden");
      } else if (window.innerWidth <= 1024) {
        headerWrapper.classList.add("sidebar-collapsed");
        headerWrapper.classList.remove("sidebar-hidden");
      } else {
        headerWrapper.classList.remove("sidebar-hidden");
        if (!sidebar.classList.contains("collapsed")) {
          headerWrapper.classList.remove("sidebar-collapsed");
        }
      }
    }
  }

  // Throttle para resize
  let resizeTimeout;
  window.addEventListener("resize", function () {
    if (resizeTimeout) {
      clearTimeout(resizeTimeout);
    }
    resizeTimeout = setTimeout(handleResize, 100);
  });

  // Ejecutar al cargar
  handleResize();

  // === NOTIFICACIONES EN TIEMPO REAL ===

  /**
   * Actualizar contador de notificaciones
   */
  function updateNotificationCount(count) {
    const badge = document.querySelector(".notification-badge");
    const countSpan = document.querySelector(".notifications-count");

    if (badge) {
      if (count > 0) {
        badge.textContent = count > 99 ? "99+" : count;
        badge.style.display = "flex";
      } else {
        badge.style.display = "none";
      }
    }

    if (countSpan) {
      countSpan.textContent = `${count} nuevas`;
    }

    // Actualizar atributo del botón
    if (notificationBtn) {
      notificationBtn.setAttribute("data-count", count);
    }
  }

  /**
   * Añadir nueva notificación
   */
  function addNotification(notification) {
    const notificationsList = document.querySelector(".notifications-list");

    if (!notificationsList) return;

    const notificationElement = createNotificationElement(notification);

    // Si no hay notificaciones, remover mensaje "no hay notificaciones"
    const noNotifications =
      notificationsList.querySelector(".no-notifications");
    if (noNotifications) {
      noNotifications.remove();
    }

    // Añadir al principio de la lista
    notificationsList.insertBefore(
      notificationElement,
      notificationsList.firstChild
    );

    // Limitar a 5 notificaciones
    const notifications = notificationsList.querySelectorAll(
      ".notification-item:not(.no-notifications)"
    );
    if (notifications.length > 5) {
      notifications[notifications.length - 1].remove();
    }

    // Animar entrada
    notificationElement.style.opacity = "0";
    notificationElement.style.transform = "translateX(-20px)";
    setTimeout(() => {
      notificationElement.style.transition = "all 0.3s ease";
      notificationElement.style.opacity = "1";
      notificationElement.style.transform = "translateX(0)";
    }, 10);
  }

  /**
   * Crear elemento de notificación
   */
  function createNotificationElement(notification) {
    const element = document.createElement("div");
    element.className = "notification-item";
    element.innerHTML = `
            <div class="notification-icon">
                <i class="${notification.icon || "fas fa-info-circle"}"></i>
            </div>
            <div class="notification-content">
                <h4>${escapeHtml(notification.title)}</h4>
                <p>${escapeHtml(notification.message)}</p>
                <small>${notification.time || "Ahora"}</small>
            </div>
        `;
    return element;
  }

  /**
   * Escapar HTML
   */
  function escapeHtml(text) {
    const div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
  }

  // === INICIALIZACIÓN ===

  /**
   * Inicializar header
   */
  function initHeader() {
    // Añadir clase de carga completada
    document.body.classList.add("header-loaded");

    // Inicializar tooltips si es necesario
    initTooltips();

    // Configurar WebSocket para notificaciones en tiempo real
    setupWebSocket();
  }

  /**
   * Inicializar tooltips
   */
  function initTooltips() {
    // Implementar tooltips para elementos que lo necesiten
  }

  /**
   * Configurar WebSocket para notificaciones
   */
  function setupWebSocket() {
    // Implementar conexión WebSocket para notificaciones en tiempo real
    /*
        const ws = new WebSocket('ws://localhost:8080');
        
        ws.onmessage = function(event) {
            const data = JSON.parse(event.data);
            if (data.type === 'notification') {
                addNotification(data.notification);
                updateNotificationCount(data.count);
            }
        };
        */
  }

  // Inicializar cuando el DOM esté listo
  initHeader();

  // === EXPOSER FUNCIONES GLOBALMENTE ===
  window.HeaderManager = {
    toggleSidebar,
    updateNotificationCount,
    addNotification,
    closeAllDropdowns,
  };
});

/**
 * UTILIDADES ADICIONALES
 */

// Función para mostrar mensajes toast
function showToast(message, type = "info") {
  const toast = document.createElement("div");
  toast.className = `toast toast-${type}`;
  toast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-${getToastIcon(type)}"></i>
            <span>${message}</span>
        </div>
    `;

  // Estilos inline para el toast
  Object.assign(toast.style, {
    position: "fixed",
    top: "100px",
    right: "20px",
    background:
      type === "error" ? "#dc3545" : type === "success" ? "#28a745" : "#007bff",
    color: "white",
    padding: "1rem 1.5rem",
    borderRadius: "8px",
    boxShadow: "0 4px 15px rgba(0, 0, 0, 0.2)",
    zIndex: "10000",
    opacity: "0",
    transform: "translateX(100%)",
    transition: "all 0.3s ease",
  });

  document.body.appendChild(toast);

  // Animar entrada
  setTimeout(() => {
    toast.style.opacity = "1";
    toast.style.transform = "translateX(0)";
  }, 10);

  // Remover después de 3 segundos
  setTimeout(() => {
    toast.style.opacity = "0";
    toast.style.transform = "translateX(100%)";
    setTimeout(() => {
      document.body.removeChild(toast);
    }, 300);
  }, 3000);
}

function getToastIcon(type) {
  switch (type) {
    case "success":
      return "check-circle";
    case "error":
      return "exclamation-triangle";
    case "warning":
      return "exclamation-circle";
    default:
      return "info-circle";
  }
}

// Función para confirmar acciones
function confirmAction(message, callback) {
  if (confirm(message)) {
    callback();
  }
}

// Exportar utilidades
window.UIUtils = {
  showToast,
  confirmAction,
};
