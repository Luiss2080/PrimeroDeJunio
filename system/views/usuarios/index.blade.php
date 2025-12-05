@extends('layouts.dashboard')

@section('title', 'Usuarios - 1ro de Junio')

@push('styles')
    <!-- CSS Específico -->
    <link rel="stylesheet" href="{{ asset('css/usuarios/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filters/usuarios-filters.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/paginacion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/confirmar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mod/advertencia.css') }}">
@endpush

@section('content')

    <div class="usuarios-index-container">
        
        <!-- Header -->
        <div class="index-header-container">
            <div class="header-main-row">
                <div class="header-title-group">
                    <h1 class="page-title">Gestión de Usuarios</h1>
                    <p class="page-subtitle">Administra usuarios del sistema y sus permisos</p>
                </div>
                <div class="header-actions-group">
                    <button class="system-btn-secondary" id="btnBulkActions" title="Acciones en Lote">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11H6l2.5-2.5L6 6h3l2 2 2-2h3l-2.5 2.5L16 11h-3l-2-2-2 2z"/><path d="M12 3v6m0 6v6"/></svg>
                        <span>Acciones</span>
                    </button>
                    <a href="{{ route('usuarios.create') }}" class="btn-primary-glow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                        <span>Nuevo Usuario</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Enhanced Toolbar -->
        <div class="toolbar-container">
            <!-- Left: Search -->
            <div class="toolbar-left">
                <div class="search-box">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    <input type="text" id="searchUser" class="module-search-input" placeholder="Buscar por nombre, email, cédula, teléfono..." value="{{ request('search') }}">
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
            <div class="filter-header">
                <h4 class="filter-title">Filtros Avanzados</h4>
                <button class="filter-reset-btn" id="resetFilters">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 4v6h6"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                    Limpiar
                </button>
            </div>
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Estado del Usuario</label>
                    <select name="estado" class="filter-select">
                        <option value="">Todos los estados</option>
                        <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>✅ Activo</option>
                        <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>⏸️ Inactivo</option>
                        <option value="suspendido" {{ request('estado') == 'suspendido' ? 'selected' : '' }}>🚫 Suspendido</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Rol del Sistema</label>
                    <select name="rol_id" class="filter-select">
                        <option value="">Todos los roles</option>
                        @foreach(\App\Models\Role::all() as $rol)
                            <option value="{{ $rol->id }}" {{ request('rol_id') == $rol->id ? 'selected' : '' }}>
                                {{ ucfirst($rol->nombre) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Fecha de Registro</label>
                    <select name="fecha_registro" class="filter-select">
                        <option value="">Cualquier fecha</option>
                        <option value="hoy" {{ request('fecha_registro') == 'hoy' ? 'selected' : '' }}>Hoy</option>
                        <option value="esta_semana" {{ request('fecha_registro') == 'esta_semana' ? 'selected' : '' }}>Esta semana</option>
                        <option value="este_mes" {{ request('fecha_registro') == 'este_mes' ? 'selected' : '' }}>Este mes</option>
                        <option value="ultimos_3_meses" {{ request('fecha_registro') == 'ultimos_3_meses' ? 'selected' : '' }}>Últimos 3 meses</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Último Acceso</label>
                    <select name="ultimo_acceso" class="filter-select">
                        <option value="">Sin filtro</option>
                        <option value="hoy" {{ request('ultimo_acceso') == 'hoy' ? 'selected' : '' }}>Hoy</option>
                        <option value="esta_semana" {{ request('ultimo_acceso') == 'esta_semana' ? 'selected' : '' }}>Esta semana</option>
                        <option value="inactivos_30" {{ request('ultimo_acceso') == 'inactivos_30' ? 'selected' : '' }}>Inactivos +30 días</option>
                    </select>
                </div>
            </div>
            <div class="filter-actions">
                <button class="btn-filter-apply" id="applyFilters">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    Aplicar Filtros
                </button>
            </div>
        </div>

        <!-- Contenedor dinámico de tabla y tarjetas -->
        <div id="usuariosContent">
            @include('usuarios.partials.table', ['usuarios' => $usuarios])
        </div>
    </div>

    <!-- Modal de filtros avanzados -->
    @include('filters.usuarios-filters')

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
    <script src="{{ asset('js/filters/usuarios-filters.js') }}"></script>
    <script>
        // Inicialización del sistema de filtros
        document.addEventListener('DOMContentLoaded', function() {
            window.usuariosFilters = new UsuariosFilters({
                baseUrl: '{{ route("usuarios.index") }}',
                searchInput: '#searchUser',
                filterButton: '#btnFilter',
                exportButton: '#btnExport',
                contentContainer: '#usuariosContent'
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
                        window.usuariosFilters.updatePerPage(value);
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
                    document.getElementById('searchUser').value = '';
                    window.usuariosFilters.performSearch('');
                });
            }
        });
    </script>
@endpush