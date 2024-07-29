const reservationBtn = document.querySelector(".book_button");

const closeBtn = document.querySelector(".close");

reservationBtn.addEventListener("click", (event) => {
            event.preventDefault();
            window.open("{{ path('reservation') }}", "Réservation", "width=600,height=800");
        });

        closeBtn.addEventListener("click", () => {
            window.close();
        });

function toggleMenu() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('open');
        }

        const guestButtons = document.querySelectorAll('.guest-buttons button');
const guestCount = document.getElementById('guest-count');
const guestInput = document.getElementById('guests');

guestButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Remove active class from all buttons
    guestButtons.forEach(btn => btn.classList.remove('active'));
    
    // Add active class to clicked button
    button.classList.add('active');

    let guestValue = button.dataset.guest;
    if (guestValue === 'more') {
      // Handle "+" button (e.g., open a modal or increase count by a larger number)
      // For simplicity, let's just increase by 1 for now
      guestValue = parseInt(guestInput.value) + 1;
    }
    guestCount.textContent = guestValue;
    guestInput.value = guestValue;
  });
});
document.addEventListener("DOMContentLoaded", () => {
  const reservationBtn = document.querySelector(".book_button");
  const closeBtn = document.querySelector(".close");

  if (reservationBtn) {
      reservationBtn.addEventListener("click", (event) => {
          event.preventDefault();
          window.open("{{ path('reservation') }}", "Réservation", "width=600,height=800");
      });
  }

  if (closeBtn) {
      closeBtn.addEventListener("click", () => {
          window.close();
      });
  }
});
