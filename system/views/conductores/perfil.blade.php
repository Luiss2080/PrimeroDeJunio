@extends('layouts.dashboard')

@section('title', 'Perfil de Conductor - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/perfil.css') }}?v={{ time() + 1 }}">

    <div class="conductores-profile-container">
        
        <!-- Header with Back Button and Actions -->
        <div class="profile-header-container">
            <div class="header-top">
                <a href="{{ route('conductores.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    <span>Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Perfil de Conductor</h1>
                    <span class="conductor-id">ID: #CND-{{ str_pad($conductor->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="header-actions-group">
                    <button class="system-btn-secondary" title="Exportar Ficha">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        <span>Exportar</span>
                    </button>
                    <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
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
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($conductor->nombre . ' ' . $conductor->apellido) }}&background=00ff66&color=000&size=256" alt="Avatar" class="profile-avatar">
                            <div class="status-indicator {{ $conductor->estado === 'activo' ? 'active' : '' }}" title="{{ ucfirst($conductor->estado) }}"></div>
                        </div>
                        <h2 class="profile-name">{{ $conductor->nombre }} {{ $conductor->apellido }}</h2>
                        <div class="profile-role">Conductor Profesional</div>
                        <div class="profile-badges">
                            <span class="status-badge status-{{ $conductor->estado }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($conductor->estado) }}
                            </span>
                            <span class="payment-badge status-{{ $conductor->estado_pago }}">
                                {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="profile-stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </div>
                            <span class="stat-value">{{ number_format($conductor->rating, 1) }}</span>
                            <span class="stat-label">Rating</span>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <span class="stat-value">{{ number_format($conductor->total_viajes) }}</span>
                            <span class="stat-label">Viajes</span>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <span class="stat-value">{{ $conductor->ciudad ?? 'N/A' }}</span>
                            <span class="stat-label">Ciudad</span>
                        </div>
                    </div>

                    <!-- New Mini Details Row -->
                    <div class="mini-details-row">
                        <div class="mini-detail">
                            <span class="mini-label">Edad</span>
                            <span class="mini-value">{{ $conductor->fecha_nacimiento ? \Carbon\Carbon::parse($conductor->fecha_nacimiento)->age : 'N/A' }} Años</span>
                        </div>
                        <div class="mini-detail">
                            <span class="mini-label">Sangre</span>
                            <span class="mini-value">{{ $conductor->grupo_sanguineo ?? 'N/A' }}</span>
                        </div>
                        <div class="mini-detail">
                            <span class="mini-label">Licencia</span>
                            <span class="mini-value">{{ $conductor->numero_licencia ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="profile-contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Móvil Personal</span>
                                <span class="contact-value">{{ $conductor->telefono }}</span>
                                @if($conductor->telefono_secundario)
                                    <span class="contact-subvalue">Alt: {{ $conductor->telefono_secundario }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Correo Electrónico</span>
                                <span class="contact-value">{{ $conductor->email ?? 'No registrado' }}</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Domicilio</span>
                                <span class="contact-value">{{ Str::limit($conductor->direccion, 25) ?? 'No registrado' }}</span>
                                @if($conductor->ciudad)
                                    <span class="contact-subvalue">{{ $conductor->ciudad }}</span>
                                @endif
                            </div>
                        </div>
                        @if($conductor->contacto_emergencia_nombre)
                        <div class="contact-item emergency">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Contacto de Emergencia</span>
                                <span class="contact-value">{{ $conductor->contacto_emergencia_nombre }}</span>
                                @if($conductor->contacto_emergencia_telefono)
                                    <span class="contact-subvalue">{{ $conductor->contacto_emergencia_telefono }}</span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="profile-actions">
                        <button class="btn-action-icon call" title="Llamar">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </button>
                        <button class="btn-action-icon email" title="Enviar Email">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </button>
                        <button class="btn-action-icon whatsapp" title="WhatsApp">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Main Content -->
            <main class="profile-main">
                <!-- Tabs Navigation -->
                <div class="profile-tabs">
                    <button class="tab-btn active" data-tab="general">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        General
                    </button>
                    <button class="tab-btn" data-tab="documentos">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Documentos
                    </button>
                    <button class="tab-btn" data-tab="historial">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Historial
                    </button>
                </div>

                <!-- Tab Content: General -->
                <div class="tab-content active" id="general">
                    <!-- Vehicle Card -->
                    <div class="content-section">
                        <h3 class="section-title">Vehículo Asignado</h3>
                        @if($conductor->vehiculoActual)
                        <div class="vehicle-card-large">
                            <div class="vehicle-image">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                            </div>
                            <div class="vehicle-info-main">
                                <h4>{{ $conductor->vehiculoActual->marca }} {{ $conductor->vehiculoActual->modelo }}</h4>
                                <span class="vehicle-model">Modelo {{ $conductor->vehiculoActual->ano }} - {{ $conductor->vehiculoActual->color }}</span>
                                <div class="vehicle-tags">
                                    <span class="v-tag">Cilindraje {{ $conductor->vehiculoActual->cilindraje }}cc</span>
                                </div>
                            </div>
                            <div class="vehicle-plate-display">
                                <span class="plate-number">{{ $conductor->vehiculoActual->placa }}</span>
                                <span class="plate-country">BOLIVIA</span>
                            </div>
                        </div>
                        @else
                        <div class="empty-state-container">
                            <p class="text-muted">No tiene vehículo asignado actualmente.</p>
                        </div>
                        @endif
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
                        
                        <!-- Estadísticas Adicionales -->
                        <div class="additional-stats">
                            <div class="stat-row">
                                <span class="stat-label">Distancia Total (Este Mes):</span>
                                <span class="stat-value">{{ number_format($estadisticasActuales['distancia_total'], 1) }} km</span>
                            </div>
                            <div class="stat-row">
                                <span class="stat-label">Porcentaje de Asistencia:</span>
                                <span class="stat-value">{{ $conductor->asistencia_porcentaje ?? 0 }}%</span>
                            </div>
                            <div class="stat-row">
                                <span class="stat-label">Fecha de Ingreso:</span>
                                <span class="stat-value">{{ $conductor->fecha_ingreso ? \Carbon\Carbon::parse($conductor->fecha_ingreso)->format('d/m/Y') : 'No registrada' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="content-section">
                        <h3 class="section-title">Información Profesional</h3>
                        <div class="professional-info-grid">
                            <div class="pro-info-card">
                                <div class="pro-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>
                                </div>
                                <div class="pro-details">
                                    <span class="pro-label">Licencia de Conducir</span>
                                    <span class="pro-value">{{ $conductor->numero_licencia ?? 'No registrada' }}</span>
                                    @if($conductor->categoria_licencia)
                                        <span class="pro-meta">Categoría: {{ strtoupper($conductor->categoria_licencia) }}</span>
                                    @endif
                                    @if($conductor->fecha_vencimiento_licencia)
                                        <span class="pro-meta">Vence: {{ \Carbon\Carbon::parse($conductor->fecha_vencimiento_licencia)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($conductor->numero_seguro_social)
                            <div class="pro-info-card">
                                <div class="pro-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9c.39 0 .77.02 1.15.07"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </div>
                                <div class="pro-details">
                                    <span class="pro-label">Seguro Social</span>
                                    <span class="pro-value">{{ $conductor->numero_seguro_social }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tab Content: Documentos -->
                <div class="tab-content" id="documentos">
                    <div class="content-section">
                        <div class="section-header-row">
                            <h3 class="section-title">Documentación del Conductor</h3>
                            <button class="btn-primary-glow btn-sm">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Descargar Todo
                            </button>
                        </div>
                        
                        <div class="documents-grid">
                            @forelse($conductor->documentos as $documento)
                            <div class="doc-card">
                                <div class="doc-icon-wrapper">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                </div>
                                <div class="doc-details">
                                    <h4>{{ ucwords(str_replace('_', ' ', $documento->tipo_documento)) }}</h4>
                                    @if($documento->numero)
                                        <span class="doc-meta">No. {{ $documento->numero }}</span>
                                    @endif
                                    @if($documento->fecha_vencimiento)
                                        <span class="doc-meta">Vence: {{ \Carbon\Carbon::parse($documento->fecha_vencimiento)->format('d/m/Y') }}</span>
                                    @endif
                                    @if($documento->fecha_expedicion)
                                        <span class="doc-meta">Expedido: {{ \Carbon\Carbon::parse($documento->fecha_expedicion)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                <div class="doc-status-badge {{ $documento->estado === 'vigente' ? 'valid' : ($documento->estado === 'vencido' ? 'expired' : 'pending') }}">
                                    {{ ucfirst($documento->estado) }}
                                </div>
                                @if($documento->archivo_ruta)
                                <button class="btn-icon-sm" data-documento-url="{{ asset('storage/' . $documento->archivo_ruta) }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                                @endif
                            </div>
                            @empty
                            <div class="empty-state-container">
                                <p class="text-muted">No hay documentos registrados para este conductor.</p>
                                <button class="btn-primary-glow btn-sm mt-2">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    Agregar Documento
                                </button>
                            </div>
                            @endforelse
                            
                            <!-- Sección especial para antecedentes penales si no está como documento -->
                            @if(!$conductor->documentos->where('tipo_documento', 'antecedentes_penales')->count())
                            <div class="doc-card">
                                <div class="doc-icon-wrapper">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"/><path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3"/><path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3"/></svg>
                                </div>
                                <div class="doc-details">
                                    <h4>Antecedentes Penales</h4>
                                    <span class="doc-meta">Estado: {{ $conductor->antecedentes_penales ? 'Con antecedentes' : 'Limpios' }}</span>
                                    @if($conductor->antecedentes_verificados_at)
                                        <span class="doc-meta">Verificado el {{ \Carbon\Carbon::parse($conductor->antecedentes_verificados_at)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                <div class="doc-status-badge {{ !$conductor->antecedentes_penales ? 'valid' : 'pending' }}">
                                    {{ !$conductor->antecedentes_penales ? 'Verificado' : 'Requiere revisión' }}
                                </div>
                            </div>
                            @endif
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
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Estado</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($conductor->viajes as $viaje)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($viaje->fecha_hora_inicio)->format('d/m/Y H:i') }}</td>
                                        <td>{{ Str::limit($viaje->origen, 20) }}</td>
                                        <td>{{ Str::limit($viaje->destino, 20) }}</td>
                                        <td><span class="badge-status {{ $viaje->estado }}">{{ ucfirst($viaje->estado) }}</span></td>
                                        <td>Bs. {{ number_format($viaje->valor_total, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No hay viajes recientes registrados.</td>
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
    <script src="{{ asset('js/conductores/perfil.js') }}"></script>
    <script>
        // Manejar clicks en botones de documentos
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-icon-sm[data-documento-url]').forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-documento-url');
                    window.open(url, '_blank');
                });
            });
        });
    </script>
@endsection