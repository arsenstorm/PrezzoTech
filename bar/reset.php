<?php
session_start();
if(isset($_SESSION['RestaurantID'])) {
    $RestaurantID = $_SESSION['RestaurantID'];
} else {
    header("Location: https://prezzo.tech/");
    exit;
}

require_once('../database/db.php');

// make amountRequired in all rows of the stock table equal to 0 unless the amountRequired is -2
$sql = "UPDATE barTasks SET done = 0 WHERE done != -2 AND RestaurantID = '$RestaurantID'";
$result = mysqli_query($conn, $sql);

header("Location: https://prezzo.tech/bar");
exit;
?>