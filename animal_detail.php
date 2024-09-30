<?php 
    include 'components/connection.php';

    include 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Nos animaux</h4>
        </div>

        <?php
        // Récupérer le nom de l'animal via l'URL
            $animal_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

            if ($animal_id <= 0) {
                echo "Identifiant de l'animal invalide";
            }

            //Préparer la requête pour récupérer les détails de l'animal
            $query = "SELECT animal.animal_name, animal.health, breed.breed_name, habitat.habitat_name, habitat.habitat_id, animal_image.animal_image_url, veterinary_report.food, veterinary_report.food_weight
                    FROM animal
                    JOIN habitat ON animal.habitat_id = habitat.habitat_id
                    JOIN breed ON animal.breed_id = breed.breed_id
                    LEFT JOIN animal_image ON animal.animal_id = animal_image.animal_id
                    LEFT JOIN veterinary_report ON animal.animal_id = veterinary_report.animal_id
                    WHERE animal.animal_id = :animal_id
                    ";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
            $stmt->execute();
            $animal = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <div>
            <h3>Détail de l'animal <? htmlspecialchars($animal['animal_name'], ENT_QUOTES); ?></h3>
            <img src="<?= htmlspecialchars($animal['animal_image_url'], ENT_QUOTES); ?>" alt="Image de <? htmlspecialchars($animal['animal_name'], ENT_QUOTES); ?>">
            <p>Habitat : <a href="habitat_detail.php?id=<?= htmlspecialchars($animal['habitat_id']); ?>"><?= htmlspecialchars($animal['habitat_name'], ENT_QUOTES); ?></a></p>
            <p>Race : <?= htmlspecialchars($animal['breed_name'], ENT_QUOTES); ?></p>
            <h4>Iformations du vétérinaire</h4>
            <p>État de santé : <?= htmlspecialchars($animal['health'], ENT_QUOTES); ?></p>
            <p>Nourriture : <?= htmlspecialchars($animal['food'], ENT_QUOTES); ?></p>
            <p>Grammage : <?= htmlspecialchars($animal['food_weight'], ENT_QUOTES); ?></p>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'components/footer.php';?>


</body>
</html>
