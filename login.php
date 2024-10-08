<?php 
    require_once 'components/connection.php';

    session_start();

    require_once 'components/header.php';

    //Vérifier si l'utilisateur est déjà connecté
    if (isset($_SESSION['user_name'])) {
        header('Location: /admin/dashboard_admin.php');
        exit();
    }

    // Initialiser les messages d'erreurs
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_name = trim($_POST['user_name'] ?? ''); //trim pour suprimer les espaces début et fin des entrées
        $user_password = trim($_POST['user_password'] ?? '');

        //Préparer une requête pour vérifier si les noms d'utilisateurs sont corrects
        $stmt = $conn->prepare('SELECT * FROM user WHERE user_name = :user_name');
        $stmt->execute(['user_name' => $user_name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //Préparer une requête pour vérifier si le mot de passe est correct (mot de passe haché)
        if ($user && password_verify($user_password, $user['user_password'])) {
            // Enregistrer le nom d'utilisateur dans la session
            $_SESSION['user_name'] = $user['user_name'];
            header('Location: /admin/dashboard_admin.php');
            exit();
        } else {
            $error = 'Nom d\'utilisateur ou mot de passe incorrect';
        }
    }
?>
    <div class="main">
        <div class="banner">
            <h4>Se connecter</h4>
        </div>
        <h3>Connexion à l'espace professionnel</h3>
        <div class="form-container">
            <?php if ($error): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif;?>
            <form action="" method="POST">
                <div class="inputBox">
                    <label for="user_name">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="user_name" placeholder="Entrer votre nom d'utilisateur" required />
                </div>
                <div class="inputBox">
                    <label for="user_password">Mot de passe :</label>
                    <input type="password" id="password" name="user_password" placeholder="Entrer votre mot de passe" required />
                </div>
                <p>En cas d'oubli de vos identifiants, veuillez contacter l'administrateur.</p>
                <button class="btn" type="submit">SE CONNECTER</button>
            </form>
        </div> 
   
        <!-- Footer -->
        <?php require_once 'components/footer.php';?>
    </div>
    
</body>
</html>