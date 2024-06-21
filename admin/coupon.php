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

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>

    <title>Conpon</title>

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
        /* Your existing styles for the select element */
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
    #coupon_detail {
    margin-bottom: 5px;
    height: 80px; /* กำหนดความสูงของช่อง coupon_detail */
}
.delete-button {
    color: white; /* สีของตัวอักษร */
}



    </style>
</head>
<body>
<?php include('condb.php')?>
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
                    <li class="active">
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
            
<body>
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">COUPON CODE</strong>
                        </div>
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Coupon Code</th>
                                        <th>Percentage</th>
                                        <th>Min price</th>
                                        <th>Expire date</th>
                                        <th>Detail</th>
                                        <th>Name Code</th>
                                        <th>Action</th> 
                                        <!-- ลบ แก้ไข-->
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php 
                                    include 'condb.php'; // ตรวจสอบเส้นทางและชื่อไฟล์ให้ถูกต้อง
                                    $sql = "SELECT * FROM coupons";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        $serial = 1; // เพิ่มตัวนับลำดับ
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {

                                            echo "<tr>";
                                            echo "<td class='serial'>" . $serial++ . ".</td>";
                                            echo "<td>" . $row['coupon_code'] . "</td>";
                                            echo "<td>" . $row['discount_percentage'] . " %" . "</td>";
                                            echo "<td>" . $row['min_purchase_amount'] . "</td>";
                                            echo "<td>" . $row['expiry_date'] . "</td>";
                                            echo "<td>" . $row['coupon_detail'] . "</td>";
                                            echo "<td>" . $row['coupon_name'] . "</td>";
                                            echo "<td>";
                                            echo "<a href='edit_coupon.php?coupon_id=" . $row['COUPON_ID'] . "' class='badge badge-primary'>Edit</a>";
                                            echo "<a class='badge badge-complete delete-button' onclick='deleteCoupon(" . $row['COUPON_ID'] . ")' style='background-color: red;'>Delete</a>"; 
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
                        </div> <!-- /.table-stats -->
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
function deleteCoupon(couponId) {
    if (confirm("Are you sure you want to delete this coupon?")) {
        // ส่งคำขอลบไปยังเซิร์ฟเวอร์ โดยใช้ AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_coupon.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

                window.location.reload();
            }
        };
        xhr.send("coupon_id=" + couponId);
    }
}
</script>





<div style="margin-bottom: 30px; margin-left: 30px; ">   

    <button onclick="toggleFormVisibility()" style="background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 12px;">Click! to Add a discount coupon</button><br><br>

    <form id="couponForm" action="chkcoupon.php" method="post" style="display: none;">
        <label for="coupon_code">Coupon Code :</label>
        <input type="text" id="coupon_code" name="coupon_code"><br>
        <label for="discount_percentage">Percentage :</label>
        <input type="number" step="0.01" id="discount_percentage" name="discount_percentage"><br>
        <label for="min_purchase_amount">Min price :</label>
        <input type="number" step="0.01" id="min_purchase_amount" name="min_purchase_amount"><br>
        <label for="expiry_date">Expire date :</label>
        <input type="date" id="expiry_date" name="expiry_date"><br>
        <label for="coupon_detail">Detail :</label>
        <textarea id="coupon_detail" name="coupon_detail" rows="4"></textarea><br> <!-- ปรับแก้ที่นี่ -->
        <label for="coupon_name">Name Code :</label>
        <input type="text" id="coupon_name" name="coupon_name"><br>
        <div class="button">
            <input type="submit" value="Upload" style="width: 100%; padding: 8px 15px; font-weight: bold; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
        </div>
    </form>

<script>
    function toggleFormVisibility() {
        var form = document.getElementById("couponForm");
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
    </script>  
</div>








<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
            