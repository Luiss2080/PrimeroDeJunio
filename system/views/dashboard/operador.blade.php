@extends('layouts.auth')

@section('title', 'Dashboard Operador - Asociación 1ro de Junio')

@section('styles')
    <!-- CSS específico del dashboard -->
    <link rel="stylesheet" href="{{ asset('css/components/dashboard.css') }}">
    <style>
        /* Estilos específicos para operador */
        .operator-dashboard .stats-card {
            border-top: 3px solid #3b82f6;
        }
        
        .operator-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: var(--border-radius);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .welcome-section {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(0, 0, 0, 0.05) 100%);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: var(--border-radius-large);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .dashboard-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 12px;
        }
        
        .quick-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-fast);
            cursor: pointer;
        }
        
        .quick-action-btn.primary {
            background: #3b82f6;
            color: var(--white);
        }
        
        .quick-action-btn.primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }
        
        .quick-action-btn.secondary {
            background: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }
        
        .quick-action-btn.secondary:hover {
            background: var(--hover-bg);
            border-color: #3b82f6;
        }
        
        .operator-restricted {
            opacity: 0.6;
            pointer-events: none;
            position: relative;
        }
        
        .operator-restricted::after {
            content: 'Acceso restringido';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .operator-restricted:hover::after {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
<div class="dashboard-container operator-dashboard">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
            </svg>
            Dashboard Operador
        </h1>
        <div class="dashboard-actions">
            <button class="quick-action-btn primary" data-action="export">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                </svg>
                Exportar
            </button>
            <button class="quick-action-btn secondary" data-action="refresh">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4c-4.42,0 -7.99,3.58 -7.99,8s3.57,8 7.99,8c3.73,0 6.84,-2.55 7.73,-6h-2.08c-0.82,2.33 -3.04,4 -5.65,4c-3.31,0 -6,-2.69 -6,-6s2.69,-6 6,-6c1.66,0 3.14,0.69 4.22,1.78L13,11h7V4L17.65,6.35z"/>
                </svg>
                Actualizar
            </button>
        </div>
    </div>
    
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h2 style="margin: 0 0 12px 0; font-size: 20px; color: var(--text-primary);">Bienvenido, {{ session('user_name') }}</h2>
        <p style="margin: 0 0 16px 0; color: var(--text-secondary);">Panel operativo para gestión diaria de conductores, vehículos y viajes.</p>
        <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
            <span class="operator-badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                </svg>
                Operador
            </span>
            <span style="font-size: 14px; color: var(--text-secondary);">
                Último acceso: {{ now()->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="dashboard-stats">
        <div class="stats-grid">
            <div class="stats-card" data-card-type="trips-today">
                <div class="stats-header">
                    <div class="stats-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div class="stats-meta">
                        <h3 class="stats-title">Viajes de Hoy</h3>
                        <span class="stats-trend positive">+5.2%</span>
                    </div>
                </div>
                <div class="stats-content">
                    <div class="stats-value" data-counter="47">47</div>
                    <div class="stats-subtitle">Completados: 42</div>
                </div>
                <div class="status-indicators">
                    <div class="status-indicator" data-status="completed" style="background: var(--primary-green);"></div>
                    <div class="status-indicator" data-status="progress" style="background: #ffa500;"></div>
                    <div class="status-indicator" data-status="pending" style="background: var(--gray-medium);"></div>
                </div>
            </div>

            <div class="stats-card" data-card-type="active-drivers">
                <div class="stats-header">
                    <div class="stats-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                        </svg>
                    </div>
                    <div class="stats-meta">
                        <h3 class="stats-title">Conductores Activos</h3>
                        <span class="stats-trend positive">+2.1%</span>
                    </div>
                </div>
                <div class="stats-content">
                    <div class="stats-value" data-counter="28">28</div>
                    <div class="stats-subtitle">En servicio</div>
                </div>
                <div class="driver-status-chart"></div>
            </div>

            <div class="stats-card" data-card-type="available-vehicles">
                <div class="stats-header">
                    <div class="stats-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                        </svg>
                    </div>
                    <div class="stats-meta">
                        <h3 class="stats-title">Vehículos</h3>
                        <span class="stats-trend neutral">0%</span>
                    </div>
                </div>
                <div class="stats-content">
                    <div class="stats-value" data-counter="65">65</div>
                    <div class="stats-subtitle">Disponibles: 23</div>
                </div>
                <div class="vehicle-status"></div>
            </div>

            <div class="stats-card" data-card-type="daily-revenue">
                <div class="stats-header">
                    <div class="stats-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                    </div>
                    <div class="stats-meta">
                        <h3 class="stats-title">Ingresos de Hoy</h3>
                        <span class="stats-trend positive">+8.5%</span>
                    </div>
                </div>
                <div class="stats-content">
                    <div class="stats-value" data-counter="125000">$125,000</div>
                    <div class="stats-subtitle">Meta: $150,000</div>
                </div>
                <div class="revenue-progress" style="width: 100%; height: 4px; background: var(--border-color); border-radius: 2px; margin-top: 8px;">
                    <div style="width: 83%; height: 100%; background: #3b82f6; border-radius: 2px; transition: width 0.5s ease;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Dashboard -->
    <div class="dashboard-actions-section">
        <h2 class="section-title">Operaciones Diarias</h2>
        <div class="actions-grid">
            <a href="{{ route('conductores.index') }}" class="action-card operator-action">
                <div class="card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                    </svg>
                </div>
                <div class="card-content">
                    <h3>Conductores</h3>
                    <p>Ver y editar información de conductores</p>
                </div>
                <div class="card-arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                </div>
            </a>
            
            <a href="{{ route('vehiculos.index') }}" class="action-card operator-action">
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
            
            <a href="{{ route('viajes.index') }}" class="action-card operator-action">
                <div class="card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div class="card-content">
                    <h3>Control de Viajes</h3>
                    <p>Gestión de servicios y rutas</p>
                </div>
                <div class="card-arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                </div>
            </a>
            
            <a href="{{ route('clientes.index') }}" class="action-card operator-action">
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
            
            <a href="{{ route('tarifas.index') }}" class="action-card operator-action">
                <div class="card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                    </svg>
                </div>
                <div class="card-content">
                    <h3>Consultar Tarifas</h3>
                    <p>Ver precios y tarifas vigentes</p>
                </div>
                <div class="card-arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
                    </svg>
                </div>
            </a>
            
            <div class="action-card operator-restricted">
                <div class="card-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                    </svg>
                </div>
                <div class="card-content">
                    <h3>Configuración Avanzada</h3>
                    <p>Solo para administradores</p>
                </div>
                <div class="card-arrow">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h2 class="section-title">Actividad Operativa Reciente</h2>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon operator-activity">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div class="activity-content">
                    <p><strong>Viaje completado</strong> - Carlos Méndez - Ruta Centro</p>
                    <span>Hace 8 minutos</span>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon operator-activity">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                    </svg>
                </div>
                <div class="activity-content">
                    <p><strong>Conductor conectado</strong> - Ana Rodríguez</p>
                    <span>Hace 12 minutos</span>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon operator-activity">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/>
                    </svg>
                </div>
                <div class="activity-content">
                    <p><strong>Vehículo en mantenimiento</strong> - Placa ABC-123</p>
                    <span>Hace 1 hora</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- JS específico del dashboard -->
    <script src="{{ asset('js/components/dashboard.js') }}"></script>
@endsection