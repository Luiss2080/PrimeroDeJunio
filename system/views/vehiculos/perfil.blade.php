@extends('layouts.dashboard')

@section('title', 'Perfil de Vehículo - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/vehiculos/perfil.css') }}?v={{ time() }}">

    <div class="vehiculos-profile-container">
        
        <!-- Header with Back Button and Actions -->
        <div class="profile-header-container">
            <div class="header-top">
                <a href="{{ route('vehiculos.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Perfil de Vehículo</h1>
                    <span class="vehiculo-id">ID: #VEH-{{ str_pad($vehiculo->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="header-actions-group">
                    <button class="system-btn-secondary" title="Exportar Ficha">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        <span>Exportar</span>
                    </button>
                    <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        <span>Editar Perfil</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="profile-grid">
            <!-- Left Column: Profile Card -->
            <aside class="profile-sidebar">
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="avatar-container">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($vehiculo->propietario_nombre) }}&background=00ff66&color=000&size=256" alt="Avatar" class="profile-avatar">
                            <div class="status-indicator {{ $vehiculo->estado === 'activo' ? 'active' : '' }}" title="{{ ucfirst($vehiculo->estado) }}"></div>
                        </div>
                        <h2 class="profile-name">{{ $vehiculo->placa }}</h2>
                        <div class="profile-role">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</div>
                        <div class="profile-badges">
                            <span class="status-badge status-{{ $vehiculo->estado }}">
                                {{ ucfirst($vehiculo->estado) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="profile-stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <span class="stat-value">{{ number_format($vehiculo->viajes->count()) }}</span>
                            <span class="stat-label">Viajes</span>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m16 16-4-4"/></svg>
                            </div>
                            <span class="stat-value">{{ number_format($vehiculo->viajes->sum('distancia_km'), 1) }}k</span>
                            <span class="stat-label">Km Total</span>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            </div>
                            <span class="stat-value">{{ date('Y') - $vehiculo->ano }}A</span>
                            <span class="stat-label">Antigüedad</span>
                        </div>
                    </div>

                    <!-- New Mini Details Row -->
                    <div class="mini-details-row">
                        <div class="mini-detail">
                            <span class="mini-label">Color</span>
                            <span class="mini-value">{{ $vehiculo->color }}</span>
                        </div>
                        <div class="mini-detail">
                            <span class="mini-label">Combustible</span>
                            <span class="mini-value">{{ $vehiculo->tipo_combustible ?? 'N/A' }}</span>
                        </div>
                        <div class="mini-detail">
                            <span class="mini-label">Pasajeros</span>
                            <span class="mini-value">{{ $vehiculo->capacidad_pasajeros ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="profile-contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Propietario</span>
                                <span class="contact-value">{{ $vehiculo->propietario_nombre }}</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Teléfono Propietario</span>
                                <span class="contact-value">{{ $vehiculo->propietario_telefono }}</span>
                            </div>
                        </div>
                        @if($vehiculo->propietario_cedula)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="3"/><circle cx="9" cy="10" r="2"/><line x1="15" x2="15" y1="8" y2="12"/><line x1="15" x2="15.01" y1="8" y2="8"/><line x1="7" x2="17" y1="16" y2="16"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Cédula Propietario</span>
                                <span class="contact-value">{{ $vehiculo->propietario_cedula }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="profile-actions">
                        <button class="btn-action-icon call" title="Llamar Propietario">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </button>
                        <button class="btn-action-icon whatsapp" title="WhatsApp Propietario">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Main Content -->
            <main class="profile-main">
                <!-- Tabs Navigation -->
                <div class="profile-tabs">
                    <button class="tab-btn active" data-tab="general">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        General
                    </button>
                    <button class="tab-btn" data-tab="documentos">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Documentos
                    </button>
                    <button class="tab-btn" data-tab="historial">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Historial
                    </button>
                </div>

                <!-- Tab Content: General -->
                <div class="tab-content active" id="general">
                    <!-- Vehicle Details Card -->
                    <div class="content-section">
                        <h3 class="section-title">Detalles del Vehículo</h3>
                        <div class="vehicle-card-large">
                            <div class="vehicle-image">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                            </div>
                            <div class="vehicle-info-main">
                                <h4>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h4>
                                <span class="vehicle-model">Modelo {{ $vehiculo->ano }} - {{ $vehiculo->color }}</span>
                                <div class="vehicle-tags">
                                    @if($vehiculo->cilindraje)
                                        <span class="v-tag">Cilindraje {{ $vehiculo->cilindraje }}cc</span>
                                    @endif
                                    @if($vehiculo->numero_motor)
                                        <span class="v-tag">Motor: {{ $vehiculo->numero_motor }}</span>
                                    @endif
                                    @if($vehiculo->numero_chasis)
                                        <span class="v-tag">Chasis: {{ $vehiculo->numero_chasis }}</span>
                                    @endif
                                </div>
                                @if($vehiculo->observaciones)
                                    <div style="margin-top: 1rem; color: var(--text-secondary); font-size: 0.9rem;">
                                        <strong>Observaciones:</strong> {{ $vehiculo->observaciones }}
                                    </div>
                                @endif
                            </div>
                            <div class="vehicle-plate-display">
                                <span class="plate-number">{{ $vehiculo->placa }}</span>
                                <span class="plate-country">BOLIVIA</span>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Stats -->
                    <div class="content-section">
                        <h3 class="section-title">Desempeño Mensual</h3>
                        <div class="performance-grid">
                            <div class="perf-card">
                                <span class="perf-label">Viajes Completados</span>
                                <span class="perf-value">{{ number_format($estadisticasActuales['viajes_completados']) }}</span>
                                <span class="perf-trend {{ $cambioViajes > 0 ? 'positive' : ($cambioViajes < 0 ? 'negative' : 'neutral') }}">
                                    @if($cambioViajes > 0)
                                        ↑ {{ $cambioViajes }}% vs mes anterior
                                    @elseif($cambioViajes < 0)
                                        ↓ {{ abs($cambioViajes) }}% vs mes anterior
                                    @else
                                        -- Igual que mes anterior
                                    @endif
                                </span>
                            </div>
                            <div class="perf-card">
                                <span class="perf-label">Ingresos Generados</span>
                                <span class="perf-value">Bs. {{ number_format($estadisticasActuales['ingresos_generados'], 2) }}</span>
                                <span class="perf-trend {{ $cambioIngresos > 0 ? 'positive' : ($cambioIngresos < 0 ? 'negative' : 'neutral') }}">
                                    @if($cambioIngresos > 0)
                                        ↑ {{ $cambioIngresos }}% vs mes anterior
                                    @elseif($cambioIngresos < 0)
                                        ↓ {{ abs($cambioIngresos) }}% vs mes anterior
                                    @else
                                        -- Igual que mes anterior
                                    @endif
                                </span>
                            </div>
                            <div class="perf-card">
                                <span class="perf-label">Calificación Promedio</span>
                                <span class="perf-value">{{ number_format($estadisticasActuales['calificacion_promedio'], 1) }} ⭐</span>
                                <span class="perf-trend {{ $cambioCalificacion > 0 ? 'positive' : ($cambioCalificacion < 0 ? 'negative' : 'neutral') }}">
                                    @if($cambioCalificacion > 0)
                                        ↑ {{ $cambioCalificacion }}% vs mes anterior
                                    @elseif($cambioCalificacion < 0)
                                        ↓ {{ abs($cambioCalificacion) }}% vs mes anterior
                                    @else
                                        -- Igual que mes anterior
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Content: Documentos -->
                <div class="tab-content" id="documentos">
                    <div class="content-section">
                        <div class="section-header-row">
                            <h3 class="section-title">Documentación del Vehículo</h3>
                            <button class="btn-primary-glow btn-sm">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                                Descargar Todo
                            </button>
                        </div>
                        
                        <div class="documents-grid">
                            @forelse($vehiculo->documentos as $documento)
                            <div class="doc-card">
                                <div class="doc-icon-wrapper">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                </div>
                                <div class="doc-details">
                                    <h4>{{ ucwords(str_replace('_', ' ', $documento->tipo_documento)) }}</h4>
                                    @if($documento->numero)
                                        <span class="doc-meta">No. {{ $documento->numero }}</span>
                                    @endif
                                    @if($documento->fecha_vencimiento)
                                        <span class="doc-meta">Vence: {{ \Carbon\Carbon::parse($documento->fecha_vencimiento)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                <div class="doc-status-badge {{ $documento->estado === 'vigente' ? 'valid' : ($documento->estado === 'vencido' ? 'expired' : 'pending') }}">
                                    {{ ucfirst($documento->estado) }}
                                </div>
                                @if($documento->archivo_ruta)
                                <button class="btn-icon-sm" onclick="window.open('{{ asset('storage/' . $documento->archivo_ruta) }}', '_blank')">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                                @endif
                            </div>
                            @empty
                            <div class="empty-state-container" style="grid-column: 1/-1; text-align: center; padding: 2rem; color: var(--text-secondary);">
                                <p>No hay documentos registrados para este vehículo.</p>
                                <button class="btn-primary-glow btn-sm mt-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    Agregar Documento
                                </button>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Tab Content: Historial -->
                <div class="tab-content" id="historial">
                    <div class="content-section">
                        <h3 class="section-title">Historial Reciente</h3>
                        <div class="table-responsive">
                            <table class="simple-table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Conductor</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Estado</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vehiculo->viajes()->latest()->take(10)->get() as $viaje)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($viaje->fecha_hora_inicio)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $viaje->conductor ? $viaje->conductor->nombre . ' ' . $viaje->conductor->apellido : 'N/A' }}</td>
                                        <td>{{ Str::limit($viaje->origen, 20) }}</td>
                                        <td>{{ Str::limit($viaje->destino, 20) }}</td>
                                        <td><span class="badge-status {{ $viaje->estado }}">{{ ucfirst($viaje->estado) }}</span></td>
                                        <td>Bs. {{ number_format($viaje->valor_total, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center" style="padding: 2rem; color: var(--text-secondary);">No hay viajes recientes registrados.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/vehiculos/perfil.js') }}"></script>
@endsection