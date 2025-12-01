<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operador - Asociación 1ro de Junio</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LogoAsociacion.png') }}">
    
    <!-- Precargar fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Meta tags -->
    <meta name="description" content="Dashboard operativo de la Asociación 1ro de Junio. Gestión de viajes y conductores.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CSS del Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    
    @stack('styles')
</head>

<body>
    
    <!-- Layout del Dashboard -->
    <div class="dashboard-layout">
        
        <!-- Sidebar Component -->
        @include('layouts.sidebar')
        
        <!-- Main Content -->
        <div class="main-content">
            
            <!-- Header Component -->
            @include('layouts.header', ['header_title' => 'Dashboard Operador'])
            
            <!-- Contenido principal -->
            <div class="dashboard-content">
                
                <!-- Welcome Section -->
                <div class="welcome-section">
                    <div class="welcome-text">
                        <h1 class="welcome-title">Hola, {{ Auth::user()->name ?? 'Operador' }}</h1>
                        <p class="welcome-subtitle">Panel de Control Operativo</p>
                    </div>
                    <div class="date-display">
                        <span class="current-date">{{ now()->format('d M, Y') }}</span>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <!-- Viajes Activos -->
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon warning">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                </svg>
                            </div>
                            <div class="stat-trend positive">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                <span>En curso</span>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\Viaje::where('estado', 'en_curso')->count() ?? '5' }}</div>
                        <div class="stat-label">Viajes Activos</div>
                    </div>

                    <!-- Conductores Disponibles -->
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon success">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <div class="stat-trend positive">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                <span>Disponibles</span>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\Conductor::where('estado', 'disponible')->count() ?? '15' }}</div>
                        <div class="stat-label">Conductores Libres</div>
                    </div>

                    <!-- Solicitudes Pendientes -->
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 12h-2v-2h2v2zm0-4h-2V6h2v4z"/>
                                </svg>
                            </div>
                            <div class="stat-trend warning">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                <span>Nuevas</span>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\Solicitud::where('estado', 'pendiente')->count() ?? '3' }}</div>
                        <div class="stat-label">Solicitudes</div>
                    </div>

                    <!-- Viajes Completados Hoy -->
                    <div class="stats-card">
                        <div class="stat-header">
                            <div class="stat-icon info">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                                </svg>
                            </div>
                            <div class="stat-trend positive">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 14l5-5 5 5z"/>
                                </svg>
                                <span>Hoy</span>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\Viaje::whereDate('created_at', today())->where('estado', 'completado')->count() ?? '28' }}</div>
                        <div class="stat-label">Completados</div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions-section">
                    <h2 class="section-title">Gestión Operativa</h2>
                    <div class="actions-grid">
                        <a href="{{ route('viajes.create') }}" class="action-card primary">
                            <div class="action-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Nuevo Viaje</h3>
                                <p>Registrar solicitud</p>
                            </div>
                        </a>

                        <a href="{{ route('conductores.index') }}" class="action-card secondary">
                            <div class="action-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Conductores</h3>
                                <p>Ver disponibilidad</p>
                            </div>
                        </a>

                        <a href="{{ route('viajes.index') }}" class="action-card info">
                            <div class="action-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2c-4.97 0-9 4.03-9 9 0 4.17 2.84 7.67 6.69 8.69L12 22l2.31-2.31C18.16 18.67 21 15.17 21 11c0-4.97-4.03-9-9-9zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.3c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Mapa en Vivo</h3>
                                <p>Seguimiento GPS</p>
                            </div>
                        </a>

                        <a href="{{ route('reportes.index') }}" class="action-card warning">
                            <div class="action-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Reportes</h3>
                                <p>Resumen diario</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity Table -->
                <div class="recent-activity-section">
                    <div class="section-header">
                        <h2 class="section-title">Viajes Recientes</h2>
                        <a href="{{ route('viajes.index') }}" class="view-all-link">Ver todos</a>
                    </div>
                    <div class="table-container">
                        <table class="activity-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Conductor</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Hora</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ejemplo estático, reemplazar con foreach -->
                                <tr>
                                    <td>#1024</td>
                                    <td>
                                        <div class="driver-info">
                                            <div class="driver-avatar">JD</div>
                                            <span>Juan Diaz</span>
                                        </div>
                                    </td>
                                    <td>Maria Lopez</td>
                                    <td><span class="status-badge success">Completado</span></td>
                                    <td>10:45 AM</td>
                                    <td>
                                        <button class="action-btn-icon">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1025</td>
                                    <td>
                                        <div class="driver-info">
                                            <div class="driver-avatar">CP</div>
                                            <span>Carlos Perez</span>
                                        </div>
                                    </td>
                                    <td>Ana Garcia</td>
                                    <td><span class="status-badge warning">En Curso</span></td>
                                    <td>11:15 AM</td>
                                    <td>
                                        <button class="action-btn-icon">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
    
    @stack('scripts')
</body>
</html>