/* PRIMERO DE JUNIO - COMPONENTES JAVASCRIPT DEL SISTEMA */
/* Funcionalidades para componentes específicos basados en el sitio web */

class ComponentSystem {
  constructor() {
    this.cards = [];
    this.buttons = [];
    this.forms = [];
    this.alerts = [];
    this.modals = [];

    this.init();
  }

  init() {
    this.setupCards();
    this.setupButtons();
    this.setupForms();
    this.setupAlerts();
    this.setupModals();
    this.initializeAnimations();
  }

  // ===== SISTEMA DE CARDS =====
  setupCards() {
    const cards = document.querySelectorAll(".system-card, .stats-card");

    cards.forEach((card, index) => {
      this.cards.push(card);

      // Efecto hover mejorado
      card.addEventListener("mouseenter", () => {
        this.animateCardHover(card, true);
      });

      card.addEventListener("mouseleave", () => {
        this.animateCardHover(card, false);
      });

      // Efecto click para cards interactivas
      if (card.hasAttribute("data-clickable")) {
        card.style.cursor = "pointer";
        card.addEventListener("click", () => {
          this.handleCardClick(card);
        });
      }

      // Animación inicial
      this.animateCardEntrance(card, index);
    });

    // Setup para cards de estadísticas con animación de contadores
    this.setupStatsCards();
  }

  animateCardHover(card, isEntering) {
    if (isEntering) {
      gsap.to(card, {
        y: -5,
        scale: 1.02,
        rotationY: 2,
        duration: 0.4,
        ease: "power2.out",
      });

      // Efecto de brillo
      this.createCardShineEffect(card);

      // Animar elementos internos
      const title = card.querySelector(".system-card-title, .stats-label");
      const content = card.querySelector(".system-card-content, .stats-value");

      if (title) {
        gsap.to(title, {
          color: "var(--primary-green)",
          duration: 0.3,
          ease: "power2.out",
        });
      }

      if (content) {
        gsap.to(content, {
          scale: 1.05,
          duration: 0.3,
          ease: "back.out(1.7)",
        });
      }
    } else {
      gsap.to(card, {
        y: 0,
        scale: 1,
        rotationY: 0,
        duration: 0.4,
        ease: "power2.out",
      });

      // Restaurar elementos internos
      const title = card.querySelector(".system-card-title, .stats-label");
      const content = card.querySelector(".system-card-content, .stats-value");

      if (title) {
        gsap.to(title, {
          color: "",
          duration: 0.3,
          ease: "power2.out",
        });
      }

      if (content) {
        gsap.to(content, {
          scale: 1,
          duration: 0.3,
          ease: "power2.out",
        });
      }
    }
  }

  createCardShineEffect(card) {
    const shine = document.createElement("div");
    shine.className = "card-shine-effect";
    shine.style.cssText = `
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 102, 0.1), transparent);
            pointer-events: none;
            z-index: 1;
        `;

    card.style.position = "relative";
    card.appendChild(shine);

    gsap.to(shine, {
      left: "100%",
      duration: 0.8,
      ease: "power2.out",
      onComplete: () => {
        shine.remove();
      },
    });
  }

  animateCardEntrance(card, index) {
    gsap.fromTo(
      card,
      {
        y: 50,
        opacity: 0,
        scale: 0.95,
        rotationX: 15,
      },
      {
        y: 0,
        opacity: 1,
        scale: 1,
        rotationX: 0,
        duration: 0.6,
        delay: index * 0.1,
        ease: "power3.out",
      }
    );
  }

  handleCardClick(card) {
    // Animación de click
    gsap.to(card, {
      scale: 0.98,
      duration: 0.1,
      yoyo: true,
      repeat: 1,
      ease: "power2.inOut",
    });

    // Efecto de ondas
    this.createRippleEffect(card);

    const action = card.getAttribute("data-action");
    const url = card.getAttribute("data-url");

    setTimeout(() => {
      if (url) {
        window.location.href = url;
      } else if (action) {
        this.executeCardAction(action, card);
      }
    }, 200);
  }

  executeCardAction(action, card) {
    switch (action) {
      case "toggle":
        this.toggleCard(card);
        break;
      case "expand":
        this.expandCard(card);
        break;
      case "modal":
        this.openCardModal(card);
        break;
      default:
        console.log(`Executing card action: ${action}`);
    }
  }

