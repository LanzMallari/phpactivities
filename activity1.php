<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            color: #333;
        }
        fieldset {
            border: 2px solid #555;
            margin-bottom: 15px;
            padding: 15px;
            background-color: #fff;
        }
        legend {
            font-weight: bold;
            color: #555;
        }
        label {
            display: inline-block;
            margin: 5px 0;
        }
        input[type="checkbox"],
        input[type="number"] {
            margin-right: 10px;
        }
        select {
            margin-left: 5px;
            padding: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            margin: 10px 0;
        }
        li {
            margin-bottom: 8px;
        }
        .summary {
            font-size: 1.1em;
        }
        hr {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h2>Vending Machine Order Form</h2>
    <hr>
    <form method="post">
        <fieldset>
            <legend>Available Drinks</legend>
            <label><input type="checkbox" name="item1" id="iCoke" value="Coke"> Coke - ₱15</label><br>
            <label><input type="checkbox" name="item2" id="iSprite" value="Sprite"> Sprite - ₱20</label><br>
            <label><input type="checkbox" name="item3" id="iRoyal" value="Royal"> Royal - ₱20</label><br>
            <label><input type="checkbox" name="item4" id="iPepsi" value="Pepsi"> Pepsi - ₱15</label><br>
            <label><input type="checkbox" name="item5" id="iMountain" value="Mountain"> Mountain Dew - ₱20</label>
        </fieldset>

        <fieldset>
            <legend>Order Options</legend>
            <label>Choose Size: 
                <select name="size">
                    <option value="Regular" selected>Regular</option>
                    <option value="Up">Up-Size (add ₱5)</option>
                    <option value="Jumbo">Jumbo-Size (add ₱10)</option>
                </select>
            </label><br><br>
            <label>Quantity: 
                <input type="number" name="quantity" id="quantity" min="1" max="10">
            </label><br><br>
            <input type="submit" value="Check Out" name="checkout">
        </fieldset>
        
        <?php
        $total = 0;
        $productPrices = [
            "Coke" => 15,
            "Sprite" => 20,
            "Royal" => 20,
            "Pepsi" => 15,
            "Mountain Dew" => 20
        ];
        $size = "Regular";
        $selectedProducts = [];
        $sizePriceAdjustment = 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        if (isset($_POST['size'])) {
            $size = $_POST['size'];
        }
        if ($size == 'Up') {
            $sizePriceAdjustment = 5;
        } elseif ($size == 'Jumbo') {
            $sizePriceAdjustment = 10;
        }
        if (isset($_POST['item1'])) {$selectedProducts[] = "Coke";}
        if (isset($_POST['item2'])) {$selectedProducts[] = "Sprite";}
        if (isset($_POST['item3'])) {$selectedProducts[] = "Royal";}
        if (isset($_POST['item4'])) {$selectedProducts[] = "Pepsi";}
        if (isset($_POST['item5'])) {$selectedProducts[] = "Mountain Dew";}
        $count = count($selectedProducts);

        if (isset($_REQUEST['checkout']) && !empty($selectedProducts) && !empty($quantity)) {
            echo "<hr><h2>Order Summary</h2>";
            foreach ($selectedProducts as $product) {
                $price = $productPrices[$product];
                $priceEachProducthold = $price * $quantity;
                $priceEachProduct = $priceEachProducthold + $sizePriceAdjustment;
                $total += $priceEachProduct;

                echo "<ul class='summary'>
                        <li><strong>$quantity x $size $product:</strong> ₱$priceEachProduct</li>
                    </ul>";
            }
            echo "<p><strong>Total Amount:</strong> ₱$total</p>";
            echo "<p><strong>Total Items Ordered:</strong> $count</p>";
        } elseif (isset($_REQUEST['checkout']) && empty($quantity)) {
            echo "<hr><p>Please specify the quantity of items.</p>";
        } elseif (isset($_REQUEST['checkout'])) {
            echo "<hr><p>No product selected. Please choose at least one product.</p>";
        }
        ?>
    </form>
</body>
</html>
