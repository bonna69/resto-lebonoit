document.addEventListener('DOMContentLoaded', () => {
    // Sélection des éléments nécessaires
    const reservationModal = document.getElementById('reservationModal');
    const openModalButton = document.querySelector('.book_button');
    const closeModalButton = reservationModal.querySelector('.close');
    const menuToggle = document.querySelector('.menuToggle');
    const navbar = document.querySelector('.navbar');

    // Ouvrir la modale de réservation
    openModalButton.addEventListener('click', (event) => {
        event.preventDefault();
        reservationModal.style.display = 'block';
    });

    // Fermer la modale de réservation
    closeModalButton.addEventListener('click', () => {
        reservationModal.style.display = 'none';
    });

    // Fermer la modale si l'utilisateur clique en dehors du contenu
    window.addEventListener('click', (event) => {
        if (event.target === reservationModal) {
            reservationModal.style.display = 'none';
        }
    });

    // Gestion de l'ouverture et fermeture du menu de navigation sur mobile
    menuToggle.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });

    // Fermer le menu de navigation si un lien est cliqué
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            navbar.classList.remove('active');
        });
    });
});
