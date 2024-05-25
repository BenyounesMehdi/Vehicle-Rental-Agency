<?php
    session_start() ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./dist/style.css"> -->
    <link rel="stylesheet" href="./node_modules/flowbite/dist/flowbite.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <title>Vehicle Rental Agency</title>
    
    <style>
        html {
            scroll-behavior : smooth ;
        }
    </style>

</head>
<body class="bg-white dark:bg-gray-900 ">
    
    <div class="mb-0">
        <!-- NAVBAR -->
        <?php include 'components/navbar.php' ?>
        <!-- NAVBAR -->
    </div>

    
    <div class="flex flex-col justify-center -gap-10">
        <div>
            <?php include 'components/heroSection.php' ?>
        </div>
        <div class="bottom-10">
            <?php include 'components/vehicleSearchSection.php' ?>
        </div>
    </div>

    <div class="">
        <?php include 'components/brandsCarousel.php' ?>
    </div>
        
    
    <div class="mt-10">
        <!-- CAROUSEL -->
        <?php include 'components/vehiclesCarousel.php' ?>
        <!-- CAROUSEL -->
    </div>
    <div>
        <!-- OPINIONS CAROUSEL -->
        <?php include 'components/opinionsCarousel.php' ?>  
        <!-- OPINIONS CAROUSEL -->
    </div>


    <?php
        if( isset($_SESSION['client']) ) {
            // session_start();
            $showModal = isset($_SESSION['showModal']) && $_SESSION['showModal'];
            if ($showModal) {
                unset($_SESSION['showModal']);
            }

            $query = "SELECT c.firstName as firstName, c.lastName as lastName, r.reservationID as ID, r.pickupDate as pickupDate, r.returnDate as returnDate,
                r.duration as duration, r.totalCost as totalCost, b.name as brandName, vt.name as vehicleType, v.name as vehicleName
            FROM client c 
            JOIN reservation r ON c.clientID = r.clientID
            JOIN vehicle v ON r.vehicleID = v.vehicleID
            JOIN brand b ON b.brandID = v.brandID
            JOIN vehiclesType vt ON vt.vehiclesTypeID = v.vehicleTypeID 
            WHERE c.clientID = ?
            ORDER BY r.reservationID DESC
            LIMIT 1";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$_SESSION['client']->clientID]);
            $reservation = $stmt->fetch();
            // var_dump($reservation) ;
        }
        
        
?>
    
    <div>
        <button id="modalToggle" data-modal-target="static-modal" data-modal-toggle="static-modal" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Toggle modal
        </button>
        
        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full overflow-y-auto overflow-x-hidden ">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg drop-shadow-md dark:bg-gray-700" >
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-green-500 dark:text-green-400">
                            The reservation has been added successfully
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">Reservation ID:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->ID; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">First Name:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->firstName; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">Last Name:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->lastName; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">Vehicle:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->brandName . " " . $reservation->vehicleName; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">Pick Up Date:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->pickupDate; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">Return Date:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->returnDate; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">Duration:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->duration . " days"; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-black dark:text-white font-semibold">Total Cost:</p>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400"> <?php echo $reservation->totalCost . " DA"; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php 
        if( isset($_SESSION['client']) ) {
            if ($showModal): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Ensure the modal toggle functionality works with your library
                        const modal = document.getElementById('static-modal');
                        modal.classList.remove('hidden');
                        console.log("Modal should be displayed now");
                    });
                </script>
            <?php endif;
        }
        ?> 
        



    <!-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> -->
    <script src="./JS/carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>

        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length === 2) return parts.pop().split(";").shift();
        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function theme() {
            var themePreference = getCookie("color-theme");
            if (themePreference === "dark" || (!themePreference && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        }

        function themeToggle() {
            var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
            var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

            // Change the icons inside the button based on previous settings
            var themePreference = getCookie("color-theme");
            if (themePreference === "dark" || (!themePreference && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                themeToggleLightIcon.classList.remove("hidden");
            } else {
                themeToggleDarkIcon.classList.remove("hidden");
            }

            var themeToggleBtn = document.getElementById("theme-toggle");

            themeToggleBtn.addEventListener("click", function () {
                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle("hidden");
                themeToggleLightIcon.classList.toggle("hidden");

                // Toggle theme preference
                var themePreference = getCookie("color-theme");
                if (themePreference === "dark") {
                    document.documentElement.classList.remove("dark");
                    setCookie("color-theme", "light", 365); // Set cookie for 1 year
                } else {
                    document.documentElement.classList.add("dark");
                    setCookie("color-theme", "dark", 365); // Set cookie for 1 year
                }
            });
        }

        theme();
        themeToggle();
    </script>
</body>
</html>