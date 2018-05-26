<?php
    session_start();

    unset($_SESSION["loggedIn"]);
    unset($_SESSION["username"]);
    unset($_SESSION["userId"]);

    header('Location: ./../website.html');
?>