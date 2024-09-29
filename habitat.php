<?php 
    include 'components/connection.php';
?>

<?php 
    include 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Habitats et animaux</h4>
        </div>
        <section class='thumb'>        
            <?php
                $sql = "SELECT 'habitat_name', 'habitat_image_id' FROM habitat WHERE habitat_id IN ('1', '2', '3')";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $habitats = $stmt->fetchAll();

                if ($habitats) {
                    foreach ($habitats as $habitat) {
                        echo "<div class='box-container'>";
                        echo "<div class='box'>";
                        echo "<h4>" . htmlspecialchars($habitat['habitat_name']) . "</h4>";
                        if (!empty($habitat['habitat_image_id'])) {
                            echo "<img src='" . htmlspecialchars($habitat['habitat_image_id']) . "' alt='" . htmlspecialchars($habitat['habitat_image_id']) . ">";
                        } else {
                            echo "<p>Image non disponible</p>";
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        <section>
    </div>

    <section>   
    <!-- Footer -->
        <?php include 'components/footer.php';?>
    </section> 
</body>
</html>