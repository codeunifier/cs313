<?php
    session_start();

    if (isset($_SESSION['duplicate'])) {
        //duplicate username entered
        echo ("<script type='text/javascript'>window.onload = function () { document.getElementById('errorText').innerText = 'Username is already taken.'; }</script>");
        unset($_SESSION['duplicate']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>New Account</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/cs313-php/web/website/style.css"> 
        <link rel="stylesheet" href="/cs313-php/web/website/login/login-styles.css">
        <script type="text/javascript" src="/cs313-php/web/website/login/login-scripts.js"></script>
        <script type="text/javascript" src="/cs313-php/web/website/scripts.js"></script>
        <script type="text/javascript">
            loadHeader().done(function(html) {
                $("#headerPlaceholder").html(html);
            });
        </script>
    </head>
    <body>
        <header>
            <div id="headerPlaceholder"></div>
        </header>
        <div id="accountContainer">
            <div id="formTitle">Create New Account</div>
            <form id="accountForm" onsubmit="return validateForm()" action="create-account.php" method="post">
                <input type="text" id="username" name="username" placeholder="Username">
                <input type="password" id="password" name="password" placeholder="Password">
                <input type="password" id="passwordConf" name="passwordConf" placeholder="Confirm Password">
                <br>
                <input type="submit" value="Create Account">
            </form>
            <div id="errorOutput">
                <span id="errorText"></span>
            </div>
        </div>
        <footer></footer>
    </body>
</html>