/* ============================================
   CONDUCTORES - CREAR / EDITAR JS
   ============================================ */

document.addEventListener("DOMContentLoaded", function () {
    // Image Preview
    const photoInput = document.getElementById("photoInput");
    const photoPreview = document.getElementById("photoPreview");
    const uploadContainer = document.querySelector(".photo-upload-container");

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

        // Click on container to trigger input
        if (uploadContainer) {
            uploadContainer.addEventListener("click", function () {
                photoInput.click();
            });
        }
    }

    // Form Validation (Basic)
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (e) {
            const requiredInputs = form.querySelectorAll("[required]");
            let isValid = true;

            requiredInputs.forEach((input) => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = "#ff3b30";
                } else {
                    input.style.borderColor = "";
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert("Por favor, completa todos los campos obligatorios.");
            }
        });
    }
});
