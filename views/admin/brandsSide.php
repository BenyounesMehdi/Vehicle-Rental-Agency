<?php
    session_start() ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
    
</head>
<body>
    

        <?php include '../components/sidebar.php' ; ?>
        
        <div class="p-4 sm:ml-64 bg-gray-300 dark:bg-gray-900 h-screen" id="content-container">
            <div class="flex justify-end items-end mb-2 mr-3">
                <a href="../brands/addbrand.php" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add a Brand
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
            <?php include '../brands/brandsList.php' ; ?>
            
        </div>

    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../JS/themeToggle.js"></script>
    <script src="../JS/brandsSearch.js"></script>
    <script>
        
        function showSearchButtonToggole () {
            const searchInputValue = document.getElementById("default-search").value ;
            const searchButton = document.getElementById("searchButton") ;
            const brandsTable = document.getElementById("brandsTable") ;
            const brandsList = document.getElementById("brandsTable") ;
            
            if( searchInputValue.length > 0 ) {
                // searchButton.classList.remove("hidden") ;

                brandsList.classList.remove("hidden") ;
                brandsTable.classList.add("hidden") ;
            }
            else {
                // searchButton.classList.add("hidden") ;

                brandsList.classList.add("hidden") ;
                // brandsTable.classList.remove("hidden") ;
            }
        }

        function closeModel() {
                const cancelButton = document.getElementById("cancelButton") ;
                const popupModal = document.getElementById("popup-modal") ;
                popupModal.classList.add("hidden") ;
            }

    </script>
</body>
</html>
