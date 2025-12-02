/* ============================================
   403 ERROR PAGE JS
   ============================================ */

document.addEventListener("DOMContentLoaded", () => {
    const highlight = document.querySelector(".highlight");

    if (highlight) {
        // Shake animation function
        function shakeElement() {
            highlight.style.transition = "transform 0.1s";
            highlight.style.transform = "translateX(5px)";
            setTimeout(() => {
                highlight.style.transform = "translateX(-5px)";
                setTimeout(() => {
                    highlight.style.transform = "translateX(5px)";
                    setTimeout(() => {
                        highlight.style.transform = "translateX(-5px)";
                        setTimeout(() => {
                            highlight.style.transform = "translateX(0)";
                        }, 100);
                    }, 100);
                }, 100);
            }, 100);
        }

        // Shake on load
        setTimeout(shakeElement, 500);

        // Shake on click/hover
        highlight.addEventListener("mouseover", shakeElement);
        highlight.addEventListener("click", shakeElement);
    }
});
