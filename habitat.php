<?php 
    require_once 'components/connection.php';

    require_once 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Habitats et animaux</h4>
        </div>
        <h3>Découvrez les différents habitats de notre zoo Arcadia</h3>
        <section id="habitats" class="thumb">
            <div class="box-container">
                <?php
                    $query = "SELECT habitat.habitat_id, habitat.habitat_name, habitat_image.habitat_image_url 
                            FROM habitat 
                            JOIN habitat_image 
                            ON habitat.habitat_id = habitat_image.habitat_id";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($habitats as $habitat) {
                        echo "<div class='box'>";
                        echo "<h4>" . htmlspecialchars($habitat['habitat_name']) . "</h4>";
                        echo "<img src='" . htmlspecialchars($habitat['habitat_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($habitat['habitat_name'], ENT_QUOTES) . "'>";
                        echo "<a href='habitat_detail.php?id=" . urlencode($habitat['habitat_id']) . "'>";
                        echo "<button class='btn'>Voir le détail</button>";
                        echo "</a>";
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