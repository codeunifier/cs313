<?php
$locations = array ( "na" => "North America", "sa" => "South America", "eu" => "Europe", "as" => "Asia", "au" => "Australia", "af" => "Africa", "an" => "Antarctica");
$name = $_POST['name'];
$email = $_POST['email'];
$major = $_POST['major'];
$comment = $_POST['comment'];
$continent = $_POST['check'];

echo "name: $name <br/>";
//echo "e-mail: $email <br/>";
echo "<a href='mailto: $email '>$email</a><br />";
echo "major: $major <br/>";
echo "comments: $comment <br/>";
echo "Contents visited: ";
//print_r($locations);
foreach($continent as $cont){
   echo "$locations[$cont], ";
};



/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 5/8/2018
 * Time: 2:35 PM
 */