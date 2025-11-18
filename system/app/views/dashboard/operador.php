<?php
/**
 * Dashboard Operador - Simple
 * Sistema PRIMERO DE JUNIO
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operador - Primero de Junio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #333;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background: rgba(255,255,255,0.95);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .user-info {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: rgba(255,255,255,0.95);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.2em;
        }
        
        .card-icon {
            font-size: 2em;
            margin-bottom: 15px;
            display: block;
        }
        
        .card-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 10px;
        }
        
        .card-label {
            color: #666;
            font-size: 0.9em;
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .menu-item {
            background: rgba(255,255,255,0.95);
            padding: 20px;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .menu-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            text-decoration: none;
            color: #333;
        }
        
        .menu-icon {
            font-size: 1.5em;
            margin-bottom: 10px;
            display: block;
        }
        
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9em;
        }
        
        .logout-btn:hover {
            background: #c82333;
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <a href="/PrimeroDeJunio/system/app/auth/login.php?logout=1" class="logout-btn">🚪 Cerrar Sesión</a>
    
    <div class="container">
        <div class="header">
            <h1>🏍️ Dashboard Operador</h1>
            <div class="user-info">
                <strong>👤 Bienvenido:</strong> 
                <?= htmlspecialchars($usuario_actual['nombre'] ?? 'Operador') ?> 
                <strong>📧</strong> <?= htmlspecialchars($usuario_actual['email'] ?? 'operador@primero1dejunio.com') ?>
            </div>
        </div>
        
        <div class="dashboard-grid">
            <div class="card">
                <span class="card-icon">🏍️</span>
                <div class="card-number">12</div>
                <div class="card-label">Conductores en Línea</div>
            </div>
            
            <div class="card">
                <span class="card-icon">📋</span>
                <div class="card-number">25</div>
                <div class="card-label">Viajes de Hoy</div>
            </div>
            
            <div class="card">
                <span class="card-icon">⏰</span>
                <div class="card-number">3</div>
                <div class="card-label">Viajes Pendientes</div>
            </div>
            
            <div class="card">
                <span class="card-icon">👥</span>
                <div class="card-number">45</div>
                <div class="card-label">Clientes Atendidos</div>
            </div>
        </div>
        
        <h2 style="color: white; margin-bottom: 20px;">📋 Operaciones Diarias</h2>
        <div class="menu-grid">
            <a href="/PrimeroDeJunio/system/public/index.php/operador/conductores" class="menu-item">
                <span class="menu-icon">🏍️</span>
                <strong>Gestión de Conductores</strong><br>
                <small>Ver y gestionar conductores activos</small>
            </a>
            
            <a href="/PrimeroDeJunio/system/public/index.php/operador/viajes" class="menu-item">
                <span class="menu-icon">📋</span>
                <strong>Gestión de Viajes</strong><br>
                <small>Crear y seguir viajes</small>
            </a>
            
            <a href="/PrimeroDeJunio/system/public/index.php/operador/clientes" class="menu-item">
                <span class="menu-icon">👥</span>
                <strong>Gestión de Clientes</strong><br>
                <small>Registrar y consultar clientes</small>
            </a>
            
            <a href="/PrimeroDeJunio/system/public/index.php/operador/vehiculos" class="menu-item">
                <span class="menu-icon">🚗</span>
                <strong>Estado de Vehículos</strong><br>
                <small>Consultar disponibilidad de motos</small>
            </a>
            
            <a href="/PrimeroDeJunio/system/public/index.php/operador/reportes" class="menu-item">
                <span class="menu-icon">📊</span>
                <strong>Reportes Operativos</strong><br>
                <small>Informes del día y actividad</small>
            </a>
            
            <a href="/PrimeroDeJunio/system/public/index.php/operador/tarifas" class="menu-item">
                <span class="menu-icon">💰</span>
                <strong>Tarifas</strong><br>
                <small>Consultar precios y tarifas</small>
            </a>
        </div>
        
        <div style="text-align: center; margin-top: 40px; color: rgba(255,255,255,0.8);">
            <p>Sistema de Gestión Mototaxis "Primero de Junio" v1.0</p>
            <p>© 2025 - Panel de Operaciones</p>
        </div>
    </div>
</body>
</html>