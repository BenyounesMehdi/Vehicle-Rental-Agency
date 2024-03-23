<?php
    require '../../models/database.php' ;
    require '../../models/functions.php' ;
    session_start() ;
    $clientId = $_SESSION['client']->clientID ;

    $query = "SELECT r.*, b.name as brandName, vt.name as vehicleTypeName,
                     v.name as vehicleName, v.modelYear as modelYear, v.image as image,
                     v.vehicleID as vehicleID
                FROM reservation r
                JOIN client c ON r.clientID = c.clientID
                JOIN vehicle v ON r.vehicleID = v.vehicleID
                JOIN brand b ON b.brandID = v.brandID
                JOIN vehiclesType vt ON v.vehicleTypeID = vt.vehiclesTypeID
                WhERE r.clientID = $clientId" ;
                
                $stmt = $pdo->prepare($query);
                $stmt->execute(); // Execute the query
                $reservations = $stmt->fetchAll();
                // var_dump($reservations) ;

                $numReservations = $stmt->rowCount();
                // echo $numReservations;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">
    
        <section class=" container mx-auto">

            <?php $tableName = "reservation" ?>
            <div class="flex justify-between items-center md:px-2">
                <p class="relative top-2 text-2xl sm:text-3xl md:text-4xl font-meduim text-black dark:text-white mb-7">My Reservations List</p>
                <div class="w-fit p-2 text-blue-700 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" role="alert">
                    <div class="flex items-center justify-between">
                        <p class="font-medium">Total Number : <?php echo $numReservations; ?></p>
                    </div>
                </div>
            </div>


            <?php 
                //Check if the current client has reserved before or not
                if( $numReservations > 0 ) {
            ?>


            <div id="myReservationsTable" class="relative overflow-x-auto overflow-y-auto shadow-lg mt-3" style="max-height : 450px;">
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
                                Vehicle Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Model Year
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Cost
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Days
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Creation Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pickup Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Return Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
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
                                            <?php echo $reservation->vehicleTypeName; ?>
                                        </td>
                                        <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                            <?php echo $reservation->modelYear; ?>
                                        </td>
                                        <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                            <?php echo $reservation->totalCost . " DA" ; ?>
                                        </td>
                                        <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                            <?php echo $reservation->duration; ?>
                                        </td>
                                        <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                            <?php echo $reservation->reservationDate; ?>
                                        </td>
                                        <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                            <?php echo $reservation->pickupDate; ?>
                                        </td>
                                        <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                            <?php echo $reservation->returnDate; ?>
                                        </td>
                                        <td class="px-6 py-2">
                                            <a href="editReservation.php?reservation=<?php echo $reservation->reservationID ?>&vehicle=<?php echo $reservation->vehicleID ?>">
                                                <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 ">Edit</button>    
                                            </a>
                                            <a data-modal-target="popup-modal" data-modal-toggle="popup-modal" >
                                            <button onclick="storeID(<?php echo $reservation->reservationID; ?>, <?php echo $reservation->vehicleID; ?>)" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    <div id="popup-modal" tabindex="-1" class="hidden fixed inset-0 overflow-y-auto overflow-x-hidden z-50  h-[calc(100%-1rem)] max-h-full" >
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                
                                                <div class="p-4 md:p-5 text-center rounded border shadow-xl border-gray-500">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this item?</h3>
                                    
                                                    
                                                    <a id="deleteLink" href="#" >
                                                        <button name="deleteButton" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Yes, I'm sure
                                                            </button>
                                                    </a>
                                                    
                                                    <button id="cancelButton" onclick="closeModel()" data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php }
                        ?>  
            
                    </tbody>

                </table>
            </div>
            <?php } ?>

        </section>



    <script src="../JS/themeToggle.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

    <script>

            function storeID (reservationID, vehicleID) {
    
                var deleteUrl = "../../models/backend/client/deleteReservation.php?id=" + reservationID +"&vehicle=" + vehicleID;
                
                // Get the anchor tag by ID
                var deleteLink = document.getElementById("deleteLink");
                
                // Set the href attribute of the anchor tag
                deleteLink.href = deleteUrl;
            }

    </script>

</body>
</html>