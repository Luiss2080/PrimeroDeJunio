/* ============================================
   CONDUCTORES - INDEX JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // Search Functionality
    const searchInput = document.getElementById("searchDriver");
    const tableRows = document.querySelectorAll(".data-table tbody tr");

    if (searchInput) {
        searchInput.addEventListener("keyup", function (e) {
            const searchTerm = e.target.value.toLowerCase();

            tableRows.forEach((row) => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }

    // Delete Confirmation
    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            if (
                !confirm(
                    "¿Estás seguro de que deseas eliminar este conductor? Esta acción no se puede deshacer."
                )
            ) {
                e.preventDefault();
            }
        });
    });

    // Filter by Status (Example placeholder)
    const statusFilter = document.getElementById("statusFilter");
    if (statusFilter) {
        statusFilter.addEventListener("change", function (e) {
            const status = e.target.value.toLowerCase();

            tableRows.forEach((row) => {
                const rowStatus = row
                    .querySelector(".status-badge")
                    .textContent.toLowerCase();
                if (status === "todos" || rowStatus.includes(status)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }
});
