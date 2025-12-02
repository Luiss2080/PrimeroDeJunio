@extends('layouts.dashboard')

@section('title', 'Nuevo Conductor - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/crear.css') }}">

    <div class="conductores-create-container">
        
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">Registrar Nuevo Conductor</h1>
                <p class="form-subtitle">Ingresa la información personal y profesional del conductor.</p>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-grid">
                    <!-- Foto de Perfil -->
                    <div class="full-width">
                        <div class="form-group">
                            <label class="form-label">Fotografía del Conductor</label>
                            <div class="photo-upload-container">
                                <img src="https://ui-avatars.com/api/?name=Nuevo+Conductor&background=333&color=fff" id="photoPreview" class="photo-preview" alt="Vista previa">
                                <div class="upload-text">
                                    <span class="upload-btn">Haz clic para subir una foto</span> o arrastra el archivo aquí
                                </div>
                                <input type="file" id="photoInput" name="foto" accept="image/*" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <!-- Información Personal -->
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre Completo *</label>
                        <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Ej: Juan Pérez" required>
                    </div>

                    <div class="form-group">
                        <label for="ci" class="form-label">Cédula de Identidad *</label>
                        <input type="text" id="ci" name="ci" class="form-input" placeholder="Ej: 1234567 SC" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono / Celular *</label>
                        <input type="tel" id="telefono" name="telefono" class="form-input" placeholder="Ej: 70012345" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Ej: juan@email.com">
                    </div>

                    <div class="form-group full-width">
                        <label for="direccion" class="form-label">Dirección de Domicilio</label>
                        <input type="text" id="direccion" name="direccion" class="form-input" placeholder="Ej: Av. Banzer, Calle 3 #45">
                    </div>

                    <!-- Información Profesional -->
                    <div class="form-group">
                        <label for="licencia" class="form-label">Número de Licencia *</label>
                        <input type="text" id="licencia" name="licencia" class="form-input" placeholder="Ej: 1234567-C" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria" class="form-label">Categoría de Licencia</label>
                        <select id="categoria" name="categoria" class="form-select">
                            <option value="A">Categoría A</option>
                            <option value="B">Categoría B</option>
                            <option value="C">Categoría C</option>
                            <option value="P">Categoría P (Profesional)</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="observaciones" class="form-label">Observaciones Adicionales</label>
                        <textarea id="observaciones" name="observaciones" class="form-textarea" placeholder="Información adicional relevante..."></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ url('/conductores') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Guardar Conductor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/crear.js') }}"></script>
@endsection