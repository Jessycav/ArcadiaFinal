<?php 
    require_once '../components/connection.php';
    
    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <h3>Gestion des employés</h3>
        <br>
        <a href="user_add_form.php"><button class="btn">Ajouter un utilisateur</button></a>
        <br>
        <?php
            $select_user = $conn->prepare("SELECT * FROM `user`");
            $select_user->execute();
            $num_of_users = $select_user->rowCount();
        ?>
        <h4><?= $num_of_users; ?> utilisateurs</h4>

        <?php
            $sql = "SELECT user.user_id, user.user_name, role.role_label 
                    FROM user 
                    JOIN role ON user.role_id = role.role_id
                    WHERE role_label IN ('Vétérinaire', 'Employé')
                    ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        ?>
        <section class="user">
            <div class="box-container">
                <?php
                //vérifier si des animaux ont été trouvés
                if (!empty($users)) {
                    // Affichage de chaque animal avec échappement des caractères spéciaux et éviter failles CSS
                    foreach ($users as $user) {
                        echo "<div class='box'>";
                        echo "<h4>" . htmlspecialchars($user['user_name'], ENT_QUOTES) . "</h4>";
                        echo "<p>" . htmlspecialchars($user['role_label'], ENT_QUOTES) . "<p>";
                        echo "<a href='user_edit.php?user_id=" . urlencode($user['user_id']) . "'>";
                        echo "<button>Modifier</button>";
                        echo "</a>";
                        echo "<a href='user_suppr.php?user_id=" . urlencode($user['user_id']) . "'>";
                        echo "<button>Supprimer</button>";
                        echo "</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Aucun utilisateur trouvé<p>"; 
                }
                ?>
            </div>
            <a href="dashboard_admin.php"><button class="btn">Retour</button></a>
        </section>
    </div>
</body>
</html>
        