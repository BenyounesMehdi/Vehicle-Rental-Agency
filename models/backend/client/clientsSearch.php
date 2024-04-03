<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">

    </head>
    <body>

    <?php
    require_once '../../database.php';

    $searchContent = isset($_POST['searchContent']) ? $_POST['searchContent'] : '';

    $query = "SELECT * FROM client WHERE (firstName LIKE :searchContent) OR (lastName LIKE :searchContent)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["searchContent" => "%$searchContent%"]);

    if ($stmt->rowCount() > 0) { // There are results
        ?>
        <div class="relative overflow-x-auto overflow-y-auto shadow-lg mt-3 " style="max-height : 350px;">
            <table class="w-full text-sm text-left rtl:text-right text-gray-50 dark:text-gray-400 rounded">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $stmt->fetch()) { ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $row->clientID; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $row->firstName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $row->lastName; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $row->phoneNumber; ?>
                                </td>
                                <td class="px-6 py-2 font-bold text-gray-900 dark:text-white">
                                    <?php echo $row->email; ?>
                                </td>
                                
                            </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
        
        <?php
        
    } else { // No results found
        echo '<p class="text-black dark:text-white text-xl font-semibold">No Result</p>';
    }
    ?>




        
        <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
        <script src="../JS/themeToggle.js"></script>
        <script src="../JS/clientsSearch"></script>

    </body>
    </html>