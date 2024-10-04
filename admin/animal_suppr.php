<?php 
    include '../components/connection.php';

    session_start();

    include '../components/admin_header.php';
?>

    <div class="main">
        <?php
            if (isset($_GET['animal_id'])) {
                $animal_id = (int)$_GET['animal_id'];
                $conn->beginTransaction();

                try {
                    // supprimer la fiche animal
                    $stmt = $conn->prepare("DELETE FROM animal_image WHERE animal_id = :animal_id"); //requête préparée pour éviter les injections SQL
                    $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
                    $stmt->execute();

                    $stmt = $conn->prepare("DELETE FROM animal WHERE animal_id = :animal_id"); 
                    $stmt->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
                    $stmt->execute();

                    $conn->commit();

                    echo "La fiche de l'animal et ses images ont été supprimés";
                } catch (PDOException $e) {
                    $conn->rollBack();
                    echo "Erreur lors de la suppression de l'animal";
                die ();
                }
            }
        ?>
    </div>