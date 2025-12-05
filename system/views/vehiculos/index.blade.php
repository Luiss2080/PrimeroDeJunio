@extends('layouts.dashboard')

@section('title', 'Vehículos - 1ro de Junio')

@push('styles')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/vehiculos/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filters/vehiculos-filters.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/paginacion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/confirmar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/advertencia.css') }}">
@endpush

@section('content')

    <div class="vehiculos-index-container">
        
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Gestión de Vehículos</h1>
            <div class="header-actions">
                <a href="{{ route('vehiculos.create') }}" class="btn-primary-glow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    <span>Nuevo Vehículo</span>
                </a>
            </div>
        </div>

        <!-- Enhanced Toolbar -->
        <div class="toolbar-container">
            <!-- Left: Search -->
            <div class="toolbar-left">
                <div class="search-box">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" id="searchVehicle" class="module-search-input" placeholder="Buscar por placa, marca, modelo, propietario..." value="{{ request('search') }}">
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
                        <option value="mantenimiento" {{ request('estado') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Marca</label>
                    <select name="marca" class="filter-select">
                        <option value="">Todas las marcas</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca }}" {{ request('marca') == $marca ? 'selected' : '' }}>{{ $marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Año</label>
                    <select name="ano" class="filter-select">
                        <option value="">Todos los años</option>
                        @foreach($anos as $ano)
                            <option value="{{ $ano }}" {{ request('ano') == $ano ? 'selected' : '' }}>{{ $ano }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Contenedor dinámico de tabla y tarjetas -->
        <div id="vehiculosContent">
            @include('vehiculos.partials.table', ['vehiculos' => $vehiculos])
        </div>
    </div>

    <!-- Modal de filtros avanzados -->
    @include('filters.vehiculos-filters')

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

    <!-- Modal de Advertencia (Session) -->
    @if(session('warning_modal'))
    <div class="mod" id="warningModal" style="display: flex;">
        <div class="dialog modal-advertencia">
            <img src="{{ asset('images/advertencia.gif') }}" alt="Advertencia">
            <h3>{{ session('warning_modal')['title'] }}</h3>
            <p>{{ session('warning_modal')['message'] }}</p>
            <div class="actions">
                <button class="confirm" onclick="document.getElementById('warningModal').style.display='none'">Entendido</button>
            </div>
        </div>
    </div>
    @endif

@endsection

@push('scripts')
    <!-- Scripts del sistema de filtros -->
    <script src="{{ asset('js/filters/vehiculos-filters.js') }}"></script>
    <script>
        // Inicialización del sistema de filtros
        document.addEventListener('DOMContentLoaded', function() {
            window.vehiculosFilters = new VehiculosFilters({
                baseUrl: '{{ route("vehiculos.index") }}',
                searchInput: '#searchVehicle',
                filterButton: '#btnFilter',
                exportButton: '#btnExport',
                contentContainer: '#vehiculosContent'
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
                        window.vehiculosFilters.updatePerPage(value);
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
                    document.getElementById('searchVehicle').value = '';
                    window.vehiculosFilters.performSearch('');
                });
            }
        });
    </script>
    <script>
        // Modal de Confirmación
        const modal = document.getElementById('confirmacionModal');
        const confirmBtn = document.getElementById('confirmAction');
        const cancelBtn = document.getElementById('cancelAction');
        let currentDeleteUrl = '';

        window.openDeleteModal = function(url, name) {
            currentDeleteUrl = url;
            document.getElementById('modalMessage').textContent = `¿Estás seguro de que deseas eliminar a ${name}? Esta acción no se puede deshacer.`;
            modal.style.display = 'flex';
        };

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (currentDeleteUrl) {
                    // Crear un formulario para enviar la petición DELETE
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = currentDeleteUrl;
                    
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = csrfToken;
                    
                    form.appendChild(methodField);
                    form.appendChild(csrfField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none';
                currentDeleteUrl = '';
            });
        }

        // Cerrar modal al hacer clic fuera
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                currentDeleteUrl = '';
            }
        });
    </script>
@endpush