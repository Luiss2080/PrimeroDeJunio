# Servidor de Desarrollo

## Iniciar Servidor Laravel

### Método 1: Servidor PHP Integrado
```bash
# Navegar al directorio del sistema
cd system

# Iniciar servidor en puerto 8000
php artisan serve

# Iniciar en puerto específico
php artisan serve --port=8080

# Iniciar en host específico
php artisan serve --host=0.0.0.0 --port=8000
```

### Método 2: Usando XAMPP
```bash
# Iniciar Apache desde XAMPP
# Acceder via: http://localhost/PrimeroDeJunio/system/public
```

## Servidor de Assets (Vite)

### Desarrollo
```bash
# Modo desarrollo (hot reload)
npm run dev

# Modo desarrollo en puerto específico
npm run dev -- --port=5174
```

### Producción
```bash
# Compilar assets para producción
npm run build

# Ver assets compilados
npm run preview
```

## Scripts de Inicio Rápido

### Windows (PowerShell)
```powershell
# Crear archivo start-dev.ps1
# Contenido del archivo:

# Iniciar MySQL (XAMPP)
Start-Process "C:\xampp\mysql_start.bat"

# Iniciar Laravel
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd system; php artisan serve"

# Iniciar Vite
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd system; npm run dev"
```

### Linux/Mac (Bash)
```bash
#!/bin/bash
# Crear archivo start-dev.sh

# Iniciar Laravel en background
cd system && php artisan serve &

# Iniciar Vite en background
npm run dev &

echo "Servidores iniciados:"
echo "Laravel: http://localhost:8000"
echo "Vite: http://localhost:5173"
```

## URLs del Sistema
- **Laravel App**: `http://localhost:8000`
- **Vite Dev Server**: `http://localhost:5173`
- **phpMyAdmin**: `http://localhost/phpmyadmin`

## Comandos Útiles

### Logs en Tiempo Real
```bash
# Ver logs de Laravel
tail -f storage/logs/laravel.log

# Ver logs con filtro
tail -f storage/logs/laravel.log | grep ERROR
```

### Reiniciar Servicios
```bash
# Limpiar todas las cachés
php artisan optimize:clear

# Reiniciar servidor (Ctrl+C y php artisan serve)
```

### Estado del Sistema
```bash
# Ver rutas registradas
php artisan route:list

# Ver comandos disponibles
php artisan list

# Verificar configuración
php artisan about
```