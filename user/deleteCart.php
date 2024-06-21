 <?php
 session_start();

 if(isset($_GET['PICTURE_ID'])){
     $id = $_GET['PICTURE_ID'];
     unset($_SESSION['cart'][$id]);
      header('location:cart.php');

 }

 ?>