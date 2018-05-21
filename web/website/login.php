<?php

$host = "ec2-54-204-45-43.compute-1.amazonaws.com"; //Host name
$username = "alwzhhuhvizjhb"; //mysql username
$password = "0091f609f2f2fb732f1ee4dded36eb5fb389ea9bf4304b10114a5c1a98cecb8f"; //mysql password
$db_name = "dem9rmc5rsvog"; //mysql database name

$db_conn_string = "host=" . $host . " dbname=" . $db_name . " user=" . $username . " password=" . $password;
// $db_connection = pg_connect($db_conn_string);

$db_connection = pg_connect(getenv("DATABASE_URL"));
echo($db_connection);


//protection from sql injection
//$newString = stripslashes($oldString);

$user_username = $_POST["username"];
$user_password = $_POST["password"];

echo("Data received: " . $user_username . ", " . $user_password . "<br>");
$user_username = stripslashes($user_username);
$user_password = stripslashes($user_password);
echo("Slashes stripped: " . $user_username . ", " . $user_password . "<br>");
// $user_username = mysqli::escape_string($user_username);
// $user_password = mysqli_real_escape_string($user_password);
// echo("MySQL stuff stripped: " . $user_username . ", " . $user_password);
?>
