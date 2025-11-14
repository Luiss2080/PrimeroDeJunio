// Asociacion page controller extracted from pages.js

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

// Exponer la clase para que pueda ser usada por otros scripts o por el sistema de controllers
if (typeof window !== 'undefined') {
  window.AsociacionPageController = AsociacionPageController;
}
