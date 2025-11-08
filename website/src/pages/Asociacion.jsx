import React, { useState, useEffect, useRef } from "react";

const Asociacion = () => {
  const [activeTab, setActiveTab] = useState("metodologia");
  const [visibleSections, setVisibleSections] = useState(new Set());
  const [currentTestimonial, setCurrentTestimonial] = useState(0);
  const observerRef = useRef();

  const tabs = [
    { id: "metodologia", name: "Metodología", icon: "🛵" },
    { id: "certificaciones", name: "Certificaciones", icon: "🏆" },
    { id: "profesores", name: "Instructores", icon: "👨‍🏫" },
    { id: "servicios", name: "Servicios", icon: "�" },
  ];

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
      courses: ["Conducción Defensiva", "Mecánica Básica"],
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
      courses: ["Atención al Cliente", "Comunicación Efectiva"],
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
      courses: ["Uso de Apps", "Navegación GPS"],
      rating: 4.7,
    },
  ];

  const testimonials = [
    {
      name: "María González",
      position: "Conductora Destacada 2024",
      image: "👩‍💼",
      text: "Gracias a PRIMERO DE JUNIO logré tener mi propio mototaxi y ahora mantengo a mi familia dignamente. La capacitación fue excelente.",
      profit: "+150%",
      country: "�� Lima, Perú",
      certification: "Master Conductor",
    },
    {
      name: "Roberto Silva",
      position: "Ex-Obrero de Construcción",
      image: "👨‍💻",
      text: "Cambié la construcción por el mototaxi. Ahora tengo horarios flexibles y gano más que antes. La asociación me apoyó en todo.",
      profit: "+200%",
      country: "�� Trujillo, Perú",
      certification: "Conductor Profesional",
    },
    {
      name: "Carmen López",
      position: "Madre de Familia",
      image: "👩‍🚀",
      text: "Como madre soltera, el mototaxi me permitió trabajar y cuidar a mis hijos. La flexibilidad horaria es increíble.",
      profit: "+180%",
      country: "🇵🇪 Arequipa, Perú",
      certification: "Master Conductor",
    },
  ];

  const methodology = [
    {
      phase: "Fase 1",
      title: "Fundamentos de Conducción",
      duration: "2-3 semanas",
      icon: "🏗️",
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
      duration: "3-4 semanas",
      icon: "⚡",
      description: "Desarrollo de habilidades de atención y comunicación",
      topics: [
        "Técnicas de comunicación efectiva",
        "Manejo de conflictos",
        "Uso de aplicaciones móviles",
        "Gestión de rutas y tarifas",
      ],
    },
    {
      phase: "Fase 3",
      title: "Práctica Supervisada",
      duration: "4+ semanas",
      icon: "🚀",
      description: "Aplicación práctica con supervisión profesional",
      topics: [
        "Rutas prácticas supervisadas",
        "Evaluación de desempeño",
        "Mentoría personalizada",
        "Preparación para certificación",
      ],
    },
  ];

  // Intersection Observer
  useEffect(() => {
    observerRef.current = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const sectionId = entry.target.dataset.sectionId;
            setVisibleSections((prev) => new Set([...prev, sectionId]));
          }
        });
      },
      { threshold: 0.1, rootMargin: "50px" }
    );

    const sections = document.querySelectorAll("[data-section-id]");
    sections.forEach((section) => {
      observerRef.current.observe(section);
    });

    return () => {
      if (observerRef.current) {
        observerRef.current.disconnect();
      }
    };
  }, []);

  // Auto-rotate testimonials
  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentTestimonial((prev) => (prev + 1) % testimonials.length);
    }, 5000);

    return () => clearInterval(interval);
  }, [testimonials.length]);

  const renderTabContent = () => {
    switch (activeTab) {
      case "metodologia":
        return (
          <div className="methodology-content">
            <div className="methodology-intro">
              <h3>Metodología Probada y Efectiva</h3>
              <p>
                Nuestra metodología ha sido desarrollada y perfeccionada durante
                más de 15 años, combinando técnicas de capacitación profesional
                con experiencia práctica para crear conductores exitosos,
                seguros y confiables.
              </p>
            </div>
            <div className="methodology-phases">
              {methodology.map((phase, index) => (
                <div
                  key={phase.phase}
                  className={`methodology-phase ${
                    visibleSections.has(`phase-${index}`) ? "visible" : ""
                  }`}
                  data-section-id={`phase-${index}`}
                >
                  <div className="phase-icon">{phase.icon}</div>
                  <div className="phase-content">
                    <div className="phase-header">
                      <span className="phase-number">{phase.phase}</span>
                      <h4>{phase.title}</h4>
                      <span className="phase-duration">{phase.duration}</span>
                    </div>
                    <p className="phase-description">{phase.description}</p>
                    <ul className="phase-topics">
                      {phase.topics.map((topic, idx) => (
                        <li key={idx}>✓ {topic}</li>
                      ))}
                    </ul>
                  </div>
                </div>
              ))}
            </div>
          </div>
        );

      case "certificaciones":
        return (
          <div className="certifications-content">
            <div className="certifications-intro">
              <h3>Certificaciones Reconocidas</h3>
              <p>
                Nuestras certificaciones son reconocidas por las principales
                empresas de transporte y entidades reguladoras a nivel nacional.
              </p>
            </div>
            <div className="certifications-grid">
              {certifications.map((cert, index) => (
                <div
                  key={cert.id}
                  className={`certification-card ${
                    visibleSections.has(`cert-${index}`) ? "visible" : ""
                  }`}
                  data-section-id={`cert-${index}`}
                >
                  <div className="cert-header">
                    <div className="cert-icon">{cert.icon}</div>
                    <div className="cert-info">
                      <h4>{cert.name}</h4>
                      <span className="cert-level">{cert.level}</span>
                      <span className="cert-duration">⏱ {cert.duration}</span>
                    </div>
                  </div>

                  <div className="cert-requirements">
                    <h5>Requisitos:</h5>
                    <ul>
                      {cert.requirements.map((req, idx) => (
                        <li key={idx}>• {req}</li>
                      ))}
                    </ul>
                  </div>

                  <div className="cert-benefits">
                    <h5>Beneficios:</h5>
                    <ul>
                      {cert.benefits.map((benefit, idx) => (
                        <li key={idx}>✓ {benefit}</li>
                      ))}
                    </ul>
                  </div>

                  <button className="btn btn-primary cert-btn">
                    Comenzar Certificación
                  </button>
                </div>
              ))}
            </div>
          </div>
        );

      case "profesores":
        return (
          <div className="professors-content">
            <div className="professors-intro">
              <h3>Aprende de los Mejores Instructores</h3>
              <p>
                Nuestro equipo de instructores está compuesto por profesionales
                especializados en transporte, seguridad vial y atención al
                cliente.
              </p>
            </div>
            <div className="professors-grid">
              {professors.map((professor, index) => (
                <div
                  key={professor.id}
                  className={`professor-card ${
                    visibleSections.has(`prof-${index}`) ? "visible" : ""
                  }`}
                  data-section-id={`prof-${index}`}
                >
                  <div className="professor-header">
                    <div className="professor-image">{professor.image}</div>
                    <div className="professor-info">
                      <h4>{professor.name}</h4>
                      <p className="professor-position">{professor.position}</p>
                      <div className="professor-meta">
                        <span className="experience">
                          📅 {professor.experience}
                        </span>
                        <div className="rating">
                          <span className="stars">⭐</span>
                          <span>{professor.rating}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="professor-specialization">
                    <strong>Especialización:</strong> {professor.specialization}
                  </div>

                  <div className="professor-achievements">
                    <h5>Logros Destacados:</h5>
                    <ul>
                      {professor.achievements.map((achievement, idx) => (
                        <li key={idx}>🏆 {achievement}</li>
                      ))}
                    </ul>
                  </div>

                  <div className="professor-courses">
                    <h5>Cursos que imparte:</h5>
                    <div className="courses-tags">
                      {professor.courses.map((course, idx) => (
                        <span key={idx} className="course-tag">
                          {course}
                        </span>
                      ))}
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        );

      case "servicios":
        return (
          <div className="services-content">
            <div className="services-intro">
              <h3>Servicios Integrales para Conductores</h3>
              <p>
                Ofrecemos un ecosistema completo de servicios diseñado para
                garantizar el éxito y bienestar de nuestros conductores
                asociados.
              </p>
            </div>

            <div className="tech-features">
              <div className="tech-feature" data-section-id="service-1">
                <div className="tech-icon">🛵</div>
                <h4>Financiamiento de Vehículos</h4>
                <p>
                  Programas de financiamiento flexibles para adquirir tu
                  mototaxi con tasas preferenciales y planes de pago adaptados a
                  tus ingresos.
                </p>
              </div>

              <div className="tech-feature" data-section-id="service-2">
                <div className="tech-icon">�️</div>
                <h4>Seguro Integral</h4>
                <p>
                  Cobertura completa contra accidentes, robo y responsabilidad
                  civil. Protección para ti, tu vehículo y tus pasajeros.
                </p>
              </div>

              <div className="tech-feature" data-section-id="service-3">
                <div className="tech-icon">�</div>
                <h4>Mantenimiento Técnico</h4>
                <p>
                  Red de talleres especializados con descuentos exclusivos.
                  Mantenimiento preventivo y correctivo garantizado.
                </p>
              </div>

              <div className="tech-feature" data-section-id="service-4">
                <div className="tech-icon">�</div>
                <h4>App Móvil Exclusiva</h4>
                <p>
                  Aplicación dedicada para gestionar rutas, pagos, soporte
                  técnico y comunicación directa con la asociación.
                </p>
              </div>
            </div>
          </div>
        );

      default:
        return null;
    }
  };

  return (
    <div className="asociacion-page">
      {/* Hero Section */}
      <section className="asociacion-hero">
        <div className="container">
          <div className="hero-content">
            <div className="hero-badge">
              <span className="badge-icon">🛵</span>
              <span>Asociación #1 de Mototaxis en Perú</span>
            </div>
            <h1 className="hero-title">
              La Asociación Más
              <span className="gradient-text"> Confiable</span> de Mototaxis
            </h1>
            <p className="hero-description">
              Metodología probada de capacitación, instructores especializados y
              servicios integrales para formar conductores exitosos y
              responsables.
            </p>
            <div className="hero-metrics">
              <div className="metric">
                <div className="metric-number">2,500+</div>
                <div className="metric-label">Conductores Activos</div>
              </div>
              <div className="metric">
                <div className="metric-number">98.5%</div>
                <div className="metric-label">Satisfacción Cliente</div>
              </div>
              <div className="metric">
                <div className="metric-number">15</div>
                <div className="metric-label">Años de Experiencia</div>
              </div>
            </div>
          </div>

          <div className="hero-visual">
            <div className="academy-stats">
              <div className="stat-card">
                <div className="stat-icon">🏆</div>
                <div className="stat-info">
                  <div className="stat-number">2,500</div>
                  <div className="stat-label">Conductores Certificados</div>
                </div>
              </div>
              <div className="stat-card">
                <div className="stat-icon">🛵</div>
                <div className="stat-info">
                  <div className="stat-number">850</div>
                  <div className="stat-label">Vehículos Financiados</div>
                </div>
              </div>
              <div className="stat-card">
                <div className="stat-icon">💼</div>
                <div className="stat-info">
                  <div className="stat-number">95%</div>
                  <div className="stat-label">Empleabilidad</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Tabs Navigation */}
      <section className="asociacion-tabs">
        <div className="container">
          <div className="tabs-nav">
            {tabs.map((tab) => (
              <button
                key={tab.id}
                className={`tab-btn ${activeTab === tab.id ? "active" : ""}`}
                onClick={() => setActiveTab(tab.id)}
              >
                <span className="tab-icon">{tab.icon}</span>
                <span className="tab-name">{tab.name}</span>
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* Tab Content */}
      <section className="asociacion-content">
        <div className="container">
          <div className="tab-content">{renderTabContent()}</div>
        </div>
      </section>

      {/* Testimonials Section */}
      <section className="testimonials-section">
        <div className="container">
          <div className="section-header">
            <h2>Lo que Dicen Nuestros Graduados</h2>
            <p>Historias reales de transformación profesional</p>
          </div>

          <div className="testimonials-carousel">
            <div className="testimonial-card">
              <div className="testimonial-content">
                <div className="testimonial-text">
                  "{testimonials[currentTestimonial].text}"
                </div>
                <div className="testimonial-author">
                  <div className="author-image">
                    {testimonials[currentTestimonial].image}
                  </div>
                  <div className="author-info">
                    <div className="author-name">
                      {testimonials[currentTestimonial].name}
                    </div>
                    <div className="author-position">
                      {testimonials[currentTestimonial].position}
                    </div>
                    <div className="author-meta">
                      <span className="profit">
                        {testimonials[currentTestimonial].profit} ROI
                      </span>
                      <span className="country">
                        {testimonials[currentTestimonial].country}
                      </span>
                      <span className="certification">
                        🏆 {testimonials[currentTestimonial].certification}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
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

      {/* CTA Section */}
      <section className="asociacion-cta">
        <div className="container">
          <div className="cta-content">
            <div className="cta-text">
              <h2>¿Listo para Unirte a Nuestra Asociación?</h2>
              <p>
                Únete a los miles de conductores que ya han transformado sus
                vidas con nuestra capacitación integral y servicios de apoyo.
              </p>
            </div>
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
