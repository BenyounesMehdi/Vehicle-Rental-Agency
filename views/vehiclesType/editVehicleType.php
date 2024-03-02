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
            <p class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">Edit a Vehicle Type</p>
            <form class=" ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="flex flex-col gap-4 sm:gap-4 sm:mb-3">

                <?php
                    // Get the selected Vehicle Type information to display them in the inputs
                    $id = $_GET['id'];
                    require '../../models/database.php';
                    $query = 'SELECT * FROM vehiclestype WHERE vehiclesTypeID=?';
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$id]);
                    $vehicleType = $stmt->fetch();

                    // var_dump($_POST) ;
                    if (isset($_POST['editVehicleType'])) {
                        $vehicleTypeName = $_POST['vehicleTypeName'];
                        $vehiclesTypeID = $_POST['id'] ;

                        if (empty($vehicleTypeName)) { // if the input is empty
                            $title = "Please, Fill The Vehicle Type Name";
                            include_once("../components/errorField.php");
                        } else {
                            require '../../models/database.php';
                           
                            // Update the Vehicle Type information in the database

                                    $query = 'UPDATE vehiclesType SET name=? WHERE vehiclesTypeID=?';
                                    $stmt = $pdo->prepare($query);
                                    $updated = $stmt->execute([$vehicleTypeName, $vehiclesTypeID]);
                                

                            if ($updated) {
                                // Redirect the user to the previous page
                                header('location: ../admin/vehiclesTypeSide.php');
                                exit; // Ensure that no further code is executed after the redirection
                            } else {
                                $title = "Error Occurred";
                                include_once("../components/errorField.php");
                            }
                        }
                    }
                ?>


                    <div class="sm:col-span-2 mb-2">
                        <input type="hidden" name="id" value="<?php echo $vehicleType->vehiclesTypeID ?>" class="">
                        <label for="name" class="block mb-2 text-medium font-medium text-gray-900 dark:text-white">Vehicle Type Name</label>
                        <input type="text" name="vehicleTypeName" id="name" oninput="checkInput()" value="<?php echo $vehicleType->name ?>" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                        <p id="errorMessage" class="text-red-500 ml-2 hidden">Please, Fill The Vehicle Type Name Input</p>
                    </div>
                    
                </div>
                <div class="flex items-center justify-end space-x-4">
                    <button id="editVehicleTyeBtn" type="submit" name="editVehicleType" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                        Edit Vehicle Type
                    </button>
                    <a href="../admin/vehiclesTypeSide.php">
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
            const editVehicleTyeBtn = document.getElementById("editVehicleTyeBtn") ;
            const errorMessage = document.getElementById("errorMessage") ;
            if( name.length <= 0 ) {
                errorMessage.classList.remove("hidden") ;
                editVehicleTyeBtn.classList.add("hidden") ;
            }
            else {
                errorMessage.classList.add("hidden") ;
                editVehicleTyeBtn.classList.remove("hidden") ;
            }
        }
    </script>
</body>
</html>

