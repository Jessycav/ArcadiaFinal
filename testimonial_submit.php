<?php 
    require_once 'components/connection.php';
    require_once 'components/header.php';
?>

    <div class="main">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Récuperer les données du formulaire
            $name = htmlspecialchars($_POST['visitor_firstname']);
            $date = htmlspecialchars($_POST['visit_date']);
            $message = htmlspecialchars($_POST['message']);

            $sql = "INSERT INTO testimonial (visitor_firstname, visit_date, message) VALUES (:visitor_firstname, :visit_date, :message)";

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute([':visitor_firstname' => $name, ':visit_date' => $date, ':message' => $message]);

                echo "Votre avis a été envoyé et est en attente de validation";
            } catch (PDOException $e) {
                echo "Erreur lors de la soumission de l'avis : ";
                die ();
            }
        }
        ?>
    </div>
