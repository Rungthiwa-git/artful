<?php
include 'condb.php'; // เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล

// รับค่า coupon_id จากคำขอ AJAX
$couponId = $_POST['coupon_id'];

// ลบข้อมูลจากฐานข้อมูล
$sql = "DELETE FROM coupons WHERE COUPON_ID = $couponId";

if ($con->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $con->error;
}

$con->close();
?>
