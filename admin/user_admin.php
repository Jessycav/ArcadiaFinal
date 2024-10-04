<?php 
    include '../components/connection.php';
    
    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <h3>Gestion des employés</h3>
        <br>
        <a href="create_user_form.php"><button class="btn">Ajouter un utilisateur</button></a>
        <br>
        <?php
            $select_user = $conn->prepare("SELECT * FROM `user`");
            $select_user->execute();
            $num_of_users = $select_user->rowCount();
        ?>
        <h4><?= $num_of_users; ?> utilisateurs</h4>

        <a href=""><button class="btn">Voir les profils employés</button></a>

        

    </div>
        
</body>
</html>
        