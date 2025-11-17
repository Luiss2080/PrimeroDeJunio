# 🔧 Solución de Problemas

Esta guía te ayudará a resolver los problemas más comunes al trabajar con el proyecto **Primero de Junio**.

## 🚨 Problemas Frecuentes y Soluciones

### 1. **❌ "Puerto 80 está ocupado" / "Apache no inicia"**

#### **🔍 Problema:**

Otro programa está usando el puerto 80 (común en Windows con IIS o Skype).

#### **✅ Soluciones:**

**Opción A: Cerrar programa que usa el puerto**

```powershell
# Encontrar qué programa usa el puerto 80
netstat -ano | findstr :80

# Terminar el proceso (reemplazar PID con el número encontrado)
taskkill /PID [PID] /F
```

**Opción B: Cambiar puerto de Apache**

1. Abrir XAMPP Control Panel
2. Click en "Config" junto a Apache
3. Seleccionar "Apache (httpd.conf)"
4. Buscar `Listen 80` y cambiar por `Listen 8080`
5. Guardar y reiniciar Apache
6. Acceder con: `http://localhost:8080/`

---

### 2. **❌ "MySQL no inicia" / "Puerto 3306 ocupado"**

#### **🔍 Problema:**

Otro servicio de MySQL está corriendo o el puerto está ocupado.

#### **✅ Soluciones:**

**Opción A: Detener otros servicios MySQL**

```powershell
# Como administrador, detener servicio de Windows
net stop mysql
net stop mysql80  # Puede variar el nombre

# O desde Services.msc buscar y detener MySQL
```

**Opción B: Cambiar puerto de MySQL**

1. En XAMPP Control Panel, click "Config" junto a MySQL
2. Seleccionar "my.ini"
3. Buscar `port = 3306` y cambiar por `port = 3307`
4. Actualizar `config.php` del proyecto con el nuevo puerto

---

### 3. **❌ "npm no es reconocido" / "node no es reconocido"**

#### **🔍 Problema:**

Node.js no está instalado o no está en el PATH del sistema.

#### **✅ Soluciones:**

**Verificar instalación:**

```powershell
# Verificar Node.js
node --version

# Verificar npm
npm --version
```

**Si no funciona:**

