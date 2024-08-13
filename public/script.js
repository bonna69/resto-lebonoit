document.addEventListener('DOMContentLoaded', () => {
    // Afficher la bannière de consentement aux cookies si non accepté
    if (!localStorage.getItem('cookiesAccepted')) {
        document.getElementById('cookie-banner')?.style.display = 'block';
    }

    // Gestion des modales
    document.querySelectorAll('.modal').forEach(modal => {
        modal.querySelector('.close')?.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    });

    // Formulaire de réservation
    document.getElementById('reservationForm')?.addEventListener('submit', (event) => {
        event.preventDefault();
        // Ajoutez ici votre logique de soumission de formulaire
        console.log('Réservation effectuée');
    });

    // Initialisation de la carte Leaflet
    if (document.getElementById('map')) {
        var map = L.map('map').setView([45.75, 4.85], 13); // Coordonnées pour Lyon, France

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([45.75, 4.85]).addTo(map); // Marqueur pour Lyon, France

        marker.bindPopup("<b>Nous sommes ici !</b><br>Adresse de votre entreprise.").openPopup();
    }
});

// Fonction pour accepter les cookies
function acceptCookies() {
    localStorage.setItem('cookiesAccepted', 'true');
    document.getElementById('cookie-banner')?.style.display = 'none';
}

// Fonction pour ouvrir la modale de contact
function openContactModal() {
    document.getElementById('contactModal')?.style.display = 'block';
}

// Fonction pour fermer la modale de contact
function closeContactModal() {
    document.getElementById('contactModal')?.style.display = 'none';
}

// Fonction pour ouvrir la modale de réservation
function openReservationModal() {
    document.getElementById('reservationModal')?.style.display = 'block';
}

// Fonction pour fermer toutes les modales
function closeModal() {
    document.querySelectorAll('.modal').forEach(modal => {
        modal.style.display = 'none';
    });
}

// Fonction pour afficher/cacher le menu
function toggleMenu() {
    document.querySelector('.navbar')?.classList.toggle('show');
}
