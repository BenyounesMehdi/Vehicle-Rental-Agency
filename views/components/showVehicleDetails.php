<?php
    session_start() ;
    include_once '../../models/database.php' ;
    $id = $_GET['id'] ;

    $query = "SELECT v.*, v.name as vehicleName, b.name as brandName, v.image as vehicleImage 
        FROM vehicle v
        JOIN brand b
        ON v.brandID = b.brandID
        WHERE vehicleID = $id" ;
    $stmt = $pdo->prepare($query) ;
    $stmt->execute() ;
    $vehicle = $stmt->fetch() ;
    // var_dump($vehicle) ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<style>


.black-bottom-border {
  border-bottom: 2px solid black;
  border-radius: 4px;
}
</style>
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">

        <div class="container mx-auto p-2 mt-5">
            <div class="flex justify-center items-center w-fit ">
                <img src="../../assets/vehiclesImages/<?php echo $vehicle->vehicleImage ?>" class="mb-2 w-72">
            </div>
            <div class="p-2 mt-0  flex justify-center items-center gap-8 flex-col md:flex-row ">
                <div class="flex flex-col ">
                    <div class="black-bottom-border dark:border-white" >
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Name : <span class="text-xl text-blue-600 font-medium italic "><?php echo $vehicle->vehicleName; ?></span> </p>
                    </div>
                    <div class="black-bottom-border dark:border-white">
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Brand : <span class="text-xl text-blue-600 font-medium italic"><?php echo $vehicle->brandName; ?></span> </p>
                    </div>
                    <div class="black-bottom-border dark:border-white">
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Model Year : <span class="text-xl text-blue-600 font-medium italic"><?php echo $vehicle->modelYear; ?></span> </p>
                    </div>
                    <div class="black-bottom-border dark:border-white">
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Cost Per Day : <span class="text-xl text-blue-600 font-medium italic"><?php echo $vehicle->costPerDay; ?> DA</span> </p>
                    </div>
                </div>
                <div class="flex flex-col "> 
                <div class="black-bottom-border <?php echo $vehicle->fuelType == '' ? 'hidden' : 'visible'; ?> dark:border-white">
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Fuel Type : <span class="text-xl text-blue-600 font-medium italic "><?php echo $vehicle->fuelType; ?></span> </p>
                    </div>
                    <div class="black-bottom-border dark:border-white">
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Mileage (Km) : <span class="text-xl text-blue-600 font-medium italic "><?php echo $vehicle->mileage; ?></span> </p>
                    </div>
                    <div class="black-bottom-border dark:border-white <?php echo $vehicle->gearBox == '' ? 'hidden' : 'visible'; ?>">
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Gearbox : <span class="text-xl text-blue-600 font-medium italic "><?php echo $vehicle->gearBox; ?></span> </p>
                    </div>
                    <div class="black-bottom-border dark:border-white">
                        <p class="text-2xl text-black dark:text-white font-semibold mb-1">Seats Number : <span class="text-xl text-blue-600 font-medium italic "><?php echo $vehicle->seatsNumber; ?></span> </p></div>
                    </div>
                    <!-- <p class="text-2xl text-black dark:text-white font-semibold mb-1">Status : <span class="text-xl font-medium italic <?php echo ($vehicle->vehicleStatus == 'Available') ? 'text-green-500' : (($vehicle->vehicleStatus == 'Not Available') ? 'text-red-500' : 'text-blue-500'); ?>" <?php echo $vehicle->vehicleStatus ; ?> "><?php echo $vehicle->vehicleStatus; ?></span> </p> -->
                </div>  
            <?php 
                if( $vehicle->vehicleStatus == "Available" ) {
                    if( isset($_SESSION['client']) ) {
                        ?>
                            <div class="w-full flex justify-center items-center mt-6 sm:px-3">
                                <a href="../client/reservation.php?id=<?php echo $_SESSION['client']->clientID; ?>&vehicle=<?php echo $vehicle->vehicleID; ?>" class="w-full">
                                    <button class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                                        Reserve Now
                                    </button>
                                </a>
                            </div>
                        <?php
                    }
                    else if( !(isset($_SESSION['admin'])) ) {
                        ?>
                            <div class="w-full flex justify-center items-center mt-6 sm:px-3">
                                <a href="../../../VehicleRentalAgency/views/client/login.php" class="w-full">
                                    <button class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                                        Reserve Now
                                    </button>
                                </a>
                            </div>
                        <?php
                    }
                    
                }
                else {
                    ?>
                        <p class="font-semibold text-4xl text-center mt-10 <?php echo ($vehicle->vehicleStatus == 'Available') ? 'text-green-500' : (($vehicle->vehicleStatus == 'Not Available') ? 'text-red-500' : 'text-blue-500'); ?>"> <?php echo $vehicle->vehicleStatus ; ?> </p>
                    <?php
                }
            ?>
        </div>

    <script src="../JS/themeToggle.js"></script>
</body>
</html>
