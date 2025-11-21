@echo off
echo ===============================================
echo     PRIMERO DE JUNIO - DESARROLLO WEB
echo ===============================================
echo.
echo Verificando directorios del proyecto...
echo.

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

REM Verificar que package.json existe en website
cd /d "%~dp0website"
if not exist "package.json" (
    echo ERROR: No se encuentra package.json en el directorio website
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

echo ✓ Verificaciones completadas exitosamente
echo.

REM Iniciar Laravel Server en segundo plano
echo 🚀 Iniciando servidor Laravel...
start "Laravel Server" cmd /c "cd /d \"%~dp0system\" && php artisan serve --host=127.0.0.1 --port=8000"
echo    → Laravel ejecutandose en: http://127.0.0.1:8000
echo    → Login disponible en: http://127.0.0.1:8000/login
echo.

REM Cambiar al directorio website para React
cd /d "%~dp0website"
echo Directorio actual para React: %CD%

REM Abrir navegadores en segundo plano (esperar 8 segundos para que ambos servidores inicien)
echo 🌐 Programando apertura de navegadores en 8 segundos...
start "" cmd /c "timeout /t 8 /nobreak > nul && start http://localhost:3000 && timeout /t 2 /nobreak > nul && start http://127.0.0.1:8000/login"

REM Ejecutar el servidor de desarrollo React
echo 🚀 Iniciando servidor React...
echo    → React ejecutandose en: http://localhost:3000
echo.
echo ⚡ Presiona Ctrl+C para detener ambos servidores
echo 📝 URLs disponibles:
echo    • Website (React): http://localhost:3000
echo    • Sistema (Laravel): http://127.0.0.1:8000/login
echo.
npm run dev

REM Si el comando falla, mantener la ventana abierta
if errorlevel 1 (
    echo.
    echo ERROR: Fallo al iniciar el servidor de desarrollo de React
    echo Verifica que Node.js y npm esten instalados correctamente
    pause
)

echo.
echo 🛑 Servidor React detenido
echo NOTA: El servidor Laravel puede seguir ejecutandose en segundo plano
echo Para detenerlo completamente, cierra su ventana de terminal
pause