<?php

    // var_dump($_GET) ;
    include_once '../../database.php' ;
    $opinionID = $_GET['id'] ;

    // echo "opinionID : " . $opinionID;
    
    $query = 'DELETE FROM opinion WHERE opinionID =?' ;
    $stmt = $pdo->prepare($query) ;
    $deleted =  $stmt->execute([$opinionID]) ;


    if( $deleted ) {
        //Redirect the user to the previous page
        echo '<script>window.history.go(-2);</script>';
        exit; // Ensure that no further code is executed after the redirection
    }
    else {
        echo "Error" ;
    }