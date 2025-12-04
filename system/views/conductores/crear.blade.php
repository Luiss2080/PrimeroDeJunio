@extends('layouts.dashboard')

@section('title', 'Nuevo Conductor - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/crear.css') }}?v={{ time() }}">

    <div class="conductores-create-container">
        
        <!-- Header -->
        <div class="create-header-container">
            <div class="header-top">
                <a href="{{ route('conductores.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Cancelar y Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Registrar Nuevo Conductor</h1>
                </div>
                <div class="header-actions-group">
                    <button type="submit" form="createForm" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span>Guardar Conductor</span>
                    </button>
                </div>
            </div>
        </div>

        <form id="createForm" action="{{ route('conductores.store') }}" method="POST" enctype="multipart/form-data" class="create-form-grid">
            @csrf

            <!-- Left Column: Avatar & Status -->
            <aside class="create-sidebar">
                <div class="glass-card centered-card">
                    <div class="avatar-upload-wrapper">
                        <img src="https://ui-avatars.com/api/?name=Nuevo+Conductor&background=00ff66&color=000&size=256" id="photoPreview" class="avatar-preview" alt="Vista previa">
                        <label for="photoInput" class="avatar-upload-btn" title="Subir Foto">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        </label>
                        <input type="file" id="photoInput" name="foto" accept="image/*" hidden>
                    </div>
                    <h3 class="sidebar-name">Nuevo Conductor</h3>
                    <p class="sidebar-role">Perfil Profesional</p>

                    <div class="form-group full-width mt-4">
                        <label for="estado" class="form-label">Estado Inicial</label>
                        <div class="select-wrapper">
                            <select id="estado" name="estado" class="form-select">
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                            <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Documentación Necesaria -->
                <div class="glass-card mt-4">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Requisitos
                    </h3>
                    <ul class="doc-checklist">
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>Cédula de Identidad</span>
                        </li>
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>Licencia de Conducir</span>
                        </li>
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>Antecedentes Penales</span>
                        </li>
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>Croquis de Domicilio</span>
                        </li>
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>Garantía (Opcional)</span>
                        </li>
                    </ul>
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
                            <label for="cedula" class="form-label">Cédula de Identidad *</label>
                            <input type="text" id="cedula" name="cedula" class="form-input" placeholder="Ej: 1234567 SC" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="grupo_sanguineo" class="form-label">Grupo Sanguíneo</label>
                            <div class="select-wrapper">
                                <select id="grupo_sanguineo" name="grupo_sanguineo" class="form-select">
                                    <option value="">Seleccionar</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
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
                            <input type="tel" id="telefono" name="telefono" class="form-input" placeholder="Ej: 70012345" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="Ej: conductor@ejemplo.com">
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="direccion" class="form-label">Dirección de Domicilio</label>
                        <input type="text" id="direccion" name="direccion" class="form-input" placeholder="Ej: Av. Banzer, Calle 3 #45">
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/></svg>
                        Información Profesional
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="licencia" class="form-label">Número de Licencia *</label>
                            <input type="text" id="licencia" name="licencia" class="form-input" placeholder="Ej: 1234567-C" required>
                        </div>
                        <div class="form-group">
                            <label for="categoria" class="form-label">Categoría</label>
                            <div class="select-wrapper">
                                <select id="categoria" name="categoria" class="form-select">
                                    <option value="P">Categoría P (Profesional)</option>
                                    <option value="A">Categoría A</option>
                                    <option value="B">Categoría B</option>
                                    <option value="C">Categoría C</option>
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="observaciones" class="form-label">Observaciones Adicionales</label>
                        <textarea id="observaciones" name="observaciones" class="form-textarea" placeholder="Información adicional relevante..."></textarea>
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
                            <input type="text" id="contacto_emergencia_nombre" name="contacto_emergencia_nombre" class="form-input" placeholder="Nombre completo">
                        </div>
                        <div class="form-group">
                            <label for="contacto_emergencia_telefono" class="form-label">Teléfono de Emergencia</label>
                            <input type="tel" id="contacto_emergencia_telefono" name="contacto_emergencia_telefono" class="form-input" placeholder="Número de contacto">
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/crear.js') }}"></script>
@endsection