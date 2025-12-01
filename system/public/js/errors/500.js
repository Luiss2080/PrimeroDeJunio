/* ============================================
   500 ERROR PAGE JS
   ============================================ */

document.addEventListener("DOMContentLoaded", () => {
    const glitchElement = document.querySelector(".glitch");

    // Random glitch intensity
    setInterval(() => {
        const intensity = Math.random() * 10;
        if (intensity > 8) {
            glitchElement.style.textShadow = `${Math.random() * 10 - 5}px ${
                Math.random() * 10 - 5
            }px 0 #ff00c1, ${Math.random() * 10 - 5}px ${
                Math.random() * 10 - 5
            }px 0 #00fff9`;
            setTimeout(() => {
                glitchElement.style.textShadow = "none";
            }, 100);
        }
    }, 2000);
});
