<?php
    require_once("db.php");

    session_start();
    $limit = $_GET['limit'];
    $emmet = $_GET['emmet'];
    $xml = $_GET['xml'];

    if(!isset($_SESSION['id']))
    {
        header('Location: ../views/login_view.php?error=No session!');
    }

    $user_id = $_SESSION['id'];

    $result = array();
    $result2 = array();

    $conn = connection("queries");
    

        if ($limit != 0) 
        {
            $stmt = $conn->prepare("SELECT * FROM queries WHERE user_id=? AND type=? LIMIT {$limit}");
            if ($xml == "true")
            {
                $stmt->execute([$user_id, "xml"]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            }

            $limit -= count($result);
            $stmt = $conn->prepare("SELECT * FROM queries WHERE user_id=? AND type=? LIMIT {$limit}");
            if ($emmet == "true")
            {
                $stmt->execute([$user_id, "emmet"]);
                $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        else
        {
            $stmt = $conn->prepare("SELECT * FROM queries WHERE user_id=? AND type=?");

            if ($xml == "true")
            {
                $stmt->execute([$user_id, "xml"]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            if ($emmet == "true")
            {
                $stmt->execute([$user_id, "emmet"]);
                $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        
        if($result || $result2)
        {
            echo "<table>";
            echo "<tr><td>id</td><td>code</td><td>date</td><td>user_id</td><td>type</td><td>config</td><td></td></tr>";
            if($result)
            {
                foreach ($result as $res)
                {
                    $i = 0;
                    echo "<tr>";
                    foreach ($res as $r) 
                    {
                        echo "<td>";
                        if($i == 1)
                        {
                            echo "<div class=\"scrollable\">";
                            $r = str_replace("<", "&lt", $r);
                            $r = str_replace(">", "&gt", $r);
                            echo "$r";
                            echo "</div></td>";   
                        }
                        else
                        {
                            echo "$r";
                            echo "</td>";   
                        } 
                        $i ++;
                    }
                    $idd = $res['id'];
                    echo "<td><a  href=\"home_view.php?query_id=$idd\"> Load </a></td>";
                    echo "</tr>";
                }
            }

            if ($result2) 
            {
                foreach ($result2 as $res)
                {
                    echo "<tr>";
                    $i = 0;
                    foreach ($res as $r) 
                    {
                        echo "<td>";
                        if($i == 1)
                        {
                            echo "<div class=\"scrollable\">";
                            $r = str_replace("<", "&lt", $r);
                            $r = str_replace(">", "&gt", $r);
                            echo "$r";
                            echo "</div></td>";   
                        }
                        else
                        {
                            echo "$r";
                            echo "</td>";   
                        } 
                        $i ++;  
                    }
                    $idd = $res['id'];
                    echo "<td><a  href=\"home_view.php?query_id=$idd\"> Load </a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }

?>