/**
 * Sistema de Filtros para el Módulo de Viajes
 */
class ViajesFilters {
    constructor(config) {
        this.baseUrl = config.baseUrl;
        this.searchInput = document.querySelector(config.searchInput);
        this.filterButton = document.querySelector(config.filterButton);
        this.exportButton = document.querySelector(config.exportButton);
        this.contentContainer = document.querySelector(config.contentContainer);

        // Modal elements
        this.modal = document.getElementById("advancedFiltersModal");
        this.closeModalBtn = document.getElementById("closeFiltersModal");
        this.applyFiltersBtn = document.getElementById("applyFilters");
        this.resetFiltersBtn = document.getElementById("resetFilters");
        this.filtersForm = document.getElementById("advancedFiltersForm");

        // State
        this.activeFilters = {};
        this.searchTimeout = null;

        this.init();
    }

    init() {
        this.bindEvents();
        this.loadActiveFiltersFromUrl();
    }

    bindEvents() {
        // Búsqueda en tiempo real (debounce)
        if (this.searchInput) {
            this.searchInput.addEventListener("input", (e) => {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.performSearch(e.target.value);
                }, 500);
            });
        }

        // Modal de filtros
        if (this.filterButton) {
            this.filterButton.addEventListener("click", () => this.openModal());
        }

        if (this.closeModalBtn) {
            this.closeModalBtn.addEventListener("click", () =>
                this.closeModal()
            );
        }

        if (this.applyFiltersBtn) {
            this.applyFiltersBtn.addEventListener("click", () =>
                this.applyFilters()
            );
        }

        if (this.resetFiltersBtn) {
            this.resetFiltersBtn.addEventListener("click", () =>
                this.resetFilters()
            );
        }

        // Cerrar modal al hacer click fuera
        if (this.modal) {
            this.modal.addEventListener("click", (e) => {
                if (e.target === this.modal) this.closeModal();
            });
        }

        // Exportar
        if (this.exportButton) {
            this.exportButton.addEventListener("click", () =>
                this.exportData()
            );
        }

        // Paginación AJAX
        document.addEventListener("click", (e) => {
            if (e.target.closest(".pagination a")) {
                e.preventDefault();
                const url = e.target.closest(".pagination a").href;
                this.loadPage(url);
            }
        });

        // Ordenamiento
        document.addEventListener("click", (e) => {
            const header = e.target.closest(".sortable-header");
            if (header) {
                const sortField = header.dataset.sort;
                this.handleSort(sortField);
            }
        });
    }

    loadActiveFiltersFromUrl() {
        const params = new URLSearchParams(window.location.search);

        // Cargar filtros en el formulario modal
        for (const [key, value] of params.entries()) {
            const input = this.filtersForm.querySelector(`[name="${key}"]`);
            if (input) {
                input.value = value;
                this.activeFilters[key] = value;
            }
        }

        this.updateFilterIndicator();
    }

    openModal() {
        this.modal.style.display = "flex";
        document.body.style.overflow = "hidden";
    }

    closeModal() {
        this.modal.style.display = "none";
        document.body.style.overflow = "";
    }

    async performSearch(term) {
        this.activeFilters.search = term;
        this.activeFilters.page = 1; // Reset a primera página
        await this.fetchData();
    }

    async applyFilters() {
        const formData = new FormData(this.filtersForm);

        // Reset active filters but keep search
        const searchTerm = this.activeFilters.search;
        this.activeFilters = {};
        if (searchTerm) this.activeFilters.search = searchTerm;

        for (const [key, value] of formData.entries()) {
            if (value) {
                this.activeFilters[key] = value;
            }
        }

        this.activeFilters.page = 1;
        await this.fetchData();
        this.closeModal();
        this.updateFilterIndicator();
    }

    async resetFilters() {
        this.filtersForm.reset();
        this.activeFilters = {};
        if (this.searchInput.value) {
            this.activeFilters.search = this.searchInput.value;
        }
        await this.fetchData();
        this.closeModal();
        this.updateFilterIndicator();
    }

    handleSort(field) {
        const currentSort = this.activeFilters.sort || "fecha_hora_inicio";
        const currentOrder = this.activeFilters.order || "desc";

        let newOrder = "asc";
        if (currentSort === field && currentOrder === "asc") {
            newOrder = "desc";
        }

        this.activeFilters.sort = field;
        this.activeFilters.order = newOrder;

        this.fetchData();
    }

    updatePerPage(value) {
        this.activeFilters.per_page = value;
        this.activeFilters.page = 1;
        this.fetchData();
    }

    async loadPage(url) {
        const urlObj = new URL(url);
        const page = urlObj.searchParams.get("page");

        if (page) {
            this.activeFilters.page = page;
            await this.fetchData();
        }
    }

    async fetchData() {
        this.showLoading();

        try {
            // Construir Query String
            const params = new URLSearchParams(this.activeFilters);
            const url = `${this.baseUrl}?${params.toString()}`;

            // Actualizar URL del navegador sin recargar
            window.history.pushState({}, "", url);

            const response = await fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            });

            if (!response.ok) throw new Error("Error al cargar datos");

            const data = await response.json();

            // Actualizar contenido
            this.contentContainer.innerHTML = data.html;

            // Actualizar paginación si existe el contenedor
            const paginationContainer = document.querySelector(
                ".pagination-container"
            );
            if (paginationContainer && data.pagination) {
                paginationContainer.innerHTML = data.pagination;
            }
        } catch (error) {
            console.error("Error:", error);
            // Mostrar mensaje de error en la UI
        } finally {
            this.hideLoading();
        }
    }

    updateFilterIndicator() {
        // Contar filtros activos (excluyendo search, page, sort, order)
        const ignoredKeys = ["search", "page", "sort", "order", "per_page"];
        const count = Object.keys(this.activeFilters).filter(
            (k) => !ignoredKeys.includes(k)
        ).length;

        this.filterButton.dataset.count = count;
        if (count > 0) {
            this.filterButton.classList.add("active");
        } else {
            this.filterButton.classList.remove("active");
        }
    }

    showLoading() {
        this.contentContainer.style.opacity = "0.5";
        this.contentContainer.style.pointerEvents = "none";
    }

    hideLoading() {
        this.contentContainer.style.opacity = "1";
        this.contentContainer.style.pointerEvents = "all";
    }

    exportData() {
        const params = new URLSearchParams(this.activeFilters);
        params.append("export", "true");
        window.location.href = `${this.baseUrl}?${params.toString()}`;
    }
}
