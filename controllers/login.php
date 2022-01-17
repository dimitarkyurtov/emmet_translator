<?php
  require_once("db.php");

  function validate_login_form($username, $password)
  {
        $errors = array();

        if(strlen($username) < 3)
        {
            $errors['email'] = 'Invalid username';
        }
    
        return $errors;
  }

  function login($username, $password)
  {
    $conn = connection();
    $hashed_password = sha1($password);
    $query = $conn->prepare("SELECT * FROM users WHERE username=? and password=?") or die("failed!");
    $query->execute([$username, $hashed_password]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($result) 
    {
        session_start();
        $_SESSION['name'] = $username;
        $_SESSION['id'] = $result[0]['id'];
        session_regenerate_id();
        header('Location: ../views/home_view.php');
    } 
    else 
    {
        header('Location: ../views/login_view.php?error=Wrong email or password2!');
    }  
  }
  
  if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $errors = validate_login_form($username, $password);

    if (!$errors) 
    {
      login($username, $password);
    }
    else
    {
        header('Location: ../views/login_view.php?error=Wrong email or password!');
    }
  }
?>