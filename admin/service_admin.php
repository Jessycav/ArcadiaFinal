<?php 
    include '../components/connection.php';
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

        // Gestion de la suppression des services
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
        <h4>Ajouter un service</h4>
        <div class="form-container">
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
                    <input type="text" id="image" name="image" placeholder="Sélectionner une image" required />
                </div>
            </form>

            <hr>

            <!-- Liste des services existants -->
            <h4>Liste des services</h4>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Description </th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['service_name']; ?></td>
                    <td><?php echo $row['service_description']; ?></td>
                    <td><img src="<?php echo $row['service_image_url']; ?>" alt="<?php echo $row['service_name']; ?>" width="100"></td>
                    <td>
                        <!-- Formulaire pour modifier un service -->
                        <form method="POST">
                        <input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">
                        <input type="text" name="service_name" value="<?php echo $row['service_name']; ?>" required>
                        <input type="textarea" name="service_description" value="<?php echo $row['service_description']; ?>" required>
                        <input type="text" name="service_image" value="<?php echo $row['service_image_url']; ?>" required>
                        <input type="submit" name="update_service" value="Modifier">
                        </form>
                        <!-- Lien pour supprimer un service -->
                        <a href="?delete=<?php echo $row['service_id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service?')">Supprimer</a> 
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
        
</body>
</html>