1. **Descargar e instalar**: [Node.js LTS](https://nodejs.org/)
2. **Reiniciar terminal** completamente
3. **Verificar PATH**: En variables de entorno debe estar `C:\Program Files\nodejs\`
4. **Reinstalar** si es necesario

---

### 4. **❌ "Error: EACCES permission denied"**

#### **🔍 Problema:**

Problemas de permisos, común en sistemas Windows.

#### **✅ Soluciones:**

**Ejecutar como administrador:**

1. Click derecho en PowerShell/CMD
2. Seleccionar "Ejecutar como administrador"
3. Navegar al directorio del proyecto
4. Ejecutar comandos

**O cambiar permisos de la carpeta:**

1. Click derecho en carpeta del proyecto
2. Propiedades > Seguridad > Editar
3. Dar control total a tu usuario

---

### 5. **❌ "Cannot connect to database"**

#### **🔍 Problema:**

El backend no puede conectarse a MySQL.

#### **✅ Soluciones:**

**Verificar servicios:**

1. MySQL debe estar corriendo en XAMPP
2. Verificar en: `http://localhost/phpmyadmin/`

**Verificar configuración:**

```php
// En system/config/config.php
'database' => [
    'host' => 'localhost',      // ✅ Correcto
    'port' => '3306',           // ✅ O el puerto que uses
    'database' => 'primero_de_junio',  // ✅ Nombre exacto
    'username' => 'root',       // ✅ Usuario de XAMPP
    'password' => '',           // ✅ Vacío por defecto en XAMPP
]
```

**Crear base de datos:**

```sql
-- En phpMyAdmin
CREATE DATABASE primero_de_junio;
```

---

### 6. **❌ "404 Not Found" en el backend**

#### **🔍 Problema:**

Apache no encuentra el proyecto o la configuración no es correcta.

#### **✅ Soluciones:**

**Verificar ubicación:**

- El proyecto debe estar en: `C:\xampp\htdocs\PrimeroDeJunio\`
- Acceder con: `http://localhost/PrimeroDeJunio/`

**Verificar archivo index:**

- Debe existir: `system/public/index.php`
- O configurar un `.htaccess` adecuado

---

### 7. **❌ Frontend no carga / "Página en blanco"**

#### **🔍 Problema:**

Error en el código de React o dependencias faltantes.

#### **✅ Soluciones:**

**Verificar en consola del navegador (F12):**

```javascript
// Buscar errores en la pestaña "Console"
// Común: "Failed to resolve module"
```

**Limpiar y reinstalar:**

```bash
# Navegar al directorio del frontend
cd C:\xampp\htdocs\PrimeroDeJunio\website

# Limpiar caché y reinstalar
npm cache clean --force
rm -rf node_modules package-lock.json
npm install

# Reiniciar servidor
npm run dev
```

---

### 8. **❌ "Scripts disabled" / "Execution Policy"**

#### **🔍 Problema:**

Windows bloquea la ejecución de scripts PowerShell por seguridad.

#### **✅ Solución:**

```powershell
# Ejecutar como administrador
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser

# O temporalmente
Set-ExecutionPolicy -ExecutionPolicy Bypass -Scope Process
```

---

## 🔍 Diagnóstico Paso a Paso

### **🩺 Verificación Completa del Sistema**

#### **1. Verificar Requisitos:**

```powershell
# Node.js instalado
node --version  # Debe ser >=16.0

# npm instalado
npm --version   # Debe ser >=7.0

# XAMPP funcionando
# Ir a http://localhost - debe mostrar página de XAMPP
```

#### **2. Verificar Servicios:**

```powershell
# En XAMPP Control Panel deben estar verdes:
# ✅ Apache
# ✅ MySQL
```

#### **3. Verificar Proyecto:**

```powershell
# Verificar estructura de archivos
dir C:\xampp\htdocs\PrimeroDeJunio\
# Debe mostrar: system/, website/, *.ps1, *.bat

# Verificar dependencias frontend
cd C:\xampp\htdocs\PrimeroDeJunio\website
dir node_modules
# Debe existir la carpeta node_modules
```

#### **4. Verificar URLs:**

- 🌐 **XAMPP**: `http://localhost/` (página de bienvenida)
- 🗄️ **phpMyAdmin**: `http://localhost/phpmyadmin/`
- ⚙️ **Backend**: `http://localhost/PrimeroDeJunio/`
- 📱 **Frontend**: `http://localhost:3000/` (solo si está corriendo)

---

## 🚨 Problemas Específicos por Sistema

### **💻 Windows 10/11**

#### **Problema: Windows Defender bloquea XAMPP**

```powershell
# Agregar excepción en Windows Defender
# Configuración > Actualización y seguridad > Seguridad de Windows
# > Protección antivirus > Exclusiones
# Agregar carpeta: C:\xampp\
```

#### **Problema: UAC (Control de Cuenta de Usuario)**

- Ejecutar XAMPP como administrador
- O desactivar UAC temporalmente

### **🔧 Antivirus/Firewall**

#### **AVG, Avast, Norton, etc.**

- Agregar `C:\xampp\` como excepción
- Permitir tráfico en puertos 80, 443, 3306
- Deshabilitar "Escudo Web" temporalmente

---

## 📋 Lista de Verificación Rápida

### **✅ Checklist de Diagnóstico:**

```bash
□ Node.js >= 16.0 instalado
□ npm >= 7.0 instalado
□ XAMPP instalado en C:\xampp\
□ Apache iniciado (verde en XAMPP)
□ MySQL iniciado (verde en XAMPP)
□ Proyecto en C:\xampp\htdocs\PrimeroDeJunio\
□ Base de datos 'primero_de_junio' existe
□ node_modules existe en /website/
□ http://localhost/ funciona
□ http://localhost/phpmyadmin/ funciona
□ http://localhost/PrimeroDeJunio/ funciona
```

---

## 🆘 Soluciones de Emergencia

### **🔥 Si NADA Funciona - Reset Completo**

#### **Paso 1: Detener Todo**

```powershell
# Cerrar todos los navegadores
# Detener Apache y MySQL en XAMPP
# Cerrar todas las terminales
```

#### **Paso 2: Limpiar Todo**

```powershell
# Navegar al proyecto
cd C:\xampp\htdocs\PrimeroDeJunio\website

# Eliminar dependencias
Remove-Item -Recurse -Force node_modules
Remove-Item package-lock.json

# Limpiar caché npm
npm cache clean --force
```

#### **Paso 3: Reinstalar Todo**

```powershell
# Reinstalar dependencias
npm install

# Verificar instalación
npm list
```

#### **Paso 4: Reiniciar Servicios**

```powershell
# Reiniciar XAMPP completamente
# Iniciar Apache y MySQL
# Verificar http://localhost/
```

#### **Paso 5: Probar Proyecto**

```powershell
# Iniciar desarrollo
.\iniciar-desarrollo.ps1

# O manualmente
cd website
npm run dev
```

---

## 🔍 Herramientas de Diagnóstico

### **📊 Comandos Útiles para Diagnóstico**

```powershell
# Ver procesos que usan puertos
netstat -ano | findstr :80
netstat -ano | findstr :3306
netstat -ano | findstr :3000

# Ver servicios en ejecución
services.msc

# Información del sistema
systeminfo

# Variables de entorno
echo $env:PATH

# Procesos de Node.js
Get-Process | Where-Object {$_.Name -like "*node*"}

# Procesos de Apache
Get-Process | Where-Object {$_.Name -like "*apache*"}
```

### **🌐 URLs de Verificación**

| URL                                | Debe Mostrar  | Estado |
| ---------------------------------- | ------------- | ------ |
| `http://localhost/`                | Página XAMPP  | ✅ OK  |
| `http://localhost/phpmyadmin/`     | phpMyAdmin    | ✅ OK  |
| `http://localhost/PrimeroDeJunio/` | Login sistema | ✅ OK  |
| `http://localhost:3000/`           | Website React | ✅ OK  |

---

## 📞 Códigos de Error Comunes

### **⚠️ Errores de npm**

| Error             | Causa             | Solución               |
| ----------------- | ----------------- | ---------------------- |
| `ENOTFOUND`       | Sin internet      | Verificar conexión     |
| `EACCES`          | Sin permisos      | Ejecutar como admin    |
| `ENOENT`          | Archivo no existe | Verificar ruta         |
| `ERR_INVALID_URL` | URL malformada    | Verificar package.json |

### **⚠️ Errores de PHP**

| Error                          | Causa               | Solución             |
| ------------------------------ | ------------------- | -------------------- |
| `Fatal error: Class not found` | Archivo no incluido | Verificar autoload   |
| `Access denied for user`       | Credenciales BD     | Verificar config.php |
| `Table doesn't exist`          | BD no creada        | Ejecutar migrations  |
| `Parse error`                  | Sintaxis PHP        | Verificar código     |

### **⚠️ Errores de Base de Datos**

| Error                | Causa              | Solución               |
| -------------------- | ------------------ | ---------------------- |
| `Connection refused` | MySQL apagado      | Iniciar MySQL          |
| `Access denied`      | Usuario incorrecto | Verificar credenciales |
| `Database not found` | BD no existe       | Crear BD manualmente   |
| `Table not found`    | Estructura vacía   | Importar migrations    |

---

## 💡 Tips de Prevención

### **🛡️ Mejores Prácticas:**

1. **Siempre hacer backup** antes de cambios importantes
2. **Usar control de versiones** (Git) para revertir cambios
3. **Verificar logs** en XAMPP cuando algo falla
4. **Mantener dependencias actualizadas** pero probadas
5. **Documentar cambios** de configuración personalizados

### **🔧 Mantenimiento Regular:**

```powershell
# Semanal - Limpiar caché
npm cache clean --force

# Mensual - Actualizar dependencias
npm update

# Trimestral - Verificar seguridad
npm audit
npm audit fix
```

---

## 📚 Recursos Adicionales

### **🔗 Enlaces Útiles:**

- [XAMPP Documentation](https://www.apachefriends.org/docs/)
- [Node.js Troubleshooting](https://nodejs.org/en/docs/guides/)
- [npm Common Issues](https://docs.npmjs.com/troubleshooting)
- [PHP Error Reference](https://www.php.net/manual/en/appendices.php)

### **🎯 Para Más Ayuda:**

1. 📖 **Revisa**: [Comandos Principales](./02-comandos-principales.md)
2. 🏗️ **Entiende**: [Arquitectura del Proyecto](./03-arquitectura-proyecto.md)
3. ⚡ **Optimiza**: [Inicio Rápido](./05-inicio-rapido.md)

---

_🔧 ¡Con estas soluciones deberías poder resolver el 99% de los problemas!_
_🔄 Última actualización: Noviembre 2024_
