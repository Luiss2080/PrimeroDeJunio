# 🏗️ Arquitectura del Proyecto

Esta guía explica cómo está estructurado el proyecto **Primero de Junio** y las tecnologías que utiliza.

## 📁 Estructura General del Proyecto

```
PrimeroDeJunio/
├── 📱 website/              # Frontend (React + Vite)
├── ⚙️ system/               # Backend (PHP MVC)
├── 🗄️ database/            # Base de datos (MySQL)
├── 🛠️ scripts/             # Scripts de automatización
└── 📚 docs/                # Documentación
```

---

## 🌐 Frontend - Website (React)

### **📂 Estructura del Website**

```
website/
├── 📦 package.json         # Dependencias y scripts de npm
├── ⚙️ vite.config.js       # Configuración de Vite
├── 🎨 src/                 # Código fuente principal
│   ├── 📄 App.jsx          # Componente principal
│   ├── 🎯 main.jsx         # Punto de entrada
│   ├── 💄 index.css        # Estilos globales
│   ├── 📱 layouts/         # Diseños de página
│   ├── 📄 pages/           # Páginas de la aplicación
│   └── 📚 docs/            # Documentación (este archivo)
└── 🌍 public/              # Archivos públicos
    ├── 🖼️ images/          # Imágenes y recursos
    ├── 💄 css/             # Estilos CSS
    └── ⚡ javaScript/       # Scripts adicionales
```

### **🔧 Tecnologías del Frontend**

- **React** `^18.2.0` - Framework de interfaz de usuario
- **Vite** `^4.4.5` - Herramienta de construcción moderna
- **React Router** `^6.8.1` - Navegación entre páginas
- **Framer Motion** `^10.16.4` - Animaciones fluidas
- **Lucide React** `^0.263.1` - Iconos modernos

### **🎨 Características**

- ⚡ **Ultra rápido**: Vite para desarrollo y construcción
- 📱 **Responsive**: Diseño adaptable a todos los dispositivos
- 🎭 **Animaciones**: Transiciones suaves con Framer Motion
- 🧭 **SPA**: Aplicación de página única con enrutamiento
- 🔄 **Hot Reload**: Recarga automática al hacer cambios

---

## ⚙️ Backend - System (PHP MVC)

### **📂 Estructura del System**

```
system/
├── 🚀 app/                 # Aplicación principal
│   ├── 🔐 auth/            # Autenticación
│   ├── 🎮 controllers/     # Controladores MVC
│   ├── 💎 core/            # Núcleo del framework
│   ├── 🛠️ helpers/         # Funciones auxiliares
│   ├── 📊 models/          # Modelos de datos
│   └── 👁️ views/           # Vistas y plantillas
├── ⚙️ config/              # Configuración del sistema
├── 🗄️ database/           # Base de datos y migraciones
├── 🌍 public/              # Archivos públicos del backend
└── 🛤️ routes/              # Definición de rutas
```

### **🎮 Controladores Principales**

- **AdminController** - Gestión de administradores
- **ClienteController** - Gestión de clientes
- **ConductorController** - Gestión de conductores
- **VehiculoController** - Gestión de vehículos
- **ViajeController** - Gestión de viajes
- **UsuarioController** - Gestión de usuarios
- **DashboardController** - Panel principal
- **ReporteController** - Generación de reportes

### **📊 Modelos de Datos**

- **Usuario** - Usuarios del sistema
- **Conductor** - Conductores de mototaxis
- **Cliente** - Clientes de la asociación
- **Vehiculo** - Vehículos (mototaxis)
- **Viaje** - Registro de viajes
- **Tarifa** - Configuración de tarifas
- **PagoTarifaDiaria** - Pagos diarios

### **💎 Núcleo del Framework**

- **Router** - Manejo de rutas
- **Controller** - Clase base de controladores
- **Model** - Clase base de modelos
- **View** - Motor de plantillas
- **Database** - Conexión y queries
- **Auth** - Sistema de autenticación

---

## 🗄️ Base de Datos (MySQL)

### **📊 Estructura de la Base de Datos**

