<?php
include 'condb.php';
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}

// Fetch all coupon data from the database
$couponQuery = "SELECT * FROM coupons";
$couponResult = mysqli_query($con, $couponQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="couponStyle.css">

    <title>Conpon</title>
    <style>
    </style>
</head>
<body>
<div class="container-fluid" style="background-color: #F9B8D7; margin-bottom: -21x;  ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="user.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="logo1.png" alt="" style="max-width: 110px; height: auto; margin-bottom: -50px; margin-top: -50px; margin-left: 100px;" href="index.php">
        </a>
        
            <ul class="nav nav-pills flex-column flex-sm-row">
                <li class="nav-item">
                    <a href="user.php" class="nav-link btn btn-primary" style="font-weight: bold; background-color: #FC82BF; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 10px;   margin-left: 5px;">Home</a>
                </li>
                <li class="nav-item">
                    <a href="picture.php" class="nav-link btn btn-primary" style="font-weight: bold; background-color: #FC82BF; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 10px;   margin-left: 5px;"><i class="bi bi-shop"></i>&nbsp;Picture</a>
                </li>
                <li class="nav-item">
                    <a href="pointshop.php" class="nav-link btn btn-primary" style="font-weight: bold; background-color: #FC82BF; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 10px;   margin-left: 5px;"><i class="bi bi-tag"></i>&nbsp;Point Shop</a>
                </li>
                <li class="nav-item">
                    <a href="coupon.php" class="nav-link btn btn-primary" style="font-weight: bold; background-color: #FC82BF; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 10px;   margin-left: 5px;"><i class="bi bi-coin"></i>&nbsp;Coupon</a>
                </li>
                <li class="nav-item">
                    <a href="upload.php" class="nav-link btn btn-primary" style="font-weight: bold; background-color: #FC82BF; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 10px;   margin-left: 5px;"><i class="bi bi-cloud-upload"></i>&nbsp;Upload</a>
                </li>
                <li class="nav-item">
                    <a href="Cart.php" class="nav-link btn btn-primary" style="font-weight: bold; background-color: #FC82BF; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 10px;   margin-left: 5px;"><i class="bi bi-cart-fill"></i>&nbsp;Cart</a>
                </li>
                <li class="nav-item">
                    <a href="gallery.php" class="nav-link btn btn-primary" style="font-weight: bold; background-color: #FC82BF; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 10px;   margin-left: 5px;"><i class="bi bi-images"></i>&nbsp;Gallery</a>
                </li>
          </ul>

    </header>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <?php while ($couponData = mysqli_fetch_assoc($couponResult)) : ?>
            <div class="col-md-6 mb-4">
                <div class="coupon p-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center">
                                <img src="img/logo.png" style="max-width: 70px;">
                                <span class="d-block"><?php echo $couponData['coupon_name']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div>
                                <?php echo $couponData['coupon_detail']; ?>
                                <div class="d-flex flex-row justify-content-end off">
                                    <h1 style="color: white; text-shadow: 0px 2px 2px black;"><?php echo $couponData['discount_percentage']; ?>%</h1>
                                    <span style="color:red; text-shadow: 0px 1px 2px white; font-weight: bold;">OFF</span>
                                </div>
                                <div class="d-flex flex-row justify-content-between off px-3 p-2">
                                    <span style="color: white; text-shadow: 1px 1px 0px black; font-weight: bold;">Promo code:</span>
                                    <span class="border border-success px-3 rounded code" style="background-color: black; color: white;"><?php echo $couponData['coupon_code']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
            