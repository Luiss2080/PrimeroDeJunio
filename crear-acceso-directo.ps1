# Script para crear un acceso directo en el escritorio
param(
    [string]$DesktopPath = [Environment]::GetFolderPath("Desktop")
)

$WshShell = New-Object -comObject WScript.Shell
$Shortcut = $WshShell.CreateShortcut("$DesktopPath\Primero de Junio - Desarrollo.lnk")
$Shortcut.TargetPath = "C:\laragon\www\PrimeroDeJunio\iniciar-desarrollo.bat"
$Shortcut.WorkingDirectory = "C:\laragon\www\PrimeroDeJunio"
$Shortcut.Description = "Inicia el servidor de desarrollo de Primero de Junio"
$Shortcut.IconLocation = "C:\Windows\System32\shell32.dll,14"
$Shortcut.Save()

Write-Host "Acceso directo creado en el escritorio!" -ForegroundColor Green