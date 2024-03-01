

const clientsList = document.getElementById("clientsList");
const searchField = document.getElementById("default-search");

searchField.onkeyup = () => {
    let searchContent = searchField.value;

    if (searchContent != "") {
        searchField.classList.add("searching");
    } else {
        searchField.classList.remove("searching");
    }

    let request = new XMLHttpRequest();

    request.open("POST", "../../models/backend/client/clientsSearch.php", true);
    request.onload = () => {
        if (request.readyState === 4 && request.status === 200) {
            let data = request.responseText;
            // console.log("Received data:", data);
            clientsList.innerHTML = data;
            attachDeleteButtonListeners(); // Call the function after updating the DOM
        }
    };
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("searchContent=" + searchContent);
};

// Function to attach event listeners to delete buttons
function attachDeleteButtonListeners() {
    // console.log("Attaching delete button listeners...");
    const deleteButtons = document.querySelectorAll("[data-modal-target='popup-modal']");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", () => {
            // console.log("Delete button clicked:", button);
            const modal = document.getElementById("popup-modal");
            modal.classList.remove("hidden");
        });
    });
}   