```sql
primero_de_junio/
├── 👤 usuarios             # Usuarios del sistema
├── 👥 roles                # Roles y permisos
├── 🏍️ conductores          # Información de conductores
├── 🚗 vehiculos            # Vehículos registrados
├── 👥 clientes             # Clientes de la asociación
├── 💰 tarifas              # Configuración de tarifas
├── 🛣️ viajes               # Registro de viajes
├── 🔧 asignaciones_vehiculo # Asignación conductor-vehículo
├── 🛠️ mantenimientos       # Mantenimiento de vehículos
├── ⚙️ configuraciones      # Configuraciones del sistema
├── 📋 logs                 # Logs del sistema
└── 💵 pagos_tarifa_diaria  # Pagos diarios
```

### **🔗 Relaciones Principales**

```
Usuario (1) ──── (N) Conductor
Conductor (1) ──── (N) Vehiculo
Vehiculo (1) ──── (N) Viaje
Cliente (1) ──── (N) Viaje
Conductor (N) ──── (N) Vehiculo (AsignacionVehiculo)
```

### **🗂️ Migraciones Organizadas**

- `000_master_setup.sql` - Configuración inicial
- `001_create_roles.sql` - Creación de roles
- `002_create_usuarios.sql` - Tabla de usuarios
- `003_create_conductores.sql` - Tabla de conductores
- ... (y así sucesivamente)

---

## 🔧 Arquitectura MVC

### **🎯 Patrón Modelo-Vista-Controlador**

#### **📊 Modelo (Model)**

```php
// Ejemplo: models/Usuario.php
class Usuario extends Model {
    protected $table = 'usuarios';

    public function obtenerPorEmail($email) {
        // Lógica de base de datos
    }

    public function crearUsuario($datos) {
        // Crear nuevo usuario
    }
}
```

#### **🎮 Controlador (Controller)**

```php
// Ejemplo: controllers/UsuarioController.php
class UsuarioController extends Controller {
    public function index() {
        $usuarios = $this->model('Usuario')->obtenerTodos();
        $this->view('usuarios/index', compact('usuarios'));
    }

    public function crear() {
        // Lógica para crear usuario
    }
}
```

#### **👁️ Vista (View)**

```php
// Ejemplo: views/usuarios/index.php
<h1>Lista de Usuarios</h1>
<?php foreach ($usuarios as $usuario): ?>
    <div class="usuario-card">
        <h3><?= $usuario['nombre'] ?></h3>
        <p><?= $usuario['email'] ?></p>
    </div>
<?php endforeach; ?>
```

---

## 🌐 Flujo de Datos

### **📱 Frontend a Backend**

```
1. Usuario interactúa con React UI
2. React hace petición HTTP al backend PHP
3. PHP Router dirige a Controller apropiado
4. Controller llama al Model necesario
5. Model consulta la base de datos
6. Respuesta se retorna en JSON
7. React actualiza la interfaz
```

### **⚙️ Dentro del Backend**

```
1. public/index.php (punto de entrada)
2. Router.php (determina ruta)
3. Controller específico (lógica de negocio)
4. Model (interacción con base de datos)
5. View o JSON response (salida)
```

---

## 🛠️ Herramientas de Desarrollo

### **📦 Gestores de Dependencias**

- **npm** - Para dependencias de JavaScript/React
- **Composer** - Para dependencias de PHP (opcional)

### **⚡ Build Tools**

- **Vite** - Construcción y desarrollo del frontend
- **ESLint** - Análisis de código JavaScript
- **Prettier** - Formateo de código (recomendado)

### **🔧 Scripts de Automatización**

- `iniciar-desarrollo.ps1/.bat` - Inicia todo el entorno
- `importar-seeds.ps1/.bat` - Configura la base de datos
- `crear-acceso-directo.ps1` - Crea shortcut de escritorio

---

## 📊 Configuración del Sistema

### **⚙️ Archivos de Configuración Principales**

#### **Frontend (package.json)**

```json
{
  "scripts": {
    "dev": "vite --host 0.0.0.0 --port 3000",
    "build": "vite build",
    "preview": "vite preview"
  },
  "dependencies": {
    "react": "^18.2.0",
    "react-router-dom": "^6.8.1"
  }
}
```

#### **Backend (config/config.php)**

```php
return [
    'app' => [
        'name' => 'PRIMERO DE JUNIO',
        'version' => '1.0.0',
        'environment' => 'development',
        'url' => 'http://localhost/PrimeroDeJunio'
    ],
    'database' => [
        'host' => 'localhost',
        'database' => 'primero_de_junio',
        'username' => 'root',
        'password' => ''
    ]
];
```

