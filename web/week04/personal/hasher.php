<?php 
    $str = $_GET["data"];

    echo hash("sha256", $str);
?>