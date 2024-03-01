<?php
require_once '../../models/database.php';

// Get the search query from the URL
$searchQuery = isset($_GET['vehiclesSearch']) ? $_GET['vehiclesSearch'] : '';

// Initialize variable to count search results
$searchResultCount = 0;

if (!empty($searchQuery)) {
    $query = 'SELECT * FROM vehicle WHERE LOWER(name) LIKE ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%$searchQuery%"]);
    $vehicles = $stmt->fetchAll();
    
    // Get the count of search results
    $searchResultCount = count($brands);
} else {
    // If no search query, fetch all brands
    $query = 'SELECT * FROM vehicle';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $vehicles = $stmt->fetchAll();
}   
?>
    

<p class="mb-3 text-2xl font-semibold text-gray-900 dark:text-white">Vehicles List</p>

    <div class="px-2 sm:px-16">
        <form class="w-full mx-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" oninput="showSearchButtonToggole()" name="vehiclesSearch" id="default-search" class="block font-semibold w-full p-3 ps-10 text-medium text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
                <button id="searchButton" type="submit" class="hidden text-white absolute end-2 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <div id="vehiclesList" class="relative overflow-x-auto shadow-lg mt-3"">
            
        </div>
    </div>

    <?php if (!empty($searchQuery)) { ?>
    <p class="text-gray-700 dark:text-gray-300 mt-2">Found <?php echo $searchResultCount; ?> result(s) for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
<?php } ?>
         
    <?php 
    // require_once '../../models/database.php' ;
        // $query = 'SELECT * FROM vehicle';
        $query = "SELECT v.*, b.name as brandName, vt.name as vehicleTypeName
                    FROM vehicle v
                    JOIN brand b ON v.brandID = b.brandID
                    JOIN vehiclesType vt ON v.vehicleTypeID = vt.vehiclesTypeID" ;
        $stmt = $pdo->prepare($query);
        $stmt->execute(); // Execute the query
        $vehicles = $stmt->fetchAll(); // Fetch all rows from the result set 
        ?>
    <div id="brandsTable" class="relative overflow-x-auto overflow-y-auto shadow-lg mt-3" style="max-height : 350px;">
        <table class="w-full text-sm text-left rtl:text-right text-gray-50 dark:text-gray-400 rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
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
                        Cost Per Day
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Vehicle Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Creation Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
    
                <?php
                        foreach ($vehicles as $vehicle) { ?> 
                                
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class=" px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $vehicle->vehicleID; ?>
                                </td>
                                <td class="py-8  flex justify-center items-center">
                                    <?php 
                                        if( $vehicle->image === "" ) {
                                            ?> <?php
                                        }
                                        else {
                                            ?>
                                            <img src="../../assets/vehiclesImages/<?php echo $vehicle->image; ?>" class="w-20  md:w-10 max-w-full max-h-full">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $vehicle->name; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $vehicle->brandName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $vehicle->vehicleTypeName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $vehicle->modelYear; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $vehicle->costPerDay; ?> DA
                                </td>
                                <td class="px-6 py-2 font-bold <?php echo ($vehicle->vehicleStatus == 'Available') ? 'text-green-500' : (($vehicle->vehicleStatus == 'Not Available') ? 'text-red-500' : 'text-blue-500'); ?>">
                                    <?php echo $vehicle->vehicleStatus; ?>
                                </td>   
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $vehicle->creationDate; ?>
                                </td>
                                <td class="px-6 py-2">
                                    <a href="../vehicles/editVehicle.php?id=<?php echo $vehicle->vehicleID ?>">
                                        <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 ">Edit</button>    
                                    </a>
                                    <a data-modal-target="popup-modal" data-modal-toggle="popup-modal" >
                                    <button onclick="storeID(<?php echo $vehicle->vehicleID; ?>)" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600">Delete</button>
                                    </a>
                                </td>
                            </tr>
                            
                            <div id="popup-modal" tabindex="-1" class="hidden  overflow-y-auto overflow-x-hidden fixed z-50  h-[calc(100%-1rem)] max-h-full" >
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


    
