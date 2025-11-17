# ⚡ Inicio Rápido

¡Quieres empezar a usar **Primero de Junio** en menos de 5 minutos? ¡Esta guía es para ti!

## 🚀 Para Desarrolladores con Experiencia

### **⏱️ 5 Minutos Setup**

```powershell
# 1. Verificar prerequisitos (30 segundos)
node --version    # Debe ser >=16.0
npm --version     # Debe ser >=7.0
# XAMPP debe estar instalado y corriendo

# 2. Clonar e instalar (2 minutos)
cd C:\xampp\htdocs\
git clone [REPO_URL] PrimeroDeJunio
cd PrimeroDeJunio\website
npm install

# 3. Configurar BD (1 minuto)
.\importar-seeds.ps1

# 4. ¡Iniciar! (1 minuto)
.\iniciar-desarrollo.ps1

# ✅ ¡LISTO! Abre http://localhost:3000
```

---

## 📱 Para Novatos Absolutos

### **⏱️ 15 Minutos Setup Completo**

#### **Paso 1: Descargar Herramientas (5 min)**
1. 📥 [XAMPP](https://www.apachefriends.org/) - Instalar con configuración por defecto
2. 📥 [Node.js LTS](https://nodejs.org/) - Instalar con configuración por defecto
3. 📥 Descargar este proyecto y extraer en `C:\xampp\htdocs\PrimeroDeJunio\`

#### **Paso 2: Iniciar Servicios (2 min)**
1. 🟢 Abrir **XAMPP Control Panel**
2. 🟢 Click **Start** en Apache
3. 🟢 Click **Start** en MySQL
4. ✅ Verificar que estén en verde

#### **Paso 3: Configurar Proyecto (5 min)**
```powershell
# Abrir PowerShell como administrador
cd C:\xampp\htdocs\PrimeroDeJunio

# Instalar dependencias
cd website
npm install

# Volver a la raíz e importar base de datos
cd ..
.\importar-seeds.ps1
```

#### **Paso 4: ¡Arrancar! (3 min)**
```powershell
# Desde la raíz del proyecto
.\iniciar-desarrollo.ps1
```

**🎉 ¡Listo! Deberías ver el proyecto corriendo en tu navegador!**

---

## 📋 Checklist Ultra Rápido

### **✅ Antes de empezar, verifica:**
```bash
□ XAMPP instalado
□ Node.js instalado (node --version)
□ Apache corriendo (verde en XAMPP)
□ MySQL corriendo (verde en XAMPP)
□ Proyecto en C:\xampp\htdocs\PrimeroDeJunio\
```

### **✅ Comandos esenciales:**
```bash
□ npm install (en /website/)
□ .\importar-seeds.ps1 (en raíz)
□ .\iniciar-desarrollo.ps1 (en raíz)
```

### **✅ URLs que deben funcionar:**
```bash
□ http://localhost/ (XAMPP)
□ http://localhost/PrimeroDeJunio/ (Backend)
□ http://localhost:3000/ (Frontend)
```

---

## 🎯 Comandos de Un Solo Click

### **🖱️ Crear Acceso Directo**
```powershell
# Ejecutar una sola vez para crear shortcut en escritorio
.\crear-acceso-directo.ps1
```
**Resultado**: Doble click en escritorio → proyecto iniciado automáticamente

### **🔄 Reinicio Completo**
```powershell
# Si algo va mal, reset everything:
.\importar-seeds.ps1    # Resetear base de datos
.\iniciar-desarrollo.ps1 # Reiniciar proyecto
```

### **📊 Estado del Sistema**
```powershell
# Ver todo de un vistazo
Get-Service | Where-Object {$_.Name -like "*apache*" -or $_.Name -like "*mysql*"}
netstat -ano | findstr ":80\|:3306\|:3000"
```

---

## ⚡ Workflow Diario Optimizado

### **🌅 Al Empezar el Día:**
```powershell
# 1. Verificar XAMPP (5 segundos)
# Apache y MySQL deben estar verdes

# 2. Iniciar proyecto (10 segundos)
cd C:\xampp\htdocs\PrimeroDeJunio
.\iniciar-desarrollo.ps1

# 3. Abrir editor (5 segundos)
code .
```
**⏱️ Total: 20 segundos para estar desarrollando**

### **🌙 Al Terminar el Día:**
```powershell
# 1. Detener servidor de desarrollo
# Ctrl+C en terminal

# 2. Guardar cambios (si usas Git)
git add .
git commit -m "Trabajo del día"
git push

# 3. Opcional: Detener XAMPP
# Stop Apache y MySQL si no los necesitas
```

---

## 🎛️ Configuración de Desarrollo Optimizada

### **⚙️ VS Code Extensions Recomendadas:**
```bash
# Instalar automáticamente
code --install-extension ms-vscode.vscode-typescript-next
code --install-extension bradlc.vscode-tailwindcss
code --install-extension ms-php.php
code --install-extension formulahendry.auto-rename-tag
```

### **🔧 Configuración del Editor:**
```json
// .vscode/settings.json
{
  "php.validate.executablePath": "C:/xampp/php/php.exe",
  "emmet.includeLanguages": {
    "javascript": "javascriptreact"
  },
  "editor.formatOnSave": true,
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": true
  }
}
```

---

## 🚀 Trucos para Desarrollo Rápido

### **📱 Live Reload Automático**
El proyecto ya está configurado para recarga automática:
- ✅ **Frontend**: Se recarga automáticamente al guardar
- ✅ **Network Access**: Accesible desde teléfono con tu IP local

### **🔍 Debug Rápido**
```bash
# Frontend - Abrir DevTools
F12 en el navegador

# Backend - Ver logs de PHP
# XAMPP Control Panel > Apache > Logs

# Base de Datos - Acceso directo
http://localhost/phpmyadmin/
```

### **⚡ Comandos de Un Liner**
```powershell
# Reinstalar todo desde cero
cd website; Remove-Item -Recurse -Force node_modules; npm install; cd ..; .\iniciar-desarrollo.ps1

# Reset completo de BD y reinicio
.\importar-seeds.ps1; .\iniciar-desarrollo.ps1

# Abrir todo lo necesario de una vez
start http://localhost:3000; start http://localhost/PrimeroDeJunio; start http://localhost/phpmyadmin; code .
```

---

## 📊 Panel de Control Rápido

### **🎛️ URLs de Control:**
| Servicio | URL | Propósito |
|----------|-----|-----------|
| **Frontend** | http://localhost:3000 | Desarrollo React |
| **Backend** | http://localhost/PrimeroDeJunio | Sistema PHP |
| **Base de Datos** | http://localhost/phpmyadmin | Administrar BD |
| **XAMPP** | http://localhost | Estado de servicios |

### **⌨️ Atajos de Teclado:**
| Atajo | Función |
|-------|---------|
| `Ctrl + C` | Detener servidor |
| `Ctrl + Shift + R` | Recarga forzada |
| `F12` | DevTools |
| `Alt + Tab` | Cambiar entre apps |

---

## 🎯 Casos de Uso Rápido

### **🔧 "Solo quiero ver el proyecto"**
```powershell
# Método más rápido (sin instalar dependencias)
cd C:\xampp\htdocs\PrimeroDeJunio
# Solo abrir: http://localhost/PrimeroDeJunio/
```

### **💻 "Quiero desarrollar el frontend"**
```powershell
cd C:\xampp\htdocs\PrimeroDeJunio\website
npm run dev
# Desarrollar en: http://localhost:3000/
```

### **⚙️ "Quiero trabajar en el backend"**
```powershell
# Solo necesitas XAMPP corriendo
# Trabajar en: http://localhost/PrimeroDeJunio/
# Editar archivos en: system/
```

### **🗄️ "Solo quiero administrar la base de datos"**
```powershell
# Solo necesitas MySQL corriendo
# Ir a: http://localhost/phpmyadmin/
```

---

## 📚 Recursos de Un Vistazo

### **📖 Documentación:**
- [**📚 Guía Principal**](./README.md) - Índice completo
- [**🚀 Instalación**](./01-instalacion-basica.md) - Setup detallado
- [**💻 Comandos**](./02-comandos-principales.md) - Todos los comandos
- [**🔧 Problemas**](./04-troubleshooting.md) - Solucionar errores

### **🔗 Enlaces Rápidos:**
```bash
# Tecnologías principales
React Docs: https://react.dev/
PHP Manual: https://www.php.net/manual/
MySQL Docs: https://dev.mysql.com/doc/
Vite Guide: https://vitejs.dev/guide/
```

---

## 🎉 ¡Ya Estás Listo!

### **🚀 Si llegaste hasta aquí:**
✅ **Tu entorno está configurado**
✅ **Conoces los comandos básicos**  
✅ **Sabes dónde buscar ayuda**
✅ **Puedes empezar a desarrollar**

### **🔮 Próximos Pasos Recomendados:**
1. **Explora el código** - Empieza por `website/src/App.jsx`
2. **Haz un cambio pequeño** - Modifica un texto y ve la recarga automática
3. **Prueba el backend** - Crea un usuario nuevo en el sistema
4. **Lee la documentación** - Profundiza en la [arquitectura](./03-arquitectura-proyecto.md)

### **💪 ¡Ahora a programar!**

---

## 🆘 Ayuda de Emergencia

### **Si nada de esto funciona:**
1. 🔧 **Ve a**: [Solución de Problemas](./04-troubleshooting.md)
2. 📖 **Revisa**: [Instalación Básica](./01-instalacion-basica.md)
3. 📞 **Contacta**: Al equipo de desarrollo

### **Comando de Pánico:**
```powershell
# Reset nuclear - si todo falla
cd C:\xampp\htdocs\PrimeroDeJunio
Remove-Item -Recurse -Force website\node_modules
npm cache clean --force
cd website
npm install
cd ..
.\importar-seeds.ps1
.\iniciar-desarrollo.ps1
```

---

*⚡ ¡En menos de 5 minutos deberías estar desarrollando como un pro!*
*🔄 Última actualización: Noviembre 2024*