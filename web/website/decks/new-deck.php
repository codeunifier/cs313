<?php
    session_start();

    //just in case the user somehow gets here without being logged in
    if (!isset($_COOKIE['infinite-springs'])) {
        header("Location: /cs313-php/web/website/login/login.php");
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

        // $statement = "INSERT INTO users (username, password_hash, date_created) VALUES (?, ?, now());";
        // $db->prepare($statement)->execute([$username, $password]);

        echo 'Query successful <br>';
    }
    catch (PDOException $ex) {
        $error = $ex->getMessage();
        //TODO: figure out how to handle an error
        die();
    }

    header("Location: /cs313-php/web/website/decks/decks.php");
?>