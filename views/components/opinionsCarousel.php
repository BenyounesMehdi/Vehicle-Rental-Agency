<?php 
    include './models/database.php' ;

    $query = "SELECT o.*, c.firstName as firstName, c.lastName as lastName, c.image as image
        FROM opinion o
        JOIN client c
        ON o.clientID = c.clientID" ;

        $stmt = $pdo->prepare($query);
        $stmt->execute(); 
        $opinions = $stmt->fetchAll() ;

        // var_dump($opinions) ;

    // var_dump($opinions) ;
?>

<div id="opinions" class="container mx-auto  relative mb-10 p-4">

    <p class="dark:text-white font-semibold text-4xl text-center mb-7">What people are saying about us</p>

    
    <div id="indicators-carousel" class="w-full" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96  p-2">

            
            <?php 
                
                foreach ($opinions as $opinion) { 
                    $ratings = $opinion->rating;
                    $i = 0 ;
                    ?>
                    <div class="hidden  overflow-y-auto duration-700 ease-in-out bg-white border border-gray-300 rounded-lg shadow hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" data-carousel-item="active">
                    
                        <div class="flex justify-center items-center mt-10">

                        <?php 
                                    if ($opinion->image == "") {
                                        ?>
                                        <img class="w-8 h-8" src="./assets/clientProfile/unknownPP.jpg">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="w-10 h-10" src="./assets/clientProfile/<?php echo $opinion->image; ?>" >
                                        <?php
                                    }
                                 
                            ?>

                        </div>
                        <p class="text-center mt-5 font-semibold md:text-xl dark:text-white"> <?php echo $opinion->firstName. " ". $opinion->lastName;  ?> </p>
                        <p class="text-center mt-5 px-3 font-semibold italic leading- dark:text-white"> <span class="text-gray-400 dark:text-gray-600 text-3xl">&ldquo;</span> <?php echo $opinion->content; ?> <span class="text-gray-400 dark:text-gray-600 text-3xl">&rdquo;</span></p>
                            <div class="flex mt-4 md:mt-5 lg:mt-10 mb-5 justify-center gap-1">

                                <?php 
                                    for ($i ; $i < $ratings ; $i++) { ?>
                                        <svg class="w-8 h-8 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                                        </svg>
                                    <?php }
                                ?>
                                
                            </div>
                    </div>

                <?php }
            ?>

            

        </div>
        
        <!-- Slider controls -->
        <div class=" mt-10 flex justify-center gap-0"> 
            <button type="button" class="relative top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center shadow-md border-2 justify-center w-14 h-14 rounded-full bg-white ">
                    <i id="left" class="fa-solid fa-angle-left font-bold text-2xl"></i>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="relative top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center shadow-md border-2 justify-center w-14 h-14 rounded-full bg-white ">
                    <i id="left" class="fa-solid fa-angle-right font-bold text-2xl"></i>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        </div>
        
        
    </div>

</div>