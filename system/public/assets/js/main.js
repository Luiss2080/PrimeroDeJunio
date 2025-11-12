/**
 * PRIMERO DE JUNIO - SISTEMA MAIN JAVASCRIPT
 * Funcionalidades principales para el sistema administrativo
 */

// =============================================================================
// INICIALIZACIÓN GLOBAL
// =============================================================================

document.addEventListener("DOMContentLoaded", function () {
  console.log("🚀 PRIMERO DE JUNIO: Sistema administrativo iniciado");

  // Inicializar todas las funcionalidades
  initializeSidebar();
  initializeModals();
  initializeForms();
  initializeTables();
  initializeNotifications();
  initializeTooltips();
  initializeCharts();

  // Efectos visuales
  initializeAnimations();
  initializeCounters();
});

// =============================================================================
// NAVEGACIÓN LATERAL
// =============================================================================

function initializeSidebar() {
  const sidebar = document.querySelector(".sidebar");
  const mobileMenuBtn = document.querySelector(".mobile-menu-btn");
  const navItems = document.querySelectorAll(".nav-item");

  // Toggle sidebar en móvil
  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", () => {
      sidebar.classList.toggle("show");
    });
  }

  // Cerrar sidebar al hacer click fuera en móvil
  document.addEventListener("click", (e) => {
    if (
      window.innerWidth <= 1024 &&
      !sidebar.contains(e.target) &&
      !mobileMenuBtn.contains(e.target)
    ) {
      sidebar.classList.remove("show");
    }
  });

  // Activar item de navegación actual
  const currentPath = window.location.pathname;
  navItems.forEach((item) => {
    if (item.getAttribute("href") === currentPath) {
      item.classList.add("active");
    }
  });

  // Efecto hover en navegación
  navItems.forEach((item) => {
    item.addEventListener("mouseenter", () => {
      item.style.transform = "translateX(5px)";
    });

    item.addEventListener("mouseleave", () => {
      item.style.transform = "translateX(0)";
    });
  });
}

// =============================================================================
// MODALES
// =============================================================================

function initializeModals() {
  const modalTriggers = document.querySelectorAll("[data-modal]");
  const modals = document.querySelectorAll(".modal");
  const modalCloses = document.querySelectorAll(
    '.modal-close, [data-dismiss="modal"]'
  );

  // Abrir modales
  modalTriggers.forEach((trigger) => {
    trigger.addEventListener("click", (e) => {
      e.preventDefault();
      const modalId = trigger.getAttribute("data-modal");
      const modal = document.getElementById(modalId);
      if (modal) {
        openModal(modal);
      }
    });
  });

  // Cerrar modales
  modalCloses.forEach((close) => {
    close.addEventListener("click", () => {
      const modal = close.closest(".modal");
      if (modal) {
        closeModal(modal);
      }
    });
  });

  // Cerrar modal al hacer click en el backdrop
  modals.forEach((modal) => {
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        closeModal(modal);
      }
    });
  });

  // Cerrar modal con ESC
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      const openModal = document.querySelector(".modal.show");
      if (openModal) {
        closeModal(openModal);
      }
    }
  });
}

function openModal(modal) {
  modal.classList.add("show");
  document.body.style.overflow = "hidden";

  // Focus en el primer input del modal
  const firstInput = modal.querySelector("input, select, textarea");
  if (firstInput) {
    setTimeout(() => firstInput.focus(), 100);
  }
}

function closeModal(modal) {
  modal.classList.remove("show");
  document.body.style.overflow = "";
}

// =============================================================================
// FORMULARIOS
// =============================================================================

function initializeForms() {
  const forms = document.querySelectorAll("form");

  forms.forEach((form) => {
    // Validación en tiempo real
    const inputs = form.querySelectorAll("input, select, textarea");
    inputs.forEach((input) => {
      input.addEventListener("blur", () => validateInput(input));
      input.addEventListener("input", () => clearInputError(input));
    });

    // Submit del formulario
    form.addEventListener("submit", (e) => {
      if (!validateForm(form)) {
        e.preventDefault();
        showNotification(
          "Por favor corrige los errores en el formulario",
          "error"
        );
      } else {
        // Mostrar loading en el botón de submit
        const submitBtn = form.querySelector('[type="submit"]');
        if (submitBtn) {
          showButtonLoading(submitBtn);
        }
      }
    });
  });

  // Inicializar selects personalizados
  initializeCustomSelects();
}

