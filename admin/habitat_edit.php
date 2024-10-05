<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <?php
            // Gestion de la modification des habitats
            $habitat_id = $_GET['habitat_id'];
            // Requête pour récupérer les informations actuelles
            $query = $conn->prepare("SELECT * FROM habitat WHERE habitat_id = ?");
            $query->execute([$habitat_id]);
            $habitat = $query->fetch(PDO::FETCH_ASSOC);

            if (!$habitat) {
                echo "Ce habitat est introuvable.";
                exit;
            }
            // Si le formulaire est soumis par traitement POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $habitat_name = htmlspecialchars($_POST['habitat_name']);
                $habitat_description = htmlspecialchars($_POST['habitat_description']);

                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $image_name = basename($_FILES['image']['name']);
                    $image_path = '../images/photos_habitats/' . $image_name;
                    move_uploaded_file($image_tmp, $image_path);
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                    exit;
                }
                $sql = "UPDATE habitat 
                SET habitat_name = :habitat_name, habitat_description = :habitat_description, habitat_image_url = :habitat_image_url
                WHERE habitat_id = :habitat_id";
                
                try {                
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':habitat_name', $habitat_name, PDO::PARAM_STR);
                    $stmt->bindParam(':habitat_description', $habitat_description, PDO::PARAM_STR);
                    $stmt->bindParam(':habitat_image_url', $image_path, PDO::PARAM_STR);
                    $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                    $stmt->execute();

                    echo "Le habitat a été modifié.";
                } catch (PDOException $e) {
                    echo "Erreur lors la modification des habitats.";
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
                    <label for="habitat_description">Description du habitat :</label>
                    <textarea id="habitat_description" name="habitat_description"><?php echo htmlspecialchars($habitat['habitat_description']); ?></textarea>
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
    </div>
