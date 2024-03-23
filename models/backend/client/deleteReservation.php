<?php

    // var_dump($_GET) ;
    include_once '../../database.php' ;
    $reservationID = $_GET['id'] ;
    $vehicleID = $_GET['vehicle'] ;

    // echo "reservation : ".$reservationID . "<br>" ;
    // echo "vehicle : ".$vehicleID . "<br>" ;
    
    $query = 'DELETE FROM reservation WHERE reservationID =?' ;
    $stmt = $pdo->prepare($query) ;
    $deleted =  $stmt->execute([$reservationID]) ;

    // Modify the status of the reserved vehicle
    $query = "UPDATE vehicle SET vehicleStatus = 'Available' WHERE vehicleID = ?";
    $stmt = $pdo->prepare($query);
    $updated = $stmt->execute([$vehicleID]);

    if( $deleted && $updated ) {
        //Redirect the user to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit; // Ensure that no further code is executed after the redirection
    }
    else {
        echo "Error" ;
    }