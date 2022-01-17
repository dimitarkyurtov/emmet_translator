<?php
     require_once("credentials.php");

    function connection()
    {
        $credentials = credentials();
        $servername = $credentials['servername'];
        $db_name = $credentials['db_name'];
        $db_username = $credentials['db_username'];
        $db_password = $credentials['db_password'];

        try {
            $connection = new PDO("mysql:host=$servername", $db_username, $db_password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $db_name = "`".str_replace("`","``",$db_name)."`";
            $connection->query("CREATE DATABASE IF NOT EXISTS $db_name");
            $connection->query("use $db_name");
        
            return $connection;
        }
        catch(PDOException $e)
        {
          return $e->getMessage();                         
        }

    }
?>