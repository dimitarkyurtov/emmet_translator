<?php
    require_once("../models/tree.php");
    require_once("utility.php");

    $emmet = $_GET['code'];
    $config = $_GET['config'];

    if($config['comment'] == "false")
    {
        $comment_delims = explode(' ', $config['comment_delim']);

        $comments = explode($comment_delims[0], $emmet);


        $new_emmet = $comments[0];
        for ($i=1; $i < count($comments); $i++)
        {
            $tokens = explode($comment_delims[1], $comments[$i]);
            if(count($tokens) > 1)
            {
                for ($j=1; $j < count($tokens); $j++) 
                {    
                    $new_emmet .= $tokens[$j];
                }
            }
        }
        $emmet = $new_emmet;
    }

    $emmet = remove_spaces_newLines_emmet($emmet);

    $emmet_tokens = tokenize_depth($emmet);
    $root = array_to_tree_empty_root($emmet_tokens);
    blooms($root);
    remove_multiplications($root);
    remove_brackets($root);
    
    //var_dump($root);
    if($config['output_format'] == 'xml')
    {
        print_tree_xml($root, -1, $config);
    }
    else if($config['output_format'] == 'emmet')
    {
        $config['lmao'] = 'true';
        print_tree_emmet($root, -1, $config);
    }
    else
    {
        print_tree_xml($root, -1, $config);
    }
?>