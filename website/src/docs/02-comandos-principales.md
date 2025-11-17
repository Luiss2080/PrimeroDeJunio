# 💻 Comandos Principales

Esta guía contiene todos los comandos que necesitas para trabajar con el proyecto **Primero de Junio**.

## 🚀 Scripts de Inicio

### **Iniciar Todo el Proyecto**

#### Windows PowerShell (Recomendado):

```powershell
# Desde el directorio raíz del proyecto
.\iniciar-desarrollo.ps1
```

#### Windows CMD:

```cmd
# Desde el directorio raíz del proyecto
iniciar-desarrollo.bat
```

**¿Qué hace este comando?**

- ✅ Inicia el servidor de desarrollo del frontend (React)
- 🌐 Abre automáticamente el navegador en `http://localhost:3000`
- 📱 Permite acceso desde otros dispositivos en la red
- 🔄 Recarga automáticamente al hacer cambios en el código

---

## 🗄️ Comandos de Base de Datos

### **Importar Base de Datos Completa**

#### PowerShell:

```powershell
# Desde el directorio raíz del proyecto
.\importar-seeds.ps1
```

#### CMD:

```cmd
# Desde el directorio raíz del proyecto
importar-seeds.bat
```

**¿Qué hace este comando?**

- 🗃️ Crea la base de datos desde cero
- 📊 Importa todas las tablas necesarias
- 🎯 Inserta datos de ejemplo para pruebas
- 👤 Crea usuarios de prueba

### **Acceso Directo a Base de Datos**

```bash
# Acceder a phpMyAdmin
# URL: http://localhost/phpmyadmin/
```

---

## ⚛️ Comandos del Frontend (React)

### **Navegar al Frontend**

```bash
cd C:\xampp\htdocs\PrimeroDeJunio\website
```

### **Instalar/Actualizar Dependencias**

```bash
# Instalar todas las dependencias
npm install

# Instalar una dependencia específica
npm install nombre-paquete

# Instalar dependencia de desarrollo
npm install --save-dev nombre-paquete
```

### **Comandos de Desarrollo**

```bash
# Iniciar servidor de desarrollo (modo desarrollo)
npm run dev

# Iniciar servidor (alternativo)
npm start

# Construir para producción
npm run build

# Previsualizar build de producción
npm run preview

# Ejecutar linter (revisar código)
npm run lint
```

### **Información Útil**

```bash
# Ver dependencias instaladas
npm list

# Ver dependencias desactualizadas
npm outdated

# Verificar vulnerabilidades
npm audit

# Arreglar vulnerabilidades automáticamente
npm audit fix
```

---

## 🐘 Comandos del Backend (PHP)

### **XAMPP Control Panel**

```bash
# Iniciar Apache
# GUI: XAMPP Control Panel > Start Apache

# Iniciar MySQL
# GUI: XAMPP Control Panel > Start MySQL

# Ver logs de Apache
# GUI: XAMPP Control Panel > Apache > Logs

# Ver logs de MySQL
# GUI: XAMPP Control Panel > MySQL > Logs
```

### **Acceso al Sistema**

```bash
# URL del backend
http://localhost/PrimeroDeJunio/

# Panel de administración
http://localhost/PrimeroDeJunio/login.php
```

---

## 🛠️ Comandos de Desarrollo

### **Git (Control de Versiones)**

```bash
# Ver estado actual
git status

# Agregar archivos al staging
git add .

# Hacer commit
git commit -m "Descripción del cambio"

# Ver historial de commits
git log

# Ver ramas disponibles
git branch

# Cambiar de rama
git checkout nombre-rama

# Crear nueva rama
git checkout -b nueva-rama

# Actualizar desde repositorio remoto
git pull

# Subir cambios
git push
```

### **Composer (Para PHP)**

```bash
# Navegar al directorio del sistema
cd C:\xampp\htdocs\PrimeroDeJunio\system

# Instalar dependencias de PHP
composer install

# Actualizar dependencias
composer update
```

---

## 🔧 Comandos de Utilidades

### **Crear Acceso Directo**

```powershell
# Desde el directorio raíz del proyecto
.\crear-acceso-directo.ps1
```

**¿Qué hace?**

- 🖱️ Crea acceso directo en el escritorio
- ⚡ Permite iniciar el proyecto con doble clic
- 🎯 Ejecuta automáticamente el script de desarrollo

### **Node.js y npm**

```bash
# Verificar versión de Node.js
node --version

# Verificar versión de npm
npm --version

# Limpiar caché de npm
npm cache clean --force

# Verificar configuración global de npm
npm config list
```

