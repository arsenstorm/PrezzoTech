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
    <script src="../assets/scripts/stock.js"></script>
    <script>
        document.getElementById("reloadBtn").addEventListener("click", reload);
        document.getElementById("resetBtn").addEventListener("click", reset);
        runButtonListeners();
    </script>
</body>
</html>