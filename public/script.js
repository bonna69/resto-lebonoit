document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.querySelector('header'); // Sélectionne l'élément du header (contenant la navbar)
    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            navbar.classList.add('hidden'); // Cache la navbar
        } else {
            navbar.classList.remove('hidden'); // Montre la navbar
        }

        lastScrollTop = scrollTop;
    });

    // Gestion du menu
    document.querySelector('.menuToggle').addEventListener('click', function() {
        document.querySelector('.navbar').classList.toggle('active');
        this.classList.toggle('active');
    });

    // Modal de réservation
    const reservationModal = document.getElementById('reservationModal');
    const openModalButtons = document.querySelectorAll('.book_button');
    const closeModalButton = reservationModal.querySelector('.close');

    openModalButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            reservationModal.style.display = 'flex';
        });
    });

    closeModalButton.addEventListener('click', function() {
        reservationModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === reservationModal) {
            reservationModal.style.display = 'none';
        }
    });

    // Défilement fluide pour les liens internes
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetElement = document.getElementById(this.getAttribute('href').substring(1));
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});
