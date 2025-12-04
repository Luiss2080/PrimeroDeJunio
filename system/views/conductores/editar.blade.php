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
                        <div class="select-wrapper">
                            <select id="estado" name="estado" class="form-select status-select">
                                <option value="activo" {{ $conductor->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ $conductor->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="suspendido" {{ $conductor->estado == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                            </select>
                            <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <!-- System Information Card (New) -->
                <div class="glass-card">
                    <h3 class="card-title-sm">Información del Sistema</h3>
                    <div class="system-info-list">
                        <div class="sys-item">
                            <span class="sys-label">Fecha de Ingreso</span>
                            <span class="sys-value">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                {{ $conductor->fecha_ingreso ? \Carbon\Carbon::parse($conductor->fecha_ingreso)->format('d/m/Y') : 'No registrada' }}
                            </span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Última Actualización</span>
                            <span class="sys-value">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/></svg>
                                {{ $conductor->updated_at ? $conductor->updated_at->diffForHumans() : 'N/A' }}
                            </span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Verificación de Antecedentes</span>
                            <span class="sys-badge {{ $conductor->antecedentes_verificados_at ? 'verified' : 'pending' }}">
                                {{ $conductor->antecedentes_verificados_at ? 'Verificado' : 'Pendiente' }}
                            </span>
                        </div>
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
                            <div class="select-wrapper">
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
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
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

                <!-- Professional Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/></svg>
                        Información Profesional
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="experiencia_anos" class="form-label">Años de Experiencia</label>
                            <input type="number" id="experiencia_anos" name="experiencia_anos" class="form-input" value="{{ $conductor->experiencia_anos }}" min="0" max="50">
                        </div>
                        <div class="form-group">
                            <label for="estado_pago" class="form-label">Estado de Pago</label>
                            <div class="select-wrapper">
                                <select id="estado_pago" name="estado_pago" class="form-select">
                                    <option value="al_dia" {{ $conductor->estado_pago == 'al_dia' ? 'selected' : '' }}>Al Día</option>
                                    <option value="mora" {{ $conductor->estado_pago == 'mora' ? 'selected' : '' }}>En Mora</option>
                                    <option value="pendiente" {{ $conductor->estado_pago == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="asistencia_porcentaje" class="form-label">Porcentaje de Asistencia (%)</label>
                            <input type="number" id="asistencia_porcentaje" name="asistencia_porcentaje" class="form-input" value="{{ $conductor->asistencia_porcentaje }}" min="0" max="100">
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4-4 4-4h6a2 2 0 0 1 2 2v4z"/><path d="M18 9h4l-4 4-4-4h4z"/></svg>
                        Información Adicional
                    </h3>
                    <div class="form-group full-width">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-textarea" rows="4" placeholder="Notas adicionales sobre el conductor...">{{ $conductor->observaciones }}</textarea>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/editar.js') }}"></script>
@endsection