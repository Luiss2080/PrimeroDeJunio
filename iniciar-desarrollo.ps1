# PRIMERO DE JUNIO - Script de Desarrollo PowerShell
# Automatiza el inicio del servidor de desarrollo y abre el navegador

Write-Host "===============================================" -ForegroundColor Green
Write-Host "     PRIMERO DE JUNIO - DESARROLLO WEB" -ForegroundColor Green  
Write-Host "===============================================" -ForegroundColor Green
Write-Host ""

# Función para encontrar puerto libre
function Find-FreePort {
    param(
        [int]$StartPort = 3000,
        [int]$EndPort = 9999
    )
    
    for ($port = $StartPort; $port -le $EndPort; $port++) {
        $connection = Get-NetTCPConnection -LocalPort $port -ErrorAction SilentlyContinue
        if (-not $connection) {
            return $port
        }
    }
    return $null
}

Write-Host "Buscando puertos libres..." -ForegroundColor Yellow

# Buscar puerto libre para Laravel (empezar desde 8000)
$laravelPort = Find-FreePort -StartPort 8000
if ($laravelPort -eq $null) {
    Write-Host "ERROR: No se pudo encontrar un puerto libre para Laravel" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

# Buscar puerto libre para React (empezar desde 3000, evitar el puerto de Laravel)
$reactPort = Find-FreePort -StartPort 3000
if ($reactPort -eq $laravelPort) {
    $reactPort = Find-FreePort -StartPort ($laravelPort + 1)
}
if ($reactPort -eq $null) {
    Write-Host "ERROR: No se pudo encontrar un puerto libre para React" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

Write-Host "   Laravel usara puerto: $laravelPort" -ForegroundColor Green
Write-Host "   React usara puerto: $reactPort" -ForegroundColor Green
Write-Host ""

# Obtener la ubicación del script
$scriptPath = Split-Path -Parent $MyInvocation.MyCommand.Path
$websitePath = Join-Path $scriptPath "website"
$systemPath = Join-Path $scriptPath "system"

Write-Host "Verificando directorios del proyecto..." -ForegroundColor Yellow

# Verificar que el directorio website existe
if (-not (Test-Path $websitePath)) {
    Write-Host "ERROR: No se encuentra el directorio 'website'" -ForegroundColor Red
    Write-Host "Asegurate de ejecutar este script desde la raiz del proyecto" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

# Verificar que el directorio system existe
if (-not (Test-Path $systemPath)) {
    Write-Host "ERROR: No se encuentra el directorio 'system'" -ForegroundColor Red
    Write-Host "Asegurate de ejecutar este script desde la raiz del proyecto" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

# Verificar que package.json existe en website
Set-Location $websitePath
if (-not (Test-Path "package.json")) {
    Write-Host "ERROR: No se encuentra package.json en el directorio website" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

# Verificar que artisan existe en system
Set-Location $systemPath
if (-not (Test-Path "artisan")) {
    Write-Host "ERROR: No se encuentra artisan en el directorio system" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

Write-Host "Verificaciones completadas exitosamente" -ForegroundColor Green
Write-Host ""

# Iniciar Laravel Server en segundo plano
Write-Host "Iniciando servidor Laravel..." -ForegroundColor Cyan

# Crear job con manejo de errores mejorado
$laravelJob = Start-Job -Name "LaravelServer" -ScriptBlock {
    param($systemPath, $port)
    try {
        Set-Location $systemPath
        # Verificar que estamos en el directorio correcto
        if (-not (Test-Path "artisan")) {
            throw "Archivo artisan no encontrado en $systemPath"
        }
        php artisan serve --host=127.0.0.1 --port=$port 2>&1
    }
    catch {
        Write-Error "Error iniciando Laravel: $($_.Exception.Message)"
        return $false
    }
} -ArgumentList $systemPath, $laravelPort

# Esperar un momento para verificar que Laravel inició correctamente
Start-Sleep -Seconds 3

# Verificar que el job está ejecutándose
if ($laravelJob.State -eq "Running") {
    Write-Host "   Laravel ejecutandose en: http://127.0.0.1:$laravelPort" -ForegroundColor Green
    Write-Host "   Login disponible en: http://127.0.0.1:$laravelPort/login" -ForegroundColor Green
} else {
    Write-Host "   ERROR: Laravel no pudo iniciar" -ForegroundColor Red
    $jobOutput = Receive-Job $laravelJob -ErrorAction SilentlyContinue
    Write-Host "   Error: $jobOutput" -ForegroundColor Red
    Stop-Job $laravelJob -ErrorAction SilentlyContinue
    Remove-Job $laravelJob -Force -ErrorAction SilentlyContinue
    Read-Host "Presiona Enter para salir"
    exit 1
}
Write-Host ""

# Cambiar al directorio website para React
Set-Location $websitePath
Write-Host "Directorio actual para React: $(Get-Location)" -ForegroundColor Cyan

# Iniciar proceso en segundo plano para abrir solo React
Write-Host "Programando apertura de React en 8 segundos..." -ForegroundColor Yellow
Start-Job -ScriptBlock {
    param($reactPort)
    Start-Sleep -Seconds 8
    # Abrir solo React
    Start-Process "http://localhost:$reactPort"
} -ArgumentList $reactPort | Out-Null

# Ejecutar npm run dev para React con puerto específico
Write-Host "Iniciando servidor React..." -ForegroundColor Cyan
Write-Host "   React ejecutandose en: http://localhost:$reactPort" -ForegroundColor Green
Write-Host ""
Write-Host "Presiona Ctrl+C para detener ambos servidores" -ForegroundColor Yellow
Write-Host "URLs disponibles:" -ForegroundColor White
Write-Host "   • Website (React): http://localhost:$reactPort" -ForegroundColor White
Write-Host "   • Sistema (Laravel): http://127.0.0.1:$laravelPort/login" -ForegroundColor White
Write-Host ""

try {
    # Para Vite, usar el flag --port directamente
    npm run dev -- --port $reactPort
}
catch {
    Write-Host ""
    Write-Host "ERROR: Fallo al iniciar el servidor de desarrollo de React" -ForegroundColor Red
    Write-Host "Verifica que Node.js y npm esten instalados correctamente" -ForegroundColor Red
}
finally {
    # Detener el job de Laravel al finalizar
    Write-Host ""
    Write-Host "Deteniendo servidor Laravel..." -ForegroundColor Yellow
    Stop-Job $laravelJob -ErrorAction SilentlyContinue
    Remove-Job $laravelJob -Force -ErrorAction SilentlyContinue
    Write-Host "Servidores detenidos" -ForegroundColor Green
    Read-Host "Presiona Enter para salir"
}