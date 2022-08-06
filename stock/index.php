<?php
session_start();
if (!isset($_SESSION['RestaurantID'])) {
    header("Location: https://prezzo.tech/");
} else {
    $RestaurantID = $_SESSION['RestaurantID'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prezzo Bar Stock</title>
    <link rel="stylesheet" href="../assets/styles/stock.css">
</head>
<body>
<?php
//create a database connection
require_once '../database/db.php';

// create a html table and display the name of the product in the first column and the amountRequired in the second column
$sql = "SELECT name, amountRequired FROM stock WHERE RestaurantID = '" . $RestaurantID . "'";
$result = mysqli_query($conn, $sql);
echo "<div class=\"tableClass\">";
// create a table
echo "<table border='1'>
<tr>
<th>Name</th>
<th>Amount Required</th>
</tr>";

// loop through the results and display the name and amountRequired in the table

    while($row = mysqli_fetch_array($result)) {
    if($row['amountRequired'] == -2) {
        echo "<tr>";
        echo "<td class=\"subtitle\">" . $row['name'] . "</td>";
        echo "<td class=\"subtitle\"></td>";
    } else {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['amountRequired'] . "&nbsp;&nbsp;<input type=\"button\" id=\"incrementBtn\" class=\"tableBtn\" value=\"+1\"></input>";
        if($row['amountRequired'] > 0) {
            echo "&nbsp;&nbsp;<input type=\"button\" id=\"decrementBtn\" class=\"tableBtn\" value=\"-1\"></input>";
        }
    }
    echo "</td>";
    echo "</tr>";
    }
    echo "</table></div><p class='extraSpace'></p>";

?>
    <div class="navBar">
        <button id="resetBtn">Reset</button>
        <button id="prezzoBtn">PREZZO</button>
        <button id="reloadBtn">Reload</button>
    </div>
    
    <script>
        // create function to reload window when called
        function reload() {
            window.location.reload();
        }
        // create function to reset table when called
        function reset() {
            var x = confirm("Are you sure you want to reset the table?");
            if (x) {
                window.location.href = "./reset.php";
            }
        }
        // reloadBtn is the button that calls the reload function
        document.getElementById("reloadBtn").addEventListener("click", reload);
        // resetBtn is the button that calls the reset function
        document.getElementById("resetBtn").addEventListener("click", reset);
        
        function updateDatabase(name, amountRequired) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "https://prezzo.tech/stock/update.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("name=" + name + "&amountRequired=" + amountRequired);
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    if(xhr.responseText == "success") {
                        // do nothing
                    } else {
                        console.log(xhr.responseText);
                        //alert("Error updating database");
                    }
                }
            }
        }

        function runButtonListeners() {
            document.querySelectorAll("#incrementBtn").forEach(function(element) {
                element.addEventListener("click", function() {
                    var amountRequired = element.parentNode.innerHTML;
                    amountRequired = parseInt(amountRequired);
                    amountRequired++;
                    var name = element.parentNode.parentNode.childNodes[0].innerHTML;
                    updateDatabase(name, amountRequired);
                    element.parentNode.innerHTML = amountRequired + "&nbsp;&nbsp;<input type=\"button\" id=\"incrementBtn\" class=\"tableBtn\" value=\"+1\"></input>&nbsp;&nbsp;<input type=\"button\" id=\"decrementBtn\" class=\"tableBtn\" value=\"-1\"></input>";
                    runButtonListeners();
                });
            });
            document.querySelectorAll("#decrementBtn").forEach(function(element) {
                element.addEventListener("click", function() {
                    var amountRequired = element.parentNode.innerHTML;
                    amountRequired = parseInt(amountRequired);
                    amountRequired--;
                    var name = element.parentNode.parentNode.childNodes[0].innerHTML;
                    updateDatabase(name, amountRequired);
                    if(amountRequired == 0) {
                        element.parentNode.innerHTML = amountRequired + "&nbsp;&nbsp;<input type=\"button\" id=\"incrementBtn\" class=\"tableBtn\" value=\"+1\"></input>";
                    } else {
                        element.parentNode.innerHTML = amountRequired + "&nbsp;&nbsp;<input type=\"button\" id=\"incrementBtn\" class=\"tableBtn\" value=\"+1\"></input>&nbsp;&nbsp;<input type=\"button\" id=\"decrementBtn\" class=\"tableBtn\" value=\"-1\"></input>";
                    }
                    runButtonListeners();
                });
            });
        }

        runButtonListeners();
    </script>
</body>
</html>