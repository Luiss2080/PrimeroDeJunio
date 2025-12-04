/* ============================================
   VIAJES - EDITAR JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // Form Validation (Basic)
    const form = document.getElementById("editForm");
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
            } else {
                const btn = this.querySelector('button[type="submit"]');
                if (btn) {
                    btn.innerHTML =
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
                    btn.disabled = true;
                }
            }
        });
    }
});
