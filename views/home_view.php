<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/home.css" rel="stylesheet">
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
            $xml = str_replace('> ', '>&#13;', $xml);
            $emmet = preg_replace('/\s*/m', '', $emmet);
            $config = str_replace(' ', '', $config);

        }
    ?>
    
    <nav class="nav" id="nav">
        <?php
            session_start();
            if(!isset($_SESSION['id']))
            {
                echo "<a href=\"login_view.php\" class=\"nav_link\">Login</a>";
                echo "<a href=\"register_view.php\" class=\"nav_link\">Register</a>";
            }
            else
            {   
                $name = $_SESSION['name'];
                echo "<a class=\"nav_link\">Hello, $name</a>";
                echo "<a href=\"../controllers/logout.php\" class=\"nav_link\">Logout</a>";
                echo "<a href=\"history_view.php\" class=\"nav_link\">History</a>";
            }
        ?>
    </nav>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
        <div class="config">
            <h2>Configuration</h2>
            <textarea class="dd textarea" id="config"  placeholder="Input"><?php echo $config;?></textarea>
        </div>
    <br>
    <br>
    <div class="row">
        <div class="col col1">
            <h2>Emmet to xml</h2>
            <textarea  class="textarea" id="emmet"  onchange="interpretate(this.value, 'emmet');" placeholder="Input"><?php echo $emmet;?></textarea>
            <br>
            <br>
            <hr>
            <br>
            <textarea class="textarea" id="decoded" placeholder="Output"></textarea>
            <?php
                if(isset($_SESSION['id']))
                {
                    echo "<button onclick=\"save('emmet')\">Save</button>";
                }
            ?>
            <p id="save_emmet" class="w">s</p>
        </div>
        <div class="col col2">
            <h2>Xml to emmet</h2>
            <textarea class="textarea" id="xml"  onchange="interpretate(this.value, 'xml');" placeholder="Input"><?php echo $xml;?></textarea>
            <br>
            <br>
            <hr>
            <br>
            <textarea class="textarea" id="decoded_2" placeholder="Output"></textarea>
            <?php
                if(isset($_SESSION['id']))
                {
                    echo "<button onclick=\"save('xml')\">Save</button>";
                }
            ?>
            <br>
            <p id="save_xml" class="w">s</p>
        </div>
    </div>
    <script>
        if(document.getElementById("emmet").value)
            interpretate(document.getElementById("emmet").value, 'emmet');
        else
            interpretate(document.getElementById("xml").value, 'xml');
    </script>
</body>
</html>
