<?php
/**
 * Redirección automática al login funcional
 * Sistema PRIMERO DE JUNIO
 */

// Redirigir inmediatamente al login que funciona
$loginUrl = '/PrimeroDeJunio/system/app/auth/login.php';
header("Location: $loginUrl");
exit;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redirigiendo...</title>
    <meta http-equiv="refresh" content="0;url=<?php echo $loginUrl; ?>">
</head>
<body>
    <p>Redirigiendo al sistema de login...</p>
    <p><a href="<?php echo $loginUrl; ?>">Si no eres redirigido automáticamente, haz clic aquí</a></p>
</body>
</html>