function validateInput(input) {
  const value = input.value.trim();
  let isValid = true;
  let errorMessage = "";

  // Limpiar errores previos
  clearInputError(input);

  // Validación requerida
  if (input.hasAttribute("required") && !value) {
    isValid = false;
    errorMessage = "Este campo es requerido";
  }

  // Validación de email
  if (input.type === "email" && value && !isValidEmail(value)) {
    isValid = false;
    errorMessage = "Ingresa un email válido";
  }

  // Validación de teléfono
  if (input.type === "tel" && value && !isValidPhone(value)) {
    isValid = false;
    errorMessage = "Ingresa un teléfono válido";
  }

  // Validación personalizada
  const pattern = input.getAttribute("pattern");
  if (pattern && value && !new RegExp(pattern).test(value)) {
    isValid = false;
    errorMessage = input.getAttribute("data-error") || "Formato inválido";
  }

  if (!isValid) {
    showInputError(input, errorMessage);
  }

  return isValid;
}

function validateForm(form) {
  const inputs = form.querySelectorAll("input, select, textarea");
  let isValid = true;

  inputs.forEach((input) => {
    if (!validateInput(input)) {
      isValid = false;
    }
  });

  return isValid;
}

function showInputError(input, message) {
  input.classList.add("error");

  let errorElement = input.parentNode.querySelector(".error-message");
  if (!errorElement) {
    errorElement = document.createElement("div");
    errorElement.className = "error-message";
    input.parentNode.appendChild(errorElement);
  }

  errorElement.textContent = message;
}

function clearInputError(input) {
  input.classList.remove("error");
  const errorElement = input.parentNode.querySelector(".error-message");
  if (errorElement) {
    errorElement.remove();
  }
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhone(phone) {
  const phoneRegex = /^[+]?[\d\s\-\(\)]{7,15}$/;
  return phoneRegex.test(phone);
}

function initializeCustomSelects() {
  // Agregar funcionalidad para selects personalizados si es necesario
  const customSelects = document.querySelectorAll(".custom-select");

  customSelects.forEach((select) => {
    // Implementar funcionalidad de select personalizado
    select.addEventListener("change", function () {
      this.classList.add("has-value");
    });
  });
}

// =============================================================================
// TABLAS
// =============================================================================

function initializeTables() {
  const tables = document.querySelectorAll(".table");

  tables.forEach((table) => {
    // Hacer las filas clickeables si tienen data-href
    const clickableRows = table.querySelectorAll("tr[data-href]");
    clickableRows.forEach((row) => {
      row.style.cursor = "pointer";
      row.addEventListener("click", () => {
        window.location.href = row.getAttribute("data-href");
      });
    });

    // Hover effects
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach((row) => {
      row.addEventListener("mouseenter", () => {
        row.style.transform = "scale(1.01)";
      });

      row.addEventListener("mouseleave", () => {
        row.style.transform = "scale(1)";
      });
    });

    // Ordenar columnas
    const sortableHeaders = table.querySelectorAll("th[data-sort]");
    sortableHeaders.forEach((header) => {
      header.style.cursor = "pointer";
      header.addEventListener("click", () => {
        sortTable(table, header);
      });
    });
  });

  // Paginación
  initializePagination();
}

function sortTable(table, header) {
  const columnIndex = Array.from(header.parentNode.children).indexOf(header);
  const rows = Array.from(table.querySelectorAll("tbody tr"));
  const isAscending = header.getAttribute("data-direction") === "asc";

  rows.sort((a, b) => {
    const aValue = a.children[columnIndex].textContent.trim();
    const bValue = b.children[columnIndex].textContent.trim();

    if (isAscending) {
      return aValue.localeCompare(bValue);
    } else {
      return bValue.localeCompare(aValue);
    }
  });

  // Actualizar dirección
  header.setAttribute("data-direction", isAscending ? "desc" : "asc");

  // Remover todas las filas y agregarlas ordenadas
  const tbody = table.querySelector("tbody");
  tbody.innerHTML = "";
  rows.forEach((row) => tbody.appendChild(row));

  // Añadir indicador visual de ordenamiento
  table.querySelectorAll("th").forEach((th) => th.classList.remove("sorted"));
  header.classList.add("sorted");
}

function initializePagination() {
  const paginationContainers = document.querySelectorAll(".pagination");

  paginationContainers.forEach((pagination) => {
    const links = pagination.querySelectorAll("a");

    links.forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault();

        // Remover active de todos los enlaces
        links.forEach((l) => l.classList.remove("active"));

        // Agregar active al enlace clickeado
        link.classList.add("active");

        // Aquí puedes agregar lógica para cargar la página correspondiente
        const page = link.textContent;
        loadPage(page);
      });
    });
  });
}

