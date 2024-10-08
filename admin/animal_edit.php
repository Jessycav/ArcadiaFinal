<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';;
?>
    <div class="main">
        <?php
            $animal_id = $_GET['animal_id'];
            $query = $conn->prepare("
                SELECT animal.animal_id, animal.animal_name, animal.health, breed.breed_name, habitat.habitat_name, animal_image.animal_image_url, veterinary_report.food, veterinary_report.food_weight
                FROM animal
                LEFT JOIN habitat ON animal.habitat_id = habitat.habitat_id
                LEFT JOIN breed ON animal.breed_id = breed.breed_id
                LEFT JOIN animal_image ON animal.animal_id = animal_image.animal_id
                LEFT JOIN veterinary_report ON animal.animal_id = veterinary_report.animal_id
                WHERE animal.animal_id = ?
                ");
            $query->execute([$animal_id]);
            $animal = $query->fetch(PDO::FETCH_ASSOC);

            if (!$animal) {
                echo "Cet animal est introuvable.";
                exit;
            }
            try {
                //Récupérer les données depuis le formulaire
                $animal_id = isset($animal['animal_id']) ? $animal['animal_id'] : '';
                $health = isset($animal['health']) ? $animal['health'] : '';
               
                $sql_health = "UPDATE animal 
                SET health = :health 
                WHERE animal_id = :animal_id";
            
                $stmt = $conn->prepare($sql_health);
                $stmt->bindParam(':health', $health, PDO::PARAM_STR);
                $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
                $stmt->execute();

                // Vérifier si un rapport vétérinaire existe
                $query = $conn->prepare("SELECT animal_id FROM veterinary_report WHERE animal_id = :animal_id");
                $query->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
                $query->execute();
                $veterinary_report = $query->fetch(PDO::FETCH_ASSOC);

                $food = isset($animal['food']) ? $animal['food'] : '';
                $food_weight = isset($animal['food_weight']) ? $animal['food_weight'] : '';

                $sql_report = "UPDATE veterinary_report 
                SET food = :food, food_weight = :food_weight 
                WHERE animal_id = :animal_id";
               
                $stmt = $conn->prepare($sql_report);
                $stmt->bindParam(':food', $food, PDO::PARAM_STR);
                $stmt->bindParam(':food_weight', $food_weight, PDO::PARAM_STR);
                $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
                $stmt->execute();

                // Gérer le téléchargement de l'image
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $image_name = basename($_FILES['image']['name']);
                    $image_path = '../images/animaux/' . $image_name;
                    move_uploaded_file($image_tmp, $image_path);

                    $sql_image = "UPDATE animal_image 
                    SET animal_image_url = :animal_image_url 
                    WHERE animal_id = :animal_id";            

                    $stmt = $conn->prepare($sql_image);
                    $stmt->bindParam(':animal_image_url', $image_path, PDO::PARAM_STR);
                    $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
                    $stmt->execute();
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                }
                echo "Les modifications ont été enregistrées.";
            } catch (PDOException $e) {
                echo "Erreur lors la modification de la fiche: " . $e->getMessage();
            }
        ?>

        <div class="form-container">
            <h4>Modifier cet animal</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="animal_id" value="<?php echo htmlspecialchars($animal_id); ?>"> 
                <div class="inputBox">
                    <label for="animal_name">Nom de l'animal :</label>
                    <input type="text" id="animal_name" value="<?php echo htmlspecialchars($animal['animal_name']); ?>" disabled/>
                </div>
                <div class="inputBox">
                    <label for="habitat_name">Habitat de l'animal :</label>
                    <input type="text" id="habitat_name" value="<?php echo htmlspecialchars($animal['habitat_name']); ?>" disabled/>
                </div>
                <div class="inputBox">
                    <label for="breed_name">Race de l'animal :</label>
                    <input type="text" id="breed_name" value="<?php echo htmlspecialchars($animal['breed_name']); ?>" disabled/>
                </div>
                <h5>État de l'animal</h5>
                <div class="inputBox">
                    <label for="health">Santé :</label>
                    <input type="text" id="health" name="health" value="<?php echo $health; ?>" required/>
                </div>
                <div class="inputBox">
                    <label for="food">Nourriture :</label>
                    <input type="text" id="food" name="food" value="<?php echo $food; ?>"/>
                </div>
                
                <div class="inputBox">
                    <label for="food_weight">Poids de la nourriture:</label>
                    <input type="text" id="food_weight" name="food_weight" value="<?php echo $food_weight; ?>"/>
                </div>
                <div class="inputBox">
                    <label for="animal_image">Ajouter une image :</label>
                    <br>
                    <?php if (!empty($animal['animal_image_url'])): ?>
                        <img src="<?php echo htmlspecialchars($animal['animal_image_url']); ?>" style="max-width: 200px;">
                    <?php endif; ?>
                    <br>
                    <input type="file" id="animal_image_url" name="image">
                </div>
                <button class="btn" type="submit">Enregistrer les modifications</button>
            </form>
            <br>
            <a href="animal_admin.php"><button class="btn">Retour</button></a>
        </div>
    </div>
</body>
</html>