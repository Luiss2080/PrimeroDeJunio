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
                        <div class="custom-dropdown filter-dropdown" data-name="estado">
                            <div class="dropdown-trigger">
                                <span class="selected-value">Todos los estados</span>
                                <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                            <div class="dropdown-options">
                                <div class="dropdown-option" data-value="">Todos los estados</div>
                                <div class="dropdown-option" data-value="activo">Activo</div>
                                <div class="dropdown-option" data-value="inactivo">Inactivo</div>
                                <div class="dropdown-option" data-value="suspendido">Suspendido</div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Estado de Pago</label>
                        <div class="custom-dropdown filter-dropdown" data-name="estado_pago">
                            <div class="dropdown-trigger">
                                <span class="selected-value">Todos</span>
                                <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                            <div class="dropdown-options">
                                <div class="dropdown-option" data-value="">Todos</div>
                                <div class="dropdown-option" data-value="al_dia">Al Día</div>
                                <div class="dropdown-option" data-value="mora">En Mora</div>
                                <div class="dropdown-option" data-value="pendiente">Pendiente</div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Asignación de Vehículo</label>
                        <div class="custom-dropdown filter-dropdown" data-name="vehiculo">
                            <div class="dropdown-trigger">
                                <span class="selected-value">Todos</span>
                                <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                            <div class="dropdown-options">
                                <div class="dropdown-option" data-value="">Todos</div>
                                <div class="dropdown-option" data-value="asignado">Con Vehículo Asignado</div>
                                <div class="dropdown-option" data-value="sin_asignar">Sin Vehículo</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros de rendimiento -->
            <div class="filters-section">
                <h4 class="section-title">Rendimiento</h4>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Rating Mínimo</label>
                        <div class="custom-dropdown filter-dropdown" data-name="rating_min">
                            <div class="dropdown-trigger">
                                <span class="selected-value">Cualquier rating</span>
                                <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                            <div class="dropdown-options">
                                <div class="dropdown-option" data-value="">Cualquier rating</div>
                                <div class="dropdown-option" data-value="4.5">4.5 estrellas o más</div>
                                <div class="dropdown-option" data-value="4.0">4.0 estrellas o más</div>
                                <div class="dropdown-option" data-value="3.5">3.5 estrellas o más</div>
                                <div class="dropdown-option" data-value="3.0">3.0 estrellas o más</div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Experiencia</label>
                        <div class="custom-dropdown filter-dropdown" data-name="experiencia">
                            <div class="dropdown-trigger">
                                <span class="selected-value">Cualquier experiencia</span>
                                <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                            <div class="dropdown-options">
                                <div class="dropdown-option" data-value="">Cualquier experiencia</div>
                                <div class="dropdown-option" data-value="0-1">0-1 años</div>
                                <div class="dropdown-option" data-value="2-5">2-5 años</div>
                                <div class="dropdown-option" data-value="5-10">5-10 años</div>
                                <div class="dropdown-option" data-value="10+">Más de 10 años</div>
                            </div>
                        </div>
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
                        <div class="custom-dropdown filter-dropdown" data-name="grupo_sanguineo">
                            <div class="dropdown-trigger">
                                <span class="selected-value">Todos</span>
                                <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                            <div class="dropdown-options">
                                <div class="dropdown-option" data-value="">Todos</div>
                                <div class="dropdown-option" data-value="O+">O+</div>
                                <div class="dropdown-option" data-value="O-">O-</div>
                                <div class="dropdown-option" data-value="A+">A+</div>
                                <div class="dropdown-option" data-value="A-">A-</div>
                                <div class="dropdown-option" data-value="B+">B+</div>
                                <div class="dropdown-option" data-value="B-">B-</div>
                                <div class="dropdown-option" data-value="AB+">AB+</div>
                                <div class="dropdown-option" data-value="AB-">AB-</div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Rango de Edad</label>
                        <div class="custom-dropdown filter-dropdown" data-name="edad">
                            <div class="dropdown-trigger">
                                <span class="selected-value">Cualquier edad</span>
                                <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                            <div class="dropdown-options">
                                <div class="dropdown-option" data-value="">Cualquier edad</div>
                                <div class="dropdown-option" data-value="18-25">18-25 años</div>
                                <div class="dropdown-option" data-value="26-35">26-35 años</div>
                                <div class="dropdown-option" data-value="36-45">36-45 años</div>
                                <div class="dropdown-option" data-value="46-55">46-55 años</div>
                                <div class="dropdown-option" data-value="55+">Más de 55 años</div>
                            </div>
                        </div>
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