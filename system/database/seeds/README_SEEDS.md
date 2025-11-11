# Seeds de Datos de Prueba - Sistema Mototaxi Primero de Junio

## Resumen General
Este directorio contiene los archivos de seeds (datos de prueba) para todas las tablas del sistema. Cada migración tiene su correspondiente archivo de seed con datos realistas para desarrollo y testing.

## Estructura de Seeds Disponibles

### 001_create_roles.sql
- **Registros**: 4 roles (administrador, operador, supervisor, conductor)
- **Datos clave**: Permisos granulares en formato JSON para cada rol
- **Funcionalidad**: Control de acceso completo según el rol

### 002_create_usuarios.sql
- **Registros**: 8 usuarios (1 admin, 2 operadores, 1 supervisor, 4 conductores)
- **Datos clave**: Credenciales de acceso, información personal, asignación de roles
- **Password por defecto**: mototaxi123 (cambiar en producción)

### 003_create_conductores.sql
- **Registros**: 10 conductores con perfiles completos
- **Datos clave**: Información personal, licencias, experiencia, estados variados
- **Cobertura**: Conductores activos, inactivos, en entrenamiento

### 004_create_vehiculos.sql
- **Registros**: 13 vehículos (motos colombianas típicas)
- **Datos clave**: Honda, Yamaha, Suzuki con placas, documentos, estados
- **Cobertura**: Vehículos activos, en mantenimiento, documentos por vencer

### 005_create_clientes.sql
- **Registros**: 20+ clientes variados
- **Datos clave**: Clientes frecuentes, ocasionales, empresariales
- **Cobertura**: Diferentes tipos de clientes y descuentos

### 006_create_tarifas.sql
- **Registros**: 15+ tarifas por distancia y tiempo
- **Datos clave**: Tarifas día/noche, mínimas, por kilómetro, especiales
- **Cobertura**: Toda la estructura tarifaria del negocio

### 007_create_viajes.sql
- **Registros**: 50+ viajes distribuidos en 7 días
- **Datos clave**: Viajes actuales, históricos, diferentes estados
- **Cobertura**: Viajes completados, cancelados, en curso

### 008_create_asignaciones_vehiculo.sql
- **Registros**: 20+ asignaciones conductor-vehículo
- **Datos clave**: Asignaciones por turnos, fechas, diferentes conductores
- **Cobertura**: Gestión completa de turnos y asignaciones

### 009_create_mantenimientos.sql
- **Registros**: 25+ registros de mantenimiento
- **Datos clave**: Mantenimientos preventivos, correctivos, programados
- **Cobertura**: Historial y programación de mantenimientos

### 010_create_configuraciones.sql
- **Registros**: 70+ configuraciones del sistema
- **Datos clave**: 8 categorías de configuración (empresa, sistema, tarifas, etc.)
- **Cobertura**: Configuración completa del sistema

### 011_create_logs.sql
- **Registros**: 30+ logs de actividades
- **Datos clave**: Logs de creación, actualización, eliminación, accesos
- **Cobertura**: Trazabilidad completa de actividades del sistema

### 012_create_pagos_tarifa_diaria.sql
- **Registros**: 35+ pagos de tarifa diaria
- **Datos clave**: Pagos de últimos 7 días, diferentes estados y métodos
- **Cobertura**: Gestión completa de pagos de conductores

## Características de los Datos

### Realismo
- Nombres colombianos típicos
- Direcciones realistas de ciudades colombianas
- Placas de vehículos con formato oficial
- Rutas y destinos comunes en el negocio

### Coherencia Temporal
- Datos distribuidos en los últimos 15 días
- Fechas de vencimiento realistas para documentos
- Horarios típicos de operación de mototaxis

### Variedad de Estados
- Entidades activas e inactivas
- Diferentes estados de procesos (pendiente, en curso, completado)
- Escenarios de excepción (cancelaciones, mantenimientos)

### Relaciones Consistentes
- Todas las claves foráneas son válidas
- Datos interconectados lógicamente
- Respeta las restricciones del modelo de datos

## Instrucciones de Uso

### Importar Seeds Completos
```sql
-- Ejecutar en orden:
SOURCE 001_create_roles.sql;
SOURCE 002_create_usuarios.sql;
SOURCE 003_create_conductores.sql;
SOURCE 004_create_vehiculos.sql;
SOURCE 005_create_clientes.sql;
SOURCE 006_create_tarifas.sql;
SOURCE 007_create_viajes.sql;
SOURCE 008_create_asignaciones_vehiculo.sql;
SOURCE 009_create_mantenimientos.sql;
SOURCE 010_create_configuraciones.sql;
SOURCE 011_create_logs.sql;
SOURCE 012_create_pagos_tarifa_diaria.sql;
```

### Scripts de Importación Automática
Usar los archivos .bat/.ps1 disponibles en el directorio raíz para importación automatizada.

## Datos de Testing

### Credenciales de Acceso
- **Admin**: admin@primero1dejunio.com / mototaxi123
- **Operador**: operador@primero1dejunio.com / mototaxi123
- **Supervisor**: supervisor@primero1dejunio.com / mototaxi123
- **Conductor**: conductor1@primero1dejunio.com / mototaxi123

### Escenarios de Prueba Incluidos
1. **Dashboard Poblado**: Estadísticas reales con datos suficientes
2. **Operaciones Diarias**: Viajes, asignaciones, pagos del día actual
3. **Historial**: Datos históricos para reportes y análisis
4. **Mantenimientos**: Programación y historial de mantenimientos
5. **Configuración**: Sistema completamente configurado

## Notas Importantes

### Seguridad
- Cambiar passwords por defecto en producción
- Los seeds son solo para desarrollo y testing
- No usar estos datos en producción

### Consistencia
- Todos los datos están interrelacionados correctamente
- Las fechas son coherentes con el negocio
- Los montos y tarifas son realistas para el mercado

### Mantenimiento
- Actualizar seeds cuando cambien los modelos
- Mantener coherencia en las relaciones
- Documentar cambios significativos

---
*Generado automáticamente para el Sistema Mototaxi Primero de Junio*
*Fecha: Noviembre 2025*