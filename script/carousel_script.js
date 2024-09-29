// Changement automatique des slides
let currentSlide  = 0; //variable de l'index de l'image visible

let slides = document.querySelectorAll('.carousel-images img', '.testimonial-item'); //Récupère toutes les images de la div .carousel-images
const totalSlides = slides.length; // Stocke le nombre total d'images dans le caroussel

function showSlides(index) {
    slides[index].classList.add('active'); //fonction pour rendre visible une image et cacher les autres
    slides.forEach((slide, i) => {
        if (i === index) {
            slide.classList.add('active');
        } else {
            slide.classList.remove('active');
        }
    });
}

function changeSlide(direction) {
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
    showSlides(currentSlide);

    if(currentSlide > slides.length){
        currentSlide = 0;
    }    
}

setInterval(() => {
    changeSlide(1);
}, 1500);

showSlides(currentSlide)