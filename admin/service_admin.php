<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <?php
        // Gestion de l'ajout des services
        if (isset($_POST['add_service'])) {
            $service_name = $_POST['service_name'];
            $service_description = $_POST['service_description'];
            $service_image = $_POST['service_image_url'];

            $sql = "INSERT INTO service (service_name, service_description, service_image_url) VALUES ('$service_name', '$service_description', '$service_image')";
            if ($conn->query($sql) === TRUE) {
                echo "Le service a été ajouté avec succès";
            } else {
                echo "Erreur: " . $conn->$error;
            }
        }

        // Gestion de la suppression des services
        if (isset($_GET['delete'])) {
            $service_id = $_GET['delete'];
            $sql = "DELETE FROM service WHERE service_id = $service_id";
            if ($conn->query($sql) === TRUE) {
                echo "Le service a été supprimé avec succès";
            } else {
                echo "Erreur: " . $conn->$error;
            }
        }

        // Gestion de la modification des services
        if (isset($_GET['update_service'])) {
            $service_id = $_GET['service_id'];
            $service_name = $_POST['service_name'];
            $service_description = $_POST['service_description'];
            $service_image = $_POST['service_image_url'];

            $sql = "UPDATE service SET service_name='$service_name', service_description='$service_description', service_image_url='$service_image' WHERE service_id=$service_id";
            if ($conn->query($sql) === TRUE) {
                echo "Le service a été modifié avec succès";
            } else {
                echo "Erreur: " . $conn->$error;
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
            <form method="POST">
                <div class="inputBox">
                    <label for="service_name">Nom du service :</label>
                    <input type="text" id="service_name" name="service_name" placeholder="Entrer le nom du service" required />
                </div>
                <div class="inputBox">
                    <label for="service_description">Description du service :</label>
                    <input type="text" id="description" name="description" placeholder="Entrer un description du service" required />
                </div>
                <div class="inputBox">
                    <label for="service_image">Ajouter une image :</label>
                    <input type="file" id="service_image" name="image" accept="../images/*" required>
                </div>
                <button class="btn" type="submit" name="register">Enregistrer</button>
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
                //vérifier si des animaux ont été trouvés
                if (!empty($services)) {
                    // Affichage de chaque animal avec échappement des caractères spéciaux et éviter failles CSS
                    foreach ($services as $service) {
                        echo "<div class='box'>";
                        echo "<img src='" . htmlspecialchars($service['service_image_url'], ENT_QUOTES) . "' alt='" . htmlspecialchars($service['service_name'], ENT_QUOTES) . "'>";
                        echo "<h4>" . htmlspecialchars($service['service_name'], ENT_QUOTES) . "</h4>";
                        echo "<p>" . htmlspecialchars($service['service_description'], ENT_QUOTES) . "</p>";
                        echo "<a href='edit_service.php?id=" . urlencode($service['service_id']) . "'>";
                        echo "<button>Modifier</button>";
                        echo "</a>";
                        echo "<a href='delete.php?id=" . urlencode($service['service_id']) . "'>";
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
    </div>
        
</body>
</html>