document.addEventListener("DOMContentLoaded", () => {
  // Gestion du clic sur le bouton "Goûtez Annaba"
  const tasteAnnabaBtn = document.getElementById('taste-annaba');
  if (tasteAnnabaBtn) {
      tasteAnnabaBtn.addEventListener('click', (event) => {
          event.preventDefault();
          const targetElement = document.getElementById('menu');
          if (targetElement) {
              targetElement.scrollIntoView({
                  behavior: 'smooth'
              });
          }
      });
  }

  // Gestion du clic sur le bouton de réservation
  const reservationBtn = document.querySelector(".book_button");
  const modal = document.getElementById("reservationModal");
  const closeBtn = modal.querySelector(".close");

  if (reservationBtn) {
      reservationBtn.addEventListener("click", (event) => {
          event.preventDefault();
          modal.style.display = "block";
      });
  }

  // Gestion du clic sur le bouton de fermeture de la modale
  if (closeBtn) {
      closeBtn.addEventListener("click", () => {
          modal.style.display = "none";
      });
  }

  // Fermer la modale en cliquant en dehors de la zone de contenu
  window.addEventListener("click", (event) => {
      if (event.target === modal) {
          modal.style.display = "none";
      }
  });

  // Fonction pour basculer le menu
  const navbarToggle = document.querySelector('.menu-toggle');
  if (navbarToggle) {
      navbarToggle.addEventListener('click', toggleMenu);
  }

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const targetId = this.getAttribute('href').substring(1);
          const targetElement = document.getElementById(targetId);
          if (targetElement) {
              targetElement.scrollIntoView({
                  behavior: 'smooth'
              });
          }
      });
  });

  const guestButtons = document.querySelectorAll('.guest-buttons button');
  const guestCount = document.getElementById('guest-count');
  const guestInput = document.getElementById('guests');

  if (guestButtons.length > 0 && guestCount && guestInput) {
      guestButtons.forEach(button => {
          button.addEventListener('click', () => {
              guestButtons.forEach(btn => btn.classList.remove('active'));
              button.classList.add('active');

              let guestValue = button.dataset.guest;
              if (guestValue === 'more') {
                  guestValue = parseInt(guestInput.value) + 1;
              }
              guestCount.textContent = guestValue;
              guestInput.value = guestValue;
          });
      });
  }
});

// Fonction pour basculer le menu
function toggleMenu() {
  const navbar = document.querySelector('.navbar');
  if (navbar) {
      navbar.classList.toggle('open');
  }
}
