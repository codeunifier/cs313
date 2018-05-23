<?php
    session_start();

    if (!isset($_SESSION["loggedIn"])) {
        //need to log in before saved cards can be viewed
        header("Location: login.php");
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

    //query the database for user's card information
    // $result = pg_query($db_conn, "SELECT * FROM multiverse_lookup");

    $statement = "SELECT multiverse_id FROM multiverse_lookup AS ml JOIN users AS u ON u.user_id = ml.user_id";
    $data = null;
    if ($response = $db->query($statement)) {
        if ($response->columnCount() == 1) {
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
        <title>Saved Cards</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css"> 
        <link rel="stylesheet" href="saved-card-styles.css">
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
        <table>
            <tr>
                <th>Card</th>
                <th>Name</th>
                <th>Mana Cost</th>
                <th>Card Text</th>
            </tr>
            <?php
                foreach ($data as $row) {
                    $id = $row['multiverse_id'];

                    echo("<tr>");
                    echo("<td id='card_" . $id . "'>Loading card data...</td>");
                    echo("<td id='cardName_" . $id . "'></td>");
                    echo("<td id='cardCost_" . $id . "'></td>");
                    echo("<td id='cardText_" . $id . "'></td>");
                    echo("<script>
                            getCardByMultiverse(" . $id . ").done(function(response) {
                                $('#card_" . $id . "').html(\"<img src='\" + response.card.imageUrl + \"'>\");
                                $('#cardName_" . $id . "').html(\"<span>\" + response.card.name + \"</span>\");
                                $('#cardCost_" . $id . "').html(\"<span>\" + response.card.manaCost + \"</span>\");
                                $('#cardText_" . $id . "').html(\"<span>\" + response.card.originalText + \"</span>\");
                            });
                        </script>");
                    echo("</tr>");
                }
            ?>
        </table>
        <footer></footer>
    </body>
</html>