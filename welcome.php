<?php 
    include 'components/connection.php';

    session_start();

    include 'components/header.php';
?>
    <div class="main">
        <div class="container">
            <h3>Bienvenue sur votre espace, <?= htmlspecialchars($_SESSION['user_name']) ?> !</h3>
        </div>





        
        <p><a href="logout.php">Se déconnecter</a></p>

        <?php include 'components/footer.php'?>
    </div>

</body>
</html>