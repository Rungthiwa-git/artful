<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleadd.css">
</head>
<body>
<?php
    include 'condb.php';
    if (isset($_GET['id'])) {
        $imageId = $_GET['id'];
    
        // ดึงข้อมูลของรูปภาพจากฐานข้อมูล
        $sql = "SELECT * FROM picture WHERE PICTURE_ID = $imageId";
        $result = mysqli_query($con, $sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    
            // แสดงรายละเอียดของรูปภาพ
            echo '<form action="login.php" method="post">';
            echo '<div class="container">';
            echo '<h2>Add to Cart</h2>';
            echo '<img src="img/' . $row['PICTURE_IMAGELINE'] . '" alt="pic" class="img-add">';
            echo '<div class="pic">';
            echo '<h4>' . $row['PICTURE_NAME'] . '</h4>';
            echo '<p class="name-pic">Artist: ' . $row['USER_NAME'] . '</p>';
            echo '<p class="name-pic">Category: ' . $row['CATEGORY_NAME'] . '</p>';
            echo '<p class="price-pic">Price: ' . $row['PICTURE_PRICE'] . ' USD</p>';
            echo '<br>';
            echo '<button type="submit" class="like-add" name="like"><a href="like.php">BUY</a></button>';
            echo '<button type="submit" class="add-cart" name="ADD">ADD CART🛒</button>';
            echo '<a href="PICTURE.php">Back</a>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
        } else {
            echo "No details found for ID = $imageId";
        }
    } else {
        echo "Invalid request. Please provide an image ID.";
    }
?>

    
</body>
</html>