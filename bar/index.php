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
    <title>Prezzo Bar Tasks</title>
    <link rel="stylesheet" href="../assets/styles/bar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
//create a database connection
require_once '../database/db.php';

// create a html table and display the name of the product in the first column and the done in the second column
$sql = "SELECT name, done FROM barTasks WHERE RestaurantID = '" . $RestaurantID . "'";
$result = mysqli_query($conn, $sql);
echo "<div class=\"tableClass\">";
// create a table
echo "<table border='1'>
<tr>
<th>Task Name</th>
<th>Task complete?</th>
</tr>";

// loop through the results and display the name and done in the table

    while($row = mysqli_fetch_array($result)) {
    if($row['done'] == -2) {
        echo "<tr>";
        echo "<td class=\"subtitle\">" . $row['name'] . "</td>";
        echo "<td class=\"subtitle\"></td>";
    } else {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        if($row['done'] > 0) {
            echo "<td>" . $row['done'] . "&nbsp;&nbsp;<input type=\"button\" id=\"noBtn\" class=\"tableBtn\" value=\"Uncomplete\"></input>";
        } else {
            echo "<td>" . $row['done'] . "&nbsp;&nbsp;<input type=\"button\" id=\"yesBtn\" class=\"tableBtn\" value=\"Complete\"></input>";
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
    <script src="../assets/scripts/bar.js"></script>
    <script>
        document.getElementById("reloadBtn").addEventListener("click", reload);
        document.getElementById("resetBtn").addEventListener("click", reset);
        runButtonListeners();
    </script>
</body>
</html>