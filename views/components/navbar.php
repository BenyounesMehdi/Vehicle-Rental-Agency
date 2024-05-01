<?php 
    require './models/database.php' ;

?>

<nav class="bg-white dark:bg-gray-900 relative w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">KARI</span>
        </a>


        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <?php 
                if( !isset($_SESSION['client']) && !isset($_SESSION['admin'])  ) { // if neither the Admin nor the Client are logged in
                    ?>
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Sign In<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="views/client/login.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">As a Client</a>
                            </li>
                            <li>
                                <a href="views/admin/login.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">As an Adminstrator</a>
                            </li>
                            
                            </ul>
                        </div>

                        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                            </svg>
                        </button>
                    <?php
                }
                else if( isset($_SESSION['client'])  ) { // if the Client is already Logged in

                        $stmt = $pdo->prepare("
                        SELECT * FROM reservation r 
                        JOIN client c ON r.clientID = c.clientID
                        WHERE isExpired = 'Yes' AND r.clientID = ?
                        ");
                        
                        $stmt->execute([$_SESSION['client']->clientID]);
                        
                        $expiredReservations = $stmt->fetchAll();
                        
                        // var_dump($expiredReservations) ;
                        $expiredReservationsCount = $stmt->rowCount();
                        
                        // echo $expiredReservationsCount;

                        

                        // var_dump($_SESSION['client']) ;
                        $clientID = $_SESSION['client']->clientID ;
                        // echo $clientID;

                        $query = "SELECT * FROM opinion
                        WHERE clientID = ". $clientID;
                        $stmt = $pdo->prepare($query) ;
                        $stmt->execute();   
                        $client = $stmt->fetch() ;
                        // var_dump($client) ;

                        $client ? $isExit = true : $isExit = false;
                        // echo $isExit;

                    ?>
                        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="relative top-1 md:top-0 flex text-sm rounded-full md:me-0 " type="button">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="./assets/clientProfile/unknownPP.jpg" alt="ClientPhoto">
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownAvatar" class="z-10 hidden bg-gray-100 divide-y divide-gray-300 rounded-lg shadow-lg w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div> <?php echo $_SESSION['client']->firstName. " " .$_SESSION['client']->lastName  ?> </div>
                            <div class="font-medium truncate"> <?php echo $_SESSION['client']->email ?> </div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                            </li>
                            <li>
                                <a href="../../../VehicleRentalAgency/views/client/myReservations.php" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">My Reservations</a>
                            </li>
                            <li>
                                <?php 
                                    if( $expiredReservationsCount > 0 ) {
                                    if( !$isExit ) { ?>
                                        <a href="../../../VehicleRentalAgency/views/client/myOpinion.php" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Add Opinion</a>
                                    <?php }
                                    else { ?>
                                        <a href="../../../VehicleRentalAgency/views/client/editDeleteOpinoin.php" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Edit & Delete Opinion</a>
                                        <?php
                                    }
                                }
                                ?>
                            </li>
                            </ul>
                            <div class="py-2">
                            <a href="./views/client/signOut.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                            </div>
                        </div>

                        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                            </svg>
                        </button>
                    <?php
                }

                else { // if the Admin is already Logged in
                    ?> 
                
                        <a href="./views/admin/dashboardSide.php" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Go To Dashboard
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>

                    <?php
                    
                }
            ?>

        </div>


        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
                <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
            </li>
            <li>
                <a href="#brands" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Brands</a>
            </li>

            <li>

              
                    <div class=" w-full md:block md:w-auto" id="navbar-dropdown">
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full text-gray-900  hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Vehicles <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                             </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">

                                    <?php 
                                            include_once './models/database.php' ;
                                            // Get all the vehicles type to add them into the dropdown menu
                                            $query = "SELECT * FROM vehiclestype";
                                            $stmt = $pdo->prepare($query);
                                            $stmt->execute();
                                            $vehiclesType = $stmt->fetchAll();
                                            // var_dump($vehiclesType);

                                            foreach ($vehiclesType as $vehicleType) {
                                                ?>
                                                    <li >
                                                        <a href="#<?php echo $vehicleType->name; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"> 
                                                            <?php echo $vehicleType->name; ?>    
                                                        </a>
                                                    </li>
                                                <?php
                                            }

                                        ?>

                                </ul>
                            
                        </li>
                    
                    </ul>
                    </div>


            </li>

            
            
            <li>
                <a href="#opinions" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Opinions</a>
            </li>
            
            <li>
                <button id="theme-toggle" type="button" class="w-full text-gray-500 dark:text-gray-400 text-sm px-2 relative top-0">
                    <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
            </li>

            </ul>
        </div>
        </div>
        </nav>