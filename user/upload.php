<!DOCTYPE html>
<html lang="en">
    
<?php session_start();
if (!isset($_SESSION['USER_ID'])) {
    header("Location: ../index.php");
}
include('condb.php')
?>
<head>
    <!-- basic -->
    <meta charset="UTF-8">
    <title> Picture Upload </title>
    <link rel="stylesheet" href="styleup1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
</head>

<body>
    
    <!-- Contact Start -->
    <div class="container">
                <img src="Logo1.png"  alt="Logo"style="max-width: 130px; height: auto; margin-bottom: -70px;">
                    <div class="title"><center>Picture Upload</center></div>
                
                    <div class="content">
                        <form action="chkupload.php" method="post" enctype="multipart/form-data">

                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Picture name</span>
                                    <input type="text" name="name" placeholder="Enter your Picture name" required>
                                </div>
                            </div>
                            
                            <div class="input-box">
                                <span class="details">Price</span>
                                <input type="text" name="price" placeholder="Enter your Price" required>
                            </div>
                            <br>
                            <div class="input-box">
                            <span class="details">Category</span>
                            <select name="category" required style="width: 100%;height: 45px;border-radius: 5px;border: 1px solid gray;">
                                <option value="" disabled selected >&nbsp; &nbsp;Select your Category</option>
                                <?php
                                $sql = "SELECT * FROM category";
                                $result = mysqli_query($con, $sql);
                                // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง category
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['CATEGORY_NAME'] . '">' . $row['CATEGORY_NAME'] . '</option>';
                                }
                                ?>
                            </select>
                             </div>
                             <br>                          
                         <div class="input-box">
                            <span class="details">File Type</span>
                            <select name="type" required style="width: 100%; height: 45px; border-radius: 5px; border: 1px solid gray;">
                            <option value="" disabled selected >&nbsp; &nbsp;Select your Category</option>
                                <?php
                               $sql1 = "SELECT * FROM picture_type";
                               $result1 = mysqli_query($con, $sql1);
                               // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง category
                               while ($row = mysqli_fetch_assoc($result1)) {
                                   echo '<option value="' . $row['PICTURETYPE_NAME'] . '">' . $row['PICTURETYPE_NAME'] . '</option>';
                               }
                               ?>
                            </select>
                        </div>
                        <br>
                        <div class="col-sm-12 control-group">
                            Upload file
                            <input type="file" class="contactus" name="pic" required="required" style="width: 100%; padding: 10px 12px; margin-top: 10px; background-color: #B0DCFF; color: white; border: none; border-radius: 4px; cursor: pointer;" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="button">
                            <input type="submit" value="Upload" style="width: 100%; padding: 10px 20px; font-weight: bold; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        </div>

                        <div class="button">
                        <a href="user.php" style="width: 100%; cursor: pointer; text-decoration: none; text-align: center; font-weight: bold; color: red; ">&nbsp;&nbsp;&nbsp;&#9664;&nbsp;Back</a>
                        </div>


                            
                        </form>
                    </div>
        </div>
           
</body>

</html>