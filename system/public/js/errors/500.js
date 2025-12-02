/* ============================================
   500 ERROR PAGE JS
   ============================================ */

document.addEventListener("DOMContentLoaded", () => {
    const highlight = document.querySelector(".highlight");

    if (highlight) {
        // Random glitch intensity
        setInterval(() => {
            const intensity = Math.random() * 10;
            if (intensity > 7) {
                const x = Math.random() * 10 - 5;
                const y = Math.random() * 10 - 5;

                highlight.style.textShadow = `${x}px ${y}px 0 #a855f7, ${-x}px ${-y}px 0 #ffffff`;

                setTimeout(() => {
                    highlight.style.textShadow =
                        "0 0 30px rgba(168, 85, 247, 0.6), 0 0 60px rgba(168, 85, 247, 0.4)";
                }, 100);
            }
        }, 2000);
    }
});
