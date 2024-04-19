<?php
                        // Fetch brand names and vehicle counts
                        $query = "SELECT b.name AS brand_name, COUNT(v.vehicleID) AS vehicle_count
                        FROM brand b
                        LEFT JOIN vehicle v ON b.brandID = v.brandID
                        GROUP BY b.name" ;
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $brandsData = $stmt->fetchAll();
                    ?>

            <script>
                    var brandsData = <?php echo json_encode($brandsData); ?>;
                    console.log(brandsData); // Check the data in the browser console
            </script>

            <div class="w-full overflow-auto" >
                <canvas id="myChart" class="overflow-x-auto"></canvas>
            </div>


            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: brandsData.map(data => data.brand_name),
                        datasets: [{
                            label: 'Vehicles Count By Brand',
                            data: brandsData.map(data => data.vehicle_count), // Replace this with your actual data
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>