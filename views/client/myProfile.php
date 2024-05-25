<?php
    session_start() ;
    if( isset($_SESSION['client']) ) {
        include '../../models/database.php' ;
        
        // var_dump($_SESSION) ;
        $clientID = $_SESSION['client']->clientID;

        // echo $clientID;

        $query = "SELECT * FROM client
                WHERE clientID = ?" ;
        $stmt = $pdo->prepare($query) ;
        $stmt->execute([$clientID]) ;
        $client = $stmt->fetch() ;

        // var_dump($client) ;
    }
    else {
        header('location: login.php') ;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body class="p-4 bg-gray-300 dark:bg-gray-900 ">

    <p class="text-5xl font-semibold dark:text-white">Profile</p>
    
    <div class="mt-5 mb-5 container mx-auto">
        <div class="flex items-center gap-5">
            <div class="">
            <?php 
                if( $client->image !== "" ) { ?>
                    <div class="w-32 sm:w-36 ">
                            <img class="w-32 sm:w-36" src="../../assets/clientProfile/<?php echo $client->image ?>">
                    </div>
            <?php
                }
                else {
                    ?>
                    <img class="w-32 sm:w-36  " src="../../assets/clientProfile/unknownPP.jpg" >
                    <?php
                }
            ?>
            </div>
            <p class="font-semibold text-3xl sm:text-4xl dark:text-white"> <?php echo $client->firstName . " " . $client->lastName ; ?> </p>
        </div>

        

        <div class=" mt-5 ">
            <div class="sm:col-span-2 mb-2">
                <label class="block mb-1 text-md font-medium text-gray-900 dark:text-white">Email</label>
                <input type="text" value="<?php echo $client->email ; ?>"  readOnly class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>
            <div class="sm:col-span-2 mb-2">
                <label class="block mb-1 text-md font-medium text-gray-900 dark:text-white">Password</label>
                <input type="text" value="<?php echo $client->pass ; ?>" readOnly class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>
            <div class="sm:col-span-2 mb-2">
                <label class="block mb-1 text-md font-medium text-gray-900 dark:text-white">Phone Number</label>
                <input type="text" value="<?php echo $client->phoneNumber ; ?>" readOnly class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>
        </div>

    </div>

    <div class="flex justify-end container mx-auto mt-5 ">
        <a href="editProfile.php" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Edit Profile
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>


    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../JS/themeToggle.js"></script>
</body>
</html>