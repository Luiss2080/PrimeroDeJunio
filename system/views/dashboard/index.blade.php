<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Asociación 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .dashboard-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            width: 90%;
            padding: 40px;
            text-align: center;
        }
        
        .welcome-header {
            color: #2c3e50;
            margin-bottom: 30px;
        }
        
        .welcome-title {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #27ae60;
        }
        
        .welcome-subtitle {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 30px;
        }
        
        .user-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            border-left: 5px solid #27ae60;
        }
        
        .user-info h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            text-align: left;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            color: #555;
        }
        
        .info-item strong {
            color: #2c3e50;
            margin-right: 10px;
            min-width: 80px;
        }
        
        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .action-card {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(39, 174, 96, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .action-card h4 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background 0.3s;
        }
        
        .logout-btn:hover {
            background: #c0392b;
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 30px 20px;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="welcome-header">
            <h1 class="welcome-title">¡Bienvenido!</h1>
            <p class="welcome-subtitle">Sistema de Gestión - Asociación 1ro de Junio</p>
        </div>

        <div class="user-info">
            <h3>Información de la Sesión</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Usuario:</strong>
                    <span>{{ session('user_name', 'Usuario') }}</span>
                </div>
                <div class="info-item">
                    <strong>Email:</strong>
                    <span>{{ session('user_email', 'No disponible') }}</span>
                </div>
                <div class="info-item">
                    <strong>Rol:</strong>
                    <span>{{ session('user_role', 'Usuario') }}</span>
                </div>
                <div class="info-item">
                    <strong>ID:</strong>
                    <span>#{{ session('user_id', '0') }}</span>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="#" class="action-card">
                <h4>🏍️ Gestión de Conductores</h4>
                <p>Administrar conductores y sus datos</p>
            </a>
            
            <a href="#" class="action-card">
                <h4>🚗 Gestión de Vehículos</h4>
                <p>Controlar el parque automotor</p>
            </a>
            
            <a href="#" class="action-card">
                <h4>🚖 Gestión de Viajes</h4>
                <p>Administrar servicios y viajes</p>
            </a>
            
            <a href="#" class="action-card">
                <h4>💰 Tarifas y Pagos</h4>
                <p>Control de tarifas y pagos</p>
            </a>
            
            <a href="#" class="action-card">
                <h4>📊 Reportes</h4>
                <p>Estadísticas y reportes del sistema</p>
            </a>
            
            <a href="#" class="action-card">
                <h4>⚙️ Configuración</h4>
                <p>Ajustes del sistema</p>
            </a>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button type="submit" class="logout-btn">
                🔒 Cerrar Sesión
            </button>
        </form>
    </div>
</body>
</html>