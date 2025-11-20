-- Migracion: 009_create_mantenimientos.sql
-- Tabla de mantenimientos de vehiculos

CREATE TABLE mantenimientos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehiculo_id INT NOT NULL,
    tipo_mantenimiento ENUM('preventivo', 'correctivo', 'revision', 'emergencia') NOT NULL,
    descripcion TEXT NOT NULL,
    kilometraje_actual INT,
    costo DECIMAL(10,2) DEFAULT 0.00,
    taller_nombre VARCHAR(100),
    taller_telefono VARCHAR(20),
    fecha_programada DATE,
    fecha_realizada DATE,
    estado ENUM('programado', 'en_proceso', 'completado', 'cancelado') DEFAULT 'programado',
    observaciones TEXT,
    proximo_mantenimiento_km INT,
    proximo_mantenimiento_fecha DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id) ON DELETE CASCADE,
    INDEX idx_vehiculo (vehiculo_id),
    INDEX idx_fecha_programada (fecha_programada),
    INDEX idx_estado (estado),
    INDEX idx_tipo (tipo_mantenimiento)
);