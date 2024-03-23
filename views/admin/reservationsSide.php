<?php
    session_start() ;
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
            $tableName = "reservation" ;
        ?>
        
        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900 h-screen" id="content-container">
            <div class="flex justify-between items-center mb-2 mr-3">
                <div class="w-fit p-2  text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
                    <div class="w-fit flex items-center justify-between">
                        <h3 class="font-medium">Total Number : <?php echo countRableRows($pdo, $tableName) ?></h3>
                    </div>
                </div> 
            </div>          
            <?php include '../reservations/reservationsList.php' ; ?>
            
        </div>

    
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../JS/themeToggle.js"></script>
    <script src="../JS/arrowToggle.js"></script>
    <script>
        
        function showSearchButtonToggole () {
            const searchInputValue = document.getElementById("default-search").value ;
            const searchButton = document.getElementById("searchButton") ;
            if( searchInputValue.length > 0 ) {
                searchButton.classList.remove("hidden") ;
            }
            else {
                searchButton.classList.add("hidden") ;
            }
        }

    </script>
</body>
</html>