---

## 🔐 Seguridad y Autenticación

### **🛡️ Características de Seguridad**

- **Autenticación basada en sesiones** - PHP Sessions
- **Validación de entrada** - Sanitización de datos
- **Control de acceso** - Sistema de roles y permisos
- **Protección CSRF** - Tokens de seguridad
- **Encriptación de contraseñas** - Hashing seguro

### **👥 Sistema de Roles**

```php
// Roles disponibles
- Admin      (acceso completo)
- Operador   (gestión operativa)
- Conductor  (acceso limitado)
- Cliente    (solo consultas)
```

---

## 📱 APIs y Endpoints

### **🌐 Estructura de API REST**

```
GET    /api/usuarios        # Listar usuarios
POST   /api/usuarios        # Crear usuario
GET    /api/usuarios/{id}   # Obtener usuario específico
PUT    /api/usuarios/{id}   # Actualizar usuario
DELETE /api/usuarios/{id}   # Eliminar usuario
```

### **📋 Endpoints Principales**

- `/api/auth/login` - Autenticación
- `/api/conductores` - Gestión de conductores
- `/api/vehiculos` - Gestión de vehículos
- `/api/viajes` - Gestión de viajes
- `/api/reportes` - Generación de reportes

---

## 🎯 Principios de Diseño

### **🎨 Frontend**

- **Component-based** - Componentes reutilizables de React
- **Responsive Design** - Adaptable a todos los dispositivos
- **Mobile First** - Diseñado primero para móviles
- **Progressive Enhancement** - Mejoras progresivas

### **⚙️ Backend**

- **MVC Pattern** - Separación clara de responsabilidades
- **RESTful APIs** - Interfaces estándar y predecibles
- **Single Responsibility** - Cada clase tiene un propósito específico
- **DRY Principle** - Don't Repeat Yourself

### **🗄️ Base de Datos**

- **Normalization** - Estructura normalizada
- **Indexing** - Índices para mejor rendimiento
- **Referential Integrity** - Integridad referencial
- **Data Validation** - Validación a nivel de BD

---

## 🚀 Rendimiento y Optimización

### **⚡ Frontend**

- **Code Splitting** - Carga bajo demanda
- **Tree Shaking** - Eliminación de código no utilizado
- **Minification** - Compresión de archivos
- **Caching** - Caché inteligente

### **⚙️ Backend**

- **Database Connection Pooling** - Reutilización de conexiones
- **Query Optimization** - Consultas optimizadas
- **Caching Layer** - Caché de respuestas frecuentes
- **Session Management** - Gestión eficiente de sesiones

---

## 📈 Escalabilidad

### **🔮 Preparado para Crecimiento**

- **Modular Architecture** - Fácil agregar nuevas funciones
- **API-First Design** - Backend desacoplado del frontend
- **Database Design** - Estructura escalable
- **Configuration Management** - Configuración centralizada

### **🔄 Posibles Mejoras Futuras**

- Migration a TypeScript para mayor seguridad de tipos
- Implementación de GraphQL para APIs más eficientes
- Containerization con Docker
- CI/CD pipelines automatizados
- Testing automatizado (Unit, Integration, E2E)

---

## 🎓 Tecnologías y Conceptos Clave

### **📚 Para Aprender Más**

- **React**: [https://react.dev/](https://react.dev/)
- **Vite**: [https://vitejs.dev/](https://vitejs.dev/)
- **PHP**: [https://www.php.net/](https://www.php.net/)
- **MySQL**: [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)
- **MVC Pattern**: Patrón de arquitectura
- **REST APIs**: Diseño de APIs web

### **🔧 Herramientas Recomendadas**

- **VS Code** - Editor de código principal
- **Postman** - Testing de APIs
- **phpMyAdmin** - Administración de base de datos
- **Git** - Control de versiones
- **Chrome DevTools** - Debugging del frontend

---

## 🎯 Próximos Pasos

### Para profundizar en el proyecto:

1. 🔧 **Explora**: [Solución de Problemas](./04-troubleshooting.md)
2. ⚡ **Optimiza**: [Inicio Rápido](./05-inicio-rapido.md)
3. 💻 **Practica**: [Comandos Principales](./02-comandos-principales.md)

---

_🏗️ ¡Con esta arquitectura tienes una base sólida para un sistema completo!_
_🔄 Última actualización: Noviembre 2024_
