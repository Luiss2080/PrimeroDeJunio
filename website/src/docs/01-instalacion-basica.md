# 🚀 Guía de Instalación Básica

Esta guía te llevará paso a paso desde cero hasta tener el programa funcionando en tu computadora.

## 📋 Requisitos Previos

Antes de empezar, necesitas instalar estos programas en tu computadora:

### 1. **XAMPP** (Para PHP y MySQL)
- 🌐 **Descargar**: [https://www.apachefriends.org/](https://www.apachefriends.org/)
- ⚡ **Versión recomendada**: 8.2 o superior
- 📁 **Instalar en**: `C:\xampp\` (ubicación por defecto)

### 2. **Node.js** (Para el frontend)
- 🌐 **Descargar**: [https://nodejs.org/](https://nodejs.org/)
- ⚡ **Versión recomendada**: 18.0 o superior (LTS)
- ✅ **Incluye**: npm (gestor de paquetes)

### 3. **Git** (Opcional pero recomendado)
- 🌐 **Descargar**: [https://git-scm.com/](https://git-scm.com/)
- 📝 **Para**: Control de versiones y clonado de repositorio

### 4. **Editor de Código** (Recomendado)
- 🌐 **Visual Studio Code**: [https://code.visualstudio.com/](https://code.visualstudio.com/)
- 🎨 **Otras opciones**: PhpStorm, Sublime Text, Atom

---

## 📥 Descarga del Proyecto

### Opción 1: Con Git (Recomendado)
```bash
# Abrir terminal en C:\xampp\htdocs\
cd C:\xampp\htdocs\

# Clonar el repositorio
git clone [URL_DEL_REPOSITORIO] PrimeroDeJunio

# Entrar al directorio
cd PrimeroDeJunio
```

### Opción 2: Descarga Manual
1. Descargar el archivo ZIP del proyecto
2. Extraer en `C:\xampp\htdocs\PrimeroDeJunio\`
3. Asegurar que la estructura de carpetas sea correcta

---

## 🔧 Configuración Inicial

### 1. **Configurar XAMPP**

#### Iniciar Servicios
1. Abrir **XAMPP Control Panel**
2. Iniciar **Apache** ✅
3. Iniciar **MySQL** ✅

#### Verificar Instalación
- Abrir navegador y ir a: `http://localhost/`
- Deberías ver la página de bienvenida de XAMPP

### 2. **Configurar Base de Datos**

#### Acceder a phpMyAdmin
1. Ir a: `http://localhost/phpmyadmin/`
2. Crear nueva base de datos llamada: `primero_de_junio`

#### Importar Estructura
```bash
# Navegar al directorio del proyecto
cd C:\xampp\htdocs\PrimeroDeJunio

# Ejecutar script de importación
.\importar-seeds.ps1
```

**O manualmente en phpMyAdmin:**
1. Seleccionar base de datos `primero_de_junio`
2. Ir a pestaña "Importar"
3. Seleccionar archivo: `system/database/create_database.sql`
4. Ejecutar

### 3. **Configurar Backend (PHP)**

#### Verificar Configuración
Editar archivo: `system/config/config.php`

```php
'database' => [
    'host' => 'localhost',
    'port' => '3306',
    'database' => 'primero_de_junio',
    'username' => 'root',
    'password' => '',  // Vacío para XAMPP por defecto
]
```

#### Probar Backend
- Ir a: `http://localhost/PrimeroDeJunio/`
- Deberías ver la página de login del sistema

### 4. **Configurar Frontend (React)**

#### Instalar Dependencias
```bash
# Navegar al directorio del website
cd C:\xampp\htdocs\PrimeroDeJunio\website

# Instalar dependencias de Node.js
npm install
```

#### Verificar Instalación
```bash
# Verificar que Node.js esté instalado
node --version
# Debería mostrar: v18.x.x o superior

# Verificar que npm esté instalado
npm --version
# Debería mostrar: 9.x.x o superior
```

---

## ▶️ Iniciar el Programa

### Método 1: Scripts Automáticos (Recomendado)

#### Para Windows PowerShell:
```powershell
# Desde el directorio raíz del proyecto
.\iniciar-desarrollo.ps1
```

#### Para Windows CMD:
```cmd
# Desde el directorio raíz del proyecto
iniciar-desarrollo.bat
```

### Método 2: Manual

#### Terminal 1 - Backend (XAMPP):
1. Iniciar Apache y MySQL en XAMPP Control Panel
2. Verificar: `http://localhost/PrimeroDeJunio/`

#### Terminal 2 - Frontend (React):
```bash
# Navegar al directorio del frontend
cd C:\xampp\htdocs\PrimeroDeJunio\website

# Iniciar servidor de desarrollo
npm run dev
```

---

## ✅ Verificación Final

### 1. **Backend funcionando**
- 🌐 URL: `http://localhost/PrimeroDeJunio/`
- ✅ **Esperar**: Página de login del sistema
- 📝 **Credenciales de prueba**: 
  - Usuario: `admin`
  - Contraseña: `admin123`

### 2. **Frontend funcionando**
- 🌐 URL: `http://localhost:3000/`
- ✅ **Esperar**: Página principal del website
- 🎨 **Debe verse**: Diseño moderno con React

### 3. **Base de Datos funcionando**
- 🌐 URL: `http://localhost/phpmyadmin/`
- ✅ **Verificar**: Base de datos `primero_de_junio` con tablas creadas

---

## 🎯 ¡Todo Listo!

Si llegaste hasta aquí y todo funciona:

### 🎉 **¡FELICITACIONES!** 
Has configurado exitosamente el proyecto **Primero de Junio**.

### 🔄 **Próximos Pasos:**
1. 📖 Leer: [**Comandos Principales**](./02-comandos-principales.md)
2. 🏗️ Explorar: [**Arquitectura del Proyecto**](./03-arquitectura-proyecto.md)
3. 🔧 Conocer: [**Solución de Problemas**](./04-troubleshooting.md)

---

## 📞 ¿Problemas en la Instalación?

### Errores Comunes:
- **Puerto 80 ocupado**: Cambiar puerto de Apache en XAMPP
- **Node.js no reconocido**: Reiniciar terminal después de instalar
- **Permisos denegados**: Ejecutar terminal como administrador
- **Base de datos no conecta**: Verificar credenciales en config.php

### Para más ayuda:
👉 **Ir a**: [**Solución de Problemas**](./04-troubleshooting.md)

---

*⏰ Tiempo estimado de instalación: 30-60 minutos*
*🔄 Última actualización: Noviembre 2024*