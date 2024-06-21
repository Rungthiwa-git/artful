<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Thai&display=swap" rel="stylesheet">
    <style>
        .header-links {
            display: flex; /* ใช้ flexbox เพื่อจัดวางปุ่มให้อยู่ใกล้กัน */
        }

        .header-link {
            padding: 12px 15px; /* ขนาดของปุ่ม */
            text-decoration: none;
            border-radius: 20px; /* ทำเว้นมุมของปุ่ม */
            box-shadow: 2px 2px 7px rgba(0, 0, 0, 0.2); /* เงา */
            transition: box-shadow 0.3s ease; /* เพิ่ม transition เมื่อ hover */
            margin-left: 15px; /* ระยะห่างขวาของปุ่ม */
        }

        .header-link:hover {
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4); /* เพิ่มเงาให้มากขึ้นเมื่อ hover */
            color: black; /* เปลี่ยนสีตัวอักษรเป็นสีดำเมื่อเม้าส์ชี้ */
        }
    </style>
    <title>Home page</title>
</head>
<body>
    <header>
        <div class="header-content">
            <img src="logo.png" alt="Your Logo" class="logo">
            <div class="header-links">
                <a href="picture.php" class="header-link">Picture</a>
                <a href="login.php" class="header-link">Login &#128274;</a>
                <a href="register.php" class="header-link">Register</a>
            </div>
        </div>
    </header>

    <main>
        <div class="kanit-thin">
            <h1>เปลี่ยนความสวยงามให้เป็น <span style="color: red;">"ภาพ"</span></h1>
            <h1>ในทุกซ็อต</h1>
        </div>
        
        <div class="centered-search-bar" style="margin-top: 20px">
            <form method="get" action="search.php"> <!-- Assuming you have a separate PHP file for handling search -->
                <input type="text" name="search" placeholder="ค้นหา...">
            </form>
        </div>
    </main>

    <div class="image-container">
    <?php
    include 'condb.php';
    $sql1 = "SELECT PICTURE_ID,PICTURE_IMAGELINE FROM picture";
    $result1 = mysqli_query($con, $sql1);

if ($result1->num_rows > 0) {
    $images = array();

    while ($row = $result1->fetch_assoc()) {
        $imageId = $row['PICTURE_ID'];
        $imagePath = $row['PICTURE_IMAGELINE'];

        $images[] = '<div class="col-lg-4 col-sm-6">
                        <a href="detailpicture.php?id=' . $imageId . '">
                            <img src="img/' . $imagePath . '" alt="Image" style="width: 100%; height: 400px;" onclick="window.location=\'detailpicture.php?id=' . $imageId . '\';">
                        </a>
                    </div>';
    }

    shuffle($images); // Shuffle the array randomly
    $selectedImages = array_slice($images, 0, 3); // Get the first 3 elements   

    echo '<div class="row">' . implode('', $selectedImages) . '</div>';
}
?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
