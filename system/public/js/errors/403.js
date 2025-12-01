/* ============================================
   403 ERROR PAGE JS
   ============================================ */

document.addEventListener("DOMContentLoaded", () => {
    const lockIcon = document.getElementById("lockIcon");

    // Shake animation function
    function shakeLock() {
        lockIcon.style.transform = "rotate(10deg)";
        setTimeout(() => {
            lockIcon.style.transform = "rotate(-10deg)";
            setTimeout(() => {
                lockIcon.style.transform = "rotate(5deg)";
                setTimeout(() => {
                    lockIcon.style.transform = "rotate(-5deg)";
                    setTimeout(() => {
                        lockIcon.style.transform = "rotate(0deg)";
                    }, 100);
                }, 100);
            }, 100);
        }, 100);
    }

    // Shake on load
    setTimeout(shakeLock, 500);

    // Shake on click/hover
    lockIcon.addEventListener("mouseover", shakeLock);
    lockIcon.addEventListener("click", shakeLock);
});
