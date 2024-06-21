<?php
include 'condb.php';
session_start();

// ตรวจสอบว่ามี User ID ที่ถูกส่งมาใน Session หรือไม่
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}

$user_id_to_display = $_SESSION['USER_ID'];
// SQL query to retrieve user details
$sql = "SELECT * FROM `user` WHERE `USER_ID` = $user_id_to_display";
$result = mysqli_query($con, $sql);



// Check if the query was successful
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User not found.";
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>bs5 edit profile account details - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{margin-top:20px;
background-color:#f2f6fc;
color:#69707a;
}
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
    </style>
</head>
<body>

<form action="chkeditprofile.php" method="post">
    <div class="container-xl px-4 mt-4">
<hr class="mt-0 mb-4">
<div class="row">
<div class="col-xl-4">

<div class="card mb-4 mb-xl-0">
<div class="card-header">Profile Picture</div>
<div class="card-body text-center">

<?php echo '<td><img class="img-account-profile rounded-circle mb-2" src="../img/' . $row['USER_PRO'] . '" alt="Profile Picture"></td>'; ?>

<div class="small font-italic text-muted mb-4"></div>
<div class="col-sm-12 control-group">Upload file
                                    <input type="file" class="form-control" id="pic" name="pic" />
                                    <p class="help-block text-danger"></p>
                                </div>
</div>
</div>
</div>
<div class="col-xl-8">

    <div class="mb-3">
        <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
        <input class="form-control" id="inputUsername" name="inputUsername" type="text" placeholder="Enter your username" value="<?php echo $row['USER_NAME']; ?>">
    </div>
    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="inputPass">password</label>
            <input class="form-control" id="inputPass" name="inputPass" type="text" placeholder="Enter your password" value="<?php echo $row['USER_PASS']; ?>">
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="inputLastName"></label>
        </div>
    </div>

    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="inputFirstName">First name</label>
            <input class="form-control" id="inputFirstName" name="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $row['USER_FIRSTNAME']; ?>">
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="inputLastName">Last name</label>
            <input class="form-control" id="inputLastName" name="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $row['USER_LASTNAME']; ?>">
        </div>
    </div>

    <div class="mb-3">
        <label class="small mb-1" for="inputEmail">Email</label>
        <input class="form-control" id="inputEmail" name="inputEmail" type="text" placeholder="Enter your Emali" value="<?php echo $row['USER_EMAIL']; ?>">
    </div>
    
    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="inputPhone">Phone</label>
            <input class="form-control" id="inputPhone" name="inputPhone" type="text" placeholder="Enter your first phone number" value="<?php echo $row['USER_PHONE']; ?>">
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="inputReligion">RELIGION</label>
            <input class="form-control" id="inputReligion" name="inputReligion" type="text" placeholder="Enter your last name" value="<?php echo $row['RELIGION_NAME']; ?>">
        </div>
    </div>

    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <label class="small mb-1" for="inputDOB">birthday</label>
            <input class="form-control" id="inputDOB" name="inputDOB" type="date" placeholder="Select your date of birth" value="<?php echo date('Y-m-d', strtotime($row['USER_DOB'])); ?>">
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="inputContry">COUNTRY</label>
            <input class="form-control" id="inputContry" name="inputContry" type="text" placeholder="Enter your Contry" value="<?php echo $row['COUNTRY_NAME']; ?>">
        </div>
    </div>

    <div class="row gx-3 mb-3">
        <div class="col-md-6">
            <select class="form-control" id="inputSex" name="inputSex">
            <option value="male" <?php echo ($row['SEX_NAME'] == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($row['SEX_NAME'] == 'female') ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for=""></label>
        </div>
    </div>

    <div class="row gx-3 mb-3">
        <div class="col-md-6">
        <label class="small mb-1" for="inputStatus">Status</label>
            <input class="form-control" id="inputStatus" name="inputStatus" type="text" placeholder="Enter your Stutus" value="<?php echo $row['STATUS_NAME']; ?>">
        </div>
        <div class="col-md-6">
            <label class="small mb-1" for="inputjob">Job</label>
            <input class="form-control" id="inputjob" name="inputjob" type="text" placeholder="Enter your Stutus" value="<?php echo $row['JOB_NAME']; ?>">
        </div>
    </div>
    
    <button class="btn btn-primary" type="submit">Save changes</button>
</form>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>