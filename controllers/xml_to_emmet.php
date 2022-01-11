<?php
    require_once("../models/tree.php");
    require_once("utility.php");
    
    $xml = $_GET['code'];
    $config = $_GET['config'];


    $xml = remove_spaces_newLines($xml);

    $xml = str_replace("<", "<!", $xml);

    $xml = substr($xml, 1,-1);

    $pattern = "/>|</";
    $xml_tokens = preg_split($pattern, $xml);

    //print_r($xml_tokens);
    

    $root = xml_array_to_tree($xml_tokens);


    //var_dump($root);
    if($xml)
    {
        print_tree_emmet($root, -1, $config);
    }
?>