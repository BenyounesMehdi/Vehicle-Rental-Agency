<?php
    $query = "SELECT o.*, c.firstName as firstName, c.lastName as lastName
    FROM opinion o 
    JOIN client c ON o.clientID = c.clientID" ;


    // Calculate the stars average
    $stmt = $pdo->prepare($query) ;
    $stmt->execute() ;
    $opinions = $stmt->fetchAll() ;    

    
?>
    
<style>
    ::-webkit-scrollbar {
    width: 5px; /* width of the scrollbar */
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; /* color of the scrollbar handle */
    border-radius: 5px; /* rounded corners */
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; /* color of the scrollbar handle on hover */
}
</style>



<p class=" px-4 text-2xl font-semibold text-gray-900 dark:text-white">Clients Opinions And Reviews</p>

<div class="bg-gray-300 p-4 dark:bg-gray-900 w-full ">
    
    <div class="sm:px-14 ">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 px-2 mb-7 gap-3">
        
            <?php 
            
                foreach ($opinions as $opinion) { ?>
                    <div class="p-2 overflow-y-auto bg-white border border-gray-300 rounded-lg shadow-lg hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" style="height : 170px;">
                        <div class="flex items-center gap-5 px-4" >
                            <img src="../../assets/clientProfile/unknownPP.jpg" class=" w-10 h-10 rounded-full">
                            <p class="font-semibold text-xl dark:text-white"> <?php echo $opinion->firstName. " ". $opinion->lastName ; ?> </p>
                        </div>
                        <div>
                            <p class="text-center mt-2 px-3 font-semibold italic text-gray-700 dark:text-gray-400" style="word-break: break-word;">
                                <span class="text-gray-400 dark:text-gray-600 text-3xl">&ldquo;</span> 
                                <?php echo $opinion->content; ?> 
                                <span class="text-gray-400 dark:text-gray-600 text-3xl">&rdquo;</span>
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-5 px-2">
                            <div class="flex flex-col">
                                <p class="text-md dark:text-white "> <?php echo $opinion->creationDate ; ?> </p>
                                <p class="text-md dark:text-white font-semibold ">Published</p>
                            </div>
                            <div class="text-yellow-300 flex gap-1 text-2xl">
                                <?php 
                                    $ratings = $opinion->rating ;
                                    for( $i = 0 ; $i < $ratings ; $i++ ) {
                                        ?>
                                          <div>★</div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php }

            ?>

            
            
           
            
            
        </div>
        
    </div>
    
</div>
    
    


    
