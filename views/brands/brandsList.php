<p class="mb-3 text-2xl font-semibold text-gray-900 dark:text-white">Brands List</p>

    <div class="px-2 sm:px-16">
        <form class="w-full mx-auto">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" name="brandsSearch" id="default-search" class="block font-semibold w-full p-3 ps-10 text-medium text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
                <button type="submit" class="text-white absolute end-2 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
    </div>

         
    <?php 
    require_once '../../models/database.php' ;
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
                                <td class="h-full py-2 flex justify-center items-center">
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
                                    <a href="">
                                        <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Edit</button>    
                                    </a>
                                    <a href="../../models/backend/brands/deleteBrand.php?id=<?php echo $brand->brandID ?>" onclick="return confirm('Do you really want to delete this items?')">
                                        <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php }
                ?>  
    
            </tbody>

        </table>
    </div>