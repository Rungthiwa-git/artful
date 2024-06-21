<?php
$con = mysqli_connect("localhost", "root", "", "ip") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8'");
date_default_timezone_set('Asia/Bangkok');

// Fetch distinct category names from the Category table
$categoryQuery = "SELECT DISTINCT CATEGORY_NAME FROM category";
$categoryResult = mysqli_query($con, $categoryQuery);

$pictureTypeQuery = "SELECT DISTINCT PICTURETYPE_NAME FROM picture_type";
$pictureTypeResult = mysqli_query($con, $pictureTypeQuery);

$sexQuery = "SELECT DISTINCT SEX_NAME FROM sex ";
$sexResult = mysqli_query($con, $sexQuery);

$statusQuery = "SELECT DISTINCT STATUS_NAME FROM status ";
$statusResult = mysqli_query($con, $statusQuery);

$jobQuery = "SELECT DISTINCT JOB_NAME FROM job ";
$jobResult = mysqli_query($con, $jobQuery);

$religionQuery = "SELECT DISTINCT RELIGION_NAME FROM user";
$religionResult = mysqli_query($con, $religionQuery);

$countryQuery = "SELECT DISTINCT COUNTRY_NAME FROM country";
$countryResult = mysqli_query($con, $countryQuery);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artful</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <style>
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            appearance: none;
            outline: 0;
            box-shadow: none;
            border: 0!important;
            background: #ff66b2; /* Set to pink color */
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
            width: 60em;
            height: 3em;
            line-height: 3;
            background: #ff66b2; /* Set to pink color */
            overflow: hidden;
            border-radius: .25em;
        }

        .select::after {
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            padding: 0 1em;
            background: #ff3385; /* Set to pink color */
            cursor: pointer;
            pointer-events: none;
            transition: .25s all ease;
        }

        .select:hover::after {
            color: #808080; /* Set to gray color */
        }
    </style>
</head>

<body>
<form method="post" action="" class="select" style="margin-top: 20px;">
    <select name="category" id="category" onchange="this.form.submit()" >
        <option value="all" <?php if (!isset($_POST['category']) || (isset($_POST['category']) && $_POST['category'] == 'all')) echo 'selected'; ?>>All Categories</option>
        <?php while ($row = mysqli_fetch_assoc($categoryResult)) : ?>
            <option value="<?php echo $row['CATEGORY_NAME']; ?>" <?php if (isset($_POST['category']) && $_POST['category'] == $row['CATEGORY_NAME']) echo 'selected'; ?>><?php echo $row['CATEGORY_NAME']; ?></option>
        <?php endwhile; ?>
    </select>

    <select name="picture_type" id="picture_type" onchange="this.form.submit()"  style="background-color: #FFB6C1;">
        <option value="all" <?php if (!isset($_POST['picture_type']) || (isset($_POST['picture_type']) && $_POST['picture_type'] == 'all')) echo 'selected'; ?>>All Types</option>
         <?php while ($row = mysqli_fetch_assoc($pictureTypeResult)) : ?>
            <option value="<?php echo $row['PICTURETYPE_NAME']; ?>" <?php if (isset($_POST['picture_type']) && $_POST['picture_type'] == $row['PICTURETYPE_NAME']) echo 'selected'; ?>><?php echo $row['PICTURETYPE_NAME']; ?></option>
          <?php endwhile; ?>
    </select>

    <select name="sex" id="sex" onchange="this.form.submit()">
        <option value="all" <?php if (!isset($_POST['sex']) || (isset($_POST['sex']) && $_POST['sex'] == 'all')) echo 'selected'; ?>>All Genders</option>
         <?php while ($row = mysqli_fetch_assoc($sexResult)) : ?>
            <option value="<?php echo $row['SEX_NAME']; ?>" <?php if (isset($_POST['sex']) && $_POST['sex'] == $row['SEX_NAME']) echo 'selected'; ?>><?php echo $row['SEX_NAME']; ?></option>
         <?php endwhile; ?>
    </select>

    <select name="status" id="status" onchange="this.form.submit()"  style="background-color: #FFB6C1;" >
        <option value="all" <?php if (!isset($_POST['status']) || (isset($_POST['status']) && $_POST['status'] == 'all')) echo 'selected'; ?>>All Statuses</option>
         <?php while ($row = mysqli_fetch_assoc($statusResult)) : ?>
            <option value="<?php echo $row['STATUS_NAME']; ?>" <?php if (isset($_POST['status']) && $_POST['status'] == $row['STATUS_NAME']) echo 'selected'; ?>><?php echo $row['STATUS_NAME']; ?></option>
         <?php endwhile; ?>
    </select>

    <select name="religion" id="religion" onchange="this.form.submit()">
        <option value="all" <?php if (!isset($_POST['religion']) || (isset($_POST['religion']) && $_POST['religion'] == 'all')) echo 'selected'; ?>>All Religions</option>
            <?php while ($row = mysqli_fetch_assoc($religionResult)) : ?>
                <option value="<?php echo $row['RELIGION_NAME']; ?>" <?php if (isset($_POST['religion']) && $_POST['religion'] == $row['RELIGION_NAME']) echo 'selected'; ?>><?php echo $row['RELIGION_NAME']; ?></option>
            <?php endwhile; ?>
    </select>

    <select name="job" id="job" onchange="this.form.submit()"  style="background-color: #FFB6C1;">
        <option value="all" <?php if (!isset($_POST['job']) || (isset($_POST['job']) && $_POST['job'] == 'all')) echo 'selected'; ?>>All Jobs</option>
            <?php while ($row = mysqli_fetch_assoc($jobResult)) : ?>
             <option value="<?php echo $row['JOB_NAME']; ?>" <?php if (isset($_POST['job']) && $_POST['job'] == $row['JOB_NAME']) echo 'selected'; ?>><?php echo $row['JOB_NAME']; ?></option>
            <?php endwhile; ?>
    </select>

    <select name="age_range" id="age_range" onchange="this.form.submit()">
        <option value="all" <?php if (!isset($_POST['age_range']) || (isset($_POST['age_range']) && $_POST['age_range'] == 'all')) echo 'selected'; ?>>All Ages</option>
        <option value="under20" <?php if (isset($_POST['age_range']) && $_POST['age_range'] == 'under20') echo 'selected'; ?>>Under 20</option>
        <option value="21-30" <?php if (isset($_POST['age_range']) && $_POST['age_range'] == '21-30') echo 'selected'; ?>>21-30</option>
        <option value="31-40" <?php if (isset($_POST['age_range']) && $_POST['age_range'] == '31-40') echo 'selected'; ?>>31-40</option>
        <option value="41-50" <?php if (isset($_POST['age_range']) && $_POST['age_range'] == '41-50') echo 'selected'; ?>>41-50</option>
        <option value="upper51" <?php if (isset($_POST['age_range']) && $_POST['age_range'] == 'upper51') echo 'selected'; ?>>Upper 51</option>
    </select>

    <select name="country" id="country" onchange="this.form.submit()" style="background-color: #FFB6C1;"> >
        <option value="all" <?php if (!isset($_POST['country']) || (isset($_POST['country']) && $_POST['country'] == 'all')) echo 'selected'; ?>>All Countries</option>
        <?php while ($row = mysqli_fetch_assoc($countryResult)) : ?>
            <option value="<?php echo $row['COUNTRY_NAME']; ?>" <?php if (isset($_POST['country']) && $_POST['country'] == $row['COUNTRY_NAME']) echo 'selected'; ?>><?php echo $row['COUNTRY_NAME']; ?></option>
        <?php endwhile; ?>
    </select>

