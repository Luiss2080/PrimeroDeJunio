@extends('layouts.dashboard')

@section('title', 'Editar Usuario - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/usuarios/editar.css') }}?v={{ time() }}">

    <div class="usuarios-edit-container">
        
        <!-- Header -->
        <div class="edit-header-container">
            <div class="header-top">
                <a href="{{ route('usuarios.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Cancelar y Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Editar Usuario</h1>
                    <span class="user-id">ID: #USR-{{ str_pad($usuario->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="header-actions-group">
                    <button type="submit" form="editForm" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </div>
        </div>

        <form id="editForm" action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data" class="edit-form-grid">
            @csrf
            @method('PUT')

            <!-- Left Column: Avatar & Status -->
            <aside class="edit-sidebar">
                <div class="glass-card centered-card">
                    <div class="avatar-upload-wrapper">
                        @if($usuario->avatar)
                            <img src="{{ asset('storage/' . $usuario->avatar) }}" id="photoPreview" class="avatar-preview" alt="Avatar">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nombre . ' ' . $usuario->apellido) }}&background=00ff66&color=000&size=256" id="photoPreview" class="avatar-preview" alt="Vista previa">
                        @endif
                        <label for="photoInput" class="avatar-upload-btn" title="Cambiar Foto">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        </label>
                        <input type="file" id="photoInput" name="avatar" accept="image/*" hidden>
                    </div>
                    <h3 class="sidebar-name">{{ $usuario->nombre }} {{ $usuario->apellido }}</h3>
                    <p class="sidebar-role">{{ ucfirst($usuario->rol->nombre ?? 'Usuario') }}</p>

                    <div class="form-group full-width mt-4">
                        <label for="estado" class="form-label">Estado del Usuario</label>
                        <div class="select-wrapper">
                            <select id="estado" name="estado" class="form-select status-select">
                                <option value="activo" {{ $usuario->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ $usuario->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                <option value="suspendido" {{ $usuario->estado == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                            </select>
                            <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>

                    <div class="form-group full-width mt-4">
                        <label for="rol_id" class="form-label">Rol de Usuario</label>
                        <div class="select-wrapper">
                            <select id="rol_id" name="rol_id" class="form-select" required>
                                <option value="">Seleccionar Rol</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}" {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>{{ ucfirst($rol->nombre) }}</option>
                                @endforeach
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
                                {{ $usuario->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Última Actualización</span>
                            <span class="sys-value">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/></svg>
                                {{ $usuario->updated_at->diffForHumans() }}
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
                            <input type="text" id="nombre" name="nombre" class="form-input" value="{{ $usuario->nombre }}" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="form-label">Apellido(s) *</label>
                            <input type="text" id="apellido" name="apellido" class="form-input" value="{{ $usuario->apellido }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-input" value="{{ $usuario->fecha_nacimiento }}">
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
                            <label for="email" class="form-label">Correo Electrónico *</label>
                            <input type="email" id="email" name="email" class="form-input" value="{{ $usuario->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label">Teléfono / Celular</label>
                            <input type="tel" id="telefono" name="telefono" class="form-input" value="{{ $usuario->telefono }}">
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="direccion" class="form-label">Dirección de Domicilio</label>
                        <input type="text" id="direccion" name="direccion" class="form-input" value="{{ $usuario->direccion }}">
                    </div>
                </div>

                <!-- Security Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        Seguridad de la Cuenta
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">Nueva Contraseña (Opcional)</label>
                            <input type="password" id="password" name="password" class="form-input" placeholder="Dejar en blanco para mantener actual">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="********">
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/usuarios/editar.js') }}"></script>
@endsection