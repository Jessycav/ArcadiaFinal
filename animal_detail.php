<?php 
    include 'components/connection.php';
?>

<?php 
    include 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Nos animaux</h4>
        </div>

        <?php
        // Récupérer le nom de l'animal via l'URL
        $nom_animal = isset($_GET['animal_name']) ? $_GET['animal_name'] : '';

        //Préparer la requête pour récupérer les détails de l'animal
        $sql = "SELECT animal.animal_name AS animal_name, 
                        animal.health, 
                        animal_image.animal_image_url, 
                        breed.breed_name, 
                        habitat.habitat_name
                FROM animal JOIN animal_image JOIN breed JOIN habitat 
                ON animal.animal_id = animal_image.animal_id = animal.breed_id = animal.habitat_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':animal_name', $nom_animal, PDO::PARAM_STR);
        $stmt->execute();
        $animal = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($animal) {
            echo "<h3>Détail de l'animal : " . htmlspecialchars($animal['animal_name'], ENT_QUOTES) . "<h3>";
            echo "<img src='" . htmlspecialchars($animal['animal_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($animal['animal_name'], ENT_QUOTES) . "'>";
            echo "<p>Habitat : " . htmlspecialchars($animal['habitat_name'], ENT_QUOTES) . "<p>";
            echo "<p>Race : " . htmlspecialchars($animal['breed_name'], ENT_QUOTES) . "<p>";
            echo "<p>Habitat : " . htmlspecialchars($animal['habitat_name'], ENT_QUOTES) . "<p>";
            echo "<p>État de l\'animal : " . htmlspecialchars($animal['health'], ENT_QUOTES) . "<p>";
        } else {
            echo "<p>Aucun animal trouvé pour cet habitat<p>"; 
        }
        ?>
    </div>
 
    
    <!-- Footer -->
    <?php include 'components/footer.php';?>
</div>

</body>
</html>
