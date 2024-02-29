function toggleArrow(element) {
    // Toggle arrow icon visibility for all items
    const arrows = document.querySelectorAll('.fa-solid.fa-arrow-right');
    arrows.forEach(arrow => arrow.classList.add('hidden'));
    
    // Get the URL from the clicked item
    const url = element.getAttribute('href');
    console.log(url)
 
   // Check if the URL matches the target URL
        switch (url) {
            case 'brandsSide.php':
            case 'dashboardSide.php':
            case 'clientSide.php':
            case 'vehiclesSide.php':
            case 'vehiclesTypeSide.php':
            case 'reservationsSide.php':
                // Add arrow icon to the clicked item
                const arrow = element.querySelector('.fa-solid.fa-arrow-right');
                arrow.classList.remove('hidden');
                break;
            default:
                break;
        }

    // Prevent the default action (link navigation) to avoid page reloading
    return false;   
}

window.addEventListener('DOMContentLoaded', (event) => {
    // Get the current URL
    const currentURL = window.location.href;

    // Define the target URL for each page
    let targetURL;

    // Set the target URL based on the current URL
    switch (currentURL) {
        case 'http://localhost/VEhicleRentalAgency/views/admin/brandsSide.php':
            targetURL = 'brandsSide.php';
            break;
        case 'http://localhost/VEhicleRentalAgency/views/admin/clientSide.php':
            targetURL = 'clientSide.php';
            break;
        case 'http://localhost/VEhicleRentalAgency/views/admin/vehiclesSide.php':
            targetURL = 'vehiclesSide.php';
            break;
        case 'http://localhost/VEhicleRentalAgency/views/admin/vehiclesTypeSide.php':
            targetURL = 'vehiclesTypeSide.php';
            break;
        case 'http://localhost/VEhicleRentalAgency/views/admin/reservationsSide.php':
            targetURL = 'reservationsSide.php';
            break;
        case 'http://localhost/VEhicleRentalAgency/views/admin/dashboardSide.php':
            targetURL = 'dashboardSide.php';
            break;
        default:
            break;
    }

    // Find the sidebar item corresponding to the target URL
    const sidebarItem = document.querySelector(`a[href="${targetURL}"]`);

    // Call the toggleArrow function with the found sidebar item
    toggleArrow(sidebarItem);
});
