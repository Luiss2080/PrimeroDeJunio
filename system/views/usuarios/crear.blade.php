@extends('layouts.dashboard')

@section('title', 'Nuevo Usuario - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/usuarios/crear.css') }}?v={{ time() }}">

    <div class="usuarios-create-container">
        
        <!-- Header -->
        <div class="create-header-container">
            <div class="header-top">
                <a href="{{ route('usuarios.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Cancelar y Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Registrar Nuevo Usuario</h1>
                </div>
                <div class="header-actions-group">
                    <button type="submit" form="createForm" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span>Guardar Usuario</span>
                    </button>
                </div>
            </div>
        </div>

        <form id="createForm" action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data" class="create-form-grid">
            @csrf

            <!-- Left Column: Avatar & Status -->
            <aside class="create-sidebar">
                <div class="glass-card centered-card">
                    <div class="avatar-upload-wrapper">
                        <img src="https://ui-avatars.com/api/?name=Nuevo+Usuario&background=00ff66&color=000&size=256" id="photoPreview" class="avatar-preview" alt="Vista previa">
                        <label for="photoInput" class="avatar-upload-btn" title="Subir Foto">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        </label>
                        <input type="file" id="photoInput" name="avatar" accept="image/*" hidden>
                    </div>
                    <h3 class="sidebar-name">Nuevo Usuario</h3>
                    <p class="sidebar-role">Perfil de Sistema</p>

                    <div class="form-group full-width mt-4">
                        <label for="estado" class="form-label">Estado Inicial</label>
                        <div class="select-wrapper">
                            <select id="estado" name="estado" class="form-select">
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                                <option value="suspendido">Suspendido</option>
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
                                    <option value="{{ $rol->id }}">{{ ucfirst($rol->nombre) }}</option>
                                @endforeach
                            </select>
                            <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Información del Sistema -->
                <div class="glass-card mt-4">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1v6m0 6v6m-6-6h6m6 0h-6"/></svg>
                        Información
                    </h3>
                    <div class="system-info-list">
                        <div class="sys-item">
                            <span class="sys-label">Fecha de Registro</span>
                            <span class="sys-value">{{ now()->format('d/m/Y') }}</span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">IP Registro</span>
                            <span class="sys-value">{{ request()->ip() }}</span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Form Fields -->
            <div class="create-main-content">
                
                <!-- Personal Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Información Personal
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre(s) *</label>
                            <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Ej: Juan" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="form-label">Apellido(s) *</label>
                            <input type="text" id="apellido" name="apellido" class="form-input" placeholder="Ej: Pérez" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-input">
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
                            <input type="email" id="email" name="email" class="form-input" placeholder="Ej: usuario@ejemplo.com" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label">Teléfono / Celular</label>
                            <input type="tel" id="telefono" name="telefono" class="form-input" placeholder="Ej: 70012345">
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="direccion" class="form-label">Dirección de Domicilio</label>
                        <input type="text" id="direccion" name="direccion" class="form-input" placeholder="Ej: Av. Banzer, Calle 3 #45">
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
                            <label for="password" class="form-label">Contraseña *</label>
                            <input type="password" id="password" name="password" class="form-input" placeholder="********" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="********" required>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/usuarios/crear.js') }}"></script>
    <script>
        // Validación adicional del formulario y preview de avatar
        document.addEventListener('DOMContentLoaded', function() {
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const previewImg = document.getElementById('photoPreview');

            // Actualizar preview del avatar cuando cambien nombre/apellido
            function updateAvatarPreview() {
                const nombre = nombreInput.value || 'Nuevo';
                const apellido = apellidoInput.value || 'Usuario';
                const initials = `${nombre}+${apellido}`;
                // Solo actualizar si no hay una imagen subida (esto es una mejora simple, idealmente verificar si file input tiene archivo)
                const photoInput = document.getElementById('photoInput');
                if (!photoInput.files || !photoInput.files.length) {
                    previewImg.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(initials)}&background=00ff66&color=000&size=256`;
                }
            }

            nombreInput.addEventListener('input', updateAvatarPreview);
            apellidoInput.addEventListener('input', updateAvatarPreview);
        });
    </script>
@endsection