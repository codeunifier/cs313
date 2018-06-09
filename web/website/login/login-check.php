<?php
session_start();

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
    
    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_username = clean_input($_POST["username"]);
    $user_password = clean_input($_POST["password"]);

    // $user_password = hash("sha256", $user_password);

    // echo ($user_password);

    $statement = "SELECT user_id, password_hash FROM users WHERE username = ? AND date_deleted IS NULL;";
    $query = $db->prepare($statement);

    if ($query->execute([$user_username])) {
        if ($query->rowCount() == 1) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if (password_verify($user_password, $row["password_hash"])) {
                //TODO: update the session variable to a cookie
                // $_SESSION["loggedIn"] = true;
                // $_SESSION["username"] = $user_username;
                // $_SESSION["userId"] = $row["user_id"];
                $cookie = json_encode(array('username' => $user_username, 'userId' => $row['user_id']));

                //86440 = 1 day
                setcookie('infinite-springs', $cookie, time() + (86440 * 7), "/");

                header("Location: /website/website.html");
            } else {
                echo("Error!: Password not verified");
            }
        } else if ($query->rowCount() == 0) {
            $_SESSION['invalid-credentials'] = true;
            header("Location: /website/login/login.php");
        } else {
            echo("Error!: Row count greater than 1");
        }
    } else {
        echo("Error!: Cannot execute");
    }
}
catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}
?>