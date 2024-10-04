<?php 
    include '../components/connection.php';
    
    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <h3>Gestion des animaux du zoo</h3>
        <br>
        <a href="add_animal.php"><button class="btn">Ajouter un animal</button></a>
        <br>
        <?php
            $select_animal = $conn->prepare("SELECT * FROM `animal`");
            $select_animal->execute();
            $num_of_animals = $select_animal->rowCount();
        ?>
        <h4><?= $num_of_animals; ?> animaux ajoutés</h4>
        

    </div>
        
</body>
</html>
        