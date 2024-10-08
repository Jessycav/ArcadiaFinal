<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
        // Gestion de l'ajout des services
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
            }

            $sql = "INSERT INTO service (service_name, service_description, service_image_url) VALUES (:service_name, :service_description, :service_image_url)";
   
            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':service_name', $service_name);
                $stmt->bindParam(':service_description', $service_description);
                $stmt->bindParam(':service_image_url', $image_path);
                $stmt->execute();

                echo "Le nouveau service a été ajouté";
            } catch (PDOException $e) {
                echo "Erreur lors l'ajout du service: " . $e->getMessage();
            }
        }

        // Récupération des services existants
        $sql = "SELECT * FROM service";
        $result = $conn->query($sql);
        ?>
        
        <h3>Gestion des services du zoo</h3>
        <!-- Formulaire pour ajouter un service -->
        <div class="form-container">
            <h4>Ajouter un service</h4>
            <form action="service_admin.php" method="POST" enctype="multipart/form-data">
                <div class="inputBox">
                    <label for="service_name">Nom du service :</label>
                    <input type="text" id="service_name" name="service_name" placeholder="Entrer le nom du service" required />
                </div>
                <div class="inputBox">
                    <label for="service_description">Description du service :</label>
                    <input type="text" id="service_description" name="service_description" placeholder="Entrer un description du service" required />
                </div>
                <div class="inputBox">
                    <label for="service_image">Ajouter une image :</label>
                    <input type="file" id="service_image_url" name="image" accept="../images/photos_services/*">
                </div>
                <button class="btn" type="submit">ENREGISTRER</button>
            </form>
        </div>

        <hr>

        <!-- Liste des services existants -->
        <?php
            $sql = "SELECT * FROM service";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $services = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        ?>
        <h4>Liste des services actuels</h4>
        <section id="service">
            <div class="box-container">
                <?php
                //vérifier si des services ont été trouvés
                if (!empty($services)) {
                    // Affichage de chaque service avec échappement des caractères spéciaux et éviter failles CSS
                    foreach ($services as $service) {
                        echo "<div class='box'>";
                        echo "<img src='" . htmlspecialchars($service['service_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($service['service_name'], ENT_QUOTES) . "'>";
                        echo "<h4>" . htmlspecialchars($service['service_name'], ENT_QUOTES) . "</h4>";
                        echo "<p>" . htmlspecialchars($service['service_description'], ENT_QUOTES) . "</p>";
                        echo "<a href='service_edit.php?service_id=" . urlencode($service['service_id']) . "'>";
                        echo "<button>Modifier</button>";
                        echo "</a>";
                        echo "<a href='service_suppr.php?service_id=" . urlencode($service['service_id']) . "'>";
                        echo "<button>Supprimer</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aucun service trouvé<p>"; 
                }
                ?>
            </div>
        </section>
        <a href="dashboard_admin.php"><button class="btn">Retour</button></a>
    </div>
        
</body>
</html>