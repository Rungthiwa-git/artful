<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stypicture.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style>
    .nav-link {
        color: white; /* กำหนดสีข้อความให้เป็นสีขาว */
    }
        .nav-link:hover {
        box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.3); /* เพิ่มเงาให้มากขึ้นเมื่อ hover */
        color: black;
        
}

</style>
<body>
<div class="container-fluid2" style="background-color: #FFE6F1; margin-bottom: -21x;  ">
<div class="container-fluid" style="background-color: #FDA7D0; margin-bottom: -21x;  ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="logo.png" alt="" style="max-width: 120px; height: auto; margin-bottom: -30px; margin-top: -20px;" href="index.php">
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="picture.php" class="nav-link">Picture</a></li>
            <li class="nav-item"><a href="login.php" class="nav-link">Login &#128274;</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
        </ul>
    </header>
</div>
<div class="container">
<h1>Image Gallery <i class="fas fa-image"></i></h1>
<br>
    <!-- Category Filter Dropdown -->
    <div class="mb-4">
        <label for="categoryFilter" class="form-label">Filter by Category:</label>
        <select class="form-select" id="categoryFilter" onchange="filterImages()">
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

    <!-- Image Cards -->
    <div class="row" id="imageGallery">
        <!-- Images will be loaded here using AJAX -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cJ2w65xiZ5T2Z9zZuovG9LPQ1RZwPpYZUCQTaCtkzmG3nYIaW8p0K7fL/JNq5Pa" crossorigin="anonymous"></script>

<script>
    function filterImages() {
        var category = document.getElementById("categoryFilter").value;

        // Send AJAX request to fetch images based on selected category
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("imageGallery").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "load_images.php?category=" + category, true);
        xhttp.send();
    }

    // Initial load of images on page load
    window.onload = function () {
        filterImages();
    };
</script>

</body>

</html>
