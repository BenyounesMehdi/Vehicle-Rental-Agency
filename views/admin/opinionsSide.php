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
            $tableName = "opinion" ;

            // Calculate the stars average
            $stmt = $pdo->prepare("SELECT AVG(rating) AS starsAverage FROM opinion");
            $stmt->execute();
            $averageStars = $stmt->fetch();
            $averageStars = number_format($averageStars->starsAverage, 1);
            
            // echo "Average stars: $averageStars";
        ?>
        
        <div class="sm:ml-64 bg-gray-300 dark:bg-gray-900 h-screen" id="content-container">
            <div class="flex justify-between items-center mr-3 p-4">
                <div class="w-fit p-2  text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
                    <div class="w-fit flex items-center justify-between">
                        <h3 class="font-medium">Total Number : <?php echo countRableRows($pdo, $tableName) ?></h3>
                    </div>
                </div> 
                <div class="flex justify-center items-center">
                    <p class="text-4xl dark:text-white font-semibold"><?php echo $averageStars; ?><p>
                    <div class="text-yellow-300 text-5xl">★</div>
                </div>
            </div>          
            <?php include '../opinion/opinionsList.php' ; ?>
            
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
