# Instalación del Sistema

## Requisitos
- XAMPP 8.2+ con PHP 8.1+
- Composer 2.0+
- Node.js 18+ / npm
- Git

## Instalación Inicial

### 1. Clonar el Repositorio
```bash
git clone [URL_REPO] PrimeroDeJunio
cd PrimeroDeJunio/system
```

### 2. Instalar Dependencias PHP
```bash
composer install
```

### 3. Instalar Dependencias JavaScript
```bash
npm install
```

### 4. Configurar Entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 5. Configuración Base de Datos (.env)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=primero_de_junio
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_spanish_ci
```

### 6. Crear Base de Datos
```sql
-- Conectar a MySQL
mysql -u root -h localhost

-- Crear base de datos
CREATE DATABASE primero_de_junio CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
```

### 7. Ejecutar Migraciones
```bash
# Ejecutar todas las migraciones
php artisan migrate

# Ejecutar seeders (datos iniciales)
php artisan db:seed
```

### 8. Configurar Storage y Cache
```bash
# Crear enlaces simbólicos
php artisan storage:link

# Limpiar caché
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Verificación de Instalación
```bash
# Verificar estado de migraciones
php artisan migrate:status

# Verificar configuración
php artisan config:show database
```