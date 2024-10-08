<?php 
    require_once '../components/connection.php';
    
    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
            // Ajouter l'animal à la base de données
            //Vérifier si le formulaire a été soumis
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $animal_name = htmlspecialchars($_POST['animal_name']);
                $habitat_id = htmlspecialchars($_POST['habitat_id']);
                $breed_id = htmlspecialchars($_POST['breed_id']);
                $health = htmlspecialchars($_POST['health']);

                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $image_name = basename($_FILES['image']['name']);
                    $image_path = '../images/animaux/' . $image_name;
                    move_uploaded_file($image_tmp, $image_path);
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                    exit;
                }

                // Démarrer une transaction
                $conn->beginTransaction();

                try {
                    // Insertion dans la table animal
                    $sql_animal = "INSERT INTO animal (animal_name, habitat_id, breed_id, health) VALUES (:animal_name, :habitat_id, :breed_id, :health)";
                    $stmt_animal = $conn->prepare($sql_animal);
                    $stmt_animal->bindParam(':animal_name', $animal_name);
                    $stmt_animal->bindParam(':habitat_id', $habitat_id);
                    $stmt_animal->bindParam(':breed_id', $breed_id);
                    $stmt_animal->bindParam(':health', $health);

                    if ($stmt_animal->execute()) {
                        // Récupérer id animal
                        $animal_id = $conn->lastInsertId();

                        // Insérer dans la table animal_image
                        $sql_image = "INSERT INTO animal_image (animal_id, animal_image_url) VALUES (:animal_id, :animal_image_url)";
                        $stmt_image = $conn->prepare($sql_image);
                        $stmt_image->bindParam(':animal_id', $animal_id);
                        $stmt_image->bindParam(':animal_image_url', $image_path);

                        if ($stmt_image->execute()) {
                            // Valider la transaction
                            $conn->commit();
                            echo "Le nouvel animal a été ajouté avec succès.";
                        } else {
                            throw new Exception("Erreur lors de l'ajout de l'image.");
                        }
                    } else {
                        throw new Exception("Erreur lors de l'ajout de l'animal.");
                    }
                } catch (PDOException $e) {
                    echo("Erreur lors de l'ajout de l'animal: " . $e->getMessage());
                }
            }
        ?>

        <h3>Gestion des animaux du zoo</h3>
        <br>
        <section class="dashboard">
            <div class="box-container">
                <h4>Ajouter un animal</h4>
                <div class="form-container">
                    <form action="animal_add.php" method="POST" enctype="multipart/form-data">
                        <div class="inputBox">
                            <label for="animal_name">Nom de l'animal :</label>
                            <input type="text" id="name" name="animal_name" placeholder="Entrer un nom" required>
                        </div>
                        <div class="inputBox">
                            <label for="habitat_id">Habitat :</label>
                            <select id="habitat_id" name="habitat_id" required>
                                <?php
                                // Récupérer les habitats
                                $sql = "SELECT habitat_id, habitat_name FROM habitat";
                                $stmt = $conn->query($sql);
                                $habitats = $stmt->fetchAll();

                                foreach ($habitats as $habitat) {
                                    echo "<option value='" . $habitat['habitat_id'] . "'>" . $habitat['habitat_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inputBox">
                            <label for="breed_name">Race :</label>
                            <select id="breed_id" name="breed_id" required>
                                <?php
                                // Récupérer les races
                                $sql = "SELECT breed_id, breed_name FROM breed";
                                $stmt = $conn->query($sql);
                                $breeds = $stmt->fetchAll();
                                foreach ($breeds as $breed) {
                                    echo "<option value='" . $breed['breed_id'] . "'>" . $breed['breed_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inputBox">
                            <label for="health">État de santé :</label>
                            <input type="text" id="health" name="health" placeholder="Saisir l'état de santé">
                        </div>
                        <div class="inputBox">
                            <label for="animal_image">Image de l'animal :</label>
                            <input type="file" id="animal_image" name="image" accept="../images/animaux/*" required>
                        </div>
                        <button class="btn" type="submit">Enregistrer</button>
                    </form>
                </div>
                <a href="animal_admin.php"><button class="btn">Retour</button></a>
            </div>
        </section>
    </div>
</body>
</html>