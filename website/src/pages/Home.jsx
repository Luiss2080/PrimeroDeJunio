import React, { useState, useEffect, useRef, useCallback } from "react";

const Home = () => {
  console.log("🏠 PRIMERO DE JUNIO: Home component renderizando...");

  // Inicializar el controlador de JavaScript cuando se monte el componente
  useEffect(() => {
    console.log("🔧 Inicializando HomePageController...");

    // Función para cargar el CSS de Home
    const loadHomeCSS = () => {
      return new Promise((resolve, reject) => {
        // Verificar si el CSS ya está cargado
        const existingLink = document.querySelector(
          'link[href="/css/home.css"]'
        );
        if (existingLink) {
          resolve();
          return;
        }

        // Crear y cargar el CSS
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = "/css/home.css";
        link.addEventListener("load", () => {
          console.log("✅ CSS home.css cargado correctamente");
          resolve();
        });
        link.addEventListener("error", (err) => {
          console.error("❌ Error cargando home.css:", err);
          reject(err);
        });
        document.head.appendChild(link);
      });
    };
    // Función para cargar el script de JavaScript de Home
    const loadHomeScript = () => {
      return new Promise((resolve, reject) => {
        // Verificar si el script ya está cargado
        const existingScript = document.querySelector(
          'script[src="/javaScript/home.js"]'
        );
        if (existingScript) {
          if (window.HomePageController) {
            resolve();
          } else {
            existingScript.addEventListener("load", resolve);
            existingScript.addEventListener("error", reject);
          }
          return;
        }

        // Crear y cargar el script
        const script = document.createElement("script");
        script.src = "/javaScript/home.js";
        script.async = true;
        script.addEventListener("load", () => {
          console.log("✅ Script home.js cargado correctamente");
          resolve();
        });
        script.addEventListener("error", (err) => {
          console.error("❌ Error cargando home.js:", err);
          reject(err);
        });
        document.head.appendChild(script);
      });
    };

    // Función para inicializar el controlador
    const initController = () => {
      if (window.HomePageController) {
        // Destruir instancia anterior si existe
        if (window.homePageController) {
          window.homePageController.destroy();
        }
        // Crear nueva instancia
        window.homePageController = new window.HomePageController();
        console.log("✅ HomePageController inicializado correctamente");
      } else {
        console.warn("⚠️ HomePageController no está disponible");
      }
    };

    // Cargar primero el CSS, luego el JavaScript y finalmente inicializar
    loadHomeCSS()
      .then(() => {
        console.log("✅ CSS cargado, procediendo a cargar JavaScript...");
        return loadHomeScript();
      })
      .then(() => {
        console.log("✅ JavaScript cargado, inicializando controlador...");
        // Esperar un poco para que se inicialice completamente
        setTimeout(initController, 100);
      })
      .catch((error) => {
        console.error("❌ Error cargando recursos de Home:", error);
      });

    return () => {
      // Cleanup: destruir el controlador cuando se desmonte el componente
      if (window.homePageController) {
        window.homePageController.destroy();
        window.homePageController = null;
        console.log("🧹 HomePageController destruido");
      }
    };
  }, []);

  // Estados para animaciones y carruseles
  const [currentText, setCurrentText] = useState("");
  const [textIndex, setTextIndex] = useState(0);

  const texts = [
    "Conductor Profesional",
    "Especialista en Rutas",
    "Servicio Confiable",
    "Transporte Seguro",
  ];

  // Efectos para carruseles y animaciones
  useEffect(() => {
    const interval = setInterval(() => {
      setTextIndex((prevIndex) => (prevIndex + 1) % texts.length);
    }, 3000);
    return () => clearInterval(interval);
  }, []);

  useEffect(() => {
    setCurrentText(texts[textIndex]);
  }, [textIndex]);

  // Notificar que la página Home está activa para inicializar controladores
  useEffect(() => {
    console.log("🏠 Home component montado, notificando cambio de página");
    const event = new CustomEvent("pageChanged", {
      detail: { page: "inicio" },
    });
    window.dispatchEvent(event);
  }, []);

  return (
    <div className="home-container">
      {/* HERO SECTION */}
      <section id="inicio" className="hero-section">
        {/* Background overlays */}
        <div className="hero-background-overlay"></div>
        <div className="hero-particles"></div>

        <div className="hero-grid">
          {/* Contenido principal */}
          <div className="hero-content">
            {/* Badge premium */}
            <div className="hero-badge">
              <span>🏆</span>
              <span>Academia #1 de Desarrollo en Latinoamérica</span>
              <span className="hero-badge-certified">CERTIFICADA</span>
            </div>

            {/* Título principal */}
            <h1 className="hero-title">
              <span className="hero-title-main">Transforma tu</span>
              <br />
              <span className="hero-title-animated">{currentText}</span>
            </h1>

            {/* Subtítulo */}
            <p className="hero-subtitle">
              Únete a la élite de conductors profesionales con nuestra
              metodología
              <span className="hero-subtitle-highlight">
                {" "}
                probada científicamente
              </span>{" "}
              que ha generado
              <strong className="hero-subtitle-highlight">
                {" "}
                +$50M en ganancias{" "}
              </strong>
              para nuestros estudiantes.
            </p>

            {/* Features destacadas */}
            <div className="hero-features">
              {[
                {
                  icon: "🎯",
                  text: "95% Tasa de Éxito",
                  subtext: "Comprobada",
                },
                {
                  icon: "⚡",
                  text: "Resultados en 30 días",
                  subtext: "Garantizado",
                },
                {
                  icon: "🏅",
                  text: "Mentores Certificados",
                  subtext: "Ex-Goldman Sachs",
                },
              ].map((item, index) => (
                <div key={index} className="hero-feature-item">
                  <span className="hero-feature-icon">{item.icon}</span>
                  <div>
                    <div className="hero-feature-text">{item.text}</div>
                    <div className="hero-feature-subtext">{item.subtext}</div>
                  </div>
                </div>
              ))}
            </div>

            {/* Stats */}
            <div className="hero-stats">
              {[
                { value: "10K+", label: "Estudiantes Activos" },
                { value: "95%", label: "Tasa de Éxito" },
                { value: "24/7", label: "Soporte Premium" },
              ].map((stat, index) => (
                <div key={index} className="hero-stat-item">
                  <div className="hero-stat-value">{stat.value}</div>
                  <div className="hero-stat-label">{stat.label}</div>
                </div>
              ))}
            </div>

            {/* Botones CTA */}
            <div className="hero-buttons">
              <button className="hero-btn-primary hover-card">
                <span>🚀 ACCESO INMEDIATO</span>
              </button>
              <button className="hero-btn-secondary hover-card">
                📹 DEMO EN VIVO
              </button>
            </div>

            {/* Trust indicators */}
            <div className="hero-trust-indicators">
              <div className="hero-trust-item">
                <span>⭐⭐⭐⭐⭐</span>
                <span>4.9/5 (2,847 reseñas)</span>
              </div>
              <div className="hero-trust-item">
                <span>🔒</span>
                <span>SSL Seguro</span>
              </div>
              <div className="hero-trust-item">
                <span>✓</span>
                <span>Garantía 30 días</span>
              </div>
            </div>
          </div>

          {/* Imagen Hero */}
          <div className="hero-image-container">
            <div className="hero-main-image">
              {/* Stats overlay */}
              <div className="hero-stats-overlay">
                <div className="hero-stats-value">+$24,750</div>
                <div className="hero-stats-label">Profit Today</div>
              </div>

              {/* Live indicator */}
              <div className="hero-live-indicator">
                <div className="hero-live-dot"></div>
                <span className="hero-live-text">Live Desarrollo Session</span>
              </div>

              {/* Play button */}
              <div className="hero-play-button">▶️</div>
            </div>
          </div>
        </div>
      </section>

      {/* WHY CHOOSE SECTION */}
      <section className="why-choose-section">
        {/* Background elements */}
        <div className="why-choose-background"></div>

        <div className="why-choose-container">
          {/* Header */}
          <div className="why-choose-header">
            <div className="why-choose-badge">
              <span>⚡</span>
              <span>Ventajas Competitivas</span>
            </div>

            <h2 className="why-choose-title">
              <span className="why-choose-title-main">¿Por qué elegir</span>
              <br />
              <span className="why-choose-title-highlight">
                PRIMERO DE JUNIO?
              </span>
            </h2>

            <p className="why-choose-description">
              La diferencia entre un buen servicio de transporte y el mejor está
              en la
              <strong className="hero-subtitle-highlight">
                {" "}
                experiencia, seguridad y compromiso
              </strong>
              . Descubre por qué somos la asociación #1 en Santa Cruz.
            </p>
          </div>

          {/* Features Grid */}
          <div className="features-grid">
            {[
              {
                id: 1,
                icon: "🏍️",
                title: "Servicio de Transporte Seguro",
                subtitle: "Conductores Certificados",
                description:
                  "Todos nuestros conductores están certificados y tienen amplia experiencia en las rutas de Santa Cruz. Garantizamos un servicio confiable y seguro.",
                stats: { value: "100+", label: "Conductores" },
                badge: "CERTIFICADO",
                color: "#00ff88",
              },
              {
                id: 2,
                icon: "🛡️",
                title: "Seguridad Garantizada",
                subtitle: "95% Satisfacción del Cliente",
                description:
                  "Nuestro compromiso con la seguridad es inquebrantable. Mantenemos los más altos estándares de seguridad en cada viaje que realizamos.",
                stats: { value: "95%", label: "Satisfacción" },
                badge: "SEGURO",
                color: "#00ff88",
              },
              {
                id: 3,
                icon: "🏅",
                title: "Reconocimiento Municipal",
                subtitle: "Asociación Oficial",
                description:
                  "Estamos oficialmente reconocidos por las autoridades municipales de Santa Cruz como una asociación legalmente constituida.",
                stats: { value: "Legal", label: "Reconocimiento" },
                badge: "OFICIAL",
                color: "#00ff88",
              },
              {
                id: 4,
                icon: "🌟",
                title: "Comunidad Unida",
                subtitle: "Red de Apoyo",
                description:
                  "Somos más que una asociación, somos una familia. Brindamos apoyo mutuo y trabajamos juntos por el bienestar de todos nuestros miembros.",
                stats: { value: "Unidos", label: "Como Familia" },
                badge: "COMUNIDAD",
                color: "#9d4edd",
              },
              {
                id: 5,
                icon: "⚡",
                title: "Servicio Rápido y Eficiente",
                subtitle: "Rutas Optimizadas",
                description:
                  "Conocemos Santa Cruz como la palma de nuestras manos. Utilizamos las rutas más eficientes para llevarte a tu destino rápidamente.",
                stats: { value: "24/7", label: "Disponible" },
                badge: "RÁPIDO",
                color: "#00bfff",
              },
              {
                id: 6,
                icon: "�",
                title: "Compromiso Social",
                subtitle: "Responsabilidad Comunitaria",
                description:
                  "Estamos comprometidos con el desarrollo de nuestra comunidad. Participamos activamente en programas sociales y de ayuda mutua.",
                stats: { value: "Social", label: "Compromiso" },
                badge: "SOCIAL",
                color: "#00ff88",
              },
            ].map((feature, index) => (
              <div
                key={feature.id}
                className="feature-card hover-card card-visible"
                id={`feature-${index}`}
              >
                {/* Feature image */}
                <div className="feature-card-image">
                  {/* Badge */}
                  <div
                    className={`feature-badge ${
                      feature.color === "#9d4edd"
                        ? "premium"
                        : feature.color === "#00bfff"
                        ? "innovation"
                        : ""
                    }`}
                  >
                    {feature.badge}
                  </div>

                  {/* Stats overlay */}
                  <div className="feature-stats-overlay">
                    <div className="feature-stats-value">
                      {feature.stats.value}
                    </div>
                    <div className="feature-stats-label">
                      {feature.stats.label}
                    </div>
                  </div>
                </div>

                {/* Feature content */}
                <div className="feature-content">
                  {/* Header */}
                  <div className="feature-header">
                    {feature.icon && (
                      <div className="feature-icon">{feature.icon}</div>
                    )}
                    <div>
                      <h3 className="feature-title">{feature.title}</h3>
                      <p className="feature-subtitle">{feature.subtitle}</p>
                    </div>
                  </div>

                  {/* Description */}
                  <p className="feature-description">{feature.description}</p>

                  {/* Button */}
                  <button className="feature-button">Saber Más →</button>
                </div>

                {/* Shine effect */}
                <div className="shine-effect"></div>
              </div>
            ))}
          </div>

          {/* CTA Final */}
          <div className="cta-final">
            <h3 className="cta-title">¿Listo para unirte a nuestra familia?</h3>
            <p className="cta-description">
              Más de 100 conductores ya forman parte de nuestra asociación. Tu
              turno de ser parte de la familia PRIMERO DE JUNIO.
            </p>
            <button className="cta-button hover-card">
              🏍️ ÚNETE A LA ASOCIACIÓN
            </button>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Home;
