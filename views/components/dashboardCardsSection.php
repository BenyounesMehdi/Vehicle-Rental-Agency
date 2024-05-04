<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-2">

    <?php
        $query = "SELECT SUM(totalCost) AS totalIncome FROM reservation WHERE isExpired = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute(["Yes"]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalIncome = $result['totalIncome'];
    ?>

    <article class="rounded-lg border bg-white p-6  dark:bg-gray-900 border-blue-300 dark:border-blue-800">
        <div class="flex items-center justify-between">
            <div>
            <p class="text-lg font-semibold text-gray-500 dark:text-gray-400">Profit</p>

            <p class="text-2xl font-medium text-gray-900 dark:text-white"> <?php echo $totalIncome; ?><span class="text-sm italic">DA</span> </p>
            </div>

            <span class="rounded-full bg-blue-100 p-3 text-blue-600 dark:bg-blue-500/20 ">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"
                />
            </svg>
            </span>
        </div>
    </article>

    <?php
        $query = "SELECT * FROM reservation WHERE isExpired = ?" ;
        $stmt = $pdo->prepare($query)  ;
        $stmt->execute(["Yes"]) ;
        $reservations = $stmt->fetchAll() ;
        $rowCount = $stmt->rowCount();
    ?>

    <article class="rounded-lg border bg-white p-6  dark:bg-gray-900 border-blue-300 dark:border-blue-800">
        <div class="flex items-center justify-between">
            <div>
            <p class="text-lg font-semibold text-gray-500 dark:text-gray-400">Reservations</p>

            <p class="text-2xl font-medium text-gray-900 dark:text-white"> <?php echo $rowCount ; ?> </p>
            </div>

            <span class="rounded-full bg-blue-100 p-3 text-blue-600 dark:bg-blue-500/20 ">
                <svg class="w-8 h-8 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path 
                       stroke="currentColor" 
                       stroke-linecap="round" 
                       stroke-linejoin="round"
                      stroke-width="2" 
                      d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1H5a1 1 0 0 0-1 1v12c0 .6.4 1 1 1Zm3-7h0v0h0v0Zm4 0h0v0h0v0Zm4 0h0v0h0v0Zm-8 4h0v0h0v0Zm4 0h0v0h0v0Zm4 0h0v0h0v0Z"/>
                </svg>
            </span>
        </div>
    </article>

    <?php 
            $table = 'brand' ;
    ?> 
    <article class="rounded-lg border bg-white p-6  dark:bg-gray-900 border-blue-300 dark:border-blue-800">
        <div class="flex items-center justify-between">
            <div>
            <p class="text-lg font-semibold text-gray-500 dark:text-gray-400">Brands</p>

            <p class="text-2xl font-medium text-gray-900 dark:text-white"> <?php echo countRableRows($pdo, $table) ?> </p>
            </div>

            <span class="rounded-full bg-blue-100 p-3 text-blue-600 dark:bg-blue-500/20 ">
                <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path 
                        fill-rule="evenodd" 
                        d="M12 2a3 3 0 0 0-2.1.9l-.9.9a1 1 0 0 1-.7.3H7a3 3 0 0 0-3 3v1.2c0 .3 0 .5-.2.7l-1 .9a3 3 0 0 0 0 4.2l1 .9c.2.2.3.4.3.7V17a3 3 0 0 0 3 3h1.2c.3 0 .5 0 .7.2l.9 1a3 3 0 0 0 4.2 0l.9-1c.2-.2.4-.3.7-.3H17a3 3 0 0 0 3-3v-1.2c0-.3 0-.5.2-.7l1-.9a3 3 0 0 0 0-4.2l-1-.9a1 1 0 0 1-.3-.7V7a3 3 0 0 0-3-3h-1.2a1 1 0 0 1-.7-.2l-.9-1A3 3 0 0 0 12 2Zm3.7 7.7a1 1 0 1 0-1.4-1.4L10 12.6l-1.3-1.3a1 1 0 0 0-1.4 1.4l2 2c.4.4 1 .4 1.4 0l5-5Z" clip-rule="evenodd"/>
                </svg>
            </span>
        </div>
    </article>

    <?php 
            $table = 'vehicle' ;
    ?> 
    <article class="rounded-lg border bg-white p-6  dark:bg-gray-900 border-blue-300 dark:border-blue-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold text-gray-500 dark:text-gray-400">Vehicles</p>
                <p class="text-2xl font-medium text-gray-900 dark:text-white"> <?php echo countRableRows($pdo, $table) ?> </p>
            </div>

            <span class="rounded-full bg-blue-100 py-3 px-4 text-blue-600 dark:bg-blue-500/20 ">
                <i class="fa-sharp  fa-solid fa-car text-2xl  "></i>
            </span>
        </div>
    </article>

     
</div>