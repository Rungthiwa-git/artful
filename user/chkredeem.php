<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
    exit();
}

// Include necessary files
include('condb.php');

// Get user ID and points
$userId = $_SESSION['USER_ID'];
$sqlMemberPoints = "SELECT USER_POINTS FROM user WHERE USER_ID = '$userId'";
$resultMemberPoints = mysqli_query($con, $sqlMemberPoints);

if ($resultMemberPoints->num_rows > 0) {
    $row = $resultMemberPoints->fetch_assoc();
    $userPoints = $row['USER_POINTS'];
} else {
    // Redirect if user data is not found
    header("Location: pointshop.php");
    exit();
}

// Get image ID from the request
if (isset($_GET['imageId'])) {
    $imageId = $_GET['imageId'];

    // Check if the user has already redeemed the same picture
    $sqlCheckRedeemed = "SELECT * FROM orders WHERE picture_id = '$imageId' AND user_id = '$userId'";
    $resultCheckRedeemed = mysqli_query($con, $sqlCheckRedeemed);

    if ($resultCheckRedeemed->num_rows > 0) {
        // Display an alert indicating that the picture has already been redeemed
        echo '<script>alert("You have already redeemed this picture."); window.location.href = "pointshop.php";</script>';
        exit();
    }

    // Check if the user has already bought the same picture (based on both userid and pictureid)
    $sqlCheckDuplicatePurchase = "SELECT * FROM orders WHERE picture_id = '$imageId' AND user_id = '$userId'";
    $resultCheckDuplicatePurchase = mysqli_query($con, $sqlCheckDuplicatePurchase);

    if ($resultCheckDuplicatePurchase->num_rows > 0) {
        // Display an alert indicating that the user has already bought the same picture
        echo '<script>alert("You have already purchased this picture."); window.location.href = "pointshop.php";</script>';
        exit();
    }

    // Fetch data for the selected image
    $sqlImageDetails = "SELECT picture.*, picpoints.PICPOINTS
                        FROM picpoints
                        JOIN picture ON picpoints.PICTURE_ID = picture.PICTURE_ID
                        WHERE picture.PICTURE_ID = '$imageId'";

    $resultImageDetails = mysqli_query($con, $sqlImageDetails);

    if ($resultImageDetails->num_rows > 0) {
        $imageDetails = $resultImageDetails->fetch_assoc();

        // Now you can use $imageDetails array to display or process the details as needed
        $imageName = $imageDetails['PICTURE_NAME'];
        $imagePath = $imageDetails['PICTURE_IMAGELINE'];
        $imgPoints = $imageDetails['PICPOINTS'];

        // Check if the user has enough points
        if ($userPoints >= $imgPoints) {
            // Perform the redemption process here
            // ...

            // Update user points after redemption (example: deduct points)
            $updatedPoints = $userPoints - $imgPoints;
            $sqlUpdatePoints = "UPDATE user SET USER_POINTS = '$updatedPoints' WHERE USER_ID = '$userId'";
            $resultUpdatePoints = mysqli_query($con, $sqlUpdatePoints);

            if ($resultUpdatePoints) {
                // Insert into orders table
                $sqlInsertOrder = "INSERT INTO orders (picture_id, user_id, order_timestamp) VALUES ('$imageId', '$userId', NOW())";
                $resultInsertOrder = mysqli_query($con, $sqlInsertOrder);

                if ($resultInsertOrder) {
                    // Display an alert for successful redemption
                    echo '<script>alert("Redemption successful!"); window.location.href = "gallery.php";</script>';
                    exit();
                } else {
                    // Handle order insertion error
                    echo '<script>alert("Error inserting order record."); window.location.href = "pointshop.php";</script>';
                    exit();
                }
                
            } else {
                // Handle points update error
                echo '<script>alert("Error updating points."); window.location.href = "pointshop.php";</script>';
                exit();
            }
        } else {
            // Display an alert for insufficient points
            echo '<script>alert("Insufficient points to redeem this picture."); window.location.href = "pointshop.php";</script>';
            exit();
        }
    } else {
        // Handle error if image details are not found
        echo '<script>alert("Error: Image details not found."); window.location.href = "pointshop.php";</script>';
        exit();
    }
} else {
    // Redirect if image ID is not provided
    echo '<script>alert("Error: Image ID not provided."); window.location.href = "pointshop.php";</script>';
    exit();
}
?>
