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
                <h4 class="section-title">Estado y Condición</h4>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Estado del Conductor</label>
                        <select name="estado" class="filter-select">
                            <option value="">Todos los estados</option>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="suspendido">Suspendido</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Estado de Pago</label>
                        <select name="estado_pago" class="filter-select">
                            <option value="">Todos</option>
                            <option value="al_dia">Al Día</option>
                            <option value="mora">En Mora</option>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Asignación de Vehículo</label>
                        <select name="vehiculo" class="filter-select">
                            <option value="">Todos</option>
                            <option value="asignado">Con Vehículo Asignado</option>
                            <option value="sin_asignar">Sin Vehículo</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filtros de rendimiento -->
            <div class="filters-section">
                <h4 class="section-title">Rendimiento</h4>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Rating Mínimo</label>
                        <select name="rating_min" class="filter-select">
                            <option value="">Cualquier rating</option>
                            <option value="4.5">4.5 estrellas o más</option>
                            <option value="4.0">4.0 estrellas o más</option>
                            <option value="3.5">3.5 estrellas o más</option>
                            <option value="3.0">3.0 estrellas o más</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Experiencia</label>
                        <select name="experiencia" class="filter-select">
                            <option value="">Cualquier experiencia</option>
                            <option value="0-1">0-1 años</option>
                            <option value="2-5">2-5 años</option>
                            <option value="5-10">5-10 años</option>
                            <option value="10+">Más de 10 años</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filtros de fecha -->
            <div class="filters-section">
                <h4 class="section-title">Fechas</h4>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Registrado desde</label>
                        <input type="date" name="fecha_desde" class="filter-input">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Registrado hasta</label>
                        <input type="date" name="fecha_hasta" class="filter-input">
                    </div>
                </div>
            </div>

            <!-- Filtros adicionales -->
            <div class="filters-section">
                <h4 class="section-title">Información Adicional</h4>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Grupo Sanguíneo</label>
                        <select name="grupo_sanguineo" class="filter-select">
                            <option value="">Todos</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Rango de Edad</label>
                        <select name="edad" class="filter-select">
                            <option value="">Cualquier edad</option>
                            <option value="18-25">18-25 años</option>
                            <option value="26-35">26-35 años</option>
                            <option value="36-45">36-45 años</option>
                            <option value="46-55">46-55 años</option>
                            <option value="55+">Más de 55 años</option>
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