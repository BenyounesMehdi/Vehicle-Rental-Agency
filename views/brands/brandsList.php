<?php
require_once '../../models/database.php';

// Get the search query from the URL
$searchQuery = isset($_GET['brandsSearch']) ? $_GET['brandsSearch'] : '';

// Initialize variable to count search results
$searchResultCount = 0;

// Fetch brands based on the search query
// if (!empty($searchQuery)) {
//     $query = 'SELECT * FROM brand WHERE name LIKE ?';
//     $stmt = $pdo->prepare($query);
//     $stmt->execute(["%$searchQuery%"]);
//     $brands = $stmt->fetchAll();
    
//     // Get the count of search results
//     $searchResultCount = count($brands);
// } else {
//     // If no search query, fetch all brands
//     $query = 'SELECT * FROM brand';
//     $stmt = $pdo->prepare($query);
//     $stmt->execute();
//     $brands = $stmt->fetchAll();
// }

if (!empty($searchQuery)) {
    $query = 'SELECT * FROM brand WHERE LOWER(name) LIKE ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%$searchQuery%"]);
    $brands = $stmt->fetchAll();
    
    // Get the count of search results
    $searchResultCount = count($brands);
} else {
    // If no search query, fetch all brands
    $query = 'SELECT * FROM brand';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $brands = $stmt->fetchAll();
}   
?>
    

<p class="mb-3 text-2xl font-semibold text-gray-900 dark:text-white">Brands List</p>

    <div class="px-2 sm:px-16">
        <form class="w-full mx-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" oninput="showSearchButtonToggole()" name="brandsSearch" id="default-search" class="block font-semibold w-full p-3 ps-10 text-medium text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
                <button id="searchButton" type="submit" class="hidden text-white absolute end-2 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </div>

    <?php if (!empty($searchQuery)) { ?>
    <p class="text-gray-700 dark:text-gray-300 mt-2">Found <?php echo $searchResultCount; ?> result(s) for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
<?php } ?>
         
    <?php 
    // require_once '../../models/database.php' ;
        $query = 'SELECT * FROM brand';
        $stmt = $pdo->prepare($query);
        $stmt->execute(); // Execute the query
        $brands = $stmt->fetchAll(); // Fetch all rows from the result set 
        ?>
    <div class="relative overflow-x-auto shadow-lg mt-3">
        <table class="w-full text-sm text-left rtl:text-right text-gray-50 dark:text-gray-400 rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-16 py-3 flex justify-center items-center">
                        Logo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Brand
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
    
                <?php
                        foreach ($brands as $brand) { ?> 
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="h-full py-3 flex justify-center items-center">
                                    <?php 
                                        if( $brand->image === "" ) {
                                            ?> <?php
                                        }
                                        else {
                                            ?>
                                            <img src="../../assets/brandsImages/<?php echo $brand->image; ?>" class="w-10 rounded-full md:w-10 max-w-full max-h-full">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $brand->name; ?>
                                </td>
                                <td class="px-6 py-2">
                                    <a href="../brands/editBrand.php?id=<?php echo $brand->brandID ?>">
                                        <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Edit</button>    
                                    </a>
                                    <a data-modal-target="popup-modal" data-modal-toggle="popup-modal" >
                                        <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php }
                ?>  
    
            </tbody>

        </table>
    </div>

    <!-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
Toggle modal
</button> -->

<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this item?</h3>
                <a href="../../models/backend/brands/deleteBrand.php?id=<?php echo $brand->brandID ?>">
                    <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                </a>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>
