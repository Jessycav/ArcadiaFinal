<?php 
    include '../components/connection.php';
    
    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <div class="container">
            <h3>Bienvenue sur votre espace, <?= htmlspecialchars($_SESSION['user_name']) ?> !</h3>
        </div>
        <div class="container">
            <a href="">Modifier les services</a>
            <a href="">Mettre à jour les horaires</a>
        </div>
        <div class="container">
            <a href="">Gestion des habitats</a> 
            <a href="">Gestion des animaux</a>
        </div>
        <div class="container">
            <a href="">Gestion des comptes employés</a>
        </div>


        <button><a href="logout.php">Se déconnecter</a></button>
    </div>
        
</body>
</html>




    








        
