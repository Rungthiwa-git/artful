<?php
include 'condb.php'; // เชื่อมต่อกับฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากแบบฟอร์ม
    $picture_name = $_POST['picture_name'];
    $picture_category = $_POST['picture_category'];
    $picture_type = $_POST['picture_type'];
    $picture_points = $_POST['picture_points'];
    $picture_user = $_POST['picture_user'];
    $file_name = $_FILES["pic"]["name"];
    $file_tmp = $_FILES["pic"]["tmp_name"]; 
    move_uploaded_file($file_tmp, "../img/" . $file_name);

    // เตรียมคำสั่ง SQL INSERT สำหรับตาราง "picture"
    $sql_insert_picture = "INSERT INTO picture (PICTURE_NAME, CATEGORY_NAME, PICTURETYPE_NAME, PICTURE_IMAGELINE,USER_NAME) VALUES (?, ?, ?, ?,?)";
    $stmt_insert_picture = $con->prepare($sql_insert_picture);
    
    // bind parameter เพื่อป้องกัน SQL injection
    $stmt_insert_picture->bind_param("sssss", $picture_name, $picture_category, $picture_type, $file_name,$picture_user);
    
    // ประมวลผลคำสั่ง SQL สำหรับการเพิ่มข้อมูลในตาราง "picture"
    if ($stmt_insert_picture->execute()) {
        echo "Record inserted successfully in picture table.";
        
        // เรียกใช้คำสั่ง SQL เพื่อให้ค่า PICTURE_ID ที่ถูกเพิ่มล่าสุด
        $last_picture_id = $con->insert_id;

        // เตรียมคำสั่ง SQL INSERT สำหรับตาราง "picpoints"
        $sql_insert_picpoints = "INSERT INTO picpoints (PICTURE_ID, PICPOINTS) VALUES (?, ?)";
        $stmt_insert_picpoints = $con->prepare($sql_insert_picpoints);
        
        // bind parameter เพื่อป้องกัน SQL injection
        $stmt_insert_picpoints->bind_param("ii", $last_picture_id, $picture_points);
        
        // ประมวลผลคำสั่ง SQL สำหรับการเพิ่มข้อมูลในตาราง "picpoints"
        if ($stmt_insert_picpoints->execute()) {
            header("Location: pointshop.php");
        } else {
            echo "Error: " . $sql_insert_picpoints . "<br>" . $con->error;
        }
        
        // ปิดการใช้งานคำสั่ง SQL
        $stmt_insert_picpoints->close();
    } else {
        echo "Error: " . $sql_insert_picture . "<br>" . $con->error;
    }
    
    // ปิดการใช้งานคำสั่ง SQL
    $stmt_insert_picture->close();
    $con->close();
} else {
    echo "Error: No file uploaded or invalid request method.";
}
?>
