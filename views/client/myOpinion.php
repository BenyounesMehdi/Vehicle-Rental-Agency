<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../node_modules/flowbite/dist/flowbite.min.css">
</head>
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">

    <p class="text-3xl md:text-4xl font-meduim dark:text-white">What Do You Think About Our Service</p>

    <section class="container mx-auto">
        
        <form action="">

            <div class="sm:px-4 mt-10 sm:mt-7">
                <label for="opinion" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Your Opinion</label>
                <textarea id="opinion" rows="2" class="block p-2.5 w-full text-md font-semibold text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                <p id="error-message" class="text-red-500 font-semibold hidden"></p>
            </div>


            <p class="mt-5 sm:px-4 mb-2 text-2xl font-medium text-gray-900 dark:text-white">Rate us</p>
            <div class="flex  sm:px-4">
                

                <button class="flex-shrink-0 z-10 inline-flex items-center justify-center py-2.5 px-4 text-sm font-medium text-center bg-gray-100 border border-gray-300 rounded-s-lg dark:bg-gray-700 dark:border-gray-600" type="button">
                    <div class="text-3xl text-yellow-300 font-bold">★</div>
                </button>
                
                <label for="stars" class="sr-only">Rate us</label>
                <select id="stars" class="bg-gray-50 border border-gray-300 text-yellow-300 text-xl rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="1">
                        <div>
                            <div class="text-xl ">★</div>
                        </div>
                    </option>
                    <option value="2">
                        <div>
                            <div class="text-xl ">★★</div>
                        </div>
                    </option>
                    <option value="3">
                        <div>
                            <div class="text-xl ">★★★</div>
                        </div>
                    </option>
                    <option value="4">
                        <div>
                            <div class="text-xl ">★★★★</div>
                        </div>
                    </option>
                    <option value="5">
                        <div>
                            <div class="text-xl ">★★★★★</div>
                        </div>
                    </option>
                    
                </select>
            </div>

            <div class="w-full flex items-end justify-end space-x-4 mt-5 px-4">
                <button id="opinionBtn" type="submit" name="opinion" class="hidden text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                    Add Opinion
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

    </script>

</body>
</html>