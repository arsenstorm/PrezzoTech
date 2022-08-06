<?php
require_once('../database/db.php');

// make amountRequired in all rows of the stock table equal to 0 unless the amountRequired is -2
$sql = "UPDATE stock SET amountRequired = 0 WHERE amountRequired != -2";
$result = mysqli_query($conn, $sql);

header("Location: https://prezzo.tech/stock");
exit;
?>