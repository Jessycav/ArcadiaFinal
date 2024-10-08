<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
        // Gestion de l'ajout des habitats
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $habitat_name = htmlspecialchars($_POST['habitat_name']);
            $habitat_description = htmlspecialchars($_POST['habitat_description']);

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                $image_tmp = $_FILES['image']['tmp_name'];
                $image_name = basename($_FILES['image']['name']);
                $image_path = '../images/photo_habitat/' . $image_name;
                move_uploaded_file($image_tmp, $image_path);
            } else {
                echo "Erreur lors du téléchargement de l'image.";
            }

            $conn->beginTransaction();

            try {
                // Insertion dans la table habitat
                $sql_habitat = "INSERT INTO habitat (habitat_name, habitat_description) VALUES (:habitat_name, :habitat_description)";
                $stmt_habitat = $conn->prepare($sql_habitat);
                $stmt_habitat->bindParam(':habitat_name', $habitat_name);
                $stmt_habitat->bindParam(':habitat_description', $habitat_description);

                if ($stmt_habitat->execute()) {
                    // Récupérer id habitat
                    $habitat_id = $conn->lastInsertId();

                    // Insérer dans la table habitat_image
                    $sql_image = "INSERT INTO habitat_image (habitat_id, habitat_image_url) VALUES (:habitat_id, :habitat_image_url)";
                    $stmt_image = $conn->prepare($sql_image);
                    $stmt_image->bindParam(':habitat_id', $habitat_id);
                    $stmt_image->bindParam(':habitat_image_url', $image_path);

                    if ($stmt_image->execute()) {
                        // Valider la transaction
                        $conn->commit();
                        echo "Le nouvel habitat a été ajouté avec succès.";
                    } else {
                        throw new Exception("Erreur lors de l'ajout de l'image.");
                    }
                } else {
                    throw new Exception("Erreur lors de l'ajout de l'habitat.");
                }
            } catch (PDOException $e) {
                echo("Erreur lors de l'ajout : " . $e->getMessage());
            }
        }
        ?>
        
        <h3>Gestion des habitats du zoo</h3>
        <!-- Formulaire pour ajouter un habitat -->
        <div class="form-container">
            <h4>Ajouter un habitat</h4>
            <form action="habitat_admin.php" method="POST" enctype="multipart/form-data">
                <div class="inputBox">
                    <label for="habitat_name">Nom de l'habitat :</label>
                    <input type="text" id="habitat_name" name="habitat_name" placeholder="Entrer le nom de l'habitat" required />
                </div>
                <div class="inputBox">
                    <label for="habitat_description">Description de l'habitat :</label>
                    <textarea type="text" id="habitat_description" name="habitat_description" required maxlength="2000" placeholder="Entrer une description de l'habitat"></textarea>
                </div>
                <div class="inputBox">
                    <label for="habitat_image">Ajouter une image :</label>
                    <input type="file" id="habitat_image_url" name="image" accept="../images/photo_habitat/*" required>
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
                        echo "<a href='habitat_edit.php?habitat_id=" . urlencode($habitat['habitat_id']) . "'>";
                        echo "<button>Modifier</button>";
                        echo "</a>";
                        echo "<a href='habitat_suppr.php?habitat_id=" . urlencode($habitat['habitat_id']) . "'>";
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
        <br>
        <a href="dashboard_admin.php"><button class="btn">Retour</button></a>
    </div>
</body>
</html>