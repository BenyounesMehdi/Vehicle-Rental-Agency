<?php

require_once '../../models/database.php';

// Get the search query from the URL
$searchQuery = isset($_GET['reservationsSearch']) ? $_GET['reservationsSearch'] : '';

// Initialize variable to count search results
$searchResultCount = 0;

if (!empty($searchQuery)) {
    $query = 'SELECT r.*, c.firstName, c.lastName 
              FROM reservation r
              JOIN client c ON r.clientID = c.clientID
              WHERE LOWER(r.reservationID) LIKE ? 
              OR LOWER(c.firstName) LIKE ? 
              OR LOWER(c.lastName) LIKE ?';
    $stmt = $pdo->prepare($query);
    $searchTerm = '%' . strtolower($searchQuery) . '%';
    $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    $reservations = $stmt->fetchAll();
    
    // Get the count of search results
    $searchResultCount = count($reservations);
} else {
    // If no search query, fetch all reservations
    $query = 'SELECT r.*, v.name as vehicleName, v.image as image, b.name as brandName,
                    c.firstName as firstName, c.lastName as lastName, r.reservationID as id 
                FROM reservation r
                JOIN client c ON r.clientID = c.clientID
                JOIN vehicle v ON r.vehicleID = v.vehicleID
                JOIN brand b ON b.brandID = v.brandID
                JOIN vehiclestype vt ON vt.vehiclesTypeID = v.vehicleTypeID';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $reservations = $stmt->fetchAll();
}  
?>

<div class="px-2 sm:px-16">
        <form class="w-full mx-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" oninput="showSearchButtonToggole()" name="reservationsSearch" id="default-search" class="block font-semibold w-full p-3 ps-10 text-medium text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by client full name or reservation id">
                <button id="searchButton" type="submit" class="hidden text-white absolute end-2 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <div id="reservationsList" class="relative overflow-x-auto shadow-lg mt-3"">
            
        </div>
    </div>

    <?php if (!empty($searchQuery)) { ?>
        <p class="text-gray-700 dark:text-gray-300 mt-2">Found <?php echo $searchResultCount; ?> result(s) for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
    <?php } ?>

<?php 

        $currentDate = new DateTime('now');
        $currentDate->setTime(0, 0, 0); // Set time to midnight


    // require_once '../../models/database.php' ;
        $query = 'SELECT r.*, v.name as vehicleName, v.image as image, b.name as brandName,
                    c.firstName as firstName, c.lastName as lastName, r.reservationID as id 
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
                        ID
                    </th>
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
                        Paied
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Reservation Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
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
                                    <?php echo $reservation->id; ?>
                                </td>
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

                                <td class="px-6 py-2">
                                               
                                            <a href="../reservations/editReservation.php?reservation=<?php echo $reservation->reservationID ?>&vehicle=<?php echo $reservation->vehicleID ?>">
                                                <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 ">Edit</button>    
                                            </a>

                                            <?php 
                                                    // $returnDate = new DateTime($reservation->returnDate);
                                                    // $returnDate->setTime(0, 0, 0); // Set time to midnight

                                                    if( $reservation->isExpired == "No" ) { ?>
                                                        <a data-modal-target="popup-modal" data-modal-toggle="popup-modal" >
                                                        <button onclick="storeID(<?php echo $reservation->reservationID; ?>, <?php echo $reservation->vehicleID; ?>)" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600">Delete</button>
                                                        </a>
                                                    <?php }
                                                    
                                            ?>

                                            
                                         
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


<script>

    function storeID (reservationID, vehicleID) {

        var deleteUrl = "../../models/backend/client/deleteReservation.php?id=" + reservationID +"&vehicle=" + vehicleID;
        
        // Get the anchor tag by ID
        var deleteLink = document.getElementById("deleteLink");
        
        // Set the href attribute of the anchor tag
        deleteLink.href = deleteUrl;
    }

</script>