<?php
       $query = "SELECT 
       YEAR(pickupDate) AS year,
       MONTH(pickupDate) AS month,
       COUNT(CASE WHEN isExpired = 'Yes' THEN 1 ELSE NULL END) AS totalReservations,
       SUM(CASE WHEN isExpired = 'Yes' THEN totalCost ELSE 0 END) AS totalIncome
   FROM 
       reservation
   GROUP BY 
       YEAR(pickupDate), MONTH(pickupDate)";
       

// Prepare and execute the query
$stmt = $pdo->prepare($query);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Print the results
// echo "<table>
//    <tr>
//        <th>Year</th>
//        <th>Month</th>
//        <th>Total Reservations</th>
//        <th>Total Income</th>
//    </tr>";

// foreach ($reservations as $row) {
// echo "<tr>";
// echo "<td>" . $row['year'] . "</td>";
// echo "<td>" . $row['month'] . "</td>";
// echo "<td>" . $row['totalReservations'] . "</td>";
// echo "<td>" . $row['totalIncome'] . "</td>";
// echo "</tr>";
// }

// echo "</table>";
?>


<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <p class="text-black dark:text-white text-4xl font-semibold mb-1">Reservations Report</p>
    <hr class="mt-3">
  

    <div id="column-chart"></div>
        
</div>


  <script>
const options = {
  colors: ["#1A56DB", "#FDBA8C"],
  series: [
    {
      name: "Total Reservations",
      data: [
        <?php foreach ($reservations as $row) : ?>
          <?php echo $row['totalReservations'] . ','; ?>
        <?php endforeach; ?>
      ],
    },
    {
      name: "Total Income",
      data: [
        <?php foreach ($reservations as $row) : ?>
          <?php echo $row['totalIncome'] . ','; ?>
        <?php endforeach; ?>
      ],
    }
  ],
  chart: {
    type: "bar",
    height: "320px",
    fontFamily: "Inter, sans-serif",
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "70%",
      borderRadiusApplication: "end",
      borderRadius: 8,
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    style: {
      fontFamily: "Inter, sans-serif",
    },
  },
  states: {
    hover: {
      filter: {
        type: "darken",
        value: 1,
      },
    },
  },
  stroke: {
    show: true,
    width: 0,
    colors: ["transparent"],
  },
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -14
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  xaxis: {
    categories: [
      <?php foreach ($reservations as $row) : ?>
        "<?php echo $row['year'] . '-' . $row['month']; ?>",
      <?php endforeach; ?>
    ],
    floating: false,
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
  fill: {
    opacity: 1,
  },
}

if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("column-chart"), options);
  chart.render();
}
</script>


<!-- <script>
    
const options = {
  colors: ["#1A56DB", "#FDBA8C", "#1C64F2", "#9061F9"],
  series: [
    {
      name: "Organic",
      color: "#1A56DB",
      data: [
        { x: "Mon", y: 231, },
        { x: "Tue", y: 122 },
        { x: "Wed", y: 63 },
        { x: "Thu", y: 421 },
        { x: "Fri", y: 122 },
        { x: "Sat", y: 323 },
        { x: "Sun", y: 111 },
      ],
    },
    {
      name: "Social media",
      color: "#FDBA8C",
      data: [
        { x: "Mon", y: 232 },
        { x: "Tue", y: 113 },
        { x: "Wed", y: 341 },
        { x: "Thu", y: 224 },
        { x: "Fri", y: 522 },
        { x: "Sat", y: 411 },
        { x: "Sun", y: 243 },
      ],
    },
    {
      name: "Organic",
      color: "#1A56DB",
      data: [
        { x: "Mon", y: 231, },
        { x: "Tue", y: 122 },
        { x: "Wed", y: 63 },
        { x: "Thu", y: 421 },
        { x: "Fri", y: 122 },
        { x: "Sat", y: 323 },
        { x: "Sun", y: 111 },
      ],
    },
    {
      name: "Social media",
      color: "#FDBA8C",
      data: [
        { x: "Mon", y: 232 },
        { x: "Tue", y: 113 },
        { x: "Wed", y: 341 },
        { x: "Thu", y: 224 },
        { x: "Fri", y: 522 },
        { x: "Sat", y: 411 },
        { x: "Sun", y: 243 },
      ],
    },
  ],
  chart: {
    type: "bar",
    height: "320px",
    fontFamily: "Inter, sans-serif",
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "70%",
      borderRadiusApplication: "end",
      borderRadius: 8,
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    style: {
      fontFamily: "Inter, sans-serif",
    },
  },
  states: {
    hover: {
      filter: {
        type: "darken",
        value: 1,
      },
    },
  },
  stroke: {
    show: true,
    width: 0,
    colors: ["transparent"],
  },
  grid: {
    show: false,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -14
    },
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  xaxis: {
    floating: false,
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {
    show: false,
  },
  fill: {
    opacity: 1,
  },
}

if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("column-chart"), options);
  chart.render();
}

</script> -->