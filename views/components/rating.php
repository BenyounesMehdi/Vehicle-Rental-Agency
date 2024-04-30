<?php
       // Fetch opinions
       $query = "SELECT rating, COUNT(*) as countOpinions
          FROM opinion
          GROUP BY rating";
       $stmt = $pdo->prepare($query);
       $stmt->execute();
       $opinions = $stmt->fetchAll();

    //    var_dump($opinions) ;
        $table = 'opinion' ;
       $totalOpinions = countRableRows($pdo, $table) ;
    //    echo $totalOpinions ;

    // Calculate the stars average
    $stmt = $pdo->prepare("SELECT AVG(rating) AS starsAverage FROM opinion");
    $stmt->execute();
    $averageStars = $stmt->fetch();
    $averageStars = number_format($averageStars->starsAverage, 1);
   ?>


<div class="bg-white dark:bg-gray-800 w-full px-2 py-3 rounded-lg">
    <div class="flex items-center justify-between mb-2">
            <p class="text-black dark:text-white text-4xl font-semibold ml-2">Ratings</p>
            <div class="flex items-center mb-0 justify-between mr-2 ">
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400"> <?php echo $averageStars; ?> </p>
                <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">out of</p>
                <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">5</p>
            </div>
        </div>

        <p class="text-sm ml-2 font-medium text-gray-500 dark:text-gray-400"><?php echo $totalOpinions; ?> global ratings</p>

        <div class="flex flex-col justify-start items-center ml-2 mt-1 mb-2">
            <?php foreach ($opinions as $opinion): ?>
                <div class="flex items-center mt-4  w-full">
                    <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline"><?php echo $opinion->rating; ?> star</a>
                    <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                        <div class="h-5 bg-yellow-300 rounded" style="width: <?php echo ($opinion->countOpinions / $totalOpinions) * 100; ?>%"></div>
                    </div>
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400"><?php echo round(($opinion->countOpinions / $totalOpinions) * 100, 2); ?>%</span>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- <div class="flex items-center mt-4">
            <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">5 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: 70%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">70%</span>
        </div>

        <div class="flex items-center mt-4">
            <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">4 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: 17%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">17%</span>
        </div>

        <div class="flex items-center mt-4">
            <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">3 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: 8%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8%</span>
        </div>

        <div class="flex items-center mt-4">
            <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">2 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: 4%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">4%</span>
        </div>

        <div class="flex items-center mt-4">
            <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">1 star</a>
            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-300 rounded" style="width: 1%"></div>
            </div>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">1%</span>
        </div>    -->

</div>