-- Migracion: 004_create_vehiculos.sql
-- Tabla de vehiculos (motos) registrados en la asociacion

CREATE TABLE vehiculos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    placa VARCHAR(10) NOT NULL UNIQUE,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    color VARCHAR(30) NOT NULL,
    ano INT NOT NULL,
    cilindraje INT NOT NULL,
    numero_motor VARCHAR(50) UNIQUE,
    numero_chasis VARCHAR(50) UNIQUE,
    propietario_nombre VARCHAR(100) NOT NULL,
    propietario_cedula VARCHAR(20) NOT NULL,
    propietario_telefono VARCHAR(20),
    seguro_numero VARCHAR(50),
    seguro_vigencia DATE,
    soat_numero VARCHAR(50),
    soat_vigencia DATE,
    tecnicomecanica_numero VARCHAR(50),
    tecnicomecanica_vigencia DATE,
    tarjeta_propiedad VARCHAR(50),
    estado ENUM('activo', 'mantenimiento', 'inactivo', 'vendido') DEFAULT 'activo',
    observaciones TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_placa (placa),
    INDEX idx_propietario_cedula (propietario_cedula),
    INDEX idx_estado (estado),
    INDEX idx_marca_modelo (marca, modelo)
);