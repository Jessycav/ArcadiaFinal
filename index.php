<?php 
    include 'components/connection.php';
?>

<?php 
    include 'components/header.php';
?>
    <div class="main">
        <!-- Caroussel d'images pour page d'accueil -->
        <div class="carousel">
            <div class="carousel-images">
                <img src="../images/animaux/elephant1.jpg" alt="Nos éléphants">
                <img src="../images/animaux/tigre2.png" alt="Fu le tigre">
                <img src="../images/animaux/flamrose2.png" alt="Nos flamants roses">
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
                Nous avons hâte de vous compter parmi nos visiteurs au zoo Arcadia et découvrez sans plus attendre des détails sur notre parc animalier.
            </p>           
        </div>
        <br>
        <hr>
        <!-- Sections du zoo -->
        <h3>Les habitats</h3>
        <section class="thumb">
            <div class="box-container">
                <div class="box">
                    <img src="images/photo-habitat/savane.jpg" alt="Savane">
                    <h4>La savane</h4>   
                    <i class="fa fa-caret-square-o-right"></i>
                </div>
                <div class="box">
                    <img src="images/photo-habitat/jungle.jpg" alt="Jungle">
                    <h4>La jungle</h4>   
                    <i class="fa fa-caret-square-o-right"></i>
                </div>
                <div class="box">
                    <img src="images/photo-habitat/marais.jpg" alt="Marais">
                    <h4>Le marais</h4>   
                    <i class="fa fa-caret-square-o-right"></i>
                </div>
            </div>
        </section>
        <br>
        <hr>
        <h3>Nos animaux les plus célèbres</h3>
        <section class="animal">
            <div class="box-container">
                <div class="box">
                    <img src="images/animaux/girafe1.jpg" alt="Notre girafe Olga">
                    <h4>Olga</h4>   
                    <a href="animal.php"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box">
                    <img src="images/animaux/orangoutan1.jpg" alt="Notre orang-outan Louis">
                    <h4>Louis</h4>   
                    <a href="animal.php"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box">
                    <img src="images/animaux/crocodile2.jpg" alt="Notre crocodile Dundee">
                    <h4>Dundee</h4>
                    <a href="animal.php"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box">
                    <img src="images/animaux/hippo1.jpg" alt="Notre hippopotame Gumba">
                    <h4>Gumba</h4>
                    <a href="animal.php"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box">
                    <img src="images/animaux/guepard1.jpg" alt="Notre guépard Speedy">
                    <h4>Speedy</h4>
                    <a href="animal.php"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box">
                    <img src="images/animaux/couleuvre.jpg" alt="La couleuvre Naga">
                    <h4>Naga</h4>
                    <a href="animal.php"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <br>
            <button class="btn" name="send"><a href="animals.php">DECOUVREZ TOUS NOS ANIMAUX</a></button>
        </section>
        <br>
        <hr>
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
            <button class="btn" name="send"><a href="services.php">VOIR LE DETAIL DES SERVICES</a></button>
        </section>
        <br>
        <hr>
        <!-- Avis des visiteurs -->
        <h3>Les avis de nos visiteurs</h3>
        <div class="testimonial-container">
            <div class="container">
                <?php
                try {
                    $sql = "SELECT * FROM testimonial WHERE approuve_message = 1";
                    $stmt = $conn->prepare($sql);

                    $stmt->execute();

                    $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach($testimonials as $testimonial) {
                        echo "<div class='testimonial-item'>";
                        echo "<h5>" . htmlspecialchars($testimonial['visitor_firstname'], ENT_QUOTES) ."</h5>
                        <p>" . htmlspecialchars($testimonial['visit_date'], ENT_QUOTES) . " </p>
                        <p>" . htmlspecialchars($testimonial['message'], ENT_QUOTES) ." </p>
                        </div>";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage() . "</br>";
                    die ();
                }
                ?>
                <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
                <button class="next" onclick="changeSlide(1)">&#10095;</button> 
            </div>        
            <button class="btn" name="send"><a href="testimonial_form.php">LAISSER VOTRE AVIS</a></button>
        </div>
        
        <!-- Footer -->
        <?php include 'components/footer.php';?>
    </div>
    
</body>
</html>