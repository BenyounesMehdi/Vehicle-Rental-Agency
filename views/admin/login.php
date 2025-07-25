<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
    
    <style>
            /* For screens smaller than 640px (e.g., mobile screens) */
            #mainContent {
                width: 55%;
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
        <section class="  dark:bg-gray-900 w-full rounded flex flex-col px-4 py-1 justify-center items-center m-1">
            <!-- <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white ">
                    <img class="w-14 h-14 mr-2" src="https://i.pinimg.com/564x/0b/00/ec/0b00eceba1bdca24c92f21f8065930cb.jpg" alt="Agency Logo">
                    KARI    
                </a>
            </div> -->
            <div id="mainContent" class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                            Sign In
                        </h1>

                        <?php include '../../models/backend/admin/login.php' ?>
                        
                        <form class="space-y-4 md:space-y-6" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div>
                                <label for="email" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="adminEmail" id="email" class="font-semibold bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" >
                            </div>
                            <div class="relative">
                                <label for="password" class="block mb-2 text-meduim font-bold text-gray-900 dark:text-white">Password</label>
                                <div class="relative">
                                    <input type="password" name="adminPassword" id="pass"  oninput="showEyePassword()"  class="font-semibold bg-gray-50 border  border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                    <i id="eye" onclick="toggle()"  class="fas fa-eye absolute right-5 top-3 cursor-pointer hidden dark:text-white"></i>
                                </div>
                            </div>
                            
                            <button type="submit" name="signIn" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-semibold rounded-lg text-xl px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign In</button>
                        </form>
                    </div>
                </div>  
        </section>
    </div>

    <script src="../JS/main.js"></script>
    <script src="../JS/themeToggle.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    
    
</body>
</html>