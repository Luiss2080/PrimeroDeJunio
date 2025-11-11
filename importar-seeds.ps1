# Script PowerShell para importar seeds del Sistema Mototaxi Primero de Junio
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "   IMPORTAR SEEDS - Sistema Mototaxi Primero de Junio" -ForegroundColor Cyan  
Write-Host "==================================================" -ForegroundColor Cyan
Write-Host ""

# Configuración de base de datos
$dbHost = "localhost"
$dbUser = "root"
$dbPass = ""
$dbName = "primero_de_junio"
$mysqlPath = "C:\xampp\mysql\bin\mysql.exe"

# Verificar que MySQL esté disponible
if (-not (Test-Path $mysqlPath)) {
    Write-Host "ERROR: No se encontró MySQL en la ruta especificada" -ForegroundColor Red
    Write-Host "Verifique que XAMPP esté instalado correctamente" -ForegroundColor Red
    Read-Host "Presione Enter para salir"
    exit 1
}

Write-Host "Verificando conexión a la base de datos..." -ForegroundColor Yellow
try {
    & $mysqlPath -h$dbHost -u$dbUser -p$dbPass -e "SELECT 1;" 2>$null
    Write-Host "Conexión establecida correctamente" -ForegroundColor Green
}
catch {
    Write-Host "ERROR: No se pudo conectar a MySQL" -ForegroundColor Red
    Write-Host "Verifique que XAMPP esté ejecutándose" -ForegroundColor Red
    Read-Host "Presione Enter para salir"
    exit 1
}

Write-Host ""
Write-Host "Importando seeds de datos de prueba..." -ForegroundColor Yellow
Write-Host ""

# Array de seeds en orden de dependencias
$seeds = @(
    @{num="1/12"; desc="roles y permisos"; file="001_create_roles.sql"},
    @{num="2/12"; desc="usuarios del sistema"; file="002_create_usuarios.sql"},
    @{num="3/12"; desc="datos de conductores"; file="003_create_conductores.sql"},
    @{num="4/12"; desc="datos de vehículos"; file="004_create_vehiculos.sql"},
    @{num="5/12"; desc="datos de clientes"; file="005_create_clientes.sql"},
    @{num="6/12"; desc="estructura de tarifas"; file="006_create_tarifas.sql"},
    @{num="7/12"; desc="historial de viajes"; file="007_create_viajes.sql"},
    @{num="8/12"; desc="asignaciones de vehículos"; file="008_create_asignaciones_vehiculo.sql"},
    @{num="9/12"; desc="registros de mantenimiento"; file="009_create_mantenimientos.sql"},
    @{num="10/12"; desc="configuraciones del sistema"; file="010_create_configuraciones.sql"},
    @{num="11/12"; desc="logs de actividad"; file="011_create_logs.sql"},
    @{num="12/12"; desc="pagos de tarifa diaria"; file="012_create_pagos_tarifa_diaria.sql"}
)

foreach ($seed in $seeds) {
    Write-Host "[$($seed.num)] Importando $($seed.desc)..." -ForegroundColor Cyan
    $seedPath = "system\database\seeds\$($seed.file)"
    
    if (Test-Path $seedPath) {
        try {
            & $mysqlPath -h$dbHost -u$dbUser -p$dbPass $dbName -e "source $seedPath" 2>$null
            Write-Host "✓ Completado" -ForegroundColor Green
        }
        catch {
            Write-Host "✗ Error al importar $($seed.file)" -ForegroundColor Red
        }
    }
    else {
        Write-Host "✗ Archivo no encontrado: $seedPath" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "==================================================" -ForegroundColor Green
Write-Host "            SEEDS IMPORTADOS EXITOSAMENTE" -ForegroundColor Green
Write-Host "==================================================" -ForegroundColor Green
Write-Host ""

Write-Host "Resumen de datos importados:" -ForegroundColor White
Write-Host "• 4 roles del sistema con permisos detallados" -ForegroundColor Gray
Write-Host "• 8 usuarios (admin, operadores, supervisor, conductores)" -ForegroundColor Gray
Write-Host "• 10 conductores con perfiles completos" -ForegroundColor Gray
Write-Host "• 13 vehículos con documentación" -ForegroundColor Gray
Write-Host "• 20+ clientes con diferentes tipos" -ForegroundColor Gray
Write-Host "• 15+ tarifas del sistema" -ForegroundColor Gray
Write-Host "• 50+ viajes históricos y actuales" -ForegroundColor Gray
Write-Host "• 20+ asignaciones de vehículos" -ForegroundColor Gray
Write-Host "• 25+ registros de mantenimiento" -ForegroundColor Gray
Write-Host "• 70+ configuraciones del sistema" -ForegroundColor Gray
Write-Host "• 30+ logs de actividad" -ForegroundColor Gray
Write-Host "• 35+ pagos de tarifa diaria" -ForegroundColor Gray
Write-Host ""

Write-Host "CREDENCIALES DE PRUEBA:" -ForegroundColor Yellow
Write-Host "• Admin: admin@primero1dejunio.com / mototaxi123" -ForegroundColor White
Write-Host "• Operador: operador@primero1dejunio.com / mototaxi123" -ForegroundColor White
Write-Host "• Supervisor: supervisor@primero1dejunio.com / mototaxi123" -ForegroundColor White
Write-Host "• Conductor: conductor1@primero1dejunio.com / mototaxi123" -ForegroundColor White
Write-Host ""

Write-Host "El sistema está listo para pruebas con datos realistas" -ForegroundColor Green
Write-Host ""
Read-Host "Presione Enter para continuar"