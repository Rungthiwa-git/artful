<?php
session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}

include('condb.php');
$user_id = $_SESSION['USER_ID'];

// SQL query สำหรับดึงข้อมูลที่มี USER_ID เท่ากับ $_SESSION['USER_ID']
$sql = "SELECT * FROM picture WHERE USER_ID = $user_id";

$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error in query: " . mysqli_error($con));
}

// การตรวจสอบว่ามีการส่งค่า picture_id มาหรือไม่
if (isset($_GET['delete_picture_id'])) {
    $delete_picture_id = $_GET['delete_picture_id'];

    // SQL query สำหรับลบรูปภาพ
    $delete_sql = "DELETE FROM picture WHERE PICTURE_ID = $delete_picture_id AND USER_ID = $user_id";
    $delete_result = mysqli_query($con, $delete_sql);

    if (!$delete_result) {
        die("Error deleting picture: " . mysqli_error($con));
    }

    // Redirect หน้าเว็บไปที่ตัวเองหลังจากทำการลบ
    header("Location: $_SERVER[PHP_SELF]");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="yourpic.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<head>
    <!-- ส่วนอื่น ๆ ของหัวเอกสาร HTML ที่เหมาะสม -->

    <title>TRADING HISTORY</title>
    <!-- เพิ่ม link CSS ต่าง ๆ ตามที่ต้องการ -->

</head>
<body>
    <?php include('nav.php')?>
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
        <h1><font size="6" class="text-right">Pictures  sell 💵</font></h1>

        <!-- เพิ่มปุ่มหรือส่วนที่ต้องการตามที่คุณต้องการ -->
        <br><br>
        <table id='example' class="display table table-bordered table-hover table-striped">
            <thead>
                <tr class="danger">
                    <th width="5%">Sale</th>
                    <th width="5%">Picture_1</th>
                    <th width="20%">Picture</th> 
                    <th width="20%">Name</th> 
                    <th width="10%">Category</th>
                    <th width="10%">Price</th>
                    <th width="10%">Action &#x1F4E6;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_count_total_orders = "SELECT o.picture_id, COUNT(*) AS total_orders
                FROM orders o
                GROUP BY o.picture_id";
                    $result_count_total_orders = mysqli_query($con, $sql_count_total_orders);

// สร้าง associative array เพื่อเก็บจำนวน orders ตาม picture_id
$total_orders_per_picture = array();
while ($row_orders = mysqli_fetch_assoc($result_count_total_orders)) {
$total_orders_per_picture[$row_orders['picture_id']] = $row_orders['total_orders'];
}
                // วนลูปเพื่อแสดงข้อมูลในตาราง
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                       echo "<td>" . (isset($total_orders_per_picture[$row['PICTURE_ID']]) ? $total_orders_per_picture[$row['PICTURE_ID']] : '0') . "</td>";
                    echo "<td>" . $row['PICTURE_ID'] . "</td>";
                    echo "<td><img src='../img/" . $row['PICTURE_IMAGELINE'] . "' width='50' height='50'></td>";
                    echo "<td>" . $row['PICTURE_NAME'] . "</td>";
                    echo "<td>" . $row['CATEGORY_NAME'] . "</td>";
                    echo "<td>" . $row['PICTURE_PRICE'] . "</td>";
                    echo "<td><button onclick=\"confirmDelete({$row['PICTURE_ID']})\">Delete</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(pictureId) {
            if (confirm("Do you want to delete this photo?")) {
                window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?delete_picture_id=" + pictureId;
            }
        }
    </script>
    
    <!-- ส่วนท้ายของ HTML และเพิ่ม script หรือ link ที่ต้องการ -->

</body>
</html>
