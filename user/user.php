<?php
include 'condb.php';
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userstyles.css">
    <title>Home</title>
</head>
<style>
    .centered-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: -60px; /* ปรับระยะห่างด้านบน */
}
</style>
<body>
 <?php include 'nav.php'?>
 <nav class="navbar navbar-inverse navbar-fixed-top">
 <div class="container-fluid" style="background-color: #FFBDDA; margin-bottom: -10x; height: 120px; line-height: 120px; ">
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
    </nav>
    <br><br><br><br><br>
    <div id="floatingEmoji" style="font-size: 50px; position: fixed;">❤️</div>
    <div id="floatingEmoji" style="font-size: 50px; position: fixed;">⭐</div>
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
        <div class="centered-text">
            <h1>Turn beauty into<span style="color: red;">&nbsp;&nbsp;&nbsp;"picture"</span></h1>
            <h1>in every moment.</h1>
        </div>
 <br>
 <br>
 <br>
 <br>
 <br>
 <?php
    include 'condb.php';
    $sql1 = "SELECT PICTURE_ID,PICTURE_IMAGELINE FROM picture WHERE  PICTURE_PRICE !=0" ;
    $result1 = mysqli_query($con, $sql1);

if ($result1->num_rows > 0) {
    $images = array();

    while ($row = $result1->fetch_assoc()) {
        $imageId = $row['PICTURE_ID'];
        $imagePath = $row['PICTURE_IMAGELINE'];

        $images[] = '<div class="col-lg-4 col-sm-6">
                        <a href="detailpiture.php?id=' . $imageId . '">
                            <img src="../img/' . $imagePath . '" alt="Image" style="width: 100%; height: 400px;" onclick="window.location=\'detailpiture.php?id=' . $imageId . '\';">
                        </a>
                    </div>';
    }

    shuffle($images); // Shuffle the array randomly
    $selectedImages = array_slice($images, 0, 6); // Get the first 3 elements   

    echo '<div class="row">' . implode('', $selectedImages) . '</div>';
}


?>

    </div>
    
</body>
</html>