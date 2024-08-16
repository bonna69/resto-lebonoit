// Fonction pour ouvrir la modale de réservation
function openReservationModal() {
    const modal = document.getElementById('reservationModal');
    if (modal) {
        modal.style.display = 'block';
    } else {
        console.error('Reservation modal not found');
    }
}

// Fonction pour fermer la modale de réservation
function closeReservationModal() {
    const modal = document.getElementById('reservationModal');
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error('Reservation modal not found');
    }
}

// Fonction pour basculer le menu
function toggleMenu() {
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.classList.toggle('active');
    } else {
        console.error('Navbar not found');
    }
}

// Ajout des gestionnaires d'événements lorsque le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', () => {
    // Gestion du menu
    const menuToggle = document.querySelector('.menuToggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    } else {
        console.error('Menu toggle not found');
    }

    // Gestion des événements pour les modales
    const reservationModalClose = document.querySelector('#reservationModal .close');
    if (reservationModalClose) {
        reservationModalClose.addEventListener('click', closeReservationModal);
    } else {
        console.error('Reservation modal close button not found');
    }

    window.addEventListener('click', (event) => {
        const modal = document.getElementById('reservationModal');
        if (modal && event.target === modal) {
            closeReservationModal();
        }
    });
});
