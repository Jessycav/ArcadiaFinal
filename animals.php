<?php 
    require_once 'components/connection.php';

    require_once 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Nos animaux</h4>
        </div>
        <h3>Venez à la rencontre de nos animaux</h3>
        <h5>Dans cette rubrique, vous pouvez découvrir la liste de tous les animaux merveilleux vivant à Arcadia.</h5>

        <?php
            // Filtrage par habitat
            $habitat_filter = isset($_GET['habitat_id']) ? $_GET['habitat_id'] : '';

            // Recupérer les données animaux avec jointure
            $sql = "SELECT animal.animal_id, animal.animal_name, animal_image.animal_image_url 
            FROM animal 
            JOIN animal_image ON animal.animal_id = animal_image.animal_id";

            if ($habitat_filter) {
                $sql .= " WHERE animal.habitat_id = :habitat_id";
            }   
            // Préparation de la requête pour sécuriser et éviter les injections SQL
            $stmt = $conn->prepare($sql);

            // Lier le paramètre si le filtre est appliqué
            if ($habitat_filter) {
                $stmt->bindParam(':habitat_id', $habitat_filter, PDO::PARAM_STR);
            }

            //Exécuter la requête
            $stmt->execute();

            //Récupération des résultats
            $animals = $stmt->fetchAll(PDO::FETCH_ASSOC); //tableau associatif de résultats
        ?>
        
        <!-- Filtrer les animaux par habitats -->
        <div class="filter">
            <form action="" method="GET"> 
                <label for="user_name">Filtrer par habitat :</label>
                <select name="habitat_id" id="habitat_id">
                    <option value="">-- Tous --</option>
                    <option value="1" <?php if($habitat_filter == '1') echo 'selected'; ?>>Savane</option>
                    <option value="2" <?php if($habitat_filter == '2') echo 'selected'; ?>>Jungle</option>
                    <option value="3" <?php if($habitat_filter == '3') echo 'selected'; ?>>Marais</option>
                </select>
                <button class="btn" type="submit">Filtrer</button>
            </form>
        </div>

        <section class="animal">
            <div class="box-container">
                <?php
                //vérifier si des animaux ont été trouvés
                if (!empty($animals)) {
                    // Affichage de chaque animal avec échappement des caractères spéciaux et éviter failles CSS
                    foreach ($animals as $animal) {
                        echo "<div class='box'>";
                        echo "<img src='" . htmlspecialchars($animal['animal_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($animal['animal_name'], ENT_QUOTES) . "'>";
                        echo "<h4>" . htmlspecialchars($animal['animal_name'], ENT_QUOTES) . "</h4>";
                        echo "<a href='animal_detail.php?id=" . urlencode($animal['animal_id']) . "'>";
                        echo "<button>Voir le détail</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aucun animal trouvé pour cet habitat<p>"; 
                }
                ?>
            </div>
        </section>       
        
        <!-- Footer -->
        <?php require_once 'components/footer.php';?>
    </div>
    
</body>
</html>