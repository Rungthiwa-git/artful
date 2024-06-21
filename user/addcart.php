<?php
include 'condb.php';
session_start();

// ตรวจสอบว่ามี User ID ที่ถูกส่งมาใน Session และไม่มี Picture ID ที่ถูกส่งมาใน Session
if (isset($_SESSION['USER_ID']) && isset($_SESSION['PICTURE_ID'])) {
    // รับค่า User ID และ Picture ID จาก Session
    $userId = $_SESSION['USER_ID'];
    $pictureId = $_SESSION['PICTURE_ID'];

    // ตรวจสอบว่าข้อมูลซ้ำกันหรือไม่ในตาราง orders
    $checkOrderSql = "SELECT * FROM orders WHERE USER_ID = '$userId' AND PICTURE_ID = '$pictureId'";
    $checkOrderResult = mysqli_query($con, $checkOrderSql);

    if (mysqli_num_rows($checkOrderResult) > 0) {
        echo "<script type='text/javascript'>";
        echo "alert('This item is already in your order!');";
        echo "window.history.back()";
        echo "</script>";
    } else {
        // ตรวจสอบว่าข้อมูลซ้ำกันหรือไม่ในตาราง cart
        $checkCartSql = "SELECT * FROM cart WHERE USER_ID = '$userId' AND PICTURE_ID = '$pictureId'";
        $checkCartResult = mysqli_query($con, $checkCartSql);

        if (mysqli_num_rows($checkCartResult) > 0) {
            echo "<script type='text/javascript'>";
            echo "alert('This item is already in your cart!');";
            echo "window.history.back()";
            echo "</script>";
        } else {
            // เพิ่มข้อมูลลงในตาราง CART
            $insertSql = "INSERT INTO cart (USER_ID, PICTURE_ID) VALUES ('$userId', '$pictureId')";
            $insertResult = mysqli_query($con, $insertSql);

            if ($insertResult) {
                echo "<script type='text/javascript'>";
                echo "alert('Succeeded!');";
                echo "window.location = 'picture.php'";
                echo "</script>";
            } else {
                echo "<script type='text/javascript'>";
                echo "alert('Error uploading!');";
                echo "window.history.back()";
                echo "</script>";
            }
        }
    }

    mysqli_close($con);
} else {
    echo "Invalid request.";
}
?>
