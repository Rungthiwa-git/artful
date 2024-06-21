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
    $user_login = $row['USER_NAME'];
    echo $user_login;
}
?>