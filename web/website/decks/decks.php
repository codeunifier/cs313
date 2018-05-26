<?php
    session_start();

    if (!isset($_SESSION["loggedIn"])) {
        //need to log in before saved cards can be viewed
        header("Location: ./../login/login.php");
        exit;
    }

    $dbase = "magic";
  
    try {   
        $dbUrl = getenv('DATABASE_URL');
        $dbopts = parse_url($dbUrl);
        $dbHost = $dbopts["host"];
        $dbPort = $dbopts["port"];
        $dbUser = $dbopts["user"];
        $dbPassword = $dbopts["pass"];
    
        if (!empty($dbopts["path"])) {
            $dbName = ltrim($dbopts["path"],'/');
        } else {
            $dbName = $dbase;
        }  
    
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    }
    catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }

    $statement = "SELECT deck_name, format_id FROM decks AS d JOIN users AS u ON u.user_id = d.user_id AND u.user_id = " . $_SESSION["userId"];
    $data = null;
    if ($response = $db->query($statement)) {
        if ($response->columnCount() == 2) {
            //Database query successful
            $data = $response->fetchAll();
        } else {
            echo ("Error with sql query - wrong number of columns returned.");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Decks</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="./../mtg-icons/css/mana.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="./../style.css"> 
        <link rel="stylesheet" href="deck-styles.css">
        <script type="text/javascript" src="./../mtg-endpoints.js"></script>
        <script type="text/javascript" src="./../scripts.js"></script>
        <script>
            window.onload = function () {
                var mtg = new mtgApi();

                mtg.getFormats().done(function (response) {
                    console.log(response);
                });
            }
        </script>
    </head>
    <body>
        <header>
            <div class="header-contents">
                <div class="logo-container">
                    <a href="./../website.html">
                        <div class="header-image">
                            <img src="./../images/spring.JPG">
                        </div>
                        <div class="header-text">
                            <span>Infinite Springs</span>
                        </div>
                    </a>
                </div>
                <div class="nav-bar-container">
                    <ul>
                        <li><a href="./../login/login.php">Login</a></li>
                        <li><a href="./../saved-cards/saved-cards.php">Cards</a></li>
                        <li><a href="decks.php">Decks</a></li>
                    </ul>
                </div>
            </div>
            <div id="decksMainContainer">
                <?php
                    foreach ($data as $deck) {
                        echo("User " . $_SESSION["username"] . " has created " . count($data) . " decks:<br>");
                        echo("Deck Name: " . $deck["deck_name"] . ", Format: " . $deck["format_id"]);
                    }
                ?>
            </div>
            <footer></footer>
        </header>
</html>