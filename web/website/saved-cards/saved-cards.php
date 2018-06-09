<?php
    session_start();

    if (!isset($_COOKIE['infinite-springs'])) {
        //need to log in before cards can be viewed
        header("Location: /website/login/login.php");
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
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $cookie = json_decode($_COOKIE['infinite-springs'], true);

        $statement = "SELECT multiverse_id FROM multiverse_lookup AS ml JOIN users AS u ON u.user_id = ml.user_id AND u.user_id = " . (int)$cookie["userId"];
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
    }
    catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Saved Cards</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="/website/mtg-icons/css/mana.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/website/style.css"> 
        <link rel="stylesheet" href="/website/saved-cards/saved-card-styles.css">
        <script type="text/javascript" src="/website/mtg-endpoints.js"></script>
        <script type="text/javascript" src="/website/scripts.js"></script>
        <script type="text/javascript" src="/website/saved-cards/saved-cards-scripts.js"></script>
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
        <div class="body-container">
            <?php
                if (count($data) > 0) {
                    echo("<table>
                            <tr>
                                <th>Card</th>
                                <th>Name</th>
                                <th>Mana Cost</th>
                                <th>Card Text</th>
                            </tr>");

                    foreach ($data as $row) {
                        $id = $row['multiverse_id'];

                        echo("<tr>");
                        echo("<td id='card_" . $id . "'>Loading card data...</td>");
                        echo("<td id='cardName_" . $id . "' class='card-name'></td>");
                        echo("<td id='cardCost_" . $id . "' class='card-cost'></td>");
                        echo("<td id='cardText_" . $id . "'></td>");
                        echo("<script>setCardData(" . $id . ");</script>");
                        echo("</tr>");
                    }

                    echo("</table>");
                } else {
                    echo("<div id='noCardsContainer'><span>- No cards saved by user -</span></div>");
                }
            ?>
        </div>
        <footer></footer>
    </body>
</html>