<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';
    
    if (isset($_GET['testimonial_id'])) {
        $testimonial_id = (int)$_GET['testimonial_id'];

        try {
            //Mettre à jour l'avis pour le supprimer
            $stmt = $conn->prepare("DELETE FROM testimonial WHERE testimonial_id = :testimonial_id"); //requête préparée pour éviter les injections SQL
            $stmt->execute([':testimonial_id' => $testimonial_id]);

            echo "Avis supprimé";
        } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'avis";
        die ();
        }
    }
