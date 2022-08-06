<?php
session_start();
if(!isset($_SESSION['RestaurantID'])){
    header("Location: ../");
} else {
    $RestaurantID = $_SESSION['RestaurantID'];
    // connect to database
    require_once '../database/db.php';
    // get restaurant name and restaurant reset email
    $sql = "SELECT RestaurantName, resetEmail FROM restaurantAccounts WHERE RestaurantID = '$RestaurantID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $RestaurantName = $row['RestaurantName'];
    $resetEmail = $row['resetEmail'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prezzo Tech Account</title>
        <link rel="stylesheet" href="../assets/styles/main.css">
        <link rel="stylesheet" href="../assets/styles/account.css">
    </head>
    <body>
        <div class="container">
            <div class="navBar">
                <h1 class="PrezzoLogo">Prezzo Tech Account</h1>
            </div>
        </div>
        <div class="container">
            <div class="changeID">
                <div class="currentID">
                    <div class="container">
                        <h2>Restaurant ID: <?php echo $RestaurantID; ?></h2>
                    </div>
                    <div class="container">
                        <button id="changeIdBtn" class="buttonSwitch">Change the ID of the Restaurant</button>
                    </div>
                </div>
                <div class="IdChanger hidden" id="IdChangerClass">
                    <div class="container">
                        <input type="number" class="idInput" id="idInput" autocomplete="off" placeholder="Change the Restaurant ID">
                            <button id="idSubmitBtn" class="buttonSwitch">Change ID</button>
                        </input>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="changeName">
                <div class="CurrentName">
                    <div class="container">
                        <h2>Restaurant Name: <?php echo $RestaurantName; ?></h2>
                    </div>
                    <div class="container">
                        <button id="changeNameBtn" class="buttonSwitch">Change the Name of the Restaurant</button>
                    </div>
                </div>
                <div class="NameChanger hidden" id="NameChangerClass">
                    <div class="container">
                        <input type="text" class="nameInput" id="nameInput" autocomplete="off" placeholder="Change the Restaurant Name">
                            <button id="nameSubmitBtn" class="buttonSwitch">Change Name</button>
                        </input>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="changeEmail">
                <div class="currentEmail">
                    <div class="container">
                        <h2>Restaurant Email: <?php echo $resetEmail; ?></h2>
                    </div>
                    <div class="container">
                        <button id="changeEmailBtn" class="buttonSwitch">Change the Email of the Restaurant</button>
                    </div>
                </div>
                <div class="EmailChanger hidden" id="EmailChangerClass">
                    <div class="container">
                        <input type="email" class="emailInput" id="emailInput" autocomplete="off" placeholder="Change the Restaurant Email">
                            <button id="emailSubmitBtn" class="buttonSwitch">Change Email</button>
                        </input>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="backToHome">
                <div class="container">
                    <button id="backToHomeBtn" class="buttonSwitch">Go Back</button>
                </div>
            </div>
        </div>
        <div class="container" id="messageArea">

        </div>
        <script>
            function successMessage(message) {
                var messageArea = document.getElementById("messageArea");
                var msgSuccessBox = document.createElement("div");
                msgSuccessBox.className = "messageBox msgSuccess";
                msgSuccessBox.id = "msgSuccessBox";
                msgSuccessBox.innerHTML = message;
                messageArea.appendChild(msgSuccessBox);
            }
            function failMessage(message) {
                var messageArea = document.getElementById("messageArea");
                var msgFailBox = document.createElement("div");
                msgFailBox.className = "messageBox msgFail";
                msgFailBox.id = "msgFailBox";
                msgFailBox.innerHTML = message;
                messageArea.appendChild(msgFailBox);
            }
            function updateDatabase(type, value) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "https://prezzo.tech/account/update.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("type=" + type + "&value=" + value);
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        if(xhr.responseText == "success") {
                            // do nothing
                        } else {
                            console.log(xhr.responseText);

                            if(type == 0) {
                                // if response text contains "ID Updated" then display success message
                                if(xhr.responseText.includes("ID Updated")) {
                                    successMessage("ID Updated");
                                } else {
                                    failMessage("ID Update Failed");
                                    // enable the button and input again
                                    // wait five seconds
                                    setTimeout(function() {
                                        document.getElementById("idSubmitBtn").disabled = false;
                                        document.getElementById("idInput").disabled = false;
                                        document.getElementById("idSubmitBtn").className = "buttonSwitch";
                                        document.getElementById("idInput").className = "idInput";
                                    }, 5000);
                                    
                                }
                            } else if(type == 1) {
                                // if response text contains "Name Updated" then display success message
                                if(xhr.responseText.includes("Name Updated")) {
                                    successMessage("Name Updated");
                                } else {
                                    failMessage("Name Update Failed");
                                    // enable the button and input again
                                    // wait five seconds 
                                    setTimeout(function() {
                                        document.getElementById("nameSubmitBtn").disabled = false;
                                        document.getElementById("nameInput").disabled = false;
                                        document.getElementById("nameSubmitBtn").className = "buttonSwitch";
                                        document.getElementById("nameInput").className = "nameInput";
                                    }, 5000);
                                }
                            } else if(type == 2) {
                                // if response text contains "Email Updated" then display success message
                                if(xhr.responseText.includes("Email Updated")) {
                                    successMessage("Email Updated");
                                } else {
                                    failMessage("Error updating email");
                                    // enable the button and input again
                                    // wait five seconds
                                    setTimeout(function() {
                                        document.getElementById("emailSubmitBtn").disabled = false;
                                        document.getElementById("emailInput").disabled = false;
                                        document.getElementById("emailSubmitBtn").className = "buttonSwitch";
                                        document.getElementById("emailInput").className = "emailInput";
                                    }, 5000);
                                }
                            }
                        }
                    }
                }
            }
            // if change id button is clicked show the id changer div and hide the current id div and change the class of the button to buttonSwitchActive
            document.getElementById('changeIdBtn').addEventListener('click', function(){
                document.getElementById('changeIdBtn').className = 'buttonSwitchActive';
                document.getElementById('changeNameBtn').className = 'buttonSwitch';
                document.getElementById('changeEmailBtn').className = 'buttonSwitch';
                // remove the hidden class from the id changer div and add the hidden class to the other divs
                document.getElementById('IdChangerClass').className = 'IdChanger';
                document.getElementById('NameChangerClass').className = 'NameChanger hidden';
                document.getElementById('EmailChangerClass').className = 'EmailChanger hidden';
            });
            // if change name button is clicked show the name changer div and hide the current name div and change the class of the button to buttonSwitchActive
            document.getElementById('changeNameBtn').addEventListener('click', function(){
                document.getElementById('changeIdBtn').className = 'buttonSwitch';
                document.getElementById('changeNameBtn').className = 'buttonSwitchActive';
                document.getElementById('changeEmailBtn').className = 'buttonSwitch';
                // remove the hidden class from the name changer div and add the hidden class to the other divs
                document.getElementById('NameChangerClass').className = 'NameChanger';
                document.getElementById('IdChangerClass').className = 'IdChanger hidden';
                document.getElementById('EmailChangerClass').className = 'EmailChanger hidden';
            });
            // if change email button is clicked show the email changer div and hide the current email div and change the class of the button to buttonSwitchActive
            document.getElementById('changeEmailBtn').addEventListener('click', function(){
                document.getElementById('changeIdBtn').className = 'buttonSwitch';
                document.getElementById('changeNameBtn').className = 'buttonSwitch';
                document.getElementById('changeEmailBtn').className = 'buttonSwitchActive';
                // remove the hidden class from the email changer div and add the hidden class to the other divs
                document.getElementById('EmailChangerClass').className = 'EmailChanger';
                document.getElementById('IdChangerClass').className = 'IdChanger hidden';
                document.getElementById('NameChangerClass').className = 'NameChanger hidden';
            });
            // if back to home button is clicked go back to the home page
            document.getElementById('backToHomeBtn').addEventListener('click', function(){
                window.location.href = '../';
            });
            // id submit is type 0
            // name submit is type 1
            // email submit is type 2
            // if id submit button is clicked update the database with the new id
            document.getElementById('idSubmitBtn').addEventListener('click', function(){
                idSubmit();
            });
            // if name submit button is clicked update the database with the new name
            document.getElementById('nameSubmitBtn').addEventListener('click', function(){
                nameSubmit();
            });
            // if email submit button is clicked update the database with the new email
            document.getElementById('emailSubmitBtn').addEventListener('click', function(){
                emailSubmit();
            });
            // if the enter key is pressed in any input field then update the database with the new value
            document.getElementById('idInput').addEventListener('keypress', function(e){
                if(e.keyCode == 13) {
                    idSubmit();
                }
            });
            document.getElementById('nameInput').addEventListener('keypress', function(e){
                if(e.keyCode == 13) {
                    nameSubmit();
                }
            });
            document.getElementById('emailInput').addEventListener('keypress', function(e){
                if(e.keyCode == 13) {
                    emailSubmit();
                }
            });

            function idSubmit() {
                var id = document.getElementById('idInput').value;
                updateDatabase(0, id);
                // disable the submit button so the user can't submit the same id twice
                document.getElementById('idSubmitBtn').disabled = true;
                document.getElementById('changeIdBtn').className = 'buttonSwitch';
                document.getElementById('IdChangerClass').className = 'IdChanger hidden';
                // add class disabled to the input and submit button so the user can't submit the same name twice
                document.getElementById('idInput').className = 'inputDisabled';
                document.getElementById('idSubmitBtn').className = 'buttonSwitchDisabled';
            }
            function nameSubmit() {
                var name = document.getElementById('nameInput').value;
                updateDatabase(1, name);
                // disable the submit button after it is clicked
                document.getElementById('nameSubmitBtn').disabled = true;
                document.getElementById('changeNameBtn').className = 'buttonSwitch';
                document.getElementById('NameChangerClass').className = 'NameChanger hidden';
                // add class disabled to the input and submit button so the user can't submit the same name twice
                document.getElementById('nameInput').className = 'inputDisabled';
                document.getElementById('nameSubmitBtn').className = 'buttonSwitchDisabled';
            }
            function emailSubmit() {
                var email = document.getElementById('emailInput').value;
                updateDatabase(2, email);
                // disable the submit button so the user can't submit the same email twice
                document.getElementById('emailSubmitBtn').disabled = true;
                document.getElementById('changeEmailBtn').className = 'buttonSwitch';
                document.getElementById('EmailChangerClass').className = 'EmailChanger hidden';
                // add class disabled to the input and submit button so the user can't submit the same name twice
                document.getElementById('emailInput').className = 'inputDisabled';
                document.getElementById('emailSubmitBtn').className = 'buttonSwitchDisabled';
            }
        </script>
    <?php
}