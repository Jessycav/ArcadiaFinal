<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <h3>Modifier les horaires du zoo</h3>
        <div class="form-container">
            <form id="horairesForm">
                <table>
                    <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Ouverture</th>
                            <th>Fermeture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lundi</td>
                            <td><input type="time" id="ouverture_Lundi" value="09:00" required></td>
                            <td><input type="time" id="fermeture_Lundi" value="18:00" required></td>
                        </tr>
                        <tr>
                            <td>Mardi</td>
                            <td><input type="time" id="ouverture_Mardi" value="09:00" required></td>
                            <td><input type="time" id="fermeture_Mardi" value="18:00" required></td>
                        </tr>
                        <tr>
                            <td>Mercredi</td>
                            <td><input type="time" id="ouverture_Mercredi" value="09:00" required></td>
                            <td><input type="time" id="fermeture_Mercredi" value="18:00" required></td>
                        </tr>
                        <tr>
                            <td>Jeudi</td>
                            <td><input type="time" id="ouverture_Jeudi" value="09:00" required></td>
                            <td><input type="time" id="fermeture_Jeudi" value="18:00" required></td>
                        </tr>
                        <tr>
                            <td>Vendredi</td>
                            <td><input type="time" id="ouverture_Vendredi" value="09:00" required></td>
                            <td><input type="time" id="fermeture_Vendredi" value="18:00" required></td>
                        </tr>
                        <tr>
                            <td>Samedi</td>
                            <td><input type="time" id="ouverture_Samedi" value="09:00" required></td>
                            <td><input type="time" id="fermeture_Samedi" value="19:00" required></td>
                        </tr>
                        <tr>
                            <td>Dimanche</td>
                            <td><input type="time" id="ouverture_Dimanche" value="10:00" required></td>
                            <td><input type="time" id="fermeture_Dimanche" value="18:00" required></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn" type="submit" onclick="enregistrerHoraires()">Enregistrer</button>
            </form>
            <div id="message"></div>
        </div>
        <a href="dashboard_admin.php"><button class="btn">Retour</button></a>
    </div>
</body>
</html>