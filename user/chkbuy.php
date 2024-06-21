<?php
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
    exit();
}

include('condb.php');
$user_id = $_SESSION['USER_ID'];

// Retrieve items from the cart
$sqlSelect = "SELECT * FROM cart WHERE USER_ID = '$user_id'";
$resultSelect = mysqli_query($con, $sqlSelect);

if (!$resultSelect) {
    die("Error in query: " . mysqli_error($con));
}

// Calculate total points
$totalPrice = 0;
while ($row = mysqli_fetch_assoc($resultSelect)) {
    $picture_id = $row['PICTURE_ID'];
    $pictureSql = "SELECT * FROM picture WHERE PICTURE_ID = $picture_id";
    $pictureResult = mysqli_query($con, $pictureSql);
    $pictureData = mysqli_fetch_assoc($pictureResult);
    $totalPrice += $pictureData['PICTURE_PRICE'];
}

// Calculate total points (1 point for every 3 in total price)
$totalpoints = floor($totalPrice / 3);

// Update USER_POINTS in the user table
$sqlUpdatePoints = "UPDATE user SET USER_POINTS = USER_POINTS + $totalpoints WHERE USER_ID = '$user_id'";
$resultUpdatePoints = mysqli_query($con, $sqlUpdatePoints);

if (!$resultUpdatePoints) {
    die("Error updating user points: " . mysqli_error($con));
}

// Insert items into orders table
$resultSelect = mysqli_query($con, $sqlSelect);  // Reset result set
while ($row = mysqli_fetch_assoc($resultSelect)) {
    $picture_id = $row['PICTURE_ID'];

    // Retrieve picture price
    $pictureSql = "SELECT PICTURE_PRICE FROM picture WHERE PICTURE_ID = $picture_id";
    $pictureResult = mysqli_query($con, $pictureSql);
    $pictureData = mysqli_fetch_assoc($pictureResult);
    $picturePrice = $pictureData['PICTURE_PRICE'];

    // Insert into orders table with picture price
    $sqlInsert = "INSERT INTO orders (picture_id, user_id, order_price) VALUES ('$picture_id', '$user_id', '$picturePrice')";
    $resultInsert = mysqli_query($con, $sqlInsert);

    if (!$resultInsert) {
        die("Error inserting order record: " . mysqli_error($con));
    }
}

// Clear items from the cart after purchase
$sqlDelete = "DELETE FROM cart WHERE USER_ID = '$user_id'";
$resultDelete = mysqli_query($con, $sqlDelete);

if ($resultDelete) {
    echo "<script type='text/javascript'>";
    echo "alert('Succeeded! You earned $totalpoints points.');";
    echo "window.location = 'gallery.php'";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error buying!');";
    echo "window.history.back()";
    echo "</script>";
}
exit();
?>
