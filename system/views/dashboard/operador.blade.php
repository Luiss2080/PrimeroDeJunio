@extends('layouts.dashboard')

@section('title', 'Dashboard Operador')

@push('styles')
    <style>
        /* Estilos específicos para el dashboard del operador con estilo de la web */
        .operador-dashboard {
            padding: 40px;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 100vh;
        }
        
        .dashboard-welcome {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(0, 255, 102, 0.3);
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 35px;
            position: relative;
            overflow: hidden;
        }
        
        .dashboard-welcome::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #00ff66, #00e055);
        }
        
        .welcome-title {
            font-size: 32px;
            font-weight: 900;
            color: white;
            margin: 0 0 12px 0;
            font-family: 'Montserrat', sans-serif;
        }
        
        .welcome-subtitle {
            color: rgba(255, 255, 255, 0.8);
            margin: 0 0 24px 0;
            font-size: 16px;
        }
        
        .operador-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(0, 255, 102, 0.2);
            color: #00ff66;
            border: 1px solid rgba(0, 255, 102, 0.4);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 18px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
        
        .stats-card:hover {
            border-color: #00ff66;
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 255, 102, 0.2);
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
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
        
        .stat-number {
            font-size: 38px;
            font-weight: 900;
            color: white;
            line-height: 1;
            font-family: 'Montserrat', sans-serif;
        }
        
        .stat-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            font-weight: 600;
            margin-top: 8px;
        }
        
        .stat-change {
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 20px;
        }
        
        .stat-change.positive {
            color: #00ff66;
            background: rgba(0, 255, 102, 0.2);
            border: 1px solid rgba(0, 255, 102, 0.3);
        }
        
        /* Sección de acciones rápidas */
        .quick-actions-section {
            margin-top: 40px;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }
        
        .action-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            transition: all 0.5s ease;
            text-decoration: none;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 102, 0.1), transparent);
            transition: left 0.6s ease;
        }
        
        .action-card:hover::before {
            left: 100%;
        }
        
        .action-card:hover {
            border-color: rgba(0, 255, 102, 0.4);
            transform: translateY(-12px);
            text-decoration: none;
            box-shadow: 0 25px 50px rgba(0, 255, 102, 0.15);
            background: rgba(255, 255, 255, 0.08);
        }
        
        .action-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #00ff66, #00e055);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #000;
            font-size: 32px;
            box-shadow: 0 12px 30px rgba(0, 255, 102, 0.4);
            transition: all 0.3s ease;
        }
        
        .action-card:hover .action-icon {
            transform: scale(1.1);
            box-shadow: 0 15px 40px rgba(0, 255, 102, 0.6);
        }
        
        .action-title {
            font-size: 20px;
            font-weight: 800;
            color: white;
            margin: 0 0 12px 0;
            font-family: 'Montserrat', sans-serif;
        }
        
        .action-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 15px;
            margin: 0;
            line-height: 1.5;
        }
        
        .section-title {
            font-size: 28px;
            font-weight: 900;
            color: white;
            margin: 50px 0 25px 0;
            font-family: 'Montserrat', sans-serif;
        }
        
        @media (max-width: 768px) {
            .operador-dashboard {
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
<div class="operador-dashboard">
@endsection