<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/ajax.js"></script>
    <title>Home</title>
</head>
<body>
    <?php
        require_once("../controllers/db.php");

        $config = '';
        $xml = '';
        $emmet = '';

        if(isset($_GET['query_id']))
        {
            $conn = connection("queries");
            $query = $conn->prepare("SELECT * FROM queries WHERE id=?") or die("failed!");
            $query->execute([$_GET['query_id']]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if($result['type'] == 'xml')
            {
                $xml = $result['code'];
            }
            else
            {
                $emmet = $result['code'];
            }

            $config = $result['config'];

            $xml = str_replace('"', '&quot;', $xml);
            $emmet = str_replace(' ', '', $emmet);
            $config = str_replace(' ', '', $config);
        }

        session_start();
        if(!isset($_SESSION['id']))
        {
            echo "<a href=\"login_view.php\">Login</a>";
            echo "<a href=\"register_view.php\">Register</a>";
        }
        else
        {   
            $name = $_SESSION['name'];
            echo "Hello, $name";
            echo "<a href=\"../controllers/logout.php\">Logout</a>";
            echo "<a href=\"history_view.php\">History</a>";
        }
    ?>
    <br>
    <input id="config" type="text" value=<?php echo "$config"?> />
    <br>
    <input id="emmet" type="text" onchange="interpretate(this.value, 'emmet');" value="<?php echo "$emmet"?>"/>
    <p id="decoded"></p>
    <?php
        if(isset($_SESSION['id']))
        {
            echo "<button onclick=\"save('emmet')\">Save</button>";
        }
    ?>
    <p id="save_emmet"></p>
    <br>
    <input id="xml" type="text" onchange="interpretate(this.value, 'xml');" value="<?php echo "$xml"?>"/>
    <p id="decoded_2"></p>
    <?php
        if(isset($_SESSION['id']))
        {
            echo "<button onclick=\"save('xml')\">Save</button>";
        }
    ?>
    <p id="save_xml"></p>
</body>
</html>
