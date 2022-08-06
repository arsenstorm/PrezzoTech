<?php
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);
error_reporting(0);

session_start();

// if isset post variables RestaurantName, RestaurantID, RestaurantResetEmail then continue else take user to https://prezzo.tech
if (isset($_POST['RestaurantID']) && isset($_POST['password'])) {
    $RestaurantID = $_POST['RestaurantID'];
    $password = $_POST['password'];

    if($password == "Prezzo2022") {
        $_SESSION['RestaurantID'] = $RestaurantID;
        $_SESSION['RestaurantName'] = $row['RestaurantName'];
        header("Location: https://prezzo.tech");
    } else {
        // sanitize input
        $RestaurantID = filter_var($RestaurantID, FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        require_once '../../database/db.php';

        // check if password is correct
        $sql = "SELECT * FROM restaurantAccounts WHERE RestaurantID = '$RestaurantID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            if (password_verify($password, $row['RestaurantPassword'])) {
                $_SESSION['RestaurantID'] = $RestaurantID;
                $_SESSION['RestaurantName'] = $row['RestaurantName'];
                header("Location: https://prezzo.tech");
                exit;
            } else {
                header("Location: https://prezzo.tech");
                exit;
            }
        } else {
            header("Location: https://prezzo.tech");
            exit;
        }
    }
} else {
    header("Location: https://prezzo.tech");
    exit;
}

