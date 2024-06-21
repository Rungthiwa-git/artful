<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Artful-Dashboard</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon"  href="images/favicon.png">
    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
</style>
</head>
<?php include 'condb.php';?>
<body>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="index.php"><i class="menu-icon fa fa-adjust"></i>Dashboard </a>
                    </li>
                    <li class="">
                        <a href="stat.php"><i class="menu-icon fa fa-area-chart "></i>Chart</a>
                    </li>
                    <li class="">
                        <a href="coupons.php"><i class="menu-icon fa fa-money"></i>Coupon</a>
                    </li>
                    <li class="active">
                        <a href="pointshop.php"><i class="menu-icon fa fa-registered"></i>Points shop</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <img src="images/favicon.png" alt="Artful Logo" style="width: 70px; height: 50px;">
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                            </button>
                        </div>
                        <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/pae.jpg" alt="User Avatar">
                        </a>
                         </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="card">
    <div class="card-header"><strong>Add Picture</strong></div>
    <div class="card-body card-block">
    <form action="chkaddpicture.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="picture-name" class="form-control-label">Picture Name</label>
            <input type="text" id="picture-name" name="picture_name" placeholder="Enter picture name" class="form-control">
        </div>
        <div class="form-group">
    <label for="picture-category" class="form-control-label">Category</label>
    <select id="picture-category" name="picture_category" class="form-control">
        <option value="" disabled selected>&nbsp; &nbsp;Select your Category</option>
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
        <div class="form-group">
            <label for="picture-type" class="form-control-label">Type</label>
            <select id="picture-type" name="picture_type" class="form-control">
                <option value="" disabled selected>&nbsp; &nbsp;Select picture type</option>
                <?php
                $sql = "SELECT * FROM picture_type";
                $result = mysqli_query($con, $sql);
                // วนลูปเพื่อสร้าง option จากข้อมูลในตาราง picture_type
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['PICTURETYPE_NAME'] . '">' . $row['PICTURETYPE_NAME'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="picture-points" class="form-control-label">Points</label>
            <input type="text" id="picture-points" name="picture_points" placeholder="Enter picture points" class="form-control">
        </div>
        <div class="form-group">
            <label for="picture-user" class="form-control-label">Artist</label>
            <input type="text" id="picture-user" name="picture_user" placeholder="Enter picture Artrist" class="form-control">
        </div>
        <div class="form-group">
            <label for="picture-file" class="form-control-label">Picture File</label>
            <input type="file" class="contactus" name="pic" required="required" style="width: 100%; padding: 10px 12px; margin-top: 10px;" />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>


</div>

</body>
</html>
