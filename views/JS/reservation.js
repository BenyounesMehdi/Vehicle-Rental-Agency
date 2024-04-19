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
    }, 50); 
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
    }, 50); 
}

// Add event listeners to input fields
document.getElementById("pickupDate").addEventListener("focus", logChosenDate); // Listen for focus event
document.getElementById("pickupDate").addEventListener("input", logChosenDate); // Listen for input event
document.getElementById("returnDate").addEventListener("focus", logChosenReturnDate); // Listen for focus event
document.getElementById("returnDate").addEventListener("input", logChosenReturnDate); // Listen for input event

// Function to toggle reserve button visibility
function reserveButtonToggole() {
    var reserveButton = document.getElementById("reserveButton");

    if (pickupDateAuth && returnDateAuth) {
        reserveButton.classList.remove("hidden");
    } else {
        reserveButton.classList.add("hidden");

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