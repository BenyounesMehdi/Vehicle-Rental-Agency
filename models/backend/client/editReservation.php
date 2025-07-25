<?php
    echo "<pre>" ;
    print_r($_POST) ;
    echo "</pre>" ;

    if( isset($_POST['editReservation']) ) {
        $reservationID = $_POST['reservationID'] ;
        $pickupDate = date('Y-m-d', strtotime($_POST['pickupDate']))  ;
        $returnDate = date('Y-m-d', strtotime($_POST['returnDate'])) ;
        $duration = $_POST['duration'] ;
        $totalCost = $_POST['totalCost'] ;
        $reservationDate = date('Y-m-d');
        $isPayed = 'no';

        require_once '../../database.php' ;
        
        $query = "UPDATE reservation 
          SET pickupDate = ?, returnDate = ?, duration = ?, totalCost = ?
          WHERE reservationID = ?";
          $stmt = $pdo->prepare($query);
          $updated = $stmt->execute([$pickupDate, $returnDate, $duration, $totalCost, $reservationID]);

        if( $updated ) {
            echo "Done" ;
            header( 'location: ../../../views/client/myReservations.php' ) ;
        }
        else {
            echo "Fail" ;
        }
    }