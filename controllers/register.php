<?php
    require_once("db.php");

        $valid = true;
        $errors = array();
        if ($_POST) 
        {
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_2 = $_POST['password_2'];
            $name = $_POST['name'];

            if (!$username || !$password || !$password_2 || !$name) {
                $valid = false;
            } 
            if(strlen($username) < 3){
                $valid = false;
            }
            if(strlen($username) > 30){
                $valid = false;
            }
            if (!preg_match('~[0-9]+~', $password)) {
                $valid = false;
            }          
            if(strlen($password) < 6){
                $valid = false;
            }
            if (!preg_match('~[0-9]+~', $password)) {
                $valid = false;
            }
            if(strtoupper($password) == $password){
                $valid = false;
            }
            if(strtolower($password) == $password){
                $valid = false;
            }
            if($password != $password_2){
                $valid = false;
            }
            if(strlen($username) < 2){
                $valid = false;
            }
            if(strlen($name) > 15){
                $valid = false;
            }
        }
        else
        {
            $valid = false;
        }
        if ($valid)
        {

                $conn = connection("queries");
                $stmt = $conn->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");
                $hashed_password = sha1($password);
                $result = $stmt->execute([$username, $hashed_password, $name]);

                $stmt2 = $conn->prepare("SELECT * FROM users WHERE username=? and password=?");
                $stmt2->execute([$username, $hashed_password]);
                $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if ($result)
                {
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['id'] = $result2[0]['id'];
                    header("Location: ../views/home_view.php");
                }
                else
                {
                    $error = $stmt->errorInfo();

                    if ($error[1] == 1062) 
                    {
                        header("Location: ../views/register_view.php?error=User with same username or password is already registered!");
                    }

                    header("Location: ../views/register_view.php");
                }
                //$conn = null;


        }
        else
        {
            header('Location: ../views/register_view.php');
        }
    ?>