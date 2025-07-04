window.addEventListener('load', () => {
    document.body.classList.add('loaded');
});

const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.getElementById('nav-links');

menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
});

//mappa
const map = L.map('map').setView([44.42850, 8.74959], 18);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

L.marker([44.42850, 8.74959]).addTo(map)
    .bindPopup('Ferramenta Luxardo<br>Via Carlo Camozzini 51/R, Voltri, Genova')
    .openPopup();