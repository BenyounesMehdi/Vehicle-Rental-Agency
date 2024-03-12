<?php

    include_once '../../models/database.php' ;
    $id = $_GET['id'] ;

    $query = "SELECT * FROM vehicle
        WHERE vehicleID = $id" ;
    $stmt = $pdo->prepare($query) ;
    $stmt->execute() ;
    $vehicle = $stmt->fetch() ;
    var_dump($vehicle) ;

    // ar_dump($_GET);
?>
