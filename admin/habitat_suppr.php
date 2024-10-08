<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
            if (isset($_GET['habitat_id'])) {
                $habitat_id = (int)$_GET['habitat_id'];
                $conn->beginTransaction();

                try {
                    // supprimer la fiche habitat
                    $stmt = $conn->prepare("DELETE FROM habitat_image WHERE habitat_id = :habitat_id"); //requête préparée pour éviter les injections SQL
                    $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                    $stmt->execute();

                    $stmt = $conn->prepare("DELETE FROM habitat WHERE habitat_id = :habitat_id"); 
                    $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
                    $stmt->execute();

                    $conn->commit();

                    echo "La fiche de l'habitat et ses images ont été supprimées";
                } catch (PDOException $e) {
                    $conn->rollBack();
                    echo "Erreur lors de la suppression de l'habitat: " . $e->getMessage();
                    die ();
                }
            }
        ?>
        <a href="habitat_admin.php"><button class="btn">Retour</button></a>
    </div>