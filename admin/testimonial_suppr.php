<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
            if (isset($_GET['testimonial_id'])) {
                $testimonial_id = (int)$_GET['testimonial_id'];

                try {
                    //Mettre à jour l'avis pour le supprimer
                    $stmt = $conn->prepare("DELETE FROM testimonial WHERE testimonial_id = :testimonial_id"); //requête préparée pour éviter les injections SQL
                    $stmt->execute([':testimonial_id' => $testimonial_id]);

                    echo "L'avis a été supprimé";
                } catch (PDOException $e) {
                echo "Erreur lors de la suppression de l'avis: " . $e->getMessage();
                die ();
                }
            }
        ?>
        <a href="testimonial_admin.php"><button class="btn">Retour</button></a>
    </div>
