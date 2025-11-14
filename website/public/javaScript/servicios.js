// PRIMERO DE JUNIO - SERVICIOS PAGE JAVASCRIPT
// JavaScript específico para la página de Servicios

class ServiciosPageController {
  constructor() {
    console.log("🎓 SERVICIOS: ServiciosPageController inicializando...");

    // Estados para filtros y animaciones
    this.selectedCategory = "todos";
    this.visibleCourses = new Set();
    this.observerRef = null;

    // Datos de categorías
    this.categories = [
      { id: "todos", name: "Todos los Servicios", icon: "🎯" },
      { id: "principiante", name: "Principiante", icon: "🌟" },
      { id: "intermedio", name: "Intermedio", icon: "📈" },
      { id: "avanzado", name: "Avanzado", icon: "🚀" },
      { id: "vip", name: "VIP Elite", icon: "👑" },
    ];

    // Datos de cursos/servicios
    this.courses = [
      {
        id: 1,
        title: "Desarrollo Web para Principiantes",
        description:
          "Aprende los fundamentos del servicio de mototaxi desde cero. Curso completo con estrategias probadas.",
        price: 199,
        originalPrice: 299,
        image: "📊",
        level: "principiante",
        duration: "6 semanas",
        students: "2,847",
        rating: 4.9,
        lessons: 45,
        certificate: true,
        highlights: [
          "Análisis técnico básico",
          "Gestión de riesgo",
          "Psicología del Desarrollo",
          "MetaDesarrollador 4/5",
        ],
      },
      {
        id: 2,
        title: "Desarrollo Avanzado Pro",
        description:
          "Estrategias profesionales para desarrolladors experimentados. Técnicas institucionales y algoritmos avanzados.",
        price: 499,
        originalPrice: 699,
        image: "🚀",
        level: "avanzado",
        duration: "12 semanas",
        students: "1,234",
        rating: 4.8,
        lessons: 89,
        certificate: true,
        highlights: [
          "Algoritmos institucionales",
          "Order Flow",
          "Market Making",
          "Backtesting avanzado",
        ],
      },
      {
        id: 3,
        title: "Índices Sintéticos Master",
        description:
          "Domina los mercados sintéticos de alta volatilidad. Estrategias exclusivas para índices artificiales.",
        price: 349,
        originalPrice: 449,
        image: "⚡",
        level: "intermedio",
        duration: "8 semanas",
        students: "987",
        rating: 4.7,
        lessons: 67,
        certificate: true,
        highlights: [
          "Volatility Indices",
          "Crash & Boom",
          "Jump Indices",
          "Estrategias de scalping",
        ],
      },
      {
        id: 4,
        title: "Análisis Técnico Profesional",
        description:
          "Interpreta gráficos como un experto institucional. Patrones avanzados y confluencias técnicas.",
        price: 299,
        originalPrice: 399,
        image: "📉",
        level: "intermedio",
        duration: "10 semanas",
        students: "1,567",
        rating: 4.9,
        lessons: 78,
        certificate: true,
        highlights: [
          "Patrones armónicos",
          "Elliott Wave",
          "Fibonacci avanzado",
          "Volume Profile",
        ],
      },
      {
        id: 5,
        title: "Elite VIP Mentorship",
        description:
          "Mentoría personalizada 1:1 con desarrolladors institucionales. Acceso exclusivo a señales premium.",
        price: 1999,
        originalPrice: 2999,
        image: "👑",
        level: "vip",
        duration: "24 semanas",
        students: "156",
        rating: 5.0,
        lessons: 999,
        certificate: true,
        highlights: [
          "Mentoría 1:1",
          "Señales premium",
          "Acceso directo",
          "Soporte 24/7",
        ],
      },
      {
        id: 6,
        title: "Criptomonedas & DeFi",
        description:
          "Desarrollo profesional de criptodivisas descentralizadas. Del spot al futuro.",
        price: 399,
        originalPrice: 549,
        image: "₿",
        level: "avanzado",
        duration: "14 semanas",
        students: "743",
        rating: 4.6,
        lessons: 92,
        certificate: true,
        highlights: [
          "DeFi Desarrollo",
          "NFT flipping",
          "Análisis on-chain",
          "Yield farming",
        ],
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
    console.log("🎓 SERVICIOS: Inicializando página de servicios...");
    this.setupFilterTabs();
    this.setupIntersectionObserver();
    this.setupEventListeners();
    this.setupScrollEffects();
    this.renderCourses();
  }

  // Configurar tabs de filtro
  setupFilterTabs() {
    const filterTabs = document.querySelectorAll(".filter-tab");

    filterTabs.forEach((tab) => {
      tab.addEventListener("click", (e) => {
        const category = e.currentTarget.dataset.category;
        if (category) {
          this.setActiveCategory(category);
        }
      });

      // Efectos hover adicionales
      tab.addEventListener("mouseenter", (e) => {
        if (!e.target.classList.contains("active")) {
          e.target.style.transform = "translateY(-3px) scale(1.02)";
          e.target.style.boxShadow = "0 8px 25px rgba(0, 255, 136, 0.3)";
        }
      });

      tab.addEventListener("mouseleave", (e) => {
        if (!e.target.classList.contains("active")) {
          e.target.style.transform = "translateY(0) scale(1)";
          e.target.style.boxShadow = "none";
        }
      });
    });
  }

  // Cambiar categoría activa
  setActiveCategory(category) {
    this.selectedCategory = category;

    // Actualizar tabs visuales
    document.querySelectorAll(".filter-tab").forEach((tab) => {
      tab.classList.remove("active");
      tab.style.transform = "translateY(0) scale(1)";
      tab.style.boxShadow = "none";
    });

    const activeTab = document.querySelector(`[data-category="${category}"]`);
    if (activeTab) {
      activeTab.classList.add("active");
    }

    // Filtrar y renderizar cursos
    this.renderCourses();
  }

  // Renderizar cursos filtrados
  renderCourses() {
    const filteredCourses = this.getFilteredCourses();
    const coursesGrid = document.querySelector(".courses-grid");

    if (!coursesGrid) return;

    // Limpiar grid actual
    coursesGrid.innerHTML = "";

    // Renderizar cursos filtrados
    filteredCourses.forEach((course, index) => {
      const courseElement = this.createCourseCard(course, index);
      coursesGrid.appendChild(courseElement);
    });

    // Reinicializar observer para nuevos elementos
    setTimeout(() => {
      this.setupIntersectionObserver();
    }, 100);
  }

  // Obtener cursos filtrados
  getFilteredCourses() {
    if (this.selectedCategory === "todos") {
      return this.courses;
    }
    return this.courses.filter(
      (course) => course.level === this.selectedCategory
    );
  }

  // Crear tarjeta de curso
  createCourseCard(course, index) {
    const card = document.createElement("div");
    card.className = "course-card";
    card.setAttribute("data-course-id", course.id);
    card.setAttribute("data-category", course.level);
    card.style.animationDelay = `${index * 0.1}s`;

    const discountPercentage =
      course.originalPrice > course.price
        ? Math.round(
            ((course.originalPrice - course.price) / course.originalPrice) * 100
          )
        : 0;

    card.innerHTML = `
      <div class="course-card-inner">
        <div class="course-image">
          <div class="course-icon">${course.image}</div>
          <div class="course-badge">${course.level}</div>
          ${
            discountPercentage > 0
              ? `<div class="discount-badge">${discountPercentage}% OFF</div>`
              : ""
          }
        </div>

        <div class="course-content">
          <div class="course-meta">
            <span class="course-students">👥 ${course.students}</span>
            <div class="course-rating">
              <span class="stars">⭐</span>
              <span>${course.rating}</span>
            </div>
          </div>

          <h3 class="course-title">${course.title}</h3>
          <p class="course-description">${course.description}</p>

          <div class="course-highlights">
            ${course.highlights
              .slice(0, 2)
              .map(
                (highlight) =>
                  `<span class="highlight-tag">✓ ${highlight}</span>`
              )
              .join("")}
          </div>

          <div class="course-info">
            <div class="course-duration">⏱ ${course.duration}</div>
            <div class="course-lessons">📚 ${course.lessons} lecciones</div>
            ${
              course.certificate
                ? '<div class="course-certificate">🏆 Certificado</div>'
                : ""
            }
          </div>

          <div class="course-footer">
            <div class="course-pricing">
              <span class="current-price">$${course.price}</span>
              ${
                course.originalPrice > course.price
                  ? `<span class="original-price">$${course.originalPrice}</span>`
                  : ""
              }
            </div>
            <button class="btn btn-primary course-btn" data-course-id="${
              course.id
            }">
              Ver Detalles
            </button>
          </div>
        </div>
      </div>
    `;

    return card;
  }

  // Intersection Observer para animaciones
  setupIntersectionObserver() {
    // Desconectar observer anterior si existe
    if (this.observerRef) {
      this.observerRef.disconnect();
    }

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

    // Observar todas las tarjetas de curso
    const courseCards = document.querySelectorAll(".course-card");
    courseCards.forEach((card) => {
      this.observerRef.observe(card);
    });
  }

  // Event listeners generales
  setupEventListeners() {
    // Botones de cursos
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("course-btn")) {
        const courseId = e.target.dataset.courseId;
        this.handleCourseButtonClick(courseId);
      }
    });

