-- Migracion: 006_create_tarifas.sql
-- Tabla de tarifas del servicio de mototaxi

CREATE TABLE tarifas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    tarifa_base DECIMAL(10,2) NOT NULL,
    tarifa_por_km DECIMAL(10,2) NOT NULL,
    tarifa_por_minuto DECIMAL(10,2) DEFAULT 0.00,
    tarifa_minima DECIMAL(10,2) NOT NULL,
    tarifa_maxima DECIMAL(10,2),
    recargo_nocturno DECIMAL(5,2) DEFAULT 0.00, -- Porcentaje
    recargo_festivo DECIMAL(5,2) DEFAULT 0.00, -- Porcentaje
    recargo_lluvia DECIMAL(5,2) DEFAULT 0.00, -- Porcentaje
    hora_inicio_nocturno TIME DEFAULT '18:00:00',
    hora_fin_nocturno TIME DEFAULT '06:00:00',
    estado ENUM('activa', 'inactiva') DEFAULT 'activa',
    fecha_vigencia_inicio DATE DEFAULT (CURRENT_DATE),
    fecha_vigencia_fin DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_estado (estado),
    INDEX idx_vigencia (fecha_vigencia_inicio, fecha_vigencia_fin)
);