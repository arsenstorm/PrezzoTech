<?php

function stockApp($RestaurantID) {
    require '../../database/db.php';

    $sql = "INSERT INTO `stock` (`RestaurantID`, `name`, `amountRequired`) VALUES
    (".$RestaurantID.", 'Soft Drinks', -2),
    (".$RestaurantID.", 'Pepsi', 0),
    (".$RestaurantID.", 'Diet Pepsi', 0),
    (".$RestaurantID.", 'Pepsi Max', 0),
    (".$RestaurantID.", 'J2O', 0),
    (".$RestaurantID.", '7Up', 0),
    (".$RestaurantID.", 'San Pellegrino', 0),
    (".$RestaurantID.", 'FS Orange', 0),
    (".$RestaurantID.", 'FS Black', 0),
    (".$RestaurantID.", 'Juices', -2),
    (".$RestaurantID.", 'Cranberry', 0),
    (".$RestaurantID.", 'Apple', 0),
    (".$RestaurantID.", 'Orange', 0),
    (".$RestaurantID.", 'Cloudy', 0),
    (".$RestaurantID.", 'Margarita', 0),
    (".$RestaurantID.", 'Milks', -2),
    (".$RestaurantID.", 'Milk', 0),
    (".$RestaurantID.", 'Soya Milk', 0),
    (".$RestaurantID.", 'Strawberry', 0),
    (".$RestaurantID.", 'Chocolate', 0),
    (".$RestaurantID.", 'Beers & Ciders', -2),
    (".$RestaurantID.", 'Large Peroni', 0),
    (".$RestaurantID.", 'Small Peroni', 0),
    (".$RestaurantID.", 'GF Peroni', 0),
    (".$RestaurantID.", 'Lucky Saint', 0),
    (".$RestaurantID.", 'Camden', 0),
    (".$RestaurantID.", 'Camden', 0),
    (".$RestaurantID.", 'Meantime', 0),
    (".$RestaurantID.", 'Curious', 0),
    (".$RestaurantID.", 'London', 0),
    (".$RestaurantID.", 'Berry', 0),
    (".$RestaurantID.", 'Mixers', -2),
    (".$RestaurantID.", 'Yellow', 0),
    (".$RestaurantID.", 'Soda Water', 0),
    (".$RestaurantID.", 'Grey', 0),
    (".$RestaurantID.", 'Pepsi', 0),
    (".$RestaurantID.", 'Diet Pepsi', 0),
    (".$RestaurantID.", 'White Wines', -2),
    (".$RestaurantID.", 'House White', 0),
    (".$RestaurantID.", 'Pinot Grigio', 0),
    (".$RestaurantID.", 'Trebbiano', 0),
    (".$RestaurantID.", 'Gavi di Gavi', 0),
    (".$RestaurantID.", 'Sauvignon Blanc', 0),
    (".$RestaurantID.", 'Rose Wine', -2),
    (".$RestaurantID.", 'Pinot Grigio Rose', 0),
    (".$RestaurantID.", 'Cote de Provence', 0),
    (".$RestaurantID.", 'Red Wines', -2),
    (".$RestaurantID.", 'House Red', 0),
    (".$RestaurantID.", 'Montepulciano', 0),
    (".$RestaurantID.", 'Barbera', 0),
    (".$RestaurantID.", 'Malbec', 0),
    (".$RestaurantID.", 'Primitivo', 0),
    (".$RestaurantID.", 'Sparkling Wines', -2),
    (".$RestaurantID.", 'Prosecco', 0),
    (".$RestaurantID.", 'Prosecco Rose', 0);";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}