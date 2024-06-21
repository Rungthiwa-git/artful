<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title> 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
     <header></header>
     <!--<form action="action_page.php" method="post">-->
     <img src="Logo.png"  alt="Logo"style="max-width: 130px; height: auto; margin-bottom: -70px;">
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login</span></div>
        <div class="content">
        <form action="checklogin.php" method="post"> 
         <!--เริ่มฟอร์ม-->
         <div class="user-details"> 
          <!--พาส -->
        <div class="input-box"> 
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="USER_PASS" name='USER_EMAIL'id="USER_EMAIL" placeholder="Enter your E-Mail" required >
          </div>
          <div class="input-box"> 
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="USER_PASS" name='USER_PASS'id="USER_PASS" placeholder="Enter your password" required >

          </div>
          <div class="pass"><a href="#">Forgot password?</a></div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">
            <a href="register.php">Register</a></div>
      </div>
        </form>
      </div>
    </div>

  </body>
</html>
