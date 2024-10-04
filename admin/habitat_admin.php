<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <?php
            // Récupération des habitats existants
            $sql = "SELECT * FROM habitat";
            $result = $conn->query($sql);
        ?>
        
        <h3>Gestion des habitats du zoo</h3>
        <!-- Formulaire pour ajouter un habitat -->
        <div class="form-container">
            <h4>Ajouter un habitat</h4>
            <form method="POST">
                <div class="inputBox">
                    <label for="habitat_name">Nom du habitat :</label>
                    <input type="text" id="habitat_name" name="habitat_name" placeholder="Entrer le nom de l'habitat" required />
                </div>
                <div class="inputBox">
                    <label for="habitat_description">Description de l'habitat :</label>
                    <textarea type="text" id="description" name="description" required maxlength="2000" placeholder="Entrer un description du habitat"></textarea>
                </div>
                <div class="inputBox">
                    <label for="habitat_image">Ajouter une image :</label>
                    <input type="file" id="habitat_image" name="image" accept="../images/*" required>
                </div>
                <button class="btn" type="submit" name="register">Enregistrer</button>
            </form>
        </div>

        <hr>

        <!-- Liste des habitats existants -->
        <?php
            $sql = "SELECT habitat.habitat_id, habitat.habitat_name, habitat.habitat_description, habitat_image.habitat_image_url 
            FROM habitat 
            JOIN habitat_image ON habitat.habitat_id = habitat_image.habitat_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        ?>
        <h4>Liste des habitats actuels</h4>
        <section id="habitat">
            <div class="box-container">
                <?php
                //vérifier si des animaux ont été trouvés
                if (!empty($habitats)) {
                    // Affichage de chaque animal avec échappement des caractères spéciaux et éviter failles CSS
                    foreach ($habitats as $habitat) {
                        echo "<div class='box'>";
                        echo "<img src='" . htmlspecialchars($habitat['habitat_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($habitat['habitat_name'], ENT_QUOTES) . "'>";
                        echo "<h4>" . htmlspecialchars($habitat['habitat_name'], ENT_QUOTES) . "</h4>";
                        echo "<p>" . htmlspecialchars($habitat['habitat_description'], ENT_QUOTES) . "</p>";
                        echo "<a href='habitat_edit.php?id=" . urlencode($habitat['habitat_id']) . "'>";
                        echo "<button>Modifier</button>";
                        echo "</a>";
                        echo "<a href='habitat_suppr.php?id=" . urlencode($habitat['habitat_id']) . "'>";
                        echo "<button>Supprimer</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aucun habitat trouvé<p>"; 
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>