<?php 
    require_once '../components/connection.php';

    session_start();

    require_once '../components/admin_header.php';;
?>
    <div class="main">
        <h3>Comptes-rendus du vétérinaire</h3>
        <?php
            $select_report = $conn->prepare("SELECT * FROM `veterinary_report`");
            $select_report->execute();
            $num_of_reports = $select_report->rowCount();
        ?>
        <h4><?= $num_of_reports; ?> rapports ajoutés</h4>
        <br>
        <?php
            $sql = "SELECT animal.animal_id, animal.animal_name, animal.health, veterinary_report.food, veterinary_report.food_weight, veterinary_report.report_date
                FROM animal
                LEFT JOIN veterinary_report ON animal.animal_id = veterinary_report.animal_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <section class="report">
            <div class="box-container">
                <?php
                //vérifier si des rapports ont été trouvés
                if (!empty($reports)) {
                    // Affichage de chaque rapport avec échappement des caractères spéciaux et éviter failles CSS
                    foreach ($reports as $report) {
                        // Vérification des données
                        $animal_name = !empty($report['animal_name']) ? htmlspecialchars($report['animal_name'], ENT_QUOTES) : '';
                        $food = !empty($report['food']) ? htmlspecialchars($report['food'], ENT_QUOTES) : '';
                        $food_weight = !empty($report['food_weight']) ? htmlspecialchars($report['food_weight'], ENT_QUOTES) : '';
                        $report_date = !empty($report['report_date']) ? htmlspecialchars($report['report_date'], ENT_QUOTES) : '';
                        // Affichage conditionnel
                        if($animal_name && $food && $food_weight && $report_date) {
                            echo "<div class='box'>";
                            echo "<h4>Prénom :" . $animal_name . "</h4>";
                            echo "<p>Nourriture :" . $food . "</p>";
                            echo "<p>Grammage :" . $food_weight . "</p>";
                            echo "<p>Date de passage : " . $report_date . "</p>";
                            echo "</div>";
                        }
                    }
                } else {
                    echo "<p>Aucun rapport disponible<p>"; 
                }
                ?>
            </div>
        </section> 
        <a href="dashboard_admin.php"><button class="btn">Retour</button></a>
    </div>       
</body>
</html>
                
        
        
        
        
            
        
        
        
        
        
        
        
        
                
        