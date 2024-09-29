// Changement automatique des slides
let currentSlideIndex  = 0; //variable de l'index de l'image visible
let currentTestimonialIndex = 0;

function changeSlide(n) {
    const slides = document.querySelectorAll('#image-carousel .slide');
    showSlides(currentSlideIndex += n, slides); 
}

function showSlides(n, slides) {
    if (n >= slides.length) currentSlideIndex = 0;
    if (n < 0) currentSlideIndex = slides.length - 1;

    slides.forEach(slide => slide.style.display = 'none');
    slides[currentSlideIndex].style.display = 'block';  
};
    
function initializeImageCarousel (){
    const slides = document.querySelectorAll('#image-carousel .slide');
    slides[0].style.display ='block';

    setInterval(() =>{
        changeSlide(1);
    }, 2000);
}

function changeTestimonialSlide(n) {
    const testimonialSlides = document.querySelectorAll('#testimonial-carousel .slide');
    showTestimonialSlide(currentTestimonialIndex += n, testimonialSlides);
}

function showTestimonialSlide(n, testimonialSlides) {
    if (n >= testimonialSlides.length) currentTestimonialIndex = 0;
    if (n < 0) currentTestimonialIndex = testimonialSlides.length - 1;

    testimonialSlides.forEach(slide => slide.style.display = 'none');
    testimonialSlides[currentTestimonialIndex].style.display = 'block';
}

function initializeTestimonialCarousel() {
    const testimonialSlides = document.querySelectorAll('#testimonial-carousel .slide');
    if (testimonialSlides.length > 0) {
        testimonialSlides[0].style.display = 'block';
        
        setInterval(() =>{
            changeTestimonialSlide(1);
        }, 4000);
    }
}

initializeImageCarousel();
initializeTestimonialCarousel();