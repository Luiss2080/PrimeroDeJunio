<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador - Asociación 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Meta tags -->
    <meta name="description" content="Dashboard administrativo de la Asociación 1ro de Junio. Gestión profesional de mototaxis.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CSS del Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/loading.css') }}">
    
    @stack('styles')
</head>

<body>
    
    <!-- Loading Screen -->
    @include('layouts.loading')
    
    <!-- Layout del Dashboard -->
    <div class="dashboard-layout">
        
        <!-- Sidebar Component -->
        @include('layouts.sidebar')
        
        <!-- Main Content -->
        <div class="main-content">
            
            <!-- Header Component -->
            @include('layouts.header', ['header_title' => 'Dashboard Admin'])
            
            <!-- Contenido principal -->
            <div class="dashboard-content">
                
                <!-- Tarjetas de Estadísticas -->
                <div class="stats-grid">
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <div class="stat-trend">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                +2.1%
                            </div>
                        </div>
                        <div class="stat-number">{{ \App\Models\Conductor::count() ?? '24' }}</div>
                        <div class="stat-label">Total Conductores</div>
                        <div class="stat-subtitle">Incremento desde el mes pasado</div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                </svg>
                            </div>
                            <div class="stat-trend">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                +5.4%
                            </div>
                        </div>
                        <div class="stat-number">{{ \App\Models\Vehiculo::count() ?? '10' }}</div>
                        <div class="stat-label">Vehículos Activos</div>
                        <div class="stat-subtitle">Incremento desde el mes pasado</div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 6h-2.18c.11-.31.18-.65.18-1a2.996 2.996 0 0 0-5.5-1.65l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1z"/>
                                </svg>
                            </div>
                            <div class="stat-trend">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                +12.3%
                            </div>
                        </div>
                        <div class="stat-number">{{ \App\Models\Viaje::whereDate('created_at', today())->count() ?? '12' }}</div>
                        <div class="stat-label">Viajes Hoy</div>
                        <div class="stat-subtitle">Incremento desde ayer</div>
                    </div>
                    
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-4.8c0-.7.33-1.35.85-1.78L12 6c.55-.37 1.3-.37 1.85 0l7.15 5.42c.52.43.85 1.08.85 1.78V18c0 1.11-.89 2-2 2H6c-1.11 0-2-.89-2-2z"/>
                                </svg>
                            </div>
                            <div class="stat-trend">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                +3.2%
                            </div>
                        </div>
                        <div class="stat-number">{{ \App\Models\Cliente::count() ?? '2' }}</div>
                        <div class="stat-label">Clientes Nuevos</div>
                        <div class="stat-subtitle">En proceso</div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="quick-actions-section">
                    <h2 class="section-title">Acciones Rápidas</h2>
                    <div class="actions-grid">
                        
                        <!-- Crear Conductor -->
                        <div class="action-card">
                            <div class="action-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                            </div>
                            <h3 class="action-title">Agregar Conductor</h3>
                            <p class="action-description">Registra un nuevo conductor en el sistema</p>
                            <a href="/conductores/crear" class="action-btn">
                                Crear Conductor
                            </a>
                        </div>
                        
                        <!-- Nuevo Vehículo -->
                        <div class="action-card">
                            <div class="action-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                                </svg>
                            </div>
                            <h3 class="action-title">Registrar Vehículo</h3>
                            <p class="action-description">Añade un nuevo vehículo a la flota</p>
                            <a href="/vehiculos/crear" class="action-btn">
                                Agregar Vehículo
                            </a>
                        </div>
                        
                        <!-- Ver Reportes -->
                        <div class="action-card">
                            <div class="action-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                </svg>
                            </div>
                            <h3 class="action-title">Generar Reportes</h3>
                            <p class="action-description">Consulta estadísticas y reportes del sistema</p>
                            <a href="/reportes" class="action-btn">
                                Ver Reportes
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <!-- Footer Component -->
            @include('layouts.footer')
            
        </div>
    </div>
    
    <!-- Configuración global -->
    <script>
        window.appConfig = {
            csrfToken: '{{ csrf_token() }}',
            baseUrl: '{{ url("/") }}',
            user: {
                id: '{{ session("user_id") }}',
                name: '{{ session("user_name") }}',
                role: '{{ session("user_role") }}'
            }
        };
    </script>
    
    <!-- JavaScript del Dashboard -->
    <script src="{{ asset('js/components/loading.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
    
    @stack('scripts')
</body>
</html>