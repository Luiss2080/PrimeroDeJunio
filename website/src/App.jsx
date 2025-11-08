import React, { useState, useEffect } from "react";
import Header from "./layouts/header";
import Footer from "./layouts/footer";
import Home from "./pages/Home";
import Servicios from "./pages/Servicios";
import Conductores from "./pages/Conductores";
import Asociacion from "./pages/Asociacion";
import Nosotros from "./pages/Nosotros";
import Contacto from "./pages/Contacto";

function App() {
  console.log("🎯 PRIMERO DE JUNIO: App.jsx renderizando aplicación...");

  const [currentView, setCurrentView] = useState("inicio");
  const [isTransitioning, setIsTransitioning] = useState(false);

  // Función para cambiar de vista con animación
  const changeView = (newView) => {
    if (newView === currentView) return;

    setIsTransitioning(true);

    setTimeout(() => {
      setCurrentView(newView);
      setIsTransitioning(false);
      // Scroll suave al top
      window.scrollTo({ top: 0, behavior: "smooth" });
    }, 300);
  };

  // Renderizar el componente de la vista actual
  const renderCurrentView = () => {
    switch (currentView) {
      case "inicio":
        return <Home />;
      case "servicios":
        return <Servicios />;
      case "conductores":
        return <Conductores />;
      case "asociacion":
        return <Asociacion />;
      case "nosotros":
        return <Nosotros />;
      case "contacto":
        return <Contacto />;
      default:
        return <Home />;
    }
  };

  // Escuchar cambios en la URL hash
  useEffect(() => {
    const handleHashChange = () => {
      const hash = window.location.hash.substring(1);
      if (hash && hash !== currentView) {
        changeView(hash);
      }
    };

    window.addEventListener("hashchange", handleHashChange);

    // Verificar hash inicial
    const initialHash = window.location.hash.substring(1);
    if (initialHash) {
      setCurrentView(initialHash);
    }

    return () => {
      window.removeEventListener("hashchange", handleHashChange);
    };
  }, [currentView]);

  return (
    <div className="app-container">
      <Header currentView={currentView} changeView={changeView} />
      <main
        className={`main-content ${isTransitioning ? "transitioning" : ""}`}
      >
        <div className="view-container">{renderCurrentView()}</div>
      </main>
      <Footer />
    </div>
  );
}

export default App;
