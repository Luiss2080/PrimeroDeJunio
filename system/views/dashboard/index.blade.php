<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Asociación 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- CSS del Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
</head>

<body class="dashboard-body">
    
    <!-- Incluir Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Contenido Principal -->
    <div class="main-content">
        
        <!-- Incluir Header -->
        @include('layouts.header')
        
        <!-- Dashboard Container -->
        <div class="dashboard-container">
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
            
            
            <!-- Hero Section -->
            <div class="dashboard-hero">
                <div class="hero-content">
                    <h1 class="hero-title">Bienvenido al Sistema</h1>
                    <p class="hero-subtitle">Panel de control administrativo - Asociación 1ro de Junio</p>
                </div>
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\Conductor::count() }}</span>
                            <span class="stat-label">Conductores</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\Vehiculo::count() }}</span>
                            <span class="stat-label">Vehículos</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2.01.99L12 11l-1.99-2.01A2.5 2.5 0 0 0 8 8H5.46c-.8 0-1.49.59-1.42 1.37L6 16.5V22h2v-6h2v6h8z"/>
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\Cliente::count() }}</span>
                            <span class="stat-label">Clientes</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2 class="section-title">Acciones Rápidas</h2>
                <div class="actions-grid">
                    <a href="{{ route('conductores.index') }}" class="action-card">
                        <div class="card-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Conductores</h3>
                            <p>Gestionar conductores registrados</p>
                        </div>
                        <div class="card-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                            </svg>
                        </div>
                    </a>
                    
                    <a href="{{ route('vehiculos.index') }}" class="action-card">
                        <div class="card-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Vehículos</h3>
                            <p>Administrar parque automotor</p>
                        </div>
                        <div class="card-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                            </svg>
                        </div>
                    </a>
                    
                    <a href="{{ route('viajes.index') }}" class="action-card">
                        <div class="card-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Viajes</h3>
                            <p>Control de servicios y viajes</p>
                        </div>
                        <div class="card-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                            </svg>
                        </div>
                    </a>
                    
                    <a href="{{ route('clientes.index') }}" class="action-card">
                        <div class="card-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0 0 18.54 8H16c-.8 0-1.54.37-2.01.99L12 11l-1.99-2.01A2.5 2.5 0 0 0 8 8H5.46c-.8 0-1.49.59-1.42 1.37L6 16.5V22h2v-6h2v6h8z"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Clientes</h3>
                            <p>Administrar base de clientes</p>
                        </div>
                        <div class="card-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                            </svg>
                        </div>
                    </a>
                    
                    <a href="{{ route('tarifas.index') }}" class="action-card">
                        <div class="card-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Tarifas</h3>
                            <p>Control de tarifas y precios</p>
                        </div>
                        <div class="card-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                            </svg>
                        </div>
                    </a>
                    
                    <a href="{{ route('reportes.index') }}" class="action-card">
                        <div class="card-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Reportes</h3>
                            <p>Estadísticas y análisis</p>
                        </div>
                        <div class="card-arrow">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h2 class="section-title">Actividad Reciente</h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                            </svg>
                        </div>
                        <div class="activity-content">
                            <p><strong>Nuevo conductor registrado</strong></p>
                            <span>Hace 15 minutos</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                            </svg>
                        </div>
                        <div class="activity-content">
                            <p><strong>Vehículo actualizado</strong></p>
                            <span>Hace 1 hora</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                            </svg>
                        </div>
                        <div class="activity-content">
                            <p><strong>Tarifas actualizadas</strong></p>
                            <span>Hace 2 horas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Incluir Footer -->
        @include('layouts.footer')
    </div>

    <!-- Incluir JS del Dashboard -->
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
</body>
</html>