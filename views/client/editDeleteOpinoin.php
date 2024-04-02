<?php
    require '../../models/database.php' ;
    session_start() ;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">


    <?php 
        $query = "SELECT * FROM opinion
                WHERE clientID = " . $_SESSION['client']->clientID ;
        $stmt = $pdo->prepare($query) ;
        $stmt->execute() ;
        $clientOpinion = $stmt->fetch() ;

        // var_dump($clientOpinion) ;
    ?>


    <div class=" flex items-center justify-between">
        <p class="text-3xl md:text-4xl font-meduim dark:text-white">Edit My Opinion</p>

        <a href="../../models/backend/client/deleteOpinion.php?id=<?php echo $clientOpinion->opinionID; ?>" >  
            <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Delete My Opinion</button>
        </a>
    </div>

    <section class="container mx-auto">
        
        <form action="../../models/backend/client/editOpinion.php" method="POST">

            <div class="sm:px-4 mt-10 sm:mt-7">
                <label for="opinion" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Your Opinion</label>
                <textarea name="opinionContent" id="opinion" rows="2" class="block p-2.5 w-full text-md font-semibold text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."> <?php echo $clientOpinion->content; ?> </textarea>
                <p id="error-message" class="text-red-500 font-semibold hidden"></p>
            </div>


            <p class="mt-5 sm:px-4 mb-2 text-2xl font-medium text-gray-900 dark:text-white">Rate us</p>
            <div class="flex  sm:px-4">
                

                <button class="flex-shrink-0 z-10 inline-flex items-center justify-center py-2.5 px-4 text-sm font-medium text-center bg-gray-100 border border-gray-300 rounded-s-lg dark:bg-gray-700 dark:border-gray-600" type="button">
                    <div class="text-3xl text-yellow-300 font-bold">★</div>
                </button>
                
                <label for="stars" class="sr-only">Rate us</label>
                <select name="rating" id="stars" class="bg-gray-50 border border-gray-300 text-yellow-300 text-xl rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="<?php $clientOpinion->rating; ?>">
                        <div>
                            <?php
                                for( $i = 0 ; $i < $clientOpinion->rating ; $i++ ) { ?>
                                    <div class="text-xl ">★</div>
                                <?php }
                            ?>
                           
                    </option>
                    <?php
                        $selectedRating = $clientOpinion->rating ?? ''; // Get the rating value from $clientOpinion or default to empty string

                        // Generate options for ratings from 1 to 5
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i == $selectedRating) {
                                continue; // Skip the selected rating
                            }

                            echo "<option value=\"$i\">";
                            // Generate stars
                            $stars = str_repeat("<div class=\"text-xl\">★</div>", $i);
                            echo $stars;
                            echo "</option>";
                        }
                    ?>
                    
                </select>
            </div>

            <input name="clientID" type="hidden" value="<?php echo $_SESSION['client']->clientID ?>">

            <div class="w-full flex items-end justify-end space-x-4 mt-5 px-4">
                <button id="opinionBtn" type="submit" name="editOpinion" class="hidden text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                    Edit Opinion
                </button>
                <a href="#" onclick="history.go(-1);">
                    <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Cancel</button>
                </a>
            </div>

        </form>

    </section>


    <script src="../JS/themeToggle.js"></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

    <script>

        

        const opinionButton = document.getElementById("opinionBtn") ;
        const opinionTextarea = document.getElementById('opinion');
        const errorMessage = document.getElementById('error-message');

        opinionTextarea.addEventListener('input', function() {
        const opinionLength = this.value.length;

        if (opinionLength < 5) {
            errorMessage.innerHTML = "Your opinion must be at least 5 characters." ;
            errorMessage.classList.remove('hidden');
            opinionButton.classList.add('hidden');
        }
        else if (opinionLength > 70) {
            errorMessage.innerHTML = "Your opinion must be less than 70 characters." ;
            errorMessage.classList.remove('hidden');
            opinionButton.classList.add('hidden') ;
        } else {
            errorMessage.classList.add('hidden');
            opinionButton.classList.remove('hidden') ;
        }
    });


    const selectElement = document.getElementById('stars');

        selectElement.addEventListener('change', function() {
            // Get the selected value
            const selectedValue = selectElement.value;

            if( selectedValue ) {
                opinionButton.classList.remove('hidden') ;
            }
            else {
                // Do something with the selected value
                opinionButton.classList.add('hidden') ;
            }
            
        });

    </script>

</body>
</html>