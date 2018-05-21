<?php
//make the database connection with the database environment variable
$db_conn = pg_connect(getenv("DATABASE_URL"));

$user_username = $_POST["username"];
$user_password = $_POST["password"];

$user_username = stripslashes($user_username);
$user_password = stripslashes($user_password);

$result = pg_query($db_conn, "SELECT user_id, username, date_created FROM users");

if (!$result) {
    echo ("Error querying rows from users table");
    exit;
}

echo("Datbase query successful.<br>");
echo("Returned " . pg_num_rows($result) . " row(s).<br>");
echo("Log in successful.<br>");

echo("
<head><style>
    #resultTable {
        border-collapse: collapse;
        margin-top: 50px;
    }

    #resultTable tr * {
        border: 1px solid black;
        padding: 5px;
    }
</style></head>");

echo("<table id='resultTable'><tr><th>user_id</th><th>username</th><th>date_created</th></tr>");
while ($row = pg_fetch_row($result)) {
    echo ("<tr>");
        echo ("<td>");
            echo ($row[0]);
        echo ("</td>");
        echo ("<td>");
            echo ($row[1]);
        echo ("</td>");
        echo ("<td>");
            echo ($row[2]);
        echo ("</td>");
    echo("</tr>");
}
echo("</table>");
?>

