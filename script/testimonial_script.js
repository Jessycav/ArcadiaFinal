fetch('get_testimonials.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur lors du chargement des avis');
        }
        return response.json();
    })
    .then(testimonials => {
        const sliderContainer = document.getElementById('testimonial-slider-container');
        testimonials.forEach((testimonial, index) => {
            const slide = document.createElement('div');
            slide.classList.add('slide');

            slide.innerHTML = `
                <h5>${testimonial.visitor_firstname}</h5>
                <p>Visite du ${new Date(testimonial.visit_date).toLocaleDateString('fr-FR')}</p>
                <p>"${testimonial.message}"</p>
            `;
            sliderContainer.appendChild(slide);
        });
        initializeTestimonialCarousel();
    })
    .catch(error => {
        console.error('Erreur lors du chargement des avis', error);
        document.getElementById('testimonial-slider-container').innerHTML = `<p>${error.message}</p>`;
    });


