<?php
    session_start() ;
    if( !isset($_SESSION['client']) ) {
        header('Location: login.php');
    }
    else {
        require '../../models/database.php' ;
        require '../../models/functions.php' ;

        // Set the current client id
        $clientIID = $_GET['id'] ;
        // Set the current vehicle id
        $vehicleID = $_GET['vehicle'] ;

        // echo $clientIID ;
        // echo $vehicleID ;

        // Get the client data
        $query = "SELECT * FROM client
                 WHERE clientID = $clientIID" ;
        $stmt = $pdo->prepare($query) ;
        $stmt->execute() ;
        $client = $stmt->fetch() ;
        // var_dump($client) ;



        // Get the vehicle data
        $vehicle = getData($pdo, 'vehicle') ;
        $query = "SELECT * FROM vehicle
                 WHERE vehicleID = $vehicleID" ;
        $stmt = $pdo->prepare($query) ;
        $stmt->execute() ;
        $vehicle = $stmt->fetch() ;
        // var_dump($vehicle) ;
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">

    <section class="container mx-auto ">
         <p class="text-4xl font-meduim text-black dark:text-white mb-7">Create a New Reservation</p>
         <div class="flex justify-center items-center">
                <img src="../../assets/vehiclesImages/<?php echo $vehicle->image ?>" class="mb-2 w-72">
         </div>

           <!-- TABS -->
            <div class="sm:hidden">
                    <select id="tabs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Client</option>
                        <option>Vehicle</option>
                        <option>Reserve</option>
                    </select>
                </div>
                <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
    <li class="w-full focus-within:z-10">
        <p class="tab-item inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-s-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white" data-target="client">Profile</p>
    </li>
    <li class="w-full focus-within:z-10">
        <p class="tab-item inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-target="vehicle">Vehicle</p>
    </li>
    <li class="w-full focus-within:z-10">
        <p class="tab-item inline-block w-full p-4 bg-white border-s-0 border-gray-200 dark:border-gray-700 rounded-e-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-target="reserve">Reserve</p>
    </li>
</ul>

            <!-- CAROUSEL -->
                <div id="controls-carousel" class="relative w-full bg-red-400 mt-2" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <p>Client</p>
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                            <p>Vehicle</p>
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <p>Reserve</p>
                        </div>
                    </div>

                    <!-- Slider controls -->
                    <!-- <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button> -->

                </div>

    </section>

    <script src="../JS/themeToggle.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>
     document.addEventListener("DOMContentLoaded", function() {
        // Get all tab items
        const tabItems = document.querySelectorAll('.tab-item');

        // Get all carousel items
        const carouselItems = document.querySelectorAll('[data-carousel-item]');

        // Add click event listener to each tab item
        tabItems.forEach(function(tabItem) {
            tabItem.addEventListener('click', function() {
                // Hide all carousel items
                carouselItems.forEach(function(carouselItem) {
                    carouselItem.classList.add('hidden');
                });

                // Get the target carousel item based on the data-target attribute of the clicked tab
                const targetCarouselItemId = this.getAttribute('data-target');
                const targetCarouselItem = document.querySelector(`[data-carousel-item="${targetCarouselItemId}"]`);

                // Show the target carousel item
                targetCarouselItem.classList.remove('hidden');

                // If the target carousel item is active, make it the current slide
                if (targetCarouselItem.getAttribute('data-carousel-item') === 'active') {
                    const carousel = document.querySelector('#controls-carousel');
                    carousel.dataset.carousel = 'active';
                }
            });
        });
    });
</script>
</body>
</html>