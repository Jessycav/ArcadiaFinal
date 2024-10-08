<?php
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <div class="container">
            <h3>Créer un nouvel utilisateur</h3>
        </div>
        <div class="form-container">
            <form action="user_add_submit.php" method="POST">
                <div class="inputBox">
                    <label for="role">Profil :</label>
                    <select id="role" name="role" required>
                        <?php
                        // Récupérer les roles
                        $sql = "SELECT role_id, role_label FROM role WHERE role_label IN ('Vétérinaire', 'Employé')"; //IN pour filtrer les lignes
                        $stmt = $conn->query($sql);
                        $roles = $stmt->fetchAll();

                        foreach ($roles as $role) {
                            echo "<option value='" . $role['role_id'] . "'>" . $role['role_label'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="inputBox">
                    <label for="user_name">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="user_name" placeholder="Entrer le nom d'utilisateur" required />
                </div>
                <div class="inputBox">
                    <label for="user_password">Mot de passe :</label>
                    <input type="password" id="password" name="user_password" placeholder="Entrer votre mot de passe" required />
                </div>
                <div class="inputBox">
                    <label for="user_password">Confirmation du mot de passe :</label>
                    <input type="password" id="password" name="confirm_user_password" placeholder="Confirmer votre mot de passe" required />
                </div>
                <button class="btn" type="submit" name="register">Enregistrer</button>
            </form>
        </div>
        <a href="user_admin.php"><button class="btn">Retour</button></a>
    </div>
        
</body>
</html>
