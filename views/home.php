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