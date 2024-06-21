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
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
        select {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    outline: 0;
    box-shadow: none;
    border: 0!important;
    background: #ff66b2; /* Change to pink color */
    background-image: none;
    flex: 1;
    padding: 0 .5em;
    color: #fff;
    cursor: pointer;
    font-size: 1em;
    font-family: 'Open Sans', sans-serif;
}

.select {
    position: relative;
    display: flex;
    width: 20em;
    height: 3em;
    line-height: 3;
    background: #ff66b2; /* Change to pink color */
    overflow: hidden;
    border-radius: .25em;
}

.select::after {
    content: '\25BC';
    position: absolute;
    top: 0;
    right: 0;
    padding: 0 1em;
    background: #ff3385; /* Change to pink color */
    cursor: pointer;
    pointer-events: none;
    transition: .25s all ease;
}

.select:hover::after {
    color: #ff66b2; /* Change to pink color */
}
.navbar-brand img {
        max-width: 100px; /* Adjust the value according to your needs */
        max-height: 50px; /* Adjust the value according to your needs */
    }
   

    </style>
</head>

<body>
<?php include('condb.php')?>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"><i class="menu-icon fa fa-adjust"></i>Dashboard </a>
                    </li>
                    <li class="">
                        <a href="stat.php"><i class="menu-icon fa fa-area-chart "></i>Chart</a>
                    </li>
                    <li class="">
                        <a href="coupon.php"><i class="menu-icon fa fa-money"></i>Coupon</a>
                    </li>
                    <li class="">
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
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                <div class="col-lg-3 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-five">
                <div class="stat-icon dib flat-color-1">
                    <i class="pe-7s-cash"></i>
                </div>
                <div class="stat-content">
                    <div class="text-left dib">
                                    <?php
                                    // คำสั่ง SQL
                                    $sql_total_price = "SELECT SUM(order_price) AS total_order_price FROM orders";
                                    // ทำการส่งคำสั่ง SQL ไปทำงาน
                                    $result_total_price = mysqli_query($con, $sql_total_price);
                                    // ตรวจสอบผลลัพธ์
                                    if ($result_total_price) {
                                        // ดึงข้อมูล
                                        $row_total_price = mysqli_fetch_assoc($result_total_price);
                                        $total_order_price = $row_total_price["total_order_price"];

                                        // แสดงผลลัพธ์
                                        echo '<div class="stat-text"><span class="sum">' . $total_order_price . '$</span></div>';
                                        echo '<div class="stat-heading">Total Price</div>';
                                    } else {
                                        echo "Query failed: " . mysqli_error($con);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <?php
                                        $sql_total_orders = "SELECT COUNT(*) AS total_orders FROM orders";
                                        // ทำการส่งคำสั่ง SQL ไปทำงาน
                                        $result_total_orders = mysqli_query($con, $sql_total_orders);
                                        // ตรวจสอบผลลัพธ์
                                        if ($result_total_orders)  {
                                            // ดึงข้อมูล
                                            $row_total_orders = mysqli_fetch_assoc($result_total_orders);
                                            $total_orders = $row_total_orders["total_orders"];

                                            // แสดงผลลัพธ์
                                            echo '<div class="stat-text"><span class="sum">' . $total_orders . '</span></div>';
                                            echo '<div class="stat-heading">Total Order</div>';
                                        } else {
                                            echo "Query failed: " . mysqli_error($con);
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <?php
                                         $sql_total_user = "SELECT COUNT(*) AS total_user FROM USER WHERE USER_ROLE = 'USER'";
                                        // ทำการส่งคำสั่ง SQL ไปทำงาน
                                        $result_total_user = mysqli_query($con, $sql_total_user);
                                        // ตรวจสอบผลลัพธ์
                                        if ($result_total_user)  {
                                            // ดึงข้อมูล
                                            $row_total_user = mysqli_fetch_assoc($result_total_user);
                                            $total_user = $row_total_user["total_user"];

                                            // แสดงผลลัพธ์
                                            echo '<div class="stat-text"><span class="sum">' . $total_user . '</span></div>';
                                            echo '<div class="stat-heading">Total User</div>';
                                        } else {
                                            echo "Query failed: " . mysqli_error($con);
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-photo"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <?php
                                            $sql_total_picture = "SELECT COUNT(*) AS total_picture FROM Picture";
                                            $result_total_picture = mysqli_query($con, $sql_total_picture);

                                            if ($result_total_picture) {
                                                $row_total_picture = mysqli_fetch_assoc($result_total_picture);
                                                $total_picture = $row_total_picture["total_picture"];

                                                echo '<div class="stat-text"><span class="sum">' . $total_picture . '</span></div>';
                                                echo '<div class="stat-heading">Total Pictures</div>';
                                            } else {
                                                echo "Query failed: " . mysqli_error($con);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <?php include 'category.php' ?>
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                 <?php include 'type.php' ?>
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                </div>

                
                                
                <!--  Traffic  -->
               
</body>
</html>
