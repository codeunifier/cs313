<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../style.css">
        <link rel="stylesheet" href="pi-style.css">
    </head>
    <body>
        <div class="nav-toolbar font-18">
            <a href="../../landing.html" class="nav-toolbar-item">Home</a>
            <a href="../../assignments.html" class="nav-toolbar-item">Assignments</a>
        </div>
        <h1>Shopping Cart</h1>
        <div class="shopping-cart">
            <div class="banner-message">
                Please confirm items in your cart for purchase before checking out.
            </div>
            <table id="cartTable">
                <tr>
                    <th>Quantity</th>
                    <th>Name</th>
                    <th>Item</th>
                </tr>
                <?php 
                    $dictionary = $_SESSION["dictionary"];

                    $cart = $_SESSION["cart"];

                    foreach ($cart as &$item) {
                        echo ("<tr>"
                                . "<td>" . $item["count"] . "</td>"
                                . "<td>" . $dictionary[$item["model"]] . "</td>"
                                . "<td><img src='models/" . $item["model"] . ".jpg'></td>"
                            . "</tr>");
                    }
                ?>
            </table>
            <div class="button-container">
                <form action="checkout.php"><input type="submit" value="Go To Checkout" <?php if (count($_SESSION["cart"]) < 1) { echo("disabled"); } ?>></form>
            </div>
        </div>
    </body>
</html>