<?php
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}
include('condb.php');
$user_id = $_SESSION['USER_ID'];
$sql = "SELECT USER_NAME FROM user WHERE USER_ID = $user_id";
$result = mysqli_query($con, $sql);


if ($result) {
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['USER_NAME'];
} else {
    echo "Error retrieving user data.";
}
$name = $_POST["name"];
$price = $_POST["price"];
$category = $_POST["category"];
$type = $_POST["type"];
$file_name = $_FILES["pic"]["name"];
$file_tmp = $_FILES["pic"]["tmp_name"];
move_uploaded_file($file_tmp, "../img/" . $file_name);


$sql1 = "INSERT INTO picture(PICTURE_NAME, PICTURE_PRICE, CATEGORY_NAME, PICTURETYPE_NAME, PICTURE_IMAGELINE, USER_NAME,USER_ID)
        VALUES('$name', '$price', '$category', '$type', '$file_name', '$user_name',$user_id)";

$result1 = mysqli_query($con, $sql1) or die("Error in query: $sql1");
if ($result1) {
    echo "<script type='text/javascript'>";
    echo "alert('Succeeded!');";
    echo "window.location = 'mypicture.php'";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error up lode!');";
    echo "window.history.back()";
    echo "</script>";
}
mysqli_close($con);