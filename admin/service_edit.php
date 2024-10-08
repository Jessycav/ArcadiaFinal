<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
            // Gestion de la modification des services
            $service_id = $_GET['service_id'];
            // Requête pour récupérer les informations actuelles
            $query = $conn->prepare("SELECT * FROM service WHERE service_id = ?");
            $query->execute([$service_id]);
            $service = $query->fetch(PDO::FETCH_ASSOC);

            if (!$service) {
                echo "Ce service est introuvable.";
                exit;
            }
            // Si le formulaire est soumis par traitement POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $service_name = htmlspecialchars($_POST['service_name']);
                $service_description = htmlspecialchars($_POST['service_description']);

                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                    $image_tmp = $_FILES['image']['tmp_name'];
                    $image_name = basename($_FILES['image']['name']);
                    $image_path = '../images/photos_services/' . $image_name;
                    move_uploaded_file($image_tmp, $image_path);
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                    exit;
                }
                $sql = "UPDATE service 
                SET service_name = :service_name, service_description = :service_description, service_image_url = :service_image_url
                WHERE service_id = :service_id";
                
                try {                
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':service_name', $service_name, PDO::PARAM_STR);
                    $stmt->bindParam(':service_description', $service_description, PDO::PARAM_STR);
                    $stmt->bindParam(':service_image_url', $image_path, PDO::PARAM_STR);
                    $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
                    $stmt->execute();

                    echo "Le service a été modifié.";
                } catch (PDOException $e) {
                    echo "Erreur lors la modification des services: " . $e->getMessage();
                }
            } 
        ?>

        <div class="form-container">
            <h4>Modifier ce service</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service_id); ?>"> 
                <div class="inputBox">
                    <label for="service_name">Nom du service :</label>
                    <input type="text" id="service_name" name="service_name" value="<?php echo htmlspecialchars($service['service_name']); ?>" required/>
                </div>
                <div class="inputBox">
                    <label for="service_description">Description du service :</label>
                    <textarea id="service_description" name="service_description"><?php echo htmlspecialchars($service['service_description']); ?></textarea>
                </div>
                <div class="inputBox">
                    <label for="service_image">Ajouter une image :</label>
                    <br>
                    <?php if (!empty($service['service_image_url'])): ?>
                        <img src="<?php echo htmlspecialchars($service['service_image_url']); ?>" style="max-width: 200px;">
                    <?php endif; ?>
                    <br>
                    <input type="file" id="service_image_url" name="image">
                </div>
                <button class="btn" type="submit" name="edit">Enregistrer les modifications</button>
            </form>
        </div>
        <a href="service_admin.php"><button class="btn">Retour</button></a>
    </div>
