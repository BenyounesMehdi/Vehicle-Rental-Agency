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

</head>
<body class="bg-gray-100 dark:bg-gray-900 ">

    <div class="container mx-auto flex items-center py-4  h-screen">
        <section class="  dark:bg-gray-900 w-full rounded flex flex-col px-4 py-2 justify-center items-center m-1">
            <!-- <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white ">
                    <img class="w-14 h-14 mr-2" src="https://i.pinimg.com/564x/0b/00/ec/0b00eceba1bdca24c92f21f8065930cb.jpg" alt="Agency Logo">
                    KARI    
                </a>
            </div> -->
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 ">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-7">
                        <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                            Create an Account
                        </h1>
                        <div id="errorField" class="p-3 mb-4 text-md text-red-800 rounded-lg bg-red-100 dark:bg-red-100 dark:text-red-600" role="alert">
                            <p id="errorText" class="text-[#721c24] font-semibold text-center">This is an Error Message</p>
                        </div>
                        <form class="flex flex-col gap-1" action="#">
                            <div>
                                <label for="firstName" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">First Name</label>
                                <input type="text" name="clientFirstName" id="firstName" class="font-semibold bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <div>
                                <label for="lastName" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Last Name</label>
                                <input type="text" name="clientLastName" id="lastName" class="font-semibold bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <label for="phoneNumber" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Phone Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                     <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                     <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="phoneNumber" aria-describedby="helper-text-explanation" class="font-semibold bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" pattern="[0-9]{10}" required />
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="clientEmail" id="email" class="font-semibold bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            </div>
                            <div class="relative">
                                <label for="password" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Password</label>
                                <div class="relative">
                                    <input type="password" name="clientPassword" oninput="showEyePassword()" id="pass" class="font-semibold bg-gray-50 border  border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    <i id="eye" onclick="toggle()"  class="fas fa-eye absolute right-5 top-3 cursor-pointer hidden dark:text-white"></i>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full mt-1 mb-1 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-semibold rounded-lg text-xl px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Register</button>
                            <div class="flex justify-center items-center text-xl">
                                <p class="font-light text-gray-500 dark:text-gray-400 sm:text-md text-md">
                                    Have an Account? <a href="./login.php" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Sign In</a>
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