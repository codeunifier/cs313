<html>

<body>
<h1>Scripture Resources</h1>
<?php
  $dbase = "postgres";
  
  try {   
    $dbUrl = getenv('HEROKU_POSTGRESQL_ONYX_URL');
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

  foreach ($db->query('SELECT * FROM scriptures') as $row) {
    echo  "<b>" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " </b> - \"" . $row['content'] . "\"" . '<br/>';
  }

?>
<br><br><br>
<a href="search.php">Go to search page</a>
</body>
</html>