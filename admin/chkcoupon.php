<?php
// รับค่าที่ส่งมาจากฟอร์ม
$coupon_code = $_POST['coupon_code'];
$discount_percentage = $_POST['discount_percentage'];
$min_purchase_amount = $_POST['min_purchase_amount'];
$expiry_date = $_POST['expiry_date'];
$coupon_detail = $_POST['coupon_detail'];
$coupon_name = $_POST['coupon_name'];

// เชื่อมต่อกับฐานข้อมูล
include 'condb.php';

// เตรียมคำสั่ง SQL สำหรับแทรกข้อมูล
$sql = "INSERT INTO coupons (coupon_code, discount_percentage, min_purchase_amount, expiry_date, coupon_detail, coupon_name)
        VALUES ('$coupon_code', '$discount_percentage', '$min_purchase_amount', '$expiry_date', '$coupon_detail', '$coupon_name')";

// ทำการ execute คำสั่ง SQL
if ($con->query($sql) === TRUE) {
    // ถ้าเพิ่มข้อมูลสำเร็จ ให้ redirect กลับไปยังหน้า coupon.php
    echo '<script>window.location = "coupon.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$con->close();
?>
