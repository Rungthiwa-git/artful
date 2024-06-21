<?php
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}

include('condb.php');
$user_id = $_SESSION['USER_ID'];

// SQL query to retrieve picture information from 'picture' table based on 'orders' table
$sql = "SELECT p.* FROM orders o
        JOIN picture p ON o.picture_id = p.PICTURE_ID
        WHERE o.user_id = $user_id";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error in query: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="gallerystyles.css">
<head>


    <title>TRADING HISTORY</title>


    <style>
       .download-link a {
    display: block;
    width: 100%;
    height: 100%;
    background-color: #fec3df;
    color: #0056b3;
    text-decoration: none;
    text-align: center;
    padding: 10px 0; /* เพิ่ม padding เพื่อทำให้ปุ่มดูสวยงาม */
    border-radius: 20px; /* เพิ่ม border-radius เพื่อทำให้มีมุมโค้ง */
}

.download-link a:hover {
    background-color: #FF81D3; /* สีเมื่อ hover */
}

        
    </style>

        
</head>

<body>
    <?php include('nav.php') ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid" style="background-color: #FFBDDA; margin-bottom: -10x;  ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#alberto" aria-expanded="false" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="img/logo.png" alt="Logo" style="max-width: 160px; margin-left: -100px; height: auto; margin-bottom: -20px; margin-top: -20px;" href="index.php">
            </div>

            <div class="collapse navbar-collapse" id="alberto">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">logout</a></li>
                <li><a href="cart.php"><i class="bi bi-cart4"></i></a></li>
                <li><a href="profile.php"><i class="bi bi-person-circle" aria-hidden="true"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="user.php" class="btn btn-primary"style="color: white;">Home</a></li>
                <li><a href="picture.php" class="btn btn-primary" style="color: white;"><i class="bi bi-shop"></i> Picture</a></li>
                <li><a href="upload.php" class="btn btn-primary" style="color: white;"><i class="bi bi-cloud-upload"></i> Uplode</a></li>
                <li><a href="gallery.php" class="btn btn-primary" style="color: white;"><i class="bi bi-images"></i> Gallery</a></li>
                <li><a href="pointshop.php" class="btn btn-primary" style="color: white;"><i class="bi bi-coin"></i> Points shop</a></li>
                <li><a href="coupon.php" class="btn btn-primary" style="color: white;"><i class="bi bi-tag"></i> Coupon</a></li>

            </ul>
        </div>
        </div>
    </nav><br><br><br>
    <div id="floatingEmoji" style="font-size: 50px; position: fixed;">❤️</div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const emoji = document.getElementById('floatingEmoji');

            function moveEmoji() {
                const x = Math.random() * (window.innerWidth - emoji.clientWidth);
                const y = Math.random() * (window.innerHeight - emoji.clientHeight);

                emoji.style.left = x + 'px';
                emoji.style.top = y + 'px';
            }

            moveEmoji(); // ย้ายอิโมจิเมื่อหน้าเว็บโหลด
            setInterval(moveEmoji, 3000); // ย้ายทุก 5 วินาที
        });
    </script>
    <div class="container">
        <h1>
            <font size="6" class="text-right">Gallery</font>
        </h1>

        <br><br>
        <table id='example' class="display table table-bordered table-hover table-striped">
            <thead>
                <tr class="danger">
                    <th width="20%">Picture</th>
                    <th width="20%">Name</th>
                    <th width="10%">Category</th>
                    <th width="10%">Action &#x1F4E6;</th>
                </tr>
            </thead>
            <tbody>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td><img src='../img/" . $row['PICTURE_IMAGELINE'] . "' width='50' height='50'></td>";
                    echo "<td>" . $row['PICTURE_NAME'] . "</td>";
                    echo "<td>" . $row['CATEGORY_NAME'] . "</td>";
                    echo "<td class='download-link'><a href='../img/" . $row['PICTURE_IMAGELINE'] . "' download>Download</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>