@extends('layouts.dashboard')

@section('title', 'Nuevo Vehículo - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/vehiculos/crear.css') }}?v={{ time() }}">

    <div class="vehiculos-create-container">
        
        <!-- Header -->
        <div class="create-header-container">
            <div class="header-top">
                <a href="{{ route('vehiculos.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Cancelar y Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Registrar Nuevo Vehículo</h1>
                </div>
                <div class="header-actions-group">
                    <button type="submit" form="createForm" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span>Guardar Vehículo</span>
                    </button>
                </div>
            </div>
        </div>

        <form id="createForm" action="{{ route('vehiculos.store') }}" method="POST" enctype="multipart/form-data" class="create-form-grid">
            @csrf

            <!-- Left Column: Avatar & Status -->
            <aside class="create-sidebar">
                <div class="glass-card centered-card">
                    <div class="avatar-upload-wrapper">
                        <img src="https://ui-avatars.com/api/?name=Nuevo+Vehiculo&background=00ff66&color=000&size=256" id="photoPreview" class="avatar-preview" alt="Vista previa">
                        <label for="photoInput" class="avatar-upload-btn" title="Subir Foto">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        </label>
                        <input type="file" id="photoInput" name="foto" accept="image/*" hidden>
                    </div>
                    <h3 class="sidebar-name">Nuevo Vehículo</h3>
                    <p class="sidebar-role">Detalles del Vehículo</p>

                    <div class="form-group full-width mt-4">
                        <label for="estado" class="form-label">Estado Inicial</label>
                        <div class="select-wrapper">
                            <select id="estado" name="estado" class="form-select">
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                                <option value="mantenimiento">Mantenimiento</option>
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
                            <span class="sys-label">Viajes Realizados</span>
                            <span class="sys-value">0</span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Estado de Documentos</span>
                            <span class="sys-value">Pendiente</span>
                        </div>
                        <div class="sys-item">
                            <span class="sys-label">Fecha de Registro</span>
                            <span class="sys-value">{{ now()->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Documentación Necesaria -->
                <div class="glass-card mt-4">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Documentación Requerida
                    </h3>
                    <ul class="doc-checklist">
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>SOAT Vigente</span>
                        </li>
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>Inspección Técnica</span>
                        </li>
                        <li class="doc-item">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span>RUAT</span>
                        </li>
                        <li class="doc-item required">
                            <div class="doc-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            </div>
                            <span>Fotos del Vehículo</span>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Right Column: Form Fields -->
            <div class="create-main-content">
                
                <!-- Información del Vehículo -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
                        Información del Vehículo
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="placa" class="form-label">Placa *</label>
                            <input type="text" id="placa" name="placa" class="form-input" placeholder="Ej: 1234-ABC" required style="text-transform: uppercase;">
                        </div>
                        <div class="form-group">
                            <label for="marca" class="form-label">Marca *</label>
                            <input type="text" id="marca" name="marca" class="form-input" placeholder="Ej: Toyota" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo" class="form-label">Modelo *</label>
                            <input type="text" id="modelo" name="modelo" class="form-input" placeholder="Ej: Corolla" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ano" class="form-label">Año *</label>
                            <input type="number" id="ano" name="ano" class="form-input" placeholder="Ej: 2020" min="1900" max="{{ date('Y') + 1 }}" required>
                        </div>
                        <div class="form-group">
                            <label for="color" class="form-label">Color *</label>
                            <input type="text" id="color" name="color" class="form-input" placeholder="Ej: Blanco" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo_combustible" class="form-label">Tipo de Combustible</label>
                            <div class="select-wrapper">
                                <select id="tipo_combustible" name="tipo_combustible" class="form-select">
                                    <option value="">Seleccionar</option>
                                    <option value="Gasolina">Gasolina</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="GNV">GNV</option>
                                    <option value="Hibrido">Híbrido</option>
                                    <option value="Electrico">Eléctrico</option>
                                </select>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                         <div class="form-group">
                            <label for="capacidad_pasajeros" class="form-label">Capacidad de Pasajeros</label>
                            <input type="number" id="capacidad_pasajeros" name="capacidad_pasajeros" class="form-input" placeholder="Ej: 4" min="1" max="50">
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
                            <input type="text" id="propietario_nombre" name="propietario_nombre" class="form-input" placeholder="Ej: Juan Pérez" required>
                        </div>
                        <div class="form-group">
                            <label for="propietario_cedula" class="form-label">Cédula de Identidad</label>
                            <input type="text" id="propietario_cedula" name="propietario_cedula" class="form-input" placeholder="Ej: 1234567 SC">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="propietario_telefono" class="form-label">Teléfono / Celular *</label>
                            <input type="tel" id="propietario_telefono" name="propietario_telefono" class="form-input" placeholder="Ej: 70012345" required>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="glass-card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Observaciones Adicionales
                    </h3>
                    <div class="form-group full-width">
                        <label for="observaciones" class="form-label">Detalles o notas sobre el vehículo</label>
                        <textarea id="observaciones" name="observaciones" class="form-textarea" placeholder="Información adicional relevante..." rows="3"></textarea>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/vehiculos/crear.js') }}"></script>
    <script>
        // Validación adicional del formulario
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('createForm');
            const previewImg = document.getElementById('photoPreview');
            const photoInput = document.getElementById('photoInput');
            const propietarioInput = document.getElementById('propietario_nombre');
            const placaInput = document.getElementById('placa');

            // Actualizar preview del avatar cuando cambie el nombre del propietario
            function updateAvatarPreview() {
                const nombre = propietarioInput.value || 'Nuevo Vehiculo';
                previewImg.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(nombre)}&background=00ff66&color=000&size=256`;
            }

            propietarioInput.addEventListener('input', updateAvatarPreview);

            // Preview de imagen subida
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Validación antes de enviar
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let hasErrors = false;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('error');
                        hasErrors = true;
                    } else {
                        field.classList.remove('error');
                    }
                });

                if (hasErrors) {
                    e.preventDefault();
                    alert('Por favor, complete todos los campos obligatorios marcados con (*)');
                }
            });
            
            // Auto-uppercase for Placa
            placaInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        });
    </script>
@endsection