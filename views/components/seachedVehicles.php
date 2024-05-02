<?php   
    session_start() ;
    include '../../models/database.php' ;

    // var_dump($_SESSION['dates']) ;
    $pickupDate = $_SESSION['dates']['pickupDate'];
    $returnDate = $_SESSION['dates']['returnDate'];
    
    // echo "pickupData : " . $pickupDate . "<br>";
    // echo "returnDate : " . $returnDate . "<br>";
    
    $pickupDateAfterFormat = DateTime::createFromFormat('m/d/Y', $pickupDate)->format('Y-m-d');
    $returnDateAfterFormat = DateTime::createFromFormat('m/d/Y', $returnDate)->format('Y-m-d');
    
    // echo "pickupData after format : " . $pickupDateAfterFormat . "<br>";
    // echo "returnDate after format : " . $returnDateAfterFormat . "<br>";

    $vehicleType = $_SESSION['dates']['vehicleType'];
    $brand = $_SESSION['dates']['brand'];
    // var_dump($_POST) ;
    
    if( empty($vehicleType) && empty($brand) ) {
        // echo "Both are empty" ;
        $query = "SELECT DISTINCT v.*, v.name AS vehicleName, v.image AS vehicleImage
                FROM vehicle v
                WHERE v.vehicleID NOT IN (
                    SELECT r.vehicleID 
                    FROM reservation r
                    WHERE (r.pickupDate <= ? AND r.returnDate >= ?)
                ) AND v.vehicleStatus = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$pickupDate, $returnDate, 'Available']);
        $vehicles = $stmt->fetchAll();

    }
    else if( !empty($vehicleType) && empty($brand) ) {
        // echo "Brand is Empty" ;
        $query = "SELECT DISTINCT v.*, v.name AS vehicleName, v.image AS vehicleImage
                FROM vehicle v
                WHERE v.vehicleID NOT IN (
                    SELECT r.vehicleID 
                    FROM reservation r
                    WHERE (r.pickupDate <= ? AND r.returnDate >= ?)
                ) 
                AND v.vehicleStatus = ?
                AND v.vehicleTypeID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$pickupDate, $returnDate, 'Available', $vehicleType]);
        $vehicles = $stmt->fetchAll();

    }
    else if( !empty($brand) && empty($vehicleType) ) {
        // echo "VehicleType is Empty" ;
        $query = "SELECT DISTINCT v.*, v.name AS vehicleName, v.image AS vehicleImage
                FROM vehicle v
                WHERE v.vehicleID NOT IN (
                    SELECT r.vehicleID 
                    FROM reservation r
                    WHERE (r.pickupDate <= ? AND r.returnDate >= ?)
                ) 
                AND v.vehicleStatus = ?
                AND v.brandID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$pickupDate, $returnDate, 'Available', $brand]);
        $vehicles = $stmt->fetchAll();
    }
    else {
        // echo "All fields are filled" ;
        $query = "SELECT DISTINCT v.*, v.name AS vehicleName, v.image AS vehicleImage
                FROM vehicle v
                WHERE v.vehicleID NOT IN (
                    SELECT r.vehicleID 
                    FROM reservation r
                    WHERE (r.pickupDate <= ? AND r.returnDate >= ?)
                ) 
                AND v.vehicleStatus = ?
                AND v.vehicleTypeID = ?
                AND v.brandID = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$pickupDate, $returnDate, 'Available',$vehicleType, $brand]);
        $vehicles = $stmt->fetchAll();
    }

    $numRows = $stmt->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body class="bg-white dark:bg-gray-900 ">


<div class="container mx-auto  flex justify-start ">
    <div class="mt-2 ml-3 flex p-2 text-blue-700 relative top-4 bg-blue-100 border border-blue-300 rounded-lg dark:bg-gray-800 dark:border-blue-800 dark:text-blue-400" >
        <div class="flex items-center justify-between ">
            <h3 class="font-medium">Total Number : <?php echo $numRows ?></h3>
        </div>
    </div>

</div> 
    
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 px-5 py-8">

    
        <?php
        if( $numRows > 0 ) {
                foreach ($vehicles as $vehicle) {
                    ?>
                        <div class="card p-2 flex flex-col justify-between relative bg-white border border-gray-300 rounded-lg shadow hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h2 class="text-black dark:text-white text-center"> <?php echo $vehicle->vehicleName; ?> </h2>
                            <p class="font-semibold text-green-500 text-center italic"> <?php echo $vehicle->costPerDay; ?> DA </p>
                                <div class="flex justify-center items-center ">
                                    <img class="w-56" src="../../assets/vehiclesImages/<?php echo $vehicle->vehicleImage; ?>" draggable="false">
                                </div>
                                <p class="font-semibold  text-center text-xl <?php echo ($vehicle->vehicleStatus == 'Available') ? 'text-green-500' : (($vehicle->vehicleStatus == 'Not Available') ? 'text-red-500' : 'text-blue-500'); ?>"> <?php echo $vehicle->vehicleStatus ; ?> </p>
                                
                                <div class=" flex flex-col justify-center items-center gap-1">
                                     <?php 
                                                
                                                // The Reserve Now Button Should Not Appear When The User Is The Admin
                                                    if( !isset($_SESSION['admin']) ) {
                                                    // The client should be singed in to go to the reservation page
                                                    if( isset($_SESSION['client']) ) {
                                                        if( $vehicle->vehicleStatus == 'Available' ) {
                                                        ?>
                                                            <a href="../../../VehicleRentalAgency/views/client/reservation.php?id=<?php echo $_SESSION['client']->clientID; ?>&vehicle=<?php echo $vehicle->vehicleID; ?>" class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 me-2 mt-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> Reserve Now </a>
                                                        <?php
                                                        }
                                                    }
                                                    else {
                                                        if( $vehicle->vehicleStatus == 'Available' ) {
                
                                                        ?>
                                                            <a href="../../../VehicleRentalAgency/views/client/login.php" class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 me-2 mt-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> Reserve Now </a>
                                                                        <?php
                                                        }
                                                    }
                                                                    
                                                    }
                                                ?>
                                                <a href="../../../VehicleRentalAgency/views/components/showVehicleDetails.php?id=<?php echo $vehicle->vehicleID ?>" class="text-black dark:text-white hover:underline font-light text-sm mt-0">Show Details</a>
                                                <!-- <a href="../../../VehicleRentalAgency/views/components/searchedVehicleDetails.php?id=<?php echo $vehicle->vehicleID ?>" class="text-black dark:text-white hover:underline font-light text-sm mt-0">Show Details</a> -->
                                </div>

                        </div>
                    <?php
                }
            }
            else {
                ?>
                    <p class="font-semibold text-3xl dark:text-white">No Results</p>
                <?php
            }
        ?>
            

    </div>


    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../JS/themeToggle.js"></script>
</body>
</html>