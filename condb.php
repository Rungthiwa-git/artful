<?php
// ข้อมูลการเชื่อมต่อฐานข้อมูล
$host = "localhost"; // ชื่อ Host
$user ="root"; // ชื่อผู้ใช้ฐานข้อมูล
$password = ""; // รหัสผ่านฐานข้อมูล
$database = "ip"; // ชื่อฐานข้อมูล

// การเชื่อมต่อกับ MySQL
$con = mysqli_connect($host, $user, $password, $database);


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con, "utf8");
?>
