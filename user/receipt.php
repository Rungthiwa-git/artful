<?php
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}

include('condb.php');

// Display items and total price
// Retrieve user's name
$user_id = $_SESSION['USER_ID'];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['apply_coupon'])) {
    // Retrieve coupon code from the form
    $coupon_code = $_POST['coupon_code'];

    echo "<script type='text/javascript'>";
    echo "alert('Coupon applied successfully!');";
    echo "</script>";
}

$sqlUserInfo = "SELECT * FROM user WHERE USER_ID = '$user_id'";
$resultUserInfo = mysqli_query($con, $sqlUserInfo);
if (!$resultUserInfo) {
    die("Error in user info query: " . mysqli_error($con));
}

$userInfo = mysqli_fetch_assoc($resultUserInfo);
$userFirstName = $userInfo['USER_FIRSTNAME'];
$userLastName = $userInfo['USER_LASTNAME'];

$sqlSelect = "SELECT * FROM cart WHERE USER_ID = '$user_id'";
$result = mysqli_query($con, $sqlSelect);

if (!$result) {
    die("Error in cart query: " . mysqli_error($con));
}


// Initialize itemsHTML
$itemsHTML = '';

$totalPrice = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $pictureId = $row['PICTURE_ID'];
    $pictureSql = "SELECT * FROM picture WHERE PICTURE_ID = $pictureId";
    $pictureResult = mysqli_query($con, $pictureSql);
    $pictureData = mysqli_fetch_assoc($pictureResult);

    $itemsHTML .= "<tr>";
    $itemsHTML .="<td><img src='../img/" . $pictureData['PICTURE_IMAGELINE'] . "' width='50' height='50'></td>";
    $itemsHTML .= "<td>" . $pictureData['PICTURE_NAME'] . "</td>";
    $itemsHTML .= "<td>" . $pictureData['CATEGORY_NAME'] . "</td>";
    $itemsHTML .= "<td>" . $pictureData['PICTURE_PRICE'] . "</td>";
    $itemsHTML .= "</tr>";
    $totalPrice += $pictureData['PICTURE_PRICE'];
    $totalpoints = floor($totalPrice / 3);
}

// Apply Coupon Logic
$appliedCouponName = ''; // Initialize the variable to store the applied coupon name
$discountPercentage = 0; // Initialize the variable to store the discount percentage

