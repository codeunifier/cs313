<?php
    session_start();

    if (!isset($_COOKIE['infinite-springs'])) {
        //need to log in before decks can be viewed
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

        $statement = "SELECT deck_name FROM decks AS d JOIN users AS u ON u.user_id = d.user_id AND u.user_id = " . $cookie['userId'];
        
        $data = null;
        if ($response = $db->query($statement)) {
            //Database query successful
            $data = $response->fetchAll();
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
        <title>Decks</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href="/website/mtg-icons/css/mana.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/website/cookie.js"></script>

        <link rel="stylesheet" href="/website/style.css"> 
        <link rel="stylesheet" href="/website/decks/deck-styles.css">
        <script type="text/javascript" src="/website/mtg-endpoints.js"></script>
        <script type="text/javascript" src="/website/decks/deck-scripts.js"></script>
        <script type="text/javascript" src="/website/scripts.js"></script>
        <script>
            loadHeader().done(function(html) {
                $("#headerPlaceholder").html(html);
            });

            function loadFormats() {
                var formats = [];
                
                getFormatData().done(function (formats) {
                    formats.forEach(function (format) {
                        $("#formatSelector").append("<option>" + format + "</option>");
                    });
                });
            }

            window.onload = function () {
                $(".color").each(function (index) {
                    var iconHTML = convertManaCostToSymbols($(this).attr('name'));
                    $(this).html(iconHTML);
                });

                $("#submitContainer input").prop("disabled", true);

                $(".color-input input").each(function (index) {
                    $(this).change(function () {
                        checkCreateDeckInputs();
                    });
                });
            }
        </script>
    </head>
    <body>
        <header>
            <div id="headerPlaceholder"></div>
        </header>
        <div id="decksMainContainer">
            <div id="newDeckContainer">
                <i id="btnNewDeck" class="fa fa-plus fa-lg" onclick="onNewDeckButtonClick()"></i>
            </div>
            <div id="newDeckInputsContainer">
                <form id="newDeckForm" action="new-deck.php" method="post">
                    <div id="nameContainer">
                        <input type="text" name="name" placeholder="Deck name" onchange="checkCreateDeckInputs()">
                    </div>
                    <div id="formatContainer">
                        <span>Format: </span>
                        <select id="formatSelector" name="format"></select>
                    </div>
                    <div id="colorsContainer">
                        <div class="color-input">
                            <div name="{W}" class="color"></div>
                            <input type="checkbox" name="color[]" value="w">
                        </div>
                        <div class="color-input">
                            <div name="{U}" class="color"></div>
                            <input type="checkbox" name="color[]" value="u">
                        </div>
                        <div class="color-input">
                            <div name="{B}" class="color"></div>
                            <input type="checkbox" name="color[]" value="b">
                        </div>
                        <div class="color-input">
                            <div name="{R}" class="color"></div>
                            <input type="checkbox" name="color[]" value="r">
                        </div>
                        <div class="color-input">
                            <div name="{G}" class="color"></div>
                            <input type="checkbox" name="color[]" value="g">
                        </div>
                    </div>
                    <div id="submitContainer">
                        <input type="submit" value="Create">
                    </div>
                </form>
            </div>
            <?php
                if ($data != null) {
                    foreach ($data as $deck) {
                        echo("User " . $_SESSION["username"] . " has created " . count($data) . " decks:<br>");
                        echo("Deck Name: " . $deck["deck_name"] . ", Format: " . $deck["format_name"]);
                    }
                } else {
                    //no decks created
                    echo ("<div id='noDecksContainer'><span>- No decks created for this user -</span></div>");
                }
            ?>
            <br><br>
            Feature not fully implemented.
        </div>
        <footer></footer>
</html>