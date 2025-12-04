@extends('layouts.dashboard')

@section('title', 'Detalle de Viaje - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/viajes/perfil.css') }}?v={{ time() }}">

    <div class="viajes-profile-container">
        
        <!-- Header -->
        <div class="profile-header-container">
            <div class="header-top">
                <a href="{{ route('viajes.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Volver al Listado</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Detalle del Viaje</h1>
                    <span class="viaje-id">ID: #VJ-{{ str_pad($viaje->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="header-actions-group">
                    <button class="system-btn-secondary btn-action-icon print" title="Imprimir Comprobante">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                        <span>Imprimir</span>
                    </button>
                    <a href="{{ route('viajes.edit', $viaje->id) }}" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        <span>Editar Viaje</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="profile-grid">
            <!-- Left Column: Status & Summary -->
            <aside class="profile-sidebar">
                <div class="profile-card">
                    <h2 class="profile-name">Resumen del Viaje</h2>
                    <p class="profile-role">{{ $viaje->created_at->format('d F Y, H:i') }}</p>
                    
                    <div class="profile-badges">
                        <span class="status-badge" style="background: rgba(255,255,255,0.1);">
                            <span class="status-indicator {{ $viaje->estado }}"></span>
                            {{ ucfirst(str_replace('_', ' ', $viaje->estado)) }}
                        </span>
                    </div>

                    <div class="profile-stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            </div>
                            <span class="stat-value">{{ number_format($viaje->valor_total, 2) }}</span>
                            <span class="stat-label">Monto (Bs)</span>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <span class="stat-value">{{ $viaje->tiempo_estimado_min ?? '--' }}</span>
                            <span class="stat-label">Minutos</span>
                        </div>
                    </div>

                    <div class="profile-contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Cliente</span>
                                <span class="contact-value">{{ $viaje->cliente_nombre }}</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Teléfono Cliente</span>
                                <span class="contact-value">{{ $viaje->cliente_telefono }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Details -->
            <main class="profile-main">
                
                <!-- Route Details -->
                <div class="info-card">
                    <h3 class="section-title">Detalles de la Ruta</h3>
                    <div class="info-row">
                        <span class="info-label">Origen</span>
                        <span class="info-value">{{ $viaje->origen }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Destino</span>
                        <span class="info-value">{{ $viaje->destino }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Distancia Estimada</span>
                        <span class="info-value">{{ $viaje->distancia_km ? $viaje->distancia_km . ' km' : 'No registrada' }}</span>
                    </div>
                </div>

                <!-- Assignment Details -->
                <div class="info-card">
                    <h3 class="section-title">Asignación</h3>
                    <div class="info-row">
                        <span class="info-label">Conductor</span>
                        <span class="info-value">
                            @if($viaje->conductor)
                                <a href="{{ route('conductores.show', $viaje->conductor->id) }}" style="color: var(--primary-green); text-decoration: none;">
                                    {{ $viaje->conductor->nombre }} {{ $viaje->conductor->apellido }}
                                </a>
                            @else
                                <span style="color: #a0a0a0;">Sin asignar</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Vehículo</span>
                        <span class="info-value">
                            @if($viaje->vehiculo)
                                {{ $viaje->vehiculo->marca }} - {{ $viaje->vehiculo->placa }}
                            @else
                                <span style="color: #a0a0a0;">Sin asignar</span>
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="info-card">
                    <h3 class="section-title">Información de Pago</h3>
                    <div class="info-row">
                        <span class="info-label">Método de Pago</span>
                        <span class="info-value" style="text-transform: capitalize;">{{ $viaje->metodo_pago }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Estado del Pago</span>
                        <span class="info-value">
                            @if($viaje->estado == 'completado')
                                <span style="color: var(--primary-green);">Pagado</span>
                            @else
                                <span style="color: #ffcc00;">Pendiente</span>
                            @endif
                        </span>
                    </div>
                </div>

                @if($viaje->observaciones)
                <div class="info-card">
                    <h3 class="section-title">Observaciones</h3>
                    <p style="color: #ddd; line-height: 1.6;">{{ $viaje->observaciones }}</p>
                </div>
                @endif

            </main>
        </div>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/viajes/perfil.js') }}"></script>
@endsection
