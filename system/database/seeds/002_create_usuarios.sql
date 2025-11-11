-- Seed: 002_create_usuarios.sql
-- Datos iniciales para la tabla usuarios

-- Insertar usuarios por defecto
-- Contraseña para todos: mototaxi123 (cambiar inmediatamente en producción)
INSERT INTO usuarios (nombre, apellido, email, password, telefono, direccion, rol_id, estado) VALUES
('Administrador', 'Sistema', 'admin@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3001234567', 'Oficina Principal - Calle 123 #45-67', 1, 'activo'),
('Carlos Alberto', 'Rodriguez', 'operador@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3009876543', 'Carrera 15 #30-25', 2, 'activo'),
('Ana Lucía', 'Martínez Silva', 'supervisor@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3018765432', 'Avenida Principal #88-42', 4, 'activo'),
('Juan Manuel', 'Pérez García', 'conductor1@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3012345678', 'Barrio La Esperanza - Calle 8 #12-34', 3, 'activo'),
('María Elena', 'González López', 'conductor2@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3154567890', 'Sector El Progreso - Carrera 20 #15-40', 3, 'activo'),
('Roberto Carlos', 'Jiménez Torres', 'conductor3@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3176543210', 'Barrio San José - Calle 25 #18-60', 3, 'activo'),
('Patricia Andrea', 'Hernández Ruiz', 'conductor4@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3198765432', 'Sector Villa Nueva - Carrera 8 #32-14', 3, 'activo'),
('Miguel Ángel', 'Vargas Castro', 'operador2@primero1dejunio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3134567891', 'Centro - Avenida 19 #25-35', 2, 'activo');