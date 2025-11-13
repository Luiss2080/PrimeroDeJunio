// PRIMERO DE JUNIO - HOME PAGE JAVASCRIPT
// Migración completa de la lógica desde Home.jsx

class HomePageController {
  constructor() {
    // Estados para animaciones y carruseles
    this.currentText = "";
    this.textIndex = 0;
    this.currentCourseSlide = 0;
    this.currentTestimonial = 0;
    this.currentSignal = 0;
    this.visibleCards = new Set();
    this.observerRef = null;

    // Datos para carruseles
    this.texts = [
      "Conductor Profesional",
      "Especialista en Rutas",
      "Servicio Confiable",
      "Transporte Seguro",
    ];

    this.courses = [
      {
        id: 1,
        title: "Desarrollo Web Básico",
        description: "Aprende los fundamentos del rutas de la ciudad",
        price: "$199",
        image: "📊",
        level: "Principiante",
        duration: "6 semanas",
        students: "2,847",
      },
      {
        id: 2,
        title: "Servicio Express",
        description: "Estrategias profesionales para conductors experimentados",
        price: "$399",
        image: "📈",
        level: "Avanzado",
        duration: "12 semanas",
        students: "1,234",
      },
      {
        id: 3,
        title: "Índices Sintéticos",
        description: "Domina los mercados sintéticos de alta volatilidad",
        price: "$299",
        image: "🎯",
        level: "Intermedio",
        duration: "8 semanas",
        students: "987",
      },
      {
        id: 4,
        title: "Análisis Técnico",
        description: "Interpreta gráficos como un profesional",
        price: "$249",
        image: "📉",
        level: "Intermedio",
        duration: "10 semanas",
        students: "1,567",
      },
    ];

    this.testimonials = [
      {
        name: "Carlos Mendoza",
        position: "Servicio Confiable",
        image: "👨‍💼",
        text: "PRIMERO DE JUNIO transformó mi vida financiera completamente. En 6 meses logré la libertad financiera que buscaba.",
        profit: "+285%",
        country: "🇲🇽 México",
      },
      {
        name: "Ana Rodriguez",
        position: "Inversionista",
        image: "👩‍💼",
        text: "Las estrategias que aprendí me permitieron generar ingresos pasivos consistentes. Altamente recomendado.",
        profit: "+190%",
        country: "🇪🇸 España",
      },
      {
        name: "Luis Silva",
        position: "Empresario",
        image: "👨‍💻",
        text: "La mejor inversión que he hecho. El ROI fue increíble y ahora vivo del Desarrollo profesionalmente.",
        profit: "+340%",
        country: "🇨🇴 Colombia",
      },
    ];

    this.signals = [
      {
        pair: "EUR/USD",
        action: "BUY",
        entry: "1.0875",
        tp: "1.0925",
        sl: "1.0825",
        status: "ACTIVE",
        profit: "+45 pips",
      },
      {
        pair: "GBP/JPY",
        action: "SELL",
        entry: "189.45",
        tp: "188.90",
        sl: "190.00",
        status: "CLOSED",
        profit: "+55 pips",
      },
      {
        pair: "USD/CAD",
        action: "BUY",
        entry: "1.3650",
        tp: "1.3700",
        sl: "1.3600",
        status: "PENDING",
        profit: "---",
      },
    ];

    this.team = [
      {
        name: "Roberto García",
        position: "CEO & conductor Senior",
        experience: "15+ años",
        specialty: "Desarrollo Web & Commodities",
        image: "👨‍💼",
        description:
          "Ex-conductor de Goldman Sachs con más de $50M gestionados",
      },
      {
        name: "María Fernández",
        position: "Directora de Educación",
        experience: "12+ años",
        specialty: "Análisis Técnico",
        image: "👩‍🏫",
        description:
          "Certificada CFA con especialización en mercados emergentes",
      },
      {
        name: "David López",
        position: "Head of Research",
        experience: "10+ años",
        specialty: "Algoritmos & IA",
        image: "👨‍🔬",
        description: "PhD en Finanzas Cuantitativas, ex-JPMorgan",
      },
    ];

    // Inicializar cuando el DOM esté listo
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => this.init());
    } else {
      this.init();
    }
  }

  init() {
    console.log("🏠 PRIMERO DE JUNIO: Home page JavaScript inicializado...");
    this.setupTextRotation();
    this.setupCarousels();
    this.setupIntersectionObserver();
    this.setupEventListeners();
    this.updateTextContent();
  }

  // Rotación automática de textos
  setupTextRotation() {
    this.textRotationInterval = setInterval(() => {
      this.textIndex = (this.textIndex + 1) % this.texts.length;
      this.updateTextContent();
    }, 3000);
  }

  updateTextContent() {
    this.currentText = this.texts[this.textIndex];
    const textElement = document.querySelector(".hero-title-animated");
    if (textElement) {
      textElement.textContent = this.currentText;
    }
  }

  // Configuración de carruseles automáticos
  setupCarousels() {
    // Carrusel de cursos
    this.courseInterval = setInterval(() => {
      this.currentCourseSlide =
        (this.currentCourseSlide + 1) % this.courses.length;
      this.updateCourseCarousel();
    }, 4000);

    // Carrusel de testimonios
    this.testimonialInterval = setInterval(() => {
      this.currentTestimonial =
        (this.currentTestimonial + 1) % this.testimonials.length;
      this.updateTestimonialCarousel();
    }, 5000);

    // Rotación de señales
    this.signalInterval = setInterval(() => {
      this.currentSignal = (this.currentSignal + 1) % this.signals.length;
      this.updateSignalDisplay();
    }, 3000);
  }

  updateCourseCarousel() {
    const courseTrack = document.querySelector(".course-carousel-track");
    if (courseTrack) {
      const translateX = -this.currentCourseSlide * 100;
      courseTrack.style.transform = `translateX(${translateX}%)`;
    }
  }

  updateTestimonialCarousel() {
    const testimonialTrack = document.querySelector(
      ".testimonial-carousel-track"
    );
    if (testimonialTrack) {
      const translateX = -this.currentTestimonial * 100;
      testimonialTrack.style.transform = `translateX(${translateX}%)`;
    }
  }

  updateSignalDisplay() {
    const signalDisplay = document.querySelector(".current-signal-display");
    if (signalDisplay) {
      const signal = this.signals[this.currentSignal];
      signalDisplay.innerHTML = `
        <div class="signal-pair">${signal.pair}</div>
        <div class="signal-action ${signal.action.toLowerCase()}">${
        signal.action
      }</div>
        <div class="signal-details">
          <span>Entry: ${signal.entry}</span>
          <span>TP: ${signal.tp}</span>
          <span>SL: ${signal.sl}</span>
        </div>
        <div class="signal-profit">${signal.profit}</div>
      `;
    }
  }

  // Intersection Observer para animaciones
  setupIntersectionObserver() {
    this.observerRef = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            this.visibleCards.add(entry.target.id);
            entry.target.classList.add("card-visible");
            entry.target.classList.remove("card-hidden");
          }
        });
      },
      { threshold: 0.1 }
    );

    // Observar todos los elementos con la clase card-hidden
    document.querySelectorAll(".card-hidden").forEach((element) => {
      this.observerRef.observe(element);
    });
  }

  // Event listeners para interacciones
  setupEventListeners() {
    // Botones hover effects
    this.setupButtonHoverEffects();

    // Scroll effects
    this.setupScrollEffects();

    // Play button click
    this.setupVideoPlayButton();

    // Feature cards hover effects
    this.setupFeatureCardEffects();
  }

  setupButtonHoverEffects() {
    // Hero buttons
    const primaryButton = document.querySelector(".hero-btn-primary");
    if (primaryButton) {
      primaryButton.addEventListener("mouseenter", (e) => {
        e.target.style.transform = "translateY(-3px) scale(1.02)";
        e.target.style.boxShadow = "0 20px 40px rgba(0, 255, 136, 0.6)";
      });

      primaryButton.addEventListener("mouseleave", (e) => {
        e.target.style.transform = "translateY(0) scale(1)";
        e.target.style.boxShadow = "0 15px 35px rgba(0, 255, 136, 0.4)";
      });
    }

    const secondaryButton = document.querySelector(".hero-btn-secondary");
    if (secondaryButton) {
      secondaryButton.addEventListener("mouseenter", (e) => {
        e.target.style.background = "rgba(0, 255, 136, 0.1)";
        e.target.style.transform = "translateY(-3px)";
        e.target.style.borderColor = "#00ff66";
      });

      secondaryButton.addEventListener("mouseleave", (e) => {
        e.target.style.background = "rgba(255, 255, 255, 0.1)";
        e.target.style.transform = "translateY(0)";
        e.target.style.borderColor = "#00ff88";
      });
    }
  }

  setupScrollEffects() {
    let ticking = false;

    const updateScrollEffects = () => {
      const scrollY = window.scrollY;
      const heroSection = document.querySelector(".hero-section");
      const asociacionSection = document.querySelector(".asociacion-hero");

      if (heroSection) {
        // Parallax effect para hero
        const parallaxElements = document.querySelectorAll(
          ".hero-background-overlay, .hero-particles"
        );
        parallaxElements.forEach((element) => {
          const speed = element.classList.contains("hero-particles")
            ? 0.3
            : 0.5;
          element.style.transform = `translateY(${scrollY * speed}px)`;
        });
      }

      if (asociacionSection) {
        // Parallax effect para asociación
        const asociacionParallax = document.querySelectorAll(
          ".asociacion-particles, .cta-particles"
        );
        asociacionParallax.forEach((element) => {
          const speed = 0.2;
          element.style.transform = `translateY(${scrollY * speed}px)`;
        });
      }

      // Parallax effect para servicios
      const serviciosSection = document.querySelector(".Servicios-hero");
      if (serviciosSection) {
        const serviciosParallax = document.querySelectorAll(
          ".hero-particles, .why-choose-background"
        );
        serviciosParallax.forEach((element) => {
          const speed = element.classList.contains("hero-particles") ? 0.3 : 0.25;
          element.style.transform = `translateY(${scrollY * speed}px)`;
        });
      }

      ticking = false;
    };

    const requestScrollUpdate = () => {
      if (!ticking) {
        requestAnimationFrame(updateScrollEffects);
        ticking = true;
      }
    };

    window.addEventListener("scroll", requestScrollUpdate);
  }

  setupVideoPlayButton() {
    const playButton = document.querySelector(".hero-play-button");
    if (playButton) {
      playButton.addEventListener("click", () => {
        // Aquí puedes agregar la lógica para reproducir el video
        console.log("🎬 Reproduciendo video demo...");

        // Ejemplo: abrir modal de video o iniciar reproducción
        this.showVideoModal();
      });
    }
  }

  showVideoModal() {
    // Crear modal de video dinámicamente
    const modal = document.createElement("div");
    modal.className = "video-modal";
    modal.innerHTML = `
      <div class="video-modal-overlay">
        <div class="video-modal-content">
          <button class="video-modal-close">&times;</button>
          <div class="video-container">
            <iframe 
              src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
              frameborder="0" 
              allowfullscreen>
            </iframe>
          </div>
        </div>
      </div>
    `;

    document.body.appendChild(modal);

    // Cerrar modal
    modal.querySelector(".video-modal-close").addEventListener("click", () => {
      modal.remove();
    });

    modal.addEventListener("click", (e) => {
      if (
        e.target === modal ||
        e.target.classList.contains("video-modal-overlay")
      ) {
        modal.remove();
      }
    });
  }

  setupFeatureCardEffects() {
    const featureCards = document.querySelectorAll(".feature-card");

    featureCards.forEach((card) => {
      card.addEventListener("mouseenter", (e) => {
        const shineEffect = e.currentTarget.querySelector(".shine-effect");
        if (shineEffect) {
          shineEffect.style.transform = "translateX(100%)";
        }
      });

      card.addEventListener("mouseleave", (e) => {
        const shineEffect = e.currentTarget.querySelector(".shine-effect");
        if (shineEffect) {
          shineEffect.style.transform = "translateX(-100%)";
        }
      });
    });

    // Feature buttons
    const featureButtons = document.querySelectorAll(".feature-button");
    featureButtons.forEach((button) => {
      button.addEventListener("mouseenter", (e) => {
        e.target.style.transform = "scale(1.02)";
        e.target.style.boxShadow = "0 12px 30px rgba(0,255,136,0.4)";
      });

      button.addEventListener("mouseleave", (e) => {
        e.target.style.transform = "scale(1)";
        e.target.style.boxShadow = "0 8px 25px rgba(0,255,136,0.3)";
      });
    });
  }

  // Funciones de navegación para carruseles manuales
  nextCourse() {
    this.currentCourseSlide =
      (this.currentCourseSlide + 1) % this.courses.length;
    this.updateCourseCarousel();
  }

  prevCourse() {
    this.currentCourseSlide =
      this.currentCourseSlide === 0
        ? this.courses.length - 1
        : this.currentCourseSlide - 1;
    this.updateCourseCarousel();
  }

  nextTestimonial() {
    this.currentTestimonial =
      (this.currentTestimonial + 1) % this.testimonials.length;
    this.updateTestimonialCarousel();
  }

  prevTestimonial() {
    this.currentTestimonial =
      this.currentTestimonial === 0
        ? this.testimonials.length - 1
        : this.currentTestimonial - 1;
    this.updateTestimonialCarousel();
  }

  // Destruir listeners al salir de la página
  destroy() {
    if (this.textRotationInterval) clearInterval(this.textRotationInterval);
    if (this.courseInterval) clearInterval(this.courseInterval);
    if (this.testimonialInterval) clearInterval(this.testimonialInterval);
    if (this.signalInterval) clearInterval(this.signalInterval);
    if (this.observerRef) this.observerRef.disconnect();
  }

  // Métodos de utilidad
  animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
      current += increment;
      element.textContent = Math.floor(current);

      if (current >= target) {
        element.textContent = target;
        clearInterval(timer);
      }
    }, 16);
  }

  // Lazy loading de imágenes
  setupLazyLoading() {
    const images = document.querySelectorAll("img[data-src]");
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.classList.remove("lazy");
          observer.unobserve(img);
        }
      });
    });

    images.forEach((img) => imageObserver.observe(img));
  }

  // Smooth scroll para navegación
  smoothScrollTo(target) {
    const element = document.querySelector(target);
    if (element) {
      element.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  }

  // Función para detectar si un elemento está visible
  isElementVisible(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  // Performance optimization: debounce function
  debounce(func, wait) {
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

  // Throttle function for scroll events
  throttle(func, limit) {
    let inThrottle;
    return function () {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => (inThrottle = false), limit);
      }
    };
  }
}