function loadPage(page) {
  // Implementar lógica de paginación
  console.log("Cargando página:", page);
  // Aquí puedes hacer una petición AJAX para cargar los datos de la página
}

// =============================================================================
// NOTIFICACIONES
// =============================================================================

function initializeNotifications() {
  // Crear contenedor de notificaciones si no existe
  if (!document.querySelector(".notifications-container")) {
    const container = document.createElement("div");
    container.className = "notifications-container";
    container.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 10000;
      max-width: 300px;
    `;
    document.body.appendChild(container);
  }

  // Auto-cerrar notificaciones existentes
  const existingNotifications = document.querySelectorAll(".notification");
  existingNotifications.forEach((notification) => {
    setTimeout(() => {
      hideNotification(notification);
    }, 5000);
  });
}

function showNotification(message, type = "info", duration = 5000) {
  const container = document.querySelector(".notifications-container");

  const notification = document.createElement("div");
  notification.className = `notification notification-${type}`;
  notification.style.cssText = `
    background: ${getNotificationColor(type)};
    border: 1px solid ${getNotificationBorderColor(type)};
    color: white;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    opacity: 0;
    transform: translateX(100%);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  `;

  notification.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <span>${message}</span>
      <button onclick="hideNotification(this.parentNode.parentNode)" 
              style="background: none; border: none; color: white; cursor: pointer; padding: 0; margin-left: 10px;">
        ×
      </button>
    </div>
  `;

  container.appendChild(notification);

  // Mostrar notificación
  setTimeout(() => {
    notification.style.opacity = "1";
    notification.style.transform = "translateX(0)";
  }, 100);

  // Auto-ocultar después del tiempo especificado
  if (duration > 0) {
    setTimeout(() => {
      hideNotification(notification);
    }, duration);
  }

  return notification;
}

function hideNotification(notification) {
  notification.style.opacity = "0";
  notification.style.transform = "translateX(100%)";

  setTimeout(() => {
    if (notification && notification.parentNode) {
      notification.parentNode.removeChild(notification);
    }
  }, 300);
}

function getNotificationColor(type) {
  const colors = {
    success: "rgba(34, 197, 94, 0.9)",
    error: "rgba(220, 38, 38, 0.9)",
    warning: "rgba(245, 158, 11, 0.9)",
    info: "rgba(59, 130, 246, 0.9)",
  };
  return colors[type] || colors.info;
}

function getNotificationBorderColor(type) {
  const colors = {
    success: "#22c55e",
    error: "#dc2626",
    warning: "#f59e0b",
    info: "#3b82f6",
  };
  return colors[type] || colors.info;
}

// =============================================================================
// TOOLTIPS
// =============================================================================

function initializeTooltips() {
  const tooltipElements = document.querySelectorAll("[data-tooltip]");

  tooltipElements.forEach((element) => {
    element.addEventListener("mouseenter", showTooltip);
    element.addEventListener("mouseleave", hideTooltip);
    element.addEventListener("focus", showTooltip);
    element.addEventListener("blur", hideTooltip);
  });
}

function showTooltip(e) {
  const text = e.target.getAttribute("data-tooltip");
  if (!text) return;

  const tooltip = document.createElement("div");
  tooltip.className = "tooltip";
  tooltip.style.cssText = `
    position: absolute;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    z-index: 10001;
    pointer-events: none;
    white-space: nowrap;
    opacity: 0;
    transform: translateY(-5px);
    transition: all 0.2s ease;
    border: 1px solid rgba(0, 255, 102, 0.3);
  `;
  tooltip.textContent = text;

  document.body.appendChild(tooltip);

  // Posicionar tooltip
  const rect = e.target.getBoundingClientRect();
  const tooltipRect = tooltip.getBoundingClientRect();

  tooltip.style.left =
    Math.max(10, rect.left + rect.width / 2 - tooltipRect.width / 2) + "px";
  tooltip.style.top = rect.top - tooltipRect.height - 10 + "px";

  // Mostrar tooltip
  setTimeout(() => {
    tooltip.style.opacity = "1";
    tooltip.style.transform = "translateY(0)";
  }, 50);

  // Guardar referencia para poder eliminarlo
  e.target._tooltip = tooltip;
}

function hideTooltip(e) {
  const tooltip = e.target._tooltip;
  if (tooltip) {
    tooltip.style.opacity = "0";
    tooltip.style.transform = "translateY(-5px)";

    setTimeout(() => {
      if (tooltip && tooltip.parentNode) {
        tooltip.parentNode.removeChild(tooltip);
      }
    }, 200);

    e.target._tooltip = null;
  }
}

// =============================================================================
// CONTADORES ANIMADOS
// =============================================================================

function initializeCounters() {
  const counters = document.querySelectorAll(".stat-value[data-count]");

  const observerOptions = {
    threshold: 0.5,
    rootMargin: "0px 0px -100px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  counters.forEach((counter) => {
    observer.observe(counter);
  });
}

