<?php
    $db_name = 'mysql:host=localhost;dbname=arcadia_final;charset=utf8';
    $db_user = 'root';
    $db_password = '';

    try {
        $conn = new PDO($db_name, $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Facilite le débogage
    } catch (PDOException $e) {
        echo "Une erreur est survenue lors de la connexion : " . $e->getMessage() . "</br>";
        die ();  
    }

?>   


