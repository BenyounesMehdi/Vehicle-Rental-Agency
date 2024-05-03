<?php
    // Query to get the count of vehicles for each vehicle type
    $query = "SELECT vt.name, COUNT(*) AS count 
        FROM vehiclestype vt
        JOIN vehicle v
        ON v.vehicleTypeID = vt.vehiclesTypeID
        GROUP BY vt.name";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 px-3 py-4">
    <p class="text-black dark:text-white text-4xl font-semibold mb-2">Vehicles Types Report</p>
    <hr class="mb-3 mt-3">
  <div id="barChart"></div>


</div>


<script>
  
  var vehicleData = [
  <?php foreach ($data as $row) : ?>
    {
      type: "<?php echo $row['name']; ?>",
      count: <?php echo $row['count']; ?>
    },
  <?php endforeach; ?>
];

  const vehiclesOptions = {
  color: ["#31C48D"],
  series: [{
    name: "Total Number",
    data: vehicleData.map(item => item.count)
  }],
  chart: {
    sparkline: {
      enabled: false,
    },
    type: "bar",
    width: "100%",
    height: 400,
    toolbar: {
      show: false,
    }
  },
  fill: {
    opacity: 1,
  },
  plotvehiclesOptions: {
    bar: {
      horizontal: true,
      columnWidth: "100%",
      borderRadiusApplication: "end",
      borderRadius: 6,
      dataLabels: {
        position: "top",
      },
    },
  },
  legend: {
    show: true,
    position: "bottom",
  },
  dataLabels: {
    enabled: false,
  },
  tooltip: {
    shared: true,
    intersect: false,
    formatter: function (value) {
      return  value
    }
  },
  xaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      },
      formatter: function(value) {
        return  value
      }
    },
    categories: vehicleData.map(item => item.type),
    axisTicks: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    }
  },
  grid: {
    show: true,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -20
    },
  },
};

if (document.getElementById("barChart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("barChart"), vehiclesOptions);
  chart.render();
}

</script>