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

console.log(
  "✅ PRIMERO DE JUNIO: JavaScript del sistema cargado correctamente"
);
