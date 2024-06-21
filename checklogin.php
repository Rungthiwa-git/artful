<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['USER_EMAIL']) && isset($_POST['USER_PASS'])) {
        include("condb.php");

        $email = mysqli_real_escape_string($con, $_POST['USER_EMAIL']);
        $password = mysqli_real_escape_string($con, $_POST['USER_PASS']);

        $sql = "SELECT user_id, USER_ROLE FROM user WHERE USER_EMAIL='$email' AND USER_PASS='$password'";
        $result = mysqli_query($con, $sql);
        
        if ($result) {
            $row = mysqli_fetch_array($result);

            if ($row) {
                // Check USER_ROLE before redirecting
                if ($row['USER_ROLE'] == 'USER') {
                    $_SESSION['USER_ID'] = $row['user_id'];
                    header("Location: user/user.php");
                    exit();
                } elseif ($row['USER_ROLE'] == 'MANAGER') {
                    $_SESSION['USER_ID'] = $row['user_id'];
                    header("Location: admin/index.php");
                    exit();
                } elseif ($row['USER_ROLE'] == 'executive') {
                    $_SESSION['USER_ID'] = $row['user_id'];
                    header("Location: executive/index.php");
                    exit();
                } else {
                    echo "<script>alert('Access denied. Invalid user role');</script>";
                    echo "<script>window.history.back();</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Invalid email or password');</script>";
                echo "<script>window.history.back();</script>";
                exit();
            }
        } else {
            die("Error in SQL query: " . mysqli_error($con));
        }
    } else {
        echo "<script>alert('Please enter both email and password');</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
