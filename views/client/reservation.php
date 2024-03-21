<?php
    session_start() ;
    if( !isset($_SESSION['client']) ) {
        header('Location: login.php');
    }
    else {
        require '../../models/database.php' ;
        require '../../models/functions.php' ;

        // Set the current client id
        $clientIID = $_GET['id'] ;
        // Set the current vehicle id
        $vehicleID = $_GET['vehicle'] ;

        // echo $clientIID ;
        // echo $vehicleID ;

        // Get the client data
        $query = "SELECT * FROM client
                 WHERE clientID = $clientIID" ;
        $stmt = $pdo->prepare($query) ;
        $stmt->execute() ;
        $client = $stmt->fetch() ;
        // var_dump($client) ;


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
        
    }
    
?>

        <?php 
        
            if( isset($_POST['reserve']) ) {
                $clientID = $POST['clientID'] ;
                $vehicleID = $POST['vehicleID'] ;


            }
        
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
         <p class="text-4xl font-meduim text-black dark:text-white mb-7">Create a New Reservation</p>
         
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

       
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="p-5 flex flex-col sm:flex-col justify-center items-center gap-2">

            <div class="flex flex-col sm:flex-row w-full gap-3">
                <div class="w-full">
                    <label for="pickupDate" class="text-xl text-black dark:text-white font-semibold italic">Pick up Date</label>
                    <div class="relative w-full mt-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input name="pickupDate" id="pickupDate" datepicker type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pick up date" readonly>
                    </div>
                    <p id="pickupDateMessage"  class="text-red-500 font-semibold dark:text-red-600">The chosen date is already past</p>
                </div>

                <div class="w-full">
                    <label for="returnDate" class="text-xl text-black dark:text-white font-semibold italic">Return Date</label>
                    <div class="relative w-full mt-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input name="returnDate" id="returnDate" datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Return date" readonly>
                    </div>
                    <p id="returnDateMessage" class="hidden text-red-500 font-semibold dark:text-red-600">Choose a day in the future</p>
                </div>

                <div class="w-full flex flex-col gap-2 ">
                    <p class="text-xl text-black dark:text-white font-semibold italic ">Total Days</p>
                    <div type="button" class="w-fit text-gray-900 bg-white font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 ">0</div>
                </div>
                <input type="hidden" name="duration" readonly >
            </div>

            
            <div class="w-full flex flex-col justify-center items-center mt-1">
                <label class="text-xl text-black dark:text-white font-semibold italic ">Total Cost</label>
                <p class="text-3xl text-green-600 font-semibold italic">2500 DA</p>
                <input type="hidden" name="totalCost" readonly class="font-semibold mt-1 outline-none border border-green-600 focus:border-green-600 bg-green-600 focus:ring-green-600 text-white italic rounded-lg block py-1.5 w-fit dark:bg-green-600 text-center text-xl " value="<?php echo $vehicle->costPerDay ?> DA">
            </div>

            <!-- HiDDEn INPUTS -->
                <input type="hidden" name="clientID" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="vehicleID" value="<?php echo $_GET['vehicle'] ?>">
            
        </div>
        <div class="w-full flex justify-center items-center mt-3 sm:px-3">
                <button id="reserveButton" name="reserve" type="submit" class="hidden w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                    Reserve Now
                </button>
            
        </div>
        
