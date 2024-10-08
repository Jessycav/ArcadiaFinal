<?php 
    require_once 'components/connection.php';

    header('Content-Type: application/json');

    // Requête pour récupérer les avis
    $query = $conn->prepare("SELECT visitor_firstname, visit_date, message FROM testimonial WHERE approuve_message = 1");
    $query->execute();
    $testimonials = $query->fetchAll(PDO::FETCH_ASSOC);

    // Renvoie les avis sous forme de JSON
    
    echo json_encode($testimonials);

?>