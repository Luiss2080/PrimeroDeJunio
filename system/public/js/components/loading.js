/* ============================================
   LOADING SCREEN JS
   ============================================ */
const LoadingScreen = {
    overlay: null,

    init: function () {
        this.overlay = document.getElementById("loadingOverlay");

        // Show on initial load if needed, or hide it
        // Currently hidden by default via CSS

        // Expose globally
        window.showLoading = this.show.bind(this);
        window.hideLoading = this.hide.bind(this);
    },

    show: function () {
        if (this.overlay) {
            this.overlay.classList.add("active");
        }
    },

    hide: function () {
        if (this.overlay) {
            this.overlay.classList.remove("active");
        }
    },
};

document.addEventListener("DOMContentLoaded", () => {
    LoadingScreen.init();
});
