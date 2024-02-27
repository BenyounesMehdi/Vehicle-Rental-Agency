<?php
  if( isset($_POST['signIn']) ) {
    $adminEmail = $_POST['adminEmail'] ;
    $adminPassword = $_POST['adminPassword'] ;

    if( !empty($adminEmail) && !empty($adminPassword) ) {
       require_once '../../models/database.php' ;
       
        // Check if the Admin exits in the database    
       $query = 'SELECT * FROM admin WHERE email=? AND password=?';
       $stmt = $pdo->prepare($query);
       $stmt->execute([$adminEmail, $adminPassword]);

        if( $stmt->rowCount() >= 1 ) {
                // Create a Session for the Admin
                session_start() ;
                $_SESSION['admin'] = $stmt->fetch() ;

                // Redirect The Admin
                header( 'location: dashboardSide.php' ) ;
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