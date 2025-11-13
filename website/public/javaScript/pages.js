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

      if (heroSection) {
        // Parallax effect
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

// Inicializar la aplicación
window.homePageController = new HomePageController();

// Limpiar al cerrar/salir de la página
window.addEventListener("beforeunload", () => {
  if (window.homePageController) {
    window.homePageController.destroy();
  }
});

// Exportar para uso global si es necesario
if (typeof module !== "undefined" && module.exports) {
  module.exports = HomePageController;
}
