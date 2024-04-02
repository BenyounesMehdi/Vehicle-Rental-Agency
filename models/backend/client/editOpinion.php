<?php
    echo "<pre>" ;
    print_r($_POST) ;
    echo "</pre>" ;
    
    if( isset($_POST['editOpinion']) ) {
        $opinionID = $_POST['opinionID'] ;
        $opinionContent = $_POST['opinionContent'] ;
        $rating = $_POST['rating'] ;
        require_once '../../database.php' ;
        
        $query = "UPDATE opinion 
          SET content = ?, rating = ?
          WHERE opinionID = ?";
          $stmt = $pdo->prepare($query);
          $updated = $stmt->execute([$opinionContent, $rating, $opinionID]);

        if( $updated ) {
            //Redirect the user to the previous page
            // echo '<script>window.history.go(-2);</script>';
            header("Location: ../../../index.php");
        
        }
        else {
            echo "Fail" ;
        }
    }