<?php
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body>

    
    
    <section class="bg-gray-200 dark:bg-gray-900">
        <div class="max-w-2xl">
            <p class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">Add a Brand</p>
            <form class=" ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="flex flex-col gap-4 sm:gap-4 sm:mb-3">

                    <?php
                        if( isset($_POST['addBrand']) ) {
                            $brandName = $_POST['brandName'] ;
                            $brandImage = $_FILES['brandImage']['name'];
                            
                            if( empty($brandName) ) { // if the inputs are empty
                                $title ="Please, Fill The Brand Name" ;
                                include_once("../components/errorField.php");
                            }
                            else {
                                require_once '../../models/database.php' ;
                                if( empty($brandImage) ) {
                                    $fileName = "" ;
                                    $query = 'INSERT INTO brand (name) VALUES (?)' ;
                                    $stmt = $pdo->prepare($query) ;
                                    $inserted = $stmt->execute([$brandName]) ;
                                }
                                else {
                                    $fileName = uniqid().$brandImage ;
                                    // Move the file from [tmp_name] into assests/brandsImages
                                     move_uploaded_file($_FILES['brandImage']['tmp_name'], '../../assets/brandsImages/'. $fileName) ;
                                     $query = 'INSERT INTO brand (name, image) VALUES (?, ?)' ;
                                     $stmt = $pdo->prepare($query) ;
                                     $inserted = $stmt->execute([$brandName, $fileName]) ;
                                }

                                 if( $inserted ) {
                                    header( 'dashboard.php' ) ;
                                 }
                                 else {
                                    $title= "Error Occurred" ;
                                    include_once("../components/errorField.php");
                                 }
                             }
                        }
                    ?>

                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-2 text-medium font-medium text-gray-900 dark:text-white">Brand Name</label>
                        <input type="text" name="brandName" id="name" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                    </div>
                    
                    <div class="w-full mb-2">
                        <label class="block mb-2 text-medium font-medium text-gray-900 dark:text-white" for="multiple_files">Upload an Image</label>
                        <input type="file" name="brandImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files"  multiple>
                    </div>
                </div>
                <div class="flex items-center justify-end space-x-4">
                    <button type="submit" name="addBrand" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                        Add brand
                    </button>
                    <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Cancel</button>
                </div>
            </form>
        </div>
    </section>

    <hr class="w-full border-gray-500 dark:border-gray-500 mt-2 mb-2 border-1">


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
                    <img src="../../assets/brandsImages/<?php echo $brand['image']; ?>" class="w-10 rounded-full md:w-10 max-w-full max-h-full" alt="Brand Image">
                </td>
                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                    <?php echo $brand['name']; ?>
                </td>
                <td class="px-6 py-2">
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                        <button type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Edit</button>    
                        <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                    </a>
                </td>
            </tr>
        <?php }
    ?>  
</tbody>

        </table>
    </div>

    

</body>
</html>