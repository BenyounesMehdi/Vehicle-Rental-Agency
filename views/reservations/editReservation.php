<?php
    session_start() ;
    
        require '../../models/database.php' ;
        require '../../models/functions.php' ;

        // Set the current reservation id
        $reservationID = $_GET['reservation'] ;
        // Set the current vehicle id
        $vehicleID = $_GET['vehicle'] ;


        // Get the reservation data
        $query = "SELECT * FROM reservation
                 WHERE reservationID = $reservationID" ;
        $stmt = $pdo->prepare($query) ;
        $stmt->execute() ;
        $reservation = $stmt->fetch() ;
        // var_dump($reservation) ;

        $dateTime = new DateTime($reservation->pickupDate);
        $pickupDate = $dateTime->format('m/d/Y');

        $dateTime = new DateTime($reservation->returnDate);
        $returnDate = $dateTime->format('m/d/Y');


        // Get the vehicle data
        // $vehicle = getData($pdo, 'vehicle') ;
        $query = "SELECT v.* , b.name as brandName
                  FROM vehicle v
                  JOIN brand b 
                  ON v.brandID = b.brandID 
                 WHERE vehicleID = $vehicleID" ;
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
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">

    <section class="container mx-auto ">
         <p class="text-4xl font-meduim text-black dark:text-white mb-7">Edit a Reservation</p>
         
         <div class="flex flex-col sm:flex-row justify-center items-center p-2 mb-2 sm:mb-5">
            <div class="flex justify-center items-center mr-8">
                    <img src="../../assets/vehiclesImages/<?php echo $vehicle->image ?>" class="mb-2 w-72">
            </div>
            <div class="p-2 mt-2 ml-8">
                    <p class="text-2xl text-black dark:text-white font-semibold mb-1">Name : <span class="text-xl text-blue-600 font-medium italic "><?php echo $vehicle->name; ?></span> </p>
                    <p class="text-2xl text-black dark:text-white font-semibold mb-1 ">Brand : <span class="text-xl text-blue-600 font-medium italic"><?php echo $vehicle->brandName; ?></span> </p>
                    <p class="text-2xl text-black dark:text-white font-semibold mb-1">Model Year : <span class="text-xl text-blue-600 font-medium italic"><?php echo $vehicle->modelYear; ?></span> </p>
                    <p class="text-2xl text-black dark:text-white font-semibold mb-1">Cost Per Day : <span class="text-xl text-blue-600 font-medium italic"><?php echo $vehicle->costPerDay; ?> DA</span> </p>
            </div>
         </div>

       
        <form action="../../models/backend/admin/editReservation.php" method="POST" class="p-5 flex flex-col sm:flex-col justify-center items-center gap-2">
            <input type="hidden" name="reservationID" value="<?php echo $reservation->reservationID; ?>">
            <div class="flex flex-col sm:flex-row w-full gap-3">
                <div class="w-full">
                    <label for="pickupDate" class="text-xl text-black dark:text-white font-semibold italic">Pick up Date</label>
                    <div class="relative w-full mt-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input name="pickupDate" id="pickupDate" datepicker value="<?php echo $pickupDate ?>" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pick up date" readonly>
                    </div>
                    <p id="pickupDateMessage"  class="hidden text-red-500 font-semibold dark:text-red-600">The chosen date is already past</p>
                </div>

                <div class="w-full">
                    <label for="returnDate" class="text-xl text-black dark:text-white font-semibold italic">Return Date</label>
                    <div class="relative w-full mt-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input name="returnDate" id="returnDate" datepicker value="<?php echo $returnDate ?>" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Return date" readonly>
                    </div>
                    <p id="returnDateMessage" class="hidden text-red-500 font-semibold dark:text-red-600">Choose a day in the future</p>
                </div>

                <div class="w-full flex flex-col gap-2 ">
                    <p class="text-xl text-black dark:text-white font-semibold italic ">Total Days</p>
                    <div id="totalDays" type="button" class="w-fit text-gray-900 bg-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 "><?php echo $reservation->duration; ?></div>
                </div>
                <input id="duration" type="hidden" value="<?php echo $reservation->duration ?>" name="duration" readonly >
            </div>

            
            <div class="w-full flex flex-col justify-center items-center mt-1">
                <label class="text-xl text-black dark:text-white font-semibold italic ">Total Cost</label>
                <p id="totalCost" class="text-3xl text-green-600 font-semibold italic"><?php echo $reservation->totalCost ?> DA</p>
                <input id="costPerDay" type="hidden" value="<?php echo $vehicle->costPerDay ?>">
                <input id="cost" type="hidden" name="totalCost" readonly >
            </div>

            <!-- HiDDEn INPUTS -->
                <input type="hidden" name="reservationID" value="<?php echo $_GET['reservation'] ?>">
                <input type="hidden" name="vehicleID" value="<?php echo $_GET['vehicle'] ?>">
            
        </div>
        <div class="w-full flex items-end justify-end space-x-4">
            <button id="editButton" type="submit" name="editReservation" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                Edit Reservation
            </button>
            <a href="../admin/reservationsSide.php">
                <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Cancel</button>
            </a>
        </div>
        
