/* ============================================
   CONDUCTORES - INDEX JS
   ============================================ */

window.addEventListener("load", function () {
    // Force hide loading overlay
    const overlay = document.getElementById("loadingOverlay");
    if (overlay) {
        overlay.classList.remove("active");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // --- Toast Notification System ---
    const toastContainer = document.getElementById("toastContainer");

    function showToast(message, type = "success") {
        const toast = document.createElement("div");
        toast.className = `toast toast-${type}`;

        // Icon based on type
        let icon = "";
        if (type === "success")
            icon =
                '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>';
        else if (type === "error")
            icon =
                '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>';
        else
            icon =
                '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>';

        toast.innerHTML = `${icon}<span>${message}</span>`;

        toastContainer.appendChild(toast);

        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateX(50px)";
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // --- Search Functionality (Desktop & Mobile) ---
    const searchInput = document.getElementById("searchDriver");
    const tableRows = document.querySelectorAll(".data-table tbody tr");
    const mobileCards = document.querySelectorAll(".driver-card");
    const emptyStateTable = document.getElementById("emptyState"); // For table
    const emptyStateMobile = document.querySelector(".empty-state-mobile"); // For mobile
    const tableHead = document.querySelector(".data-table thead");

    if (searchInput) {
        searchInput.addEventListener("keyup", function (e) {
            const searchTerm = e.target.value.toLowerCase();
            let visibleCountTable = 0;
            let visibleCountMobile = 0;

            // Filter Table Rows
            tableRows.forEach((row) => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = "";
                    visibleCountTable++;
                } else {
                    row.style.display = "none";
                }
            });

            // Filter Mobile Cards
            mobileCards.forEach((card) => {
                const text = card.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    card.style.display = "flex"; // Cards are flex containers
                    visibleCountMobile++;
                } else {
                    card.style.display = "none";
                }
            });

            // Handle Empty States
            // Table View
            if (visibleCountTable === 0 && tableRows.length > 0) {
                if (emptyStateTable) emptyStateTable.style.display = "flex";
                if (tableHead) tableHead.style.display = "none";
            } else {
                if (emptyStateTable) emptyStateTable.style.display = "none";
                if (tableHead) tableHead.style.display = "";
            }

            // Mobile View
            if (visibleCountMobile === 0 && mobileCards.length > 0) {
                if (emptyStateMobile) emptyStateMobile.style.display = "flex";
            } else {
                if (emptyStateMobile) emptyStateMobile.style.display = "none";
            }
        });
    }

    // --- Bulk Selection (Desktop Only) ---
    const selectAll = document.getElementById("selectAll");
    const rowCheckboxes = document.querySelectorAll(".row-checkbox");

    if (selectAll) {
        selectAll.addEventListener("change", function () {
            const isChecked = this.checked;
            rowCheckboxes.forEach((cb) => {
                cb.checked = isChecked;
                toggleRowHighlight(cb);
            });
        });
    }

    rowCheckboxes.forEach((cb) => {
        cb.addEventListener("change", function () {
            toggleRowHighlight(this);
            // Update Select All state
            const allChecked = Array.from(rowCheckboxes).every(
                (c) => c.checked
            );
            selectAll.checked = allChecked;
        });
    });

    function toggleRowHighlight(checkbox) {
        const row = checkbox.closest("tr");
        if (checkbox.checked) {
            row.classList.add("selected");
        } else {
            row.classList.remove("selected");
        }
    }

    // --- Filter Panel Toggle ---
    const btnFilter = document.getElementById("btnFilter");
    const filterPanel = document.getElementById("filterPanel");

    if (btnFilter && filterPanel) {
        btnFilter.addEventListener("click", function () {
            filterPanel.classList.toggle("show");
            this.classList.toggle("active");
        });
    }

    // --- Custom Dropdown Logic (Rows Selector) ---
    const dropdown = document.getElementById("rowsDropdown");

    if (dropdown) {
        const trigger = dropdown.querySelector(".dropdown-trigger");
        const selectedValue = dropdown.querySelector(".selected-value");
        const options = dropdown.querySelectorAll(".dropdown-option");

        // Toggle Dropdown
        trigger.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdown.classList.toggle("active");
        });

        // Select Option
        options.forEach((option) => {
            option.addEventListener("click", function () {
                const value = this.dataset.value;
                selectedValue.textContent = value;
                dropdown.classList.remove("active");
                console.log(`Showing ${value} rows`);
            });
        });

        // Close when clicking outside
        document.addEventListener("click", function (e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove("active");
            }
        });
    }

    // --- Action Dropdowns (Desktop & Mobile) ---
    // Desktop Dropdowns
    const actionButtons = document.querySelectorAll(".btn-icon-more");

    actionButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.stopPropagation();
            // Close all other dropdowns first
            closeAllDropdowns();

            // Toggle current
            const parent =
                this.closest(".dropdown-action") ||
                this.closest(".card-actions");

            if (parent.classList.contains("dropdown-action")) {
                parent.classList.toggle("active");
            } else {
                // Mobile logic
                const menu = parent.querySelector(".mobile-dropdown-menu");
                menu.classList.toggle("show");
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function () {
        closeAllDropdowns();
    });

    function closeAllDropdowns() {
        document
            .querySelectorAll(".dropdown-action")
            .forEach((el) => el.classList.remove("active"));
        document
            .querySelectorAll(".mobile-dropdown-menu")
            .forEach((el) => el.classList.remove("show"));
    }

    // --- Actions (Export & Delete) ---
    const btnExport = document.getElementById("btnExport");
    if (btnExport) {
        btnExport.addEventListener("click", function () {
            showToast("Exportando lista de conductores...", "info");
            setTimeout(() => {
                showToast("Archivo descargado correctamente", "success");
            }, 1500);
        });
    }

    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            if (
                confirm("¿Estás seguro de que deseas eliminar este conductor?")
            ) {
                showToast("Conductor eliminado correctamente", "success");

                // Remove row or card
                const row = this.closest("tr");
                const card = this.closest(".driver-card");

                if (row) row.style.display = "none";
                if (card) card.style.display = "none";
            }
        });
    });
});
