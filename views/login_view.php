<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/register.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function register()
        {
            var url= "register_view.php";
            window.location = url;
        }
    </script>
    <title>Document</title>
</head>
<body>
    <div class="outer">
        <div class="inner_log">
            <div class="inner2_log">
                <form  class="inner3" name="form" method="post" action="../controllers/login.php">
                    <div class="field2">
                        <input class="field" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="field2">
                        <input class="field" id="password" name="password" type="password" placeholder="Password">
                    </div>

                    <div class="field2">
                        <button class="field3 button_log" type="submit"> Login </button>
                    </div>

                    
                    <div class="field2">
                        <button class="field3 button_reg" type="button" onclick="register();"> Register </button>
                    </div>
                        <?php
                            if(isset($_GET['error']))
                            {
                                $error = $_GET['error'];
                                echo "<p class=\"field2 error\">" . "$error" . "</p>";
                            }
                        ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>