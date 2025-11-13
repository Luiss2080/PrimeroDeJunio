import React, { useState, useEffect, useRef } from "react";
import "./Home.css";

const Home = () => {
  console.log("🏠 PRIMERO DE JUNIO: Home component renderizando...");

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

  // Función para registrar elementos observables (simplificada)
  const observeElement = (element) => {
    // Función vacía para mantener compatibilidad
  };

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
              La diferencia entre el éxito y el fracaso en el Desarrollo está en
              la
              <strong className="hero-subtitle-highlight">
                {" "}
                metodología, el mentorship y la comunidad
              </strong>
              . Descubre por qué somos la opción #1 en Latinoamérica.
            </p>
          </div>

          {/* Features Grid */}
          <div className="features-grid">
            {[
              {
                id: 1,
                icon: "🚀",
                title: "Desarrollo Profesional de Élite",
                subtitle: "Metodología Institucional",
                description:
                  "Estrategias exclusivas utilizadas por hedge funds y bancos de inversión. Aprende de conductors que han gestionado más de $500M.",
                stats: { value: "500M+", label: "Gestionados" },
                badge: "EXCLUSIVO",
                color: "#00ff88",
              },
              {
                id: 2,
                title: "Resultados Garantizados",
                subtitle: "96.8% Tasa de Éxito",
                description:
                  "Nuestra metodología probada garantiza resultados. Si no ves mejoras en 30 días, te devolvemos el 100% de tu inversión.",
                stats: { value: "96.8%", label: "Éxito Comprobado" },
                badge: "GARANTÍA",
                color: "#00ff88",
              },
              {
                id: 3,
                icon: "🏅",
                title: "Certificación Internacional",
                subtitle: "Reconocimiento Global",
                description:
                  "Certificados avalados por la Financial Desarrollo Association y reconocidos por las principales instituciones financieras.",
                stats: { value: "ISO 9001", label: "Certificación" },
                badge: "OFICIAL",
                color: "#00ff88",
              },
              {
                id: 4,
                icon: "👑",
                title: "Comunidad VIP Exclusiva",
                subtitle: "Network de Élite",
                description:
                  "Acceso directo a nuestra comunidad privada de 15,000+ conductors profesionales. Networking, señales premium y mentoría 24/7.",
                stats: { value: "15K+", label: "Miembros VIP" },
                badge: "PREMIUM",
                color: "#9d4edd",
              },
              {
                id: 5,
                icon: "🤖",
                title: "Tecnología de Vanguardia",
                subtitle: "AI & Machine Learning",
                description:
                  "Plataforma potenciada por inteligencia artificial que analiza mercados en tiempo real y genera señales con 89% de precisión.",
                stats: { value: "89%", label: "Precisión IA" },
                badge: "INNOVACIÓN",
                color: "#00bfff",
              },
              {
                id: 6,
                icon: "📊",
                title: "Soporte Institucional",
                subtitle: "Mentoría 24/7/365",
                description:
                  "Soporte premium con conductors certificados disponibles 24/7. Análisis personalizado de tu portfolio y estrategias individualizadas.",
                stats: { value: "24/7", label: "Soporte Live" },
                badge: "PREMIUM",
                color: "#00ff88",
              },
            ].map((feature, index) => (
              <div
                key={feature.id}
                className={`feature-card hover-card ${
                  visibleCards.has(`feature-${index}`)
                    ? "card-visible"
                    : "card-hidden"
                }`}
                ref={(el) => observeElement(el)}
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
            <h3 className="cta-title">¿Listo para unirte a la élite?</h3>
            <p className="cta-description">
              Más de 15,000 conductors ya han transformado su futuro financiero.
              Tu turno de ser el siguiente success story.
            </p>
            <button className="cta-button hover-card">
              🚀 COMENZAR TRANSFORMACIÓN
            </button>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Home;
