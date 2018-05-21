<?php
//make the database connection with the database environment variable
$db_conn = pg_connect(getenv("DATABASE_URL"));


$user_username = $_POST["username"];
$user_password = $_POST["password"];

echo("Data received: " . $user_username . ", " . $user_password . "<br>");
$user_username = stripslashes($user_username);
$user_password = stripslashes($user_password);
echo("Slashes stripped: " . $user_username . ", " . $user_password . "<br>");


$result = pg_query($db_conn, "SELECT user_id, username FROM users");

echo("Result of database query:");
echo ($result);

if (!$result) {
    echo ("Error querying rows from users table");
    exit;
}

while ($row = pg_fetch_row($result)) {
    echo ("<br><br>");
    echo ("User Number: " . $row[0]);
    echo ("Username: " . $row[1]);
    echo ("<br><br>");
}
?>
