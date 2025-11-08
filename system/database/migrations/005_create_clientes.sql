-- Migracion: 005_create_clientes.sql
-- Tabla de clientes del servicio de mototaxi

CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100),
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(150),
    direccion_habitual TEXT,
    tipo_cliente ENUM('particular', 'corporativo', 'frecuente') DEFAULT 'particular',
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    observaciones TEXT,
    descuento_porcentaje DECIMAL(5,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_telefono (telefono),
    INDEX idx_email (email),
    INDEX idx_tipo_cliente (tipo_cliente),
    INDEX idx_estado (estado)
);