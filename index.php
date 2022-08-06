<?php
session_start();
// set RestaurantID to session variable 3263
//$_SESSION['RestaurantID'] = 3263;
// destroy session variable RestaurantID
//unset($_SESSION['RestaurantID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prezzo Tech</title>
    <link rel="stylesheet" href="./assets/styles/main.css">
</head>
<body>
    <div class="container">
        <div class="navBar">
            <h1 class="PrezzoLogo">Prezzo Tech</h1>
        </div>
    </div>

    <?php
        // if isset session RestaurantID then show restaurant main page
        // else show signup/login form
        if (isset($_SESSION['RestaurantID'])) {
        ?>
            <div class="containerGrid container">
                <div class="item">
                    <button class="buttonGrid" onclick="stockSubmit()">Stock</button>
                </div>
                <div class="item">
                    <button class="buttonGrid" onclick="npsSubmit()">NPS</button>
                </div>
                <div class="item">
                    
                </div>
                <div class="item">                    
                
                </div>
                <div class="item">
                    
                </div>
                <div class="item">
                    
                </div>
                <div class="item item__circle">                    
                    <button id="oneCallBtn" onclick="onecall()"><img src="./assets/images/onecall.png" alt="OneCall"></button>
                </div>
                <div class="item">
                    <button id="accountBtn" onclick="account()">Account</button>
                </div>
                <div class="item">
                    <button id="logoutBtn" onclick="logoutSubmit()">Logout</button>
                </div>
            </div>
            <script>
                // if logoutBtn is clicked then show confirm using alert and then redirect to prezzo.tech/logout.php
                function logoutSubmit() {
                    var confirm = window.confirm("Are you sure you want to logout?");
                    if (confirm) {
                        window.location.href = "https://prezzo.tech/logout";
                    }
                }
                // if npsBtn is clicked then redirect to https://www.prezzovoice.co.uk/
                function npsSubmit() {
                    window.location.href = "https://www.prezzovoice.co.uk/";
                }
                // if stockBtn is clicked then redirect to ./stock
                function stockSubmit() {
                    window.location.href = "https://prezzo.tech/stock";
                }
                // if accountBtn is clicked then redirect to ./account
                function account() {
                    window.location.href = "https://prezzo.tech/account";
                }
                // if oneCallBtn is clicked then redirect to https://onecall.prezzo.co.uk/
                function onecall() {
                    window.location.href = "https://onecall.prezzo.co.uk/";
                }
            </script>
            

        <?php
        } else {
        ?>
            <!--- Signup/Login Form -->
            <div class="container">
                <div class="buttonSwitches">
                    <button id="loginButtonSwitch" class="buttonSwitchActive">Login</button>
                    <button id="signupButtonSwitch" class="buttonSwitch">Signup</button>
                </div>
            </div>
            <div class="container">
                <div class="formClass">
                    <div class="loginForm" id="loginForm">
                        <form action="https://prezzo.tech/account/login/index.php" method="post">
                            <div class="formGroup">
                                <label for="RestaurantID">Restaurant ID</label>
                                <input type="text" name="RestaurantID" id="RestaurantID" placeholder="Restaurant ID" required>
                            </div>
                            <div class="formGroup">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" required>
                            </div>
                            <div class="formGroup">
                                <input type="submit" value="Login" id="submitButton">
                            </div>
                        </form>
                    </div>
                    <div class="signupForm hidden" id="signupForm">
                        <form action="https://prezzo.tech/account/signup/index.php" method="post">
                            <div class="formGroup">
                                <label for="RestaurantID">Restaurant ID</label>
                                <input type="text" name="RestaurantID" id="RestaurantID" placeholder="Restaurant ID" required>
                            </div>
                            <div class="formGroup">
                                <label for="RestaurantName">Restaurant Name</label>
                                <input type="text" name="RestaurantName" id="RestaurantName" placeholder="Prezzo [Restaurant Name]" required>
                            </div>
                            <div class="formGroup">
                                <label for="RestaurantResetEmail">Email for the Restaurant</label>
                                <input type="text" name="RestaurantResetEmail" id="RestaurantResetEmail" placeholder="Restaurant Email" required>
                            </div>
                            <div class="formGroup">
                                <input type="submit" value="Signup" id="submitButton">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                // if login button is clicked then show login form else show signup form
                document.getElementById("loginButtonSwitch").addEventListener("click", function() {
                    document.getElementById("loginButtonSwitch").classList.add("buttonSwitchActive");
                    document.getElementById("signupButtonSwitch").classList.remove("buttonSwitchActive");
                    document.getElementById("loginButtonSwitch").classList.remove("buttonSwitch");
                    document.getElementById("signupButtonSwitch").classList.add("buttonSwitch");
                    document.getElementById("loginForm").classList.remove("hidden");
                    document.getElementById("signupForm").classList.add("hidden");
                });
                document.getElementById("signupButtonSwitch").addEventListener("click", function() {
                    document.getElementById("loginButtonSwitch").classList.remove("buttonSwitchActive");
                    document.getElementById("signupButtonSwitch").classList.add("buttonSwitchActive");
                    document.getElementById("loginButtonSwitch").classList.add("buttonSwitch");
                    document.getElementById("signupButtonSwitch").classList.remove("buttonSwitch");
                    document.getElementById("loginForm").classList.add("hidden");
                    document.getElementById("signupForm").classList.remove("hidden");
                });
            </script>
        <?php
        }
        
    ?>
</body>
</html>