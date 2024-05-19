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
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">
    
<section class="">
        <div class="w-full ">
            <p class="text-2xl font-semibold text-gray-900 dark:text-white">Edit a Vehicle</p>


            <?php
                        $existingVehicle = "" ;
                        // Get the selected brand information to display them in the inputs
                            $id = $_GET['id'];
                            require '../../models/database.php';
                            // $query = 'SELECT * FROM vehicle WHERE vehicleID=?';
                            $query = "SELECT v.*, b.name as brandName, b.brandID as brandID,
                                             vt.name as vehicleTypeName, vt.vehiclesTypeID as vehicleTypeID
                            FROM vehicle v
                            JOIN brand b ON v.brandID = b.brandID
                            JOIN vehiclesType vt ON v.vehicleTypeID = vt.vehiclesTypeID
                            WHERE vehicleID=?" ;
                            $stmt = $pdo->prepare($query);
                            $stmt->execute([$id]);
                            $vehicle = $stmt->fetch();
                            
                        if (isset($_POST['editVehicle'])) {

                            // var_dump($_POST) ;
                            $vehicleName = $_POST['vehicleName'];
                            $brandID = $_POST['vehicleBrand'];
                            $vehiclesTypeID = $_POST['vehicleType'];
                            $modelYear = $_POST['modelYear'];
                            $costPerDay = $_POST['costPerDay'];
                            $vehicleStatus = $_POST['vehicleStatus'];
                            $fuelType = $_POST['fuelType'];
                            $seatsNumber = $_POST['seatsNumber'];
                            $mileAge = $_POST['mileAge'];
                            $gearBox = $_POST['gearBox'];
                            $vehicleImage = $_FILES['vehicleImage']['name'];
                            $vehicleID = $_POST['id'] ;

                            var_dump($_POST) ;

                                    if (empty($vehicleImage)) {
                                        $fileName = "";
                                    } else {
                                        $fileName = uniqid() . $vehicleImage;
                                        // Move the file from [tmp_name] into assets/brandsImages
                                        move_uploaded_file($_FILES['vehicleImage']['tmp_name'], '../../assets/vehiclesImages/' . $fileName);
                                        
                                    }

                                    // Vehicle name does not exist, proceed with adding the brand

                                    if( !empty($vehicleImage) ) {
                                     // A new image is uploaded, replace the existing image
                                        $query = 'UPDATE vehicle SET 
                                            name=?, modelYear=?, costPerDay=?, vehicleStatus=?,
                                            fuelType=?, mileage=?, gearBox=?, seatsNumber=?,
                                            image=?, brandID=?, vehicleTypeID=? WHERE vehicleID=?';
                                        $stmt = $pdo->prepare($query);
                                        $updated = $stmt->execute([$vehicleName, $modelYear, $costPerDay,
                                            $vehicleStatus, $fuelType, $mileAge, $gearBox, $seatsNumber, $fileName, $brandID, $vehiclesTypeID, $vehicleID]);
                                    }
                                    else {
                                        // No new image uploaded, retain the existing image
                                        $query = 'UPDATE vehicle SET 
                                            name=?, modelYear=?, costPerDay=?, vehicleStatus=?,
                                            fuelType=?, mileage=?, gearBox=?, seatsNumber=?,
                                             brandID=?, vehicleTypeID=? WHERE vehicleID=?';
                                        $stmt = $pdo->prepare($query);
                                        $updated = $stmt->execute([$vehicleName, $modelYear, $costPerDay,
                                            $vehicleStatus, $fuelType, $mileAge, $gearBox, $seatsNumber, $brandID, $vehiclesTypeID, $vehicleID]);
                                    }

                                       

                        
                                    if ($updated) {
                                        // Redirect the user to the previous page
                                        header('location: ../admin/vehiclesSide.php');
                                        exit; // Ensure that no further code is executed after the redirection
                                    } else {
                                        $title = "Error Occurred";
                                        include_once("../components/errorField.php");
                                    }
                                
                            

                        }
                    ?>

            <div class="flex justify-center items-center">
                <img src="../../assets/vehiclesImages/<?php echo $vehicle->image ?>" class="mb-2 w-72">
            </div>                  
                            


            <form class=" ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $vehicle->vehicleID ?>" class="">
                <input type="hidden" name="image" value="<?php echo $vehicle->image ?>">

                <div class="flex flex-col gap-3">

                        <div class="grid grid-cols-1  md:grid-cols-3 gap-2">
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Name</label>
                                <input type="text" id="vehicleName" oninput="checkName()" name="vehicleName" value="<?php echo $vehicle->name ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <p id="nameErroMessage" class="text-red-500 ml-2 hidden">Please, Fill The Vehicle Name Input</p>
                            </div>

                            <?php 
                                $query = 'SELECT * FROM brand';
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $brands = $stmt->fetchAll(); ?>

                                <div class="w-full">
                                    
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Brand</label>
                                    <select name="vehicleBrand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        
                                        <option value=" <?php echo $vehicle->brandID; ?>"> <?php echo $vehicle->brandName ?> </option>
                                        <?php
                                        foreach ($brands as $brand) {
                                            if( $brand->name === $vehicle->brandName ) {
                                                continue ;
                                            }
                                            else {
                                                ?>
                                                <option value=" <?php echo $brand->brandID; ?>"> <?php echo $brand->name ?> </option>
                                                <?php
                                            }
                                            
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
                                    <?php ?>
                                        <option value=" <?php echo $vehicle->vehicleTypeID; ?>"> <?php echo $vehicle->vehicleTypeName ?> </option>
                                        <?php
                                        foreach ($vehiclesType as $vehicleType) {
                                            if( $vehicleType->name === $vehicle->vehicleTypeName ) {
                                                continue ;
                                            }
                                            else {
                                                ?>
                                                <option value=" <?php echo $vehicleType->vehiclesTypeID; ?>"> <?php echo $vehicleType->name ?> </option>
                                                <?php
                                            }
                                            
                                        }
                                    ?>
                                    </select>
                                </div>
                        </div>


                        <div class="grid grid-cols-1  md:grid-cols-3 gap-2">
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model Year</label>
                                <input id="modelYear" name="modelYear" value="<?php echo $vehicle->modelYear; ?>" oninput="checkYear()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1900" step="1" pattern="[0-9]{4}" placeholder="YYYY">
                                <div id="yearError" class="text-red-500 text-sm mt-1 hidden"></div>
                                <p id="modeYearErroMessage" class="text-red-500 ml-2 hidden">Please, Fill The Model Year Input</p>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cost Per Day</label>
                                <input name="costPerDay" id="costPerDay" oninput="checkCostPerDay()" value="<?php echo $vehicle->costPerDay; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1"  step="1" pattern="[0-9]{4}" placeholder="500 DA">
                                <p id="costPerDayErroMessage" class="text-red-500 ml-2 hidden">Please, Fill The Cost Per Day Input</p>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Status</label>
                                <select name="vehicleStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <?php 
                                        if( $vehicle->vehicleStatus === "Available" ) { ?>
                                            <option value="Available" selected>Available</option>
                                            <option value="Not Available">Not Available</option>
                                            <option value="Maitenance">Maitenance</option>
                                            <?php
                                        }
                                        else if( $vehicle->vehicleStatus === "Not Available" ) { ?>
                                            <option value="Available" >Available</option>
                                            <option value="Not Available" selected>Not Available</option>
                                            <option value="Maitenance">Maitenance</option>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <option value="Available" >Available</option>
                                            <option value="Not Available" >Not Available</option>
                                            <option value="Maitenance" selected>Maitenance</option>
                                            <?php
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4   gap-2" >
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fuel Type</label>
                                <select name="fuelType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <?php 
                                        if( $vehicle->fuelType === "gas" ) { ?>
                                            <option value=""></option>
                                            <option value="gas" selected>Gas</option>
                                            <option value="diesel">Diesel</option>
                                            <option value="electric">Electric</option>
                                            <option value="petrol">Petrol</option>
                                            <?php
                                        }
                                        else if( $vehicle->fuelType === "diesel" ) { ?>
                                            <option value=""></option>
                                            <option value="gas" >Gas</option>
                                            <option value="diesel" selected>Diesel</option>
                                            <option value="electric">Electric</option>
                                            <option value="petrol">Petrol</option>
                                            <?php
                                        }
                                        else if( $vehicle->fuelType === "electric" ) { ?>
                                            <option value=""></option>
                                            <option value="gas" >Gas</option>
                                            <option value="diesel" >Diesel</option>
                                            <option value="electric" selected>Electric</option>
                                            <option value="petrol">Petrol</option>
                                            <?php
                                        }
                                        else if( $vehicle->fuelType === "petrol" ) { ?>
                                            <option value=""></option>
                                            <option value="gas" >Gas</option>
                                            <option value="diesel" >Diesel</option>
                                            <option value="electric" selected>Electric</option>
                                            <option value="petrol">Petrol</option>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <option value="" selected></option>
                                            <option value="gas" >Gas</option>
                                            <option value="diesel" >Diesel</option>
                                            <option value="electric" >Electric</option>
                                            <option value="petrol">Petrol</option>
                                            <?php
                                        }
                                    ?>
                                
                                </select>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seats Number</label>
                                <input id="seatsNumber" name="seatsNumber" oninput="checkSeatsNumberInput()" value="<?php echo $vehicle->seatsNumber; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1"  step="1" >
                                <p id="seatsNumberErroMessage" class="text-red-500 ml-2 hidden">Please, Fill The Seats Number Input</p>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mileage</label>
                                <input id="mileAge" name="mileAge"  oninput="checkMileageInput()" value="<?php echo $vehicle->mileage; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" type="number" name="modelYear" min="1"  step="1" >
                                <p id="mileAgeErroMessage" class="text-red-500 ml-2 hidden">Please, Fill The Mileage Input</p>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transmission Type</label>
                                <select name="gearBox" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <?php 
                                        if( $vehicle->gearBox === "manual" ) { ?>
                                            <option value=""></option>   
                                            <option value="manual" selected>Manual</option>
                                            <option value="automatic">Automatic</option>
                                            <option value="automated manual">Automated Manual</option>
                                            <?php
                                        }
                                        else if( $vehicle->gearBox === "automatic" ) { ?>
                                            <option value=""></option>   
                                            <option value="manual" >Manual</option>
                                            <option value="automatic" selected>Automatic</option>
                                            <option value="automated manual">Automated Manual</option>
                                            <?php
                                        }
                                        else if( $vehicle->gearBox === "automated manual" ) { ?>
                                            <option value=""></option>   
                                            <option value="manual" >Manual</option>
                                            <option value="automatic" >Automatic</option>
                                            <option value="automated manual" selected>Automated Manual</option>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <option value="" selected></option>    
                                            <option value="manual">Manual</option>
                                            <option value="automatic">Automatic</option>
                                            <option value="automated manual">Automated Manual</option>
                                            <?php
                                        }
                                    ?>

                                    
                                </select>
                            </div>
                        </div>

                        </div>
                        
                        <div class="w-full mb-3 mt-2">
                                <label class="block mb-2 text-medium font-medium text-gray-900 dark:text-white" for="multiple_files">Upload an Image</label>
                                <input type="file" name="vehicleImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files"  multiple>
                        </div>

                            <div class="flex items-end justify-end space-x-4">
                                <button id="submitButton" type="submit" name="editVehicle" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                                    Edit Vehicle
                                </button>
                                <a href="../admin/vehiclesSide.php">
                                    <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Cancel</button>
                                </a>
                            </div>
                        </form>
                 
    </section>

    <script src="../JS/themeToggle.js"></script>
    <script>
        const submitButton = document.getElementById("submitButton") ;
        const seatsNumber = document.getElementById("seatsNumber") ;
        const mileAge = document.getElementById("mileAge") ;

        function checkSeatsNumberInput () {
            if( seatsNumber.value.length == 0 ) {
                document.getElementById("seatsNumberErroMessage").classList.remove("hidden") ;
                submitButton.classList.add("hidden") ;
            }
            else {
                document.getElementById("seatsNumberErroMessage").classList.add("hidden") ;
                submitButton.classList.remove("hidden") ;
            }
        }

        function checkMileageInput () {
            if( mileAge.value.length == 0 ) {
                document.getElementById("mileAgeErroMessage").classList.remove("hidden") ;
                submitButton.classList.add("hidden") ;
            }
            else {
                document.getElementById("mileAgeErroMessage").classList.add("hidden") ;
                submitButton.classList.remove("hidden") ;
            }
        }

        function checkYear () {
            
            const modelYear = document.getElementById("modelYear").value ;
            const yearError = document.getElementById("yearError") ;
            const modeYearErroMessage = document.getElementById("modeYearErroMessage") ;
            const currentYear = new Date().getFullYear() ;

            if( modelYear.length <= 0 ) {
                modeYearErroMessage.classList.remove("hidden") ;
                submitButton.classList.add("hidden") ;
            }

            else if( modelYear < 1900 || modelYear > currentYear ) {
                yearError.innerHTML = "Please, enter a year between [1900-"+ currentYear +"]" ;
                modeYearErroMessage.classList.add("hidden") ;
                yearError.classList.remove("hidden") ;
                submitButton.classList.add("hidden") ;
            }
            
            else {
                modeYearErroMessage.classList.add("hidden") ;
                yearError.classList.add("hidden") ;
                submitButton.classList.remove("hidden") ;
            }
        }

        function checkName () {
            const vehicleName = document.getElementById("vehicleName").value ;
            const nameErroMessage = document.getElementById("nameErroMessage") ;

            if( vehicleName.length <= 0 ) {
                nameErroMessage.classList.remove("hidden") ;
                submitButton.classList.add("hidden") ;
            }
            else {
                nameErroMessage.classList.add("hidden") ;
                submitButton.classList.remove("hidden") ;
            }
        }

        function checkCostPerDay () {
            const costPerDay = document.getElementById("costPerDay").value ;
            const costPerDayErroMessage = document.getElementById("costPerDayErroMessage") ;

            if( costPerDay.length <= 0 ) {
                costPerDayErroMessage.classList.remove("hidden") ;
                submitButton.classList.add("hidden") ;
            }
            else {
                costPerDayErroMessage.classList.add("hidden") ;
                submitButton.classList.remove("hidden") ;
            }
        }

    </script>
</body>
</html>

