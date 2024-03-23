<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-2">

        <?php 
            $table = 'client' ;
        ?>            
    <div class="w-fit flex justify-between items-center py-2 px-4 text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
        <div class="flex flex-col gap-1">
            <p class="mb-2 text-3xl font-light tracking-tight text-gray-900 dark:text-white">Clients</p>
            <p class="text-3xl font-bold text-blue-500 dark:text-blue-500"> <?php echo countRableRows($pdo, $table) ?> </p>
        </div>
        <svg class="flex-shrink-0 w-10 h-10 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
        </svg>
    </div>

        <?php 
            $table = 'vehicle' ;
        ?>            
    <div class="w-fit flex justify-between items-center py-2 px-4 text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
        <div class="flex flex-col gap-1">
            <p class="mb-2 text-3xl font-light tracking-tight text-gray-900 dark:text-white">Vehicles</p>
            <p class="text-3xl font-bold text-blue-500 dark:text-blue-500"> <?php echo countRableRows($pdo, $table) ?> </p>
        </div>
        <i class="fa-sharp fa-solid fa-car text-gray-500 text-5xl"></i>
    </div>

        <?php 
            $table = 'vehiclesType' ;
        ?>            
    <div class="w-fit flex justify-between items-center py-2 px-4 text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
        <div class="flex flex-col gap-1">
            <p class="mb-2 text-3xl font-light tracking-tight text-gray-900 dark:text-white">Vehicles Type</p>
            <p class="text-3xl font-bold text-blue-500 dark:text-blue-500"> <?php echo countRableRows($pdo, $table) ?> </p>
        </div>
        <i class="fa-solid fa-layer-group text-gray-500 text-5xl"></i>
    </div>

        <?php 
            $table = 'brand' ;
        ?>            
    <div class="w-fit flex justify-between items-center py-2 px-4 text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
        <div class="flex flex-col gap-1">
            <p class="mb-2 text-3xl font-light tracking-tight text-gray-900 dark:text-white">Brands</p>
            <p class="text-3xl font-bold text-blue-500 dark:text-blue-500"> <?php echo countRableRows($pdo, $table) ?> </p>
        </div>
        <svg class="flex-shrink-0 w-14 h-14 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 2a3 3 0 0 0-2.1.9l-.9.9a1 1 0 0 1-.7.3H7a3 3 0 0 0-3 3v1.2c0 .3 0 .5-.2.7l-1 .9a3 3 0 0 0 0 4.2l1 .9c.2.2.3.4.3.7V17a3 3 0 0 0 3 3h1.2c.3 0 .5 0 .7.2l.9 1a3 3 0 0 0 4.2 0l.9-1c.2-.2.4-.3.7-.3H17a3 3 0 0 0 3-3v-1.2c0-.3 0-.5.2-.7l1-.9a3 3 0 0 0 0-4.2l-1-.9a1 1 0 0 1-.3-.7V7a3 3 0 0 0-3-3h-1.2a1 1 0 0 1-.7-.2l-.9-1A3 3 0 0 0 12 2Zm3.7 7.7a1 1 0 1 0-1.4-1.4L10 12.6l-1.3-1.3a1 1 0 0 0-1.4 1.4l2 2c.4.4 1 .4 1.4 0l5-5Z" clip-rule="evenodd"/>
        </svg>
    </div>

    <?php 
            $table = 'reservation' ;
        ?>            
    <div class="w-fit flex justify-between items-center py-2 px-4 text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
        <div class="flex flex-col gap-1">
            <p class="mb-2 text-3xl font-light tracking-tight text-gray-900 dark:text-white">Reservations</p>
            <p class="text-3xl font-bold text-blue-500 dark:text-blue-500"> <?php echo countRableRows($pdo, $table) ?> </p>
        </div>
        <svg class="w-14 h-14 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1H5a1 1 0 0 0-1 1v12c0 .6.4 1 1 1Zm3-7h0v0h0v0Zm4 0h0v0h0v0Zm4 0h0v0h0v0Zm-8 4h0v0h0v0Zm4 0h0v0h0v0Zm4 0h0v0h0v0Z"/>
        </svg>
    </div>

     
</div>