function animateCounter(element) {
  const target = parseInt(element.getAttribute("data-count"));
  const duration = 2000; // 2 segundos
  const increment = target / (duration / 50);
  let current = 0;

  const timer = setInterval(() => {
    current += increment;

    if (current >= target) {
      current = target;
      clearInterval(timer);
    }

    // Formatear según el tipo
    if (element.classList.contains("currency")) {
      element.textContent = "$" + Math.floor(current).toLocaleString();
    } else if (element.classList.contains("percentage")) {
      element.textContent = current.toFixed(1) + "%";
    } else {
      element.textContent = Math.floor(current).toLocaleString();
    }
  }, 50);
}

// =============================================================================
// GRÁFICOS
// =============================================================================

function initializeCharts() {
  // Aquí puedes inicializar librerías de gráficos como Chart.js
  const chartContainers = document.querySelectorAll("[data-chart]");

  chartContainers.forEach((container) => {
    const chartType = container.getAttribute("data-chart");

    // Dependiendo del tipo de gráfico, crear la configuración apropiada
    switch (chartType) {
      case "line":
        createLineChart(container);
        break;
      case "bar":
        createBarChart(container);
        break;
      case "pie":
        createPieChart(container);
        break;
      case "doughnut":
        createDoughnutChart(container);
        break;
    }
  });
}

function createLineChart(container) {
  // Implementar gráfico de línea
  console.log("Creando gráfico de línea en:", container);
}

function createBarChart(container) {
  // Implementar gráfico de barras
  console.log("Creando gráfico de barras en:", container);
}

function createPieChart(container) {
  // Implementar gráfico circular
  console.log("Creando gráfico circular en:", container);
}

function createDoughnutChart(container) {
  // Implementar gráfico de dona
  console.log("Creando gráfico de dona en:", container);
}

// =============================================================================
// ANIMACIONES
// =============================================================================

function initializeAnimations() {
  const animatedElements = document.querySelectorAll(".fade-in, .slide-up");

  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.visibility = "visible";
        entry.target.classList.add("animated");
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  animatedElements.forEach((element) => {
    element.style.visibility = "hidden";
    observer.observe(element);
  });
}

// =============================================================================
// UTILIDADES
// =============================================================================

function showButtonLoading(button) {
  const originalText = button.textContent;
  button.disabled = true;
  button.innerHTML =
    '<div class="loader" style="width: 20px; height: 20px; border-width: 2px;"></div>';

  // Restaurar después de un tiempo (esto debería ser manejado por el servidor)
  setTimeout(() => {
    button.disabled = false;
    button.textContent = originalText;
  }, 3000);
}

