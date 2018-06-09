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

        $insert = "INSERT INTO users (username, password_hash, date_created) VALUES (?, ?, now()) RETURNING user_id;";
        $query = $db->prepare($insert);
        
        if ($query->execute([$username, $password])) {
            $row = $query->fetch();

            $cookie = json_encode(array('username' => $username, 'userId' => $row['user_id']));

            //86440 = 1 day
            setcookie('infinite-springs', $cookie, time() + (86440 * 7), "/");

            header("Location: /website/website.html");
        }
    }
    catch (PDOException $ex) {
        $error = $ex->getMessage();
        if (strpos($error, 'Unique violation') !== false) {
            $_SESSION['duplicate'] = $username;
            header("Location: /website/login/new-account.php");
        }
        die();
    }
?>