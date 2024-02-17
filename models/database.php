<?php
    $host = 'localhost' ;
    $user = 'root' ;
    $password = "" ;
    $dbname = "vehiclerentalagency" ;

    // Set DSN
    $dsn = 'mysql:host='. $host .';dbname='. $dbname ;

    // Create a PDO Instance, and Set The Fetch Mode
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>