if (isset($_POST['apply_coupon'])) {
    $couponCode = mysqli_real_escape_string($con, $_POST['coupon_code']);

    // Retrieve coupon information
    $couponSql = "SELECT * FROM coupons WHERE coupon_code = '$couponCode'";
    $couponResult = mysqli_query($con, $couponSql);

    if ($couponResult) {
        $couponData = mysqli_fetch_assoc($couponResult);

        if ($couponData) {
            // Check coupon conditions for expiry_date
            $expiryDate = strtotime($couponData['expiry_date']);

            // Check if coupon has not expired
            if (time() <= $expiryDate) {
                // Check coupon conditions for min_purchase_amount
                $minPurchaseAmount = $couponData['min_purchase_amount'];

                // Check if total price meets min purchase amount condition
                if ($totalPrice >= $minPurchaseAmount) {
                    $discountPercentage = $couponData['discount_percentage']; // Get the discount percentage from the coupon data
                    $appliedCouponName = $couponData['coupon_code']; // Store the applied coupon name

                    // Calculate discount amount
                    $discountAmount = ($totalPrice * $discountPercentage) / 100;

                    // Ensure the total price does not go below zero
                    $totalPrice -= $discountAmount;
                    $totalPrice = max(0, $totalPrice);

                    // Display coupon_name in the table
                    $itemsHTML .= "<tr>";
                    $itemsHTML .= "<td colspan='3'><strong>Discount</strong></td>";
                    $itemsHTML .= "<td><strong>$discountPercentage %</strong></td>"; // Display the discount percentage
                    $itemsHTML .= "</tr>";
                } else {
                    // Coupon conditions for min_purchase_amount not met
                    // Display an alert using JavaScript
                    echo "<script>alert('The minimum purchase amount for this coupon is $minPurchaseAmount');</script>";
                }
            } else {
                // Coupon conditions for expiry_date not met
                // Display an alert using JavaScript
                echo "<script>alert('This discount is valid until " . date('Y-m-d', $expiryDate) . ".');</script>";
            }
        } else {
            // Coupon not found
            // Display an alert using JavaScript
            echo "<script>alert('Coupon not found.');</script>";
        }
    } else {
        // Database query error
        // Display an alert using JavaScript
        echo "<script>alert('Error retrieving coupon information.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Other HTML document parts as appropriate -->
    <link rel="stylesheet" href="receipt.css">
    <title>Receipt</title>
    <!-- Add CSS links as needed -->
</head>

<body>
    <?php include('nav.php') ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
 <div class="container-fluid" style="background-color: #FFBDDA; margin-bottom: -10x; height: 120px; line-height: 120px; ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#alberto" aria-expanded="false" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="img/logo.png" alt="Logo" style="max-width: 160px; margin-left: -100px; height: auto; margin-bottom: -20px; margin-top: -20px;" href="index.php">
            </div>

            <div class="collapse navbar-collapse" id="alberto">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">logout</a></li>
                <li><a href="cart.php"><i class="bi bi-cart4"></i></a></li>
                <li><a href="profile.php"><i class="bi bi-person-circle" aria-hidden="true"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="user.php" class="btn btn-primary"style="color: white;">Home</a></li>
                <li><a href="picture.php" class="btn btn-primary" style="color: white;"><i class="bi bi-shop"></i> Picture</a></li>
                <li><a href="upload.php" class="btn btn-primary" style="color: white;"><i class="bi bi-cloud-upload"></i> Uplode</a></li>
                <li><a href="gallery.php" class="btn btn-primary" style="color: white;"><i class="bi bi-images"></i> Gallery</a></li>
                <li><a href="pointshop.php" class="btn btn-primary" style="color: white;"><i class="bi bi-coin"></i> Points shop</a></li>
                <li><a href="coupon.php" class="btn btn-primary" style="color: white;"><i class="bi bi-tag"></i> Coupon</a></li>

            </ul>
        </div>
        </div>
    </nav>
    <br><br><br><br><br>
    <div class="container">
        <h1>
            <font size="6" class="text-right">Receipt</font>
        </h1>
        <p>Date: <?php echo date("Y-m-d H:i:s")?></p>
        <p>Buyer: <?php echo $userFirstName . " " . $userLastName; ?></p>
        <table border="1">
            <thead>
                <tr class="danger">
                    <th width="40%">&nbsp;&nbsp;Picture</th>
                    <th width="30%">&nbsp;&nbsp;Picture Name</th>
                    <th width="25%">&nbsp;&nbsp;Category</th>
                    <th width="20%">&nbsp;&nbsp;Price&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php echo  $itemsHTML; ?>
                <tr>
                    <td colspan="3"><strong>&nbsp;&nbsp;Total Price:</strong></td>
                    <td><strong><?php echo $totalPrice; ?></strong></td>
                </tr>


                <?php if ($appliedCouponName !== '') : ?>
                <tr>
                    <td colspan="3"><strong>Coupon Name:</strong></td>
                    <td><strong><?php echo $appliedCouponName; ?></strong></td>
                </tr>
                <?php endif; ?>

            

                <tr>
                    <td colspan="3"><strong>&nbsp;&nbsp;Points you will get:</strong></td>
                    <td><strong><?php echo   $totalpoints; ?></strong></td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <br>
    <label for="coupon_code">Coupon Code:</label>
    <br>
    <input type="text" name="coupon_code" id="coupon_code" style="background-color: #FFC0CB; border: 3px solid #F9F1F5; padding: 5px; width: 20%;">
    <br><br>
    <button type="submit" name="apply_coupon">Apply Coupon</button>
</form>
        <br>
        <br>
        <br>
        <script>
    function printReceipt() {
        window.print(); // เรียกใช้งานหน้าจอพิมพ์
    }
    </script>
        <a href="chkbuy.php" class="btn btn-success" onclick="printReceipt();">CONFIRM & bill</a>
        <a href="cart.php" class="btn btn-primary">BACK</a>
    </div>
    <style>
    .table td strong {
        margin-right: 10px; /* ปรับระยะห่างขวาของตัวอักษร */
    }
</style>
</body>

</html>
