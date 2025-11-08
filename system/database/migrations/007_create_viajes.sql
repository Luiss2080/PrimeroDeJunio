-- Migracion: 007_create_viajes.sql
-- Tabla de viajes realizados

CREATE TABLE viajes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    conductor_id INT NOT NULL,
    vehiculo_id INT NOT NULL,
    cliente_id INT,
    cliente_nombre VARCHAR(100), -- Para clientes no registrados
    cliente_telefono VARCHAR(20),
    origen TEXT NOT NULL,
    destino TEXT NOT NULL,
    distancia_km DECIMAL(8,2),
    duracion_minutos INT,
    tarifa_aplicada_id INT,
    valor_base DECIMAL(10,2) NOT NULL,
    recargos DECIMAL(10,2) DEFAULT 0.00,
    descuentos DECIMAL(10,2) DEFAULT 0.00,
    valor_total DECIMAL(10,2) NOT NULL,
    metodo_pago ENUM('efectivo', 'tarjeta', 'transferencia', 'credito') DEFAULT 'efectivo',
    estado ENUM('pendiente', 'en_curso', 'completado', 'cancelado') DEFAULT 'pendiente',
    fecha_hora_inicio TIMESTAMP NOT NULL,
    fecha_hora_fin TIMESTAMP NULL,
    observaciones TEXT,
    calificacion TINYINT CHECK (calificacion >= 1 AND calificacion <= 5),
    comentario_cliente TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (conductor_id) REFERENCES conductores(id) ON DELETE RESTRICT,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id) ON DELETE RESTRICT,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL,
    FOREIGN KEY (tarifa_aplicada_id) REFERENCES tarifas(id) ON DELETE SET NULL,
    INDEX idx_conductor (conductor_id),
    INDEX idx_vehiculo (vehiculo_id),
    INDEX idx_cliente (cliente_id),
    INDEX idx_fecha_inicio (fecha_hora_inicio),
    INDEX idx_estado (estado),
    INDEX idx_fecha_valor (fecha_hora_inicio, valor_total)
);