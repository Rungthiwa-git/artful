<?php
include 'condb.php';

if(isset($_POST['edit_coupon_code']) && isset($_POST['edit_discount_percentage']) && isset($_POST['edit_min_purchase_amount']) && isset($_POST['edit_expiry_date']) && isset($_POST['edit_coupon_detail']) && isset($_POST['edit_coupon_name']) && isset($_POST['edit_coupon_id'])) {
    $edit_coupon_code = $_POST['edit_coupon_code'];
    $edit_discount_percentage = $_POST['edit_discount_percentage'];
    $edit_min_purchase_amount = $_POST['edit_min_purchase_amount'];
    $edit_expiry_date = $_POST['edit_expiry_date'];
    $edit_coupon_detail = $_POST['edit_coupon_detail'];
    $edit_coupon_name = $_POST['edit_coupon_name'];
    $edit_coupon_id = $_POST['edit_coupon_id'];

    $sql = "UPDATE coupons SET coupon_code = '$edit_coupon_code', discount_percentage = '$edit_discount_percentage', min_purchase_amount = '$edit_min_purchase_amount', expiry_date = '$edit_expiry_date', coupon_detail = '$edit_coupon_detail', coupon_name = '$edit_coupon_name' WHERE COUPON_ID = '$edit_coupon_id'";

    if ($con->query($sql) === TRUE) {
        // หลังจากที่คำสั่ง SQL สำหรับอัปเดตคูปองสำเร็จ ให้ทำการ redirect กลับไปยังหน้า coupon.php
        echo '<script>window.location = "coupon.php";</script>';
    } else {
        echo "Error updating coupon: " . $con->error;
    }
} else {
    echo "Invalid request";
}

$con->close();
?>
