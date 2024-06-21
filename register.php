<?php include('condb.php')?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regis Page</title>
    <link rel="stylesheet" href="styleregister.css">
</head>
<body>
   <!--<form action="action_page.php" method="post">-->

  <div class="container"> <!--โลโก้-->
    <img src="Logo.png"  alt="Logo"style="max-width: 130px; height: auto; margin-bottom: -70px;">


    <div class="title"><center>Register</center></div><!--ชื่อเรื่อง-->

    <div class="content">

      <form action="checkregister.php" method="post" enctype="multipart/form-data"> 
        <!--เริ่มฟอร์ม  -->

        <div class="user-details"> 

          <div class="input-box">
            <span class="details">Firstname</span>
            <input type="text" name="USER_FIRSTNAME" placeholder="Enter your Firstname" pattern="[A-Za-z]+"required>
          </div>

          <div class="input-box">
            <span class="details">Lastname</span>
            <input type="text" name='USER_LASTNAME'placeholder="Enter your Lastname" pattern="[A-Za-z]+"required>
          </div>


          <div class="input-box">
            <span class="details">User_name</span>
            <input type="text" name='USER_NAME'placeholder="Confirm your  name" required>
          </div>


        <div class="input-box">
            <span class="details">Birthday</span>
            <input type="date" name='USER_DOB' id='dobInput' placeholder="Enter your Birthday" max="2006-12-31" min="1924-01-01" required onchange="calculateAge()">
        </div>

        <div class="input-box">
            <span class="details">Age</span>
            <input type="text" name='USER_AGE' id='ageInput' readonly>
        </div>

        <script> 
        // Function to calculate age
        function calculateAge() {
            // Get the selected date of birth
            var dobInput = document.getElementById('dobInput');
            var dob = new Date(dobInput.value);

            // Calculate the age
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();

            // Adjust the age if the birthday hasn't occurred yet this year
            if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                age--;
            }

            // Update the USER_AGE input field
            var ageInput = document.getElementById('ageInput');
            ageInput.value = age;
        }

        // Calculate age on page load
        window.onload = function() {
            calculateAge();
        };
        </script>
          <div class="input-box">
            <span class="details">E-mail</span>
            <input type="email" name='USER_EMAIL'placeholder="Enter your E-mail"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"  required>
          </div>
                <div class="input-box">
                          <span class="details">Religion</span>
                            <select name="USER_RELOGION"   required style="width: 100%;height: 45px;border-radius: 5px;border: 1px solid gray;border-radius: 20px;">
                            <option value="" disabled selected >&nbsp; &nbsp;Select your Religion</option>
                                <?php
                               $sql1 = "SELECT * FROM religion";
                               $result1 = mysqli_query($con, $sql1);
                               // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง category
                               while ($row = mysqli_fetch_assoc($result1)) {
                                  echo "<option>" . $row["RELIGION_NAME"] . '</option>';
                               }
                               ?>
                          </select>
                    </div>

                    <div class="input-box">
                          <span class="details">Country</span>
                            <select name="USER_COUNTRY"   required style="width: 100%;height: 45px;border-radius: 5px;border: 1px solid gray;border-radius: 20px;">
                            <option value="" disabled selected >&nbsp; &nbsp;Select your Country</option>
                                <?php
                               $sql1 = "SELECT * FROM Country";
                               $result1 = mysqli_query($con, $sql1);
                               // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง category
                               while ($row = mysqli_fetch_assoc($result1)) {
                                  echo "<option>" . $row["COUNTRY_NAME"] . '</option>';
                               }
                               ?>
                          </select>
                    </div>

<!--พาส -->
        <div class="input-box"> 
            <span class="details">Password</span>
            <input type="password1" name='USER_PASS1'id="passwordInput" placeholder="Enter your password"  minlength="8"  required >
          </div>
          <div class="input-box">
                          <span class="details">Occupation</span>
                            <select name="JOB_NAME"   required style="width: 100%;height: 45px;border-radius: 5px;border: 1px solid gray;border-radius: 20px;">
                            <option value="" disabled selected >&nbsp; &nbsp;Select your Jobs</option>
                                <?php
                               $sql1 = "SELECT * FROM job";
                               $result1 = mysqli_query($con, $sql1);
                               // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง category
                               while ($row = mysqli_fetch_assoc($result1)) {
                                  echo "<option>" . $row["JOB_NAME"] . '</option>';
                               }
                               ?>
                          </select>
                    </div>
          <div class="input-box">
                          <span class="details">Status</span>
                            <select name="USER_STATUS"   required style="width: 100%;height: 45px;border-radius: 5px;border: 1px solid gray;border-radius: 20px;">
                            <option value="" disabled selected >&nbsp; &nbsp;Select your Status</option>
                                <?php
                               $sql1 = "SELECT * FROM STATUS";
                               $result1 = mysqli_query($con, $sql1);
                               // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง category
                               while ($row = mysqli_fetch_assoc($result1)) {
                                  echo "<option>" . $row["STATUS_NAME"] . '</option>';
                               }
                               ?>
                          </select>
                    </div>
          <div class="input-box"> <!-- กำหนดไม่ได้ pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"-->
            <span class="details">Phone number</span>
            <input type="tel" name='USER_PHONE'placeholder="Enter your Phone number" pattern="[0-9]+"  >
          </div>
        </div>
        <div class="input-box">
                          <span class="details">sex</span>
                            <select name="SEX_NAME"   required style="width: 100%;height: 45px;border-radius: 5px;border: 1px solid gray;border-radius: 20px">
                            <option value="" disabled selected >&nbsp; &nbsp;Select your Sex</option>
                                <?php
                               $sql1 = "SELECT * FROM SEX";
                               $result1 = mysqli_query($con, $sql1);
                               // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง category
                               while ($row = mysqli_fetch_assoc($result1)) {
                                  echo "<option>" . $row["SEX_NAME"] . '</option>';
                               }
                               ?>
                          </select>
                    </div>
          <br>
        <div class="input-box">
            <span class="details">Profile</span>
            <input type="file" class="contactus" name="USER_PIC" required="required" />
        </div>
      <div class="button">
          <button type="reset" name="Reset">Reset</button>
      </div>
      <div class="button">
          <button type="submit" name="Register" href="login.php">Register</button>
      </div>
    </div>
      <div class="message"><!--มีบัญชีอยู่แล้ว-->
        <p>Already have an account? <a href="login.php">Log in here</a></p>
      </div>

      </form><!--จบ-->
                                

    </div>
  </div>
</body>
</html>













