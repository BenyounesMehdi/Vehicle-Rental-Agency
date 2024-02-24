<?php 
    // var_dump($_GET) ;
    include_once '../../database.php' ;
    $brandID = $_GET['id'] ;
    
    $query = 'DELETE FROM brand WHERE brandID =?' ;
    $stmt = $pdo->prepare($query) ;
    $deleted =  $stmt->execute([$brandID]) ;

    if( $deleted ) {
        // Redirect the user to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit; // Ensure that no further code is executed after the redirection
    }
    else {
        echo "Error" ;
    }
?>