@echo off
echo ==================================================
echo    IMPORTAR SEEDS - Sistema Mototaxi Primero de Junio
echo ==================================================
echo.

REM Configuracion de base de datos
set DB_HOST=localhost
set DB_USER=root
set DB_PASS=
set DB_NAME=primero_de_junio
set MYSQL_PATH="C:\xampp\mysql\bin\mysql.exe"

echo Verificando conexion a la base de datos...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% -e "SELECT 1;" >nul 2>&1
if errorlevel 1 (
    echo ERROR: No se pudo conectar a MySQL
    echo Verifique que XAMPP este ejecutandose
    pause
    exit /b 1
)

echo Conexion establecida correctamente
echo.

echo Importando seeds de datos de prueba...
echo.

echo [1/12] Importando roles y permisos...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\001_create_roles.sql"

echo [2/12] Importando usuarios del sistema...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\002_create_usuarios.sql"

echo [3/12] Importando datos de conductores...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\003_create_conductores.sql"

echo [4/12] Importando datos de vehiculos...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\004_create_vehiculos.sql"

echo [5/12] Importando datos de clientes...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\005_create_clientes.sql"

echo [6/12] Importando estructura de tarifas...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\006_create_tarifas.sql"

echo [7/12] Importando historial de viajes...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\007_create_viajes.sql"

echo [8/12] Importando asignaciones de vehiculos...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\008_create_asignaciones_vehiculo.sql"

echo [9/12] Importando registros de mantenimiento...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\009_create_mantenimientos.sql"

echo [10/12] Importando configuraciones del sistema...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\010_create_configuraciones.sql"

echo [11/12] Importando logs de actividad...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\011_create_logs.sql"

echo [12/12] Importando pagos de tarifa diaria...
%MYSQL_PATH% -h%DB_HOST% -u%DB_USER% -p%DB_PASS% %DB_NAME% < "system\database\seeds\012_create_pagos_tarifa_diaria.sql"

echo.
echo ==================================================
echo            SEEDS IMPORTADOS EXITOSAMENTE
echo ==================================================
echo.
echo Resumen de datos importados:
echo - 4 roles del sistema con permisos detallados
echo - 8 usuarios (admin, operadores, supervisor, conductores)
echo - 10 conductores con perfiles completos
echo - 13 vehiculos con documentacion
echo - 20+ clientes con diferentes tipos
echo - 15+ tarifas del sistema
echo - 50+ viajes historicos y actuales
echo - 20+ asignaciones de vehiculos
echo - 25+ registros de mantenimiento
echo - 70+ configuraciones del sistema
echo - 30+ logs de actividad
echo - 35+ pagos de tarifa diaria
echo.
echo CREDENCIALES DE PRUEBA:
echo - Admin: admin@primero1dejunio.com / mototaxi123
echo - Operador: operador@primero1dejunio.com / mototaxi123  
echo - Supervisor: supervisor@primero1dejunio.com / mototaxi123
echo - Conductor: conductor1@primero1dejunio.com / mototaxi123
echo.
echo El sistema esta listo para pruebas con datos realistas
echo.
pause