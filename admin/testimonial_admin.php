<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <h3>Gérer les avis</h3>
        <section id="testimonial">
            <h4>Avis en attente de validation</h4>
            <div class="box-container">
                <?php
                    //Vérifier si l'utilisateur est déjà connecté
                    if (isset($_SESSION['user_name'])) {
                        try {
                            //Récupérer les avis non approuvés
                            $stmt = $conn->query("SELECT * FROM testimonial WHERE approuve_message = 0");
                            $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if ($testimonials) {
                                foreach($testimonials as $row) {
                                    echo "<div class='box'>";
                                    echo "<p>Prénom : " . htmlspecialchars($row["visitor_firstname"]) . "</p>";
                                    echo "<p>Visite du : " . htmlspecialchars($row["visit_date"]) . "</p>";
                                    echo "<p>Message : " . htmlspecialchars($row["message"]) . "</p>";
                                    echo "<a href='/admin/testimonial_valid.php?testimonial_id=". $row['testimonial_id']."'>";
                                    echo "<button>Approuver</button>";
                                    echo "</a>";
                                    echo "<a href='/admin/testimonial_suppr.php?testimonial_id=". $row['testimonial_id']."'>";
                                    echo "<button>Supprimer</button>";
                                    echo "</a>";
                                    echo "</div>";
                                }
                            } else {
                                echo "Aucun avis en attente de validation";
                            }
                        } catch (PDOException $e) {
                            echo "Erreur lors de la récupération des avis: " . $e->getMessage();
                            die ();
                        }
                    }
                ?>
            </div>
        </section>
        <a href="dashboard_admin.php"><button class="btn">Retour</button></a>
    </div>

</body>
</html>

