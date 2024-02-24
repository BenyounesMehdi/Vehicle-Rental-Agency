<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">
    
<section class="">
        <div class="max-w-2xl">
            <p class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">Edit a Brand</p>
            <form class=" ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="flex flex-col gap-4 sm:gap-4 sm:mb-3">

                <?php
                    // Get the selected brand information to display them in the inputs
                    $id = $_GET['id'];
                    require '../../models/database.php';
                    $query = 'SELECT * FROM brand WHERE brandID=?';
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$id]);
                    $brand = $stmt->fetch();
                    // var_dump($brand);

                    if (isset($_POST['editBrand'])) {
                        $brandName = $_POST['brandName'];
                        $brandImage = $_FILES['brandImage']['name'];
                        $brandID = $_POST['id'] ;

                        if (empty($brandName)) { // if the input is empty
                            $title = "Please, Fill The Brand Name";
                            include_once("../components/errorField.php");
                        } else {
                            require '../../models/database.php';
                            if (empty($brandImage)) {
                                $fileName = "";
                            } else {
                                $fileName = uniqid() . $brandImage;
                                // Move the file from [tmp_name] into assets/brandsImages
                                move_uploaded_file($_FILES['brandImage']['tmp_name'], '../../assets/brandsImages/' . $fileName);
                                
                            }

                            // Update the brand information in the database
                            $query = 'UPDATE brand SET name=?, image=? WHERE brandID=?';
                            $stmt = $pdo->prepare($query);
                            $updated = $stmt->execute([$brandName, $fileName, $brandID]);

                            if ($updated) {
                                // Redirect the user to the previous page
                                header('location: ../admin/dashboard.php');
                                exit; // Ensure that no further code is executed after the redirection
                            } else {
                                $title = "Error Occurred";
                                include_once("../components/errorField.php");
                            }
                        }
                    }
                ?>


                    <div class="sm:col-span-2">
                        <?php 
                            if( $brand->image !== "" ) { ?>
                                <img src="../../assets/brandsImages/<?php echo $brand->image ?>" class="mb-2">
                            <?php
                            }
                        ?>
                        <input type="hidden" name="id" value="<?php echo $brand->brandID ?>" class="">
                        <input type="hidden" name="image" value="<?php echo $brand->image ?>">
                        <label for="name" class="block mb-2 text-medium font-medium text-gray-900 dark:text-white">Brand Name</label>
                        <input type="text" name="brandName" id="name" oninput="checkInput()" value="<?php echo $brand->name ?>" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                        <p id="errorMessage" class="text-red-500 ml-2 hidden">Please, Fill The Brand Name Input</p>
                    </div>
                    
                    <div class="w-full mb-2">
                        <label class="block mb-2 text-medium font-medium text-gray-900 dark:text-white" for="multiple_files">Upload an Image</label>
                        <input type="file" name="brandImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files"  multiple>
                    </div>
                </div>
                <div class="flex items-center justify-end space-x-4">
                    <button id="editBrandBtn" type="submit" name="editBrand" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                        Edit brand
                    </button>
                    <a href="../admin/dashboard.php">
                        <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Cancel</button>
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script src="../JS/themeToggle.js"></script>
    <script>
        function checkInput () {
            const name = document.getElementById("name").value ;
            const editBrandBtn = document.getElementById("editBrandBtn") ;
            const errorMessage = document.getElementById("errorMessage") ;
            if( name.length <= 0 ) {
                errorMessage.classList.remove("hidden") ;
                editBrandBtn.classList.add("hidden") ;
            }
            else {
                errorMessage.classList.add("hidden") ;
                editBrandBtn.classList.remove("hidden") ;
            }
        }
    </script>
</body>
</html>

