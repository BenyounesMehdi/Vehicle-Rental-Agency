<?php
 if( isset($_POST['register']) ) {
    $clientFirstName = $_POST['clientFirstName'] ;
    $clientLastName = $_POST['clientLastName'] ;
    $clientPhoneNumber = $_POST['clientPhoneNumber'] ;
    $clientEmail = $_POST['clientEmail'] ;
    $clientPassword = $_POST['clientPassword'] ;

    // Check if the inputs are empty
    if( empty($clientFirstName) || empty($clientLastName) || empty($clientPhoneNumber) || empty($clientEmail) || empty($clientPassword) ) {
        $title= "Please, Fill All The Inputs" ;
        include_once("../../views/components/errorField.php");
    }
    else { // Means all the inputs are filled
        // Check if the email is valid
        if( !filter_var($clientEmail, FILTER_VALIDATE_EMAIL) ) {
            $title= "This Email Is Not A Valid Email" ;
            include_once("../../views/components/errorField.php");
        }
        else {
            // Check if the email is already in the database or not
            require_once '../../models/database.php' ;
        
            // Check if the Client exits in the database    
            $query = 'SELECT * FROM client WHERE email=?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$clientEmail]);

            if( $stmt->rowCount() >= 1 ) {
                $title= "This Email Is Already Exit" ;
                 include_once("../../views/components/errorField.php");
            }
            else { // Means this client is new
                // Time to insert all user infos in our database
                $query = 'INSERT INTO client (firstName, lastName, phoneNumber, email, pass) VALUES (?, ?, ?, ?, ?)' ;
                $stmt = $pdo->prepare($query) ;
                $result = $stmt->execute([$clientFirstName, $clientLastName, $clientPhoneNumber, $clientEmail, $clientPassword]) ;
                
                if ($result) {
                    // Create a Session for the Client
                    $query = 'SELECT * FROM client WHERE email=?';
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$clientEmail]);
       
                    if( $stmt->rowCount() >= 1 ) {
                        // Create a Session for the Client
                        session_start() ;
                        $_SESSION['client'] = $stmt->fetch() ;

                        // Redirect The Admin
                        header( 'location: ../../index.php' ) ;
                    } 
                }
                else {
                    $title= "Error Occurred" ;
                    include_once("../../views/components/errorField.php");
                }
        }
    }
}
}                        
?>