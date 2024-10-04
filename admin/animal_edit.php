<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';;
?>
    <div class="main">
        <?php
        // Récupérer le nom de l'animal via l'URL
            $animal_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

            if ($animal_id <= 0) {
                echo "Identifiant de l'animal invalide";
            }

            //Préparer la requête pour récupérer les détails de l'animal
            $sql = "SELECT animal.animal_name, animal.health, breed.breed_name, habitat.habitat_name, habitat.habitat_id, animal_image.animal_image_url, veterinary_report.food, veterinary_report.food_weight
                    FROM animal
                    JOIN habitat ON animal.habitat_id = habitat.habitat_id
                    JOIN breed ON animal.breed_id = breed.breed_id
                    LEFT JOIN animal_image ON animal.animal_id = animal_image.animal_id
                    LEFT JOIN veterinary_report ON animal.animal_id = veterinary_report.animal_id
                    WHERE animal.animal_id = :animal_id
                    ";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
            $stmt->execute();
            $animal = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <section id="detail_page">
            <h3>Modifier un animal</h3>
            <div class="box-container">
                <h5 class="title"><?= htmlspecialchars($animal['animal_name'], ENT_QUOTES); ?></h5>
                <div class="box">
                    <div class="image">
                        <img src="<?= htmlspecialchars($animal['animal_image_url'], ENT_QUOTES); ?>" alt="Image de <? htmlspecialchars($animal['animal_name'], ENT_QUOTES); ?>">
                    </div>
                    <br>
                    <div class="description">
                        <p>Habitat : <a href="habitat_detail.php?id=<?= htmlspecialchars($animal['habitat_id']); ?>"><?= htmlspecialchars($animal['habitat_name'], ENT_QUOTES); ?></a></p>
                        <p>Race : <?= htmlspecialchars($animal['breed_name'], ENT_QUOTES); ?></p>
                        <h4>Informations du vétérinaire</h4>
                        <p>État de santé : <?= htmlspecialchars($animal['health'], ENT_QUOTES); ?></p>
                        <?php
                            // Conditions pour vérifier la présence d'un rapport du vétérinaire
                            if (!empty($animal['food']) && !empty($animal['food_weight'])) {
                                echo '<p>Nourriture : ' . htmlspecialchars($animal['food'], ENT_QUOTES) . '</p>';
                                echo '<p>Grammage : ' . htmlspecialchars($animal['food_weight'], ENT_QUOTES) . '</p>';
                            } else {
                                echo '<p>Aucun rapport vétérinaire n\'est disponible pour cet animal. </p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <a href='animal_admin.php'><button class='btn'>Retour à la liste des animaux</button></a>
        </section>
    </div>
</body>
</html>