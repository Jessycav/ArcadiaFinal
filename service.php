<?php 
    include 'components/connection.php';

    include 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Nos services</h4>
        </div>

        <h3>Le parc zoologique d'Arcadia dispose de plusieurs services pour faciliter votre visite</h3>
        <section id="service" class="service">
            <div class="box-container">
                <?php
                    $query = "SELECT service.service_id, service.service_name, service.service_image_url, service.service_description FROM service";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($services as $service) {
                        echo "<div class='box'>";
                        echo "<h4>" . htmlspecialchars($service['service_name']) . "</h4>";
                        echo "<img src='" . htmlspecialchars($service['service_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($service['service_name'], ENT_QUOTES) . "'>";
                        echo "<p>" . htmlspecialchars($service['service_description']) . "</p>";
                        echo "</div>";
                    }     
                ?>
            </div>
        </section>

        <!-- Footer -->
        <?php include 'components/footer.php';?>    
    </div>

</body>
</html>