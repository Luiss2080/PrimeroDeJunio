import React, { useState, useEffect, useRef } from "react";
import "../styles/Servicios.css";

const Servicios = () => {
  console.log("🎓 SERVICIOS: Servicios component renderizando...");

  const [selectedCategory, setSelectedCategory] = useState("todos");
  const [visibleCourses, setVisibleCourses] = useState(new Set());
  const observerRef = useRef();

  // Inicializar el controlador de JavaScript cuando se monte el componente
  useEffect(() => {
    console.log("🔧 Inicializando ServiciosPageController...");

    // Función para cargar el script de JavaScript de Servicios
    const loadServiciosScript = () => {
      return new Promise((resolve, reject) => {
        // Verificar si el script ya está cargado
        const existingScript = document.querySelector('script[src="/javaScript/servicios.js"]');
        if (existingScript) {
          if (window.ServiciosPageController) {
            resolve();
          } else {
            existingScript.addEventListener('load', resolve);
            existingScript.addEventListener('error', reject);
          }
          return;
        }

        // Crear y cargar el script
        const script = document.createElement('script');
        script.src = '/javaScript/servicios.js';
        script.async = true;
        script.addEventListener('load', () => {
          console.log("✅ Script servicios.js cargado correctamente");
          resolve();
        });
        script.addEventListener('error', (err) => {
          console.error("❌ Error cargando servicios.js:", err);
          reject(err);
        });
        document.head.appendChild(script);
      });
    };

    // Función para inicializar el controlador
    const initController = () => {
      if (window.ServiciosPageController) {
        // Destruir instancia anterior si existe
        if (window.serviciosPageController) {
          window.serviciosPageController.destroy();
        }
        // Crear nueva instancia
        window.serviciosPageController = new window.ServiciosPageController();
        console.log("✅ ServiciosPageController inicializado correctamente");
      } else {
        console.warn("⚠️ ServiciosPageController no está disponible");
      }
    };

    // Cargar el script y luego inicializar el controlador
    loadServiciosScript()
      .then(() => {
        // Esperar un poco para que se inicialice completamente
        setTimeout(initController, 100);
      })
      .catch((error) => {
        console.error("❌ Error inicializando Servicios:", error);
      });

    return () => {
      // Cleanup: destruir el controlador cuando se desmonte el componente
      if (window.serviciosPageController) {
        window.serviciosPageController.destroy();
        window.serviciosPageController = null;
        console.log("🧹 ServiciosPageController destruido");
      }
    };
  }, []);

  const categories = [
    { id: "todos", name: "Todos los Servicios", icon: "🎯" },
    { id: "principiante", name: "Principiante", icon: "🌟" },
    { id: "intermedio", name: "Intermedio", icon: "📈" },
    { id: "avanzado", name: "Avanzado", icon: "🚀" },
    { id: "vip", name: "VIP Elite", icon: "👑" },
  ];

  const courses = [
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
        "Metadesarrollador 4/5",
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
      lessons: 999, // Ilimitado
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

  // Filter courses based on selected category
  const filteredCourses = courses.filter((course) => {
    if (selectedCategory === "todos") return true;
    return course.level === selectedCategory;
  });

  // Setup intersection observer for course cards
  useEffect(() => {
    observerRef.current = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const courseId = entry.target.dataset.courseId;
            if (courseId) {
              setVisibleCourses((prev) => new Set([...prev, courseId]));
            }
          }
        });
      },
      { threshold: 0.1, rootMargin: "50px" }
    );

    const cards = document.querySelectorAll(".course-card");
    cards.forEach((card) => observerRef.current.observe(card));

    return () => {
      if (observerRef.current) {
        observerRef.current.disconnect();
      }
    };
  }, [filteredCourses]);

  // Dispatch page change event
  useEffect(() => {
    const event = new CustomEvent("pageChanged", {
      detail: { page: "servicios" },
    });
    window.dispatchEvent(event);
  }, []);

  return (
    <div className="Servicios-page">
      {/* ===== HERO SECTION ===== */}
      <section className="Servicios-hero">
        <div className="hero-particles"></div>
        <div className="container">
          <div className="hero-content">
            <div className="hero-badge">
              <span className="badge-icon">🎓</span>
              <span>+15,000 Estudiantes Exitosos</span>
            </div>
            <h1 className="hero-title">
              Transforma tu Futuro con Nuestros
              <span className="gradient-text"> Servicios de Desarrollo</span>
            </h1>
            <p className="hero-description">
              Desde principiante hasta desarrollador profesional. Metodología probada
              que ha generado +$50M en ganancias para nuestros estudiantes.
            </p>
            <div className="hero-stats">
              <div className="stat">
                <span className="stat-number">96.8%</span>
                <span className="stat-label">Tasa de Éxito</span>
              </div>
              <div className="stat">
                <span className="stat-number">24/7</span>
                <span className="stat-label">Soporte</span>
              </div>
              <div className="stat">
                <span className="stat-number">ISO 9001</span>
                <span className="stat-label">Certificado</span>
              </div>
            </div>
          </div>
          <div className="hero-visual">
            {/* Aquí irían elementos visuales opcionales */}
          </div>
        </div>
      </section>

      {/* ===== FILTROS DE CATEGORÍAS ===== */}
      <section className="courses-filters">
        <div className="why-choose-background"></div>
        <div className="container">
          <div className="filter-tabs">
            {categories.map((category) => (
              <button
                key={category.id}
                className={`filter-tab ${
                  selectedCategory === category.id ? "active" : ""
                }`}
                onClick={() => setSelectedCategory(category.id)}
                data-category={category.id}
              >
                <span className="tab-icon">{category.icon}</span>
                <span className="tab-name">{category.name}</span>
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* ===== GRID DE SERVICIOS/CURSOS ===== */}
      <section className="courses-grid-section">
        <div className="container">
          <div className="courses-grid">
            {filteredCourses.map((course, index) => (
              <div
                key={course.id}
                className={`course-card ${
                  visibleCourses.has(course.id.toString()) ? "visible" : ""
                }`}
                data-course-id={course.id}
                data-category={course.level}
                style={{ animationDelay: `${index * 0.1}s` }}
              >
                <div className="course-card-inner">
                  <div className="course-image">
                    <div className="course-icon">{course.image}</div>
                    <div className="course-badge">{course.level}</div>
                    {course.originalPrice > course.price && (
                      <div className="discount-badge">
                        {Math.round(
                          ((course.originalPrice - course.price) /
                            course.originalPrice) *
                            100
                        )}
                        % OFF
                      </div>
                    )}
                  </div>

                  <div className="course-content">
                    <div className="course-meta">
                      <span className="course-students">
                        👥 {course.students}
                      </span>
                      <div className="course-rating">
                        <span className="stars">⭐</span>
                        <span>{course.rating}</span>
                      </div>
                    </div>

                    <h3 className="course-title">{course.title}</h3>
                    <p className="course-description">{course.description}</p>

                    <div className="course-highlights">
                      {course.highlights.slice(0, 2).map((highlight, idx) => (
                        <span key={idx} className="highlight-tag">
                          ✓ {highlight}
                        </span>
                      ))}
                    </div>

                    <div className="course-info">
                      <div className="course-duration">⏱ {course.duration}</div>
                      <div className="course-lessons">
                        📚 {course.lessons} lecciones
                      </div>
                      {course.certificate && (
                        <div className="course-certificate">🏆 Certificado</div>
                      )}
                    </div>

                    <div className="course-footer">
                      <div className="course-pricing">
                        <span className="current-price">${course.price}</span>
                        {course.originalPrice > course.price && (
                          <span className="original-price">
                            ${course.originalPrice}
                          </span>
                        )}
                      </div>

                      <button className="btn btn-primary course-btn">
                        Ver Detalles
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
};

export default Servicios;