</form>
         

    </section>

    <script src="../JS/themeToggle.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>

    let pickupDateAuth = false;
    let returnDateAuth = false;

    reserveButtonToggole() ;

    // Function to log the chosen date to the console
    function logChosenDate() {
        setTimeout(function() {
            var pickupDate = document.getElementById("pickupDate").value;
            
            // Check if the input value is in a valid date format
            if (pickupDate.match(/^\d{2}\/\d{2}\/\d{4}$/)) {
                var dateParts = pickupDate.split("/"); // Split the date string into parts
                var inputDate = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]); // Construct a Date object
                console.log("Chosen date:", inputDate); // Log chosen date to console
                
                // Check if the chosen date is in the past
                var currentDate = new Date();

                var previousDate = new Date(currentDate);
                previousDate.setDate(currentDate.getDate() - 1);
                console.log("input date : ", inputDate) ;

                if (inputDate >= previousDate) {
                    document.getElementById("pickupDateMessage").style.display = "none"; 
                    // document.getElementById("reserveButton").style.display = "block"; 
                    pickupDateAuth = true ;
                } 
                else {
                    // document.getElementById("reserveButton").style.display = "none"; 
                    pickupDateAuth = false ;
                    document.getElementById("pickupDateMessage").style.display = "block"; 
                }
            } else {
                console.log("Invalid date format:", pickupDate); // Log invalid date format
            }
            reserveButtonToggole() ;
        }, 50); // Adjust the delay as needed (in milliseconds)
    }

    // Function to check if the chosen date is in the past
    function checkPickupDate() {
        var inputDate = new Date(document.getElementById("pickupDate").value);
        var currentDate = new Date();

        // If inputDate is in the past
        if (inputDate < currentDate) {
            document.getElementById("pickupDateMessage").style.display = "block"; // Show message
            pickupDateAuth = false ;
        } else {
            document.getElementById("pickupDateMessage").style.display = "none"; // Hide message
            // document.getElementById("reserveButton").style.display = "block"; // Show message
            pickupDateAuth = true ;
        }
        reserveButtonToggole() ;
    }

    // Add event listeners to input field
    document.getElementById("pickupDate").addEventListener("focus", logChosenDate); // Listen for focus event
    document.getElementById("pickupDate").addEventListener("input", checkPickupDate);

    // Call checkPickupDate() initially to check the date when the page loads
    checkPickupDate();






    // Function to log the chosen date to the console
    function logChosenReturnDate() {
        setTimeout(function() {
            var returnDate = document.getElementById("returnDate").value;
            
            // Check if the input value is in a valid date format
            if (returnDate.match(/^\d{2}\/\d{2}\/\d{4}$/)) {
                var dateParts = returnDate.split("/"); // Split the date string into parts
                var inputDate = new Date(dateParts[2], dateParts[0] - 1, dateParts[1]); // Construct a Date object
                console.log("Chosen date:", inputDate); // Log chosen date to console
                
                // Check if the chosen date is in the past
                var currentDate = new Date();

                if (inputDate >= currentDate) {
                    document.getElementById("returnDateMessage").style.display = "none"; 
                    // document.getElementById("reserveButton").style.display = "block"; 
                    returnDateAuth = true ;
                } 
                else {
                    // document.getElementById("reserveButton").style.display = "none"; 
                    returnDateAuth = false ;
                    document.getElementById("returnDateMessage").style.display = "block"; 
                }
            } else {
                console.log("Invalid date format:", returnDate); // Log invalid date format
            }
            reserveButtonToggole() ;
        }, 50); // Adjust the delay as needed (in milliseconds)
    }

    // Function to check if the chosen date is in the past
    function checkReturnDate() {
        var inputDate = new Date(document.getElementById("returnDate").value);
        var currentDate = new Date();

        // If inputDate is in the past
        if (inputDate < currentDate) {
            document.getElementById("returnDateMessage").style.display = "block"; // Show message
            returnDateAuth = false ;
        } else {
            document.getElementById("returnDateMessage").style.display = "none"; // Hide message
            // document.getElementById("reserveButton").style.display = "block"; // Show message
            returnDateAuth = true ;
        }
        reserveButtonToggole() ;
    }

    // Add event listeners to input field
    document.getElementById("returnDate").addEventListener("focus", logChosenReturnDate); // Listen for focus event
    document.getElementById("returnDate").addEventListener("input", checkReturnDate);

    // Call checkPickupDate() initially to check the date when the page loads
    checkReturnDate();


    setInterval(() => {
        // reserveButtonToggole() ;
    }, 0);

    function reserveButtonToggole() {
        const reserveButton = document.getElementById("reserveButton") ;

        if( pickupDateAuth && returnDateAuth ) {
            console.log("pickupDate : ", pickupDateAuth) ;
            console.log("returnDate : ", returnDateAuth) ;
            reserveButton.classList.remove("hidden") ;
        }
        else {
            console.log("pickupDate : ", pickupDateAuth) ;
            console.log("returnDate : ", returnDateAuth) ;
            reserveButton.classList.add("hidden") ;
        }
    }
    reserveButtonToggole() ;




    

    // Function to log the chosen return date to the console and check if it's in the past
    // function logChosenReturnDate() {
    //     setTimeout(function() {
    //         var returnDateInput = document.getElementById("returnDate").value;
            
    //         // Check if the input value is in a valid date format
    //         if (returnDateInput.match(/^\d{2}\/\d{2}\/\d{4}$/)) {
    //             var returnDateParts = returnDateInput.split("/"); // Split the return date string into parts
    //             var returnInputDate = new Date(returnDateParts[2], returnDateParts[0] - 1, returnDateParts[1]); // Construct a Date object
    //             console.log("Chosen return date:", returnInputDate); // Log chosen return date to console
                
    //             // Check if the chosen return date is in the past
    //             var currentDate = new Date();
    //             if (returnInputDate < currentDate) {
    //                 document.getElementById("returnDateMessage").style.display = "block";
    //                 document.getElementById("reserveButton").style.display = "none";  
    //             } else {
    //                 document.getElementById("returnDateMessage").style.display = "none";
    //                 document.getElementById("reserveButton").style.display = "block";  
    //             }
    //         } else {
    //             console.log("Invalid return date format:", returnDateInput); // Log invalid return date format
    //         }
    //     }, 50); // Adjust the delay as needed (in milliseconds)
    // }

    // // Add event listener to return date input field
    // document.getElementById("returnDate").addEventListener("focus", logChosenReturnDate); // Listen for focus event

    // // Call logChosenReturnDate() initially to check the return date when the page loads
    // logChosenReturnDate();

</script>
</script>

    </script>

</body>
</html>