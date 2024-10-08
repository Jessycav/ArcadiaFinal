<?php 
    require_once 'components/connection.php';

    require_once 'components/header.php';
?>
    <div class="main">
        <h3>Écrire un avis</h3>
        <div class="form-container">
            <form action="testimonial_submit.php" method="POST">
                <div class="inputBox">
                    <label for="visitor_firstname">Prénom :</label>
                    <input type="text" id="visitor_firstname" name="visitor_firstname" placeholder="Entrer votre prénom" required />
                </div>
                <div class="inputBox">
                    <label for="visit_date">Visite du :</label>
                    <input type="date" id="visit_date" name="visit_date" placeholder="Entrer votre mot de passe" required />
                </div>
                <div class="inputBox">
                    <label for="message">Votre avis :</label>
                    <textarea type="message" id="message" name="message" rows="5" placeholder="Écriver votre avis" required></textarea>
                </div>        
                <button class="btn" type="submit">ENVOYER</button>
            </form>
        </div>
    </div>
