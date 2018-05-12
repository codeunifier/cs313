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
        <h1>Confirmation</h1>
        <div class="confirmation">
            <div class="banner-message">
                Thank you! We have received your order of the following items:
            </div>
            <div class="cart-review black-border">
                <?php foreach($_SESSION["cart"] as &$item) { echo($item["count"] . "x " . $_SESSION["dictionary"][$item["model"]] . "<br>"); } ?>
            </div>
            <div class="customer-info-review black-border">
                <?php
                    echo("Name: " . $_POST["first-name"] . " " . $_POST["last-name"] . "<br>");
                    echo("Email: " . $_POST["email"] . "<br>");
                    echo("Address: " . $_POST["address-1"] . " " . $_POST["city"] . ", " . $_POST["state"] . " " . $_POST["zip"] . "<br>");
                    echo("Phone: " . $_POST["phone"] . "<br>");
                ?>
            </div>
            <div class="billing-info-review black-border">
                <?php
                    echo("Card Type: " . $_POST["card-type"] . "<br>");
                    echo("Card Number: ");
                    $cardNum = substr($_POST["card-number"], strlen($_POST["card-number"]) - 4);
                    for ($x = 0; $x < strlen($_POST["card-number"]) - 4; $x++) { echo("*"); }
                    echo($cardNum . "<br>");
                    echo("Expiration Date: " . $_POST["card-month"] . " " . $_POST["card-year"]);
                ?>
            </div>
        </div>
    </body>
</html>