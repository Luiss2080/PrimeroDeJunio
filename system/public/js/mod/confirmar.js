document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("deleteModal");
    const cancelBtn = document.getElementById("cancelDeleteBtn");
    const confirmBtn = document.getElementById("confirmDeleteBtn");
    const deleteForm = document.getElementById("deleteForm");

    // Function to open modal
    window.openDeleteModal = function (actionUrl, itemName = "este elemento") {
        if (!modal) return;

        // Update form action
        deleteForm.action = actionUrl;

        // Update item name if placeholder exists
        const itemSpan = document.getElementById("deleteItemName");
        if (itemSpan) {
            itemSpan.textContent = itemName;
        }

        // Show modal
        modal.classList.add("active");
    };

    // Function to close modal
    window.closeDeleteModal = function () {
        if (!modal) return;
        modal.classList.remove("active");
    };

    // Event Listeners
    if (cancelBtn) {
        cancelBtn.addEventListener("click", window.closeDeleteModal);
    }

    // Close on click outside
    if (modal) {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                window.closeDeleteModal();
            }
        });
    }

    // Close on Escape key
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && modal.classList.contains("active")) {
            window.closeDeleteModal();
        }
    });
});
