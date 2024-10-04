<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <?php
            if (isset($_GET['service_id'])) {
                $service_id = (int)$_GET['service_id'];

                try {
                    //Mettre à jour le service pour le supprimer
                    $stmt = $conn->prepare("DELETE FROM service WHERE service_id = :service_id"); //requête préparée pour éviter les injections SQL
                    $stmt->bindParam(':service_id', $service_id, PDO::PARAM_INT);
                    $stmt->execute();

                    echo "Le service a été supprimé";
                } catch (PDOException $e) {
                    echo "Erreur lors de la suppression du service";
                    die ();
                }
            }
        ?>
    </div>