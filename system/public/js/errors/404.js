/* ============================================
   404 ERROR PAGE JS
   ============================================ */

document.addEventListener("DOMContentLoaded", () => {
    const highlight = document.querySelector(".highlight");
    const container = document.querySelector(".error-container");

    if (highlight && container) {
        // Parallax effect on mouse move
        container.addEventListener("mousemove", (e) => {
            const x = (window.innerWidth - e.pageX * 2) / 50;
            const y = (window.innerHeight - e.pageY * 2) / 50;

            highlight.style.transform = `translateX(${x}px) translateY(${y}px)`;
        });

        // Reset on mouse leave
        container.addEventListener("mouseleave", () => {
            highlight.style.transform = "translateX(0) translateY(0)";
        });
    }
});
