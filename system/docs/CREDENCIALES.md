# 🔐 Credenciales del Sistema - Primero de Junio

## 📋 Información General

- **Proyecto**: Sistema de Gestión de Mototaxis - Asociación 1ro de Junio
- **Base de Datos**: MySQL - `primero_de_junio`
- **Usuario BD**: `root` (sin contraseña)
- **Entorno**: Desarrollo con Laragon

---

## 🚀 URLs del Sistema

### Servidores Locales
- **Frontend (React)**: http://localhost:3000+ (puerto dinámico)
- **Backend (Laravel)**: http://127.0.0.1:8000+ (puerto dinámico)
- **Login**: http://127.0.0.1:8000+/login

### Acceso Rápido
Para iniciar el sistema completo:
```bash
.\iniciar-desarrollo.ps1
```

---

## 👥 Usuarios de Prueba

### 🔧 Administrador Principal
- **Email**: `admin@primero1dejunio.com`
- **Contraseña**: `mototaxi123`
- **Rol**: Administrador
- **Permisos**: Acceso completo al sistema

### 💼 Personal Operativo

#### Operador de Sistema
- **Email**: `operador@primero1dejunio.com`  
- **Contraseña**: `mototaxi123`
- **Rol**: Operador
- **Función**: Gestión diaria de operaciones

#### Supervisor de Servicios
- **Email**: `supervisor@primero1dejunio.com`
- **Contraseña**: `mototaxi123`
- **Rol**: Supervisor
- **Función**: Supervisión y control de calidad

### 🏍️ Conductores de Prueba

#### Conductor 1
- **Email**: `conductor1@primero1dejunio.com`
- **Contraseña**: `mototaxi123`
- **Nombre**: Juan Manuel Perez Garcia
- **Rol**: Conductor

#### Conductor 2
- **Email**: `conductor2@primero1dejunio.com`
- **Contraseña**: `mototaxi123`
- **Nombre**: Maria Elena Gonzalez Lopez
- **Rol**: Conductor

#### Conductor 3
- **Email**: `conductor3@primero1dejunio.com`
- **Contraseña**: `mototaxi123`
- **Nombre**: Carlos Alberto Rodriguez Martinez
- **Rol**: Conductor

---

## 📊 Datos de Prueba Disponibles

### Base de Datos Poblada
- ✅ **8 usuarios** del sistema (diferentes roles)
- ✅ **10 conductores** registrados
- ✅ **13 vehículos** en el parque automotor
- ✅ **20 clientes** frecuentes
- ✅ **8 asignaciones** vehículo-conductor activas
- ✅ **Roles y permisos** configurados
- ✅ **Tarifas y configuraciones** del sistema

---

## 🔑 Credenciales por Rol

### Administrador
| Usuario | Email | Contraseña | Acceso |
|---------|-------|------------|--------|
| Administrador Sistema | `admin@primero1dejunio.com` | `mototaxi123` | Total |

### Personal de Oficina
| Usuario | Email | Contraseña | Función |
|---------|-------|------------|---------|
| Carlos Rodriguez | `operador@primero1dejunio.com` | `mototaxi123` | Operaciones |
| Ana Martinez | `supervisor@primero1dejunio.com` | `mototaxi123` | Supervisión |

### Conductores
| Conductor | Email | Contraseña | Estado |
|-----------|-------|------------|---------|
| Juan Perez | `conductor1@primero1dejunio.com` | `mototaxi123` | Activo |
| Maria Gonzalez | `conductor2@primero1dejunio.com` | `mototaxi123` | Activo |
| Carlos Rodriguez | `conductor3@primero1dejunio.com` | `mototaxi123` | Activo |

---

## ⚡ Inicio Rápido

### 1. Iniciar el Sistema
```powershell
# Desde la raíz del proyecto
.\iniciar-desarrollo.ps1
```

### 2. Acceder al Login
- Abre tu navegador en: `http://127.0.0.1:8000/login`
- Usa cualquier credencial de arriba
- **Recomendado**: Usar el administrador para explorar todo el sistema

### 3. Probar Funcionalidades
- **Dashboard**: Visión general del sistema
- **Gestión de Conductores**: CRUD completo
- **Gestión de Vehículos**: Parque automotor
- **Asignaciones**: Conductor-Vehículo
- **Reportes**: Viajes y estadísticas

---

## 🛠️ Configuración Técnica

### Base de Datos
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=primero_de_junio
DB_USERNAME=root
DB_PASSWORD=
```

### Configuración Laravel
```env
APP_NAME="Primero de Junio"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

---

## 🔒 Seguridad

⚠️ **IMPORTANTE**: Estas credenciales son solo para **desarrollo y pruebas**.

### En Producción:
1. **Cambiar todas las contraseñas**
2. **Usar contraseñas seguras** (mínimo 12 caracteres)
3. **Habilitar autenticación de dos factores**
4. **Configurar HTTPS**
5. **Actualizar variables de entorno**

---

## 📞 Soporte

**Desarrollado para**: Asociación de Mototaxis "1ro de Junio"  
**Versión**: 1.0.0  
**Fecha**: Noviembre 2025  

### Funcionalidades Principales
- ✅ Gestión de conductores y vehículos
- ✅ Sistema de asignaciones
- ✅ Control de viajes y tarifas
- ✅ Reportes y estadísticas
- ✅ Panel administrativo completo

---

*Este documento contiene información sensible. Mantener seguro y actualizar regularmente.*