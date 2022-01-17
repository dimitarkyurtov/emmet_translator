<?php
    require_once("../models/tree.php");
    require_once("utility.php");
    
    $xml = $_GET['code'];
    $config = $_GET['config'];

    if($config['comment'] == 'false')
    {
        $comment_delims = explode(' ', $config['comment_delim']);

        $comments = explode($comment_delims[0], $xml);


        $new_xml = $comments[0];
        for ($i=1; $i < count($comments); $i++)
        {
            $tokens = explode($comment_delims[1], $comments[$i]);
            if(count($tokens) > 1)
            {
                for ($j=1; $j < count($tokens); $j++) 
                {    
                    $new_xml .= $tokens[$j];
                }
            }
        }
        $xml = $new_xml;
    }

    //$xml = remove_spaces_newLines($xml);
    $xml = remove_spaces_newLines_xml($xml);

    //echo $xml;

    $xml = str_replace("<", "<!", $xml);

    $xml = substr($xml, 1,-1);

    $pattern = "/>|</";
    $xml_tokens = preg_split($pattern, $xml);

    //print_r($xml_tokens);
    

    $root = xml_array_to_tree($xml_tokens);


    //var_dump($root);
    if($xml)
    {
        if($config['output_format'] == 'xml')
        {
            print_tree_xml($root, -1, $config);
        }
        else if($config['output_format'] == 'emmet')
        {
            print_tree_emmet($root, -1, $config);
        }
        else
        {
            print_tree_emmet($root, -1, $config);
        }
    }
?>