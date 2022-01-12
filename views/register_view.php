<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/register.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/register_validation.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="outer">
        <div class="inner">
            <div class="inner2">
                <form  class="inner3" name="form" method="post" action="../controllers/register.php" onsubmit="return clickHandler()">
                    <div class="field2">
                        <input class="field" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="field2">
                        <input class="field" id="password" name="password" type="password" placeholder="Password">
                    </div>

                    <div class="field2">
                        <input class="field" id="password_2" name="password_2" type="password" placeholder="Repeat Password">
                    </div>

                    <div class="field2">
                        <input class="field" id="name" name="name" placeholder="Name" >
                    </div>

                    <div class="field2">
                        <button class="field3 button_log" type="submit"> Register me </button>
                    </div>
                    <p id="error" class="error">        
                        <?php
                            if(isset($_GET['error']))
                            {
                                $error = $_GET['error'];
                                echo "$error";
                            }
                        ?>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>