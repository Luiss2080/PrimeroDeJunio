# PRIMERO DE JUNIO - Script de Desarrollo PowerShell
# Automatiza el inicio del servidor de desarrollo y abre el navegador

Write-Host "===============================================" -ForegroundColor Green
Write-Host "     PRIMERO DE JUNIO - DESARROLLO WEB" -ForegroundColor Green  
Write-Host "===============================================" -ForegroundColor Green
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

Write-Host "✅ Verificaciones completadas exitosamente" -ForegroundColor Green
Write-Host ""

# Iniciar Laravel Server en segundo plano
Write-Host "🚀 Iniciando servidor Laravel..." -ForegroundColor Cyan
$laravelJob = Start-Job -ScriptBlock {
    param($systemPath)
    Set-Location $systemPath
    php artisan serve --host=127.0.0.1 --port=8000
} -ArgumentList $systemPath

Write-Host "   → Laravel ejecutándose en: http://127.0.0.1:8000" -ForegroundColor Green
Write-Host "   → Login disponible en: http://127.0.0.1:8000/login" -ForegroundColor Green
Write-Host ""

# Cambiar al directorio website para React

# Cambiar al directorio website para React
Set-Location $websitePath
Write-Host "Directorio actual para React: $(Get-Location)" -ForegroundColor Cyan

# Iniciar procesos en segundo plano para abrir navegadores
Write-Host "🌐 Programando apertura de navegadores en 8 segundos..." -ForegroundColor Yellow
Start-Job -ScriptBlock {
    Start-Sleep -Seconds 8
    # Abrir React
    Start-Process "http://localhost:3000"
    Start-Sleep -Seconds 2
    # Abrir Laravel
    Start-Process "http://127.0.0.1:8000/login"
} | Out-Null

# Ejecutar npm run dev para React
Write-Host "🚀 Iniciando servidor React..." -ForegroundColor Cyan
Write-Host "   → React ejecutándose en: http://localhost:3000" -ForegroundColor Green
Write-Host ""
Write-Host "⚡ Presiona Ctrl+C para detener ambos servidores" -ForegroundColor Yellow
Write-Host "📝 URLs disponibles:" -ForegroundColor White
Write-Host "   • Website (React): http://localhost:3000" -ForegroundColor White
Write-Host "   • Sistema (Laravel): http://127.0.0.1:8000/login" -ForegroundColor White
Write-Host ""

try {
    npm run dev
}
catch {
    Write-Host ""
    Write-Host "ERROR: Fallo al iniciar el servidor de desarrollo de React" -ForegroundColor Red
    Write-Host "Verifica que Node.js y npm esten instalados correctamente" -ForegroundColor Red
}
finally {
    # Detener el job de Laravel al finalizar
    Write-Host ""
    Write-Host "🛑 Deteniendo servidor Laravel..." -ForegroundColor Yellow
    Stop-Job $laravelJob -ErrorAction SilentlyContinue
    Remove-Job $laravelJob -Force -ErrorAction SilentlyContinue
    Write-Host "✅ Servidores detenidos" -ForegroundColor Green
    Read-Host "Presiona Enter para salir"
}