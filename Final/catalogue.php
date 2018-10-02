<?php
session_start(); // start the session
require_once 'DataBaseConnection.php'; // connect to the database

$product_id = $_POST['Select_Product'];
$action = $_POST['action'];

switch ($action) {
    case "Add":
        $_SESSION['cart'][$product_id] ++; // adding one from the quanitity of the product with id
        break;
    case "Remove":
        $_SESSION['cart'][$product_id] --; // removing one from the quanitity of the product with id
        if ($_SESSION['cart'][$product_id] <= 0) {
            unset($_SESSION['cart'][$product_id]); // if quantity is zero, remove it completely
        }
        break;
    case "Empty":
        unset($_SESSION['cart']);
        break;
    case "Info":
        $infonum = $product_id;
        break;
}
//print_r($_SESSION);
require_once 'DataBaseConnection.php';
?>


<html>
    <head>
        <meta charset="UTF-8">
        <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAA19fXAMCAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIBAQECAgICAgICAQEBAgICAQABAgICAgICAgEAAQICAgEAAQECAgECAgEBAAEBAgIBAAAAAQEAAQEAAQAAAAEBAQABAQABAAEBAAEAAQEAAQEAAQEAAQABAQABAAEBAAEBAAEBAAEAAQEAAQABAQABAQAAAAEBAAAAAQEAAAABAQIBAQECAQABAQICAQEBAgICAgICAgEAAQICAgICAgICAgICAgIBAQECAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />
        <title>Product Cart</title>
        <link href="/CSIS2440/CodeEx/view.css" rel="stylesheet" type="text/css">
    </head>

    <?php
    //print_r($_SESSION);
    ?>

    <body>
        <div class="form" id="form_container">
            <form action="catalogue.php" method="Post">
                <div >
                    <p><span class="text">Please Select a product:</span>
                        <select id="Select_Product" name="Select_Product" class="select">
                            <option value=""></option>

                            <?php
                            $search = "SELECT Name, ProductID FROM Library.Products order by Name";
                            $return = $con->query($search);

                            if (!$return) {
                                $message = "whole query: " . $search;
                                echo $message;
                                die('invalid queery: ' . mysqli_error());
                            }
                            while ($row = mysqli_fetch_array($return)) {
                                if ($row['ProductID'] == $product_id) {
                                    echo "<option value='" . $row['ProductID'] . "' selected='selected'>" . $row['Name'] . "</option>\n";
                                } else {
                                    echo "<option value='" . $row['ProductID'] . "'>" . $row['Name'] . "</option>\n";
                                }
                            }
                            ?>


                        </select></p>
                    <table>
                        <tr>
                            <td>
                                <input id="button_Add" type="submit" value="Add" name="action" class="button"/>
                            </td>
                            <td>
                                <input name="action" type="submit" class="button" id="button_Remove" value="Remove"/>
                            </td>
                            <td>
                                <input name="action" type="submit" class="button" id="button_empty" value="Empty"/>
                            </td>
                            <td>
                                <input name="action" type="submit" class="button" id="button_Info" value="Info"/>
                            </td>
                        </tr>                    
                    </table>
                </div>
                <div id="productInformation"
            </div>
            <div>
            </div>
            <div id="Display_cart">

                <?php
                if ($_SESSION['cart']) {
                    //show the cart
                    echo "<table border=\"1\" padding=\"3\" width=\"640px\"><tr><th>Name</th><th>Price</th>"
                    . "<th>Quantity</th><th width=\"80px\">Line</th></tr>"; // format the cart using the HTML table
                    //iterate through the car, the productID is the key and the quantity is the value
                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        $sql = "SELECT Name, Price FROM Library.Products WHERE ProductID = " . $product_id;
                        //echo $sql;
                        $result = $con->query($sql);

                        list($name, $price) = mysqli_fetch_row($result);
                        $line_cost = $price * $quantity; // work out the line cost
                        $total = $total + $line_cost; // add the total cost
                        echo "<tr>";
                        // show this info in table cells
                        echo "<td align=\"Left\" width=\"450px\">$name</td>";

                        echo "<td align=\"center\" width=\"75px\">$price</td>";

                        echo "<td align=\"center\" width=\"75px\">$quantity</td>";

                        echo "<td align=\"center\">" . money_format('%.2n', $line_cost) . "</td>";

                        echo "</tr>";
                    }
                } else {
                    $total = 0;
                }
                ?>
            </div>
        </form>
        <?php
        echo"<h2>Total: $" . $total . "</h2>";
        ?>
    </div>
</body>
</html>
