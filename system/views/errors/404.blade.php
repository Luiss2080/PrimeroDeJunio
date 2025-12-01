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
            <div class="error-code" id="errorCode">404</div>
            <h1 class="error-title">Página No Encontrada</h1>
            <p class="error-message">Parece que te has desviado del camino. La página que buscas no existe o ha sido movida.</p>
            
            <div class="error-actions">
                <a href="{{ url('/') }}" class="btn-home">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    Volver al Inicio
                </a>
            </div>
        </div>
        
        <div class="decoration-circle circle-1"></div>
        <div class="decoration-circle circle-2"></div>
    </div>

    <script src="{{ asset('js/errors/404.js') }}"></script>
</body>
</html>
