<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
    
    <script>
        function theme() {
         // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (
                localStorage.getItem("color-theme") === "dark" ||
                (!("color-theme" in localStorage) &&
                    window.matchMedia("(prefers-color-scheme: dark)").matches)
            ) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        }   
        theme() ;
    </script>
    <style>
        /* For screens smaller than 640px (e.g., mobile screens) */
        #mainContent {
            width: 57%;
        }
        /* For mobile screens and above */
        @media (max-width: 1024px) {
            #mainContent {
                width: 100%;
            }
        }
    </style>

</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div class="container mx-auto h-screen flex items-center ">
        <section class=" dark:bg-gray-900 w-full rounded flex flex-col px-4 sm:px-16 justify-center items-center sm:m-4">
            <!-- <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white ">
                    <img class="w-14 h-14 mr-2" src="https://i.pinimg.com/564x/0b/00/ec/0b00eceba1bdca24c92f21f8065930cb.jpg" alt="Agency Logo">
                    KARI    
                </a>
            </div> -->
            <div id="mainContent" class=" bg-white rounded-lg shadow dark:border md:mt-0  dark:bg-gray-800 dark:border-gray-700" >
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                            Sign In
                        </h1>
                        <div id="errorField" class="p-2 mb-4 text-md text-red-800 rounded-lg bg-red-100 dark:bg-red-100 dark:text-red-600" role="alert">
                            <p id="errorText" class="text-[#721c24] font-semibold text-center">This is an Error Message</p>
                        </div>
                        <form class="space-y-4 md:space-y-6 " action="#">
                            <div>
                                <label for="email" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="clientEmail" id="email" class="font-semibold bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block  py-1.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            </div>
                            <div class="relative">
                                <label for="password" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Password</label>
                                <div class="relative">
                                    <input type="password" name="clientPassword" id="pass"  oninput="showEyePassword()"  class="font-semibold bg-gray-50 border  border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    <i id="eye" onclick="toggle()"  class="fas fa-eye absolute right-5 top-3 cursor-pointer hidden dark:text-white"></i>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-semibold rounded-lg text-xl px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign In</button>
                            <div class="flex justify-center items-center text-xl">
                                <p class="font-light text-gray-500 dark:text-gray-400">
                                    Create an Account? <a href="./register.php" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Register</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>  
        </section>
    </div>

    
    <script src="../JS/main.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script>
        function themeToggle() {
            var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
            var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

            // Change the icons inside the button based on previous settings
            if (
                localStorage.getItem("color-theme") === "dark" ||
                (!("color-theme" in localStorage) &&
                    window.matchMedia("(prefers-color-scheme: dark)").matches)
            ) {
                themeToggleLightIcon.classList.remove("hidden");
            } else {
                themeToggleDarkIcon.classList.remove("hidden");
            }

            var themeToggleBtn = document.getElementById("theme-toggle");

            themeToggleBtn.addEventListener("click", function () {
                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle("hidden");
                themeToggleLightIcon.classList.toggle("hidden");

                // if set via local storage previously
                if (localStorage.getItem("color-theme")) {
                    if (localStorage.getItem("color-theme") === "light") {
                        document.documentElement.classList.add("dark");
                        localStorage.setItem("color-theme", "dark");
                    } else {
                        document.documentElement.classList.remove("dark");
                        localStorage.setItem("color-theme", "light");
                    }
                }
                // if NOT set via local storage previously
                else {
                    if (document.documentElement.classList.contains("dark")) {
                        document.documentElement.classList.remove("dark");
                        localStorage.setItem("color-theme", "light");
                    } else {
                        document.documentElement.classList.add("dark");
                        localStorage.setItem("color-theme", "dark");
                    }
                }
            });
        }
        themeToggle() ;
    </script>
    
</body>
</html>