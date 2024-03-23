<?php 
    // require_once '../../models/database.php' ;
        $query = 'SELECT r.*, v.name as vehicleName, v.image as image, b.name as brandName,
                    c.firstName as firstName, c.lastName as lastName 
                FROM reservation r
                JOIN client c ON r.clientID = c.clientID
                JOIN vehicle v ON r.vehicleID = v.vehicleID
                JOIN brand b ON b.brandID = v.brandID
                JOIN vehiclestype vt ON vt.vehiclesTypeID = v.vehicleTypeID';
        $stmt = $pdo->prepare($query);
        $stmt->execute(); // Execute the query
        $reservations = $stmt->fetchAll(); // Fetch all rows from the result set 
        ?>
    <div id="reservationsTable" class="relative overflow-x-auto overflow-y-auto shadow-lg mt-3" style="max-height : 500px;">
        <table class="w-full text-sm text-left rtl:text-right text-gray-50 dark:text-gray-400 rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
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
                </tr>
            </thead>
            <tbody>
    
                <?php
                        foreach ($reservations as $reservation) { ?> 
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                
                            </tr>
                            

                        <?php }
                ?>  
    
            </tbody>

        </table>
    </div>