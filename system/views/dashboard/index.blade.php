@extends('layouts.auth')

@section('title', 'Dashboard - Asociación 1ro de Junio')

@section('styles')
    <!-- CSS específico del dashboard -->
    <link rel="stylesheet" href="{{ asset('css/components/dashboard.css') }}">
    <style>
        /* Estilos específicos para el dashboard general */
        .dashboard-redirect {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 160px);
            padding: 40px 20px;
        }
        
        .redirect-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-large);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }
        
        .redirect-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green) 0%, rgba(0, 255, 102, 0.8) 100%);
            color: var(--black);
            font-size: 32px;
        }
        
        .redirect-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
        }
        
        .redirect-message {
            font-size: 16px;
            color: var(--text-secondary);
            margin-bottom: 32px;
            line-height: 1.6;
        }
        
        .user-info {
            background: var(--hover-bg);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 32px;
        }
        
        .user-info h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .user-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }
        
        .user-detail {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }
        
        .user-detail .label {
            color: var(--text-secondary);
            font-weight: 500;
        }
        
        .user-detail .value {
            color: var(--text-primary);
            font-weight: 600;
        }
        
        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: var(--border-radius);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .role-badge.administrador {
            background: rgba(0, 255, 102, 0.1);
            color: var(--primary-green);
            border: 1px solid rgba(0, 255, 102, 0.3);
        }
        
        .role-badge.operador {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        .redirect-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .redirect-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-fast);
            position: relative;
            overflow: hidden;
        }
        
        .redirect-btn.primary {
            background: var(--primary-green);
            color: var(--black);
            border: 2px solid var(--primary-green);
        }
        
        .redirect-btn.primary:hover {
            background: rgba(0, 255, 102, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 255, 102, 0.3);
        }
        
        .redirect-btn.secondary {
            background: transparent;
            color: var(--text-primary);
            border: 2px solid var(--border-color);
        }
        
        .redirect-btn.secondary:hover {
            background: var(--hover-bg);
            border-color: var(--primary-green);
        }
        
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .redirect-countdown {
            font-size: 14px;
            color: var(--text-secondary);
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .redirect-card {
                padding: 30px 20px;
            }
            
            .redirect-icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }
            
            .redirect-title {
                font-size: 20px;
            }
            
            .user-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
<div class="dashboard-redirect">
    <div class="redirect-card">
        <div class="redirect-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
        </div>
        
        <h1 class="redirect-title">¡Bienvenido al Sistema!</h1>
        <p class="redirect-message">
            Redirigiendo al dashboard correspondiente según tu rol de usuario...
        </p>
        
        <div class="user-info">
            <h4>Información de la Sesión</h4>
            <div class="user-details">
                <div class="user-detail">
                    <span class="label">Usuario:</span>
                    <span class="value">{{ session('user_name', 'Usuario') }}</span>
                </div>
                <div class="user-detail">
                    <span class="label">Email:</span>
                    <span class="value">{{ session('user_email', 'No disponible') }}</span>
                </div>
                <div class="user-detail">
                    <span class="label">Rol:</span>
                    <span class="value">
                        <span class="role-badge {{ strtolower(session('user_role', 'usuario')) }}">
                            @if(session('user_role') === 'administrador')
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                                </svg>
                            @else
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                                </svg>
                            @endif
                            {{ session('user_role', 'Usuario') }}
                        </span>
                    </span>
                </div>
                <div class="user-detail">
                    <span class="label">ID de Usuario:</span>
                    <span class="value">#{{ session('user_id', '0') }}</span>
                </div>
            </div>
        </div>
        
        <div class="redirect-actions">
            @if(session('user_role') === 'administrador')
                <a href="{{ route('dashboard.administrador') }}" class="redirect-btn primary" id="redirectBtn">
                    <span class="loading-spinner" style="display: none;"></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                    </svg>
                    Ir al Dashboard de Administrador
                </a>
            @elseif(session('user_role') === 'operador')
                <a href="{{ route('dashboard.operador') }}" class="redirect-btn primary" id="redirectBtn">
                    <span class="loading-spinner" style="display: none;"></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/>
                    </svg>
                    Ir al Dashboard de Operador
                </a>
            @else
                <p class="redirect-message" style="color: var(--accent-red);">
                    ❌ Rol no reconocido. Por favor, contacta al administrador.
                </p>
            @endif
            
            <a href="{{ route('auth.logout') }}" class="redirect-btn secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.59L17 17l5-5z"/>
                </svg>
                Cerrar Sesión
            </a>
        </div>
        
        <div class="redirect-countdown">
            <span>Redirección automática en <span id="countdown">5</span> segundos...</span>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const redirectBtn = document.getElementById('redirectBtn');
    const countdownElement = document.getElementById('countdown');
    let countdown = 5;
    
    // Solo hacer redirección automática si hay un rol válido
    @if(session('user_role') === 'administrador' || session('user_role') === 'operador')
    
    const countdownInterval = setInterval(function() {
        countdown--;
        if (countdownElement) {
            countdownElement.textContent = countdown;
        }
        
        if (countdown <= 0) {
            clearInterval(countdownInterval);
            
            // Mostrar loading spinner
            if (redirectBtn) {
                const spinner = redirectBtn.querySelector('.loading-spinner');
                const svg = redirectBtn.querySelector('svg:not(.loading-spinner)');
                if (spinner) spinner.style.display = 'inline-block';
                if (svg) svg.style.display = 'none';
                redirectBtn.textContent = redirectBtn.textContent.replace(/Ir al/, 'Cargando');
            }
            
            // Realizar redirección
            setTimeout(function() {
                if (redirectBtn && redirectBtn.href) {
                    window.location.href = redirectBtn.href;
                }
            }, 500);
        }
    }, 1000);
    
    // Permitir cancelar la redirección automática al hacer hover
    const redirectCard = document.querySelector('.redirect-card');
    if (redirectCard) {
        redirectCard.addEventListener('mouseenter', function() {
            clearInterval(countdownInterval);
            if (countdownElement) {
                countdownElement.parentElement.style.display = 'none';
            }
        });
    }
    
    @endif
    
    // Manejar clic manual en el botón
    if (redirectBtn) {
        redirectBtn.addEventListener('click', function(e) {
            const spinner = this.querySelector('.loading-spinner');
            const svg = this.querySelector('svg:not(.loading-spinner)');
            if (spinner) spinner.style.display = 'inline-block';
            if (svg) svg.style.display = 'none';
        });
    }
});
</script>
@endsection