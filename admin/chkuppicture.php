<?php
include 'condb.php';

// ตรวจสอบว่ามีการส่งข้อมูลมาแบบ POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์มและทำการเก็บไว้ในตัวแปร
    $picture_name = $_POST['picture_name'];
    $picture_category = $_POST['picture_category'];
    $picture_type = $_POST['picture_type'];
    $picture_points = $_POST['picture_points'];
    $picture_user = $_POST['picture_user'];

    // ตรวจสอบว่ามีค่าของ PICTURE_ID ใน URL หรือไม่
    if(isset($_POST['picture_id'])) {
        $picture_id = $_POST['picture_id'];

        // อัปเดตข้อมูลในตาราง picture
        $sql_picture = "UPDATE picture SET PICTURE_NAME = '$picture_name', CATEGORY_NAME = '$picture_category', PICTURETYPE_NAME = '$picture_type', USER_NAME = '$picture_user' WHERE PICTURE_ID = '$picture_id'";
        $result_picture = mysqli_query($con, $sql_picture);

        // อัปเดตข้อมูลในตาราง picpoints
        $sql_picpoints = "UPDATE picpoints SET PICPOINTS = '$picture_points' WHERE PICTURE_ID = '$picture_id'";
        $result_picpoints = mysqli_query($con, $sql_picpoints);

        // ตรวจสอบการอัปเดตข้อมูล
        if ($result_picture && $result_picpoints) {
            echo "Data updated successfully.";
            header("Location: pointshop.php");
            exit; // ออกจากการทำงานของสคริปต์หลังจาก redirect
        } else {
            echo "Error updating data: " . mysqli_error($con);
        }
    } else {
        echo "No picture ID provided."; // แสดงข้อความหากไม่มี picture ID ใน URL
    }
}
?>
