<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture Order Counts</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
// Establish database connection
$con1 = mysqli_connect("localhost", "root", "", "ip") or die("Error: " . mysqli_error($con1));
mysqli_query($con1, "SET NAMES 'utf8'");
date_default_timezone_set('Asia/Bangkok');

// SQL query to get picture order counts and total price
$query = "SELECT o.picture_id, COUNT(*) AS order_count, SUM(o.order_price) AS total_price, p.CATEGORY_NAME, p.PICTURE_IMAGELINE
          FROM orders o
          INNER JOIN picture p ON o.picture_id = p.PICTURE_ID
          GROUP BY o.picture_id";
$result = mysqli_query($con1, $query);

// Check if the query was successful
if ($result) {
    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        // Output table header with sorting functionality
        echo "<table>";
        echo "<tr><th onclick='sortTable(0)'>Picture ID</th><th onclick='sortTable(1)'>Order Count</th><th onclick='sortTable(2)'>Total Price</th><th>Image</th><th>Category</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["picture_id"] . "</td>";
            echo "<td>" . $row["order_count"] . "</td>";
            echo "<td>" . $row["total_price"] . "</td>";
            //echo "<td style='width: 100px; height: 100px;'><img class='image' src='../img/" . $row['PICTURE_IMAGELINE'] . "' alt='Picture'></td>";
            echo "<td>" . $row["CATEGORY_NAME"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "0 results";
    }
} else {
    // Output any MySQL errors
    echo "Error: " . mysqli_error($con1);
}

// Close connection
mysqli_close($con1);
?>
<!-- JavaScript for table sorting -->
<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.querySelector("table");
    switching = true;
    dir = "asc"; 
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];
            if (dir == "asc") {
                if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++; 
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>

</body>
</html>
