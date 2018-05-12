<?php
    session_start();

    $cart = $_SESSION["cart"];
    $model = $_POST["model"];
    $count = $_POST["count"];

    $object = array(
        "model" => $model,
        "count" => $count
    );

    if (isset($_POST)) {
        array_push($cart, $object);
    } else if (isset($_GET)) {
        print_r($_SESSION["cart"]);
    }

    $_SESSION["cart"] = $cart;
?>