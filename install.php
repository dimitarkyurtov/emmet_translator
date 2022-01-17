<?php
     require_once("controllers/db.php");

    $filename = 'queries.sql';
    
    $connection = connection();

    $templine = '';
    $lines = file($filename);

    foreach ($lines as $line)
    {
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        $templine .= $line;

        if (substr(trim($line), -1, 1) == ';')
        {
            $connection->exec($templine);
            
            $templine = '';
        }
    }
    echo "Tables imported successfully";
?>