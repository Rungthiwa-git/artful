


<!doctype html>
<html class="no-js" lang="">
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
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

<style>

.badge-back {
    background-color: #007bff; /* สีของปุ่ม */
    color: white; /* สีของตัวอักษร */
    padding: 8px 15px; /* ขนาดของปุ่ม */
    border: 1px solid #007bff; /* เส้นขอบ */
    border-radius: 4px; /* ขอบเส้นโค้ง */
    text-decoration: none; /* ไม่มีขีดเส้นใต้ */
}
    
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
            <div class="card-header"><strong>EDIT COUPON</strong></div>
            <div class="card-body card-block">
            <form id="editCouponForm" action="update_coupon.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="edit_coupon_code" class="form-control-label">Coupon Code</label>
                    <input type="text" id="edit_coupon_code" name="edit_coupon_code">
                </div>

                <div class="form-group">
                    <label for="edit_discount_percentage" class="form-control-label">Percentage</label>
                    <input type="number" step="0.01" id="edit_discount_percentage" name="edit_discount_percentage" class="form-control">
                </div>

                <div class="form-group">
                    <label for="edit_min_purchase_amount" class="form-control-label">Min Price</label>
                    <input type="number" step="0.01" id="edit_min_purchase_amount" name="edit_min_purchase_amount" class="form-control">
                </div>

                <div class="form-group">
                    <label for="edit_expiry_date" class="form-control-label">Expire Date</label>
                    <input type="date" id="edit_expiry_date" name="edit_expiry_date" class="form-control">
                </div>

                <div class="form-group">
                    <label for="edit_coupon_detail" class="form-control-label">Detail</label>
                    <textarea id="edit_coupon_detail" name="edit_coupon_detail" rows="4" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="edit_coupon_name" class="form-control-label">Name Code</label>
                    <input type="text" id="edit_coupon_name" name="edit_coupon_name" class="form-control">
                    <input type="hidden" id="edit_coupon_id" name="edit_coupon_id" class="form-control">

                </div>

                <div class="button">
                    <input type="submit" value="Update Coupon">
                    <a href="coupon.php" class="badge badge-back">Back to Coupons</a>
                </div>


            
            </form>   
            </div>
        </div>
    </div>



<script>
window.onload = function() {
    var urlParams = new URLSearchParams(window.location.search);
    var couponId = urlParams.get('coupon_id');
    
    if(couponId) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_coupon.php?coupon_id=" + couponId, true);
        xhr.onreadystatechange = function() {
            if(xhr.readyState === 4 && xhr.status === 200) {
                var couponData = JSON.parse(xhr.responseText);
                document.getElementById("edit_coupon_code").value = couponData.coupon_code;
                document.getElementById("edit_discount_percentage").value = couponData.discount_percentage;
                document.getElementById("edit_min_purchase_amount").value = couponData.min_purchase_amount;
                document.getElementById("edit_expiry_date").value = couponData.expiry_date;
                document.getElementById("edit_coupon_detail").value = couponData.coupon_detail;
                document.getElementById("edit_coupon_name").value = couponData.coupon_name;
                document.getElementById("edit_coupon_id").value = couponData.COUPON_ID;
            }
        };
        xhr.send();
    }
};
</script>


</body>
</html>

            

















































