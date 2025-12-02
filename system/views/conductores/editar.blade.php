@extends('layouts.dashboard')

@section('title', 'Editar Conductor - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/editar.css') }}">

    <div class="conductores-edit-container">
        
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">Editar Conductor</h1>
                <p class="form-subtitle">Actualiza la información del conductor.</p>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <!-- Foto de Perfil -->
                    <div class="full-width">
                        <div class="form-group">
                            <label class="form-label">Fotografía del Conductor</label>
                            <div class="photo-upload-container">
                                <img src="https://ui-avatars.com/api/?name=Juan+Perez&background=00ff66&color=000" id="photoPreview" class="photo-preview" alt="Vista previa">
                                <div class="upload-text">
                                    <span class="upload-btn">Haz clic para cambiar la foto</span>
                                </div>
                                <input type="file" id="photoInput" name="foto" accept="image/*" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <!-- Información Personal -->
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre Completo *</label>
                        <input type="text" id="nombre" name="nombre" class="form-input" value="Juan Pérez" required>
                    </div>

                    <div class="form-group">
                        <label for="ci" class="form-label">Cédula de Identidad *</label>
                        <input type="text" id="ci" name="ci" class="form-input" value="1234567 SC" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono / Celular *</label>
                        <input type="tel" id="telefono" name="telefono" class="form-input" value="70012345" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-input" value="juan.perez@email.com">
                    </div>

                    <div class="form-group full-width">
                        <label for="direccion" class="form-label">Dirección de Domicilio</label>
                        <input type="text" id="direccion" name="direccion" class="form-input" value="Av. Principal #123">
                    </div>

                    <!-- Información Profesional -->
                    <div class="form-group">
                        <label for="licencia" class="form-label">Número de Licencia *</label>
                        <input type="text" id="licencia" name="licencia" class="form-input" value="1234567-C" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria" class="form-label">Categoría de Licencia</label>
                        <select id="categoria" name="categoria" class="form-select">
                            <option value="A">Categoría A</option>
                            <option value="B">Categoría B</option>
                            <option value="C" selected>Categoría C</option>
                            <option value="P">Categoría P (Profesional)</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="estado" class="form-label">Estado del Conductor</label>
                        <select id="estado" name="estado" class="form-select">
                            <option value="activo" selected>Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="suspendido">Suspendido</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ url('/conductores') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-submit">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Actualizar Conductor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/editar.js') }}"></script>
@endsection