<?php
    require_once '../../models/database.php' ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>

<style>


.black-top-border {
  border-top: 1px solid black;
}
</style>

<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">
    
<section class="">
        <div class="w-full ">
            <p class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">Add a Vehicle</p>

            <?php
                        
            
                        if (isset($_POST['addVehicle'])) {

                            // var_dump($_POST) ;
                            $vehicleName = $_POST['vehicleName'];
                            $brandID = $_POST['vehicleBrand'];
                            $vehiclesTypeID = $_POST['vehicleType'];
                            $modelYear = $_POST['modelYear'];
                            $costPerDay = $_POST['costPerDay'];
                            $vehicleStatus = $_POST['vehicleStatus'];
                            $vehicleImage = $_FILES['vehicleImage']['name'];

                            $query = 'SELECT * FROM admin';
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $admins = $stmt->fetchAll(); 
                            
                            foreach ($admins as $admin) {
                                $adminID = $admin->adminID;
                                // echo $adminID;
                            }

                            $date = date('Y-m-d');
                            // echo "Date : " . $date ;

                        
                            if (empty($vehicleName) || empty($brandID) || empty($vehiclesTypeID ) || empty($modelYear) || empty($costPerDay) || empty($vehicleStatus) || empty($_FILES['vehicleImage']['name']))  {
                                $title = "Please, Fill All The Inputs";
                                include_once("../components/errorField.php");
                            } else {
                        
                                // Check if the Vehicle name already exists in the database
                                $query = 'SELECT * FROM vehicle WHERE name = ?';
                                $stmt = $pdo->prepare($query);
                                $stmt->execute([$vehicleName]);
                                $existingVehicle = $stmt->fetch();
                        
                                if ($existingVehicle) {
                                    // Vehicle name already exists, display an error message
                                    $title = "The Vehicle Is Already Exists";
                                    include_once("../components/errorField.php");
                                } else {

                                   

                                    // Vehicle name does not exist, proceed with adding the brand

                                        $fileName = uniqid() . $vehicleImage;
                                        // Move the file from [tmp_name] into assets/brandsImages
                                        move_uploaded_file($_FILES['vehicleImage']['tmp_name'], '../../assets/vehiclesImages/' . $fileName);
                                        $query = 'INSERT INTO vehicle
                                                 (name, modelYear, costPerDay, vehicleStatus, image, creationDate, brandID, vehicleTypeID, adminID)
                                                  VALUES (?,?,?,?,?,?,?,?,?)';
                                        $stmt = $pdo->prepare($query);
                                        $inserted = $stmt->execute([$vehicleName, $modelYear, $costPerDay, $vehicleStatus, $fileName, $date, $brandID, $vehiclesTypeID, $adminID]);
                                  
                        
                                    if ($inserted) {
                                        // Redirect the user to the previous page
                                        header('location: ../admin/vehiclesSide.php');
                                        exit; // Ensure that no further code is executed after the redirection
                                    } else {
                                        $title = "Error Occurred";
                                        include_once("../components/errorField.php");
                                    }
                                }
                            }

                        }
                    ?>


            <form class=" ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="flex flex-col gap-3 ">

                        <div class="grid grid-cols-1  md:grid-cols-3 gap-2">
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Name</label>
                                <input type="text" name="vehicleName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>

                            <?php 
                                $query = 'SELECT * FROM brand';
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $brands = $stmt->fetchAll(); ?>

                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Brand</label>
                                    <select name="vehicleBrand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <?php
                                        foreach ($brands as $brand) { ?>
                                            <option value=" <?php echo $brand->brandID; ?> "> <?php echo $brand->name ?> </option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                
                                <?php 
                                $query = 'SELECT * FROM vehiclesType';
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $vehiclesType = $stmt->fetchAll(); ?>

                                <div class="w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Type</label>
                                    <select name="vehicleType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <?php
                                        foreach ($vehiclesType as $vehicleType) { ?>
                                            <option value=" <?php echo $vehicleType->vehiclesTypeID; ?>"> <?php echo $vehicleType->name ?> </option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                        </div>


                        <div class="grid grid-cols-1  md:grid-cols-3 gap-2">
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model Year</label>
                                <input id="modelYear" name="modelYear" oninput="checkYear()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1900" step="1" pattern="[0-9]{4}" placeholder="YYYY">
                                <div id="yearError" class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cost Per Day</label>
                                <input name="costPerDay" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1"  step="1" pattern="[0-9]{4}" placeholder="500 DA">
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Status</label>
                                <select name="vehicleStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="Available" selected>Available</option>
                                    <option value="Not Available">Not Available</option>
                                    <option value="Maitenance">Maitenance</option>
                                </select>
                            </div>
                        </div>

                        <div class="black-top-border dark:border-white mt-3">
                            <p class="dark:text-white mt-1 font-semibold text-xl">Additional Informations</p>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4   gap-2" >
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fuel Type</label>
                                <select name="fuelType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="gas" selected>Gas</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="electric">Electric</option>
                                    <option value="petrol">Petrol</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats Number</label>
                                <input name="seatsNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1"  step="1" >
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mileage</label>
                                <input name="mileAge" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1"  step="1" >
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transmission Type</label>
                                <select name="gearBox" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option value="manual" selected>Manual</option>
                                    <option value="automatic">Automatic</option>
                                    <option value="automated manual">Automated Manual</option>
                                </select>
                            </div>
                        </div>

                        </div>
                        
                        <div class="black-top-border dark:border-white mt-5">
                        </div>

                        <div class="w-full mb-3 mt-2">
                                <label class="block mb-2 text-medium font-medium text-gray-900 dark:text-white" for="multiple_files">Upload an Image</label>
                                <input type="file" name="vehicleImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files"  multiple>
                        </div>

                        

                            <div class="flex items-end justify-end space-x-4">
                                <button id="submitButton" type="submit" name="addVehicle" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                                    Add Vehicle
                                </button>
                                <a href="../admin/vehiclesSide.php">
                                    <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Cancel</button>
                                </a>
                            </div>
                        </form>
                 
    </section>

    <script src="../JS/themeToggle.js"></script>
    <script>
        function checkYear () {
            const submitButton = document.getElementById("submitButton") ;
            const modelYear = document.getElementById("modelYear").value ;
            const yearError = document.getElementById("yearError") ;
            const currentYear = new Date().getFullYear() ;

            if( modelYear < 1900 || modelYear > currentYear ) {
                yearError.innerHTML = "Please, enter a year between [1900-"+ currentYear +"]" ;
                yearError.classList.remove("hidden") ;
                submitButton.classList.add("hidden") ;
            }
            else {
                yearError.classList.add("hidden") ;
                submitButton.classList.remove("hidden") ;
            }
        }
    </script>
</body>
</html>

