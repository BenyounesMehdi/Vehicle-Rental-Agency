<?php
    $query = 'SELECT r.*, v.name as vehicleName, v.image as image, b.name as brandName,
    c.firstName as firstName, c.lastName as lastName, 
    SUM(r.totalCost) as totalIncome
    FROM reservation r
    JOIN client c ON r.clientID = c.clientID
    JOIN vehicle v ON r.vehicleID = v.vehicleID
    JOIN brand b ON b.brandID = v.brandID
    JOIN vehiclestype vt ON vt.vehiclesTypeID = v.vehicleTypeID
    WHERE DATE(r.reservationDate) = CURDATE()
    GROUP BY r.reservationID';


    $stmt = $pdo->prepare($query);
    $stmt->execute(); 
    $todaysReservations = $stmt->fetchAll(); 

    $totalTodayReservations = $stmt->rowCount();

    $totalIncome = 0; 

    // Calculating the today's total income
    foreach ($todaysReservations as $reservation) {
        // Access the totalPrice property of each reservation and add it to the totalIncome
        $totalIncome += $reservation->totalCost;
    }

    // echo $totalIncome;
    // var_dump($todaysReservations) ;
?>

<div class="relative bg-white dark:bg-gray-800 overflow-x-auto shadow-md sm:rounded-lg px-2 py-3">

    <div class="flex justify-between items-center mb-2">
        <p class="text-black dark:text-white text-4xl font-semibold mb-3">Today's Reservations</p>
        <div class="flex flex-col">
            <p class="text-normal font-medium text-gray-500 dark:text-gray-400">Today's Income: <span class="text-green-500 dark:text-green-400"><?php echo $totalIncome; ?> DA</span> </p>
            <p class="text-normal font-medium text-gray-500 dark:text-gray-400">Total Reservations: <span class="mt-2 "><?php echo $totalTodayReservations; ?></span> </p>
        </div>
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
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
                        foreach ($todaysReservations as $reservation) { ?> 
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
