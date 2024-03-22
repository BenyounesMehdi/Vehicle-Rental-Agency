<?php

    if( isset($_POST['reserve']) ) {
        $pickupDate = date('Y-m-d', strtotime($_POST['pickupDate']))  ;
        $returnDate = date('Y-m-d', strtotime($_POST['returnDate'])) ;
        $duration = $_POST['duration'] ;
        $totalCost = $_POST['totalCost'] ;
        $reservationDate = date('Y-m-d');
        $isPayed = 'no';
        $clientID = $_POST['clientID'] ;
        $vehicleID = $_POST['vehicleID'] ;

        echo "pickupDate : ". $pickupDate . "<br>";
        echo "returnDate : ".$returnDate . "<br>";
        echo "duration : ". $duration . "<br>";
        echo "totalCost : ".$totalCost . "<br>";
        echo "reservationDate : ".$reservationDate . "<br>";
        echo "isPayed : ". $isPayed . "<br>";
        echo "clientID : ".$clientID . "<br>";
        echo "vehicleID : ".$vehicleID . "<br>";

        require_once '../../database.php' ;
        
        $query = 'INSERT INTO reservation
        (pickupDate, returnDate, duration, totalCost, reservationDate, isPayed, clientID, vehicleID)
         VALUES (?,?,?,?,?,?,?,?)';
        $stmt = $pdo->prepare($query);
        $inserted = $stmt->execute([$pickupDate, $returnDate, $duration, $totalCost, $reservationDate, $isPayed, $clientID, $vehicleID]);

        if( $inserted ) {
            // Modify the status of the reserved vehicle
            $query = "UPDATE vehicle SET vehicleStatus = 'Not Available' WHERE vehicleID = $vehicleID" ;
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            header( 'location: ../../../index.php' ) ;
        }
        else {
            echo "Fail" ;
        }
    }
    