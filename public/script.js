document.addEventListener("DOMContentLoaded", () => {
    // Gestion du menu toggle
    const menuToggle = document.querySelector('.menuToggle');
    const navbar = document.querySelector('.navbar');

    if (menuToggle && navbar) {
        menuToggle.addEventListener('click', () => {
            toggleMenu();
        });
    }

    function toggleMenu() {
        if (navbar) {
            navbar.classList.toggle('open');
            menuToggle.classList.toggle('active');
        }
    }

    // Gestion du modal de réservation
    const reservationModal = document.getElementById('reservationModal');
    const reservationButtons = document.querySelectorAll('.book_button');
    const closeModalButton = reservationModal ? reservationModal.querySelector('.close') : null;

    if (reservationButtons.length > 0) {
        reservationButtons.forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                if (reservationModal) {
                    reservationModal.style.display = 'block';
                }
            });
        });
    }

    if (closeModalButton) {
        closeModalButton.addEventListener('click', () => {
            if (reservationModal) {
                reservationModal.style.display = 'none';
            }
        });
    }

    window.addEventListener('click', event => {
        if (event.target === reservationModal) {
            reservationModal.style.display = 'none';
        }
    });

    // Défilement fluide pour les liens internes
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            e.preventDefault();
            const targetElement = document.getElementById(anchor.getAttribute('href').substring(1));
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Gestion de la visibilité de la navbar au défilement
    const header = document.querySelector('header');
    let lastScrollTop = 0;

    if (header) {
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                header.classList.add('hidden');
            } else {
                header.classList.remove('hidden');
            }

            lastScrollTop = scrollTop;
        });
    }

    // Gestion de la bannière de consentement aux cookies
    function checkCookieConsent() {
        if (!localStorage.getItem('cookie-consent')) {
            document.getElementById('cookie-banner').style.display = 'block';
        }
    }

    function acceptCookies() {
        localStorage.setItem('cookie-consent', 'true');
        document.getElementById('cookie-banner').style.display = 'none';
    }

    checkCookieConsent();

    const acceptButton = document.querySelector('#cookie-banner button');
    if (acceptButton) {
        acceptButton.addEventListener('click', acceptCookies);
    }

    // Gestion de l'éditeur de menu
    function openEditor() {
        document.getElementById('editor-modal').style.display = 'block';
    }

    function closeEditor() {
        document.getElementById('editor-modal').style.display = 'none';
    }

    // Ajouter des écouteurs d'événements pour ouvrir et fermer l'éditeur de menu
    const editMenuButton = document.querySelector('.menu-editor button');
    const editorModal = document.getElementById('editor-modal');

    if (editMenuButton) {
        editMenuButton.addEventListener('click', openEditor);
    }

    if (editorModal) {
        const closeEditorButton = editorModal.querySelector('.close');
        if (closeEditorButton) {
            closeEditorButton.addEventListener('click', closeEditor);
        }

        window.addEventListener('click', event => {
            if (event.target === editorModal) {
                closeEditor();
            }
        });
    }
});
