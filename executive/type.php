<?php
$con1 = mysqli_connect("localhost", "root", "", "ip") or die("Error: " . mysqli_error($con1));
mysqli_query($con1, "SET NAMES 'utf8'");
date_default_timezone_set('Asia/Bangkok');

// Fetch distinct picture type names from the picture_type table
$categoryQuery1 = "SELECT DISTINCT PICTURETYPE_NAME FROM picture_type";
$categoryResult1 = mysqli_query($con1, $categoryQuery1);

// Create an array to store picture type names
$pictureTypeNames1 = array();
while ($row = mysqli_fetch_assoc($categoryResult1)) {
    $pictureTypeNames1[] = $row['PICTURETYPE_NAME'];
}

// Create an array to store total order counts and total sales for each picture type
$totalCountsAndSalesPictureType1 = array();
foreach ($pictureTypeNames1 as $pictureTypeName1) {
    // Total order counts
    $totalCountQuery1 = "SELECT COUNT(o.order_id) AS total_count
                        FROM orders o
                        JOIN picture p ON o.picture_id = p.PICTURE_ID
                        JOIN picture_type pt ON p.PICTURETYPE_NAME = pt.PICTURETYPE_NAME
                        WHERE pt.PICTURETYPE_NAME = '$pictureTypeName1'";
    $totalCountResult1 = mysqli_query($con1, $totalCountQuery1);
    $totalCountRow1 = mysqli_fetch_assoc($totalCountResult1);
    $totalCount1 = $totalCountRow1['total_count'];

    // Total sales
    $totalSalesQuery1 = "SELECT SUM(o.order_price) AS total_sales
                        FROM orders o
                        JOIN picture p ON o.picture_id = p.PICTURE_ID
                        JOIN picture_type pt ON p.PICTURETYPE_NAME = pt.PICTURETYPE_NAME
                        WHERE pt.PICTURETYPE_NAME = '$pictureTypeName1'";
    $totalSalesResult1 = mysqli_query($con1, $totalSalesQuery1);
    $totalSalesRow1 = mysqli_fetch_assoc($totalSalesResult1);
    $totalSales1 = $totalSalesRow1['total_sales'];

    $totalCountsAndSalesPictureType1[] = array(
        'pictureType' => $pictureTypeName1,
        'totalCount' => $totalCount1,
        'totalSales' => $totalSales1
    );
}
?>
</html>

<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<div style="display: flex; justify-content: space-around;">

  <!-- Doughnut Chart for Total Order Counts -->
  <canvas id="myDoughnutChartCountsNew1" style="width:100%;max-width:600px"></canvas>

  <!-- Doughnut Chart for Total Sales -->
  <canvas id="myDoughnutChartSalesNew1" style="width:100%;max-width:600px"></canvas>

</div>

<script>
var dataCountsAndSalesPictureType1 = <?php echo json_encode($totalCountsAndSalesPictureType1); ?>;
var labels1 = dataCountsAndSalesPictureType1.map(item => item.pictureType);
var doughnutCountsData1 = dataCountsAndSalesPictureType1.map(item => item.totalCount);
var doughnutSalesData1 = dataCountsAndSalesPictureType1.map(item => item.totalSales);

var doughnutColors1 = [
    "#FFD1DC",
    "#FFA07A",
    "#FFDEAD",
    "#B0E0E6",
    "#98FB98",
    "#FFB6C1"
];

// Doughnut Chart for Total Order Counts
new Chart("myDoughnutChartCountsNew1", {
  type: "doughnut",
  data: {
    labels: labels1,
    datasets: [{
      label: "Total Order Counts",
      data: doughnutCountsData1,
      backgroundColor: doughnutColors1
    }]
  },
  options: {
    title: {
      display: true,
      text: "Total Order Counts by Picture Type"
    },
    tooltips: {
      callbacks: {
        label: function (tooltipItem, data) {
          return data.labels[tooltipItem.index] + ': ' + doughnutCountsData1[tooltipItem.index] + ' orders';
        }
      }
    }
  }
});

// Doughnut Chart for Total Sales
new Chart("myDoughnutChartSalesNew1", {
  type: "doughnut",
  data: {
    labels: labels1,
    datasets: [{
      label: "Total Sales",
      data: doughnutSalesData1,
      backgroundColor: doughnutColors1
    }]
  },
  options: {
    title: {
      display: true,
      text: "Total Sales by Picture Type"
    },
    tooltips: {
      callbacks: {
        label: function (tooltipItem, data) {
          return data.labels[tooltipItem.index] + ': $' + doughnutSalesData1[tooltipItem.index];
        }
      }
    }
  }
});
</script>

</body>
</html>
