-- Migracion: 003_create_conductores.sql
-- Tabla de conductores registrados en la asociacion

CREATE TABLE conductores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NULL, -- Referencia opcional a usuarios
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    cedula VARCHAR(20) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL,
    direccion TEXT,
    fecha_nacimiento DATE NOT NULL,
    licencia_numero VARCHAR(50) NOT NULL UNIQUE,
    licencia_categoria VARCHAR(10) NOT NULL,
    licencia_vigencia DATE NOT NULL,
    experiencia_anos INT DEFAULT 0,
    foto VARCHAR(255),
    estado ENUM('activo', 'inactivo', 'suspendido') DEFAULT 'activo',
    fecha_ingreso DATE DEFAULT (CURRENT_DATE),
    observaciones TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    INDEX idx_cedula (cedula),
    INDEX idx_licencia (licencia_numero),
    INDEX idx_estado (estado),
    INDEX idx_usuario (usuario_id)
);