-- Migración: Crear tabla pagos_tarifa_diaria
-- Sistema PRIMERO DE JUNIO
-- Fecha: 2025-11-11

-- Tabla para registrar pagos de tarifa diaria de conductores
CREATE TABLE pagos_tarifa_diaria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    conductor_id INT NOT NULL,
    fecha_pago DATE NOT NULL,
    monto_tarifa DECIMAL(10,2) NOT NULL,
    metodo_pago ENUM('efectivo', 'transferencia', 'descuento_viajes') DEFAULT 'efectivo',
    registrado_por INT NOT NULL, -- ID del usuario que registra el pago (admin/operador)
    observaciones TEXT,
    estado ENUM('pendiente', 'pagado', 'exonerado') DEFAULT 'pendiente',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (conductor_id) REFERENCES conductores(id) ON DELETE CASCADE,
    FOREIGN KEY (registrado_por) REFERENCES usuarios(id) ON DELETE RESTRICT,
    
    -- Un conductor solo puede tener un registro por fecha
    UNIQUE KEY unique_conductor_fecha (conductor_id, fecha_pago),
    
    INDEX idx_conductor_fecha (conductor_id, fecha_pago),
    INDEX idx_fecha_estado (fecha_pago, estado),
    INDEX idx_registrado_por (registrado_por)
);

-- Configuración inicial de monto de tarifa diaria
INSERT INTO configuraciones (clave, valor, tipo, descripcion, categoria) VALUES
('tarifa_diaria_monto', '15000', 'integer', 'Monto de tarifa diaria que deben pagar los conductores', 'tarifas'),
('tarifa_diaria_obligatoria', '1', 'boolean', 'Si la tarifa diaria es obligatoria para trabajar', 'tarifas'),
('tarifa_diaria_hora_limite', '08:00', 'string', 'Hora límite para pagar tarifa diaria', 'tarifas');

-- Trigger para actualizar fecha_actualizacion
DELIMITER $$
CREATE TRIGGER tr_pagos_tarifa_diaria_updated_at
    BEFORE UPDATE ON pagos_tarifa_diaria
    FOR EACH ROW
BEGIN
    SET NEW.fecha_actualizacion = CURRENT_TIMESTAMP;
END$$
DELIMITER ;