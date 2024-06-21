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
                        <a href="coupon.php"><i class="menu-icon fa fa-money"></i>Coupon</a>
                    </li>
                    <li class="active">
                        <a href="pointshop.php"><i class="menu-icon fa fa-registered"></i>Points shop</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
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
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Custom Table</strong>
                        </div>
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="avatar">Picture</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Artist</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Points</th>
                                        <th>Edit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include 'condb.php'; // ตรวจสอบเส้นทางและชื่อไฟล์ให้ถูกต้อง
                                    $sql = "SELECT picture.*, picpoints.PICPOINTS FROM picpoints JOIN picture ON picpoints.PICTURE_ID = picture.PICTURE_ID";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        $serial = 1; // เพิ่มตัวนับลำดับ
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td class='serial'>" . $serial++ . ".</td>";
                                            echo "<td class='avatar'><div class='round-img'><a href='#'><img src='../img/" . $row["PICTURE_IMAGELINE"] . "' alt='' style='width: 50px; height: 50px;'></a></div></td>"; // แก้ไขให้ตรงกับชื่อฟิลด์
                                            echo "<td>" . $row["PICTURE_ID"] . "</td>";
                                            echo "<td><span class='name'>" . $row["PICTURE_NAME"] . "</span></td>";
                                            echo "<td><span class='name'>" . $row["USER_NAME"] . "</span></td>";
                                            echo "<td><span class='product'>" . $row["CATEGORY_NAME"] . "</span></td>"; 
                                            echo "<td><span class='product'>" . $row["PICTURETYPE_NAME"]."</span></td>";
                                            echo "<td><span class='product'>" . $row["PICPOINTS"] . "</span></td>"; 
                                            echo "<td><button class='btn btn-primary' onclick=\"window.location.href='editpicture.php?picture_id=" . $row['PICTURE_ID'] . "';\">Edit</button></td>";
                                            echo "<td>";
                                            echo "<form id='deleteForm' method='post' action='delete_picture.php' onsubmit='return confirmDelete()'>"; // Assuming you have a separate PHP file named delete_picture.php to handle deletion
                                            echo "<input type='hidden' name='picture_id' value='" . $row["PICTURE_ID"] . "'>"; // Hidden field to pass picture_id
                                            echo "<input type='submit' value='Delete'>";
                                            echo "</form>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No data found.</td></tr>";
                                    }
                                    $con->close();
                                    ?>
                                </tbody>
                            </table>
                        </div> 
                        <div class="card-footer text-right">
                            <a href="Addpicture.php" class="btn btn-success">Add Pictures</a>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this picture?");
    }
</script>


</body>
</html>
