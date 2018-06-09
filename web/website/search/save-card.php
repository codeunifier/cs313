<?php
    session_start();

    //just in case a cookie expires when trying to save
    if (!isset($_COOKIE['infinite-springs'])) {
        //need to log in before cards can be saved
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

        if (isset($_POST)) {
            $multiverseId = $_POST['id'];
            $userId = (int)$cookie['userId'];
            $deckId = null;

            if (isset($_POST['deckId'])) {
                $deckId = $_POST['deckId'];
            }

            $statement = "INSERT INTO multiverse_lookup (multiverse_id, user_id, deck_id, date_created)
                        SELECT " . $multiverseId . ", " . $userId . ", ";
            
            if ($deckId) {
                $statement = $statement . "," . $deckId;
            } else {
                $statement = $statement . "NULL";
            }
            
            $statement = $statement . ", now() WHERE NOT EXISTS (SELECT * FROM multiverse_lookup WHERE multiverse_id = " . $multiverseId . " AND user_id = " . $userId . ")";
            
            if ($response = $db->query($statement)) {
                if ($response->rowCount() > 0) {
                    echo(1); //inserted successfully
                } else if ($response->errorCode() == 00000) {
                    echo(0); //card already saved
                } else {
                    echo("{error:" . $response->errorCode() . "}");
                }
            }
        } else if (isset($_GET)) {
            $userId = (int)$cookie['userId'];

            $statement = "SELECT multiverse_id, user_id, deck_id FROM multiverse_lookup WHERE date_deleted IS NULL AND user_id = " . $userId;

            if ($response = $db->query($statement)) {
                print_r($response->fetchAll());
            }
        }
    } 
    catch (PDOException $ex) {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
?>