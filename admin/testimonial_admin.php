<?php 
    require '../components/connection.php';

    try {
        //Récupérer les avis non approuvés
        $stmt = $conn->query("SELECT * FROM testimonial WHERE approuve_message = 0");
        $testionials = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($testionials) {
            echo "<h4>Gérer les avis</h4>";
            foreach($testionials as $row) {
                echo "<div>";
                echo"<p>Prénom " . htmlspecialchars($row["visitor_firstname"]) . "</p>";
                echo"<p>Visite du : " . htmlspecialchars($row["visit_date"]) . "</p>";
                echo"<p>Message " . htmlspecialchars($row["message"]) . "</p>";
                echo "<a href='/admin/testimonial_valid.php?testimonial_id=". $row['testimonial_id']."'>Appouver</a> | ";
                echo "<a href='/admin/testimonial_suppr.php?testimonial_id=". $row['testimonial_id']."'>Supprimer</a> | ";
                echo "<div>";
            }
        } else {
            echo "Aucun avis en attente de validation";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des avis : ";
        die ();
    }
