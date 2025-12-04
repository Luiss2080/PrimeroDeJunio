@extends('layouts.dashboard')

@section('title', 'Conductores - 1ro de Junio')

@push('styles')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/conductores/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/confirmar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/advertencia.css') }}">
@endpush

@section('content')

    <div class="conductores-index-container">
        
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Gestión de Conductores</h1>
            <div class="header-actions">
                <a href="{{ url('/conductores/crear') }}" class="btn-primary-glow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    <span>Nuevo Conductor</span>
                </a>
            </div>
        </div>

        <!-- Enhanced Toolbar -->
        <div class="toolbar-container">
            <!-- Left: Search -->
            <div class="toolbar-left">
                <div class="search-box">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" id="searchDriver" class="module-search-input" placeholder="Buscar conductor...">
                </div>
            </div>

            <!-- Right: Actions -->
            <div class="toolbar-right">
                <!-- Rows Selector -->
                <div class="rows-selector">
                    <span class="selector-label">Mostrar:</span>
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
                <button class="btn-toolbar btn-secondary" id="btnFilter" title="Filtros Avanzados">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    <span class="btn-text">Filtros</span>
                </button>

                <!-- Export Button -->
                <button class="btn-toolbar btn-secondary" id="btnExport" title="Exportar Datos">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span class="btn-text">Exportar</span>
                </button>
            </div>
        </div>

        <!-- Filter Panel (Collapsible) -->
        <div class="filter-panel" id="filterPanel">
            <div class="filter-grid">
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
        </div>

        <!-- Desktop Table View -->
        <div class="table-container desktop-view">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="custom-checkbox" id="selectAll">
                        </th>
                        <th>Conductor</th>
                        <th>ID / CI</th>
                        <th>Desempeño</th>
                        <th>Estado Pago</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Vehículo</th>
                        <th class="text-right">Acciones</th>
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
                                    <span class="driver-role">Conductor</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="info-cell">
                                <span class="primary-text">{{ $conductor->cedula }}</span>
                                <span class="secondary-text">ID: #{{ $conductor->id }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="rating-cell">
                                <div class="star-rating">
                                    <span class="star-icon">★</span>
                                    <span class="rating-value">{{ $conductor->rating }}</span>
                                </div>
                                <span class="secondary-text">{{ $conductor->total_viajes }} viajes</span>
                            </div>
                        </td>
                        <td>
                            <span class="payment-badge status-{{ $conductor->estado_pago }}">
                                {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                            </span>
                        </td>
                        <td>
                            <span class="contact-text">{{ $conductor->telefono }}</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $conductor->estado }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($conductor->estado) }}
                            </span>
                        </td>
                        <td>
                            @if($conductor->vehiculoActual)
                                <div class="vehicle-info-cell">
                                    <span class="vehicle-plate">{{ $conductor->vehiculoActual->placa }}</span>
                                    <span class="vehicle-desc">{{ $conductor->vehiculoActual->marca }}</span>
                                </div>
                            @else
                                <span class="no-vehicle">Sin asignar</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons justify-end">
                                <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-icon btn-view" title="Ver Perfil">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-icon btn-edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button class="btn-icon btn-delete" title="Eliminar" onclick="openDeleteModal('{{ route('conductores.destroy', $conductor->id) }}', '{{ $conductor->nombre }} {{ $conductor->apellido }}')">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="empty-state-container">
                                <div class="empty-icon-wrapper">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                </div>
                                <h3 class="empty-title">No hay conductores registrados</h3>
                                <p class="empty-desc">Comienza agregando un nuevo conductor al sistema.</p>
                                <a href="{{ url('/conductores/crear') }}" class="btn-primary-glow mt-3">
                                    Nuevo Conductor
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-cards-view">
            @forelse($conductores as $conductor)
            <div class="driver-card">
                <div class="card-header">
                    <div class="driver-main-info">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($conductor->nombre . ' ' . $conductor->apellido) }}&background=00ff66&color=000" alt="Avatar" class="card-avatar">
                        <div>
                            <h3 class="card-name">{{ $conductor->nombre }} {{ $conductor->apellido }}</h3>
                            <span class="card-id">ID: #{{ $conductor->id }}</span>
                        </div>
                    </div>
                    <!-- Mobile Actions (Direct Icons) -->
                    <div class="card-actions-direct">
                        <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-icon-sm btn-view">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-icon-sm btn-edit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <button class="btn-icon-sm btn-delete" onclick="openDeleteModal('{{ route('conductores.destroy', $conductor->id) }}', '{{ $conductor->nombre }} {{ $conductor->apellido }}')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="card-row">
                        <span class="card-label">Estado</span>
                        <span class="status-badge status-{{ $conductor->estado }} sm">
                            <span class="status-dot"></span>
                            {{ ucfirst($conductor->estado) }}
                        </span>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Desempeño</span>
                        <div class="rating-cell">
                            <span class="star-icon">★</span> {{ $conductor->rating }} <span class="text-muted">({{ $conductor->total_viajes }} viajes)</span>
                        </div>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Pago</span>
                        <span class="payment-badge status-{{ $conductor->estado_pago }}">
                            {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                        </span>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Teléfono</span>
                        <span class="card-value">{{ $conductor->telefono }}</span>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Vehículo</span>
                        @if($conductor->vehiculoActual)
                            <span class="card-value highlight">{{ $conductor->vehiculoActual->placa }}</span>
                        @else
                            <span class="card-value text-muted">Sin asignar</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state-mobile">
                <div class="empty-icon-wrapper">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <p>No se encontraron conductores</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <span class="pagination-info">Mostrando 1-10 de 50 conductores</span>
            <div class="pagination-links">
                <a href="#" class="page-link disabled"><</a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">></a>
            </div>
        </div>

    <!-- Toast Container -->
        <div class="toast-container" id="toastContainer"></div>
```
                    </select>
                </div>
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="table-container desktop-view">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="custom-checkbox" id="selectAll">
                        </th>
                        <th>Conductor</th>
                        <th>ID / CI</th>
                        <th>Desempeño</th>
                        <th>Estado Pago</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Vehículo</th>
                        <th class="text-right">Acciones</th>
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
                                    <span class="driver-role">Conductor</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="info-cell">
                                <span class="primary-text">{{ $conductor->cedula }}</span>
                                <span class="secondary-text">ID: #{{ $conductor->id }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="rating-cell">
                                <div class="star-rating">
                                    <span class="star-icon">★</span>
                                    <span class="rating-value">{{ $conductor->rating }}</span>
                                </div>
                                <span class="secondary-text">{{ $conductor->total_viajes }} viajes</span>
                            </div>
                        </td>
                        <td>
                            <span class="payment-badge status-{{ $conductor->estado_pago }}">
                                {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                            </span>
                        </td>
                        <td>
                            <span class="contact-text">{{ $conductor->telefono }}</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $conductor->estado }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($conductor->estado) }}
                            </span>
                        </td>
                        <td>
                            @if($conductor->vehiculoActual)
                                <div class="vehicle-info-cell">
                                    <span class="vehicle-plate">{{ $conductor->vehiculoActual->placa }}</span>
                                    <span class="vehicle-desc">{{ $conductor->vehiculoActual->marca }}</span>
                                </div>
                            @else
                                <span class="no-vehicle">Sin asignar</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons justify-end">
                                <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-icon btn-view" title="Ver Perfil">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-icon btn-edit" title="Editar">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <button class="btn-icon btn-delete" title="Eliminar" onclick="openDeleteModal('{{ route('conductores.destroy', $conductor->id) }}', '{{ $conductor->nombre }} {{ $conductor->apellido }}')">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="empty-state-container">
                                <div class="empty-icon-wrapper">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                </div>
                                <h3 class="empty-title">No hay conductores registrados</h3>
                                <p class="empty-desc">Comienza agregando un nuevo conductor al sistema.</p>
                                <a href="{{ url('/conductores/crear') }}" class="btn-primary-glow mt-3">
                                    Nuevo Conductor
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-cards-view">
            @forelse($conductores as $conductor)
            <div class="driver-card">
                <div class="card-header">
                    <div class="driver-main-info">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($conductor->nombre . ' ' . $conductor->apellido) }}&background=00ff66&color=000" alt="Avatar" class="card-avatar">
                        <div>
                            <h3 class="card-name">{{ $conductor->nombre }} {{ $conductor->apellido }}</h3>
                            <span class="card-id">ID: #{{ $conductor->id }}</span>
                        </div>
                    </div>
                    <!-- Mobile Actions (Direct Icons) -->
                    <div class="card-actions-direct">
                        <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-icon-sm btn-view">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-icon-sm btn-edit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <button class="btn-icon-sm btn-delete" onclick="openDeleteModal('{{ route('conductores.destroy', $conductor->id) }}', '{{ $conductor->nombre }} {{ $conductor->apellido }}')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="card-row">
                        <span class="card-label">Estado</span>
                        <span class="status-badge status-{{ $conductor->estado }} sm">
                            <span class="status-dot"></span>
                            {{ ucfirst($conductor->estado) }}
                        </span>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Desempeño</span>
                        <div class="rating-cell">
                            <span class="star-icon">★</span> {{ $conductor->rating }} <span class="text-muted">({{ $conductor->total_viajes }} viajes)</span>
                        </div>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Pago</span>
                        <span class="payment-badge status-{{ $conductor->estado_pago }}">
                            {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                        </span>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Teléfono</span>
                        <span class="card-value">{{ $conductor->telefono }}</span>
                    </div>
                    <div class="card-row">
                        <span class="card-label">Vehículo</span>
                        @if($conductor->vehiculoActual)
                            <span class="card-value highlight">{{ $conductor->vehiculoActual->placa }}</span>
                        @else
                            <span class="card-value text-muted">Sin asignar</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state-mobile">
                <div class="empty-icon-wrapper">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <p>No se encontraron conductores</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <span class="pagination-info">Mostrando 1-10 de 50 conductores</span>
            <div class="pagination-links">
                <a href="#" class="page-link disabled"><</a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <a href="#" class="page-link">></a>
            </div>
        </div>

    <!-- Toast Container -->
        <div class="toast-container" id="toastContainer"></div>

    </div>

@include('mod.eliminar')
@include('mod.advertencia')

@endsection

@push('scripts')
    <!-- JS Específico -->
    <script src="{{ asset('js/conductores/index.js') }}"></script>
    <script src="{{ asset('js/mod/confirmar.js') }}"></script>
    <script src="{{ asset('js/mod/advertencia.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            @if(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif

            @if(session('warning_modal'))
                window.openWarningModal(
                    "{{ session('warning_modal')['title'] }}", 
                    "{{ session('warning_modal')['message'] }}"
                );
            @endif
        });
    </script>
@endpush
```
