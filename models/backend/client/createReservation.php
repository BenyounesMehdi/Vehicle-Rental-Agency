<?php
    // session_start() ;

    if( isset($_POST['reserve']) ) {
        $pickupDate = date('Y-m-d', strtotime($_POST['pickupDate']))  ;
        $returnDate = date('Y-m-d', strtotime($_POST['returnDate'])) ;
        $duration = $_POST['duration'] ;
        $totalCost = $_POST['totalCost'] ;
        $reservationDate = date('Y-m-d');
        $isPayed = 'No';
        $isExpired = 'No';
        $clientID = $_POST['clientID'] ;
        $vehicleID = $_POST['vehicleID'] ;
        $adminID = 1 ;

        require_once '../../database.php' ;
        
        $query = 'INSERT INTO reservation
        (pickupDate, returnDate, duration, totalCost, reservationDate, isPayed, isExpired, clientID, vehicleID, adminID)
         VALUES (?,?,?,?,?,?,?,?,?,?)';
        $stmt = $pdo->prepare($query);
        $inserted = $stmt->execute([$pickupDate, $returnDate, $duration, $totalCost, $reservationDate, $isPayed, $isExpired, $clientID, $vehicleID, $adminID]);

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
    