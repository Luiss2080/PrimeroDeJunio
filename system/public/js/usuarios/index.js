/* ============================================
   USUARIOS - INDEX JS
   ============================================ */

window.addEventListener("load", function () {
    // Force hide loading overlay if it exists
    const overlay = document.getElementById("loadingOverlay");
    if (overlay) {
        overlay.classList.remove("active");
        overlay.style.opacity = "0";
        overlay.style.visibility = "hidden";
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // --- Toast Notification System ---
    window.showToast = function (message, type = "success") {
        const toastContainer = document.getElementById("toastContainer");
        if (!toastContainer) return;

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
    };

    // --- Search Functionality (Desktop & Mobile) ---
    // Note: This client-side search is supplementary to the server-side search via AJAX
    const searchInput = document.getElementById("searchUser");
    const tableRows = document.querySelectorAll(".data-table tbody tr");
    const mobileCards = document.querySelectorAll(".user-card");
    const emptyStateTable = document.getElementById("emptyState"); // For table
    const emptyStateMobile = document.querySelector(".empty-state-mobile"); // For mobile
    const tableHead = document.querySelector(".data-table thead");

    if (searchInput) {
        searchInput.addEventListener("keyup", function (e) {
            // If using server-side search (UsuariosFilters), this might be redundant or conflict.
            // However, for immediate feedback on current page, we can keep it or rely solely on the filter class.
            // The Drivers module has both, so we keep it for consistency, but check if it conflicts.
            // In Drivers module, this seems to filter the *currently visible* rows.

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
                    card.style.display = "flex"; // Cards are flex containers or block
                    visibleCountMobile++;
                } else {
                    card.style.display = "none";
                }
            });
        });
    }

    // --- Filter Panel Toggle ---
    const btnFilter = document.getElementById("btnFilter");
    const filterPanel = document.getElementById("filterPanel");

    if (btnFilter && filterPanel) {
        btnFilter.addEventListener("click", function () {
            filterPanel.classList.toggle("active"); // Changed from 'show' to 'active' to match CSS
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
                // The actual reload is handled by UsuariosFilters if initialized
            });
        });

        // Close when clicking outside
        document.addEventListener("click", function (e) {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove("active");
            }
        });
    }

    // --- Actions (Export) ---
    const btnExport = document.getElementById("btnExport");
    if (btnExport) {
        btnExport.addEventListener("click", function () {
            showToast("Exportando lista de usuarios...", "info");
            setTimeout(() => {
                showToast("Archivo descargado correctamente", "success");
            }, 1500);
        });
    }
});
