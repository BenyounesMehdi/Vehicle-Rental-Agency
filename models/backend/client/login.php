<?php
  if( isset($_POST['signIn']) ) {
    $clientEmail = $_POST['clientEmail'] ;
    $clientPassword = $_POST['clientPassword'] ;

    if( !empty($clientEmail) && !empty($clientPassword) ) {
       require_once '../../models/database.php' ;
       
        // Check if the Client exits in the database    
       $query = 'SELECT * FROM client WHERE email=? AND pass=?';
       $stmt = $pdo->prepare($query);
       $stmt->execute([$clientEmail, $clientPassword]);
       
       if( $stmt->rowCount() >= 1 ) {
            // Create a Session for the Client
            session_start() ;
            $_SESSION['client'] = $stmt->fetch() ;

            // Redirect The Admin
             header( 'location: ../../index.php' ) ;
       }
       else { 
        $title = "Email Or Password Is Incorrect" ; 
        include_once("../../views/components/errorField.php");
       }
    }
     else { 
        $title= "Please, Fill All The Inputs" ;
        include_once("../../views/components/errorField.php");
    }
}                          
?>