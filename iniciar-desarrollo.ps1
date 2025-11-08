# PRIMERO DE JUNIO - Script de Desarrollo PowerShell
# Automatiza el inicio del servidor de desarrollo y abre el navegador

Write-Host "===============================================" -ForegroundColor Green
Write-Host "     PRIMERO DE JUNIO - DESARROLLO WEB" -ForegroundColor Green  
Write-Host "===============================================" -ForegroundColor Green
Write-Host ""

# Obtener la ubicación del script
$scriptPath = Split-Path -Parent $MyInvocation.MyCommand.Path
$websitePath = Join-Path $scriptPath "website"

Write-Host "Cambiando al directorio: $websitePath" -ForegroundColor Yellow

# Verificar que el directorio website existe
if (-not (Test-Path $websitePath)) {
    Write-Host "ERROR: No se encuentra el directorio 'website'" -ForegroundColor Red
    Write-Host "Asegurate de ejecutar este script desde la raiz del proyecto" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

# Cambiar al directorio website
Set-Location $websitePath

# Verificar que package.json existe
if (-not (Test-Path "package.json")) {
    Write-Host "ERROR: No se encuentra package.json en el directorio website" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
    exit 1
}

Write-Host "Directorio actual: $(Get-Location)" -ForegroundColor Cyan
Write-Host ""

# Iniciar proceso en segundo plano para abrir el navegador
Write-Host "Programando apertura del navegador en 5 segundos..." -ForegroundColor Yellow
Start-Job -ScriptBlock {
    Start-Sleep -Seconds 5
    Start-Process "http://localhost:3000"
} | Out-Null

# Ejecutar npm run dev
Write-Host "Ejecutando npm run dev..." -ForegroundColor Green
Write-Host "Presiona Ctrl+C para detener el servidor" -ForegroundColor Yellow
Write-Host ""

try {
    npm run dev
}
catch {
    Write-Host ""
    Write-Host "ERROR: Fallo al iniciar el servidor de desarrollo" -ForegroundColor Red
    Write-Host "Verifica que Node.js y npm esten instalados correctamente" -ForegroundColor Red
    Read-Host "Presiona Enter para salir"
}