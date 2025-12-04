@extends('layouts.dashboard')

@section('title', 'Perfil de Usuario - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/usuarios/perfil.css') }}?v={{ time() }}">

    <div class="usuarios-profile-container">
        
        <!-- Header with Back Button and Actions -->
        <div class="profile-header-container">
            <div class="header-top">
                <a href="{{ route('usuarios.index') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    <span>Volver</span>
                </a>
            </div>
            
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Perfil de Usuario</h1>
                    <span class="user-id">ID: #USR-{{ str_pad($usuario->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="header-actions-group">
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        <span>Editar Perfil</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="profile-grid">
            <!-- Left Column: Profile Card -->
            <aside class="profile-sidebar">
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="avatar-container">
                            @if($usuario->avatar)
                                <img src="{{ asset('storage/' . $usuario->avatar) }}" alt="Avatar" class="profile-avatar">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nombre . ' ' . $usuario->apellido) }}&background=00ff66&color=000&size=256" alt="Avatar" class="profile-avatar">
                            @endif
                            <div class="status-indicator {{ $usuario->estado === 'activo' ? 'active' : '' }}" title="{{ ucfirst($usuario->estado) }}"></div>
                        </div>
                        <h2 class="profile-name">{{ $usuario->nombre }} {{ $usuario->apellido }}</h2>
                        <div class="profile-role">{{ ucfirst($usuario->rol->nombre ?? 'Usuario') }}</div>
                        <div class="profile-badges">
                            <span class="status-badge status-{{ $usuario->estado }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($usuario->estado) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="profile-stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            </div>
                            <span class="stat-value">{{ $usuario->created_at->diffForHumans(null, true) }}</span>
                            <span class="stat-label">Antigüedad</span>
                        </div>
                    </div>

                    <!-- New Mini Details Row -->
                    <div class="mini-details-row">
                        <div class="mini-detail">
                            <span class="mini-label">Edad</span>
                            <span class="mini-value">{{ $usuario->fecha_nacimiento ? \Carbon\Carbon::parse($usuario->fecha_nacimiento)->age . ' Años' : 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="profile-contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Móvil Personal</span>
                                <span class="contact-value">{{ $usuario->telefono ?? 'No registrado' }}</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Correo Electrónico</span>
                                <span class="contact-value">{{ $usuario->email }}</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Domicilio</span>
                                <span class="contact-value">{{ Str::limit($usuario->direccion, 25) ?? 'No registrado' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <button class="btn-action-icon call" title="Llamar">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </button>
                        <button class="btn-action-icon email" title="Enviar Email">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </button>
                        <button class="btn-action-icon whatsapp" title="WhatsApp">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Right Column: Main Content -->
            <main class="profile-main">
                <!-- Tabs Navigation -->
                <div class="profile-tabs">
                    <button class="tab-btn active" data-tab="general">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        General
                    </button>
                    <!-- Future tabs can be added here -->
                </div>

                <!-- Tab Content: General -->
                <div class="tab-content active" id="general">
                    <div class="content-section">
                        <h3 class="section-title">Información General</h3>
                        <div class="table-responsive">
                            <table class="simple-table">
                                <tbody>
                                    <tr>
                                        <td>Nombre Completo</td>
                                        <td>{{ $usuario->nombre }} {{ $usuario->apellido }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rol de Usuario</td>
                                        <td>{{ ucfirst($usuario->rol->nombre ?? 'Usuario') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Estado</td>
                                        <td><span class="badge-status status-{{ $usuario->estado }}">{{ ucfirst($usuario->estado) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de Registro</td>
                                        <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Última Actualización</td>
                                        <td>{{ $usuario->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/usuarios/perfil.js') }}"></script>
@endsection