function formatCurrency(amount) {
  return new Intl.NumberFormat("es-CO", {
    style: "currency",
    currency: "COP",
    minimumFractionDigits: 0,
  }).format(amount);
}

function formatDate(date) {
  return new Intl.DateTimeFormat("es-CO", {
    year: "numeric",
    month: "long",
    day: "numeric",
  }).format(new Date(date));
}

function formatTime(time) {
  return new Intl.DateTimeFormat("es-CO", {
    hour: "2-digit",
    minute: "2-digit",
    hour12: true,
  }).format(new Date(time));
}

function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// =============================================================================
// BÚSQUEDA EN TIEMPO REAL
// =============================================================================

function initializeLiveSearch() {
  const searchInputs = document.querySelectorAll("[data-live-search]");

  searchInputs.forEach((input) => {
    const targetTable = document.querySelector(
      input.getAttribute("data-target")
    );

    if (targetTable) {
      input.addEventListener(
        "input",
        debounce(() => {
          filterTable(targetTable, input.value);
        }, 300)
      );
    }
  });
}

function filterTable(table, query) {
  const rows = table.querySelectorAll("tbody tr");

  rows.forEach((row) => {
    const text = row.textContent.toLowerCase();
    const matches = text.includes(query.toLowerCase());

    row.style.display = matches ? "" : "none";
  });
}

// =============================================================================
// EXPORTS GLOBALES
// =============================================================================

window.PrimeroDeJunioJS = {
  showNotification,
  hideNotification,
  openModal,
  closeModal,
  showButtonLoading,
  formatCurrency,
  formatDate,
  formatTime,
  debounce,
};

// Agregar estilos CSS dinámicos
const dynamicStyles = document.createElement("style");
dynamicStyles.textContent = `
  .error {
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important;
  }

  .error-message {
    color: #dc2626;
    font-size: 0.85rem;
    margin-top: 5px;
    font-weight: 500;
  }

  .animated {
    animation-fill-mode: forwards;
  }

  .fade-in.animated {
    animation: fadeIn 0.6s ease-out;
  }

  .slide-up.animated {
    animation: slideUp 0.6s ease-out;
  }

  .sorted::after {
    content: ' ↕';
    color: var(--primary-green);
  }

  .mobile-menu-btn {
    display: none;
    background: transparent;
    border: none;
    color: var(--primary-green);
    font-size: 1.5rem;
    cursor: pointer;
    padding: 5px;
  }

  @media (max-width: 1024px) {
    .mobile-menu-btn {
      display: block;
    }
  }
`;

document.head.appendChild(dynamicStyles);

// =============================================================================
// VEHICLE MANAGEMENT MODULE
// =============================================================================

// Vehicle Profile Module
const VehicleProfile = {
  init() {
    this.initializeTabs();
    this.bindEvents();
  },

  initializeTabs() {
    const tabButtons = document.querySelectorAll(".tab-button-modern");
    const tabContents = document.querySelectorAll(".tab-content-modern");

    tabButtons.forEach((button) => {
      button.addEventListener("click", (e) => {
        const targetTab = e.target
          .closest(".tab-button-modern")
          .getAttribute("data-tab");

        // Remove active class from all buttons and contents
        tabButtons.forEach((btn) => btn.classList.remove("active"));
        tabContents.forEach((content) => content.classList.remove("active"));

        // Activate target button and content
        e.target.closest(".tab-button-modern").classList.add("active");
        document
          .querySelector(`[data-tab="${targetTab}"].tab-content-modern`)
          .classList.add("active");
      });
    });
  },

  bindEvents() {
    // Photo modal
    const photoModal = document.querySelector(
      ".vehicle-main-photo .photo-overlay"
    );
    if (photoModal) {
      photoModal.addEventListener("click", this.openPhotoModal);
    }

    // Maintenance modal buttons
    const maintenanceButtons = document.querySelectorAll(
      '[onclick*="openMaintenanceModal"]'
    );
    maintenanceButtons.forEach((btn) => {
      btn.addEventListener("click", this.openMaintenanceModal);
    });
  },

  openPhotoModal() {
    console.log("Open photo modal");
  },

  openMaintenanceModal() {
    console.log("Open maintenance modal");
  },
};

