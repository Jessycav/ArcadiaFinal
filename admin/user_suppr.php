<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
            if (isset($_GET['user_id'])) {
                $user_id = (int)$_GET['user_id'];
                $conn->beginTransaction();

                try {
                    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = :user_id"); 
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    $conn->commit();

                    echo "Le profil a été supprimé";
                } catch (PDOException $e) {
                    echo "Erreur lors de la suppression du profil: " . $e->getMessage();
                    die ();
                }
            }
        ?>
        <a href="user_admin.php"><button class="btn">Retour</button></a>
    </div>