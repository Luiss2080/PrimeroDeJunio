@echo off
echo ===============================================
echo     PRIMERO DE JUNIO - DESARROLLO WEB
echo ===============================================
echo.
echo Iniciando servidor de desarrollo...
echo.

REM Cambiar al directorio del proyecto website
cd /d "%~dp0website"

REM Verificar que estemos en el directorio correcto
if not exist "package.json" (
    echo ERROR: No se encuentra package.json en el directorio website
    echo Asegurate de que el script este en la raiz del proyecto
    pause
    exit /b 1
)

echo Directorio actual: %CD%
echo.

REM Abrir el navegador en segundo plano (esperar 3 segundos para que el servidor inicie)
start "" cmd /c "timeout /t 5 /nobreak > nul && start http://localhost:3000"

REM Ejecutar el servidor de desarrollo
echo Ejecutando npm run dev...
echo Presiona Ctrl+C para detener el servidor
echo.
npm run dev

REM Si el comando falla, mantener la ventana abierta
if errorlevel 1 (
    echo.
    echo ERROR: Fallo al iniciar el servidor de desarrollo
    echo Verifica que Node.js y npm esten instalados correctamente
    pause
)