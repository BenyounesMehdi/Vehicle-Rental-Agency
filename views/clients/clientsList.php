<?php
require_once '../../models/database.php';


// Get the search query from the URL
$searchQuery = isset($_GET['clientsSearch']) ? $_GET['clientsSearch'] : '';

// Initialize variable to count search results
$searchResultCount = 0;

if (!empty($searchQuery)) {
    $query = 'SELECT * FROM client WHERE LOWER(name) LIKE ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%$searchQuery%"]);
    $clients = $stmt->fetchAll();
    
    // Get the count of search results
    $searchResultCount = count($vehiclesType);
} else {
    // If no search query, fetch all brands
    $query = 'SELECT * FROM client';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $clients = $stmt->fetchAll();
}   
?>
    

<p class="mb-3 text-2xl font-semibold text-gray-900 dark:text-white">Clients List</p>

    <div class="px-2 sm:px-16">
        <form class="w-full mx-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" oninput="showSearchButtonToggole()" name="clientsSearch" id="default-search" class="block font-semibold w-full p-3 ps-10 text-medium text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
                <button id="searchButton" type="submit" class="hidden text-white absolute end-2 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <div id="clientsList" class="relative overflow-x-auto shadow-lg mt-3"">
            
        </div>
    </div>

    <?php if (!empty($searchQuery)) { ?>
    <p class="text-gray-700 dark:text-gray-300 mt-2">Found <?php echo $searchResultCount; ?> result(s) for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
<?php } ?>
         
    <?php 
    // require_once '../../models/database.php' ;
        $query = 'SELECT * FROM client';
        $stmt = $pdo->prepare($query);
        $stmt->execute(); // Execute the query
        $clients = $stmt->fetchAll(); // Fetch all rows from the result set 
        ?>
    <div id="clientsTable" class="relative overflow-x-auto overflow-y-auto shadow-lg mt-3" style="max-height : 350px;">
        <table class="w-full text-sm text-left rtl:text-right text-gray-50 dark:text-gray-400 rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                </tr>
            </thead>
            <tbody>
    
                <?php
                        foreach ($clients as $client) { ?> 
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $client->clientID; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $client->firstName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $client->lastName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $client->phoneNumber; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $client->email; ?>
                                </td>
                            </tr>
                            

                        <?php }
                ?>  
    
            </tbody>

        </table>
    </div>


    
