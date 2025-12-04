@extends('layouts.dashboard')

@section('title', 'Editar Conductor - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/editar.css') }}">

    <div class="conductores-edit-container">
        
        <!-- Header -->
        <div class="edit-header-container">
            <div class="header-top">
                <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Cancelar y Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Editar Conductor</h1>
                    <span class="conductor-id">ID: #CND-{{ str_pad($conductor->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="header-actions-group">
                    <button type="submit" form="editForm" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </div>
        </div>

        <form id="editForm" action="{{ route('conductores.update', $conductor->id) }}" method="POST" enctype="multipart/form-data" class="edit-form-grid">
            @csrf
            @method('PUT')

            <!-- Left Column: Avatar & Status -->
            <aside class="edit-sidebar">
                <div class="glass-card centered-card">
                    <div class="avatar-upload-wrapper">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($conductor->nombre . ' ' . $conductor->apellido) }}&background=00ff66&color=000&size=256" id="photoPreview" class="avatar-preview" alt="Vista previa">
                        <label for="photoInput" class="avatar-upload-btn" title="Cambiar Foto">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        </label>
                        <input type="file" id="photoInput" name="foto" accept="image/*" hidden>
                    </div>
                    <h3 class="sidebar-name">{{ $conductor->nombre }} {{ $conductor->apellido }}</h3>
                    <p class="sidebar-role">Conductor Profesional</p>

                    <div class="form-group full-width mt-4">
                        <label for="estado" class="form-label">Estado del Conductor</label>
                        <select id="estado" name="estado" class="form-select status-select">
                            <option value="activo" {{ $conductor->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $conductor->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="suspendido" {{ $conductor->estado == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                        </select>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Form Fields -->
            <div class="edit-main-content">
                
                <!-- Personal Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Información Personal
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre(s) *</label>
                            <input type="text" id="nombre" name="nombre" class="form-input" value="{{ $conductor->nombre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="form-label">Apellido(s) *</label>
                            <input type="text" id="apellido" name="apellido" class="form-input" value="{{ $conductor->apellido }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cedula" class="form-label">Cédula de Identidad *</label>
                            <input type="text" id="cedula" name="cedula" class="form-input" value="{{ $conductor->cedula }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-input" value="{{ $conductor->fecha_nacimiento }}">
                        </div>
                        <div class="form-group">
                            <label for="grupo_sanguineo" class="form-label">Grupo Sanguíneo</label>
                            <select id="grupo_sanguineo" name="grupo_sanguineo" class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="O+" {{ $conductor->grupo_sanguineo == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ $conductor->grupo_sanguineo == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="A+" {{ $conductor->grupo_sanguineo == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ $conductor->grupo_sanguineo == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ $conductor->grupo_sanguineo == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ $conductor->grupo_sanguineo == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ $conductor->grupo_sanguineo == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ $conductor->grupo_sanguineo == 'AB-' ? 'selected' : '' }}>AB-</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Información de Contacto
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="telefono" class="form-label">Teléfono / Celular *</label>
                            <input type="tel" id="telefono" name="telefono" class="form-input" value="{{ $conductor->telefono }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-input" value="{{ $conductor->email }}">
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="direccion" class="form-label">Dirección de Domicilio</label>
                        <input type="text" id="direccion" name="direccion" class="form-input" value="{{ $conductor->direccion }}">
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        Contacto de Emergencia
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contacto_emergencia_nombre" class="form-label">Nombre del Contacto</label>
                            <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" class="form-input" value="{{ $conductor->contacto_emergencia_nombre }}">
                        </div>
                        <div class="form-group">
                            <label for="contacto_emergencia_telefono" class="form-label">Teléfono de Emergencia</label>
                            <input type="tel" id="contacto_emergencia_telefono" name="contacto_emergencia_telefono" class="form-input" value="{{ $conductor->contacto_emergencia_telefono }}">
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/editar.js') }}"></script>
@endsection