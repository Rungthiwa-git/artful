<?php
include 'condb.php';

if(isset($_GET['coupon_id'])) {
    $coupon_id = $_GET['coupon_id'];
    $sql = "SELECT * FROM coupons WHERE COUPON_ID = '$coupon_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "Coupon not found";
    }
} else {
    echo "Invalid request";
}

$con->close();
?>