</form>
         

    </section>

    <script src="../JS/themeToggle.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- <script src="../JS/reservation.js"></script> -->

    <script>

let pickupDateAuth = false;
let returnDateAuth = false;

// Call reserveButtonToggole() initially to hide the button
reserveButtonToggole();

// Function to log the chosen date to the console and validate pickup date
function logChosenDate() {
    setTimeout(function() {
        var pickupDate = document.getElementById("pickupDate").value;
        
        // Check if the input value is in a valid date format
        if (pickupDate.match(/^\d{2}\/\d{2}\/\d{4}$/)) {
            var dateParts = pickupDate.split("/"); // Split the date string into parts
            var inputDate = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]); // Construct a Date object
            
            // Check if the chosen date is not in the past
            var currentDate = new Date();
            var previousDate = new Date(currentDate);
            previousDate.setDate(currentDate.getDate() - 1);

            if (inputDate >= previousDate) {
                document.getElementById("pickupDateMessage").style.display = "none"; 
                pickupDateAuth = true;
            } 
            else {
                pickupDateAuth = false;
                document.getElementById("pickupDateMessage").style.display = "block"; 
            }
        } else {
            // console.log("Invalid date format:", pickupDate); // Log invalid date format
        }
        reserveButtonToggole();
        updateTotalDays() ;
    }, 50); // Adjust the delay as needed (in milliseconds)
}

// Function to log the chosen date to the console and validate return date
function logChosenReturnDate() {
    setTimeout(function() {
        var returnDate = document.getElementById("returnDate").value;
        
        // Check if the input value is in a valid date format
        if (returnDate.match(/^\d{2}\/\d{2}\/\d{4}$/)) {
            var dateParts = returnDate.split("/"); // Split the date string into parts
            var inputDate = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]); // Construct a Date object
            
            // Check if the chosen date is not in the past
            var currentDate = new Date();
             var pickupDate = new Date(document.getElementById("pickupDate").value);
             var returnDate = new Date(document.getElementById("returnDate").value);
             dif = returnDate - pickupDate ;
            // console.log(dif) ;

            if (inputDate >= currentDate && dif > 0) {
                document.getElementById("returnDateMessage").style.display = "none"; 
                returnDateAuth = true;
            } 
            else {
                returnDateAuth = false;
                document.getElementById("returnDateMessage").style.display = "block"; 
            }
        } else {
            // console.log("Invalid date format:", returnDate); // Log invalid date format
        }
        reserveButtonToggole();
        updateTotalDays() ;
    }, 50); // Adjust the delay as needed (in milliseconds)
}

// Add event listeners to input fields
document.getElementById("pickupDate").addEventListener("focus", logChosenDate); // Listen for focus event
document.getElementById("pickupDate").addEventListener("input", logChosenDate); // Listen for input event
document.getElementById("returnDate").addEventListener("focus", logChosenReturnDate); // Listen for focus event
document.getElementById("returnDate").addEventListener("input", logChosenReturnDate); // Listen for input event

// Function to toggle reserve button visibility
function reserveButtonToggole() {
    var editButton = document.getElementById("editButton");

    if (pickupDateAuth && returnDateAuth) {
        editButton.classList.remove("hidden");
    } else {
        editButton.classList.add("hidden");

    }
}

    // Function to update total days
function updateTotalDays() {
    var pickupDate = new Date(document.getElementById("pickupDate").value);
    var returnDate = new Date(document.getElementById("returnDate").value);

    if (pickupDateAuth && returnDateAuth && pickupDate < returnDate) {
        var timeDiff = Math.abs(returnDate.getTime() - pickupDate.getTime());
        var totalDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Calculate difference in days
        // console.log(totalDays) ;
        document.getElementById("totalDays").innerHTML = totalDays;
        document.getElementById("duration").value = totalDays ;
    } else {
        document.getElementById("totalDays").innerHTML = "0";
        reserveButton.classList.add("hidden");
        // console.log(totalDays) ;
    }
    updateTotalCost();
}

// Function to update total cost
function updateTotalCost() {
    var totalDays = parseInt(document.getElementById("totalDays").innerText);
    var costPerDay = parseInt(document.getElementById("costPerDay").value);
    var totalCost = totalDays * costPerDay;
    document.getElementById("totalCost").innerHTML = totalCost + " DA";
    document.getElementById("cost").value = totalCost ;
}

// Call updateTotalCost() initially
updateTotalCost();

    </script>
    
</body>
</html>