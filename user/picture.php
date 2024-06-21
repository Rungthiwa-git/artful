<?php
session_start();

// ตรวจสอบว่ามี User ID ที่ถูกส่งมาใน Session หรือไม่
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
    exit(); // Make sure to stop script execution after redirection
}

include 'condb.php';

// Use prepared statement to prevent SQL injection
$sql1 = "SELECT PICTURE_ID, PICTURE_IMAGELINE FROM picture WHERE USER_ID != ?";
$stmt = $con->prepare($sql1);
$stmt->bind_param("i", $_SESSION['USER_ID']);
$stmt->execute();
$result1 = $stmt->get_result();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Pictures</title>
    <link rel="stylesheet" href="picuser.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
<div class="container-fluid2" style="background-color: #FFE6F1; margin-bottom: -21x;  ">
<div class="container-fluid" style="background-color: #F9B8D7; margin-bottom: -21x;  ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="user.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="logo1.png" alt="" style="max-width: 110px; height: auto; margin-bottom: -50px; margin-top: -50px; margin-left: 100px;" href="index.php">
        </a>
        
        <ul class="nav nav-pills flex-column flex-sm-row" style="color: black;">
            <li class="btn btn-primary"><a href="user.php" class="btn btn-primary" style="font-weight: bold;">Home</a></li>
            <li class="btn btn-primary"><a href="picture.php" class="btn btn-primary" style="font-weight: bold;"><i class="bi bi-shop"></i>&nbsp;Picture</a></li>
            <li class="btn btn-primary"><a href="pointshop.php" class="btn btn-primary" style="font-weight: bold;"><i class="bi bi-tag"></i>&nbsp;Point Shop</a></li>
            <li class="btn btn-primary"><a href="coupon.php" class="btn btn-primary" style="font-weight: bold;"><i class="bi bi-coin"></i>&nbsp;Coupon</a></li>
            <li class="btn btn-primary"><a href="upload.php" class="btn btn-primary" style="font-weight: bold;"><i class="bi bi-cloud-upload"></i>&nbsp;Upload</a></li>
            <li class="btn btn-primary"><a href="Cart.php" class="btn btn-primary" style="font-weight: bold;"><i class="bi bi-cart-fill"></i>&nbsp;Cart</a></li>
            <li class="btn btn-primary"><a href="gallery.php" class="btn btn-primary" style="font-weight: bold;"><i class="bi bi-images"></i>&nbsp;Gallery</a></li>
        </ul>

    </header>
</div>
<div class="advertisement-bar" style="background-color: #FFFEFE; padding: 8px; text-align: center;">
    <p style="font-weight: bold;"><i class="bi bi-tag-fill"></i> Exclusive Offer: Get 75% off on all pictures! <button onclick="window.location.href = 'coupon.php';" style="margin-left: 10px;">Click</button></p>
</div>

<br><br>
        <div class="container">
        <h1 style="text-align: center;">Picture Shop 🛒</h1>
<br><br>

<div class="mb-4" style="display: flex; align-items: center;">
    <label for="imageSearch" class="form-label" style="font-weight: bold; color: #444444;">Search Image :&nbsp;&nbsp;</label>
    <input type="text" class="form-control" id="imageSearch" placeholder="Enter image name" oninput="filterImages()" style="width: 400px; height: 50px;">
    <button class="btn btn-primary" style="margin-left: 5px; height: 50px;"><i class="bi bi-search"></i></button>

        <!-- Category Filter Dropdown -->
      
            <label for="categoryFilter" class="form-label"style="font-weight: bold;color: #444444;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filter by Category :&nbsp;&nbsp;</label>
            <select class="form-select" id="categoryFilter" onchange="filterImages()" style="width: 500px; height: 50px;"> <!-- ปรับขนาดของ dropdown ตรงนี้ -->
                <option value="all">All Categories</option>
                <?php
                include 'condb.php';

                // Fetch categories from the database
                $sqlCategories = "SELECT DISTINCT CATEGORY_NAME FROM category";
                $resultCategories = mysqli_query($con, $sqlCategories);

                while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
                    echo '<option value="' . $rowCategory['CATEGORY_NAME'] . '">' . $rowCategory['CATEGORY_NAME'] . '</option>';
                }
                ?>
            </select>
        </div>
        <br><br>
        <!-- Image Cards -->
        <div class="row" id="imageGallery">
            <!-- Images will be loaded here using AJAX -->
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cJ2w65xiZ5T2Z9zZuovG9LPQ1RZwPpYZUCQTaCtkzmG3nYIaW8p0K7fL/JNq5Pa" crossorigin="anonymous"></script>

    <script>
         function filterImages() {
        var category = document.getElementById("categoryFilter").value;
        var imageName = document.getElementById("imageSearch").value;

        // Send AJAX request to fetch images based on selected category and image name
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("imageGallery").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "load_images.php?category=" + category + "&imageName=" + imageName, true);
        xhttp.send();
    }

    // Initial load of images on page load
    window.onload = function () {
        filterImages();
    };
    </script>
    
</body>

</html>
