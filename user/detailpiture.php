<?php
include 'condb.php';
session_start();

// ตรวจสอบว่ามี User ID ที่ถูกส่งมาใน Session หรือไม่
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Picture</title>
    <link rel="stylesheet" href="../styleadd.css">
</head>
<body>
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
<?php
    include 'condb.php';
    if (isset($_GET['id'])) {
        $imageId = $_GET['id'];
    
        // ดึงข้อมูลของรูปภาพจากฐานข้อมูล
        $sql = "SELECT * FROM picture WHERE PICTURE_ID = $imageId";
        $result = mysqli_query($con, $sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    
            // เก็บค่า PICTURE_ID ใน Session
            $_SESSION['PICTURE_ID'] = $row['PICTURE_ID'];

            // แสดงรายละเอียดของรูปภาพ
            echo '<form action="addcart.php" method="post">';
            echo '<div class="container">';
            echo '<h2>Add to Cart</h2>';
            echo '<img src="../img/' . $row['PICTURE_IMAGELINE'] . '" alt="pic" class="img-add">';
            echo '<div class="pic">';
            echo '<h4>' . $row['PICTURE_NAME'] . '</h4>';
            echo '<p class="name-pic">Artist: ' . $row['USER_NAME'] . '</p>';
            echo '<p class="name-pic">Category: ' . $row['CATEGORY_NAME'] . '</p>';
            echo '<p class="price-pic">Price: ' . $row['PICTURE_PRICE'] . ' USD</p>';
            echo '<br>';
            echo '<button type="submit" class="like-add" name="like"><a href="receipt.php">BUY</a></button>';
            echo '<button type="submit" class="add-cart" name="ADD">ADD CART 🛒</button>';
            echo '<button type="submit" class="like-add1" name="like"><a href="user.php">&#9664;&nbsp;Back</a></button>';
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
    <style>
       a {
        text-decoration: none; /* ลบเส้นใต้ */
        margin-right: 10px; /* ปรับระยะห่างด้านขวา */
        }
      .add-cart {
        background-color: #4CAF50; /* เปลี่ยนสีปุ่ม */
        border: none; /* ลบเส้นขอบ */
        color: white; /* เปลี่ยนสีตัวอักษร */
        padding: 15px 32px; /* ปรับขนาดของปุ่ม */
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 12px; /* ปรับขอบมน */
       }
    /* Reset some default styles */
        body, h1, h2, p, img {
            margin: 0;
            padding: 0;
        }

        /* Add some basic styling to improve readability */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #FFE6F1;
            margin-top: 70px; /* Adjust the margin to match the height of your header */
            position: relative; /* Add this line */
            
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #FFBDE4;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .img-add {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .pic {
            text-align: center;
        }

        h4, p {
            margin-bottom: 13px;
        }

        .name-pic, .price-pic, .size {
            color: #0b82b9;
        }

        .detail-pic {
            color: #14b645;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            
        }

        button {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            color: #F782C2;
        }

        .like-add {
            background-color: #9BE0A1;
            border-radius: 12px;
            color: #fff;
            border: none;
        }
        .like-add1 {
            background-color: #FF6868;
            border-radius: 12px;
            color: #fff;
            border: none;
        }

        .add-cart {
            background-color: #fa80ad;
            font-weight: bold;
            color: #fff;
            border: none;
        }
        @keyframes floatAnimation {
            0% { transform: translate(0, 0); }
            50% { transform: translate(0, -20px); }
            100% { transform: translate(0, 0); }
        }

        #floatingEmoji {
            animation: floatAnimation 5s ease-in-out infinite;
            will-change: transform; /* ช่วยให้การเคลื่อนไหวลื่นไหลมากขึ้น */
        }
        #floatingEmoji {
            font-size: 50px;
            right: 250px;
            position: fixed;
        } 
</style>

</body>
</html>
