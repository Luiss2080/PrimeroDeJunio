# 🛵 Primero de Junio - Asociación de Mototaxis

<div align="center">

![Logo Primero de Junio](website/public/images/logoMoto.jpg)

**Plataforma Integral para la Asociación de Mototaxis Primero de Junio**

[![Estado del Proyecto](https://img.shields.io/badge/Estado-En%20Desarrollo-yellow?style=for-the-badge)](https://github.com/Luiss2080/PrimeroDeJunio)
[![Versión](https://img.shields.io/badge/Versión-1.0.0-blue?style=for-the-badge)](https://github.com/Luiss2080/PrimeroDeJunio)
[![Licencia](https://img.shields.io/badge/Licencia-MIT-green?style=for-the-badge)](LICENSE)

</div>

---

## 🎯 **Descripción del Proyecto**

**Primero de Junio** es una plataforma integral diseñada para modernizar y digitalizar las operaciones de la Asociación de Mototaxis "Primero de Junio". El proyecto combina un **sistema administrativo completo** con un **website institucional moderno**, proporcionando herramientas avanzadas para la gestión operativa y una presencia digital profesional.

### 🌟 **Características Principales**

| 🏢 **Sistema Administrativo** | 🌐 **Website Institucional** |
|---|---|
| ✅ Gestión completa de conductores | ✅ Página principal moderna y responsiva |
| ✅ Control de vehículos y documentación | ✅ Sección de servicios interactiva |
| ✅ Administración de viajes y tarifas | ✅ Información sobre conductores |
| ✅ Sistema de pagos y facturación | ✅ Detalles de la asociación |
| ✅ Dashboard con estadísticas en tiempo real | ✅ Formulario de contacto |
| ✅ Control de roles y permisos | ✅ Animaciones y experiencia de usuario optimizada |

---

## 🚀 **Inicio Rápido**

### 📋 **Prerrequisitos**

```bash
✅ XAMPP (Apache, MySQL, PHP 8.0+)
✅ Node.js (16.0.0+)
✅ NPM (7.0.0+)
✅ PowerShell (Windows)
```

### ⚡ **Instalación en 3 Pasos**

<details>
<summary><strong>🔧 Paso 1: Clonar y Configurar el Proyecto</strong></summary>

```bash
# Clonar el repositorio
git clone https://github.com/Luiss2080/PrimeroDeJunio.git
cd PrimeroDeJunio

# Configurar el sistema backend
# Copiar el proyecto a XAMPP
cp -r . C:\xampp\htdocs\PrimeroDeJunio

# Iniciar XAMPP (Apache y MySQL)
```
</details>

<details>
<summary><strong>🗄️ Paso 2: Base de Datos</strong></summary>

```powershell
# Importar estructura y datos de prueba (PowerShell)
.\importar-seeds.ps1

# O usar el archivo batch
importar-seeds.bat
```

**Credenciales de prueba incluidas:**
- **Admin**: `admin@primero1dejunio.com` / `mototaxi123`
- **Operador**: `operador@primero1dejunio.com` / `mototaxi123`
- **Supervisor**: `supervisor@primero1dejunio.com` / `mototaxi123`
- **Conductor**: `conductor1@primero1dejunio.com` / `mototaxi123`
</details>

<details>
<summary><strong>🌐 Paso 3: Website Frontend</strong></summary>

```bash
# Navegar al directorio del website
cd website

# Instalar dependencias
npm install

# Iniciar servidor de desarrollo
npm run dev
```
</details>

### 🎉 **¡Listo!**

- **Sistema Admin**: `http://localhost/PrimeroDeJunio/system/app/auth/login.php`
- **Website**: `http://localhost:3000`

---

## 🏗️ **Arquitectura del Proyecto**

```
PrimeroDeJunio/
│
├── 🏢 system/                    # Sistema Administrativo (PHP/MySQL)
│   ├── app/
│   │   ├── controllers/          # Controladores MVC
│   │   ├── models/              # Modelos de datos
│   │   ├── views/               # Vistas y templates
│   │   └── auth/                # Sistema de autenticación
│   ├── config/                  # Configuraciones
│   ├── database/                # Migraciones y seeds
│   └── public/                  # Assets públicos
│
├── 🌐 website/                   # Website Institucional (React/Vite)
│   ├── src/
│   │   ├── pages/               # Páginas del website
│   │   ├── layouts/             # Componentes de layout
│   │   └── App.jsx              # Componente principal
│   ├── public/                  # Assets estáticos
│   └── package.json             # Dependencias Node.js
│
└── 📁 scripts/                   # Scripts de automatización
    ├── importar-seeds.ps1       # PowerShell
    └── importar-seeds.bat       # Batch
```

---

## 💼 **Sistema Administrativo**

### 🔧 **Tecnologías Backend**

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| **PHP** | 8.0+ | Lógica del servidor |
| **MySQL** | 8.0+ | Base de datos |
| **Apache** | 2.4+ | Servidor web |
| **JavaScript** | ES6+ | Interactividad frontend |
| **CSS3** | - | Estilos y animaciones |

### 📊 **Módulos del Sistema**

<details>
<summary><strong>👥 Gestión de Usuarios y Roles</strong></summary>

- **4 Roles Definidos**: Administrador, Operador, Supervisor, Conductor
- **Control Granular**: Permisos específicos por funcionalidad
- **Autenticación Segura**: Sistema de login con validación
- **Gestión de Perfiles**: Información completa de usuarios

**Controladores:**
- `UsuarioController.php` - CRUD de usuarios
- `AuthController.php` - Autenticación y autorización
- `PermisoController.php` - Gestión de permisos
</details>

<details>
<summary><strong>🚗 Gestión de Vehículos</strong></summary>

- **Registro Completo**: Información técnica y legal
- **Documentación**: Control de papeles y vencimientos
- **Mantenimientos**: Historial y programación
- **Asignaciones**: Vehículo-Conductor

**Controladores:**
- `VehiculoController.php` - Gestión de vehículos
- **Modelos**: `Vehiculo.php`, `Mantenimiento.php`
</details>

<details>
<summary><strong>👨‍💼 Gestión de Conductores</strong></summary>

- **Perfiles Completos**: Datos personales y profesionales
- **Licencias**: Control y renovación
- **Historial**: Viajes y desempeño
- **Estados**: Activo, Inactivo, En entrenamiento

**Controladores:**
- `ConductorController.php` - Gestión de conductores
- **Modelos**: `Conductor.php`, `Usuario.php`
</details>

<details>
<summary><strong>🧾 Sistema de Viajes y Tarifas</strong></summary>

- **Gestión de Viajes**: Registro completo de servicios
- **Tarifas Dinámicas**: Múltiples tipos de tarifa
- **Facturación**: Generación automática
- **Reportes**: Estadísticas detalladas

**Controladores:**
- `ViajeController.php` - Gestión de viajes
- `PagoTarifaDiariaController.php` - Control de pagos
- **Modelos**: `Viaje.php`, `Tarifa.php`, `PagoTarifaDiaria.php`
</details>

<details>
<summary><strong>👥 Gestión de Clientes</strong></summary>

- **Base de Datos**: Clientes frecuentes y ocasionales
- **Historial**: Viajes y preferencias
- **Tipos**: Categorización por uso

**Controladores:**
- `ClienteController.php` - Gestión de clientes
- **Modelos**: `Cliente.php`
</details>

<details>
<summary><strong>📊 Dashboard y Reportes</strong></summary>

- **Métricas en Tiempo Real**: Ingresos, viajes, conductores activos
- **Gráficos Interactivos**: Visualización de datos
- **Reportes Personalizables**: Filtros por fecha, conductor, etc.
- **Exportación**: PDF, Excel

**Controladores:**
- `DashboardController.php` - Métricas y estadísticas
- `AdminController.php` - Funciones administrativas
</details>

### 🗄️ **Base de Datos**

**12 Tablas Principales con Seeds Completos:**

| Tabla | Registros de Prueba | Descripción |
|-------|---------------------|-------------|
| `roles` | 4 roles | Sistema de permisos |
| `usuarios` | 8 usuarios | Cuentas del sistema |
| `conductores` | 10 conductores | Perfiles de conductores |
| `vehiculos` | 13 vehículos | Flota de mototaxis |
| `clientes` | 20+ clientes | Base de clientes |
| `tarifas` | 15+ tarifas | Sistema de precios |
| `viajes` | 50+ viajes | Historial de servicios |
| `asignaciones_vehiculo` | 20+ asignaciones | Vehículo-Conductor |
| `mantenimientos` | 25+ registros | Historial de mantenimiento |
| `configuraciones` | 70+ configuraciones | Parámetros del sistema |
| `logs` | 30+ logs | Registro de actividad |
| `pagos_tarifa_diaria` | 35+ pagos | Control de pagos |

---

## 🌐 **Website Institucional**

### ⚛️ **Tecnologías Frontend**

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| **React** | 18.2.0 | Librería de componentes |
| **Vite** | 4.4.5 | Build tool y dev server |
| **React Router DOM** | 6.8.1 | Navegación SPA |
| **Framer Motion** | 10.16.4 | Animaciones |
| **Lucide React** | 0.263.1 | Iconografía |

### 📄 **Páginas del Website**

<details>
<summary><strong>🏠 Página Principal (Home)</strong></summary>

**Características:**
- Hero section con animaciones
- Carrusel de texto dinámico
- Estadísticas de la asociación
- Testimonios de conductores
- Call-to-action prominente

**Archivos:**
- `src/pages/Home.jsx`
- `public/css/home.css`
- `public/javaScript/home.js`
</details>

<details>
<summary><strong>🛵 Servicios</strong></summary>

**Características:**
- Catálogo de servicios interactivo
- Filtros por categoría
- Cursos y capacitaciones
- Información detallada de cada servicio
- Sistema de inscripción

**Archivos:**
- `src/pages/Servicios.jsx`
- `public/css/servicios.css`
- `public/javaScript/servicios.js`
</details>

<details>
<summary><strong>👨‍💼 Conductores</strong></summary>

**Características:**
- Información para aspirantes
- Requisitos y beneficios
- Proceso de afiliación
- Testimonios de conductores activos
- Formulario de contacto

**Archivos:**
- `src/pages/Conductores.jsx`
- Assets específicos
</details>

<details>
<summary><strong>🏢 Asociación</strong></summary>

**Características:**
- Historia de la asociación
- Misión y visión
- Estructura organizacional
- Certificaciones
- Instructores

**Archivos:**
- `src/pages/Asociacion.jsx`
- Tabs interactivos
- Carrusel de testimonios
</details>

<details>
<summary><strong>ℹ️ Nosotros</strong></summary>

**Características:**
- Información institucional
- Valores y principios
- Equipo directivo
- Logros y reconocimientos

**Archivos:**
- `src/pages/Nosotros.jsx`
- Contenido dinámico
</details>

<details>
<summary><strong>📞 Contacto</strong></summary>

**Características:**
- Formulario de contacto funcional
- Información de ubicación
- Horarios de atención
- Enlaces a redes sociales
- Mapa interactivo

**Archivos:**
- `src/pages/Contacto.jsx`
- Validación de formularios
</details>

### 🎨 **Características de UX/UI**

- **Diseño Responsivo**: Compatible con móviles, tablets y desktop
- **Animaciones Fluidas**: Transiciones suaves entre páginas
- **Carga Optimizada**: Lazy loading de assets
- **SEO Friendly**: Meta tags y estructura semántica
- **Accesibilidad**: Cumple estándares de accesibilidad web

---

## 🛠️ **Scripts de Automatización**

### 📦 **Scripts Disponibles**

| Script | Plataforma | Función |
|--------|------------|---------|
| `importar-seeds.ps1` | PowerShell | Importar datos de prueba |
| `importar-seeds.bat` | Windows Batch | Importar datos de prueba |
| `iniciar-desarrollo.ps1` | PowerShell | Iniciar entorno completo |
| `iniciar-desarrollo.bat` | Windows Batch | Iniciar entorno completo |
| `crear-acceso-directo.ps1` | PowerShell | Crear shortcuts del proyecto |

### 🎯 **Scripts del Website (NPM)**

```bash
npm run dev      # Servidor de desarrollo (localhost:3000)
npm run build    # Build de producción
npm run preview  # Vista previa de build
npm run lint     # Validación de código
```

---

## 🎨 **Paleta de Colores**

```css
/* Colores Principales */
--primero-junio-primary: #FF6B35;    /* Naranja vibrante */
--primero-junio-secondary: #2E86AB;  /* Azul profesional */
--primero-junio-accent: #F18F01;     /* Amarillo/Naranja */
--primero-junio-dark: #1A1A1A;       /* Negro profundo */
--primero-junio-light: #F8F9FA;      /* Blanco suave */

/* Colores de Estado */
--success: #28A745;                   /* Verde éxito */
--warning: #FFC107;                   /* Amarillo advertencia */
--danger: #DC3545;                    /* Rojo peligro */
--info: #17A2B8;                      /* Azul información */
```

---

## 📊 **Métricas del Proyecto**

<div align="center">

| 📈 **Estadística** | 📊 **Valor** |
|---|---|
| **Total de Archivos** | 100+ archivos |
| **Líneas de Código** | 15,000+ líneas |
| **Componentes React** | 25+ componentes |
| **Controladores PHP** | 12 controladores |
| **Modelos de Datos** | 11 modelos |
| **Tablas de BD** | 12 tablas |
| **Seeds de Prueba** | 300+ registros |
| **Scripts Automatizados** | 5 scripts |

</div>

---

## 🚀 **Roadmap de Desarrollo**

### ✅ **Completado**
- [x] Sistema de autenticación completo
- [x] Gestión de usuarios y roles
- [x] CRUD completo de todas las entidades
- [x] Dashboard con métricas
- [x] Website institucional responsive
- [x] Sistema de navegación SPA
- [x] Base de datos con seeds completos
- [x] Scripts de automatización

### 🔄 **En Desarrollo**
- [ ] Sistema de notificaciones push
- [ ] Integración con APIs de pago
- [ ] Módulo de reportes avanzados
- [ ] App móvil para conductores
- [ ] Sistema de GPS en tiempo real

### 📋 **Planificado**
- [ ] Integración con WhatsApp Business API
- [ ] Sistema de rating y reviews
- [ ] Módulo de facturación electrónica
- [ ] Dashboard para conductores
- [ ] Sistema de backup automático

---

## 🤝 **Contribución**

### 📝 **Guía de Contribución**

1. **Fork** del repositorio
2. **Crear** una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. **Commit** tus cambios (`git commit -m 'Añadir nueva funcionalidad'`)
4. **Push** a la rama (`git push origin feature/nueva-funcionalidad`)
5. **Crear** un Pull Request

### 🔍 **Estándares de Código**

- **PHP**: PSR-12 para PHP, comentarios en español
- **JavaScript**: ES6+, camelCase, JSDoc para funciones importantes
- **CSS**: BEM methodology, Mobile-first
- **Commits**: Conventional Commits en español

---

## 🆘 **Soporte y Documentación**

### 📚 **Documentación Adicional**
- [`DESARROLLO.md`](DESARROLLO.md) - Guía detallada de desarrollo
- [`system/database/seeds/README_SEEDS.md`](system/database/seeds/README_SEEDS.md) - Documentación de datos de prueba

### 🐛 **Reportar Problemas**
- **Issues**: [GitHub Issues](https://github.com/Luiss2080/PrimeroDeJunio/issues)
- **Email**: soporte@primero1dejunio.com
- **WhatsApp**: +591 XXXXXXXX

### 💬 **Comunidad**
- **Discord**: [Servidor de Discord](https://discord.gg/primero1dejunio)
- **Facebook**: [@PrimeroDeJunioBo](https://facebook.com/PrimeroDeJunioBo)
- **Instagram**: [@primero1dejunio](https://instagram.com/primero1dejunio)

---

## 📄 **Licencia**

Este proyecto está bajo la Licencia MIT. Ver [`LICENSE`](LICENSE) para más detalles.

---

## 🙏 **Agradecimientos**

- 🛵 **Asociación Primero de Junio** - Por confiar en este proyecto
- 👨‍💻 **Equipo de Desarrollo** - Por la dedicación y profesionalismo
- 🚀 **Comunidad Open Source** - Por las herramientas y librerías utilizadas

---

<div align="center">

**Hecho con ❤️ para la Asociación de Mototaxis Primero de Junio**

[![GitHub](https://img.shields.io/badge/GitHub-Luiss2080-black?style=for-the-badge&logo=github)](https://github.com/Luiss2080)
[![Email](https://img.shields.io/badge/Email-contacto@primero1dejunio.com-red?style=for-the-badge&logo=gmail)](mailto:contacto@primero1dejunio.com)

**© 2024 Primero de Junio - Asociación de Mototaxis. Todos los derechos reservados.**

</div>
