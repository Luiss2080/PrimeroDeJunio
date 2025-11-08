-- Seed: 002_create_usuarios.sql
-- Datos iniciales para la tabla usuarios

-- Insertar usuarios por defecto
-- Contraseña para todos: mototaxi123 (cambiar inmediatamente en producción)
INSERT INTO usuarios (nombre, apellido, email, password, telefono, direccion, rol_id, estado) VALUES
('Administrador', 'Sistema', 'admin@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3001234567', 'Oficina Principal - Calle 123 #45-67', 1, 'activo'),
('Carlos Alberto', 'Rodriguez', 'operador@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3009876543', 'Carrera 15 #30-25', 2, 'activo'),
('Juan Manuel', 'Pérez García', 'conductor1@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3012345678', 'Barrio La Esperanza - Calle 8 #12-34', 3, 'activo'),
('María Elena', 'González López', 'conductor2@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3154567890', 'Sector El Progreso - Carrera 20 #15-40', 3, 'activo');