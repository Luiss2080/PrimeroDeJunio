@extends('layouts.dashboard')

@section('title', 'Conductores - 1ro de Junio')
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
                    <input type="text" id="searchDriver" class="module-search-input" placeholder="Buscar por nombre, apellido, cédula, teléfono, chaleco..." value="{{ request('search') }}">
                    @if(request('search'))
                    <button class="search-clear" id="clearSearch" title="Limpiar búsqueda">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                    @endif
                </div>
            </div>

            <!-- Right: Actions -->
            <div class="toolbar-right">
                <!-- Rows Selector -->
                <div class="rows-selector">
                    <span class="selector-label">Mostrar:</span>
                    <div class="custom-dropdown" id="rowsDropdown">
                        <div class="dropdown-trigger">
                            <span class="selected-value">{{ request('per_page', 10) }}</span>
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
                <button class="btn-toolbar btn-secondary filters-indicator" id="btnFilter" title="Filtros Avanzados" data-count="0">
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
                    <select name="estado" class="filter-select">
                        <option value="">Todos los estados</option>
                        <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        <option value="suspendido" {{ request('estado') == 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Estado de Pago</label>
                    <select name="estado_pago" class="filter-select">
                        <option value="">Todos</option>
                        <option value="al_dia" {{ request('estado_pago') == 'al_dia' ? 'selected' : '' }}>Al Día</option>
                        <option value="mora" {{ request('estado_pago') == 'mora' ? 'selected' : '' }}>En Mora</option>
                        <option value="pendiente" {{ request('estado_pago') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Vehículo</label>
                    <select name="vehiculo" class="filter-select">
                        <option value="">Todos</option>
                        <option value="asignado" {{ request('vehiculo') == 'asignado' ? 'selected' : '' }}>Con Vehículo</option>
                        <option value="sin_asignar" {{ request('vehiculo') == 'sin_asignar' ? 'selected' : '' }}>Sin Vehículo</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Rating Mínimo</label>
                    <select name="rating_min" class="filter-select">
                        <option value="">Cualquier rating</option>
                        <option value="4.5" {{ request('rating_min') == '4.5' ? 'selected' : '' }}>4.5+ estrellas</option>
                        <option value="4.0" {{ request('rating_min') == '4.0' ? 'selected' : '' }}>4.0+ estrellas</option>
                        <option value="3.5" {{ request('rating_min') == '3.5' ? 'selected' : '' }}>3.5+ estrellas</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Contenedor dinámico de tabla y tarjetas -->
        <div id="conductoresContent">
            @include('conductores.partials.table', ['conductores' => $conductores])
        </div>
    </div>

    <!-- Modal de filtros avanzados -->
    @include('filters.conductores-filters')

    @php
        $conductorEnSesion = session('conductor');
    @endphp

    <!-- Modals de Confirmación -->
    <div class="mod" id="confirmacionModal" style="display: none;">
        <div class="dialog modal-confirmar">
            <img src="{{ asset('images/advertencia.gif') }}" alt="Confirmar">
            <h3 id="modalTitle">¿Estás seguro?</h3>
            <p id="modalMessage">Esta acción no se puede deshacer.</p>
            <div class="actions">
                <button class="cancel" id="cancelAction">Cancelar</button>
                <button class="confirm" id="confirmAction">Confirmar</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Scripts del sistema de filtros -->
    <script src="{{ asset('js/filters/conductores-filters.js') }}"></script>
    <script>
        // Inicialización del sistema de filtros
        document.addEventListener('DOMContentLoaded', function() {
            window.conductoresFilters = new ConductoresFilters({
                baseUrl: '{{ url("/conductores") }}',
                searchInput: '#searchDriver',
                filterButton: '#btnFilter',
                exportButton: '#btnExport',
                contentContainer: '#conductoresContent'
            });

            // Configurar manejo del dropdown de filas
            const rowsDropdown = document.getElementById('rowsDropdown');
            if (rowsDropdown) {
                const trigger = rowsDropdown.querySelector('.dropdown-trigger');
                const options = rowsDropdown.querySelector('.dropdown-options');
                
                trigger.addEventListener('click', function() {
                    options.style.display = options.style.display === 'block' ? 'none' : 'block';
                });

                options.addEventListener('click', function(e) {
                    if (e.target.classList.contains('dropdown-option')) {
                        const value = e.target.dataset.value;
                        rowsDropdown.querySelector('.selected-value').textContent = value;
                        options.style.display = 'none';
                        
                        // Aplicar cambio de paginación
                        window.conductoresFilters.updatePerPage(value);
                    }
                });

                // Cerrar dropdown al hacer click fuera
                document.addEventListener('click', function(e) {
                    if (!rowsDropdown.contains(e.target)) {
                        options.style.display = 'none';
                    }
                });
            }

            // Configurar limpiar búsqueda
            const clearSearch = document.getElementById('clearSearch');
            if (clearSearch) {
                clearSearch.addEventListener('click', function() {
                    document.getElementById('searchDriver').value = '';
                    window.conductoresFilters.performSearch('');
                });
            }
        });
    </script>
@endpush