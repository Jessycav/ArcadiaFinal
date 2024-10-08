<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <?php
            // Gestion de la modification des users
            $user_id = $_GET['user_id'];
            // Requête pour récupérer les informations actuelles
            $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                echo "Ce profil utilisateur est introuvable.";
                exit;
            }

            $stmt_roles = $conn->prepare("SELECT * FROM role");
            $stmt_roles->execute();
            $roles = $stmt_roles->fetchAll(PDO::FETCH_ASSOC);

            // Si le formulaire est soumis par traitement POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = $_POST['user_id'];
                $user_name = htmlspecialchars($_POST['user_name']);
                $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
                $role_id = $_POST['role_id'];
                
                try {                
                    $stmt = $conn->prepare("UPDATE user SET user_name = :user_name, user_password = :user_password, role_id = :role_id WHERE user_id = :user_id");
                    $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
                    $stmt->bindParam(':user_password', $user_password, PDO::PARAM_STR);
                    $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();

                    echo "Le profil utilisateur a été modifié.";
                } catch (PDOException $e) {
                    echo "Erreur lors la modification du profil: " . $e->getMessage();
                }
            } 
        ?>

        <div class="form-container">
            <h4>Modifier cet utilisateur</h4>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>"> 
                <div class="inputBox">
                    <label for="user_name">Nom de l'utilisateur :</label>
                    <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required/>
                </div>
                <div class="inputBox">
                    <label for="user_password">Mot de passe :</label>
                    <input type="password" id="user_password" name="user_password" value="<?php echo htmlspecialchars($user['user_password']); ?>" required/>
                </div>
                <div class="inputBox">
                    <label for="role_id">Profil de l'utilisateur :</label>
                    <select id="role_id" name="role_id" required>
                        <?php
                            foreach ($roles as $role) {
                                echo "<option value='" . $role['role_id'] . "'>" . $role['role_label'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <br>
                <button class="btn" type="submit">Enregistrer les modifications</button>
            </form>
        </div>
        <a href="user_admin.php"><button class="btn">Retour</button></a>
    </div>