    // Efectos hover para tarjetas
    document.addEventListener(
      "mouseenter",
      (e) => {
        if (e.target.classList.contains("course-card")) {
          this.handleCardHoverEnter(e.target);
        }
      },
      true
    );

    document.addEventListener(
      "mouseleave",
      (e) => {
        if (e.target.classList.contains("course-card")) {
          this.handleCardHoverLeave(e.target);
        }
      },
      true
    );
  }

  // Manejar click en botón de curso
  handleCourseButtonClick(courseId) {
    const course = this.courses.find((c) => c.id == courseId);
    if (course) {
      console.log(`🎓 Ver detalles del curso: ${course.title}`);
      // Aquí puedes agregar lógica para mostrar detalles del curso
      this.showCourseModal(course);
    }
  }

  // Mostrar modal de curso
  showCourseModal(course) {
    const modal = document.createElement("div");
    modal.className = "course-modal";
    modal.innerHTML = `
      <div class="course-modal-overlay">
        <div class="course-modal-content">
          <button class="course-modal-close">&times;</button>
          <div class="course-modal-header">
            <div class="course-modal-icon">${course.image}</div>
            <h2>${course.title}</h2>
            <p>${course.description}</p>
          </div>
          <div class="course-modal-details">
            <div class="course-modal-info">
              <div class="info-item">
                <span class="info-label">Duración:</span>
                <span class="info-value">${course.duration}</span>
              </div>
              <div class="info-item">
                <span class="info-label">Lecciones:</span>
                <span class="info-value">${course.lessons}</span>
              </div>
              <div class="info-item">
                <span class="info-label">Estudiantes:</span>
                <span class="info-value">${course.students}</span>
              </div>
              <div class="info-item">
                <span class="info-label">Calificación:</span>
                <span class="info-value">⭐ ${course.rating}</span>
              </div>
            </div>
            <div class="course-modal-highlights">
              <h3>Lo que aprenderás:</h3>
              <ul>
                ${course.highlights
                  .map((highlight) => `<li>✓ ${highlight}</li>`)
                  .join("")}
              </ul>
            </div>
            <div class="course-modal-pricing">
              <span class="modal-price">$${course.price}</span>
              ${
                course.originalPrice > course.price
                  ? `<span class="modal-original-price">$${course.originalPrice}</span>`
                  : ""
              }
            </div>
            <button class="btn btn-primary modal-enroll-btn">
              🚀 Inscribirse Ahora
            </button>
          </div>
        </div>
      </div>
    `;

    document.body.appendChild(modal);

    // Event listener para cerrar modal
    const closeBtn = modal.querySelector(".course-modal-close");
    const overlay = modal.querySelector(".course-modal-overlay");

    closeBtn.addEventListener("click", () => this.closeCourseModal(modal));
    overlay.addEventListener("click", (e) => {
      if (e.target === overlay) {
        this.closeCourseModal(modal);
      }
    });

    // Animación de entrada
    setTimeout(() => {
      modal.style.opacity = "1";
      modal.querySelector(".course-modal-content").style.transform =
        "translateY(0) scale(1)";
    }, 10);
  }

  // Cerrar modal de curso
  closeCourseModal(modal) {
    modal.style.opacity = "0";
    modal.querySelector(".course-modal-content").style.transform =
      "translateY(50px) scale(0.9)";

    setTimeout(() => {
      document.body.removeChild(modal);
    }, 300);
  }

  // Efectos hover para tarjetas
  handleCardHoverEnter(card) {
    card.style.transform = "translateY(-15px) scale(1.02)";
    card.style.boxShadow = "0 25px 50px rgba(0, 255, 136, 0.2)";
    card.style.borderColor = "rgba(0, 255, 136, 0.4)";
  }

  handleCardHoverLeave(card) {
    card.style.transform = "translateY(0) scale(1)";
    card.style.boxShadow = "0 10px 30px rgba(0, 255, 136, 0.1)";
    card.style.borderColor = "rgba(0, 255, 136, 0.1)";
  }

  // Efectos de scroll
  setupScrollEffects() {
    let ticking = false;

    const updateScrollEffects = () => {
      const scrollY = window.scrollY;

      // Parallax para elementos de fondo
      const parallaxElements = document.querySelectorAll(
        ".hero-particles, .why-choose-background"
      );

      parallaxElements.forEach((element) => {
        const speed = element.classList.contains("hero-particles") ? 0.3 : 0.25;
        element.style.transform = `translateY(${scrollY * speed}px)`;
      });

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

  // Destruir controlador
  destroy() {
    console.log("🧹 ServiciosPageController destruido");

    // Limpiar intervals
    if (this.observerRef) {
      this.observerRef.disconnect();
    }

    // Remover event listeners
    document.removeEventListener("click", this.handleCourseButtonClick);
    window.removeEventListener("scroll", this.requestScrollUpdate);
  }
}

// Hacer disponible globalmente
window.ServiciosPageController = ServiciosPageController;
