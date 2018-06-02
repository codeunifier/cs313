<?php
    session_start();

    //simply unsetting the cookie does not remove it.
    unset($_COOKIE['infinite-springs']);
    setcookie('infinite-springs', '', time() - 3600, '/');

    header('Location: /cs313-php/web/website/website.html');
?>