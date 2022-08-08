<?php
error_reporting(0);
session_start();
if(isset($_SESSION['RestaurantID'])) {
    $RestaurantID = $_SESSION['RestaurantID'];
} else {
    header("Location: https://prezzo.tech/");
    exit;
}

// if name and amountRequired are set, update the database
// if name or amountRequired is not set, take user to index.php
if(isset($_POST['name']) && isset($_POST['amountRequired'])) {
    $name = $_POST['name'];
    $amountRequired = $_POST['amountRequired'];

    // sanitize input
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $amountRequired = filter_var($amountRequired, FILTER_SANITIZE_NUMBER_INT);
    
    require_once('../database/db.php');
    
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE stock SET amountRequired = $amountRequired WHERE name = '$name' AND RestaurantID = '$RestaurantID'";
    if($conn->query($sql) === TRUE) {
        echo "Successfully updated database";
    } else {
        echo "Error updating database";
    }
    $conn->close();
} else {
    header("Location: ./index.php");
}
?>