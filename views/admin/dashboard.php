<?php
    session_start() ;
    if( !isset($_SESSION['admin']) ) {
        header( 'location: ../../index.php' ) ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">

</head>
<body class="bg-gray-100 dark:bg-gray-900">


    <div>
        
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
        </button>

        <!-- SIDEBAR -->
        <?php include '../components/sidebar.php' ?>
        <!-- SIDEBAR -->

        
    </div>


    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>
        // Add an event listener to each <a> element inside <li> elements
        document.querySelectorAll('#sideBar li a').forEach(function(link) {
            link.addEventListener('click', function() {
                // Hide all <i> elements
                document.querySelectorAll('#sideBar li a i.fa-solid.fa-arrow-right').forEach(function(arrow) {
                    arrow.classList.add('hidden');
                });

                // Show the <i> element inside the clicked <li>
                link.querySelector('i.fa-solid.fa-arrow-right').classList.remove('hidden');
            });
        });

        function loadContent(url) { // This function sends an AJAX request to fetch the content from the specified URL and updates the #content-container with the fetched data.
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content-container").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

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
            const themeExepression = document.getElementById("themeExepression") ;
            var themePreference = getCookie("color-theme");
            if (themePreference === "dark" || (!themePreference && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                document.documentElement.classList.add("dark");
                themeExepression.innerHTML ="Light Mode" ;
            } else {
                document.documentElement.classList.remove("dark");
                themeExepression.innerHTML ="Night Mode" ;
            }
        }

        function themeToggle() {
            var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
            var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
            const themeExepression = document.getElementById("themeExepression") ;

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
                    themeExepression.innerHTML ="Night Mode" ;
                } else {
                    document.documentElement.classList.add("dark");
                    setCookie("color-theme", "dark", 365); // Set cookie for 1 year
                    themeExepression.innerHTML ="Light Mode" ;
                }
            });
        }

        theme();
        themeToggle();

    </script>
    
</body>
</html>