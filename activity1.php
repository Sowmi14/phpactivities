<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #eef1f7;
        }
        h1 {
            text-align: left;
            color: #444;
        }
        fieldset {
            margin-bottom: 20px;
            padding: 15px;
            border: 2px solid #666;
            background-color: #fff;
        }
        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }
        label {
            margin-bottom: 10px;
            display: block;
        }
        input[type="checkbox"], input[type="number"] {
            margin-right: 8px;
        }
        select {
            margin-left: 5px;
            padding: 5px;
        }
        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #0069d9;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            margin: 15px 0;
        }
        li {
            margin-bottom: 10px;
        }
        .summary {
            font-size: 1.1em;
        }
        hr {
            margin: 20px 0;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Vending Machine</h1>
    <form method="post">
        <fieldset>
            <legend>Drinks Selection</legend>
            <label><input type="checkbox" name="drinks[]" value="Coke"> Coke - ₱15</label>
            <label><input type="checkbox" name="drinks[]" value="Sprite"> Sprite - ₱20</label>
            <label><input type="checkbox" name="drinks[]" value="Royal"> Royal - ₱20</label>
            <label><input type="checkbox" name="drinks[]" value="Pepsi"> Pepsi - ₱15</label>
            <label><input type="checkbox" name="drinks[]" value="Mountain Dew"> Mountain Dew - ₱20</label>
        </fieldset>

        <fieldset>
            <legend>Order Details</legend>
            <label>Size:
                <select name="size">
                    <option value="Regular" selected>Regular</option>
                    <option value="Up">Up-Size (₱5 extra)</option>
                    <option value="Jumbo">Jumbo-Size (₱10 extra)</option>
                </select>
            </label>
            <label>Quantity: <input type="number" name="quantity" min="1" max="10"></label>
        </fieldset>

        <input type="submit" value="Checkout" name="checkout">
    </form>

    <?php
    $prices = [
        "Coke" => 15,
        "Sprite" => 20,
        "Royal" => 20,
        "Pepsi" => 15,
        "Mountain Dew" => 20
    ];
    $sizeCost = [
        "Regular" => 0,
        "Up" => 5,
        "Jumbo" => 10
    ];
    $totalCost = 0;

    if (isset($_POST['checkout'])) {
        $selectedDrinks = $_POST['drinks'] ?? [];
        $selectedSize = $_POST['size'] ?? "Regular";
        $quantity = $_POST['quantity'] ?? 0;

        if (empty($selectedDrinks)) {
            echo "<hr><p>Please select at least one drink to proceed.</p>";
        } elseif ($quantity < 1) {
            echo "<hr><p>Please specify a valid quantity.</p>";
        } else {
            echo "<hr><h2>Order Summary</h2>";
            echo "<ul>";
            foreach ($selectedDrinks as $drink) {
                $price = $prices[$drink];
                $sizeCharge = $sizeCost[$selectedSize];
                $itemTotal = ($price + $sizeCharge) * $quantity;
                $totalCost += $itemTotal;

                echo "<li><strong>$quantity x $selectedSize $drink:</strong> ₱$itemTotal</li>";
            }
            echo "</ul>";
            echo "<p class='summary'><strong>Total Cost:</strong> ₱$totalCost</p>";
            echo "<p class='summary'><strong>Total Drinks Ordered:</strong> " . count($selectedDrinks) . "</p>";
        }
    }
    ?>
</body>
</html>
