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
<body class="bg-gray-200 dark:bg-gray-900 py-6 px-8">
    
<section class="">
        <div class="max-w-2xl ml-2">
            <p class="mb-4 text-2xl font-semibold text-gray-900 dark:text-white">Edit Profile</p>
            <form class=" ml-2" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="flex flex-col gap-4 sm:gap-4 sm:mb-3">

                    <?php

                        if (isset($_POST['editProfile'])) {
                            $firstName = $_POST['firstName'];
                            $lastName = $_POST['lastName'];
                            $phoneNumber = $_POST['phoneNumber'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $profileImage = $_FILES['profileImage']['name'];
                        

                                if (empty($profileImage)) {
                                    $fileName = "";
                                } else {
                                    $fileName = uniqid() . $profileImage;
                                    // Move the file from [tmp_name] into assets/clientProfile
                                    move_uploaded_file($_FILES['profileImage']['tmp_name'], '../../assets/clientProfile/' . $fileName);
                                    
                                }

                                // Update the profile information in the database
                                    if (!empty($profileImage)) {
                                        // A new image is uploaded, replace the existing image
                                        $query = 'UPDATE client 
                                        SET firstName=?, lastName=?, phoneNumber=?, email=?, pass=?, image=? 
                                        WHERE clientID=?';
                                        $stmt = $pdo->prepare($query);
                                        $updated = $stmt->execute([$firstName, $lastName, $phoneNumber, $email, $password, $fileName, $clientID]);
                                    } else {
                                        // No new image uploaded, retain the existing image
                                        $query = 'UPDATE client 
                                        SET firstName=?, lastName=?, phoneNumber=?, email=?, pass=? 
                                        WHERE clientID=?';
                                        $stmt = $pdo->prepare($query);
                                        $updated = $stmt->execute([$firstName, $lastName, $phoneNumber, $email, $password, $clientID]);
                                    }

                                if ($updated) {
                                    // Redirect the user to the previous page
                                    header('location: myProfile.php');
                                    exit; // Ensure that no further code is executed after the redirection
                                } else {
                                    $title = "Error Occurred";
                                    include_once("../components/errorField.php");
                                }
                            
                        }
                    ?>

                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-1 text-medium font-medium text-gray-900 dark:text-white">First Name</label>
                        <input type="text" name="firstName" id="firstName" oninput="checkFirstName()" value="<?php echo $client->firstName; ?>" id="firstName" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                        <div id="firstNameError" class="text-red-500 text-sm mt-1 hidden">Please, fill this input.</div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-1 text-medium font-medium text-gray-900 dark:text-white">Last Name</label>
                        <input type="text" name="lastName" id="lastName" oninput="checkLastName()" value="<?php echo $client->lastName; ?>" id="lastName" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                        <div id="lastNameError" class="text-red-500 text-sm mt-1 hidden">Please, fill this input.</div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-1 text-medium font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" name="phoneNumber" oninput="phoneValidator()" value="<?php echo $client->phoneNumber; ?>" id="phoneNumber" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                        <div id="phoneError" class="text-red-500 text-sm mt-1 hidden">Please, enter a valid phone number.</div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-1 text-medium font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email" oninput="checkEmail()" value="<?php echo $client->email; ?>" id="email" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                        <div id="emailError" class="text-red-500 text-sm mt-1 hidden">Please, fill this input.</div>
                        <div id="emailValidationError" class="text-red-500 text-sm mt-1 hidden">This email is not a valid email.</div>
                    </div>

                    
                    <div class="sm:col-span-2">
                        <label for="name" class="block mb-1 text-medium font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="text" name="password" id="password" oninput="checkPassword()" value="<?php echo $client->pass; ?>" id="password" class="bg-gray-50 border border-gray-300 font-semibold text-gray-900 text-medium rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" >
                        <div id="passwordError" class="text-red-500 text-sm mt-1 hidden">Please, fill this input.</div>
                    </div>
                    
                    <div class="w-full mb-2">
                        <label class="block mb-1 text-medium font-medium text-gray-900 dark:text-white" for="multiple_files">Upload an Image</label>
                        <input type="file" name="profileImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files"  multiple>
                    </div>
                </div>
                <div class="flex items-center justify-end space-x-4">
                    <button type="submit" id="editProfile" name="editProfile" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                        Edit
                    </button>
                    <a href="myProfile.php">
                        <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 ">Cancel</button>
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script src="../JS/themeToggle.js"></script>
    <script>

        const editProfile = document.getElementById('editProfile');

        function phoneValidator() {
            const phoneNumberInput = document.getElementById('phoneNumber');
            const phoneNumber = phoneNumberInput.value;
            const phoneError = document.getElementById('phoneError');
            
            // Regular expression to match only numbers
            const numbersRegex = /^[0-9]+$/;

            if (!phoneNumber.match(numbersRegex) || phoneNumber.length === 0 || phoneNumber.length !== 10 || phoneNumber.length > 10 || !(phoneNumber.startsWith('06') || phoneNumber.startsWith('07') || phoneNumber.startsWith('05'))) {
                phoneError.textContent = 'Please, enter a valid phone number.';
                phoneError.classList.remove('hidden');
                editProfile.style.visibility = "hidden"; // Hide the submit button
            } else {
                phoneError.classList.add('hidden');
                editProfile.style.visibility = "visible"; // Show the submit button
            }
        }

        function checkFirstName () {
            const firstName = document.getElementById('firstName');
            const firstNameError = document.getElementById('firstNameError');

            if( firstName.value.length == 0 ) {
                firstNameError.classList.remove('hidden');
                editProfile.style.visibility = "hidden"; 
            }
            else {
                firstNameError.classList.add('hidden');
                editProfile.style.visibility = "visible";
            }
        }

        function checkLastName () {
            const lastName = document.getElementById('lastName');
            const lastNameError = document.getElementById('lastNameError');

            if( lastName.value.length == 0 ) {
                lastNameError.classList.remove('hidden');
                editProfile.style.visibility = "hidden"; 
            }
            else {
                lastNameError.classList.add('hidden');
                editProfile.style.visibility = "visible";
            }
        }

        function checkPassword() {
            const password = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');

            if (password.value.length == 0) {
                passwordError.classList.remove('hidden');
                editProfile.style.visibility = "hidden"; 
            } else {
                passwordError.classList.add('hidden');
                editProfile.style.visibility = "visible";
            }
        }

        function checkEmail() {
            const email = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const emailValidationError = document.getElementById('emailValidationError');

            const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

            if (email.value.length === 0) {
                emailError.classList.remove('hidden');
                emailValidationError.classList.add('hidden');
                editProfile.style.visibility = "hidden";
            } else if (!emailPattern.test(email.value)) {
                emailValidationError.classList.remove('hidden');
                emailError.classList.add('hidden');
                editProfile.style.visibility = "hidden"; 
            } else {
                emailError.classList.add('hidden');
                emailValidationError.classList.add('hidden');
                editProfile.style.visibility = "visible";
            }
        }

    </script>
</body>
</html>

