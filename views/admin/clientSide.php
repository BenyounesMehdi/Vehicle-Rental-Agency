<?php
    session_start() ;
    require_once '../../models/database.php' ;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">


</head>
<body>
    


        <?php include '../components/sidebar.php' ; ?>

        <?php 
            include '../../models/functions.php' ; 
            $tableName = "client" ;
        ?>
        
        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900 h-screen" id="content-container">
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700">Total Number : <?php echo countRableRows($pdo, $tableName) ?></button>
            <?php include '../clients/clientsList.php' ; ?>
            
        </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../JS/themeToggle.js"></script>
    <script src="../JS/clientsSearch.js"></script>
    <script>
            
        
        function showSearchButtonToggole () {
            const searchInputValue = document.getElementById("default-search").value ;
            const searchButton = document.getElementById("searchButton") ;
            const clientsTable = document.getElementById("clientsTable") ;
            const clientsList = document.getElementById("clientsList") ;
            
            if( searchInputValue.length > 0 ) {
                // searchButton.classList.remove("hidden") ;

                clientsList.classList.remove("hidden") ;
                clientsTable.classList.add("hidden") ;
            }
            else {
                // searchButton.classList.add("hidden") ;

                clientsList.classList.add("hidden") ;
                // brandsTable.classList.remove("hidden") ;
            }
        }

    </script>
</body>
</html>
