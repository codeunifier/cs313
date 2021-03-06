<?php
    session_start();

    //TODO: update this to check for cookie
    if (isset($_COOKIE["infinite-springs"])) {
        $cookie = json_decode($_COOKIE['infinite-springs'], true);
        echo("Already logged in as " . $cookie["username"] . "<br>");
        echo("<br>Click <a href='logout.php'>here</a> to log out.<br>");
        echo("<br><br>Click <a href='/website/website.html'>here</a> to return.");
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login - Infinite Springs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/website/style.css"> 
        <link rel="stylesheet" href="/website/login/login-styles.css">
        <script type="text/javascript" src="/website/login/entropy.js"></script>
        <script type="text/javascript" src="/website/login/login-scripts.js"></script>
        <script type="text/javascript" src="/website/mtg-endpoints.js"></script>
        <script type="text/javascript" src="/website/scripts.js"></script>
        <script type="text/javascript">
            loadHeader().done(function(html) {
                $("#headerPlaceholder").html(html);
            });

            window.onload = function () {
                <?php
                    if (isset($_SESSION['invalid-credentials'])) {
                        unset($_SESSION['invalid-credentials']);
                        echo("$('#invalidCredentials').show();");
                    }
                ?>
            }
        </script>
    </head>
    <body>
        <header>
            <div id="headerPlaceholder"></div>
        </header>
        <div class="body-container">
            <div id="loginInfoContainer">
                <div id="imageContainer"><img src="/website/images/johnny.jpg"></div>
                <form id="loginForm" method="post" action="login-check.php">
                    <span id="formHeader">Log In</span>
                    <div id="invalidCredentials"><span>Incorrect username or password</span></div>
                    <input type="text" name="username" value="" placeholder="Username" class="login-input" required>
                    <input type="password" name="password" value="" placeholder="Password" class="login-input" required>
                    <input type="submit" value="Log In" class="login-input">
                    <input type="button" onclick="onNewAccountClick()" value="Create New Account" class="login-input">
                </form>
            </div>
        </div>
        <footer></footer>
    </body>
</html>