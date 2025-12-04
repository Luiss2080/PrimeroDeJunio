@extends('layouts.dashboard')

@section('title', 'Viajes - 1ro de Junio')

@push('styles')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/viajes/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filters/viajes-filters.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/confirmar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/advertencia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/paginacion.css') }}">
@endpush

@section('content')

    <div class="viajes-index-container">
        
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Gestión de Viajes</h1>
            <div class="header-actions">
                <a href="{{ url('/viajes/crear') }}" class="btn-primary-glow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span>Nuevo Viaje</span>
                </a>
            </div>
        </div>

        <!-- Enhanced Toolbar -->
        <div class="toolbar-container">
            <!-- Left: Search -->
            <div class="toolbar-left">
                <div class="search-box">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" id="searchViaje" class="module-search-input" placeholder="Buscar por cliente, conductor, origen, destino..." value="{{ request('search') }}">
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
                        <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_curso" {{ request('estado') == 'en_curso' ? 'selected' : '' }}>En Curso</option>
                        <option value="completado" {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                        <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Método de Pago</label>
                    <select name="metodo_pago" class="filter-select">
                        <option value="">Todos</option>
                        <option value="efectivo" {{ request('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                        <option value="qr" {{ request('metodo_pago') == 'qr' ? 'selected' : '' }}>QR</option>
                        <option value="transferencia" {{ request('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Fecha Inicio</label>
                    <input type="date" name="fecha_inicio" class="filter-input" value="{{ request('fecha_inicio') }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Fecha Fin</label>
                    <input type="date" name="fecha_fin" class="filter-input" value="{{ request('fecha_fin') }}">
                </div>
            </div>
        </div>

        <!-- Contenedor dinámico de tabla y tarjetas -->
        <div id="viajesContent">
            @include('viajes.partials.table', ['viajes' => $viajes])
        </div>
    </div>

    <!-- Modal de filtros avanzados -->
    @include('filters.viajes-filters')

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

    <!-- Modal de Advertencia (Session Flash) -->
    @if(session('warning_modal'))
    <div class="mod" id="advertenciaModal" style="display: flex;">
        <div class="dialog modal-advertencia">
            <div class="icon-container">
                <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <h3>{{ session('warning_modal')['title'] }}</h3>
            <p>{{ session('warning_modal')['message'] }}</p>
            <div class="actions">
                <button class="accept" onclick="document.getElementById('advertenciaModal').style.display='none'">Entendido</button>
            </div>
        </div>
    </div>
    @endif

@endsection

@push('scripts')
    <!-- Scripts del sistema de filtros -->
    <script src="{{ asset('js/filters/viajes-filters.js') }}"></script>
    <script src="{{ asset('js/mod/confirmar.js') }}"></script>
    <script src="{{ asset('js/mod/advertencia.js') }}"></script>
    
    <script>
        // Inicialización del sistema de filtros
        document.addEventListener('DOMContentLoaded', function() {
            window.viajesFilters = new ViajesFilters({
                baseUrl: '{{ url("/viajes") }}',
                searchInput: '#searchViaje',
                filterButton: '#btnFilter',
                exportButton: '#btnExport',
                contentContainer: '#viajesContent'
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
                        window.viajesFilters.updatePerPage(value);
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
                    document.getElementById('searchViaje').value = '';
                    window.viajesFilters.performSearch('');
                });
            }
        });
    </script>
@endpush