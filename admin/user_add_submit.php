<?php
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>
    <div class="main">
        <?php
            // Création du compte vétérinaire ou employé
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_name = htmlspecialchars($_POST['user_name']);
                $user_password = htmlspecialchars($_POST['user_password']);
                $role_id = htmlspecialchars($_POST['role']);

                // Hachage du mot de passe pour la sécurité
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO user (user_name, user_password, role_id) VALUES (:user_name, :user_password, :role_id)";
                $stmt = $conn->prepare($sql);

                try {
                    $stmt->execute([':user_name' => $user_name, ':user_password' => $hashed_password, ':role_id' => $role_id]);
                    echo "L'utilisateur à été créé avec succès.";
                } catch (PDOException $e) {
                    echo("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
                }
            }
        ?>
        <a href="user_admin.php"><button class="btn">Retour</button></a>
    </div>

</body>
</html>

