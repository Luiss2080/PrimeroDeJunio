# Comandos de Artisan

## Comandos Básicos

### Información del Sistema
```bash
# Ver información general
php artisan about

# Listar todos los comandos
php artisan list

# Ver configuración
php artisan config:show database
php artisan config:show app
```

### Cache y Optimización
```bash
# Limpiar todas las cachés
php artisan optimize:clear

# Limpiar cachés específicas
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Crear cachés de optimización
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Base de Datos

### Migraciones
```bash
# Ejecutar migraciones
php artisan migrate

# Ver estado
php artisan migrate:status

# Rollback
php artisan migrate:rollback
php artisan migrate:rollback --step=3

# Reset completo
php artisan migrate:fresh --seed
```

### Seeders
```bash
# Ejecutar todos
php artisan db:seed

# Ejecutar específico
php artisan db:seed --class=RolesSeeder
```

## Generadores

### Crear Archivos
```bash
# Modelo + Migración
php artisan make:model Producto -m

# Controlador
php artisan make:controller ProductoController
php artisan make:controller ProductoController --resource

# Middleware
php artisan make:middleware AuthAdmin

# Request (validación)
php artisan make:request ProductoRequest

# Seeder
php artisan make:seeder ProductoSeeder

# Factory
php artisan make:factory ProductoFactory

# Test
php artisan make:test ProductoTest
```

## Desarrollo

### Rutas
```bash
# Ver todas las rutas
php artisan route:list

# Filtrar rutas
php artisan route:list --name=api
php artisan route:list --path=admin
```

### Queue (Colas)
```bash
# Procesar colas
php artisan queue:work

# Ver trabajos fallidos
php artisan queue:failed

# Reintentar trabajos
php artisan queue:retry all
```

### Storage
```bash
# Crear enlace simbólico
php artisan storage:link

# Limpiar uploads temporales
php artisan storage:clear-temp
```

## Mantenimiento

### Modo Mantenimiento
```bash
# Activar modo mantenimiento
php artisan down

# Activar con mensaje personalizado
php artisan down --message="Mantenimiento programado"

# Desactivar modo mantenimiento
php artisan up
```

### Logs
```bash
# Ver logs en tiempo real
tail -f storage/logs/laravel.log

# Limpiar logs
> storage/logs/laravel.log
```

## Personalización

### Crear Comando Personalizado
```bash
# Crear comando
php artisan make:command ImportarDatos

# Registrar en app/Console/Kernel.php
protected $commands = [
    Commands\ImportarDatos::class,
];

# Ejecutar comando personalizado
php artisan importar:datos
```

### Scheduling (Tareas Programadas)
```bash
# Ver tareas programadas
php artisan schedule:list

# Ejecutar schedule manualmente
php artisan schedule:run

# Ejecutar en background (Linux/Mac)
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Debugging

### Tinker (Consola Interactiva)
```bash
# Iniciar consola
php artisan tinker

# Ejemplos en Tinker:
>>> User::count()
>>> User::where('estado', 'activo')->get()
>>> DB::table('users')->get()
>>> Cache::put('test', 'value', 60)
```

### Información Útil
```bash
# Ver configuración actual
php artisan env

# Verificar permisos
ls -la storage/
ls -la bootstrap/cache/

# Ver versión de Laravel
php artisan --version
```