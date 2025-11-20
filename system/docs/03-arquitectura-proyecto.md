# Estructura del Sistema

## Arquitectura General

### Directorios Principales
```
PrimeroDeJunio/
├── database/           # SQL original (migrado)
├── system/            # Aplicación Laravel
└── website/           # Frontend (futuro)
```

### Laravel (system/)
```
system/
├── app/
│   ├── Http/Controllers/    # Controladores
│   ├── Models/             # Modelos Eloquent
│   └── Providers/          # Proveedores de servicios
├── database/
│   ├── migrations/         # Migraciones de BD
│   └── seeders/           # Datos iniciales
├── resources/
│   ├── views/             # Plantillas Blade
│   ├── js/               # JavaScript/Vue
│   └── css/              # Estilos
└── routes/               # Definición de rutas
```

## Modelos de Datos

### Entidades Principales
1. **roles** → `Role` model
2. **users** → `User` model  
3. **conductores** → `Conductor` model
4. **vehiculos** → `Vehiculo` model
5. **clientes** → `Cliente` model
6. **tarifas** → `Tarifa` model
7. **viajes** → `Viaje` model

### Relaciones
```php
// User belongsTo Role
User::with('role')

// Conductor belongsTo User  
Conductor::with('user')

// Vehiculo hasMany AsignacionVehiculo
Vehiculo::with('asignaciones')

// Viaje belongsTo Cliente, Conductor, Vehiculo
Viaje::with(['cliente', 'conductor', 'vehiculo'])
```

## Comandos de Desarrollo

### Crear Componentes
```bash
# Crear modelo con migración
php artisan make:model Ejemplo -m

# Crear controlador
php artisan make:controller EjemploController

# Crear controlador con recursos
php artisan make:controller EjemploController --resource

# Crear middleware
php artisan make:middleware EjemploMiddleware

# Crear request (validación)
php artisan make:request EjemploRequest
```

### Generar Claves y Cachés
```bash
# Generar APP_KEY
php artisan key:generate

# Limpiar cachés
php artisan optimize:clear

# Crear caché de configuración
php artisan config:cache
```

## Testing

### Crear Tests
```bash
# Test unitario
php artisan make:test EjemploTest --unit

# Test de feature
php artisan make:test EjemploTest
```

### Ejecutar Tests
```bash
# Todos los tests
php artisan test

# Tests específicos
php artisan test --filter=EjemploTest

# Con coverage
php artisan test --coverage
```

## Assets (Frontend)

### Compilar Assets
```bash
# Desarrollo
npm run dev

# Producción
npm run build

# Watch mode
npm run dev -- --watch
```

### Estructura Frontend
```
resources/
├── js/
│   ├── app.js           # Entry point
│   └── components/      # Vue components
├── css/
│   └── app.css         # Estilos principales
└── views/
    ├── layouts/        # Layouts base
    └── pages/          # Páginas específicas
```