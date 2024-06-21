<?php
session_start();

// ตรวจสอบว่ามี User ID ที่ถูกส่งมาใน Session หรือไม่
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
    exit(); // Make sure to stop script execution after redirection
}

include 'condb.php';

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : 'all';
$userID = $_SESSION['USER_ID'];

// เพิ่มการรับค่าชื่อรูปภาพจาก URL
$imageName = isset($_GET['imageName']) ? $_GET['imageName'] : '';

$sqlImages = "SELECT PICTURE_ID, PICTURE_IMAGELINE, PICTURE_NAME, PICTURE_PRICE FROM picture WHERE USER_ID != '$userID' AND PICTURE_PRICE != 0";


if ($categoryFilter !== 'all') {
    $sqlImages .= " AND CATEGORY_NAME = '$categoryFilter'";
}

// เพิ่มเงื่อนไขค้นหาด้วยชื่อรูปภาพ
if (!empty($imageName)) {
    $sqlImages .= " AND PICTURE_NAME LIKE '%$imageName%'";
}

$resultImages = mysqli_query($con, $sqlImages);

if ($resultImages->num_rows > 0) {
    $images = array();
    $count = 0;

    while ($row = $resultImages->fetch_assoc()) {
        $imageId = $row['PICTURE_ID'];
        $imagePath = $row['PICTURE_IMAGELINE'];
        $imagename = $row['PICTURE_NAME'];

        $images[] = '<div class="col-lg-4 col-sm-6 mb-4">
                        <div class="card">
                             <a href="detailpiture.php?id=' . $imageId . '">
                            <img src="../img/' . $imagePath . '" class="card-img-top" alt="Image" style="width: 100%; height: 400px;" onclick="window.location=\'detailpicture.php?id=' . $imageId . '\';">
                            <div class="card-body">
                                <h5 class="card-title">Picture name: ' . $imagename . '</h5>
                                <!-- Add more details or actions as needed -->
                            </div>
                        </div>
                    </div>';

        $count++;

        // Display a new row after every 9 images
        if ($count % 9 === 0) {
            echo '<div class="row">' . implode('', $images) . '</div>';
            $images = array(); // Reset the array for the next row
        }
    }

    // Display the remaining images if not a multiple of 9
    if (!empty($images)) {
        echo '<div class="row">' . implode('', $images) . '</div>';
    }
}
?>
