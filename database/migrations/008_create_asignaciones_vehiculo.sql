-- Migracion: 008_create_asignaciones_vehiculo.sql
-- Tabla de asignaciones de vehiculos a conductores

CREATE TABLE asignaciones_vehiculo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    conductor_id INT NOT NULL,
    vehiculo_id INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NULL,
    turno ENUM('manana', 'tarde', 'noche', 'completo') DEFAULT 'completo',
    hora_inicio TIME,
    hora_fin TIME,
    dias_semana VARCHAR(20) DEFAULT 'L,M,X,J,V,S,D', -- L=Lunes, M=Martes, etc.
    estado ENUM('activa', 'terminada', 'suspendida') DEFAULT 'activa',
    observaciones TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (conductor_id) REFERENCES conductores(id) ON DELETE CASCADE,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id) ON DELETE CASCADE,
    INDEX idx_conductor (conductor_id),
    INDEX idx_vehiculo (vehiculo_id),
    INDEX idx_fecha_inicio (fecha_inicio),
    INDEX idx_estado (estado),
    UNIQUE KEY uk_conductor_vehiculo_activa (conductor_id, vehiculo_id, estado)
);