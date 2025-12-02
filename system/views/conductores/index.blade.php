@extends('layouts.dashboard')

@section('title', 'Conductores - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/index.css') }}">

    <div class="conductores-index-container">
        
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Gestión de Conductores</h1>
            <div class="header-actions">
                <a href="{{ url('/conductores/crear') }}" class="btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    Nuevo Conductor
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters-container">
            <div class="search-box">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" id="searchDriver" class="search-input" placeholder="Buscar por nombre, licencia o teléfono...">
            </div>
            
            <select id="statusFilter" class="filter-select">
                <option value="todos">Todos los Estados</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Conductor</th>
                        <th>Licencia</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Vehículo Asignado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dummy Data Row 1 -->
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="https://ui-avatars.com/api/?name=Juan+Perez&background=00ff66&color=000" alt="Avatar" class="user-avatar">
                                <div class="user-details">
                                    <span class="user-name">Juan Pérez</span>
                                    <span class="user-email">juan.perez@email.com</span>
                                </div>
                            </div>
                        </td>
                        <td>1234567-SC</td>
                        <td>+591 700-12345</td>
                        <td><span class="status-badge status-active"><span class="dot">●</span> Activo</span></td>
                        <td>Toyota Corolla (2024-ABC)</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ url('/conductores/perfil') }}" class="btn-icon btn-view" title="Ver Perfil">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ url('/conductores/editar') }}" class="btn-icon btn-edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button class="btn-icon btn-delete" title="Eliminar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Dummy Data Row 2 -->
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="https://ui-avatars.com/api/?name=Carlos+Mamani&background=random" alt="Avatar" class="user-avatar">
                                <div class="user-details">
                                    <span class="user-name">Carlos Mamani</span>
                                    <span class="user-email">carlos.m@email.com</span>
                                </div>
                            </div>
                        </td>
                        <td>7654321-LP</td>
                        <td>+591 600-54321</td>
                        <td><span class="status-badge status-inactive"><span class="dot">●</span> Inactivo</span></td>
                        <td>Nissan Versa (4050-XYZ)</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ url('/conductores/perfil') }}" class="btn-icon btn-view" title="Ver Perfil">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ url('/conductores/editar') }}" class="btn-icon btn-edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button class="btn-icon btn-delete" title="Eliminar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <span>Mostrando 1-10 de 50 conductores</span>
            <div class="pagination-links">
                <a href="#" class="page-link"><</a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">></a>
            </div>
        </div>

    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/index.js') }}"></script>
@endsection