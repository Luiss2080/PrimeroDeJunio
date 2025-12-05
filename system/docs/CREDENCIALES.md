# 🔐 Credenciales del Sistema - Primero de Junio

## 📋 Información General

-   **Proyecto**: Sistema de Gestión de Mototaxis - Asociación 1ro de Junio
-   **Base de Datos**: MySQL - `primero_de_junio`
-   **Usuario BD**: `root` (sin contraseña)
-   **Entorno**: Desarrollo con Laragon

---

## 🚀 URLs del Sistema

### Servidores Locales

-   **Frontend (React)**: http://localhost:3000+ (puerto dinámico)
-   **Backend (Laravel)**: http://127.0.0.1:8000+ (puerto dinámico)
-   **Login**: http://127.0.0.1:8000/login

### Acceso Rápido

Para iniciar el sistema completo:

```bash
.\iniciar-desarrollo.ps1
```

---

## 👥 Usuarios de Prueba

### 🔧 Administradores del Sistema

#### Super Administrador
-   **Nombre**: Super Administrador
-   **Email**: `superadmin@primero.com`
-   **Contraseña**: `SuperAdmin123!`
-   **Rol**: Administrador
-   **Permisos**: Acceso completo al sistema

#### Administrador Principal
-   **Nombre**: Carlos Rodríguez
-   **Email**: `admin@primero.com`
-   **Contraseña**: `Admin123!`
-   **Rol**: Administrador
-   **Permisos**: Gestión completa del sistema

### 👥 Personal de Supervisión

#### Supervisor de Operaciones
-   **Nombre**: María González
-   **Email**: `supervisor@primero.com`
-   **Contraseña**: `Supervisor123!`
-   **Rol**: Supervisor
-   **Función**: Supervisión de conductores y viajes

#### Supervisor Adicional
-   **Nombre**: Andrea Ramírez
-   **Email**: `andrea.ramirez@primero.com`
-   **Contraseña**: `password`
-   **Rol**: Supervisor
-   **Función**: Supervisión nocturna

### 💼 Personal Operativo

#### Operador Principal
-   **Nombre**: Luis Martínez
-   **Email**: `operador@primero.com`
-   **Contraseña**: `Operador123!`
-   **Rol**: Operador
-   **Función**: Operaciones diarias

#### Operador Inactivo (para pruebas)
-   **Nombre**: Ana Pérez
-   **Email**: `ana.perez@primero.com`
-   **Contraseña**: `password`
-   **Estado**: Inactivo
-   **Función**: Usuario de prueba

#### Operador en Vacaciones
-   **Nombre**: Laura Vargas
-   **Email**: `laura.vargas@primero.com`
-   **Contraseña**: `password`
-   **Estado**: Vacaciones
-   **Función**: Usuario de prueba

### 🚗 Conductores del Sistema

#### Conductor Suspendido (para pruebas)
-   **Nombre**: Pedro Jiménez
-   **Email**: `pedro.jimenez@primero.com`
-   **Contraseña**: `password`
-   **Estado**: Suspendido
-   **Función**: Usuario de prueba

#### Conductores Activos
-   **5 conductores adicionales** generados automáticamente
-   **Contraseña**: `password` (para todos)
-   **Estado**: Activos

### 👤 Usuarios Adicionales
-   **10 usuarios** con roles variados generados automáticamente
-   **Contraseña**: `password` (para todos)
-   **Estados**: Mixtos (activo, inactivo, etc.)

---

## 📊 Datos de Prueba Disponibles

### Base de Datos Poblada

-   ✅ **26 usuarios** del sistema (Administradores, Supervisores, Operadores y Conductores)
-   ✅ **5 roles** configurados (Administrador, Supervisor, Operador, Conductor, Invitado)
-   ✅ **20 conductores** con datos completos
-   ✅ **20 vehículos** con documentación al día
-   ✅ **20 clientes** registrados
-   ✅ **50 viajes** de ejemplo
-   ✅ **30 pagos** a conductores
-   ✅ **25 mantenimientos** programados

---

## 🔑 Credenciales por Rol

### 🔧 Administradores

| Usuario                | Email                      | Contraseña      | Acceso    |
| ---------------------- | -------------------------- | --------------- | --------- |
| Super Administrador    | `superadmin@primero.com`   | `SuperAdmin123!`| Completo  |
| Carlos Rodríguez       | `admin@primero.com`        | `Admin123!`     | Completo  |

