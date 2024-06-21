<?php
session_start();
include 'condb.php';

// USER_ID to update
$user_id_to_update = $_SESSION['USER_ID'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $inputUsername = $_POST['inputUsername'];
    $inputFirstName = $_POST['inputFirstName'];
    $inputLastName = $_POST['inputLastName'];
    $inputPass = $_POST['inputPass'];
    $inputEmail = $_POST['inputEmail'];
    $inputPhone = $_POST['inputPhone'];
    $inputDOB = $_POST['inputDOB'];
    $inputSex = $_POST['inputSex'];
    $inputStatus = $_POST['inputStatus'];
    $inputjob = $_POST['inputjob'];
    $file_name = $_FILES["pic"]["name"];
    $file_tmp = $_FILES["pic"]["tmp_name"];
    move_uploaded_file($file_tmp, "../img/" . $file_name);

    
    
    // Fix SQL syntax by adding a comma before USER_FIRSTNAME
    $updateSql = "UPDATE `user` SET  `USER_ID`='$user_id_to_update',
    `USER_NAME`='$inputUsername',
    `USER_FIRSTNAME`='$inputFirstName', 
    `USER_LASTNAME`='$inputLastName', 
    `USER_EMAIL`='$inputEmail',
    `USER_PASS`='$inputPass', 
    `USER_PHONE`='$inputPhone', 
    `USER_DOB`='$inputDOB', 
    `SEX_NAME`='$inputSex', 
    `STATUS_NAME`='$inputStatus', 
    `JOB_NAME`='$inputjob',
    `USER_PRO`='$file_name'
    WHERE `USER_ID`='$user_id_to_update'";
    
    $result = mysqli_query($con, $updateSql);

    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('Successful!');";
        echo "window.location ='editprofile.php'";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('An error occurred.!');";
        echo "window.location = 'editprofile.php'";
        echo "</script>";
    }
}

?>
