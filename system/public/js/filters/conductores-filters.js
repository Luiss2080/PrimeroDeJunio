/**
 * Filtros y búsqueda para Conductores
 */

class ConductoresFilters {
    constructor() {
        this.currentFilters = {};
        this.currentSort = { field: 'created_at', order: 'desc' };
        this.currentPage = 1;
        this.perPage = 10;
        this.searchTimeout = null;
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.bindModalDropdowns();
        this.loadInitialData();
    }

    bindEvents() {
        // Búsqueda en tiempo real
        const searchInput = document.getElementById('searchDriver');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.handleSearch(e.target.value);
                }, 300);
            });
        }

        // Botón de filtros
        const filterBtn = document.getElementById('btnFilter');
        if (filterBtn) {
            filterBtn.addEventListener('click', () => {
                this.openFiltersModal();
            });
        }

        // Modal de filtros
        const closeModalBtn = document.getElementById('closeFiltersModal');
        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                this.closeFiltersModal();
            });
        }

        // Overlay del modal
        const modalOverlay = document.getElementById('filtersModal');
        if (modalOverlay) {
            modalOverlay.addEventListener('click', (e) => {
                if (e.target === modalOverlay) {
                    this.closeFiltersModal();
                }
            });
        }

        // Aplicar filtros
        const applyBtn = document.getElementById('applyFiltersBtn');
        if (applyBtn) {
            applyBtn.addEventListener('click', () => {
                this.applyFilters();
            });
        }

        // Limpiar filtros
        const clearBtn = document.getElementById('clearFiltersBtn');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                this.clearAllFilters();
            });
        }

        // Selector de filas por página
        this.bindRowsSelector();

        // Headers de ordenamiento
        this.bindSortHeaders();

        // Filtros del panel rápido
        this.bindQuickFilters();

        // Exportar datos
        const exportBtn = document.getElementById('btnExport');
        if (exportBtn) {
            exportBtn.addEventListener('click', () => {
                this.exportData();
            });
        }
    }

    bindRowsSelector() {
        const dropdown = document.getElementById('rowsDropdown');
        if (!dropdown) return;

        const trigger = dropdown.querySelector('.dropdown-trigger');
        const options = dropdown.querySelectorAll('.dropdown-option');

        trigger?.addEventListener('click', () => {
            dropdown.classList.toggle('active');
        });

        options.forEach(option => {
            option.addEventListener('click', (e) => {
                const value = e.target.getAttribute('data-value');
                const selectedSpan = dropdown.querySelector('.selected-value');
                
                if (selectedSpan) {
                    selectedSpan.textContent = value;
                }
                
                this.perPage = parseInt(value);
                this.currentPage = 1;
                dropdown.classList.remove('active');
                
                this.loadData();
            });
        });

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });
    }

    bindSortHeaders() {
        const sortHeaders = document.querySelectorAll('.sortable-header');
        
        sortHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const field = header.getAttribute('data-sort');
                
                if (this.currentSort.field === field) {
                    this.currentSort.order = this.currentSort.order === 'asc' ? 'desc' : 'asc';
                } else {
                    this.currentSort.field = field;
                    this.currentSort.order = 'asc';
                }
                
                this.updateSortUI();
                this.loadData();
            });
        });
    }

    bindModalDropdowns() {
        const modalDropdowns = document.querySelectorAll('.filters-content .filter-dropdown');
        
        modalDropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.dropdown-trigger');
            const options = dropdown.querySelectorAll('.dropdown-option');
            const selectedValue = dropdown.querySelector('.selected-value');
            const filterName = dropdown.getAttribute('data-name');
            
            // Toggle dropdown al hacer clic en el trigger
            trigger?.addEventListener('click', (e) => {
                e.stopPropagation();
                
                // Cerrar otros dropdowns
                modalDropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove('active');
                    }
                });
                
                dropdown.classList.toggle('active');
            });
            
            // Manejo de selección de opciones
            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.stopPropagation();
                    
                    const value = option.getAttribute('data-value');
                    const text = option.textContent;
                    
                    // Actualizar el texto seleccionado
                    selectedValue.textContent = text;
                    
                    // Marcar opción como seleccionada
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                    
                    // Guardar filtro
                    if (value) {
                        this.currentFilters[filterName] = value;
                    } else {
                        delete this.currentFilters[filterName];
                    }
                    
                    // Cerrar dropdown
                    dropdown.classList.remove('active');
                    
                    // Actualizar contador de filtros
                    this.updateFiltersCount();
                });
            });
        });
        
        // Cerrar dropdowns al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.filter-dropdown')) {
                modalDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });
    }

    bindQuickFilters() {
        const quickFilters = document.querySelectorAll('.filter-panel .filter-input, .filter-panel .filter-select');
        
        quickFilters.forEach(filter => {
            filter.addEventListener('change', () => {
                this.applyQuickFilters();
            });
        });
    }

    handleSearch(searchTerm) {
        if (searchTerm.length === 0 || searchTerm.length >= 2) {
            this.currentFilters.search = searchTerm;
            this.currentPage = 1;
            this.loadData();
        }
    }

    openFiltersModal() {
        const modal = document.getElementById('filtersModal');
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            this.populateFiltersForm();
        }
    }

    closeFiltersModal() {
        const modal = document.getElementById('filtersModal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    populateFiltersForm() {
        const form = document.getElementById('filtersForm');
        if (!form) return;

        // Poblar el formulario con filtros actuales
        Object.keys(this.currentFilters).forEach(key => {
            // Manejar inputs de fecha
            const input = form.querySelector(`input[name="${key}"]`);
            if (input && this.currentFilters[key]) {
                input.value = this.currentFilters[key];
            }
            
            // Manejar custom dropdowns
            const dropdown = form.querySelector(`.filter-dropdown[data-name="${key}"]`);
            if (dropdown && this.currentFilters[key]) {
                const selectedValue = dropdown.querySelector('.selected-value');
                const option = dropdown.querySelector(`.dropdown-option[data-value="${this.currentFilters[key]}"]`);
                
                if (selectedValue && option) {
                    selectedValue.textContent = option.textContent;
                    
                    // Marcar como seleccionado
                    dropdown.querySelectorAll('.dropdown-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    option.classList.add('selected');
                }
            }
        });

        this.updateActiveFiltersDisplay();
    }

    applyFilters() {
        const form = document.getElementById('filtersForm');
        if (!form) return;

        const formData = new FormData(form);
        this.currentFilters = {};

        // Recopilar filtros del formulario
        for (let [key, value] of formData.entries()) {
            if (value && value.trim() !== '') {
                this.currentFilters[key] = value.trim();
            }
        }

        this.currentPage = 1;
        this.loadData();
        this.closeFiltersModal();
        this.updateFiltersIndicator();
    }

    applyQuickFilters() {
        const panel = document.querySelector('.filter-panel');
        if (!panel) return;

        const inputs = panel.querySelectorAll('.filter-input, .filter-select');
        
        inputs.forEach(input => {
            const name = input.name;
            const value = input.value;
            
            if (value && value.trim() !== '') {
                this.currentFilters[name] = value.trim();
            } else {
                delete this.currentFilters[name];
            }
        });

        this.currentPage = 1;
        this.loadData();
        this.updateFiltersIndicator();
    }

    clearAllFilters() {
        this.currentFilters = {};
        this.currentPage = 1;

        // Limpiar inputs de fecha
        const form = document.getElementById('filtersForm');
        if (form) {
            const dateInputs = form.querySelectorAll('input[type="date"]');
            dateInputs.forEach(input => input.value = '');
        }

        // Limpiar custom dropdowns del modal
        const modalDropdowns = document.querySelectorAll('.filters-content .filter-dropdown');
        modalDropdowns.forEach(dropdown => {
            const selectedValue = dropdown.querySelector('.selected-value');
            const firstOption = dropdown.querySelector('.dropdown-option[data-value=""]');
            const options = dropdown.querySelectorAll('.dropdown-option');
            
            if (selectedValue && firstOption) {
                selectedValue.textContent = firstOption.textContent;
                
                // Limpiar selección
                options.forEach(opt => opt.classList.remove('selected'));
                firstOption.classList.add('selected');
            }
        });

        // Limpiar panel de filtros rápidos
        const panel = document.querySelector('.filter-panel');
        if (panel) {
            const inputs = panel.querySelectorAll('.filter-input, .filter-select');
            inputs.forEach(input => input.value = '');
        }

        // Limpiar búsqueda
        const searchInput = document.getElementById('searchDriver');
        if (searchInput) {
            searchInput.value = '';
        }

        this.loadData();
        this.updateFiltersIndicator();
        this.updateActiveFiltersDisplay();
        
        // Cerrar modal después de limpiar
        this.closeFiltersModal();
    }

    updateActiveFiltersDisplay() {
        const container = document.getElementById('activeFiltersList');
        const counter = document.getElementById('filtersCount');
        
        if (!container || !counter) return;

        container.innerHTML = '';
        
        const filterCount = Object.keys(this.currentFilters).filter(key => key !== 'search').length;
        counter.textContent = filterCount;

        if (filterCount === 0) {
            container.innerHTML = '<p class="no-filters">No hay filtros activos</p>';
            return;
        }

        Object.entries(this.currentFilters).forEach(([key, value]) => {
            if (key === 'search') return;
            
            const tag = document.createElement('span');
            tag.className = 'active-filter-tag';
            tag.innerHTML = `
                <span>${this.getFilterLabel(key)}: ${this.getFilterValueLabel(key, value)}</span>
                <button type="button" class="remove-filter" data-filter="${key}">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            `;
            
            tag.querySelector('.remove-filter').addEventListener('click', () => {
                this.removeFilter(key);
            });
            
            container.appendChild(tag);
        });
    }

    removeFilter(filterKey) {
        delete this.currentFilters[filterKey];
        
        // Actualizar formulario
        const form = document.getElementById('filtersForm');
        const input = form?.querySelector(`[name="${filterKey}"]`);
        if (input) {
            input.value = '';
        }

        this.currentPage = 1;
        this.loadData();
        this.updateActiveFiltersDisplay();
        this.updateFiltersIndicator();
    }

    updateFiltersIndicator() {
        const filterBtn = document.getElementById('btnFilter');
        if (!filterBtn) return;

        const filterCount = Object.keys(this.currentFilters).filter(key => key !== 'search').length;
        
        // Siempre mostrar el contador, incluso cuando es 0
        filterBtn.setAttribute('data-count', filterCount);
        
        if (filterCount > 0) {
            filterBtn.classList.add('filters-active');
        } else {
            filterBtn.classList.remove('filters-active');
        }
    }
    
    updateFiltersCount() {
        this.updateFiltersIndicator();
    }

    updateSortUI() {
        const headers = document.querySelectorAll('.sortable-header');
        
        headers.forEach(header => {
            header.classList.remove('active', 'asc', 'desc');
            
            if (header.getAttribute('data-sort') === this.currentSort.field) {
                header.classList.add('active', this.currentSort.order);
            }
        });
    }

    async loadData() {
        try {
            this.showLoading();
            
            const params = new URLSearchParams();
            
            // Agregar filtros
            Object.entries(this.currentFilters).forEach(([key, value]) => {
                params.append(key, value);
            });
            
            // Agregar ordenamiento
            params.append('sort', this.currentSort.field);
            params.append('order', this.currentSort.order);
            
            // Agregar paginación
            params.append('page', this.currentPage);
            params.append('per_page', this.perPage);

            const response = await fetch(`/conductores?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Error al cargar los datos');
            }

            const data = await response.json();
            
            this.updateTable(data.html);
            this.updatePagination(data.pagination, data.showing);
            
        } catch (error) {
            console.error('Error:', error);
            this.showError('Error al cargar los conductores');
        } finally {
            this.hideLoading();
        }
    }

    loadInitialData() {
        // Cargar filtros desde URL si existen
        const urlParams = new URLSearchParams(window.location.search);
        
        urlParams.forEach((value, key) => {
            if (['sort', 'order', 'page', 'per_page'].includes(key)) return;
            this.currentFilters[key] = value;
        });

        this.updateFiltersIndicator();
    }

    updateTable(html) {
        const tableContainer = document.querySelector('.table-container');
        const mobileContainer = document.querySelector('.mobile-cards-view');
        
        if (tableContainer && mobileContainer) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            
            const newTableContainer = tempDiv.querySelector('.table-container');
            const newMobileContainer = tempDiv.querySelector('.mobile-cards-view');
            
            if (newTableContainer) {
                tableContainer.innerHTML = newTableContainer.innerHTML;
            }
            
            if (newMobileContainer) {
                mobileContainer.innerHTML = newMobileContainer.innerHTML;
            }
            
            // Re-bind eventos para nuevos elementos
            this.bindSortHeaders();
        }
    }

    updatePagination(paginationHtml, showing) {
        const paginationContainer = document.querySelector('.pagination-links');
        const infoSpan = document.querySelector('.pagination-info');
        
        if (paginationContainer && paginationHtml) {
            paginationContainer.innerHTML = paginationHtml;
        }
        
        if (infoSpan && showing) {
            infoSpan.textContent = `Mostrando ${showing.from}-${showing.to} de ${showing.total} conductores`;
        }
    }

    async exportData() {
        try {
            const params = new URLSearchParams();
            
            // Agregar filtros actuales
            Object.entries(this.currentFilters).forEach(([key, value]) => {
                params.append(key, value);
            });
            
            params.append('export', 'excel');

            window.open(`/conductores/export?${params.toString()}`, '_blank');
            
        } catch (error) {
            console.error('Error:', error);
            this.showError('Error al exportar los datos');
        }
    }

    showLoading() {
        const tableContainer = document.querySelector('.table-container');
        if (tableContainer) {
            tableContainer.classList.add('filters-loading');
        }
    }

    hideLoading() {
        const tableContainer = document.querySelector('.table-container');
        if (tableContainer) {
            tableContainer.classList.remove('filters-loading');
        }
    }

    showError(message) {
        // Implementar sistema de notificaciones
        if (window.showToast) {
            window.showToast(message, 'error');
        } else {
            alert(message);
        }
    }

    getFilterLabel(key) {
        const labels = {
            'estado': 'Estado',
            'estado_pago': 'Estado de Pago',
            'vehiculo': 'Vehículo',
            'rating_min': 'Rating Mínimo',
            'experiencia': 'Experiencia',
            'fecha_desde': 'Desde',
            'fecha_hasta': 'Hasta',
            'grupo_sanguineo': 'Grupo Sanguíneo',
            'edad': 'Edad'
        };
        
        return labels[key] || key;
    }

    getFilterValueLabel(key, value) {
        const valueLabels = {
            'estado': {
                'activo': 'Activo',
                'inactivo': 'Inactivo',
                'suspendido': 'Suspendido'
            },
            'estado_pago': {
                'al_dia': 'Al Día',
                'mora': 'En Mora',
                'pendiente': 'Pendiente'
            },
            'vehiculo': {
                'asignado': 'Con Vehículo',
                'sin_asignar': 'Sin Vehículo'
            }
        };
        
        return valueLabels[key]?.[value] || value;
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.conductoresFilters = new ConductoresFilters();
    
    // Toggle del panel de filtros rápidos
    const filterBtn = document.getElementById('btnFilter');
    const filterPanel = document.getElementById('filterPanel');
    
    if (filterBtn && filterPanel) {
        filterBtn.addEventListener('dblclick', () => {
            filterPanel.classList.toggle('active');
        });
    }
});