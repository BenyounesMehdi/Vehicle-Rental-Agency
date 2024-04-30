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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
        

        <?php include '../components/sidebar.php' ; ?>
        
        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900 " id="content-container">
            <p class=" text-3xl mb-2 font-semibold text-gray-900 dark:text-white">Overview</p>
           <?php include '../components/dashboardCardsSection.php' ?>
        </div>

            
        <div class="flex flex-col lg:flex-row bg-gray-300 dark:bg-gray-900 p-4 sm:ml-64 justify-center items-center gap-2 ">
            <div id="rating" class="w-full lg:w-1/2 ">
                <?php include '../components/rating.php'; ?>
            </div>

            <div id="vehiclesStatus" class="w-full lg:w-1/2 ">
                <?php include '../components/vehicleStatusStats.php'; ?>
            </div>
        </div>

        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900">
             <?php include '../components/clientsStats.php'; ?>
        </div>

        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900">
             <?php include '../components/reservationsReport.php'; ?>
        </div>

        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900">
            
            <?php include '../components/todayReservations.php'; ?>
        </div>

        <!-- CHARTS -->
        <div id="chartsContainer" class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900 flex flex-col h-screen">

            <div class="w-full">
                <?php include '../components/charts/vehiclesCountByBrandChart.php' ?>
            </div>
                    
        </div>

        

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
