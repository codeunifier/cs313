<?php
//make the database connection with the database environment variable
$db_connection = pg_connect(getenv("DATABASE_URL"));

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
