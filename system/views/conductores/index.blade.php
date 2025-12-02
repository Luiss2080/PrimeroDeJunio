@extends('layouts.dashboard')

@section('title', 'Conductores - 1ro de Junio')

@section('content')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/index.css') }}">

    <div class="conductores-index-container">
        
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Gestión de Conductores</h1>
        </div>

        <!-- Enhanced Toolbar -->
        <div class="toolbar-container">
            <!-- Left: Search -->
            <div class="toolbar-left">
                <div class="search-box">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" id="searchDriver" class="module-search-input" placeholder="Buscar por nombre, licencia o teléfono...">
                </div>
            </div>

            <!-- Right: Actions -->
            <div class="toolbar-right">
                <!-- Rows Selector -->
                <div class="rows-selector">
                    <span>Mostrar:</span>
                    <div class="custom-dropdown" id="rowsDropdown">
                        <div class="dropdown-trigger">
                            <span class="selected-value">10</span>
                            <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </div>
                        <div class="dropdown-options">
                            <div class="dropdown-option" data-value="10">10</div>
                            <div class="dropdown-option" data-value="25">25</div>
                            <div class="dropdown-option" data-value="50">50</div>
                        </div>
                    </div>
                </div>

                <div class="toolbar-divider"></div>

                <!-- Filters Button -->
                <button class="btn-toolbar btn-secondary" id="btnFilter">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filtros
                </button>

                <!-- Export Button -->
                <button class="btn-toolbar btn-secondary" id="btnExport">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Exportar
                </button>

                <!-- Add Button -->
                <a href="{{ url('/conductores/crear') }}" class="btn-toolbar btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    Nuevo Conductor
                </a>
            </div>
        </div>

        <!-- Filter Panel (Collapsible) -->
        <div class="filter-panel" id="filterPanel">
            <div class="filter-group">
                <label class="filter-label">Estado</label>
                <select class="filter-input">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="pendiente">Pendiente</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">Categoría Licencia</label>
                <select class="filter-input">
                    <option value="">Todas</option>
                    <option value="A">Categoría A</option>
                    <option value="B">Categoría B</option>
                    <option value="C">Categoría C</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label">Fecha Registro</label>
                <input type="date" class="filter-input">
            </div>
            <div class="filter-group">
                <label class="filter-label">Vehículo</label>
                <select class="filter-input">
                    <option value="">Todos</option>
                    <option value="asignado">Con Vehículo</option>
                    <option value="sin_asignar">Sin Vehículo</option>
                </select>
            </div>
        </div>

        <!-- Enhanced Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="custom-checkbox" id="selectAll">
                        </th>
                        <th>Conductor</th>
                        <th>ID / CI</th>
                        <th>Licencia</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Vehículo Asignado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($conductores as $conductor)
                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox">
                        </td>
                        <td>
                            <div class="driver-info">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($conductor->nombre . ' ' . $conductor->apellido) }}&background=00ff66&color=000" alt="Avatar" class="driver-avatar">
                                <div>
                                    <span class="driver-name">{{ $conductor->nombre }} {{ $conductor->apellido }}</span>
                                    <span class="driver-id">ID: #{{ $conductor->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $conductor->cedula }}</div>
                        </td>
                        <td>
                            <div>{{ $conductor->licencia_numero }}</div>
                            <small class="text-muted">Cat. {{ $conductor->licencia_categoria }}</small>
                        </td>
                        <td>
                            <span class="contact-text">{{ $conductor->telefono }}</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $conductor->estado }}">
                                {{ ucfirst($conductor->estado) }}
                            </span>
                        </td>
                        <td>
                            <div class="vehicle-info">
                                @if($conductor->vehiculoActual)
                                    <span class="vehicle-plate">{{ $conductor->vehiculoActual->placa }}</span>
                                    <span class="vehicle-model">{{ $conductor->vehiculoActual->marca }} {{ $conductor->vehiculoActual->modelo }}</span>
                                @else
                                    <span class="text-muted">Sin vehículo</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-icon" title="Ver Perfil">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-icon" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button class="btn-icon btn-delete" title="Eliminar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="empty-state-container">
                                <p class="text-muted">No hay conductores registrados.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <!-- Empty State (Hidden by default via JS if rows exist, but handled by blade above too) -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <svg class="empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <p class="empty-text">No se encontraron conductores</p>
            </div>
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

        <!-- Toast Container -->
        <div class="toast-container" id="toastContainer"></div>

    </div>

    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/index.js') }}"></script>
@endsection
