<?php 
    require_once '../components/connection.php';
    
    session_start();

    require_once '../components/admin_header.php';
?>

    <div class="main">
        <h3>Statistiques de consultation des animaux</h3>
        <?php
            // Appel à l'API pour récupérer les statistiques
            $api_url = 'http://localhost:2000/animals/stats';
            $response = file_get_contents($api_url); //Récupérer le réponse JSON

            if ($response !== false) {
                $stats = json_decode($response, true);

                if(!empty($stats)) {
                    foreach ($stats as $stat) {
                        echo "<p>Animal ID : " . $stat['animal_id'] . "- Nombre total de consultations : " . $stat['count'] . "<p>";
                    }
                } else {
                    echo "<p>Aucune statistique disponible.</p>";
                }
            } else {
                echo "<p>Impossible de récupérer les statistiques des animaux</p>";
            }
        ?>
    </div>