<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acceso Denegado | 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/errors/403.css') }}">
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <div class="lock-icon-container" id="lockIcon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                </svg>
            </div>
            <div class="error-code">403</div>
            <h1 class="error-title">Acceso Denegado</h1>
            <p class="error-message">Lo sentimos, pero no tienes los permisos necesarios para acceder a esta área restringida.</p>
            
            <div class="error-actions">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Regresar
                </a>
                <a href="{{ url('/') }}" class="btn-home">
                    Ir al Inicio
                </a>
            </div>
        </div>
        
        <div class="decoration-circle circle-1"></div>
        <div class="decoration-circle circle-2"></div>
    </div>

    <script src="{{ asset('js/errors/403.js') }}"></script>
</body>
</html>
