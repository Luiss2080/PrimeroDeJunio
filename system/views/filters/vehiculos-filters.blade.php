<!-- Advanced Filters Modal -->
<div class="filters-modal-overlay" id="filtersModal">
    <div class="filters-modal">
        <div class="filters-header">
            <h3 class="filters-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                Filtros Avanzados
            </h3>
            <button class="filters-close-btn" id="closeFiltersModal">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="filtersForm" class="filters-content">
            <!-- Filtros principales -->
            <div class="filters-section">
                <h4 class="section-title">Estado y Características</h4>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Estado</label>
                        <select name="estado" class="filter-select">
                            <option value="">Todos los estados</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="mantenimiento">Mantenimiento</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Marca</label>
                        <select name="marca" class="filter-select">
                            <option value="">Todas las marcas</option>
                            @foreach($marcas as $marca)
                                <option value="{{ $marca }}">{{ $marca }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Año</label>
                        <select name="ano" class="filter-select">
                            <option value="">Todos los años</option>
                            @foreach($anos as $ano)
                                <option value="{{ $ano }}">{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filtros técnicos -->
            <div class="filters-section">
                <h4 class="section-title">Detalles Técnicos</h4>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Tipo de Combustible</label>
                        <select name="tipo_combustible" class="filter-select">
                            <option value="">Todos</option>
                            <option value="gasolina">Gasolina</option>
                            <option value="diesel">Diesel</option>
                            <option value="gas">Gas</option>
                            <option value="electrico">Eléctrico</option>
                            <option value="hibrido">Híbrido</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Capacidad Pasajeros</label>
                        <select name="capacidad_pasajeros" class="filter-select">
                            <option value="">Cualquiera</option>
                            <option value="2">2 pasajeros</option>
                            <option value="4">4 pasajeros</option>
                            <option value="5">5 pasajeros</option>
                            <option value="7">7+ pasajeros</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Indicadores de filtros activos -->
            <div class="active-filters" id="activeFilters">
                <h4 class="section-title">Filtros Activos <span class="filters-count" id="filtersCount">0</span></h4>
                <div class="active-filters-list" id="activeFiltersList">
                    <!-- Filtros activos aparecerán aquí dinámicamente -->
                </div>
            </div>
        </form>

        <div class="filters-actions">
            <button type="button" class="btn-secondary" id="clearFiltersBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
                Limpiar Filtros
            </button>
            <button type="button" class="btn-primary" id="applyFiltersBtn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Aplicar Filtros
            </button>
        </div>
    </div>
</div>
