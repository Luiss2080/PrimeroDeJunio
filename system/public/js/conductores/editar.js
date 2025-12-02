/* ============================================
   CONDUCTORES - EDITAR JS
   ============================================ */
/* Reusing logic from crear.js */
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

        if (uploadContainer) {
            uploadContainer.addEventListener("click", function () {
                photoInput.click();
            });
        }
    }
});
