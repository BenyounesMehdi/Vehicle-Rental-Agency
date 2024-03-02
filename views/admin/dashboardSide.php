<?php
    session_start() ;
    include_once '../../models/database.php' ;
    include_once '../../models/functions.php'
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
        
        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900 h-screen" id="content-container">
            <p class="mb-3 text-2xl font-semibold text-gray-900 dark:text-white">Dashboard</p>

           <?php include '../components/dashboardCardsSection.php' ?>

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
