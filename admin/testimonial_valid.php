<?php 
    require '../components/connection.php';

    if (isset($_GET['testimonial_id'])) {
        $testimonial_id = (int)$_GET['testimonial_id'];

        try {
            //Mettre à jour l'avis pour l'approuver
            $stmt = $conn->prepare("UPDATE testimonial SET approuve_message = 1 WHERE testimonial_id = :testimonial_id");
            $stmt->execute([':testimonial_id' => $testimonial_id]);

            echo "Avis approuvé";
        } catch (PDOException $e) {
        echo "Erreur lors de l'approbation de l'avis";
        die ();
        }
    }
    
    header("Location: testimonial_admin.php");