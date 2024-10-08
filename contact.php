<?php 
    require_once 'components/connection.php';
?>

<?php 
    require_once 'components/header.php';
?>
    <div class="main">
        <div class="banner">
            <h4>Nous contacter</h4>
        </div>
        <h3>Formulaire de contact</h3>
        <!-- Espace de contact -->
        <div class="form-container">
            <form action="" method="POST"> 
                <div class="inputBox">
                    <input type="email" placeholder="Entrez votre email" required>
                    <input type="text" placeholder="Saisissez un titre" required>
                </div>
                <textarea name="" placeholder="Ecrivez votre message..." cols="10" rows="6" required></textarea>
                <button class="btn" type="submit">ENVOYER</button>
            </form>
        </div> 
   
        <!-- Footer -->
        <?php require_once 'components/footer.php';?>
    </div>
    
</body>
</html>