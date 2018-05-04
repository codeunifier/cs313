<?php
    $filename = 'num_clicks.txt';
    if (!is_file($filename)) {
        file_put_contents($filename, 0);
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $myReadFile = fopen($filename, 'r') or die("Unable to open / find file");
        $currClicks = fread($myReadFile, filesize($filename));
        fclose($myReadFile);
        $myWriteFile = fopen($filename, 'w') or die("Unable to open / find file");
        $currClicks += 1;
        fwrite($myWriteFile, $currClicks);
        fclose($myWriteFile);
        echo $currClicks;
    } else if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $myReadFile = fopen($filename, 'r') or die("Unable to open / find file");
        $currClicks = fread($myReadFile, filesize($filename));
        fclose($myReadFile);
        echo $currClicks;
    }
?>