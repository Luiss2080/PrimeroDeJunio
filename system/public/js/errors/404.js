/* ============================================
   404 ERROR PAGE JS
   ============================================ */

document.addEventListener("DOMContentLoaded", () => {
    const errorCode = document.getElementById("errorCode");

    // Parallax effect on mouse move
    document.addEventListener("mousemove", (e) => {
        const x = (window.innerWidth - e.pageX * 2) / 50;
        const y = (window.innerHeight - e.pageY * 2) / 50;

        errorCode.style.transform = `translateX(${x}px) translateY(${y}px)`;
    });

    // Glitch effect on hover
    errorCode.addEventListener("mouseover", () => {
        errorCode.style.textShadow =
            "2px 2px 0px #ff0000, -2px -2px 0px #0000ff";
        setTimeout(() => {
            errorCode.style.textShadow = "0 0 30px rgba(0, 255, 102, 0.3)";
        }, 200);
    });
});
