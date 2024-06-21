<?php
include 'condb.php';
session_start();

// ตรวจสอบว่ามี User ID ที่ถูกส่งมาใน Session หรือไม่
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}

// ใช้ User ID ที่ถูกส่งมาใน Session ในการดึงข้อมูลจากฐานข้อมูล
$user_id = $_SESSION['USER_ID'];
$sql = "SELECT USER_FIRSTNAME, USER_LASTNAME,	USER_POINTS, USER_PRO FROM user WHERE USER_ID = $user_id LIMIT 1";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile Card UI Design | CoderGirl</title>
  <link rel="stylesheet" href="styleprofile.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<header>
    <h1><img src="logo1.png" alt="Logo" width="165" height="100"></h1>
    <nav>
      
    <ul>
      <li><a href="gallery.php"><span style="font-weight: bold; color: #2E2E2E;"><i class="bi bi-images"></i> Gallery</span></a></li>
      <li><a href="mypicture.php"><span style="font-weight: bold; color: #2E2E2E;"><i class="bi bi-currency-dollar"></i> Pictures sell</span></a></li>
      <li><a href="upload.php"><span style="font-weight: bold; color: #2E2E2E;"><i class="bi bi-cloud-upload"></i>&nbsp;Upload</span></a></li>
      <li><a href="cart.php"><img src="img/trolley-cart.png" alt="รถเข็น"></a></li>
  </ul>

    </nav>
</header>

<section class="main">
<?php
// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // แสดงข้อมูลในรูปแบบของ Profile Card
    while($row = $result->fetch_assoc()) {
?>
  <div class="profile-card">
    <div class="image">
    <?php echo "<img src='../img/" . $row["USER_PRO"] . "' alt='Profile Picture' class='profile-pic'>"; ?>
    </div>
    <div class="data">
      <h2><?php echo $row["USER_FIRSTNAME"] . ' ' . $row["USER_LASTNAME"]; ?></h2>
    </div>
    <div class="row">
      <div class="info">
        <h3><a href ="pointshop.php" >Members points <?php echo $row["USER_POINTS"]; ?><a></h3>
        <!-- ใส่ข้อมูลที่ต้องการแสดง -->
        <span></span>
      </div>
    </div>
    <div class="buttons">
      <a href="editprofile.php" class="btn">Edit profile</a>
    </div>
  </div>
<?php
    }
} else {
    echo "Error!! No data";
}
?>
</section>

<footer>
  <nav class="bottom-nav">
    <ul>
      <li><a href="#"><img src="img/heart.png" alt="LIKE"> LIKE</a></li>
      <li><a href="#"><img src="img/trolley-cart.png" alt="รถเข็น">My Picture</a></li>
      <li><a href="#"><img src="img/coupon.png" alt="sale">Pictures for Sale</a></li>
      <li><a href="#"><img src="img/time.png" alt="History">History</a></li>
    </ul>
  </nav>
</footer>

</body>
</html>
