<?php
    include './models/database.php' ;
    include './models/functions.php' ;

   $table = "vehicle" ;
   $data = getData($pdo, $table) ;
  //  var_dump($data) ;
?>

<div class="container mx-auto mb-5 px-6">
  <p class="text-4xl font-semibold dark:text-white text-left">Vehicles</p>
</div>


<!-- <div id="default-carousel" class="relative container mx-auto md:w-2/4 " data-carousel="slide"> -->
    <!-- Carousel wrapper -->
    
    <!-- <div class="relative overflow-hidden rounded-lg h-96 p-6 "> -->

        <?php 
          for($i = 0 ; $i < count($data) ; $i++) {
            ?> 
              <!-- <a href="">
                <div class="hidden drop-shadow-xl  duration-700 ease-in-out p-3 flex flex-col justify-center items-center" data-carousel-item>
                    <div class="flex flex-col justify-center items-center"> -->
                      <!-- <p class="font-semibold text-xl <?php //echo ($data[$i]->vehicleStatus == 'Available') ? 'text-green-500' : (($data[$i]->vehicleStatus == 'Not Available') ? 'text-red-500' : 'text-blue-500'); ?>"> <?php echo $data[$i]->vehicleStatus ; ?> </p> -->
                       <!-- <img src="./assets/vehiclesImages/<?php //echo $data[$i]->image; ?>" class="w-64 sm:w-80"> -->
                       <!-- <p class="dark:text-white text-xl font-semibold"> <?php echo $data[$i]->name; ?> </p>  
                    </div>   
                    <a href="" class="mt-2">
                      <button type="button" class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Reserve Now</button>
                    </a>
                    <a href="" class="font-semibold hover:underline text-blue-800 ">Show Details</a>
                </div>
              </a> -->
            <?php
          }
        ?>
     
    <!-- </div> -->
  
    <!-- <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-300">
            <svg class="w-3 h-3 text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-300">
            <svg class="w-3 h-3 text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button> -->
</div>


<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

  .wrapper {
  max-width: 1100px;
  width: 100%;
  position: relative;
}
.wrapper i {
  top: 0%;
  height: 50px;
  width: 50px;
  cursor: pointer;
  font-size: 1.25rem;
  position: absolute;
  text-align: center;
  line-height: 50px;
  background: #fff;
  border-radius: 50%;
  box-shadow: 0 3px 6px rgba(0,0,0,0.33);
  transform: translateY(-50%);
  transition: transform 0.1s linear;
}
.wrapper i:active{
  transform: translateY(-50%) scale(0.85);
}
.wrapper i:first-child{
  right: 80px;
}
.wrapper i:last-child{
  right: 20px;
}
.wrapper .carousel{
  display: grid;
  grid-auto-flow: column;
  grid-auto-columns: calc((100% / 3) - 12px);
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  gap: 16px;
  border-radius: 8px;
  scroll-behavior: smooth;
  scrollbar-width: none;
}
.carousel::-webkit-scrollbar {
  display: none;
}
.carousel.no-transition {
  scroll-behavior: auto;
}
.carousel.dragging {
  scroll-snap-type: none;
  scroll-behavior: auto;
}
.carousel.dragging .card {
  cursor: grab;
  user-select: none;
}
.carousel :where(.card, .img) {
  display: flex;
  justify-content: center;
  align-items: center;
}
.carousel .card {
  scroll-snap-align: start;
  height: 342px;
  list-style: none;
  /* background: #fff; */
  cursor: pointer;
  padding-bottom: 15px;
  flex-direction: column;
  border-radius: 8px;
}
.carousel .card .img {
  /* background: #8B53FF; */
  height: 148px;
  width: 148px;
  border-radius: 50%;
}
.card .img img {
  /* width: 140px; */
  /* height: 140px; */
  /* border-radius: 50%; */
  object-fit: cover;
  /* border: 4px solid #fff; */
}
.carousel .card h2 {
  font-weight: 500;
  font-size: 1.56rem;
  margin: 30px 0 5px;
}
.carousel .card span {
  /* color: #6A6D78;
  font-size: 1.31rem; */
}
@media screen and (max-width: 900px) {
  .wrapper .carousel {
    grid-auto-columns: calc((100% / 2) - 9px);
  }
}
@media screen and (max-width: 600px) {
  .wrapper .carousel {
    grid-auto-columns: 100%;
  }
} 
</style>

