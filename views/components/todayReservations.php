<?php
    // $query = 'SELECT r.*, v.name as vehicleName, v.image as image, b.name as brandName,
    // c.firstName as firstName, c.lastName as lastName, 
    // SUM(r.totalCost) as totalIncome
    // FROM reservation r
    // JOIN client c ON r.clientID = c.clientID
    // JOIN vehicle v ON r.vehicleID = v.vehicleID
    // JOIN brand b ON b.brandID = v.brandID
    // JOIN vehiclestype vt ON vt.vehiclesTypeID = v.vehicleTypeID
    // WHERE DATE(r.reservationDate) = CURDATE()
    // GROUP BY r.reservationID';


    // $stmt = $pdo->prepare($query);
    // $stmt->execute(); 
    // $filteredReservations = $stmt->fetchAll(); 

    // $totalReservations = $stmt->rowCount();

    // $totalIncome = 0; 

    // // Calculating the today's total income
    // foreach ($filteredReservations as $reservation) {
    //     // Access the totalPrice property of each reservation and add it to the totalIncome
    //     $totalIncome += $reservation->totalCost;
    // }

    // echo $totalIncome;
    // var_dump($filteredReservations) ;


    $totalIncome = 0;
    $totalReservations = 0 ;
    $filteredReservations = [];

    // Check if a date is selected from the date picker
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Check if a date is selected from the date picker
        if(isset($_POST['selectedDate'])) {

            // Convert the selected date format from 'MM/DD/YYYY' to 'YYYY-MM-DD'
            $selectedDate = date('Y-m-d', strtotime($_POST['selectedDate']));
    
            $query = 'SELECT r.*, v.name as vehicleName, v.image as image, b.name as brandName,
                c.firstName as firstName, c.lastName as lastName, 
                SUM(r.totalCost) as totalIncome
                FROM reservation r
                JOIN client c ON r.clientID = c.clientID
                JOIN vehicle v ON r.vehicleID = v.vehicleID
                JOIN brand b ON b.brandID = v.brandID
                JOIN vehiclestype vt ON vt.vehiclesTypeID = v.vehicleTypeID
                WHERE DATE(r.reservationDate) = :selectedDate
                GROUP BY r.reservationID';

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':selectedDate', $selectedDate);
                $stmt->execute();
                $filteredReservations = $stmt->fetchAll(); 
            
                // Fetch the total number of reservations for the selected date
                $totalReservations = $stmt->rowCount();

                // Initialize total income for the selected date

            // Calculate the total income for the selected date
                foreach ($filteredReservations as $reservation) {
                    $totalIncome += $reservation->totalCost;
                }
        }
    }


?>



 <p class="text-black dark:text-white text-4xl font-semibold mb-3">Filtired Reservations</p>
<div class=" relative bg-white dark:bg-gray-800 overflow-x-auto shadow-md sm:rounded-lg px-4 py-4" style="max-height: 370px;">

    <div class="flex justify-between items-center gap-1 mb-2">
        <!-- <p class="text-black dark:text-white text-4xl font-semibold mb-3">Today's Reservations</p> -->
        
        <!-- DATEPICKER -->
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="flex flex-col md:flex-row justify-center items-center gap-1">
            <div class="relative max-w-sm">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input name="selectedDate" datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            </div>
            <button type="submit" name="submit" id="submitBtn" class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-6 py-2.5 me-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 relative bottom-1">Filter</button>

        </form>

        <div class="flex flex-col">
            <p class="text-normal font-medium text-gray-500 dark:text-gray-400">Today's Income: <span class="text-green-500 dark:text-green-400"><?php echo $totalIncome; ?> DA</span> </p>
            <p class="text-normal font-medium text-gray-500 dark:text-gray-400">Total Reservations: <span class="mt-2 "><?php echo $totalReservations; ?></span> </p>
        </div>
    </div>

    <table class="<?php echo ($totalReservations == 0 || $filteredReservations == 0) ? 'hidden' : ''; ?>  w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
            <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Brand
                    </th>
                    <th scope="col" class="px-6 py-3">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pickup Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Return Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Days
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Cost
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payed
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reservation Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
            </tr>
        </thead>

        <tbody>
    
                <?php
                        foreach ($filteredReservations as $reservation) { ?> 
                            <tr class="bg-gray-100 border-b dark:bg-gray-600 dark:border-gray-700">
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $reservation->vehicleName; ?>
                                </td>
                                <td class="py-8 flex justify-center items-center">
                                    <?php 
                                        if( $reservation->image === "" ) {
                                            ?> <?php
                                        }
                                        else {
                                            ?>
                                            <img src="../../assets/vehiclesImages/<?php echo $reservation->image; ?>" class="w-20  md:w-10 max-w-full max-h-full">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $reservation->brandName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $reservation->firstName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $reservation->lastName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $reservation->pickupDate; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $reservation->returnDate; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $reservation->duration; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-green-500 italic">
                                    <?php echo $reservation->totalCost . " DA";?>
                                </td>
                                <td class="px-6 py-2 font-bold  <?php echo ($reservation->isPayed == 'No') ? 'text-red-500' : 'text-green-500'  ?> ">
                                    <?php echo $reservation->isPayed; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-blue-500">
                                    <?php echo $reservation->reservationDate; ?>
                                </td>
                                <td class="px-6 py-2 font-bold <?php echo ($reservation->isExpired == 'No') ? 'text-red-500' : 'text-green-500'  ?> ">
                                    <?php echo ($reservation->isExpired == "Yes") ?  "Expired" : "Not Expired" ; ?>
                                </td>
                                
                            </tr>
                            

                        <?php }
                ?>  
    
            </tbody>

    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>


<!-- JavaScript to set default date to today's date -->
<script>
    // Set default date to today's date
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();
    var defaultDate = mm + '/' + dd + '/' + yyyy;
    document.getElementById('selectedDate').value = defaultDate;
</script>