<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error del Servidor | 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/errors/500.css') }}">
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <div class="glitch-wrapper">
                <div class="error-code glitch" data-text="500">500</div>
            </div>
            <h1 class="error-title">Error del Servidor</h1>
            <p class="error-message">Algo salió mal de nuestro lado. Estamos trabajando para solucionarlo lo antes posible.</p>
            
            <div class="error-actions">
                <button onclick="location.reload()" class="btn-retry">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
                    </svg>
                    Reintentar
                </button>
                <a href="{{ url('/') }}" class="btn-home">
                    Ir al Inicio
                </a>
            </div>
        </div>
        
        <div class="decoration-line line-1"></div>
        <div class="decoration-line line-2"></div>
        <div class="decoration-line line-3"></div>
    </div>

    <script src="{{ asset('js/errors/500.js') }}"></script>
</body>
</html>
