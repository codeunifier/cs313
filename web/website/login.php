<?php
    if (isset($_SESSION["loggedIn"])) {
        echo("Already logged in as " . $_SESSION["username"]);
        echo("<br><br>Click <a href='website.html'>here</a> to return.");
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login - Infinite Springs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css"> 
        <link rel="stylesheet" href="login-styles.css">
        <script type="text/javascript" src="mtg-endpoints.js"></script>
        <script type="text/javascript" src="scripts.js"></script>
    </head>
    <body>
        <header>
            <div class="header-contents">
                <div class="header-left-container">
                    <a href="website.html">
                        <div class="header-image">
                            <img src="images/spring.JPG">
                        </div>
                        <div class="header-text">
                            <span>Infinite Springs</span>
                        </div>
                    </a>
                </div>
                <div class="nav-bar-container">
                    <ul>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="saved-cards.php">Saved Cards</a></li>
                        <li><a href="decks.php">Decks</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <div id="loginInfoContainer">
            <div>No credentials are actually needed here. Any input can be entered for now.</div>
            <br>
            <form method="post" action="login-check.php">
                <input type="text" name="username" value="" placeholder="Username">
                <input type="text" name="password" value="" placeholder="Password">
                <input type="submit" value="Log In">
            </form>
        </div>
        <footer></footer>
    </body>
</html>