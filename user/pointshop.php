<?php
session_start();

// ตรวจสอบว่ามี User ID ที่ถูกส่งมาใน Session หรือไม่
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
    exit(); // Make sure to stop script execution after redirection
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="point.css">
    <title>Point Shop</title>
</head>
<body>
    <?php
    include ('nav.php');
    include ('condb.php');
    $userId = $_SESSION['USER_ID'];

    // เลือกข้อมูลของผู้ใช้รายบุคคล
    $sqlMemberPoints = "SELECT USER_POINTS FROM user WHERE USER_ID = '$userId'";
    $resultMemberPoints = mysqli_query($con, $sqlMemberPoints);

    // if ($resultMemberPoints->num_rows > 0) {
    //     while ($row = $resultMemberPoints->fetch_assoc()) {
    //         $userPoints = $row['USER_POINTS'];
    //         echo '<div style="border: 3px solid #ff69b4; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
    //                 <h2 style="color: #ff69b4;">Your Points</h2>
    //                 <p style="font-size: 18px; margin: 0; font-weight: bold;">'  . $userPoints . '</p>
    //             </div>';
    //     }
    // } else {
    //     echo '<div style="border: 2px solid #ff69b4; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
    //             <p style="color: #ff69b4; font-size: 18px; margin: 0;">No points found.</p>
    //         </div>';
    // }
    if ($resultMemberPoints->num_rows > 0) {
        while ($row = $resultMemberPoints->fetch_assoc()) {
            $userPoints = $row['USER_POINTS'];
            echo '<div style=" padding: 10px; border-radius: 5px; margin: 20px auto; width: fit-content; text-align: center;">
                   <br><br> <h2 style="color: #ff69b4; font-weight: bold;">Your Points</h2>
                    <p style="font-size: 18px; margin: 0; font-weight: bold;">'  . $userPoints . '</p>
                </div>';
        }
    } else {
        echo '<div style= "padding: 10px; border-radius: 5px; margin: 20px auto; width: fit-content; text-align: center;">
                <p style="color: #ff69b4; font-size: 18px; margin: 0;">No points found.</p>
            </div>';
    }
    
    

    $sqlImages = "SELECT picture.*, picpoints.PICPOINTS
    FROM picpoints
    JOIN picture ON picpoints.PICTURE_ID = picture.PICTURE_ID";

    $resultImages = mysqli_query($con, $sqlImages);

    if ($resultImages->num_rows > 0) {
        while ($row = $resultImages->fetch_assoc()) {
            // ปรับเปลี่ยนชื่อคอลัมน์ตามที่มีในตาราง picture
            $imageId = $row['PICTURE_ID'];
            $imagePath = $row['PICTURE_IMAGELINE'];
            $imagename = $row['PICTURE_NAME'];
            $imgpoints = $row['PICPOINTS'];

            echo '<div class="col-lg-4 col-sm-6 mb-4">
                <div class="card border ">
                    <a href="javascript:void(0);" onclick="confirmRedeem(' . $imageId . ', ' . $imgpoints . ')">
                        <img src="../img/' . $imagePath . '" class="card-img-top" alt="Image" style="width: 100%; height: 400px;" onclick="window.location=\'detailpicture.php?id=' . $imageId . '\';">
                        <div div class="card-body" style="color: #ff1493;">
                            <h5 class="card-title">Picture name: ' . $imagename . '</h5>
                            <p>Points: ' . $imgpoints . '</p>
                            <!-- Add more details or actions as needed -->
                        </div>
                    </div>
                </div>';
        }
    } else {
        echo "No images found.";
    }
    ?>
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
                <li><a href="logout.php" style="margin-top: -29px;">logout</a></li>
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
     <script>
    function confirmRedeem(imageId, requiredPoints) {
        if(<?php echo $userPoints; ?> < requiredPoints) {
            alert("Insufficient points. You need " + requiredPoints + " points to redeem this picture.");
            window.location = 'pointshop.php';
        } else {
            var confirmRedeem = confirm("Do you want to redeem this picture?");
            if (confirmRedeem) {
                // Proceed with the redemption
                window.location = 'chkredeem.php?imageId=' + imageId;
            } else {
                window.location = 'pointshop.php';
            }
        }
    }
</script>

</body>
</html>
