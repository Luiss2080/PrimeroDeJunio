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
            <h1 class="error-title">
                <span class="title-line">ERROR</span>
                <span class="highlight-wrapper">
                    <span class="highlight">500</span>
                </span>
            </h1>
            
            <p class="error-subtitle">ERROR DEL SERVIDOR</p>
            
            <p class="error-message">Algo salió mal en nuestros servidores. Estamos trabajando para solucionarlo.</p>
            
            <div class="error-actions">
                <button onclick="location.reload()" class="btn-retry">
                    Reintentar
                </button>
                <a href="{{ url('/') }}" class="btn-home">
                    Ir al Inicio
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/errors/500.js') }}"></script>
</body>
</html>