<div class="wrapper container mx-auto px-4 py-8 relative">
      
      <i id="left" class="fa-solid fa-angle-left "></i>

      <ul class="carousel">

          <?php 
              for($i = 0 ; $i < count($data) ; $i++) {
                ?>
                    
                      <li class="card bg-white border border-gray-300 rounded-lg shadow hover:bg-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <div class="img"><img src="./assets/vehiclesImages/<?php echo $data[$i]->image; ?>" draggable="false"></div>
                            <h2 class="text-black dark:text-white text-center "> <?php echo $data[$i]->name; ?> </h2>
                            <?php // The Reserve Now Button Should Not Appear When The User Is The Admin
                                if( !isset($_SESSION['admin']) ) {
                                  ?>
                                      <a href="" class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"> Reserve Now </a>
                                  <?php
                                }
                            ?>
                            <p class="font-semibold text-xl <?php echo ($data[$i]->vehicleStatus == 'Available') ? 'text-green-500' : (($data[$i]->vehicleStatus == 'Not Available') ? 'text-red-500' : 'text-blue-500'); ?>"> <?php echo $data[$i]->vehicleStatus ; ?> </p>
                            <a href="" class="text-black dark:text-white hover:underline font-light text-sm mt-1">Show Details</a>
                      </li>
                  
                <?php
              }
          ?>

      </ul>
      <i id="right" class="fa-solid fa-angle-right"></i>
</div>



<script>
    const wrapper = document.querySelector(".wrapper");
    const carousel = document.querySelector(".carousel");
    const firstCardWidth = carousel.querySelector(".card").offsetWidth;
    const arrowBtns = document.querySelectorAll(".wrapper i");
    const carouselChildrens = [...carousel.children];
    let isDragging = false, isAutoPlay = true, startX, startScrollLeft, timeoutId;
    // Get the number of cards that can fit in the carousel at once
    let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);
    // Insert copies of the last few cards to beginning of carousel for infinite scrolling
    carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
        carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
    });
    // Insert copies of the first few cards to end of carousel for infinite scrolling
    carouselChildrens.slice(0, cardPerView).forEach(card => {
        carousel.insertAdjacentHTML("beforeend", card.outerHTML);
    });
    // Scroll the carousel at appropriate postition to hide first few duplicate cards on Firefox
    carousel.classList.add("no-transition");
    carousel.scrollLeft = carousel.offsetWidth;
    carousel.classList.remove("no-transition");
    // Add event listeners for the arrow buttons to scroll the carousel left and right
    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
        });
    });
    const dragStart = (e) => {
        isDragging = true;
        carousel.classList.add("dragging");
        // Records the initial cursor and scroll position of the carousel
        startX = e.pageX;
        startScrollLeft = carousel.scrollLeft;
    }
    const dragging = (e) => {
        if(!isDragging) return; // if isDragging is false return from here
        // Updates the scroll position of the carousel based on the cursor movement
        carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
    }
    const dragStop = () => {
        isDragging = false;
        carousel.classList.remove("dragging");
    }
    const infiniteScroll = () => {
        // If the carousel is at the beginning, scroll to the end
        if(carousel.scrollLeft === 0) {
            carousel.classList.add("no-transition");
            carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
            carousel.classList.remove("no-transition");
        }
        // If the carousel is at the end, scroll to the beginning
        else if(Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
            carousel.classList.add("no-transition");
            carousel.scrollLeft = carousel.offsetWidth;
            carousel.classList.remove("no-transition");
        }
        // Clear existing timeout & start autoplay if mouse is not hovering over carousel
        clearTimeout(timeoutId);
        if(!wrapper.matches(":hover")) autoPlay();
    }
    const autoPlay = () => {
        if(window.innerWidth < 800 || !isAutoPlay) return; // Return if window is smaller than 800 or isAutoPlay is false
        // Autoplay the carousel after every 2500 ms
        timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
    }
    autoPlay();
    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    carousel.addEventListener("scroll", infiniteScroll);
    wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
    wrapper.addEventListener("mouseleave", autoPlay);
</script>