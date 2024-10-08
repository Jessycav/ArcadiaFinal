<?php 
    require_once 'components/connection.php';

    require_once 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Habitats et animaux</h4>
        </div>
        <section id="detail_page">
            <h3>L'habitat en détail</h3>
            <div class="box-container">
                <?php
                    // Récupérer l'ID de l'habitat depuis l'URL
                    $habitat_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

                    // Erreur si l'ID n'est pas valide
                    if ($habitat_id <= 0) {
                        echo "Identifiant de l'habitat invalide";
                    }

                    //Récupérer les détails de l'habitat et l'image de l'habitat
                    $query = "SELECT habitat.habitat_name, habitat_image.habitat_image_url, habitat.habitat_description
                            FROM habitat
                            JOIN habitat_image ON habitat.habitat_id = habitat_image.habitat_id
                            WHERE habitat.habitat_id = :habitat_id";

                    $stmt = $conn->prepare($query);                          
                    $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);

                    //Si aucun habitat est trouvé
                    if (!$habitat) {
                        echo"Aucun habitat trouvé pour cet identifiant";
                    }

                    $query_animals = "SELECT animal.animal_id, animal.animal_name
                    FROM animal
                    WHERE animal.habitat_id = :habitat_id";
                    //Récupérer les animaux associés à l'habitat et les images
                    $stmt_animals = $conn->prepare($query_animals);           
                    $stmt_animals->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                    $stmt_animals->execute();
                    $animals = $stmt_animals->fetchAll(PDO::FETCH_ASSOC);  
                ?>
                <div class="box">
                    <h5 class="title"><?= htmlspecialchars($habitat['habitat_name']); ?></h5>
                    <div class="image">
                        <img src="<?= htmlspecialchars($habitat['habitat_image_url'], ENT_QUOTES); ?>" alt="Image de<?= htmlspecialchars($habitat['habitat_name'], ENT_QUOTES); ?>">
                    </div>
                    <br>
                    <div class="description">
                        <p><?= htmlspecialchars($habitat['habitat_description']); ?></p>
                        <p>Dans cet habitat, vous trouverez :</p>
                        <ul>
                            <?php foreach ($animals as $animal): ?>
                                <li><a href="animal_detail.php?id=<?= htmlspecialchars($animal['animal_id']); ?>"><?= htmlspecialchars($animal['animal_name']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <a href="habitat.php"><button class="btn">Retour à la liste des habitats</button></a>
        </section>
        <!-- Footer -->
        <?php require_once 'components/footer.php';?>    
    </div>

</body>
</html>