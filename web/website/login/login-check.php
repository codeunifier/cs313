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
}
catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
}


//make the database connection with the database environment variable
// $db_conn = pg_connect(getenv("DATABASE_URL"));

$user_username = $_POST["username"];
$user_password = $_POST["password"];

$user_username = stripslashes($user_username);
$user_password = stripslashes($user_password);

//query database for user information
//TODO: add password matching
$statement = "SELECT user_id, username, password_hash, date_created FROM users WHERE username='testing';";
$data = null;
if ($response = $db->query($statement)) {
    if ($response->rowCount() > 0) {
        //this is only for testing - we are only looking for one row
        if ($response->rowCount() == 1) {
            if ($response->columnCount() == 4) {
                echo("Datbase query successful.<br>");
                
                //Only need the one row for now
                $data = $response->fetchAll()[0];

                // if ($data['password_hash'] == hash("sha256", $user_password)) {
                //     echo("Passwords validated<br>");
                // } else {
                //     echo("Error - username or password incorrect.<br>");
                //     exit;
                // }
            } else {
                echo("Error in sql query - wrong number of columns returned: " . $response->columnCount() . "<br>");
                print_r($response->errorInfo());
                exit;
            }
        } else {
            echo("Error in sql query - too many rows returned: " . $response->rowCount() . "<br>");
        }
    } else {
        echo("Error in sql query - no data returned.<br>");
        exit;
    }
}

echo("Successfully logged in.<br>");
$_SESSION["loggedIn"] = true;
$_SESSION["username"] = $data['username'];
$_SESSION["userId"] = $data['user_id'];
?>

<html>
    <head>
        <style>
            #resultTable {
                border-collapse: collapse;
                margin-top: 50px;
            }

            #resultTable tr * {
                border: 1px solid black;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <table id="resultTable">
            <tr>
                <th>user_id</th>
                <th>username</th>
                <th>password_hash</th>
                <th>date_created</th>
            </tr>
            <?php
                echo ("<tr><td>".$data['user_id']."</td><td>".$data['username']."</td><td>".$data['password_hash']."</td><td>".$data['date_created']."</tr>");
            ?>
        </table>
        <br>
        <div>
            <span>Click <a href="./../website.html">here</a> to return.</span>
        </div>
    </body>
    <footer></footer>
</html>