  setupStatsCards() {
    const statsCards = document.querySelectorAll(".stats-card");

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            this.animateStatsCard(entry.target);
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.5 }
    );

    statsCards.forEach((card) => observer.observe(card));
  }

  animateStatsCard(card) {
    const valueElement = card.querySelector(".stats-value");
    if (!valueElement) return;

    const finalValue =
      parseInt(valueElement.textContent.replace(/[^0-9]/g, "")) || 0;
    const hasPrefix = valueElement.textContent.includes("$");
    const hasSuffix =
      valueElement.textContent.includes("+") ||
      valueElement.textContent.includes("%");

    valueElement.textContent = hasPrefix ? "$0" : "0";

    gsap.to(
      { value: 0 },
      {
        value: finalValue,
        duration: 2.5,
        ease: "power2.out",
        onUpdate: function () {
          const currentValue = Math.round(this.targets()[0].value);
          let formattedValue = currentValue.toLocaleString();

          if (hasPrefix) formattedValue = `$${formattedValue}`;
          if (hasSuffix) {
            if (valueElement.textContent.includes("+")) formattedValue += "+";
            if (valueElement.textContent.includes("%")) formattedValue += "%";
          }

          valueElement.textContent = formattedValue;
        },
      }
    );

    // Efecto de pulso durante la animación
    gsap.fromTo(
      valueElement,
      { scale: 1 },
      {
        scale: 1.1,
        duration: 0.3,
        yoyo: true,
        repeat: 5,
        ease: "power2.inOut",
        delay: 0.5,
      }
    );
  }

  // ===== SISTEMA DE BOTONES =====
  setupButtons() {
    const buttons = document.querySelectorAll(
      ".btn-primary, .btn-secondary, .btn-outline, .btn-danger"
    );

    buttons.forEach((button) => {
      this.buttons.push(button);

      // Efecto hover mejorado
      button.addEventListener("mouseenter", () => {
        this.animateButtonHover(button, true);
      });

      button.addEventListener("mouseleave", () => {
        this.animateButtonHover(button, false);
      });

      // Efecto click
      button.addEventListener("click", (e) => {
        this.handleButtonClick(button, e);
      });

      // Configurar loading state si tiene data-loading
      if (button.hasAttribute("data-loading")) {
        this.setupButtonLoading(button);
      }
    });
  }

  animateButtonHover(button, isEntering) {
    const icon = button.querySelector("i");

    if (isEntering) {
      gsap.to(button, {
        y: -3,
        scale: 1.02,
        duration: 0.3,
        ease: "back.out(1.7)",
      });

      if (icon) {
        gsap.to(icon, {
          x: 5,
          rotation: 5,
          duration: 0.3,
          ease: "power2.out",
        });
      }

      // Efecto de partículas sutiles
      this.createButtonParticles(button);
    } else {
      gsap.to(button, {
        y: 0,
        scale: 1,
        duration: 0.3,
        ease: "power2.out",
      });

      if (icon) {
        gsap.to(icon, {
          x: 0,
          rotation: 0,
          duration: 0.3,
          ease: "power2.out",
        });
      }
    }
  }

  createButtonParticles(button) {
    const rect = button.getBoundingClientRect();
    const particleCount = 3;

    for (let i = 0; i < particleCount; i++) {
      const particle = document.createElement("div");
      particle.style.cssText = `
                position: fixed;
                top: ${rect.top + rect.height / 2}px;
                left: ${rect.left + Math.random() * rect.width}px;
                width: 3px;
                height: 3px;
                background: var(--primary-green);
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
            `;

      document.body.appendChild(particle);

      gsap.to(particle, {
        y: -30,
        opacity: 0,
        scale: 0,
        duration: 0.8,
        delay: i * 0.1,
        ease: "power2.out",
        onComplete: () => {
          particle.remove();
        },
      });
    }
  }

  handleButtonClick(button, event) {
    // Prevenir doble click si está en loading
    if (button.classList.contains("loading")) {
      event.preventDefault();
      return;
    }

    // Animación de click
    gsap.to(button, {
      scale: 0.95,
      duration: 0.1,
      yoyo: true,
      repeat: 1,
      ease: "power2.inOut",
    });

    // Efecto de ondas
    this.createRippleEffect(button, event);

    const action = button.getAttribute("data-action");
    const confirm = button.getAttribute("data-confirm");

    if (confirm) {
      event.preventDefault();
      this.showConfirmDialog(confirm, () => {
        this.executeButtonAction(button, action);
      });
    } else if (action) {
      this.executeButtonAction(button, action);
    }
  }

  executeButtonAction(button, action) {
    switch (action) {
      case "submit":
        this.submitForm(button);
        break;
      case "loading":
        this.setButtonLoading(button, true);
        break;
      case "modal":
        this.openModal(button.getAttribute("data-modal"));
        break;
      default:
        console.log(`Executing button action: ${action}`);
    }
  }

  setButtonLoading(button, isLoading) {
    if (isLoading) {
      button.classList.add("loading");
      const originalContent = button.innerHTML;
      button.setAttribute("data-original-content", originalContent);

      button.innerHTML = `
                <div class="spinner"></div>
                <span>Cargando...</span>
            `;
      button.disabled = true;
    } else {
      button.classList.remove("loading");
      const originalContent = button.getAttribute("data-original-content");
      if (originalContent) {
        button.innerHTML = originalContent;
      }
      button.disabled = false;
    }
  }

  createRippleEffect(element, event) {
    const rect = element.getBoundingClientRect();
    const ripple = document.createElement("div");

    ripple.className = "ripple-effect";
    ripple.style.cssText = `
            position: absolute;
            top: ${event ? event.clientY - rect.top : rect.height / 2}px;
            left: ${event ? event.clientX - rect.left : rect.width / 2}px;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 1000;
        `;

    element.style.position = "relative";
    element.appendChild(ripple);

    gsap.to(ripple, {
      width: Math.max(rect.width, rect.height) * 2,
      height: Math.max(rect.width, rect.height) * 2,
      opacity: 0,
      duration: 0.6,
      ease: "power2.out",
      onComplete: () => {
        ripple.remove();
      },
    });
  }

  // ===== SISTEMA DE FORMULARIOS =====
  setupForms() {
    const forms = document.querySelectorAll("form");
    const formControls = document.querySelectorAll(
      ".form-control, .form-select"
    );

    // Setup validación en tiempo real
    formControls.forEach((input) => {
      input.addEventListener("input", () => {
        this.validateInput(input);
      });

      input.addEventListener("blur", () => {
        this.validateInput(input, true);
      });

      input.addEventListener("focus", () => {
        this.clearInputError(input);
      });
    });

    // Setup formularios
    forms.forEach((form) => {
      this.forms.push(form);

      form.addEventListener("submit", (e) => {
        this.handleFormSubmit(form, e);
      });
    });

    // Setup floating labels
    this.setupFloatingLabels();
  }

  validateInput(input, showError = false) {
    const value = input.value.trim();
    const rules = this.getValidationRules(input);
    let isValid = true;
    let errorMessage = "";

    // Validaciones
    if (rules.required && !value) {
      isValid = false;
      errorMessage = "Este campo es requerido";
    } else if (value && rules.email && !this.isValidEmail(value)) {
      isValid = false;
      errorMessage = "Email inválido";
    } else if (value && rules.minLength && value.length < rules.minLength) {
      isValid = false;
      errorMessage = `Mínimo ${rules.minLength} caracteres`;
    } else if (value && rules.pattern && !rules.pattern.test(value)) {
      isValid = false;
      errorMessage = "Formato inválido";
    }

    // Aplicar estilos
    if (isValid) {
      input.classList.remove("is-invalid");
      input.classList.add("is-valid");
      if (showError) this.clearInputError(input);
    } else {
      input.classList.remove("is-valid");
      input.classList.add("is-invalid");
      if (showError) this.showInputError(input, errorMessage);
    }

    return isValid;
  }

  getValidationRules(input) {
    return {
      required: input.hasAttribute("required"),
      email: input.type === "email",
      minLength: parseInt(input.getAttribute("minlength")) || 0,
      pattern: input.pattern ? new RegExp(input.pattern) : null,
    };
  }

  isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  showInputError(input, message) {
    this.clearInputError(input);

    const errorDiv = document.createElement("div");
    errorDiv.className = "form-error";
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;

    input.parentNode.appendChild(errorDiv);

    // Animación de entrada
    gsap.fromTo(
      errorDiv,
      { opacity: 0, y: -10 },
      { opacity: 1, y: 0, duration: 0.3, ease: "power2.out" }
    );
  }

  clearInputError(input) {
    const errorDiv = input.parentNode.querySelector(".form-error");
    if (errorDiv) {
      gsap.to(errorDiv, {
        opacity: 0,
        y: -10,
        duration: 0.2,
        ease: "power2.in",
        onComplete: () => {
          errorDiv.remove();
        },
      });
    }
  }

  handleFormSubmit(form, event) {
    event.preventDefault();

    const inputs = form.querySelectorAll(".form-control, .form-select");
    let isFormValid = true;

    // Validar todos los inputs
    inputs.forEach((input) => {
      if (!this.validateInput(input, true)) {
        isFormValid = false;
      }
    });

    if (isFormValid) {
      this.submitForm(form);
    } else {
      this.showFormError(
        form,
        "Por favor corrige los errores en el formulario"
      );

      // Scroll al primer error
      const firstError = form.querySelector(".is-invalid");
      if (firstError) {
        firstError.scrollIntoView({ behavior: "smooth", block: "center" });
        firstError.focus();
      }
    }
  }

  async submitForm(form) {
    const submitButton = form.querySelector(
      'button[type="submit"], .btn-primary'
    );

    if (submitButton) {
      this.setButtonLoading(submitButton, true);
    }

    try {
      const formData = new FormData(form);
      const response = await fetch(form.action || window.location.href, {
        method: "POST",
        body: formData,
      });

      const result = await response.json();

      if (result.success) {
        this.showFormSuccess(
          form,
          result.message || "Formulario enviado correctamente"
        );
        form.reset();
      } else {
        this.showFormError(
          form,
          result.message || "Error al enviar el formulario"
        );
      }
    } catch (error) {
      console.error("Error submitting form:", error);
      this.showFormError(form, "Error de conexión");
    } finally {
      if (submitButton) {
        this.setButtonLoading(submitButton, false);
      }
    }
  }

  showFormError(form, message) {
    this.showAlert("error", message, form);
  }

  showFormSuccess(form, message) {
    this.showAlert("success", message, form);
  }

  setupFloatingLabels() {
    const floatingInputs = document.querySelectorAll(
      ".form-floating .form-control"
    );

    floatingInputs.forEach((input) => {
      input.addEventListener("input", () => {
        const label = input.parentNode.querySelector(".form-label");
        if (label) {
          if (input.value.trim()) {
            label.classList.add("active");
          } else {
            label.classList.remove("active");
          }
        }
      });
    });
  }

  // ===== SISTEMA DE ALERTAS =====
  setupAlerts() {
    const alerts = document.querySelectorAll(".alert");

    alerts.forEach((alert, index) => {
      this.alerts.push(alert);

      // Animación de entrada
      gsap.fromTo(
        alert,
        { opacity: 0, x: 50 },
        {
          opacity: 1,
          x: 0,
          duration: 0.4,
          delay: index * 0.1,
          ease: "power2.out",
        }
      );

      // Setup botón de cerrar
      const closeBtn = alert.querySelector(".alert-close");
      if (closeBtn) {
        closeBtn.addEventListener("click", () => {
          this.closeAlert(alert);
        });
      }

      // Auto-cerrar si tiene data-timeout
      const timeout = parseInt(alert.getAttribute("data-timeout"));
      if (timeout) {
        setTimeout(() => {
          this.closeAlert(alert);
        }, timeout);
      }
    });
  }

  closeAlert(alert) {
    gsap.to(alert, {
      opacity: 0,
      x: 50,
      height: 0,
      marginBottom: 0,
      paddingTop: 0,
      paddingBottom: 0,
      duration: 0.4,
      ease: "power2.in",
      onComplete: () => {
        alert.remove();
        this.alerts = this.alerts.filter((a) => a !== alert);
      },
    });
  }

  showAlert(type, message, container = document.body) {
    const alert = document.createElement("div");
    alert.className = `alert alert-${type}`;
    alert.innerHTML = `
            <i class="alert-icon fas fa-${this.getAlertIcon(type)}"></i>
            <div class="alert-content">
                <div class="alert-message">${message}</div>
            </div>
            <button class="alert-close">
                <i class="fas fa-times"></i>
            </button>
        `;

    container.appendChild(alert);

    // Setup eventos
    const closeBtn = alert.querySelector(".alert-close");
    closeBtn.addEventListener("click", () => {
      this.closeAlert(alert);
    });

    // Animación de entrada
    gsap.fromTo(
      alert,
      { opacity: 0, x: 50 },
      { opacity: 1, x: 0, duration: 0.4, ease: "power2.out" }
    );

    // Auto-cerrar después de 5 segundos
    setTimeout(() => {
      if (document.contains(alert)) {
        this.closeAlert(alert);
      }
    }, 5000);

    this.alerts.push(alert);
    return alert;
  }

  getAlertIcon(type) {
    const icons = {
      success: "check-circle",
      error: "exclamation-circle",
      warning: "exclamation-triangle",
      info: "info-circle",
    };
    return icons[type] || "info-circle";
  }

  // ===== SISTEMA DE MODALES =====
  setupModals() {
    const modalTriggers = document.querySelectorAll("[data-modal]");

    modalTriggers.forEach((trigger) => {
      trigger.addEventListener("click", (e) => {
        e.preventDefault();
        const modalId = trigger.getAttribute("data-modal");
        this.openModal(modalId);
      });
    });
  }

  openModal(modalId) {
    // TODO: Implementar sistema de modales
    console.log(`Opening modal: ${modalId}`);
  }

  // ===== ANIMACIONES INICIALES =====
  initializeAnimations() {
    // Animar elementos cuando entren en viewport
    const observerOptions = {
      threshold: 0.1,
      rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          this.animateElement(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observar elementos que necesitan animación
    const elementsToAnimate = document.querySelectorAll(
      ".form-group, .input-group, .alert"
    );
    elementsToAnimate.forEach((element) => observer.observe(element));
  }

  animateElement(element) {
    gsap.fromTo(
      element,
      { opacity: 0, y: 30 },
      {
        opacity: 1,
        y: 0,
        duration: 0.6,
        ease: "power3.out",
      }
    );
  }

  // ===== MÉTODOS PÚBLICOS =====
  addCard(cardData, container = document.body) {
    const card = document.createElement("div");
    card.className = `system-card ${cardData.type || ""}`;
    card.innerHTML = `
            <div class="system-card-header">
                <h3 class="system-card-title">
                    ${cardData.icon ? `<i class="${cardData.icon}"></i>` : ""}
                    ${cardData.title}
                </h3>
                ${
                  cardData.badge
                    ? `<span class="system-card-badge">${cardData.badge}</span>`
                    : ""
                }
            </div>
            <div class="system-card-content">
                ${cardData.content}
            </div>
            ${
              cardData.footer
                ? `<div class="system-card-footer">${cardData.footer}</div>`
                : ""
            }
        `;

    if (cardData.clickable) {
      card.setAttribute("data-clickable", "true");
      if (cardData.url) card.setAttribute("data-url", cardData.url);
      if (cardData.action) card.setAttribute("data-action", cardData.action);
    }

    container.appendChild(card);

    // Reconfigurar eventos
    this.setupCards();

    return card;
  }

  showConfirmDialog(message, callback) {
    // TODO: Implementar diálogo de confirmación personalizado
    if (confirm(message)) {
      callback();
    }
  }

  updateStatsCard(selector, newValue, animated = true) {
    const card = document.querySelector(selector);
    const valueElement = card?.querySelector(".stats-value");

    if (valueElement) {
      if (animated) {
        this.animateStatsCard(card);
      } else {
        valueElement.textContent = newValue;
      }
    }
  }
}

// Inicializar cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
  window.componentSystem = new ComponentSystem();
});

// CSS adicional para efectos dinámicos
const componentStyles = `
.loading .spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.form-control.is-valid {
    border-color: #22c55e;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
}

.form-control.is-invalid {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
}

.form-floating .form-label.active {
    transform: translateY(-0.5rem) scale(0.85);
    color: var(--primary-green);
}

.ripple-effect {
    animation: ripple 0.6s linear;
}

@keyframes ripple {
    to {
        transform: translate(-50%, -50%) scale(2);
        opacity: 0;
    }
}

.card-shine-effect {
    animation: shine 0.8s ease-out;
}

@keyframes shine {
    from { left: -100%; }
    to { left: 100%; }
}

.alert {
    animation: slideInRight 0.4s ease-out;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
`;

const componentStyleElement = document.createElement("style");
componentStyleElement.textContent = componentStyles;
document.head.appendChild(componentStyleElement);
