# Base de Datos Laravel

## Acceso a la Base de Datos

### Tinker (Consola Interactiva)
```bash
# Iniciar Tinker
php artisan tinker

# Ejemplos de uso en Tinker:
>>> App\Models\User::count()
>>> App\Models\Role::all()
>>> DB::table('users')->where('estado', 'activo')->count()
>>> User::with('role')->get()
```

### MySQL CLI
```bash
# Conectar directamente
mysql -u root -h localhost

# Usar base de datos
mysql> USE primero_de_junio;

# Ver tablas
mysql> SHOW TABLES;

# Consultas útiles
mysql> SELECT * FROM roles;
mysql> SELECT COUNT(*) FROM users;
```

## Migraciones

### Comandos Básicos
```bash
# Ver estado de migraciones
php artisan migrate:status

# Ejecutar migraciones pendientes
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Revertir varias migraciones
php artisan migrate:rollback --step=3

# Revertir todas las migraciones
php artisan migrate:reset

# Recrear base de datos completa
php artisan migrate:fresh

# Recrear y ejecutar seeders
php artisan migrate:fresh --seed
```

### Crear Nueva Migración
```bash
# Crear tabla
php artisan make:migration create_nueva_tabla --create=nueva_tabla

# Modificar tabla existente
php artisan make:migration add_campo_to_users --table=users

# Eliminar tabla
php artisan make:migration drop_tabla_antigua --table=tabla_antigua
```

## Seeders

### Ejecutar Seeders
```bash
# Ejecutar todos los seeders
php artisan db:seed

# Ejecutar seeder específico
php artisan db:seed --class=RolesSeeder

# Forzar en producción
php artisan db:seed --force
```

### Crear Nuevo Seeder
```bash
# Crear seeder
php artisan make:seeder NuevoSeeder

# Registrar en DatabaseSeeder.php
$this->call([NuevoSeeder::class]);
```

## Consultas Útiles

### Información del Sistema
```sql
-- Contar registros por tabla
SELECT 
  'roles' as tabla, COUNT(*) as registros FROM roles
UNION ALL SELECT 'users', COUNT(*) FROM users
UNION ALL SELECT 'conductores', COUNT(*) FROM conductores
UNION ALL SELECT 'vehiculos', COUNT(*) FROM vehiculos
UNION ALL SELECT 'clientes', COUNT(*) FROM clientes
UNION ALL SELECT 'tarifas', COUNT(*) FROM tarifas
UNION ALL SELECT 'viajes', COUNT(*) FROM viajes;

-- Usuarios por rol
SELECT r.nombre as rol, COUNT(*) as cantidad 
FROM roles r 
LEFT JOIN users u ON r.id = u.rol_id 
GROUP BY r.id 
ORDER BY r.id;

-- Estado de vehículos
SELECT estado, COUNT(*) as cantidad 
FROM vehiculos 
GROUP BY estado;
```

### Consultas de Desarrollo
```sql
-- Ver estructura de tabla
DESCRIBE users;

-- Ver índices
SHOW INDEX FROM users;

-- Ver claves foráneas
SELECT 
  TABLE_NAME,
  COLUMN_NAME,
  CONSTRAINT_NAME,
  REFERENCED_TABLE_NAME,
  REFERENCED_COLUMN_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE REFERENCED_TABLE_SCHEMA = 'primero_de_junio';
```

## Backup y Restore

### Crear Backup
```bash
# Backup completo
mysqldump -u root primero_de_junio > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup solo estructura
mysqldump -u root --no-data primero_de_junio > estructura.sql

# Backup solo datos
mysqldump -u root --no-create-info primero_de_junio > datos.sql
```

### Restaurar Backup
```bash
# Restaurar desde backup
mysql -u root primero_de_junio < backup.sql

# Recrear BD desde cero
mysql -u root -e "DROP DATABASE IF EXISTS primero_de_junio; CREATE DATABASE primero_de_junio CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;"
mysql -u root primero_de_junio < backup.sql
```

## Laravel Telescope (Opcional)

### Instalación
```bash
composer require laravel/telescope
php artisan telescope:install
php artisan migrate
```

### Uso
- Acceder a: `http://localhost:8000/telescope`
- Monitor de queries, jobs, mail, etc.

## Troubleshooting

### Problemas Comunes
```bash
# Error de conexión BD
php artisan config:clear
php artisan cache:clear

# Error de migraciones
php artisan migrate:status
php artisan migrate --force

# Reiniciar BD completa
php artisan migrate:fresh --seed
```