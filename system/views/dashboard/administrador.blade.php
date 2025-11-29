@extends('layouts.dashboard')

@section('title', 'Dashboard Administrador')

@push('styles')
    <style>
        /* Estilos específicos para el dashboard del administrador */
        .admin-dashboard {
            padding: 30px;
        }
        
        .dashboard-welcome {
            background: linear-gradient(135deg, rgba(0, 255, 102, 0.1) 0%, rgba(0, 0, 0, 0.05) 100%);
            border: 1px solid rgba(0, 255, 102, 0.2);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 10px 0;
        }
        
        .welcome-subtitle {
            color: var(--text-secondary);
            margin: 0 0 20px 0;
        }
        
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(0, 255, 102, 0.1);
            color: var(--primary-green);
            border: 1px solid rgba(0, 255, 102, 0.3);
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stats-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
            transition: var(--transition-normal);
            border-top: 3px solid var(--primary-green);
        }
        
        .stats-card:hover {
            border-color: var(--primary-green);
            transform: translateY(-2px);
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            background: rgba(0, 255, 102, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-green);
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }
        
        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .stat-change {
            font-size: 12px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 4px;
        }
        
        .stat-change.positive {
            color: var(--success);
            background: rgba(0, 255, 102, 0.1);
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .action-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            transition: var(--transition-normal);
            text-decoration: none;
            color: inherit;
        }
        
        .action-card:hover {
            border-color: var(--primary-green);
            transform: translateY(-2px);
            text-decoration: none;
        }
        
        .action-icon {
            width: 64px;
            height: 64px;
            background: rgba(0, 255, 102, 0.1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-green);
        }
        
        .action-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 8px 0;
        }
        
        .action-description {
            color: var(--text-secondary);
            font-size: 14px;
            margin: 0;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 40px 0 20px 0;
        }
        
        @media (max-width: 768px) {
            .admin-dashboard {
                padding: 20px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
<div class="admin-dashboard">
    
    <!-- Sección de Bienvenida -->
    <div class="dashboard-welcome">
        <span class="admin-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            Administrador
        </span>
        <h1 class="welcome-title">¡Bienvenido, {{ session('user_name', 'Administrador') }}!</h1>
        <p class="welcome-subtitle">Panel de control administrativo. Gestiona el sistema completo desde aquí.</p>
    </div>
    
    <!-- Estadísticas Principales -->
    <div class="stats-grid">
        <div class="stats-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <span class="stat-change positive">+5%</span>
            </div>
            <div class="stat-number">{{ \App\Models\Conductor::count() }}</div>
            <div class="stat-label">Conductores Registrados</div>
        </div>
        
        <div class="stats-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                    </svg>
                </div>
                <span class="stat-change positive">+3</span>
            </div>
            <div class="stat-number">{{ \App\Models\Vehiculo::count() }}</div>
            <div class="stat-label">Vehículos Activos</div>
        </div>
        
        <div class="stats-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 6h-2.18c.11-.31.18-.65.18-1a2.996 2.996 0 0 0-5.5-1.65l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1z"/>
                    </svg>
                </div>
                <span class="stat-change positive">+12</span>
            </div>
            <div class="stat-number">{{ \App\Models\Viaje::whereDate('created_at', today())->count() }}</div>
            <div class="stat-label">Viajes de Hoy</div>
        </div>
        
        <div class="stats-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-4.8c0-.7.33-1.35.85-1.78L12 6c.55-.37 1.3-.37 1.85 0l7.15 5.42c.52.43.85 1.08.85 1.78V18c0 1.11-.89 2-2 2H6c-1.11 0-2-.89-2-2z"/>
                    </svg>
                </div>
                <span class="stat-change positive">+8</span>
            </div>
            <div class="stat-number">{{ \App\Models\Cliente::count() }}</div>
            <div class="stat-label">Clientes Registrados</div>
        </div>
    </div>
    
    <!-- Acciones Rápidas -->
    <h2 class="section-title">Acciones Rápidas</h2>
    <div class="quick-actions">
        
        <a href="/conductores" class="action-card">
            <div class="action-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <h3 class="action-title">Gestionar Conductores</h3>
            <p class="action-description">Administra conductores, registros y asignaciones</p>
        </a>
        
        <a href="/vehiculos" class="action-card">
            <div class="action-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                </svg>
            </div>
            <h3 class="action-title">Parque Automotor</h3>
            <p class="action-description">Control de vehículos y mantenimiento</p>
        </a>
        
        <a href="/usuarios" class="action-card">
            <div class="action-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M16 7c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4zM12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <h3 class="action-title">Usuarios del Sistema</h3>
            <p class="action-description">Gestión de usuarios y permisos</p>
        </a>
        
        <a href="/reportes" class="action-card">
            <div class="action-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                </svg>
            </div>
            <h3 class="action-title">Reportes y Estadísticas</h3>
            <p class="action-description">Análisis de datos y rendimiento</p>
        </a>
        
        <a href="/tarifas" class="action-card">
            <div class="action-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                </svg>
            </div>
            <h3 class="action-title">Gestión de Tarifas</h3>
            <p class="action-description">Configuración de precios y tarifas</p>
        </a>
        
        <a href="/configuracion" class="action-card">
            <div class="action-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.82,11.69,4.82,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                </svg>
            </div>
            <h3 class="action-title">Configuración Sistema</h3>
            <p class="action-description">Ajustes generales y personalización</p>
        </a>
    </div>
    
</div>
@endsection