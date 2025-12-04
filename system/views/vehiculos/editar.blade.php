@extends('layouts.dashboard')

@section('title', 'Editar Vehículo - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/vehiculos/editar.css') }}?v={{ time() }}">

    <div class="vehiculos-edit-container">
        
        <!-- Header -->
        <div class="edit-header-container">
            <div class="header-top">
                <a href="{{ route('vehiculos.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Cancelar y Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Editar Vehículo</h1>
                    <span class="vehiculo-id">ID: #VEH-{{ str_pad($vehiculo->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="header-actions-group">
                    <button type="submit" form="editForm" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </div>
        </div>

        <form id="editForm" action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST" enctype="multipart/form-data" class="edit-form-grid">
            @csrf
            @method('PUT')

            <!-- Left Column: Avatar & Status -->
            <aside class="edit-sidebar">
                <div class="glass-card centered-card">
                    <div class="avatar-upload-wrapper">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($vehiculo->propietario_nombre) }}&background=00ff66&color=000&size=256" id="photoPreview" class="avatar-preview" alt="Vista previa">
                        <label for="photoInput" class="avatar-upload-btn" title="Cambiar Foto">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        </label>
                        <input type="file" id="photoInput" name="foto" accept="image/*" hidden>
                    </div>
                    <h3 class="sidebar-name">{{ $vehiculo->placa }}</h3>
                    <p class="sidebar-role">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</p>

                    <div class="form-group full-width mt-4">
                        <label for="estado" class="form-label">Estado del Vehículo</label>
                        <div class="select-wrapper">
                            <select id="estado" name="estado" class="form-select status-select">
                                <option value="activo" {{ $vehiculo->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ $vehiculo->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="mantenimiento" {{ $vehiculo->estado == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                            </select>
                            <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <!-- System Information Card -->
                <div class="glass-card">
                    <h3 class="card-title-sm">Información del Sistema</h3>
                    <div class="system-info-list">
                        <div class="sys-item">
                            <span class="sys-label">Fecha de Registro</span>
                            <span class="sys-value">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                {{ $vehiculo->created_at ? $vehiculo->created_at->format('d/m/Y') : 'No registrada' }}
                            </span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Última Actualización</span>
                            <span class="sys-value">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/></svg>
                                {{ $vehiculo->updated_at ? $vehiculo->updated_at->diffForHumans() : 'N/A' }}
                            </span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Documentación</span>
                            <span class="sys-badge {{ $vehiculo->documentacion_completa ? 'verified' : 'pending' }}">
                                {{ $vehiculo->documentacion_completa ? 'Completa' : 'Pendiente' }}
                            </span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Form Fields -->
            <div class="edit-main-content">
                
                <!-- Información del Vehículo -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                        Información del Vehículo
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="placa" class="form-label">Placa *</label>
                            <input type="text" id="placa" name="placa" class="form-input" value="{{ $vehiculo->placa }}" required style="text-transform: uppercase;">
                        </div>
                        <div class="form-group">
                            <label for="marca" class="form-label">Marca *</label>
                            <input type="text" id="marca" name="marca" class="form-input" value="{{ $vehiculo->marca }}" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo" class="form-label">Modelo *</label>
                            <input type="text" id="modelo" name="modelo" class="form-input" value="{{ $vehiculo->modelo }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ano" class="form-label">Año *</label>
                            <input type="number" id="ano" name="ano" class="form-input" value="{{ $vehiculo->ano }}" min="1900" max="{{ date('Y') + 1 }}" required>
                        </div>
                        <div class="form-group">
                            <label for="color" class="form-label">Color *</label>
                            <input type="text" id="color" name="color" class="form-input" value="{{ $vehiculo->color }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo_combustible" class="form-label">Tipo de Combustible</label>
                            <div class="select-wrapper">
                                <select id="tipo_combustible" name="tipo_combustible" class="form-select">
                                    <option value="">Seleccionar</option>
                                    <option value="Gasolina" {{ $vehiculo->tipo_combustible == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                                    <option value="Diesel" {{ $vehiculo->tipo_combustible == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="GNV" {{ $vehiculo->tipo_combustible == 'GNV' ? 'selected' : '' }}>GNV</option>
                                    <option value="Hibrido" {{ $vehiculo->tipo_combustible == 'Hibrido' ? 'selected' : '' }}>Híbrido</option>
                                    <option value="Electrico" {{ $vehiculo->tipo_combustible == 'Electrico' ? 'selected' : '' }}>Eléctrico</option>
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                         <div class="form-group">
                            <label for="capacidad_pasajeros" class="form-label">Capacidad de Pasajeros</label>
                            <input type="number" id="capacidad_pasajeros" name="capacidad_pasajeros" class="form-input" value="{{ $vehiculo->capacidad_pasajeros }}" min="1" max="50">
                        </div>
                    </div>
                </div>

                <!-- Información del Propietario -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Información del Propietario
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="propietario_nombre" class="form-label">Nombre Completo *</label>
                            <input type="text" id="propietario_nombre" name="propietario_nombre" class="form-input" value="{{ $vehiculo->propietario_nombre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="propietario_cedula" class="form-label">Cédula de Identidad</label>
                            <input type="text" id="propietario_cedula" name="propietario_cedula" class="form-input" value="{{ $vehiculo->propietario_cedula }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="propietario_telefono" class="form-label">Teléfono / Celular *</label>
                            <input type="tel" id="propietario_telefono" name="propietario_telefono" class="form-input" value="{{ $vehiculo->propietario_telefono }}" required>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4-4 4-4h6a2 2 0 0 1 2 2v4z"/><path d="M18 9h4l-4 4-4-4h4z"/></svg>
                        Observaciones Adicionales
                    </h3>
                    <div class="form-group full-width">
                        <label for="observaciones" class="form-label">Detalles o notas sobre el vehículo</label>
                        <textarea id="observaciones" name="observaciones" class="form-textarea" rows="4" placeholder="Información adicional relevante...">{{ $vehiculo->observaciones }}</textarea>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/vehiculos/editar.js') }}"></script>
@endsection