</form>
    <h3 style="text-align: center; margin-top: 20px;">Report income by month (USD)</h3>
    <?php
    // Handle form submission and apply category filter
    $categoryFilter = isset($_POST['category']) ? mysqli_real_escape_string($con, $_POST['category']) : 'all';
    $categoryFilterCondition = ($categoryFilter !== 'all') ? " AND p.CATEGORY_NAME = '$categoryFilter'" : "";
    
    $pictureTypeFilter = isset($_POST['picture_type']) ? mysqli_real_escape_string($con, $_POST['picture_type']) : 'all';
    $pictureTypeFilterCondition = ($pictureTypeFilter !== 'all') ? " AND p.PICTURETYPE_NAME = '$pictureTypeFilter'" : "";

    $sexFilter = isset($_POST['sex']) ? mysqli_real_escape_string($con, $_POST['sex']) : 'all';
    $sexFilterCondition = ($sexFilter !== 'all') ? " AND u.SEX_NAME = '$sexFilter'" : "";

    $statusFilter = isset($_POST['status']) ? mysqli_real_escape_string($con, $_POST['status']) : 'all';
    $statusFilterCondition = ($statusFilter !== 'all') ? " AND u.STATUS_NAME = '$statusFilter'" : "";

    $jobFilter = isset($_POST['job']) ? mysqli_real_escape_string($con, $_POST['job']) : 'all';
    $jobFilterCondition = ($jobFilter !== 'all') ? " AND u.JOB_NAME = '$jobFilter'" : "";

    $continentFilter = isset($_POST['continent']) ? mysqli_real_escape_string($con, $_POST['continent']) : 'all';
    $continentFilterCondition = ($continentFilter !== 'all') ? " AND u.CONTINENT_NAME = '$continentFilter'" : "";

    $countryFilter = isset($_POST['country']) ? mysqli_real_escape_string($con, $_POST['country']) : 'all';
    $countryFilterCondition = ($countryFilter !== 'all') ? " AND U.COUNTRY_NAME = '$countryFilter'" : "";

    
    $ageRangeFilter = isset($_POST['age_range']) ? mysqli_real_escape_string($con, $_POST['age_range']) : 'all';
    switch ($ageRangeFilter) {
    case 'under20':
        $ageFilterCondition = " AND TIMESTAMPDIFF(YEAR, u.USER_DOB, CURDATE()) < 20";
        break;
    case '21-30':
        $ageFilterCondition = " AND TIMESTAMPDIFF(YEAR, u.USER_DOB, CURDATE()) BETWEEN 21 AND 30";
        break;
    case '31-40':
        $ageFilterCondition = " AND TIMESTAMPDIFF(YEAR, u.USER_DOB, CURDATE()) BETWEEN 31 AND 40";
        break;
    case '41-50':
        $ageFilterCondition = " AND TIMESTAMPDIFF(YEAR, u.USER_DOB, CURDATE()) BETWEEN 41 AND 50";
        break;
    case 'upper51':
        $ageFilterCondition = " AND TIMESTAMPDIFF(YEAR, u.USER_DOB, CURDATE()) > 50";
        break;
    default:
        $ageFilterCondition = ""; // No specific age range selected
    }
    $religionFilter = isset($_POST['religion']) ? mysqli_real_escape_string($con, $_POST['religion']) : 'all';
    $religionFilterCondition = ($religionFilter !== 'all') ? " AND u.RELIGION_NAME = '$religionFilter'" : "";


    $query = "
    SELECT o.order_price, SUM(o.order_price) AS total, DATE_FORMAT(o.order_timestamp, '%M-%Y') AS datesave
    FROM orders o
    JOIN picture p ON o.picture_id = p.PICTURE_ID 
    JOIN user u ON o.USER_ID = u.USER_ID 
    WHERE 1 $categoryFilterCondition   $pictureTypeFilterCondition $sexFilterCondition $statusFilterCondition $jobFilterCondition $ageFilterCondition $religionFilterCondition $countryFilterCondition
    GROUP BY DATE_FORMAT(o.order_timestamp, '%Y')
    ORDER BY DATE_FORMAT(o.order_timestamp, '%Y') ASC
    ";
    $query1 = "
    SELECT DATE_FORMAT(o.order_timestamp, '%M-%Y') AS datesave, COUNT(o.order_id) AS order_count
    FROM orders o
    JOIN picture p ON o.picture_id = p.PICTURE_ID
     JOIN user u ON o.USER_ID = u.USER_ID 
    WHERE 1 $categoryFilterCondition   $pictureTypeFilterCondition $sexFilterCondition $statusFilterCondition  $jobFilterCondition $ageFilterCondition $religionFilterCondition $countryFilterCondition
    GROUP BY DATE_FORMAT(o.order_timestamp, '%Y')
    ORDER BY DATE_FORMAT(o.order_timestamp, '%Y')  ASC
    ";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Fetch data for the first chart
    $datesave = array();
    $total = array();
    while ($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if (isset($rs['total'])) {
            $datesave[] = "\"" . $rs['datesave'] . "\"";
            $total[] = "\"" . $rs['total'] . "\"";
        }
    }
    $datesave = implode(",", $datesave);
    $total = implode(",", $total);
    ?>

    <hr>
    <p align="center">
        <!-- First Chart -->
        <canvas id="myChart1" width="800px" height="300px"></canvas>
        <script>
            var ctx1 = document.getElementById("myChart1").getContext('2d');
            var myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: [<?php echo $datesave; ?>],
                    datasets: [{
                        label: 'Income report separated by  year  (USD)',
                        data: [<?php echo $total; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                          
                        ],
                        borderColor: [
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </p>
    <?php
    $result1 = mysqli_query($con, $query1);

    if (!$result1) {
        die("Query failed: " . mysqli_error($con));
    }

    // Fetch data for the second chart
    $datesave = array();
    $order_count = array();
    while ($rs = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
        $datesave[] = "\"" . $rs['datesave'] . "\"";
        $order_count[] = "\"" . $rs['order_count'] . "\"";
    }
    $datesave = implode(",", $datesave);
    $order_count = implode(",", $order_count);
    ?>

    <hr>
    <h3 align="center">Report order by year </h3>
    <p align="center">
        <!-- Second Chart -->
        <canvas id="myChart2" width="800px" height="300px"></canvas>
        <script>
            var ctx2 = document.getElementById("myChart2").getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: [<?php echo $datesave; ?>],
                    datasets: [{
                        label: 'Number of Orders by  year ',
                        data: [<?php echo $order_count; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                            'rgba(255, 99, 132,0.8)',
                            'rgba(255, 99, 132,0.5)',
                        ],
                        borderColor: [
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                            'rgba(0, 0, 0,0.8)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
    </p>
    <?php mysqli_close($con); ?>
</body>

</html>
