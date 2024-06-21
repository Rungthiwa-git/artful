<?php
include('condb.php');
    $USER_FIRSTNAME = $_POST["USER_FIRSTNAME"];
    $USER_LASTNAME = $_POST["USER_LASTNAME"];
    $USER_LOGIN =$_POST["USER_NAME"];
    $USER_DOB = $_POST["USER_DOB"];
    $USER_EMAIL = $_POST["USER_EMAIL"];
    $RELIGION_NAME =  $_POST["USER_RELOGION"];
    $COUNTRY_NAME = $_POST["USER_COUNTRY"];
    $USER_PASS =  $_POST["USER_PASS1"];
    $SEX_NAME =  $_POST["SEX_NAME"];
    $JOB_NAME =  $_POST["JOB_NAME"];
    $USER_PHONE = $_POST["USER_PHONE"];
    $STATUS_NAME = $_POST["USER_STATUS"];
    $USER_AGE = $_POST["USER_AGE"];
    $file_name = $_FILES["USER_PIC"]["name"];
    $file_tmp = $_FILES["USER_PIC"]["tmp_name"];
    move_uploaded_file($file_tmp, "../img/" . $file_name);

    $sql = "INSERT INTO USER (USER_FIRSTNAME, USER_LASTNAME, USER_NAME, USER_DOB, USER_EMAIL, RELIGION_NAME, COUNTRY_NAME, USER_PASS, SEX_NAME, JOB_NAME, USER_PHONE, STATUS_NAME, USER_AGE,USER_PRO)
    VALUES('$USER_FIRSTNAME', '$USER_LASTNAME', '$USER_LOGIN', '$USER_DOB', '$USER_EMAIL', '$RELIGION_NAME', '$COUNTRY_NAME',
    '$USER_PASS', '$SEX_NAME', '$JOB_NAME', '$USER_PHONE', '$STATUS_NAME', '$USER_AGE', '$file_name')";
    
    

$result = mysqli_query($con, $sql) or die("Error in query: $sql");
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('Successfully!');";
    echo "window.location = 'login.php'";//มาหน้า login.php
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error!');";
    echo "window.history.back()";
    echo "</script>";
}
mysqli_close($con);
?>