### **PHP**

```bash
# Verificar versión de PHP (desde XAMPP)
C:\xampp\php\php.exe --version

# Verificar configuración de PHP
C:\xampp\php\php.exe --info
```

---

## 📱 Comandos de Red

### **Acceso desde Otros Dispositivos**

El servidor de desarrollo está configurado para aceptar conexiones desde la red local:

```bash
# El frontend estará disponible en:
http://[TU_IP]:3000

# Para encontrar tu IP:
ipconfig
# Buscar "IPv4 Address" en la interfaz de red activa
```

### **URLs de Acceso Rápido**

```bash
# Frontend (React)
http://localhost:3000

# Backend (PHP)
http://localhost/PrimeroDeJunio

# Base de Datos (phpMyAdmin)
http://localhost/phpmyadmin

# XAMPP Dashboard
http://localhost
```

---

## 🎯 Comandos por Escenario

### **🔄 Desarrollo Diario**

```bash
# 1. Asegurar que XAMPP esté corriendo
# 2. Navegar al proyecto
cd C:\xampp\htdocs\PrimeroDeJunio

# 3. Iniciar desarrollo
.\iniciar-desarrollo.ps1

# 4. Abrir editor de código
code .
```

### **🚀 Despliegue a Producción**

```bash
# 1. Construir frontend
cd website
npm run build

# 2. Verificar que no hay errores
npm run lint

# 3. Hacer commit de cambios
git add .
git commit -m "Build para producción"
git push
```

### **🔧 Resolver Problemas**

```bash
# 1. Limpiar caché de npm
npm cache clean --force

# 2. Reinstalar dependencias
rm -rf node_modules package-lock.json
npm install

# 3. Verificar servicios XAMPP
# Reiniciar Apache y MySQL desde el panel de control

# 4. Verificar logs
# Ver logs en XAMPP Control Panel
```

### **📦 Actualizar Dependencias**

```bash
# Frontend
cd website
npm update

# Backend (si usa Composer)
cd ../system
composer update
```

---

## 🆘 Comandos de Emergencia

### **🚨 Si Nada Funciona**

```bash
# 1. Detener todos los procesos
# Cerrar terminales y navegadores

# 2. Reiniciar XAMPP
# Detener Apache y MySQL, luego iniciar de nuevo

# 3. Limpiar todo y reinstalar
cd C:\xampp\htdocs\PrimeroDeJunio\website
rm -rf node_modules
npm install
.\iniciar-desarrollo.ps1
```

### **🔍 Verificar Estado del Sistema**

```bash
# Verificar que Node.js funciona
node --version

# Verificar que npm funciona
npm --version

# Verificar que XAMPP funciona
# Ir a http://localhost

# Verificar que el proyecto existe
dir C:\xampp\htdocs\PrimeroDeJunio
```

---

## 📋 Lista de Comandos Frecuentes

| Comando                    | Descripción               | Ubicación       |
| -------------------------- | ------------------------- | --------------- |
| `.\iniciar-desarrollo.ps1` | Iniciar todo el proyecto  | Directorio raíz |
| `npm run dev`              | Solo frontend             | `/website/`     |
| `npm install`              | Instalar dependencias     | `/website/`     |
| `.\importar-seeds.ps1`     | Reiniciar base de datos   | Directorio raíz |
| `git status`               | Ver estado de Git         | Cualquier lugar |
| `npm run build`            | Construir para producción | `/website/`     |

---

## 💡 Tips Útiles

### **⌨️ Atajos de Teclado**

- `Ctrl + C` - Detener servidor en terminal
- `Ctrl + Shift + R` - Recarga forzada del navegador
- `F12` - Abrir herramientas de desarrollador

### **📂 Navegación Rápida**

```bash
# Ir al directorio del proyecto
cd C:\xampp\htdocs\PrimeroDeJunio

# Ir al frontend
cd website

# Ir al backend
cd system

# Regresar al directorio padre
cd ..
```

---

## 🔄 Próximos Pasos

### Después de dominar estos comandos:

1. 🏗️ **Explora**: [Arquitectura del Proyecto](./03-arquitectura-proyecto.md)
2. 🔧 **Prepárate**: [Solución de Problemas](./04-troubleshooting.md)
3. ⚡ **Optimiza**: [Inicio Rápido](./05-inicio-rapido.md)

---

_💪 ¡Con estos comandos ya puedes trabajar como un desarrollador profesional!_
_🔄 Última actualización: Noviembre 2024_
