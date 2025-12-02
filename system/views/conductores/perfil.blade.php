@extends('layouts.dashboard')

@section('title', 'Perfil de Conductor - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/perfil.css') }}">

    <div class="conductores-profile-container">
        
        <!-- Header with Back Button -->
        <div class="page-header">
            <div class="header-left">
                <a href="{{ url('/conductores') }}" class="btn-back" style="color: #fff; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Volver al Listado
                </a>
                <h1 class="page-title">Perfil de Conductor</h1>
            </div>
            <div class="header-actions">
                <a href="{{ url('/conductores/editar') }}" class="btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Editar Perfil
                </a>
            </div>
        </div>

        <div class="profile-container">
            <!-- Left Column: Profile Card -->
            <div class="profile-card">
                <img src="https://ui-avatars.com/api/?name=Juan+Perez&background=00ff66&color=000&size=256" alt="Avatar" class="profile-avatar">
                <h2 class="profile-name">Juan Pérez</h2>
                <div class="profile-role">Conductor Profesional</div>
                
                <div class="profile-stats-grid">
                    <div class="stat-item">
                        <span class="stat-value">4.8</span>
                        <span class="stat-label">Calificación</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">1,240</span>
                        <span class="stat-label">Viajes</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">3A</span>
                        <span class="stat-label">Antigüedad</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">98%</span>
                        <span class="stat-label">Asistencia</span>
                    </div>
                </div>

                <div class="profile-contact-info">
                    <div class="contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <span>+591 700-12345</span>
                    </div>
                    <div class="contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <span>juan.perez@email.com</span>
                    </div>
                    <div class="contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Av. Principal #123, Zona Norte</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="profile-content">
                <!-- Vehicle Info -->
                <div class="content-section">
                    <h3 class="section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                        Vehículo Asignado
                    </h3>
                    <div class="vehicle-card">
                        <div class="vehicle-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                        </div>
                        <div class="vehicle-details">
                            <h4>Toyota Corolla (2018)</h4>
                            <span class="vehicle-plate">2024-ABC</span>
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="content-section">
                    <h3 class="section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        Documentación
                    </h3>
                    <div class="documents-list">
                        <div class="document-item">
                            <div class="doc-info">
                                <svg class="doc-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                <span class="doc-name">Licencia de Conducir (Cat. C)</span>
                            </div>
                            <span class="doc-status status-valid">Vigente hasta 2026</span>
                        </div>
                        <div class="document-item">
                            <div class="doc-info">
                                <svg class="doc-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                <span class="doc-name">Seguro contra Accidentes</span>
                            </div>
                            <span class="doc-status status-valid">Vigente</span>
                        </div>
                        <div class="document-item">
                            <div class="doc-info">
                                <svg class="doc-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                                <span class="doc-name">Antecedentes Penales</span>
                            </div>
                            <span class="doc-status status-valid">Verificado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/perfil.js') }}"></script>
@endsection