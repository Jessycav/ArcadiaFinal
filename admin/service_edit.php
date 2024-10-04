<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <?php
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
        ?>
    </div>
