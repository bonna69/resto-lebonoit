// This script toggles the menu in responsive view
const menuToggle = document.querySelector('.menuToggle');
const navbar = document.querySelector('.navbar');
menuToggle.addEventListener('click', () => {
    navbar.classList.toggle('active');
});