// CSS adicional para el modal de video
const videoModalStyles = `
.video-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 10000;
  animation: fadeInUp 0.3s ease-out;
}

.video-modal-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.video-modal-content {
  position: relative;
  width: 100%;
  max-width: 900px;
  aspect-ratio: 16/9;
  background: #000;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.video-modal-close {
  position: absolute;
  top: -50px;
  right: 0;
  background: none;
  border: none;
  color: white;
  font-size: 2rem;
  cursor: pointer;
  padding: 0.5rem;
  z-index: 10001;
  transition: transform 0.2s ease;
}

.video-modal-close:hover {
  transform: scale(1.1);
}

.video-container {
  width: 100%;
  height: 100%;
}

.video-container iframe {
  width: 100%;
  height: 100%;
}

@media (max-width: 768px) {
  .video-modal-overlay {
    padding: 1rem;
  }
  
  .video-modal-close {
    top: -40px;
    font-size: 1.5rem;
  }
}
`;

// Agregar estilos del modal al documento
const styleSheet = document.createElement("style");
styleSheet.textContent = videoModalStyles;
document.head.appendChild(styleSheet);

// === CONTROLADOR DE PÁGINA ASOCIACIÓN ===
class AsociacionPageController {
  constructor() {
    this.activeTab = "metodologia";
    this.visibleSections = new Set();
    this.currentTestimonial = 0;
    this.observerRef = null;

    // Datos para la metodología
    this.methodology = [
      {
        phase: "Fase 1",
        title: "Fundamentos de Conducción",
        duration: "2-3 semanas",
        icon: "🏎️",
        description: "Construimos las bases sólidas de conducción segura",
        topics: [
          "Reglas de tránsito",
          "Conducción defensiva",
          "Mantenimiento básico del vehículo",
          "Primeros auxilios básicos",
        ],
      },
      {
        phase: "Fase 2",
        title: "Servicio al Cliente",
        duration: "2 semanas",
        icon: "🤝",
        description: "Desarrollo de habilidades de atención y comunicación",
        topics: [
          "Técnicas de comunicación",
          "Resolución de conflictos",
          "Atención al usuario",
          "Imagen profesional",
        ],
      },
      {
        phase: "Fase 3",
        title: "Práctica Supervisada",
        duration: "3-4 semanas",
        icon: "🎯",
        description: "Aplicación práctica con supervisión profesional",
        topics: [
          "Rutas urbanas principales",
          "Manejo en situaciones complejas",
          "Uso de tecnología GPS",
          "Evaluación continua",
        ],
      },
    ];

    // Datos para testimonios
    this.testimonials = [
      {
        name: "María González",
        position: "Conductora Destacada 2024",
        image: "👩‍💼",
        text: "Gracias a PRIMERO DE JUNIO logré tener mi propio mototaxi y ahora mantengo a mi familia dignamente. La capacitación fue excelente.",
        profit: "+150%",
        country: "🇧🇴 Santa Cruz, Bolivia",
        certification: "Master Conductor",
      },
      {
        name: "Roberto Silva",
        position: "Ex-Obrero de Construcción",
        image: "👨‍💻",
        text: "Cambié la construcción por el mototaxi. Ahora tengo horarios flexibles y gano más que antes. La asociación me apoyó en todo.",
        profit: "+200%",
        country: "🇧🇴 La Paz, Bolivia",
        certification: "Conductor Profesional",
      },
      {
        name: "Carmen López",
        position: "Madre de Familia",
        image: "👩‍🚀",
        text: "Como madre soltera, el mototaxi me permitió trabajar y cuidar a mis hijos. La flexibilidad horaria es increíble.",
        profit: "+180%",
        country: "🇧🇴 Cochabamba, Bolivia",
        certification: "Master Conductor",
      },
    ];

    // Inicializar cuando el DOM esté listo
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => this.init());
    } else {
      this.init();
    }
  }

  init() {
    console.log(
      "🏢 PRIMERO DE JUNIO: Asociación page JavaScript inicializado..."
    );
    this.setupTabs();
    this.setupIntersectionObserver();
    this.setupTestimonialCarousel();
    this.setupParticleEffects();
    this.renderTabContent();
  }

  // Configurar efectos de partículas
  setupParticleEffects() {
    const particles = document.querySelectorAll(
      ".asociacion-particles, .cta-particles"
    );
    particles.forEach((particle) => {
      if (particle) {
        // Añadir efecto de movimiento sutil
        particle.style.opacity = "0";
        particle.style.transition = "opacity 1s ease-in-out";

        setTimeout(() => {
          particle.style.opacity = "1";
        }, 300);
      }
    });
  }

  // Configurar sistema de tabs
  setupTabs() {
    const tabButtons = document.querySelectorAll(".tab-button");
    tabButtons.forEach((button) => {
      button.addEventListener("click", (e) => {
        const tabId = button.dataset.tab;
        if (tabId && tabId !== this.activeTab) {
          this.setActiveTab(tabId);
        }
      });
    });
  }

  setActiveTab(tabId) {
    // Actualizar estado activo
    this.activeTab = tabId;

    // Actualizar botones
    document.querySelectorAll(".tab-button").forEach((btn) => {
      btn.classList.remove("active");
    });

    const activeButton = document.querySelector(`[data-tab="${tabId}"]`);
    if (activeButton) {
      activeButton.classList.add("active");
    }

    // Renderizar contenido
    this.renderTabContent();
  }

  // Renderizar contenido de tabs
  renderTabContent() {
    const tabContent = document.querySelector(".tab-content");
    if (!tabContent) return;

    switch (this.activeTab) {
      case "metodologia":
        tabContent.innerHTML = this.renderMethodologyContent();
        break;
      case "certificaciones":
        tabContent.innerHTML = this.renderCertificationsContent();
        break;
      case "profesores":
        tabContent.innerHTML = this.renderProfessorsContent();
        break;
      case "servicios":
        tabContent.innerHTML = this.renderServicesContent();
        break;
      default:
        tabContent.innerHTML = this.renderMethodologyContent();
    }

    // Reinicializar observer para nuevo contenido
    setTimeout(() => {
      this.setupIntersectionObserver();
    }, 100);
  }

  renderMethodologyContent() {
    return `
      <div class="methodology-content">
        <div class="methodology-intro">
          <h3>Metodología Probada y Efectiva</h3>
          <p>
            Nuestra metodología ha sido desarrollada y perfeccionada durante
            más de 15 años, combinando técnicas de capacitación profesional
            con experiencia práctica para crear conductores exitosos,
            seguros y confiables.
          </p>
        </div>
        <div class="methodology-phases">
          ${this.methodology
            .map(
              (phase, index) => `
            <div class="methodology-phase" data-section-id="phase-${index}">
              <div class="phase-icon">${phase.icon}</div>
              <div class="phase-header">
                <span class="phase-number">${phase.phase}</span>
                <span class="phase-duration">${phase.duration}</span>
              </div>
              <h4 class="phase-title">${phase.title}</h4>
              <p class="phase-description">${phase.description}</p>
              <ul class="phase-topics">
                ${phase.topics.map((topic) => `<li>${topic}</li>`).join("")}
              </ul>
            </div>
          `
            )
            .join("")}
        </div>
      </div>
    `;
  }

  renderCertificationsContent() {
    const certifications = [
      {
        id: 1,
        name: "Conductor Certificado PRIMERO DE JUNIO",
        level: "Básico",
        duration: "2 meses",
        icon: "🥉",
        requirements: [
          "Completar curso de conducción defensiva",
          "Aprobar examen teórico vial",
          "Demostrar manejo seguro en prueba práctica",
        ],
        benefits: [
          "Certificado digital",
          "Acceso a rutas básicas",
          "Descuento en mantenimiento",
        ],
      },
      {
        id: 2,
        name: "Conductor Profesional PRIMERO DE JUNIO",
        level: "Intermedio",
        duration: "4 meses",
        icon: "🥈",
        requirements: [
          "Certificación básica",
          "500+ viajes completados",
          "Curso de atención al cliente",
        ],
        benefits: [
          "Certificado físico",
          "Acceso a rutas premium",
          "Seguro de vida extendido",
          "Tarifas preferenciales",
        ],
      },
      {
        id: 3,
        name: "Master Conductor PRIMERO DE JUNIO",
        level: "Avanzado",
        duration: "6 meses",
        icon: "🥇",
        requirements: [
          "Certificación profesional",
          "Capacitación como instructor",
          "1000+ viajes sin incidentes",
        ],
        benefits: [
          "Certificado especializado",
          "Participación en ganancias",
          "Programa de referidos",
          "Financiamiento de vehículo",
        ],
      },
    ];

    return `
      <div class="certifications-content">
        <div class="certifications-intro">
          <h3>Nuestros Programas de Certificación</h3>
          <p>
            Ofrecemos diferentes niveles de certificación para que puedas avanzar
            en tu carrera como conductor profesional. Cada nivel te brinda nuevas
            oportunidades y beneficios exclusivos.
          </p>
        </div>
        <div class="certifications-grid">
          ${certifications
            .map(
              (cert) => `
            <div class="certification-card">
              <div class="certification-icon">${cert.icon}</div>
              <h4 class="certification-name">${cert.name}</h4>
              <div class="certification-level">${cert.level}</div>
              <div class="certification-duration">Duración: ${
                cert.duration
              }</div>
              
              <div class="certification-requirements">
                <h4>Requisitos:</h4>
                <ul>
                  ${cert.requirements.map((req) => `<li>${req}</li>`).join("")}
                </ul>
              </div>
              
              <div class="certification-benefits">
                <h4>Beneficios:</h4>
                <ul>
                  ${cert.benefits
                    .map((benefit) => `<li>${benefit}</li>`)
                    .join("")}
                </ul>
              </div>
            </div>
          `
            )
            .join("")}
        </div>
      </div>
    `;
  }

  renderProfessorsContent() {
    const professors = [
      {
        id: 1,
        name: "Carlos Mendoza",
        position: "Director de Capacitación",
        specialization: "Seguridad Vial y Conducción Defensiva",
        experience: "12+ años",
        image: "👨‍🏫",
        achievements: [
          "Ex-Instructor de Policía Nacional",
          "Especialista en Transporte Urbano",
          "+5000 conductores capacitados",
          "Certificación Internacional en Seguridad Vial",
        ],
        rating: 4.9,
      },
      {
        id: 2,
        name: "Ana Rodriguez",
        position: "Jefa de Atención al Cliente",
        specialization: "Servicio al Cliente & Comunicación",
        experience: "8+ años",
        image: "👩‍🏫",
        achievements: [
          "Ex-Gerente de Servicio Uber",
          "Especialista en Experiencia del Usuario",
          "Certificada en Comunicación Asertiva",
          "Líder en Programas de Calidad",
        ],
        rating: 4.8,
      },
      {
        id: 3,
        name: "Luis Silva",
        position: "Especialista en Tecnología",
        specialization: "Aplicaciones Móviles & GPS",
        experience: "6+ años",
        image: "👨‍💻",
        achievements: [
          "Desarrollador de Apps de Transporte",
          "Especialista en Sistemas GPS",
          "Capacitador en Herramientas Digitales",
          "Certificado en Innovación Tecnológica",
        ],
        rating: 4.7,
      },
    ];

    return `
      <div class="professors-content">
        <div class="professors-intro">
          <h3>Nuestro Equipo de Instructores</h3>
          <p>
            Contamos con un equipo de instructores altamente calificados y con
            amplia experiencia en la industria del transporte. Cada uno aporta
            conocimientos especializados para tu formación integral.
          </p>
        </div>
        <div class="professors-grid">
          ${professors
            .map(
              (prof) => `
            <div class="professor-card">
              <div class="professor-image">${prof.image}</div>
              <h4 class="professor-name">${prof.name}</h4>
              <div class="professor-position">${prof.position}</div>
              <div class="professor-specialization">${prof.specialization}</div>
              <div class="professor-experience">${prof.experience}</div>
              
              <div class="professor-achievements">
                <h4>Logros destacados:</h4>
                <ul>
                  ${prof.achievements
                    .map((achievement) => `<li>${achievement}</li>`)
                    .join("")}
                </ul>
              </div>
              
              <div class="professor-rating">
                <span class="professor-rating-value">${prof.rating}</span>
                <span class="professor-rating-stars">⭐⭐⭐⭐⭐</span>
              </div>
            </div>
          `
            )
            .join("")}
        </div>
      </div>
    `;
  }

  renderServicesContent() {
    return `
      <div class="methodology-content">
        <div class="methodology-intro">
          <h3>Servicios Integrales</h3>
          <p>
            Ofrecemos una gama completa de servicios diseñados para apoyar
            tu desarrollo como conductor profesional y garantizar tu éxito
            en la industria del transporte.
          </p>
        </div>
        <div class="methodology-phases">
          <div class="methodology-phase">
            <div class="phase-icon">🚗</div>
            <h4 class="phase-title">Financiamiento de Vehículos</h4>
            <p class="phase-description">
              Te ayudamos a adquirir tu propio mototaxi con planes de 
              financiamiento flexibles y tasas preferenciales.
            </p>
          </div>
          
          <div class="methodology-phase">
            <div class="phase-icon">🛡️</div>
            <h4 class="phase-title">Seguro Integral</h4>
            <p class="phase-description">
              Cobertura completa que incluye seguro de vida, accidentes
              y protección del vehículo.
            </p>
          </div>
          
          <div class="methodology-phase">
            <div class="phase-icon">📱</div>
            <h4 class="phase-title">Aplicación Móvil</h4>
            <p class="phase-description">
              Plataforma tecnológica que conecta conductores con pasajeros,
              optimizando rutas y maximizando ganancias.
            </p>
          </div>
          
          <div class="methodology-phase">
            <div class="phase-icon">⚙️</div>
            <h4 class="phase-title">Mantenimiento</h4>
            <p class="phase-description">
              Red de talleres afiliados con descuentos especiales para
              mantener tu vehículo en óptimas condiciones.
            </p>
          </div>
        </div>
      </div>
    `;
  }

  // Configurar carrusel de testimonios
  setupTestimonialCarousel() {
    // Auto-rotate testimonials
    this.testimonialInterval = setInterval(() => {
      this.currentTestimonial =
        (this.currentTestimonial + 1) % this.testimonials.length;
      this.updateTestimonialCarousel();
    }, 5000);

    // Setup dots navigation
    this.setupTestimonialDots();
  }

  setupTestimonialDots() {
    const dotsContainer = document.querySelector(".testimonials-dots");
    if (dotsContainer) {
      dotsContainer.innerHTML = this.testimonials
        .map(
          (_, index) =>
            `<button class="dot ${
              index === this.currentTestimonial ? "active" : ""
            }" 
                 onclick="window.asociacionController.setTestimonial(${index})"></button>`
        )
        .join("");
    }
  }

  setTestimonial(index) {
    this.currentTestimonial = index;
    this.updateTestimonialCarousel();
    this.setupTestimonialDots();
  }

  updateTestimonialCarousel() {
    const track = document.querySelector(".testimonials-track");
    if (track) {
      const translateX = -this.currentTestimonial * 100;
      track.style.transform = `translateX(${translateX}%)`;
    }
    this.setupTestimonialDots();
  }

  // Intersection Observer para animaciones
  setupIntersectionObserver() {
    if (this.observerRef) {
      this.observerRef.disconnect();
    }

    this.observerRef = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const sectionId = entry.target.dataset.sectionId;
            if (sectionId) {
              this.visibleSections.add(sectionId);
              entry.target.classList.add("visible");
            }
          }
        });
      },
      { threshold: 0.1, rootMargin: "50px" }
    );

    // Observar secciones con animaciones
    const sections = document.querySelectorAll("[data-section-id]");
    sections.forEach((section) => {
      this.observerRef.observe(section);
    });
  }

  // Destruir listeners al salir de la página
  destroy() {
    if (this.testimonialInterval) clearInterval(this.testimonialInterval);
    if (this.observerRef) this.observerRef.disconnect();
  }
}

