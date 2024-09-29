<?php 
    include 'components/connection.php';
    include 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Habitats et animaux</h4>
        </div>
        <section id="habitats" class="thumb">
            <div class="box-container">
                <?php
                    // Récupérer l'ID de l'habitat depuis l'URL
                    $habitat_id = isset($_GET['habitat_id']) ? (int)$_GET['habitat_id'] : 0;

                    // Erreur si l'ID n'est pas valide
                    if($habitat_id <= 0){
                        echo "Identifiant de l'habitat invalide";
                    }

                    try {
                        //Récupérer les détails de l'habitat et l'image de l'habitat
                        $sql = "SELECT habitat.habitat_name, habitat.habitat_description, habitat_image.habitat_image_url AS habitat_image_url
                            FROM habitat    
                            JOIN habitat_image ON habitat.habitat_id = habitat_image.habitat_id
                            WHERE habitat_id = :habitat_id";
                        $stmt_habitat = $conn->prepare($sql);                          
                        $stmt_habitat->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                        $stmt_habitat->execute();
                        $habitat = $stmt_habitat->fetch(PDO::FETCH_ASSOC);

                        //Si aucun habitat est trouvé
                        if (!$habitat) {
                            echo"Aucun habitat trouvé pour cet identifiant";
                        }

                        //Récupérer les animaux associés à l'habitat et les images
                        $stmt_animaux = $conn->prepare("
                            SELECT animal.animal_name, animal_image.animal_image_url AS animal_image_url
                            FROM animal 
                            JOIN animal_image ON animal.animal_id = animal_image.animal_id
                            WHERE animal.habitat_id = :habitat_id
                        ");
                        $stmt_animaux->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                        $stmt_animaux->execute();
                        $animaux = $stmt_animaux->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                ?>
            </div>

            <div class="box-container">
                <div class='box'>
                    <h5><?= htmlspecialchars($habitat['habitat_name']); ?></h5>
                    <img src="<?= htmlspecialchars($habitat['habitat_image_url'], ENT_QUOTES); ?>" alt="Image de <?= htmlspecialchars($habitat['habitat_name'], ENT_QUOTES); ?>">
                    <p><?= htmlspecialchars($habitat['habitat_description']); ?></p>
                </div>
                  
                <p>Dans cet habitat, vous trouverez :</p>
                <?php
                    foreach ($animaux as $animal) {
                        echo "<div class='box'>";
                        echo "<img src='" . htmlspecialchars($animal['animal_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($animal['animal_name'], ENT_QUOTES) . "'>";
                        echo "<h4>" . htmlspecialchars($animal['animal_name'], ENT_QUOTES) . "</h4>";
                        echo "<a href='animal_detail.php?animal=" . urlencode($animal['animal_name']) . "'>";
                        echo "<button class='btn'>Voir le détail</button>";
                        echo "</a>";
                        echo "</div>";
                    }     
                ?>
            </div>

            <a href="habitat.php">Retour à la liste des habitats</a>
        </section>
        <!-- Footer -->
        <?php include 'components/footer.php';?>    
    </div>

</body>
</html>