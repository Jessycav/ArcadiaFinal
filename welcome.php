<?php 
    include 'components/connection.php';

    session_start();

   

    include 'components/header.php';
?>
    <div class="main">
        <div class="container">
        <h3>Bienvenue sur votre espace, <?= htmlspecialchars($_SESSION['user_name']) ?> !</h3>
        <p><a href="logout.php">Se déconnecter</a></p>
        </div>
    </div>

       
<?php
    include 'components/footer.php'
?>

</body>
</html>