// Vehicle Index Module
const VehicleIndex = {
  init() {
    this.initializeDropdowns();
    this.initializeViewToggle();
    this.initializeFilters();
    this.initializeDataTable();
    this.bindEvents();
  },

  initializeDropdowns() {
    document.querySelectorAll("[data-dropdown]").forEach((trigger) => {
      trigger.addEventListener("click", (e) => {
        e.preventDefault();
        const dropdownId = trigger.getAttribute("data-dropdown");
        const dropdown = document.getElementById(dropdownId);
        if (dropdown) {
          dropdown.classList.toggle("active");
        }
      });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", (e) => {
      if (!e.target.closest(".dropdown-modern")) {
        document.querySelectorAll(".dropdown-menu-modern").forEach((menu) => {
          menu.classList.remove("active");
        });
      }
    });
  },

  initializeViewToggle() {
    document.querySelectorAll(".view-toggle").forEach((toggle) => {
      toggle.addEventListener("click", (e) => {
        const view = e.target.closest(".view-toggle").getAttribute("data-view");

        // Update active toggle
        document
          .querySelectorAll(".view-toggle")
          .forEach((t) => t.classList.remove("active"));
        e.target.closest(".view-toggle").classList.add("active");

        // Update views
        const tableView = document.getElementById("tableView");
        const cardsView = document.getElementById("cardsView");

        if (tableView && cardsView) {
          tableView.classList.toggle("active", view === "table");
          cardsView.classList.toggle("active", view === "cards");
        }
      });
    });
  },

  initializeFilters() {
    // Clear filters
    const clearFilters = document.getElementById("clearFilters");
    if (clearFilters) {
      clearFilters.addEventListener("click", () => {
        const form = document.getElementById("filtersForm");
        if (form) {
          form.reset();
          window.location.href = window.location.pathname;
        }
      });
    }

    // Auto-submit filters
    document.querySelectorAll(".form-select-modern").forEach((select) => {
      select.addEventListener("change", () => {
        const form = document.getElementById("filtersForm");
        if (form) {
          form.submit();
        }
      });
    });
  },

  initializeDataTable() {
    if (typeof $ !== "undefined" && $.fn.DataTable) {
      const table = document.getElementById("vehiculosTable");
      if (table) {
        $(table).DataTable({
          language: {
            url: "/assets/js/datatables-es.json",
          },
          pageLength: 25,
          order: [[0, "asc"]],
          columnDefs: [{ orderable: false, targets: [5, 6] }],
        });
      }
    }
  },

  bindEvents() {
    // Quick filters
    document.querySelectorAll(".filter-btn-modern").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const filter = e.target
          .closest(".filter-btn-modern")
          .getAttribute("data-filter");
        this.filterVehiculos(filter);
      });
    });
  },

  filterVehiculos(filter) {
    const rows = document.querySelectorAll(".vehiculo-row");
    const cards = document.querySelectorAll(".vehicle-card-modern");

    // Update active filter button
    document
      .querySelectorAll(".filter-btn-modern")
      .forEach((btn) => btn.classList.remove("active"));
    document
      .querySelector(`[data-filter="${filter}"]`)
      ?.classList.add("active");

    // Filter logic
    rows.forEach((row) => {
      let show = true;

      switch (filter) {
        case "todos":
          show = true;
          break;
        default:
          show = row.getAttribute("data-estado") === filter;
          break;
      }

      row.style.display = show ? "" : "none";
    });

    // Filter cards
    cards.forEach((card) => {
      let show = true;

      switch (filter) {
        case "todos":
          show = true;
          break;
        default:
          show = card.getAttribute("data-estado") === filter;
          break;
      }

      card.style.display = show ? "" : "none";
    });
  },
};

