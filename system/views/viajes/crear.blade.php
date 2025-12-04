@extends('layouts.dashboard')

@section('title', 'Nuevo Viaje - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/viajes/crear.css') }}?v={{ time() }}">

    <div class="viajes-create-container">
        
        <!-- Header -->
        <div class="create-header-container">
            <div class="header-top">
                <a href="{{ route('viajes.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Cancelar y Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Registrar Nuevo Viaje</h1>
                </div>
                <div class="header-actions-group">
                    <button type="submit" form="createForm" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span>Guardar Viaje</span>
                    </button>
                </div>
            </div>
        </div>

        <form id="createForm" action="{{ route('viajes.store') }}" method="POST" class="create-form-grid">
            @csrf

            <!-- Left Column: Status & Info -->
            <aside class="create-sidebar">
                <div class="glass-card centered-card">
                    <h3 class="sidebar-name">Nuevo Viaje</h3>
                    <p class="sidebar-role">Detalles del Servicio</p>

                    <div class="form-group full-width mt-4">
                        <label for="estado" class="form-label">Estado Inicial</label>
                        <div class="select-wrapper">
                            <select id="estado" name="estado" class="form-select">
                                <option value="pendiente" selected>Pendiente</option>
                                <option value="en_curso">En Curso</option>
                                <option value="completado">Completado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                            <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Información del Sistema -->
                <div class="glass-card mt-4">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1v6m0 6v6m-6-6h6m6 0h-6"/></svg>
                        Valores Automáticos
                    </h3>
                    <div class="system-info-list">
                        <div class="sys-item">
                            <span class="sys-label">Fecha</span>
                            <span class="sys-value">{{ now()->format('d/m/Y') }}</span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Hora</span>
                            <span class="sys-value">{{ now()->format('H:i') }}</span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Operador</span>
                            <span class="sys-value">{{ auth()->user()->name ?? 'Sistema' }}</span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Form Fields -->
            <div class="create-main-content">
                
                <!-- Client Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Información del Cliente
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cliente_nombre" class="form-label">Nombre del Cliente *</label>
                            <input type="text" id="cliente_nombre" name="cliente_nombre" class="form-input" placeholder="Ej: María López" required>
                        </div>
                        <div class="form-group">
                            <label for="cliente_telefono" class="form-label">Teléfono *</label>
                            <input type="tel" id="cliente_telefono" name="cliente_telefono" class="form-input" placeholder="Ej: 70012345" required>
                        </div>
                    </div>
                </div>

                <!-- Route Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                        Detalles de la Ruta
                    </h3>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="origen" class="form-label">Origen *</label>
                            <input type="text" id="origen" name="origen" class="form-input" placeholder="Dirección de recogida" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label for="destino" class="form-label">Destino *</label>
                            <input type="text" id="destino" name="destino" class="form-input" placeholder="Dirección de destino" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="distancia_km" class="form-label">Distancia Estimada (km)</label>
                            <input type="number" id="distancia_km" name="distancia_km" class="form-input" placeholder="Ej: 5.2" step="0.1" min="0">
                        </div>
                        <div class="form-group">
                            <label for="tiempo_estimado_min" class="form-label">Tiempo Estimado (min)</label>
                            <input type="number" id="tiempo_estimado_min" name="tiempo_estimado_min" class="form-input" placeholder="Ej: 15" min="0">
                        </div>
                    </div>
                </div>

                <!-- Assignment & Payment -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        Asignación y Pago
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="conductor_id" class="form-label">Conductor Asignado</label>
                            <div class="select-wrapper">
                                <select id="conductor_id" name="conductor_id" class="form-select">
                                    <option value="">Seleccionar Conductor</option>
                                    @foreach(\App\Models\Conductor::where('estado', 'activo')->get() as $conductor)
                                        <option value="{{ $conductor->id }}">{{ $conductor->nombre }} {{ $conductor->apellido }}</option>
                                    @endforeach
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vehiculo_id" class="form-label">Vehículo</label>
                            <div class="select-wrapper">
                                <select id="vehiculo_id" name="vehiculo_id" class="form-select">
                                    <option value="">Seleccionar Vehículo</option>
                                    @foreach(\App\Models\Vehiculo::where('estado', 'activo')->get() as $vehiculo)
                                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->placa }} - {{ $vehiculo->marca }}</option>
                                    @endforeach
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="valor_total" class="form-label">Monto Total (Bs) *</label>
                            <input type="number" id="valor_total" name="valor_total" class="form-input" placeholder="0.00" step="0.50" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="metodo_pago" class="form-label">Método de Pago</label>
                            <div class="select-wrapper">
                                <select id="metodo_pago" name="metodo_pago" class="form-select">
                                    <option value="efectivo" selected>Efectivo</option>
                                    <option value="qr">QR</option>
                                    <option value="transferencia">Transferencia</option>
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-textarea" placeholder="Notas adicionales sobre el viaje..." rows="3"></textarea>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/viajes/crear.js') }}"></script>
@endsection