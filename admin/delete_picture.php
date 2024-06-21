<?php
include 'condb.php'; // Check and include the correct file path

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $picture_id = $_POST['picture_id']; // Retrieve picture_id from the form submission
    
    // SQL query to delete the corresponding records from both tables
    $sql_delete_picpoints = "DELETE FROM picpoints WHERE PICTURE_ID = $picture_id";
    $sql_delete_picture = "DELETE FROM picture WHERE PICTURE_ID = $picture_id";
    
    // Execute the first delete query
    if ($con->query($sql_delete_picpoints) === TRUE) {
        // If successful, execute the second delete query
        if ($con->query($sql_delete_picture) === TRUE) {
            echo "Records deleted successfully";
        } else {
            echo "Error deleting record from picture table: " . $con->error;
        }
    } else {
        echo "Error deleting record from picpoints table: " . $con->error;
    }

    $con->close();
    
    // Redirect back to the demo.php page
    header("Location: demo.php");
    exit;
}
?>