// === SERVICIOS PAGE CONTROLLER ===
class ServiciosPageController {
  constructor() {
    this.selectedCategory = "todos";
    this.visibleCourses = new Set();
    this.observerRef = null;

    // Inicializar cuando el DOM esté listo
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => this.init());
    } else {
      this.init();
    }
  }

  init() {
    console.log("🎓 PRIMERO DE JUNIO: Servicios page JavaScript inicializado...");
    this.setupCategoryFilters();
    this.setupIntersectionObserver();
    this.setupParticleEffects();
  }

  // Configurar filtros de categorías
  setupCategoryFilters() {
    const filterTabs = document.querySelectorAll(".filter-tab");
    filterTabs.forEach((tab) => {
      tab.addEventListener("click", (e) => {
        const category = tab.dataset.category || "todos";
        this.setActiveCategory(category);
      });
    });
  }

  setActiveCategory(category) {
    this.selectedCategory = category;
    
    // Actualizar tabs activos
    document.querySelectorAll(".filter-tab").forEach((tab) => {
      tab.classList.remove("active");
    });
    
    document.querySelector(`[data-category="${category}"]`)?.classList.add("active");
    
    // Filtrar servicios (esto se puede expandir según necesidad)
    this.filterCourses(category);
  }

  filterCourses(category) {
    const courseCards = document.querySelectorAll(".course-card");
    courseCards.forEach((card) => {
      const courseCategory = card.dataset.category;
      if (category === "todos" || courseCategory === category) {
        card.style.display = "block";
        card.classList.add("fade-in");
      } else {
        card.style.display = "none";
        card.classList.remove("fade-in");
      }
    });
  }

  // Configurar efectos de partículas
  setupParticleEffects() {
    const particles = document.querySelectorAll('.hero-particles, .why-choose-background');
    particles.forEach(particle => {
      if (particle) {
        particle.style.opacity = '0';
        particle.style.transition = 'opacity 1s ease-in-out';
        
        setTimeout(() => {
          particle.style.opacity = '1';
        }, 300);
      }
    });
  }

  // Configurar Intersection Observer
  setupIntersectionObserver() {
    this.observerRef = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const courseId = entry.target.dataset.courseId;
            if (courseId) {
              this.visibleCourses.add(courseId);
              entry.target.classList.add("visible");
            }
          }
        });
      },
      { threshold: 0.1, rootMargin: "50px" }
    );

    // Observar tarjetas de servicios
    const courseCards = document.querySelectorAll(".course-card");
    courseCards.forEach((card) => {
      this.observerRef.observe(card);
    });
  }

  // Destruir listeners al salir de la página
  destroy() {
    if (this.observerRef) this.observerRef.disconnect();
  }
}

