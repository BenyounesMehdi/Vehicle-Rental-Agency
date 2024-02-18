<?php

    session_start() ;
    if( !isset($_SESSION['admin']) ) {
        header( 'location: ../../index.php' ) ;
    }
    else {
        session_unset() ;
        session_destroy() ;
        header( 'location: ../../index.php' ) ;
    }
        // var_dump($_SESSION['admin']) ;
        
?>