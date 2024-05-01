
<?php
$query = "SELECT DISTINCT b.image as image 
    FROM brand b
    JOIN vehicle v
    ON b.brandID = v.brandID
    WHERE b.image <> ''";
$stmt = $pdo->prepare($query);
$stmt->execute();
$brandsLogos = $stmt->fetchAll();
// var_dump($brandsLogos) ;
?>

<style>

  .scroller {
    width: 85% ;
  }

  .scroller__inner {
    padding-block: 1rem;
    display: flex;
    gap: 1rem;
  }

  .scroller[data-animated="true"] {
    overflow: hidden;
  }

  .scroller[data-animated="true"] .scroller__inner {
    width: max-content;
    flex-wrap: nowrap;
    animation: scroll var(--_animation-duration, 40s)
      var(--_animation-direction, forwards) linear infinite;
  }

  .scroller[data-direction="right"] {
    --_animation-direction: reverse;
  }

  .scroller[data-direction="left"] {
    --_animation-direction: forwards;
  }

  .scroller[data-speed="fast"] {
    --_animation-duration: 20s;
  }

  .scroller[data-speed="slow"] {
    --_animation-duration: 60s;
  }

  @keyframes scroll {
    to {
      transform: translate(calc(-50% - 0.5rem));
    }
  }

  /* general styles */

  :root {
    --clr-neutral-100: hsl(0, 0%, 100%);
    --clr-primary-100: hsl(205, 15%, 58%);
    --clr-primary-400: hsl(215, 25%, 27%);
    --clr-primary-800: hsl(217, 33%, 17%);
    --clr-primary-900: hsl(218, 33%, 9%);
  }
  

  /* for testing purposed to ensure the animation lined up correctly */
  .test {
    background: red !important;
  }

</style>
<section id="brands">
    <p class="dark:text-white font-semibold text-4xl text-center mb-5 mt-10">Brands With Have</p>

    <div  class="flex justify-center items-center ">
        <div class="scroller bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-600 rounded-lg shadow-lg " data-direction="left" data-speed="fast">
        <div class="scroller__inner">
            <?php 
                foreach ($brandsLogos as $brand) {
                    ?> 
                        <img class="w-32" src="./assets/brandsImages/<?php echo $brand->image  ?>" >
                    <?php
                }
            ?>
        </div>
        </div>
    </div>
</section>



<script>
  // Get all elements with the class "scroller"
  const scrollers = document.querySelectorAll(".scroller");

  // Loop through each scroller
  scrollers.forEach((scroller) => {
    // Add data-animated attribute to enable animation
    scroller.setAttribute("data-animated", true);

    // Get the direction and speed from data attributes
    const direction = scroller.getAttribute("data-direction") || "left";
    const speed = scroller.getAttribute("data-speed") || "normal";

    // Set animation duration based on speed
    let duration;
    if (speed === "fast") {
      duration = "20s";
    } else if (speed === "slow") {
      duration = "60s";
    } else {
      duration = "40s"; // Default speed
    }

    // Set animation direction
    const animationDirection = direction === "right" ? "reverse" : "forwards";

    // Apply animation to the scroller__inner element
    const scrollerInner = scroller.querySelector(".scroller__inner");
    scrollerInner.style.animation = `scroll ${duration} linear infinite ${animationDirection}`;

    // Define the scroll animation keyframes
    const keyframes = `
      @keyframes scroll {
        to {
          transform: translateX(calc(-100% - 1rem));
        }
      }
    `;

    // Append the keyframes to the document head
    const style = document.createElement("style");
    style.innerHTML = keyframes;
    document.head.appendChild(style);
  });
</script>