### 👥 Supervisores

| Usuario            | Email                      | Contraseña       | Función        |
| ------------------ | -------------------------- | ---------------- | -------------- |
| María González     | `supervisor@primero.com`   | `Supervisor123!` | Supervisión    |
| Andrea Ramírez     | `andrea.ramirez@primero.com` | `password`     | Supervisión    |

### 💼 Operadores

| Usuario        | Email                      | Contraseña      | Estado     |
| -------------- | -------------------------- | --------------- | ---------- |
| Luis Martínez  | `operador@primero.com`     | `Operador123!`  | Activo     |
| Ana Pérez      | `ana.perez@primero.com`    | `password`      | Inactivo   |
| Laura Vargas   | `laura.vargas@primero.com` | `password`      | Vacaciones |

### 🚗 Conductores

| Usuario        | Email                        | Contraseña | Estado     |
| -------------- | ---------------------------- | ---------- | ---------- |
| Pedro Jiménez  | `pedro.jimenez@primero.com`  | `password` | Suspendido |
| + 5 conductores| Emails generados             | `password` | Activos    |

**Nota**: Los 15 usuarios adicionales generados automáticamente tienen contraseña `password`

---

## ⚡ Inicio Rápido

### 1. Iniciar el Sistema

```powershell
# Desde la raíz del proyecto
.\iniciar-desarrollo.ps1
```

### 2. Acceder al Login

-   Abre tu navegador en: `http://127.0.0.1:8000/login`
-   **Opción 1 (Recomendada)**: Super Admin
    -   Email: `superadmin@primero.com`
    -   Contraseña: `SuperAdmin123!`
-   **Opción 2**: Administrador
    -   Email: `admin@primero.com`
    -   Contraseña: `Admin123!`
-   **Opción 3**: Supervisor
    -   Email: `supervisor@primero.com`
    -   Contraseña: `Supervisor123!`

### 3. Probar Funcionalidades

-   **Dashboard**: Visión general con estadísticas reales
-   **Conductores**: 20 conductores con chalecos asignados
-   **Vehículos**: 20 vehículos con SOAT y tecnomecánica
-   **Clientes**: 20 clientes con preferencias configuradas
-   **Viajes**: 50 viajes con diferentes estados
-   **Asignaciones**: Sistema de asignación conductor-vehículo
-   **Pagos**: Gestión de pagos a conductores
-   **Mantenimientos**: Programación y seguimiento
-   **Reportes**: Incidentes y estadísticas operacionales
-   **Auditoría**: Logs completos de actividad del sistema

### 4. Datos de Prueba Disponibles

| Módulo | Cantidad | Descripción |
|---------|----------|-------------|
| Usuarios | 26 | Incluye todos los roles del sistema |
| Conductores | 20 | Con chalecos y datos completos |
| Vehículos | 20 | Con documentación al día |
| Clientes | 20 | Con preferencias y rutas habituales |
| Viajes | 50 | Estados: completados, en curso, cancelados |
| Asignaciones | 22 | Conductor-vehículo activas |
| Pagos | 30 | Diferentes métodos y estados |
| Mantenimientos | 25 | Preventivos y correctivos |
| Reportes | 20 | Incidentes operacionales |
| Gastos | 30 | Operativos del negocio |
| Turnos | 25 | Programación de horarios |
| Documentos | 100 | Asociados a diferentes entidades |
| Logs | 50 | Actividad y auditoría |

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

-   ✅ **Gestión de Usuarios**: 26 usuarios con 5 roles diferentes
-   ✅ **Conductores**: 20 conductores con chalecos asignados
-   ✅ **Vehículos**: 20 vehículos con documentación completa
-   ✅ **Asignaciones**: 22 asignaciones conductor-vehículo
-   ✅ **Viajes**: 50 viajes con rutas y tarifas
-   ✅ **Pagos**: 30 pagos a conductores procesados
-   ✅ **Mantenimientos**: 25 mantenimientos programados
-   ✅ **Reportes**: 20 reportes de incidentes
-   ✅ **Gastos**: 30 gastos operativos registrados
-   ✅ **Turnos**: 25 turnos de trabajo
-   ✅ **Documentos**: 100 documentos digitalizados
-   ✅ **Auditoría**: 50 logs del sistema

---

_Este documento contiene información sensible. Mantener seguro y actualizar regularmente._
