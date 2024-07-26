document.addEventListener('DOMContentLoaded', () => {
    const reservationBtn = document.querySelector(".book-button");
    const modal = document.getElementById("reservationModal");
    const closeBtn = document.querySelector(".close");

    reservationBtn.addEventListener("click", () => {
        modal.style.display = "block";
    });

    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
