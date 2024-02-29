<div class="bg-gray-300 dark:bg-gray-900">
        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
    </div>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen  transition-transform -translate-x-full sm:translate-x-0 " aria-label="Sidebar" >
        <div class="relative h-full px-3 py-4 overflow-y-auto bg-gray-50  dark:bg-gray-800 " >
            <div class="flex justify-evenly items-center  px-2 gap-2 ">
                <img src="../../assets/clientProfile/unknownPP.jpg" class="w-8 h-8 rounded-full">
                <div class="flex flex-col dark:text-white">
                    <p class="font-semibold text-xl ">Admin</p>
                    <p class="font-medium"><?php echo $_SESSION['admin']->firstName. " " .$_SESSION['admin']->lastName  ?></p>
                </div>
            </div>
            <hr class="w-full border-gray-300 dark:border-gray-500 mt-1">
            <ul class="space-y-2 font-medium mt-2" id="sideBar">
                <li>
                    <a href="../../index.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.3 3.3a1 1 0 0 1 1.4 0l6 6 2 2a1 1 0 0 1-1.4 1.4l-.3-.3V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3c0 .6-.4 1-1 1H7a2 2 0 0 1-2-2v-6.6l-.3.3a1 1 0 0 1-1.4-1.4l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg> 
                        <span class="ms-3 whitespace-nowrap">Home</span>
                        
                    </a>
                </li>
                <li>
                    <a href="dashboardSide.php" class="flex justify-between items-center p-2 text-gray-900 rounded-lg focus:bg-red-500 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group" onclick="toggleArrow(this);">
                    <div class="flex justify-center items-center">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3 whitespace-nowrap">Dashboard</span>
                    </div>
                    <i id="dashboardArrow" class="fa-solid fa-arrow-right hidden"></i>
                    </a>
                </li>
                <li>
                    <a href="reservationsSide.php" class="flex justify-between items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group" onclick="toggleArrow(this);">
                    <div class="flex justify-center items-center">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1H5a1 1 0 0 0-1 1v12c0 .6.4 1 1 1Zm3-7h0v0h0v0Zm4 0h0v0h0v0Zm4 0h0v0h0v0Zm-8 4h0v0h0v0Zm4 0h0v0h0v0Zm4 0h0v0h0v0Z"/>
                        </svg>
                        <span class="ms-3 whitespace-nowrap">Reservations</span>
                    </div>
                    <i id="reservationsArrow" class="hidden fa-solid fa-arrow-right"></i>
                    </a>
                </li>
                <li>
                    <a href="clientSide.php" class="flex justify-between items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group" onclick="toggleArrow(this);">
                    <div class="flex justify-center items-center">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                        <span class="ms-3 whitespace-nowrap">Clients</span>
                    </div>
                    <i id="clientsArrow" class="fa-solid fa-arrow-right hidden"></i>
                    </a>
                </li>
                <li class="flex">
                    <a href="vehiclesSide.php" class="w-full flex justify-between items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group" onclick="toggleArrow(this);">
                    <div class="flex justify-center items-center">
                        <i class="fa-sharp fa-solid fa-car text-gray-500 text-xl"></i>
                        <span class="ms-3 whitespace-nowrap">Vehicles</span>
                    </div>
                    <i id="vehiclesArrow" class="fa-solid fa-arrow-right hidden"></i>
                    </a>
                </li>
                <li class="flex">
                    <a href="vehiclesTypeSide.php" class="w-full flex justify-between items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group" onclick="toggleArrow(this);">
                    <div class="flex justify-center items-center">
                        <i class="fa-solid fa-layer-group text-gray-500 text-xl"></i>
                        <span class="ms-3 whitespace-nowrap">Vehicles Type</span>
                    </div>
                    <i id="vehiclesTypeArrow" class="fa-solid fa-arrow-right hidden"></i>
                    </a>
                </li>
                <li class="flex">
                    <a href="brandsSide.php" class="w-full flex justify-between items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group" onclick="toggleArrow(this); ">
                        <div class="flex justify-center items-center">
                            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2a3 3 0 0 0-2.1.9l-.9.9a1 1 0 0 1-.7.3H7a3 3 0 0 0-3 3v1.2c0 .3 0 .5-.2.7l-1 .9a3 3 0 0 0 0 4.2l1 .9c.2.2.3.4.3.7V17a3 3 0 0 0 3 3h1.2c.3 0 .5 0 .7.2l.9 1a3 3 0 0 0 4.2 0l.9-1c.2-.2.4-.3.7-.3H17a3 3 0 0 0 3-3v-1.2c0-.3 0-.5.2-.7l1-.9a3 3 0 0 0 0-4.2l-1-.9a1 1 0 0 1-.3-.7V7a3 3 0 0 0-3-3h-1.2a1 1 0 0 1-.7-.2l-.9-1A3 3 0 0 0 12 2Zm3.7 7.7a1 1 0 1 0-1.4-1.4L10 12.6l-1.3-1.3a1 1 0 0 0-1.4 1.4l2 2c.4.4 1 .4 1.4 0l5-5Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ms-3 whitespace-nowrap">Brands</span>
                        </div>
                        <i id="brandsArrow" class="fa-solid fa-arrow-right hidden"></i>
                    </a>
                </li>
                <li>
                    <button id="theme-toggle" type="button" class="w-full flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                        <span id="themeExepression" class="ms-3 whitespace-nowrap"></span>
                    </button>
                </li>
                <li class="absolute bottom-2" style="width: 90%;">
                    <a href="./signOut.php" class="w-full flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
        </aside>
       
            
        </div>