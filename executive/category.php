<?php
$con = mysqli_connect("localhost", "root", "", "ip") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8'");
date_default_timezone_set('Asia/Bangkok');

// Fetch distinct category names from the Category table
$categoryQuery = "SELECT DISTINCT CATEGORY_NAME FROM category";
$categoryResult = mysqli_query($con, $categoryQuery);

// Create an array to store category names
$categoryNames = array();
while ($row = mysqli_fetch_assoc($categoryResult)) {
    $categoryNames[] = $row['CATEGORY_NAME'];
}

// Create arrays to store total order prices and counts for each category
$totalPrices = array();
$totalCounts = array();
foreach ($categoryNames as $categoryName) {
    // Total order prices
    $totalPriceQuery = "SELECT SUM(o.order_price) AS total_price
                        FROM orders o
                        JOIN picture p ON o.picture_id = p.PICTURE_ID
                        WHERE p.CATEGORY_NAME = '$categoryName'";
    $totalPriceResult = mysqli_query($con, $totalPriceQuery);
    $totalPriceRow = mysqli_fetch_assoc($totalPriceResult);
    $totalPrices[] = $totalPriceRow['total_price'];

    // Total order counts
    $totalCountQuery = "SELECT COUNT(o.order_id) AS total_count
                        FROM orders o
                        JOIN picture p ON o.picture_id = p.PICTURE_ID
                        WHERE p.CATEGORY_NAME = '$categoryName'";
    $totalCountResult = mysqli_query($con, $totalCountQuery);
    $totalCountRow = mysqli_fetch_assoc($totalCountResult);
    $totalCounts[] = $totalCountRow['total_count'];
}

// Calculate the total sum of order prices
$totalSumPrices = array_sum($totalPrices);

// Calculate the proportion of total order prices for each category
$proportions = array_map(function ($price) use ($totalSumPrices) {
    return ($totalSumPrices > 0) ? ($price / $totalSumPrices) * 100 : 0;
}, $totalPrices);
?>
</html>
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<div style="display: flex; justify-content: space-around;">

  <!-- Doughnut Chart for Total Order Counts -->
  <canvas id="myDoughnutChartCounts" style="width:100%;max-width:600px"></canvas>

  <!-- Doughnut Chart for Proportion of Total Order Prices -->
  <canvas id="myDoughnutChartProportions" style="width:100%;max-width:600px" ></canvas>

</div>

<script>
var categoryNames = <?php echo json_encode($categoryNames); ?>;
var doughnutCountsData = <?php echo json_encode($totalCounts); ?>;
var doughnutProportionsData = <?php echo json_encode($proportions); ?>;
var doughnutColors = [
    "#FFD1DC",
    "#FFA07A",
    "#FFDEAD",
    "#B0E0E6",
    "#98FB98",
    "#FFB6C1"
];

// Format numbers to two decimal places with a percentage sign
function formatPercentage(value) {
  return value.toFixed(2) + ' $';
}

// Doughnut Chart for Total Order Counts
new Chart("myDoughnutChartCounts", {
  type: "doughnut",
  data: {
    labels: categoryNames,
    datasets: [{
      data: doughnutCountsData,
      backgroundColor: doughnutColors
    }]
  },
  options: {
    title: {
      display: true,
      text: "Total Order Counts by Category"
    },
    tooltips: {
      callbacks: {
        label: function (tooltipItem, data) {
          return data.labels[tooltipItem.index] + ': ' + doughnutCountsData[tooltipItem.index] + ' orders';
        }
      }
    }
  }
});

// Doughnut Chart for Proportion of Total Order Prices
new Chart("myDoughnutChartProportions", {
  type: "doughnut",
  data: {
    labels: categoryNames,
    datasets: [{
      data: doughnutProportionsData,
      backgroundColor: doughnutColors
    }]
  },
  options: {
    title: {
      display: true,
      text: "Proportion of Total Order Prices by Category"
    },
    tooltips: {
      callbacks: {
        label: function (tooltipItem, data) {
          return data.labels[tooltipItem.index] + ': ' + formatPercentage(doughnutProportionsData[tooltipItem.index]);
        }
      }
    }
  }
});
</script>

</body>
</html>
