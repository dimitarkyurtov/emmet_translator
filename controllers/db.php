<?php

    function connection($name)
    {
        $servername = "localhost";
        $db_name = $name;
        $db_username = "root";
        $db_password = "";

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            return $connection;
        }
        catch(PDOException $e)
        {
          return $e->getMessage();                         
        }

    }
?>