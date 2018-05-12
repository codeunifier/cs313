<?php
    session_start();

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    $_SESSION["dictionary"] = array(
        "z" => "RPi Zero",
        "zw" => "RPi Zero W",
        "1ap" => "RPi 1 Model A+",
        "1bp" => "RPi 1 Model B+",
        "2b" => "RPi 2 Model B",
        "3b" => "RPi 3 Model B",
        "3bp" => "RPi 3 Model B+"
    );
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../../style.css">
        <link rel="stylesheet" href="pi-style.css">
        <script type="text/javascript" src="script.js"></script> 
    </head>
    <body>
        <div class="nav-toolbar font-18">
            <a href="../../landing.html" class="nav-toolbar-item">Home</a>
            <a href="../../assignments.html" class="nav-toolbar-item">Assignments</a>
        </div>
        <div class="shopping-cart">
            <h1>Get Your Slice of Pi</h1>
            <div id="piTable">
                <?php
                    $items = $_SESSION["dictionary"];

                    foreach ($items as $key => $value) {
                        echo ("<div class='pi-pic'>" 
                                . "<img src='models/" . $key . ".jpg'>" 
                                . "<div class='lower-container'>" 
                                    . "<span>" . $items[$key] . "</span>"
                                    . "<select id='modelCount_" . $key . "' class='float-left'>"
                                        . "<option>1</option>"
                                        . "<option>2</option>"
                                        . "<option>3</option>"
                                        . "<option>4</option>"
                                        . "<option>5</option>"
                                    . "</select>"
                                    . "<button onclick='addModelToCart(value)' value='" . $key . "' class='float-left'>Add To Cart</button>"
                                . "</div>"
                            . "</div>");
                    }
                ?>
            </div>
        </div>
        <div class="button-container">
            <form action="cart.php" method="POST"><input type="submit" id="goToCart" value="Go To Cart"></form>
        </div>
    </body>
</html>