// Inicializar controladores según la página actual
function initPageControllers() {
  const currentPath = window.location.pathname;
  const currentPage = getCurrentPageFromPath();

  console.log(
    `🎯 PRIMERO DE JUNIO: Inicializando controladores para página: ${currentPage}`
  );

  // Limpiar controladores existentes
  if (window.homePageController) {
    window.homePageController.destroy();
    window.homePageController = null;
  }

  if (window.asociacionController) {
    window.asociacionController.destroy();
    window.asociacionController = null;
  }

  if (window.serviciosController) {
    window.serviciosController.destroy();
    window.serviciosController = null;
  }

  // Inicializar controlador apropiado
  switch (currentPage) {
    case "inicio":
    case "home":
      window.homePageController = new HomePageController();
      break;
    case "asociacion":
      window.asociacionController = new AsociacionPageController();
      break;
    case "servicios":
      window.serviciosController = new ServiciosPageController();
      break;
    // Agregar más casos según se necesiten otras páginas
    default:
      console.log(
        "🏠 PRIMERO DE JUNIO: Página sin controlador específico, usando Home por defecto"
      );
      window.homePageController = new HomePageController();
  }
}

// Función para detectar página actual
function getCurrentPageFromPath() {
  // Si es una SPA React, detectar por el hash o estado
  const hash = window.location.hash;
  const path = window.location.pathname;

  // Detectar por elementos en la página
  if (document.querySelector(".asociacion-container")) return "asociacion";
  if (document.querySelector(".Servicios-page")) return "servicios";
  if (document.querySelector(".home-container")) return "inicio";

  // Fallback a home
  return "inicio";
}

