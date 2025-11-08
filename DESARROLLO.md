# 🛵 Primero de Junio - Guía de Desarrollo

## 🚀 Inicio Rápido para Desarrollo

### Opción 1: Script Automático (Recomendado)
Simplemente ejecuta el archivo `iniciar-desarrollo.bat` haciendo doble clic en él.

### Opción 2: Línea de Comandos
```bash
# Desde la raíz del proyecto
npm run dev --prefix website
```

### Opción 3: Crear Acceso Directo en Escritorio
1. Abre PowerShell como administrador
2. Ejecuta: `.\crear-acceso-directo.ps1`
3. Usa el acceso directo desde tu escritorio

## 📁 Estructura del Proyecto

```
PrimeroDeJunio/
├── website/                    # Proyecto React principal
│   ├── src/
│   │   ├── pages/
│   │   │   └── Asociacion.jsx # Página de la asociación
│   │   └── ...
│   ├── public/
│   │   └── css/               # Estilos CSS
│   └── package.json
├── iniciar-desarrollo.bat      # Script de inicio automático
├── iniciar-desarrollo.ps1      # Script PowerShell alternativo
└── crear-acceso-directo.ps1    # Crea acceso directo en escritorio
```

## 🎨 Colores del Proyecto

- **Verde Principal**: `#00ff66` (`--primary-green`)
- **Verde Oscuro**: `#22c55e` (`--primary-green-dark`) 
- **Fondo Oscuro**: `#000000` (`--dark-bg`)
- **Fondo Secundario**: `#1a1a1a` (`--dark-secondary`)

## 📝 Notas de Desarrollo

- El servidor se inicia en `http://localhost:3000`
- Los cambios se recargan automáticamente (Hot Reload)
- El navegador se abre automáticamente después de 5 segundos
- Presiona `Ctrl+C` en la terminal para detener el servidor

## 🛠️ Requisitos

- Node.js (versión 16 o superior)
- npm (versión 7 o superior)
- Navegador web moderno

## ⚡ Scripts Disponibles

- `npm run dev` - Inicia el servidor de desarrollo
- `npm run build` - Construye la aplicación para producción
- `npm run preview` - Vista previa de la build de producción
- `npm run lint` - Ejecuta el linter de código

## 🎯 Desarrollo del Proyecto

Este proyecto es para la **Asociación de Mototaxis Primero de Junio**, enfocado en:

- 🛵 Servicios de transporte en mototaxi
- 📚 Capacitación de conductores
- 🏆 Certificaciones profesionales
- 🛡️ Servicios integrales (seguro, mantenimiento, financiamiento)

---

¡Feliz desarrollo! 🚀