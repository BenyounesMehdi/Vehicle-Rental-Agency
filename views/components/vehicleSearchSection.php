<?php 
    require './models/database.php' ;
    
    $query = "SELECT * FROM vehiclestype" ;
    $stmt = $pdo->prepare($query) ;
    $stmt->execute() ;
    $vehiclesType = $stmt->fetchAll() ;

    // var_dump($vehiclesType) ;

    $query = "SELECT * FROM brand" ;
    $stmt = $pdo->prepare($query) ;
    $stmt->execute() ;
    $brands = $stmt->fetchAll() ;

?>


<div class="container mx-auto p-2">
    <p class="dark:text-white font-semibold text-4xl  mb-5">Looking for a vehicle? You’re at the right place.</p>
    <div class="flex justify-center items-center flex-col lg:flex-row gap-2">
        <div class="p-2 w-full lg:w-1/2 ">
            <img src="./assets/others/home.jpg" class="shadow-xl w-full object-cover rounded-lg">
        </div>

        <form action="" class="w-full lg:w-1/2">

                <div class=" flex flex-col gap-3 px-3 py-3 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-md">
                        <div class="w-full">
                            <label for="pickupDate" class="text-xl text-black dark:text-white font-semibold italic">Pick up Date</label> <span class="text-red-500 text-xl">*</span>
                            <div class="relative w-full mt-2">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input name="pickupDate" id="pickupDate" datepicker type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pick up date" readonly>
                            </div>
                            <p id="pickupDateMessage"  class="hidden text-red-500 font-semibold dark:text-red-600">The chosen date is already past</p>
                        </div>

                        <div class="w-full">
                            <label for="returnDate" class="text-xl text-black dark:text-white font-semibold italic">Return Date</label> <span class="text-red-500 text-xl">*</span>
                            <div class="relative w-full mt-2">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input name="returnDate" id="returnDate" datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Return date" readonly>
                            </div>
                            <p id="returnDateMessage" class="hidden text-red-500 font-semibold dark:text-red-600">Choose a day in the future</p>
                        </div>

                        <div class="w-full">
                            <p class="text-xl text-black dark:text-white font-semibold italic mb-1">Select The Vehicle Type</p>
                            <select name="" class="bg-gray-50 border dark:text-white border-gray-300  text-xl rounded-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=""></option>
                                <?php 
                                    foreach ($vehiclesType as $vehicleType) {
                                        ?>
                                            <option value="<?php echo $vehicleType->vehicleTypeID; ?>"> <?php echo $vehicleType->name; ?> </option>
                                        <?php
                                    }
                                ?>    
                            
                            </select>
                        </div>

                        <div class="w-full">
                            <p class="text-xl text-black dark:text-white font-semibold italic mb-1">Select The Vehicle Brand</p>
                            <select name="" class="bg-gray-50 border dark:text-white border-gray-300 text-xl rounded-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=""></option>
                                <?php 
                                    foreach ($brands as $brand) {
                                        ?>
                                            <option value="<?php echo $brand->brandID; ?>"> <?php echo $brand->name; ?> </option>
                                        <?php
                                    }
                                ?>    
                            
                            </select>
                        </div>

                        <div class="w-full">
                            <p class="text-xl text-black dark:text-white font-semibold italic mb-1">Enter The Price Range</p>
                            
                            <div  class="flex items-center">
                                <div class="relative">
                                    <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full font-semibold dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full font-semibold  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-end">
                            <button class=" text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>

                </div>

        </form>

        
    </div>
</div>