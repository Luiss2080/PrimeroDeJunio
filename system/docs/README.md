# Documentación del Sistema - Índice

## Documentación Técnica

### 🚀 [Instalación](./instalacion.md)
- Requisitos del sistema
- Instalación de dependencias
- Configuración inicial
- Setup de base de datos

### 🖥️ [Servidor de Desarrollo](./servidor.md)
- Iniciar servidor Laravel
- Configurar Vite (assets)
- Scripts de inicio automático
- URLs y puertos del sistema

### 💾 [Base de Datos](./base-datos.md)
- Acceso vía Tinker y MySQL CLI
- Comandos de migraciones
- Manejo de seeders
- Consultas útiles y troubleshooting

### 🏗️ [Estructura del Proyecto](./estructura.md)
- Arquitectura general
- Modelos y relaciones
- Comandos de desarrollo
- Testing y frontend

### ⚡ [Comandos Artisan](./comandos.md)
- Comandos básicos de Laravel
- Generadores de código
- Cache y optimización
- Debugging y mantenimiento

## Información del Proyecto

### Stack Tecnológico
- **Backend**: Laravel 11 + PHP 8.1+
- **Database**: MySQL 8.0 (utf8mb4_spanish_ci)
- **Frontend**: Vue.js + Vite
- **Environment**: XAMPP (Windows)

### Base de Datos
- **Nombre**: `primero_de_junio`
- **Tablas**: 11 principales + Laravel system tables
- **Roles**: 2 (administrador, operador)
- **Usuarios**: 8 (2 admin, 6 operador)

### URLs de Desarrollo
- **Laravel**: http://localhost:8000
- **Vite Dev**: http://localhost:5173  
- **phpMyAdmin**: http://localhost/phpmyadmin

### Estructura de Roles

| Rol | Usuarios | Descripción |
|-----|----------|-------------|
| administrador | 2 | Control total del sistema |
| operador | 6 | Operaciones y gestión diaria |

### Comandos Rápidos

```bash
# Iniciar desarrollo completo
cd system
php artisan serve &
npm run dev

# Resetear BD completa
php artisan migrate:fresh --seed

# Ver estado del sistema
php artisan about
php artisan migrate:status
```

---

**Proyecto**: Sistema de Gestión de Transporte  
**Migrado**: De SQL puro a Laravel 11  
**Fecha**: Noviembre 2025