<?php 
    require_once 'components/connection.php';

    require_once 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Nos services</h4>
        </div>
        <h3>Informations pour préparer votre visite</h3>
        <h5>Pour faciliter votre venue, le parc zoologique d'Arcadia dispose de plusieurs services inclus dans le prix de votre billet d'entrée.</h5>
        <section id="service" class="service">
            <div class="box-container">
                <?php
                    $sql = "SELECT service.service_id, service.service_name, service.service_image_url, service.service_description FROM service";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($services as $service) {
                        echo "<div class='box'>";
                        echo "<img src='" . htmlspecialchars($service['service_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($service['service_name'], ENT_QUOTES) . "'>";
                        echo "<h4>" . htmlspecialchars($service['service_name']) . "</h4>";
                        echo "<p>" . htmlspecialchars($service['service_description']) . "</p>";
                        echo "</div>";
                    }     
                ?>    
            </div>
        </section>

        <!-- Footer -->
        <?php require_once 'components/footer.php';?>    
    </div>

</body>
</html>