// Vehicle Modals Module
const VehicleModals = {
  init() {
    this.bindModalEvents();
  },

  bindModalEvents() {
    // Assignment modal
    document
      .querySelectorAll('[onclick*="asignarConductor"]')
      .forEach((btn) => {
        btn.addEventListener("click", (e) => {
          e.preventDefault();
          const vehiculoId = this.extractVehicleId(btn.getAttribute("onclick"));
          this.openAssignmentModal(vehiculoId);
        });
      });

    // Maintenance modal
    document
      .querySelectorAll('[onclick*="programarMantenimiento"]')
      .forEach((btn) => {
        btn.addEventListener("click", (e) => {
          e.preventDefault();
          const vehiculoId = this.extractVehicleId(btn.getAttribute("onclick"));
          this.openMaintenanceModal(vehiculoId);
        });
      });
  },

  extractVehicleId(onclickString) {
    const match = onclickString.match(/\d+/);
    return match ? match[0] : null;
  },

  openAssignmentModal(vehiculoId) {
    const modalContent = `
            <form class="form-modern" id="assignmentForm">
                <div class="form-group-modern">
                    <label class="form-label-modern">Seleccionar Conductor</label>
                    <select class="form-select-modern" name="conductor_id" required>
                        <option value="">Seleccionar conductor...</option>
                    </select>
                </div>
                <div class="form-group-modern">
                    <label class="form-label-modern">Fecha de Asignación</label>
                    <input type="date" class="form-input-modern" name="fecha_asignacion" value="${
                      new Date().toISOString().split("T")[0]
                    }" required>
                </div>
                <div class="form-group-modern">
                    <label class="form-label-modern">Observaciones</label>
                    <textarea class="form-textarea-modern" name="observaciones" rows="3" placeholder="Notas adicionales..."></textarea>
                </div>
                <div class="form-actions-modern">
                    <button type="button" class="btn-modern btn-outline" onclick="VehicleModals.closeAssignmentModal()">Cancelar</button>
                    <button type="submit" class="btn-modern btn-primary">Asignar</button>
                </div>
            </form>
        `;

    const assignmentContent = document.getElementById("assignmentContent");
    const assignmentModal = document.getElementById("assignmentModal");

    if (assignmentContent && assignmentModal) {
      assignmentContent.innerHTML = modalContent;
      assignmentModal.classList.add("active");
    }
  },

  openMaintenanceModal(vehiculoId) {
    const modalContent = `
            <form class="form-modern" id="maintenanceForm">
                <div class="form-group-modern">
                    <label class="form-label-modern">Tipo de Mantenimiento</label>
                    <select class="form-select-modern" name="tipo_mantenimiento" required>
                        <option value="">Seleccionar tipo...</option>
                        <option value="preventivo">Preventivo</option>
                        <option value="correctivo">Correctivo</option>
                        <option value="revision">Revisión General</option>
                        <option value="cambio_aceite">Cambio de Aceite</option>
                        <option value="cambio_llantas">Cambio de Llantas</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="form-group-modern">
                    <label class="form-label-modern">Fecha Programada</label>
                    <input type="date" class="form-input-modern" name="fecha_programada" required>
                </div>
                <div class="form-group-modern">
                    <label class="form-label-modern">Kilometraje Estimado</label>
                    <input type="number" class="form-input-modern" name="kilometraje_estimado" placeholder="Km cuando se realizará">
                </div>
                <div class="form-group-modern">
                    <label class="form-label-modern">Descripción</label>
                    <textarea class="form-textarea-modern" name="descripcion" rows="3" placeholder="Detalles del mantenimiento..." required></textarea>
                </div>
                <div class="form-actions-modern">
                    <button type="button" class="btn-modern btn-outline" onclick="VehicleModals.closeMaintenanceModal()">Cancelar</button>
                    <button type="submit" class="btn-modern btn-primary">Programar</button>
                </div>
            </form>
        `;

    const maintenanceContent = document.getElementById("maintenanceContent");
    const maintenanceModal = document.getElementById("maintenanceModal");

    if (maintenanceContent && maintenanceModal) {
      maintenanceContent.innerHTML = modalContent;
      maintenanceModal.classList.add("active");
    }
  },

  closeAssignmentModal() {
    const modal = document.getElementById("assignmentModal");
    if (modal) {
      modal.classList.remove("active");
    }
  },

  closeMaintenanceModal() {
    const modal = document.getElementById("maintenanceModal");
    if (modal) {
      modal.classList.remove("active");
    }
  },
};

