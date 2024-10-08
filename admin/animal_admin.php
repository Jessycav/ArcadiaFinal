<?php 
    require_once '../components/connection.php';
    
    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <h3>Gestion des animaux du zoo</h3>
        <br>
        <a href="animal_add.php"><button class="btn">Ajouter un animal</button></a>
        <br>
        <div class="box-container">
            <?php
            $select_animal = $conn->prepare("SELECT * FROM `animal`");
            $select_animal->execute();
            $num_of_animals = $select_animal->rowCount();
            ?>
            <h4><?= $num_of_animals; ?> animaux ajoutés</h4>
            <?php
                $sql = "SELECT animal.animal_id, animal.animal_name, animal_image.animal_image_url 
                        FROM animal 
                        JOIN animal_image ON animal.animal_id = animal_image.animal_id";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $animals = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            ?>
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
                            echo "<a href='animal_edit.php?animal_id=" . urlencode($animal['animal_id']) . "'>";
                            echo "<button>Modifier</button>";
                            echo "</a>";
                            echo "<a href='animal_suppr.php?animal_id=" . urlencode($animal['animal_id']) . "'>";
                            echo "<button>Supprimer</button>";
                            echo "</a>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Aucun animal trouvé pour cet habitat<p>"; 
                    }
                    ?>
                </div>
            </section> 
            <a href="dashboard_admin.php"><button class="btn">Retour</button></a>
        </div>
        

    </div>
        
</body>
</html>
        