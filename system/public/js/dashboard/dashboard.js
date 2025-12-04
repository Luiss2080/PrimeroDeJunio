/* ============================================
   DASHBOARD MODERNO - SISTEMA DE TRANSPORTE
   Funcionalidades JavaScript para dashboards
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // ============================================
    // CONFIGURACIÓN GLOBAL
    // ============================================
    const Dashboard = {
        config: {
            animationDuration: 300,
            refreshInterval: 30000, // 30 segundos
            chartColors: {
                primary: "#00ff66",
                secondary: "#1a1a1a",
                success: "#28a745",
                warning: "#ffc107",
                danger: "#dc3545",
            },
        },

        // ============================================
        // INICIALIZACIÓN
        // ============================================
        init: function () {
            this.setupEventListeners();
            this.initializeCards();
            this.setupResponsiveMenu();
            this.startAutoRefresh();
            console.log("Dashboard inicializado correctamente");
        },

        // ============================================
        // EVENTOS Y LISTENERS
        // ============================================
        setupEventListeners: function () {
            // Card hover effects
            const cards = document.querySelectorAll(".dashboard-card");
            cards.forEach((card) => {
                card.addEventListener("mouseenter", this.handleCardHover);
                card.addEventListener("mouseleave", this.handleCardLeave);
            });

            // Navigation links con animación
            const navLinks = document.querySelectorAll(".nav-link");
            navLinks.forEach((link) => {
                link.addEventListener("click", this.handleNavigation);
            });

            // Refresh buttons
            const refreshBtns = document.querySelectorAll("[data-refresh]");
            refreshBtns.forEach((btn) => {
                btn.addEventListener("click", this.handleRefresh);
            });
        },

        // ============================================
        // MANEJO DE TARJETAS (CARDS)
        // ============================================
        initializeCards: function () {
            const cards = document.querySelectorAll(".dashboard-card");
            cards.forEach((card, index) => {
                // Animación de entrada escalonada
                setTimeout(() => {
                    card.classList.add("animate-in");
                }, index * 100);

                // Contadores animados
                const valueElement = card.querySelector(".card-value");
                if (valueElement && !isNaN(valueElement.textContent)) {
                    this.animateCounter(valueElement);
                }
            });
        },

        handleCardHover: function (e) {
            const card = e.currentTarget;
            card.style.transform = "translateY(-8px) scale(1.02)";
        },

        handleCardLeave: function (e) {
            const card = e.currentTarget;
            card.style.transform = "translateY(0) scale(1)";
        },

        // ============================================
        // ANIMACIÓN DE CONTADORES
        // ============================================
        animateCounter: function (element) {
            const target = parseInt(element.textContent.replace(/[^\d]/g, ""));
            const duration = 2000;
            const start = performance.now();

            const animate = (currentTime) => {
                const elapsed = currentTime - start;
                const progress = Math.min(elapsed / duration, 1);

                const currentValue = Math.floor(
                    target * this.easeOutQuart(progress)
                );
                element.textContent = this.formatNumber(currentValue);

                if (progress < 1) {
                    requestAnimationFrame(animate);
                }
            };

            requestAnimationFrame(animate);
        },

        // Función de easing para animaciones suaves
        easeOutQuart: function (t) {
            return 1 - Math.pow(1 - t, 4);
        },

        // Formatear números con separadores
        formatNumber: function (num) {
            return new Intl.NumberFormat("es-CO").format(num);
        },

        // ============================================
        // NAVEGACIÓN
        // ============================================
        handleNavigation: function (e) {
            const link = e.currentTarget;
            const href = link.getAttribute("href");

            // Animación de carga para enlaces externos
            if (href && !href.startsWith("#")) {
                Dashboard.showLoadingOverlay();
            }
        },

        // ============================================
        // OVERLAY DE CARGA
        // ============================================
        showLoadingOverlay: function () {
            if (window.showLoading) {
                window.showLoading();
            }
        },

        // ============================================
        // ACTUALIZACIÓN AUTOMÁTICA
        // ============================================
        startAutoRefresh: function () {
            setInterval(() => {
                this.refreshDashboardData();
            }, this.config.refreshInterval);
        },

        refreshDashboardData: function () {
            // Actualizar contadores sin recargar la página
            const refreshableElements =
                document.querySelectorAll("[data-refresh-url]");

            refreshableElements.forEach((element) => {
                const url = element.getAttribute("data-refresh-url");
                if (url) {
                    this.fetchAndUpdate(url, element);
                }
            });
        },

        handleRefresh: function (e) {
            e.preventDefault();
            const btn = e.currentTarget;
            const originalText = btn.textContent;

            btn.disabled = true;
            btn.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Actualizando...';

            setTimeout(() => {
                window.location.reload();
            }, 1000);
        },

        // ============================================
        // PETICIONES AJAX
        // ============================================
        fetchAndUpdate: function (url, element) {
            fetch(url, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    Accept: "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    this.updateElement(element, data);
                })
                .catch((error) => {
                    console.error("Error al actualizar datos:", error);
                });
        },

        updateElement: function (element, data) {
            if (data.value !== undefined) {
                const valueElement = element.querySelector(".card-value");
                if (valueElement) {
                    valueElement.textContent = this.formatNumber(data.value);
                }
            }
        },

        // ============================================
        // UTILIDADES
        // ============================================
        formatDate: function (date) {
            return new Intl.DateTimeFormat("es-CO", {
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            }).format(new Date(date));
        },
        // ============================================
        // RESPONSIVE MENU
        // ============================================
        setupResponsiveMenu: function () {
            const menuToggle = document.querySelector(".menu-toggle");
            const sidebar = document.querySelector(".dashboard-sidebar");
            const overlay = document.querySelector(".sidebar-overlay");

            if (menuToggle && sidebar) {
                menuToggle.addEventListener("click", () => {
                    sidebar.classList.toggle("active");
                    if (overlay) overlay.classList.toggle("active");
                });
            }

            if (overlay) {
                overlay.addEventListener("click", () => {
                    sidebar.classList.remove("active");
                    overlay.classList.remove("active");
                });
            }
        },
    };

    // ============================================
    // INICIALIZAR DASHBOARD
    // ============================================
    Dashboard.init();

    // Hacer Dashboard accesible globalmente
    window.Dashboard = Dashboard;
});