// =============================================================================
// GLOBAL FUNCTIONS FOR BACKWARD COMPATIBILITY
// =============================================================================

function filterVehiculos(filter) {
  VehicleIndex.filterVehiculos(filter);
}

function asignarConductor(vehiculoId) {
  VehicleModals.openAssignmentModal(vehiculoId);
}

function programarMantenimiento(vehiculoId) {
  VehicleModals.openMaintenanceModal(vehiculoId);
}

function closeAssignmentModal() {
  VehicleModals.closeAssignmentModal();
}

function closeMaintenanceModal() {
  VehicleModals.closeMaintenanceModal();
}

function openPhotoModal() {
  VehicleProfile.openPhotoModal();
}

function openMaintenanceModal() {
  VehicleProfile.openMaintenanceModal();
}

// Filter function for drivers (conductores)
function filterConductores(filter) {
  const rows = document.querySelectorAll('.conductor-row');
  const cards = document.querySelectorAll('.driver-card-modern');
  
  // Update active filter button
  document.querySelectorAll('.filter-btn-modern').forEach(btn => btn.classList.remove('active'));
  document.querySelector(`[data-filter="${filter}"]`)?.classList.add('active');
  
  // Filter logic for table rows
  rows.forEach(row => {
    let show = true;
    const estado = row.getAttribute('data-estado');
    
    switch (filter) {
      case 'todos':
        show = true;
        break;
      case 'activos':
        show = estado === 'activo';
        break;
      case 'inactivos':
        show = estado === 'inactivo';
        break;
      case 'suspendidos':
        show = estado === 'suspendido';
        break;
      case 'con_vehiculo':
        show = row.getAttribute('data-vehiculo') === 'true';
        break;
      case 'sin_vehiculo':
        show = row.getAttribute('data-vehiculo') === 'false';
        break;
    }
    
    row.style.display = show ? '' : 'none';
  });
  
  // Filter logic for cards
  cards.forEach(card => {
    let show = true;
    const estado = card.getAttribute('data-estado');
    
    switch (filter) {
      case 'todos':
        show = true;
        break;
      case 'activos':
        show = estado === 'activo';
        break;
      case 'inactivos':
        show = estado === 'inactivo';
        break;
      case 'suspendidos':
        show = estado === 'suspendido';
        break;
      case 'con_vehiculo':
        show = card.getAttribute('data-vehiculo') === 'true';
        break;
      case 'sin_vehiculo':
        show = card.getAttribute('data-vehiculo') === 'false';
        break;
    }
    
    card.style.display = show ? '' : 'none';
  });
}

// Initialize vehicle modules based on page content
document.addEventListener("DOMContentLoaded", function () {
  // Initialize AOS if available
  if (typeof AOS !== "undefined") {
    AOS.init({
      duration: 800,
      easing: "ease-out-cubic",
      once: true,
    });
  }

  // Initialize appropriate module based on page content
  if (document.querySelector(".vehicle-profile")) {
    VehicleProfile.init();
    console.log("Vehicle profile initialized");
  }

  if (
    document.querySelector("#vehiculosTable") ||
    document.querySelector(".vehicles-cards-grid-modern")
  ) {
    VehicleIndex.init();
    VehicleModals.init();
    console.log("Vehicle index initialized");
  }

  // Initialize drivers table if present
  if (document.getElementById("conductoresTable")) {
    if (typeof $ !== "undefined" && $.fn.DataTable) {
      $("#conductoresTable").DataTable({
        language: {
          url: "/assets/js/datatables-es.json",
        },
        pageLength: 25,
        order: [[0, "asc"]],
        columnDefs: [{ orderable: false, targets: [5, 6] }],
      });
    }
  }
});

// Export modules for use in other files
window.VehicleProfile = VehicleProfile;
window.VehicleIndex = VehicleIndex;
window.VehicleModals = VehicleModals;

console.log(
  "✅ PRIMERO DE JUNIO: JavaScript del sistema cargado correctamente"
);
