/* ============================================
   VIAJES - CREAR / EDITAR JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // Form Validation (Basic)
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (e) {
            const requiredInputs = form.querySelectorAll("[required]");
            let isValid = true;

            requiredInputs.forEach((input) => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add("error");
                } else {
                    input.classList.remove("error");
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert("Por favor, completa todos los campos obligatorios.");
            }
        });
    }

    // Auto-calculate total if needed (future implementation)
    // Example: Distance * Rate
});
