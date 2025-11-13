import React, { useState, useEffect } from "react";

const Asociacion = () => {
  const [activeTab, setActiveTab] = useState("metodologia");
  const [currentTestimonial, setCurrentTestimonial] = useState(0);

  const tabs = [
    { id: "metodologia", name: "Metodología", icon: "🛵" },
    { id: "certificaciones", name: "Certificaciones", icon: "🏆" },
    { id: "profesores", name: "Instructores", icon: "👨‍🏫" },
    { id: "servicios", name: "Servicios", icon: "⚙️" },
  ];

  const testimonials = [
    {
      name: "María González",
      position: "Conductora Destacada 2024",
      image: "👩‍💼",
      text: "Gracias a PRIMERO DE JUNIO logré tener mi propio mototaxi.",
      profit: "+150%",
      country: "🇧🇴 Santa Cruz, Bolivia",
    },
    {
      name: "Roberto Silva",
      position: "Ex-Obrero de Construcción",
      image: "👨‍💻",
      text: "Cambié la construcción por el mototaxi. Ahora tengo horarios flexibles.",
      profit: "+200%",
      country: "🇧🇴 La Paz, Bolivia",
    },
    {
      name: "Carmen López",
      position: "Madre de Familia",
      image: "👩‍🚀",
      text: "Como madre soltera, el mototaxi me permitió trabajar y cuidar a mis hijos.",
      profit: "+180%",
      country: "🇧🇴 Cochabamba, Bolivia",
    },
  ];

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentTestimonial((prev) => (prev + 1) % testimonials.length);
    }, 5000);
    return () => clearInterval(interval);
  }, [testimonials.length]);

  useEffect(() => {
    const event = new CustomEvent("pageChanged", {
      detail: { page: "asociacion" },
    });
    window.dispatchEvent(event);
  }, []);

  return (
    <div className="asociacion-container">
      <section className="asociacion-hero">
        <div className="asociacion-particles"></div>
        <div className="container">
          <h1 className="asociacion-title">
            La Asociación Más <span>Confiable</span> de Mototaxis
          </h1>
          <p className="asociacion-subtitle">
            Metodología probada de capacitación, instructores especializados y
            servicios integrales para formar conductores exitosos.
          </p>
        </div>
      </section>

      <section className="asociacion-tabs">
        <div className="why-choose-background"></div>
        <div className="container">
          <div className="tabs-navigation">
            {tabs.map((tab) => (
              <button
                key={tab.id}
                className={`tab-button ${activeTab === tab.id ? "active" : ""}`}
                onClick={() => setActiveTab(tab.id)}
                data-tab={tab.id}
              >
                <span className="tab-icon">{tab.icon}</span>
                {tab.name}
              </button>
            ))}
          </div>
          <div className="tab-content">
            {/* El contenido será manejado por JavaScript externo */}
          </div>
        </div>
      </section>

      <section className="testimonials-section">
        <div className="testimonials-container">
          <div className="testimonials-header">
            <h2 className="testimonials-title">
              Historias de Éxito de Nuestros Conductores
            </h2>
            <p className="testimonials-subtitle">
              Experiencias reales de quienes transformaron sus vidas
            </p>
          </div>

          <div className="testimonials-carousel">
            <div
              className="testimonials-track"
              style={{ transform: `translateX(-${currentTestimonial * 100}%)` }}
            >
              {testimonials.map((testimonial, index) => (
                <div key={index} className="testimonial-card">
                  <div className="testimonial-image">{testimonial.image}</div>
                  <p className="testimonial-text">"{testimonial.text}"</p>
                  <div className="testimonial-author">
                    <h4 className="testimonial-name">{testimonial.name}</h4>
                    <p className="testimonial-position">
                      {testimonial.position}
                    </p>
                    <div className="testimonial-profit">
                      {testimonial.profit}
                    </div>
                    <p
                      style={{
                        color: "rgba(255, 255, 255, 0.7)",
                        marginTop: "0.5rem",
                      }}
                    >
                      {testimonial.country}
                    </p>
                  </div>
                </div>
              ))}
            </div>
            <div className="testimonials-dots">
              {testimonials.map((_, index) => (
                <button
                  key={index}
                  className={`dot ${
                    index === currentTestimonial ? "active" : ""
                  }`}
                  onClick={() => setCurrentTestimonial(index)}
                />
              ))}
            </div>
          </div>
        </div>
      </section>

      <section className="asociacion-cta">
        <div className="cta-particles"></div>
        <div className="container">
          <div className="cta-content">
            <h2>¿Listo para Unirte a Nuestra Asociación?</h2>
            <p>
              Únete a los miles de conductores que ya han transformado sus vidas
              con nuestra capacitación integral.
            </p>
            <div className="cta-actions">
              <button className="btn btn-primary cta-btn">
                Comenzar Ahora
              </button>
              <button className="btn btn-ghost cta-btn-secondary">
                Agendar Demo
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Asociacion;
