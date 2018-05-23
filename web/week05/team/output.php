
<?php
// Start the session
session_start();
$listOfScriptues = $_GET["check"];
?>
<?php
$dbase = "postgres";
try
{
  $dbUrl = getenv('HEROKU_POSTGRESQL_ONYX_URL');
  $dbopts = parse_url($dbUrl);
  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
    if(!empty($dbopts["path"])){
  $dbName = ltrim($dbopts["path"],'/');
    }else{
    $dbName = $dbase;
  }  
  
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
	 
foreach($listOfScriptues as $scripture){
	
  $statement = $db->query("SELECT book, chapter, verse, scripture_id FROM scriptures where book = '".$scripture."';");
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
    echo 'Scriptures: ' . $row['book'] . " " .$row['chapter'] .':'. $row['verse'] . '<br/>';
    echo '<a href="content.php?value_key='.$row['scripture_id'].'">Link</a><br/>';
	}
}
?>