/* ============================================
   VIAJES - PERFIL JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // --- Tab Switching Logic (if needed in future) ---
    // Currently Viajes profile is simple enough to not need tabs,
    // but keeping structure ready.

    // --- Quick Actions Logic ---
    const printBtn = document.querySelector(".btn-action-icon.print");
    if (printBtn) {
        printBtn.addEventListener("click", () => {
            window.print();
        });
    }
});
