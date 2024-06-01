// Selecciona los elementos necesarios
const carrouselSlide = document.querySelector('.carrousel-slide');
const carrouselImages = document.querySelectorAll('.carrousel-slide img');
const prevButton = document.querySelector('.carrousel-btn-prev');
const nextButton = document.querySelector('.carrousel-btn-next');

// Configura el índice de la imagen actual
let counter = 0;
const size = carrouselImages[0].clientWidth;

// Función para pasar a la imagen siguiente
function nextImage() {
    counter++;
    if (counter >= carrouselImages.length) counter = 0; // Vuelve al inicio si se pasó la última imagen
    carrouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
}

// Función para pasar a la imagen anterior
function prevImage() {
    counter--;
    if (counter < 0) counter = carrouselImages.length - 1; // Vuelve a la última imagen si se pasó la primera
    carrouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
}

// Agrega los controladores de eventos a los botones
nextButton.addEventListener('click', nextImage);
prevButton.addEventListener('click', prevImage);