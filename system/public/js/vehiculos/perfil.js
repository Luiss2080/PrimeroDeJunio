/* ============================================
   VEHICULOS - PERFIL JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // --- Tab Switching Logic ---
    const tabBtns = document.querySelectorAll(".tab-btn");
    const tabContents = document.querySelectorAll(".tab-content");

    if (tabBtns.length > 0) {
        tabBtns.forEach((btn) => {
            btn.addEventListener("click", function () {
                // Remove active class from all buttons and contents
                tabBtns.forEach((b) => b.classList.remove("active"));
                tabContents.forEach((c) => c.classList.remove("active"));

                // Add active class to clicked button
                this.classList.add("active");

                // Show corresponding content
                const tabId = this.getAttribute("data-tab");
                const targetContent = document.getElementById(tabId);
                if (targetContent) {
                    targetContent.classList.add("active");
                }
            });
        });
    }
});
