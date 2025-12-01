@extends('layouts.dashboard')

@section('title', 'Dashboard Administrador')

@push('styles')
    <style>
        /* Dashboard con estilo de la página web */
        .admin-dashboard {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 100vh;
            color: white;
            padding: 30px;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0, 255, 102, 0.2);
        }
        
        .dashboard-title {
            font-size: 36px;
            font-weight: 800;
            color: white;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }
        
        .dashboard-subtitle {
            color: rgba(255, 255, 255, 0.7);
            margin: 8px 0 0 0;
            font-size: 16px;
            font-weight: 400;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 16px;
        }
        
        .btn-primary {
            background: #00ff66;
            color: #000;
            border: none;
            padding: 14px 24px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            background: #00e055;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 255, 102, 0.3);
        }
        
        .btn-secondary {
            background: transparent;
            color: #00ff66;
            border: 2px solid #00ff66;
            padding: 12px 22px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-secondary:hover {
            background: #00ff66;
            color: #000;
            transform: translateY(-2px);
        }
        
        /* Stats Cards Grid con estilo de la web */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }
        
        .stats-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 102, 0.2);
            border-radius: 20px;
            padding: 30px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #00ff66, #00e055);
        }
        
        .stats-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(0, 255, 102, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-8px);
            border-color: #00ff66;
            box-shadow: 0 20px 40px rgba(0, 255, 102, 0.2);
        }
        
        .stats-card:hover::after {
            opacity: 1;
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #00ff66, #00e055);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            box-shadow: 0 8px 20px rgba(0, 255, 102, 0.3);
        }
        
        .stat-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 20px;
            background: rgba(0, 255, 102, 0.2);
            color: #00ff66;
            border: 1px solid rgba(0, 255, 102, 0.3);
        }
        
        .stat-number {
            font-size: 42px;
            font-weight: 900;
            color: white;
            line-height: 1;
            margin: 16px 0 8px 0;
            font-family: 'Montserrat', sans-serif;
            position: relative;
            z-index: 2;
        }
        
        .stat-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            font-weight: 600;
            position: relative;
            z-index: 2;
        }
        
        .stat-subtitle {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
            margin-top: 6px;
            position: relative;
            z-index: 2;
        }
        
        /* Sección de acciones rápidas */
        .quick-actions-section {
            margin-top: 40px;
        }
        
        .section-title {
            font-size: 28px;
            font-weight: 900;
            color: white;
            margin-bottom: 25px;
            font-family: 'Montserrat', sans-serif;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 30px;
        }
        
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }
        
        .sidebar-content {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        
        /* Sección de análisis con estilo de la web */
        .analytics-section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(0, 255, 102, 0.2);
            border-radius: 24px;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .analytics-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #00ff66, #00e055);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 22px;
            font-weight: 800;
            color: white;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }
        
        .chart-placeholder {
            height: 320px;
            background: linear-gradient(135deg, rgba(0, 255, 102, 0.1) 0%, rgba(0, 0, 0, 0.8) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
            border: 2px dashed rgba(0, 255, 102, 0.3);
            transition: all 0.3s ease;
        }
        
        .chart-placeholder:hover {
            border-color: #00ff66;
            background: linear-gradient(135deg, rgba(0, 255, 102, 0.15) 0%, rgba(0, 0, 0, 0.9) 100%);
        }
        
        /* Colaboración y proyectos con estilo de la web */
        .team-section,
        .projects-section,
        .reminders-section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 25px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .team-section::before,
        .projects-section::before,
        .reminders-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, rgba(0, 255, 102, 0.6), rgba(0, 224, 85, 0.4));
        }
        
        .team-section:hover,
        .projects-section:hover,
        .reminders-section:hover {
            border-color: rgba(0, 255, 102, 0.3);
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }
        
        .team-member {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s ease;
        }
        
        .team-member:last-child {
            border-bottom: none;
        }
        
        .team-member:hover {
            background: rgba(0, 255, 102, 0.05);
            border-radius: 12px;
            margin: 0 -12px;
            padding: 16px 12px;
        }
        
        .member-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00ff66, #00e055);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 255, 102, 0.3);
            transition: all 0.3s ease;
        }
        
        .team-member:hover .member-avatar {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 255, 102, 0.5);
        }
        
        .member-info h4 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: white;
            font-family: 'Montserrat', sans-serif;
        }
        
        .member-info p {
            margin: 4px 0 0 0;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .progress-bar {
            width: 100%;
            height: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            margin: 20px 0;
            position: relative;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #00ff66, #00e055);
            border-radius: 20px;
            transition: width 0.8s ease;
            position: relative;
            overflow: hidden;
        }
        
        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        @media (max-width: 768px) {
            .admin-dashboard {
                padding: 16px;
            }
            
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            
            .dashboard-actions {
                width: 100%;
                flex-direction: column;
            }
            
            .btn-primary, .btn-secondary {
                justify-content: center;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-content {
                grid-template-columns: 1fr;
            }
            
            .dashboard-title {
                font-size: 24px;
            }
            
            .stat-number {
                font-size: 28px;
            }
        }
    </style>
@endpush

@section('content')
<div class="admin-dashboard">
    
    <!-- Header del Dashboard -->
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">Dashboard</h1>
            <p class="dashboard-subtitle">Plan, prioriza y cumple tus tareas con mayor eficiencia.</p>
        </div>
        <div class="dashboard-actions">
            <a href="/conductores/crear" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                </svg>
                Agregar Conductor
            </a>
            <a href="/reportes" class="btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                </svg>
                Importar Datos
            </a>
        </div>
    </div>
    
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
@endsection