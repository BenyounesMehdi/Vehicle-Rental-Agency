<?php
   
    $query = "SELECT vehicleStatus
          FROM vehicle";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $vehicles = $stmt->fetchAll();

       $table = 'vehicle' ;
       $totalVehicles = countRableRows($pdo, $table) ;

    // var_dump($vehicles) ;

$availableCount = 0;
$maintenanceCount = 0;
$reservedCount = 0;

// Loop through the array of vehicles
foreach ($vehicles as $vehicle) {
    switch ($vehicle->vehicleStatus) {
        case "Available":
            $availableCount += 1;
            break;
        case "Maitenance":
            $maintenanceCount += 1;
            break;
        case "Not Available":
            $reservedCount += 1;
            break;
    }
}

        // echo "Number of Available vehicles: $availableCount <br>";
        // echo "Number of Maintenance vehicles: $maintenanceCount <br>";
        // echo "Number of Not Available vehicles: $reservedCount <br>";

    
?>

<div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4">
    <div class="flex justify-between mb-3">
        <div class="flex items-center">
            <div class="flex justify-start ">
                <p class="text-black dark:text-white text-4xl font-semibold">Vehicles Status</p>
            </div>
        </div>
    </div>

   <div class="bg-gray-300 dark:bg-gray-700 p-3 rounded-lg mb-2">
        <div class="grid grid-cols-3 gap-3 mb-2">

            <dl class="bg-red-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                <dt class="w-8 h-8 rounded-full bg-red-200 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1"> <?php echo $reservedCount ; ?> </dt>
                <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Reserved</dd>
            </dl>

            <dl class="bg-teal-100 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                <dt class="w-8 h-8 rounded-full bg-green-200 dark:bg-gray-500 text-teal-600 dark:text-green-200 text-sm font-medium flex items-center justify-center mb-1"> <?php echo $availableCount ; ?> </dt>
                <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Available</dd>
            </dl>

            <dl class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                <dt class="w-8 h-8 rounded-full bg-blue-200 dark:bg-gray-500 text-blue-600 dark:text-blue-500 text-sm font-medium flex items-center justify-center mb-1"><?php echo $maintenanceCount ; ?></dt>
                <dd class="text-blue-600 dark:text-blue-500 text-sm font-medium">Maintenance</dd>
            </dl>

        </div>
    </div>

    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Vehicles <?php echo $totalVehicles; ?></p>
</div>