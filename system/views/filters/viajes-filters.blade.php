<!-- Modal de Filtros Avanzados -->
<div class="filter-modal-overlay" id="advancedFiltersModal" style="display: none;">
    <div class="filter-modal-container">
        <div class="filter-modal-header">
            <h3>Filtros Avanzados</h3>
            <button class="close-modal-btn" id="closeFiltersModal">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        
        <form id="advancedFiltersForm" class="filter-modal-body">
            <!-- Rango de Fechas -->
            <div class="filter-section">
                <h4 class="filter-section-title">Fecha del Viaje</h4>
                <div class="filter-row two-cols">
                    <div class="filter-field">
                        <label>Desde</label>
                        <input type="date" name="fecha_inicio" class="modal-input" value="{{ request('fecha_inicio') }}">
                    </div>
                    <div class="filter-field">
                        <label>Hasta</label>
                        <input type="date" name="fecha_fin" class="modal-input" value="{{ request('fecha_fin') }}">
                    </div>
                </div>
            </div>

            <!-- Estado y Pago -->
            <div class="filter-section">
                <h4 class="filter-section-title">Estado y Pago</h4>
                <div class="filter-row two-cols">
                    <div class="filter-field">
                        <label>Estado del Viaje</label>
                        <select name="estado" class="modal-select">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_curso" {{ request('estado') == 'en_curso' ? 'selected' : '' }}>En Curso</option>
                            <option value="completado" {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                            <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                    <div class="filter-field">
                        <label>Método de Pago</label>
                        <select name="metodo_pago" class="modal-select">
                            <option value="">Todos</option>
                            <option value="efectivo" {{ request('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="qr" {{ request('metodo_pago') == 'qr' ? 'selected' : '' }}>QR</option>
                            <option value="transferencia" {{ request('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Monto -->
            <div class="filter-section">
                <h4 class="filter-section-title">Monto del Viaje</h4>
                <div class="filter-row two-cols">
                    <div class="filter-field">
                        <label>Mínimo (Bs)</label>
                        <input type="number" name="monto_min" class="modal-input" placeholder="0" min="0" step="0.5" value="{{ request('monto_min') }}">
                    </div>
                    <div class="filter-field">
                        <label>Máximo (Bs)</label>
                        <input type="number" name="monto_max" class="modal-input" placeholder="1000" min="0" step="0.5" value="{{ request('monto_max') }}">
                    </div>
                </div>
            </div>

            <!-- Ordenamiento -->
            <div class="filter-section">
                <h4 class="filter-section-title">Ordenar por</h4>
                <div class="filter-row two-cols">
                    <div class="filter-field">
                        <label>Campo</label>
                        <select name="sort" class="modal-select">
                            <option value="fecha_hora_inicio" {{ request('sort') == 'fecha_hora_inicio' ? 'selected' : '' }}>Fecha</option>
                            <option value="valor_total" {{ request('sort') == 'valor_total' ? 'selected' : '' }}>Monto</option>
                            <option value="cliente_nombre" {{ request('sort') == 'cliente_nombre' ? 'selected' : '' }}>Cliente</option>
                            <option value="estado" {{ request('sort') == 'estado' ? 'selected' : '' }}>Estado</option>
                        </select>
                    </div>
                    <div class="filter-field">
                        <label>Dirección</label>
                        <select name="order" class="modal-select">
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descendente (Mayor a Menor)</option>
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascendente (Menor a Mayor)</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div class="filter-modal-footer">
            <button type="button" class="btn-reset-filters" id="resetFilters">
                Restablecer
            </button>
            <button type="button" class="btn-apply-filters" id="applyFilters">
                Aplicar Filtros
            </button>
        </div>
    </div>
</div>
