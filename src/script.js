const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.getElementById('nav-links');

menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
});

//mappa
const map = L.map('map').setView([44.42833, 8.75222], 16);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

L.marker([44.42833, 8.75222]).addTo(map)
    .bindPopup('Ferramenta Luxardo<br>Via Carlo Camozzini 51/R, Voltri, Genova')
    .openPopup();