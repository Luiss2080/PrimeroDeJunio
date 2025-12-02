<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página No Encontrada | 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/errors/404.css') }}">
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <h1 class="error-title">
                <span class="title-line">ERROR</span>
                <span class="highlight-wrapper">
                    <span class="highlight">404</span>
                </span>
            </h1>
            
            <p class="error-subtitle">PÁGINA NO ENCONTRADA</p>
            
            <p class="error-message">Lo sentimos, la página que buscas no existe o ha sido movida.</p>
            
            <div class="error-actions">
                <a href="{{ url('/') }}" class="btn-home">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/errors/404.js') }}"></script>
</body>
</html>
