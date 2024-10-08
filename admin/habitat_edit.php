<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
            // Gestion de la modification des habitats
            $habitat_id = $_GET['habitat_id'];
            // Requête pour récupérer les informations actuelles
            $query = $conn->prepare("
                SELECT habitat.habitat_id, habitat.habitat_name, habitat_image.habitat_image_url, habitat.habitat_description
                FROM habitat
                LEFT JOIN habitat_image ON habitat.habitat_id = habitat_image.habitat_id
                WHERE habitat.habitat_id = ?
                ");
            $query->execute([$habitat_id]);
            $habitat = $query->fetch(PDO::FETCH_ASSOC);

            if (!$habitat) {
                echo "Cet habitat est introuvable.";
                exit;
            }
            // Si le formulaire est soumis par traitement POST
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
                    exit;
                }
    
                try {   
                    $sql_habitat = "UPDATE habitat SET habitat_name = :habitat_name, habitat_description = :habitat_description WHERE habitat_id = :habitat_id"; 
                    $stmt_habitat = $conn->prepare($sql_habitat);
                    $stmt_habitat->bindParam(':habitat_name', $habitat_name, PDO::PARAM_STR);
                    $stmt_habitat->bindParam(':habitat_description', $habitat_description, PDO::PARAM_STR);
                    $stmt_habitat->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                    $stmt_habitat->execute();

                    if ($stmt_habitat->execute()) {
                        $habitat_id = $conn->lastInsertId();
                        $sql_image = "UPDATE habitat_image SET habitat_image_url = :habitat_image_url WHERE habitat_id = :habitat_id"; 
                        $stmt_image = $conn->prepare($sql_image);
                        $stmt_image->bindParam(':habitat_image_url', $image_path, PDO::PARAM_STR);
                        $stmt_image->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                        $stmt_image->execute();

                        echo "L'habitat a été modifié.";
                    } else {
                        echo "Erreur de modification de l'habitat.";
                    }
                } catch (PDOException $e) {
                    echo "Erreur lors la modification de l'habitat: " . $e->getMessage();
                }
            } 
        ?>

        <div class="form-container">
            <h4></h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="habitat_id" value="<?php echo htmlspecialchars($habitat_id); ?>"> 
                <div class="inputBox">
                    <label for="habitat_name">Nom de l'habitat :</label>
                    <input type="text" id="habitat_name" name="habitat_name" value="<?php echo htmlspecialchars($habitat['habitat_name']); ?>" required/>
                </div>
                <div class="inputBox">
                    <label for="habitat_description">Description de l'habitat :</label>
                    <textarea id="habitat_description" name="habitat_description" required maxlength="2000"><?php echo htmlspecialchars($habitat['habitat_description']); ?></textarea>
                </div>
                <div class="inputBox">
                    <label for="habitat_image">Ajouter une image :</label>
                    <br>
                    <?php if (!empty($habitat['habitat_image_url'])): ?>
                        <img src="<?php echo htmlspecialchars($habitat['habitat_image_url']); ?>" style="max-width: 200px;">
                    <?php endif; ?>
                    <br>
                    <input type="file" id="habitat_image_url" name="image">
                </div>
                <button class="btn" type="submit" name="edit">Enregistrer les modifications</button>
            </form>
        </div>
        <a href="habitat_admin.php"><button class="btn">Retour</button></a>
    </div>
