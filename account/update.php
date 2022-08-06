<?php
session_start();
// surpress error messages
error_reporting(0);

if(isset($_POST['type']) && isset($_POST['value'])) {
    $type = $_POST['type'];
    $value = $_POST['value'];
    $id = $_SESSION['RestaurantID'];
    // sanitize input
    $type = filter_var($type, FILTER_SANITIZE_STRING);
    $value = filter_var($value, FILTER_SANITIZE_STRING);

    require_once '../database/db.php';

    // if type is 0
    if($type == 0) {
        // check if id already exists
        $sql = "SELECT * FROM restaurantAccounts WHERE RestaurantID = '$value'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            echo "ID Not Updated/Failed";
        } else {
            $query = "UPDATE restaurantAccounts SET RestaurantID = '$value' WHERE RestaurantID = '$id'";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                echo "ID Not Updated/Failed";
            } else {
                echo "ID Updated/Refresh/Success";
                $_SESSION['RestaurantID'] = $value;
            }
        }
        
    } elseif($type == 1) {
        // check if name already exists
        $sql = "SELECT * FROM restaurantAccounts WHERE RestaurantName = '$value'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            echo "Name Not Updated/Failed";
        } else {
            $query = "UPDATE restaurantAccounts SET RestaurantName = '$value' WHERE RestaurantID = '$id'";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                echo "Name Not Updated/Failed";
            } else {
                echo "Name Updated/Refresh/Success";
                $_SESSION['RestaurantName'] = $value;
            }
        }
    } elseif($type == 2) {
        // check if email already exists
        $sql = "SELECT * FROM restaurantAccounts WHERE RestaurantEmail = '$value'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            echo "Email Not Updated/Failed";
        } else {
            $query = "UPDATE restaurantAccounts SET resetEmail = '$value' WHERE RestaurantID = '$id'";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                echo "Email Not Updated/Failed";
            } else {
                echo "Email Updated/Refresh/Success";
            }
        }
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}