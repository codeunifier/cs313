<?php
    session_start();

    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);

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

        $password = password_hash($password, PASSWORD_BCRYPT);

        $statement = "INSERT INTO users (username, password_hash, date_created) VALUES (?, ?, now());";
        $db->prepare($statement)->execute([$username, $password]);

        echo 'Query successful <br>';

        //TODO: have the user be logged in after creating new account
    }
    catch (PDOException $ex) {
        $error = $ex->getMessage();
        if (strpos($error, 'Unique violation') !== false) {
            $_SESSION['duplicate'] = $username;
            // echo ($error);
            header("Location: /website/login/new-account.php");
        }
        die();
    }
?>