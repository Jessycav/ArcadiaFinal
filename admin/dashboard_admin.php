<?php 
    require_once '../components/connection.php';
    
    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <div class="container">
            <h3>Bienvenue sur votre espace, <?= htmlspecialchars($_SESSION['user_name']); ?> !</h3>
        </div>
        <section class="dashboard">
            <div class="box-container">
                <div class="box">
                    <a href="service_admin.php">Modifier les services</a>
                </div>
                <div class="box">
                    <a href="schedule_admin.php">Mettre à jour les horaires</a>
                </div>
                <div class="box">
                    <a href="habitat_admin.php">Gestion des habitats</a>
                </div>
                <div class="box">    
                    <a href="animal_admin.php">Gestion des animaux</a>
                </div>
                <div class="box">
                    <a href="animal_report_admin.php">Visualiser les comptes-rendus vétérinaires</a>
                </div>
                <div class="box">
                    <a href="user_admin.php">Gestion des comptes employés</a>
                </div>
                <div class="box">
                    <a href="testimonial_admin.php">Gestion des avis visiteurs</a>
                </div>
                <div class="box">
                    <a href="../stat_view_admin.php">Statistiques de consultation des animaux</a>
                </div>
            </div>
        </section>
        

        <button class="btn"><a href="logout.php">Se déconnecter</a></button>
    </div>
        
</body>
</html>




    








        