// Inicializar cuando el DOM esté listo
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initPageControllers);
} else {
  initPageControllers();
}

// Reinicializar controladores cuando cambie la vista en React
window.addEventListener("popstate", initPageControllers);

// Detectar cambios en el DOM para reinicializar (útil para SPAs)
const pageObserver = new MutationObserver((mutations) => {
  let shouldReinit = false;
  mutations.forEach((mutation) => {
    if (mutation.type === "childList") {
      // Detectar si se agregó un contenedor de página
      mutation.addedNodes.forEach((node) => {
        if (node.nodeType === 1) {
          // Element node
          if (
            node.classList &&
            (node.classList.contains("asociacion-container") ||
              node.classList.contains("home-container"))
          ) {
            shouldReinit = true;
          }
        }
      });
    }
  });

  if (shouldReinit) {
    setTimeout(initPageControllers, 100);
  }
});

// Observar cambios en el body
pageObserver.observe(document.body, {
  childList: true,
  subtree: true,
});

// Escuchar eventos personalizados de React
window.addEventListener("pageChanged", (event) => {
  console.log(
    "🎯 PRIMERO DE JUNIO: Página cambió via evento:",
    event.detail.page
  );
  setTimeout(initPageControllers, 150);
});

// Re-check cada pocos segundos para asegurar inicialización
setInterval(() => {
  const currentPageDetected = getCurrentPageFromPath();
  const hasCorrectController =
    (currentPageDetected === "asociacion" && window.asociacionController) ||
    (currentPageDetected === "inicio" && window.homePageController);

  if (!hasCorrectController) {
    console.log("🔄 PRIMERO DE JUNIO: Re-inicializando controladores...");
    initPageControllers();
  }
}, 3000);

// Inicializar la aplicación
// window.homePageController = new HomePageController(); // Comentado para usar el nuevo sistema

// Limpiar al cerrar/salir de la página
window.addEventListener("beforeunload", () => {
  if (window.homePageController) {
    window.homePageController.destroy();
  }
  if (window.asociacionController) {
    window.asociacionController.destroy();
  }
});

// Exportar para uso global si es necesario
if (typeof module !== "undefined" && module.exports) {
  module.exports = HomePageController;
}
