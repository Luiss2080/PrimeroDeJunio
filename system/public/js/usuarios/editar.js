/* ============================================
   USUARIOS - EDITAR JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // Image Preview Logic
    const photoInput = document.getElementById("photoInput");
    const photoPreview = document.getElementById("photoPreview");

    if (photoInput && photoPreview) {
        photoInput.addEventListener("change", function (e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    photoPreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    }

    // Optional: Add form submission animation or validation here
    const form = document.getElementById("editForm");
    if (form) {
        form.addEventListener("submit", function () {
            const btn = this.querySelector('button[type="submit"]');
            if (btn) {
                btn.innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
                btn.disabled = true;
            }
        });
    }
});
