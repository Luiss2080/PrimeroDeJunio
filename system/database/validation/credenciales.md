# 🔐 CREDENCIALES DE USUARIOS - PRIMERO DE JUNIO

## 📋 Sistema de Mototaxis - Credenciales de Acceso

> **⚠️ IMPORTANTE:** Estas credenciales son para desarrollo y pruebas. En producción, cambiar todas las contraseñas por seguridad.

---

## 👨‍💼 **ADMINISTRADORES**

### 🔹 **Administrador Principal**

- **Email:** `admin@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Administrador
- **Permisos:** Acceso completo al sistema
- **Dashboard:** `/dashboard/?role=admin`

---

## 🎯 **OPERADORES**

### 🔹 **Operador Principal**

- **Email:** `operador@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Operador
- **Permisos:** Gestión diaria y registros operativos
- **Dashboard:** `/dashboard/?role=operador`

### 🔹 **Operador Secundario**

- **Email:** `operador2@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Operador
- **Permisos:** Gestión diaria y registros operativos
- **Dashboard:** `/dashboard/?role=operador`

---

## 👥 **SUPERVISORES**

### 🔹 **Supervisor General**

- **Email:** `supervisor@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Supervisor
- **Permisos:** Supervisión de operaciones y reportes
- **Dashboard:** `/dashboard/?role=supervisor`

---

## 🏍️ **CONDUCTORES**

### 🔹 **Conductor 1 - Carlos Rodriguez**

- **Email:** `conductor1@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Conductor
- **Permisos:** Gestión de viajes y perfil personal
- **Dashboard:** `/dashboard/?role=conductor`

### 🔹 **Conductor 2 - Miguel Angel**

- **Email:** `conductor2@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Conductor
- **Permisos:** Gestión de viajes y perfil personal
- **Dashboard:** `/dashboard/?role=conductor`

### 🔹 **Conductor 3 - Luis Fernando**

- **Email:** `conductor3@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Conductor
- **Permisos:** Gestión de viajes y perfil personal
- **Dashboard:** `/dashboard/?role=conductor`

### 🔹 **Conductor 4 - Jorge Enrique**

- **Email:** `conductor4@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Conductor
- **Permisos:** Gestión de viajes y perfil personal
- **Dashboard:** `/dashboard/?role=conductor`

### 🔹 **Conductor 5 - Andres Felipe**

- **Email:** `conductor5@primero1dejunio.com`
- **Contraseña:** `mototaxi123`
- **Rol:** Conductor
- **Permisos:** Gestión de viajes y perfil personal
- **Dashboard:** `/dashboard/?role=conductor`

---

## 🔄 **PATRONES DE REDIRECCIÓN**

| Rol               | URL de Redirección            |
| ----------------- | ----------------------------- |
| **Administrador** | `/dashboard/?role=admin`      |
| **Operador**      | `/dashboard/?role=operador`   |
| **Supervisor**    | `/dashboard/?role=supervisor` |
| **Conductor**     | `/dashboard/?role=conductor`  |

---

## 📊 **PERMISOS POR ROL**

### 🔸 **Administrador**

- ✅ Gestión completa de usuarios
- ✅ Gestión completa de conductores
- ✅ Gestión completa de vehículos
- ✅ Gestión completa de viajes
- ✅ Configuración del sistema
- ✅ Todos los reportes
- ✅ Gestión de mantenimientos
- ✅ Gestión de pagos

### 🔸 **Operador**

- ✅ Crear/editar conductores
- ✅ Editar vehículos
- ✅ Gestión completa de viajes
- ✅ Gestión de clientes
- ✅ Reportes operativos
- ❌ Gestión de usuarios
- ❌ Configuración del sistema

### 🔸 **Supervisor**

- ✅ Supervisión de operaciones
- ✅ Reportes generales
- ✅ Monitoreo de conductores
- ✅ Seguimiento de vehículos
- ❌ Modificar configuraciones
- ❌ Gestión de usuarios

### 🔸 **Conductor**

- ✅ Ver y editar perfil personal
- ✅ Gestión de sus viajes
- ✅ Ver su vehículo asignado
- ✅ Reportes de sus actividades
- ❌ Ver otros conductores
- ❌ Configuraciones del sistema

---

## 🔗 **ENLACES DE ACCESO**

### 🚪 **Página de Login**

```
http://localhost/PrimeroDeJunio/system/app/auth/login.php
```

### 📊 **Dashboard Principal**

```
http://localhost/PrimeroDeJunio/system/app/views/dashboard/
```

### 🧪 **Página de Pruebas**

```
http://localhost/PrimeroDeJunio/test-login.html
```

---

## ⚙️ **INFORMACIÓN TÉCNICA**

### 🔐 **Seguridad**

- **Hash de contraseñas:** `password_hash()` con `PASSWORD_DEFAULT`
- **Validación:** Solo usuarios con estado `activo`
- **Logs:** Registro de intentos de acceso exitosos y fallidos
- **Sesiones:** Manejo centralizado con clase `Auth`

### 🗄️ **Base de Datos**

- **Nombre:** `primero_de_junio`
- **Tablas principales:** `usuarios`, `roles`, `conductores`
- **Charset:** `utf8mb4`
- **Estado requerido:** `activo`

### 📝 **Estructura de Usuario**

```sql
usuarios:
- id (PK)
- email (unique)
- password (hash)
- nombre
- apellido
- rol_id (FK)
- estado ('activo', 'inactivo', 'pendiente')
```

---

## 📞 **SOPORTE TÉCNICO**

Si tienes problemas con las credenciales:

1. **Verificar estado del usuario en BD:**

   ```sql
   SELECT email, estado FROM usuarios WHERE email = 'tu_email@dominio.com';
   ```

2. **Verificar logs de acceso:**

   - Revisar `error_log` de PHP para intentos fallidos

3. **Reiniciar sesión:**
   - Ir a `login.php?logout=1` para cerrar sesión actual

---

## 📅 **FECHA DE ACTUALIZACIÓN**

- **Última actualización:** 17 de Noviembre de 2025
- **Versión del sistema:** 1.0.0
- **Estado:** Activo y funcional

---

> **🔒 NOTA DE SEGURIDAD:** Estas credenciales son para entorno de desarrollo. En producción, todos los usuarios deben cambiar sus contraseñas por seguridad.
