/* ============================================
   USUARIOS - CREAR / EDITAR JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // Image Preview
    const photoInput = document.getElementById("photoInput");
    const photoPreview = document.getElementById("photoPreview");
    const uploadContainer = document.querySelector(".avatar-upload-wrapper");

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

    // Form Validation (Basic)
    const form = document.getElementById("createForm");
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
});
