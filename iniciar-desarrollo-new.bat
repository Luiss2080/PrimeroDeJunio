@echo off
echo ===============================================
echo     PRIMERO DE JUNIO - DESARROLLO WEB
echo ===============================================
echo.

echo Buscando puertos libres...

REM Función para encontrar puerto libre empezando desde un puerto base
set LARAVEL_PORT=8000
:find_laravel_port
netstat -an | find ":%LARAVEL_PORT%" >nul
if errorlevel 1 (
    echo    Laravel usara puerto: %LARAVEL_PORT%
    goto :found_laravel_port
) else (
    set /a LARAVEL_PORT+=1
    if %LARAVEL_PORT% GTR 9999 (
        echo ERROR: No se pudo encontrar puerto libre para Laravel
        pause
        exit /b 1
    )
    goto :find_laravel_port
)
:found_laravel_port

set REACT_PORT=3000
:find_react_port
netstat -an | find ":%REACT_PORT%" >nul
if errorlevel 1 (
    echo    React usara puerto: %REACT_PORT%
    goto :found_react_port
) else (
    if %REACT_PORT% EQU %LARAVEL_PORT% (
        set /a REACT_PORT+=1
    )
    set /a REACT_PORT+=1
    if %REACT_PORT% GTR 9999 (
        echo ERROR: No se pudo encontrar puerto libre para React
        pause
        exit /b 1
    )
    goto :find_react_port
)
:found_react_port

echo.

echo Verificando directorios del proyecto...

REM Verificar que el directorio website existe
if not exist "%~dp0website" (
    echo ERROR: No se encuentra el directorio 'website'
    echo Asegurate de ejecutar este script desde la raiz del proyecto
    pause
    exit /b 1
)

REM Verificar que el directorio system existe
if not exist "%~dp0system" (
    echo ERROR: No se encuentra el directorio 'system'
    echo Asegurate de ejecutar este script desde la raiz del proyecto
    pause
    exit /b 1
)

REM Verificar que artisan existe en system
cd /d "%~dp0system"
if not exist "artisan" (
    echo ERROR: No se encuentra artisan en el directorio system
    pause
    exit /b 1
)

echo Verificaciones completadas exitosamente
echo.

echo Iniciando servidor Laravel...
REM Iniciar Laravel en background
start /B "" php artisan serve --host=127.0.0.1 --port=%LARAVEL_PORT%

REM Esperar un poco para que Laravel inicie
timeout /t 3 /nobreak >nul

echo    Laravel ejecutandose en: http://127.0.0.1:%LARAVEL_PORT%
echo    Login disponible en: http://127.0.0.1:%LARAVEL_PORT%/login
echo.

REM Cambiar al directorio website
cd /d "%~dp0website"

echo Programando apertura de navegadores en 8 segundos...
REM Abrir navegadores en background después de 8 segundos
start /B "" timeout /t 8 /nobreak ^&^& start "" "http://localhost:%REACT_PORT%" ^&^& timeout /t 2 /nobreak ^&^& start "" "http://127.0.0.1:%LARAVEL_PORT%/login"

echo Iniciando servidor React...
echo    React ejecutandose en: http://localhost:%REACT_PORT%
echo.
echo Presiona Ctrl+C para detener ambos servidores
echo URLs disponibles:
echo    • Website (React): http://localhost:%REACT_PORT%
echo    • Sistema (Laravel): http://127.0.0.1:%LARAVEL_PORT%/login
echo.

REM Ejecutar React con puerto específico
npm run dev -- --port %REACT_PORT%