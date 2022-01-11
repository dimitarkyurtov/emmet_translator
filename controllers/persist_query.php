<?php
    require_once("db.php");
    
    session_start();


        $conn = connection("queries");
        $stmt = $conn->prepare("INSERT INTO queries (code, user_id, type, config) VALUES (?, ?, ?, ?)");
        $code = $_POST['code'];
        $type = $_POST['type'];
        $config = $_POST['config'];
        if(!isset($_SESSION['id']))
        {
            echo "Log in!";
            return;
        }
        $user_id = $_SESSION['id'];

        try {
            $result = $stmt->execute([$code, $user_id, $type, $config]);
        }
        catch(PDOException $e)
        { 
            $error = $stmt->errorInfo();

            if ($error[1] == 1062) 
            {
                echo "Already saved!";
            }
            else
            {
                echo "Cant open connection to db!";
            }
          return;                         
        }

        if ($result)
        {
            echo "Success!";
        }
        //$conn = null;

?>