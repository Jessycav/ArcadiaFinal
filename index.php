<?php 
    require_once 'components/connection.php';

    require_once 'components/header.php';
?>
    <div class="main">
        <!-- Caroussel d'images pour page d'accueil -->
        <div id="image-carousel" class="carousel">
            <div class="carousel-inner">
                <div class="slide" style="background-image: url('../images/animaux/elephant1.jpg');"></div>
                <div class="slide" style="background-image: url('../images/animaux/tigre2.png');"></div>
                <div class="slide" style="background-image: url('../images/animaux/flamrose2.png');"></div>
            </div>    
            <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
            <button class="next" onclick="changeSlide(1)">&#10095;</button>
        </div>

        <div class="global-message">
            <h1>Bienvenue à Arcadia</h1>
            <h2>Venez vivre une parenthèse magique en forêt de Brocéliande</h2>
            <p>
                Notre parc zoologique fondé en 1960 vous propose de découvrir de nombreux animaux répartis en 3 habitats. 
                Vous aurez l'occasion de visiter notre savane africaine, notre jungle ainsi que notre petit marais.
            </p>
            <br>
            <p>
                Nous accordons la plus grande importance au bien-être de nos animaux grâce à l'implication quotidienne de nos équipes de soigneurs et vétérinaires. 
                Les contrôles médicaux et environnementaux mis en place nous permettent d'élever nos animaux sainement.
            </p>
            <br>   
            <p>
                Nous avons hâte de vous compter parmi nos visiteurs au zoo Arcadia et découvrez sans plus attendre les détails de notre parc animalier.
            </p>           
        </div>
        <br>
        <hr>
        <br>
        <!-- Sections du zoo -->
        <h3>Les habitats</h3>
        <section class="thumb">
            <div class="box-container">
                <div class="box">
                    <img src="images/photo_habitat/savane.jpg" alt="Savane">
                    <h4>La savane</h4>   
                </div>
                <div class="box">
                    <img src="images/photo_habitat/jungle.jpg" alt="Jungle">
                    <h4>La jungle</h4>   
                </div>
                <div class="box">
                    <img src="images/photo_habitat/marais.jpg" alt="Marais">
                    <h4>Le marais</h4>   
                </div>
            </div>
            <div>
                <a href="../habitat.php"><i class="fa fa-caret-square-o-right"></i></a>
            </div>
        </section>
        <br>
        <hr>
        <br>
        <h3>Nos animaux les plus célèbres</h3>
        <section class="animal">
            <div class="box-container">
                <div class="box">
                    <img src="images/animaux/girafe1.jpg" alt="Notre girafe Olga">
                    <h4>Olga</h4>   
                </div>
                <div class="box">
                    <img src="images/animaux/orangoutan1.jpg" alt="Notre orang-outan Louis">
                    <h4>Louis</h4>   
                </div>
                <div class="box">
                    <img src="images/animaux/crocodile2.jpg" alt="Notre crocodile Dundee">
                    <h4>Dundee</h4>
                </div>
                <div class="box">
                    <img src="images/animaux/hippo1.jpg" alt="Notre hippopotame Gumba">
                    <h4>Gumba</h4>
                </div>
                <div class="box">
                    <img src="images/animaux/guepard1.jpg" alt="Notre guépard Speedy">
                    <h4>Speedy</h4>
                </div>
                <div class="box">
                    <img src="images/animaux/couleuvre.jpg" alt="La couleuvre Naga">
                    <h4>Naga</h4>
                </div>
            </div>
            <br>
            <button class="btn" name="send"><a href="animals.php">DECOUVREZ TOUS NOS ANIMAUX</a></button>
        </section>
        <br>
        <hr>
        <br>
        <h3>Nos services</h3>
        <section class="services">
            <div class="box-container">
                <div class="box">
                    <i class="fa fa-cutlery"></i>
                    <h4>Se restaurer</h4>   
                </div>
                <div class="box">
                    <i class="fa fa-id-badge"></i>
                    <h4>Visite guidée</h4>   
                </div>
                <div class="box">
                    <i class="fa fa-train"></i>
                    <h4>Balade en petit train</h4>   
                </div>
            </div>
            <br>
            <button class="btn" name="send"><a href="service.php">VOIR LE DETAIL DES SERVICES</a></button>
        </section>
        <br>
        <hr>
        <br>
        <!-- Avis des visiteurs -->
        <h3>Les avis de nos visiteurs</h3>
        <div id="testimonial-carousel" class="carousel">
            <div class="carousel-inner" id="testimonial-slider-container">
                <!-- Slides ajoutées ici par Javascript -->
            </div>
            <button class="prev" onclick="changeTestimonialSlide(-1)">&#10094;</button>
            <button class="next" onclick="changeTestimonialSlide(1)">&#10095;</button>
            <br>
            <div>        
                <button class="btn" name="send"><a href="testimonial_form.php">LAISSER VOTRE AVIS</a></button>   
            </div>
        </div>
        
        <!-- Footer -->
        <?php require_once 'components/footer.php';?>
    </div>
    
</body>
</html>